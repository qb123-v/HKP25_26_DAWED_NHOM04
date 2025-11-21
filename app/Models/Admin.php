<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    // Tên bảng (nếu tên bảng khác tên model thì phải khai báo)
    protected $table = 'admins';

    // Các cột được phép fill
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    // Ẩn các cột nhạy cảm khi trả về JSON
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Tự động hash password khi gán
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    // (Tùy chọn) Nếu bạn muốn dùng username để đăng nhập thay vì email
    public function getAuthPassword()
    {
        return $this->password;
    }

    // Nếu guard admin dùng username thay vì email thì thêm hàm này
    public function username()
    {
        return 'username'; // hoặc 'email' nếu bạn dùng email để login
    }
}