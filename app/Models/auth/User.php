<?php

namespace App\Models\auth;

use App\Notifications\CustomResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'phone'

    ];
    protected $hidden = [
        'password',

    ];


    public function sendPasswordResetNotification($token)
    {
        // Tạo mã ngẫu nhiên 6 chữ số
        $code = rand(100000, 999999);
    
        // Lưu mã này vào cơ sở dữ liệu hoặc cache để xác minh sau
        Cache::put('password_reset_code_' . $this->email, $code, now()->addMinutes(config('auth.passwords.'.config('auth.defaults.passwords').'.expire')));
    
        $this->notify(new CustomResetPasswordNotification($code));
    }
}
