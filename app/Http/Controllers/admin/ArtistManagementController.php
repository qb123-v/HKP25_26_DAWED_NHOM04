<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artist;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ArtistManagementController extends Controller
{
    public function index(Request $request)
    {
        // Filter by name or email if provided
        $query = Artist::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        $artists = $query->paginate(10); // Changed from 15 to 10

        return view('_admin.artists.index', compact('artists'));
    }

    public function store(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:artists,email',
            'phone'   => 'nullable|string|max:50',
            'dob'     => 'nullable|date',
            'address' => 'nullable|string|max:255',
            'intro'   => 'nullable|string',
            'avatar'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Generate slug from name
        $slug = \Str::slug($request->input('name'));

        // Handle avatar upload
        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        // Save artist
        Artist::create([
            'name'    => $request->input('name'),
            'slug'    => $slug,
            'email'   => $request->input('email'),
            'phone'   => $request->input('phone'),
            'dob'     => $request->input('dob'),
            'address' => $request->input('address'),
            'intro'   => $request->input('intro'),
            'avatar'  => $avatarPath,
        ]);

        return redirect()->route('admin.artists.index')->with('success', 'Artist added successfully.');
    }

    public function exportCsv(Request $request)
    {
        $query = Artist::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        $artists = $query->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="artists.csv"',
        ];

        $columns = ['ID', 'Name', 'Email']; // Add other columns as needed

        $callback = function () use ($artists, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($artists as $artist) {
                fputcsv($file, [
                    $artist->id,
                    $artist->name,
                    $artist->email,
                    // Add other fields as needed
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function show($id)
    {
        // Ensure correct artist is returned by ID
        $artist = Artist::findOrFail($id);
        return response()->json($artist);
    }

    public function update(Request $request, $id)
    {
        $artist = Artist::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name'    => 'required|string|max:255',
            'email'   => 'nullable|email|unique:artists,email,' . $artist->id,
            'phone'   => 'nullable|string|max:50',
            'dob'     => 'nullable|date',
            'address' => 'nullable|string|max:255',
            'intro'   => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Only update fields that exist in the table
        $artist->name    = $request->input('name');
        $artist->email   = $request->input('email');
        $artist->phone   = $request->input('phone');
        $artist->dob     = $request->input('dob');
        $artist->address = $request->input('address');
        $artist->intro   = $request->input('intro');
        $artist->save();

        // Return the updated values (not nulls)
        return response()->json(['success' => true, 'artist' => [
            'id'      => $artist->id,
            'name'    => $artist->name,
            'email'   => $artist->email,
            'phone'   => $artist->phone,
            'dob'     => $artist->dob,
            'address' => $artist->address,
            'intro'   => $artist->intro,
        ]]);
    }

    public function updateAvatar(Request $request, $id)
    {
        $artist = Artist::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if ($request->hasFile('avatar')) {
            // Remove old avatar if exists
            if ($artist->avatar && \Storage::disk('public')->exists($artist->avatar)) {
                \Storage::disk('public')->delete($artist->avatar);
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $artist->avatar = $path;
            $artist->save();
        }

        return response()->json([
            'success' => true,
            'avatar_url' => $artist->avatar ? \Storage::url($artist->avatar) : null,
        ]);
    }

    public function destroy($id)
    {
        $artist = Artist::findOrFail($id);
        // Optionally delete avatar file
        if ($artist->avatar && \Storage::disk('public')->exists($artist->avatar)) {
            \Storage::disk('public')->delete($artist->avatar);
        }
        $artist->delete();
        return response()->json(['success' => true]);
    }
}
