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

        $artists = $query->paginate(15);

        return view('_admin.artists.index', compact('artists'));
    }

    public function store(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            // Remove email validation if 'email' column does not exist
            // 'email' => 'required|email|unique:artists,email',
            // Add other fields as needed
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Generate slug from name
        $slug = \Str::slug($request->input('name'));

        // Only use fields that exist in the artists table
        Artist::create([
            'name' => $request->input('name'),
            'slug' => $slug,
            // Add other fields as needed
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
}
