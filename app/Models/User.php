<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $guarded = ['id'];
    public static function search($query)
    {
        $query = trim($query);
        return empty($query) ? static::query()
            : static::query()->where('name', 'like', '%' . $query . '%')
            ->orWhere('username', 'like', '%' . $query . '%')
            ->orWhere('email', 'like', '%' . $query . '%')
            ->orWhere('whatsapp', 'like', '%' . $query . '%')
            ->orWhere('google2fa', 'like', '%' . $query . '%')
            ->orWhere('balance', 'like', '%' . $query . '%')
            ->orWhere('omzet', 'like', '%' . $query . '%')
            ->orWhere('level', 'like', '%' . $query . '%')
            ->orWhere('role', 'like', '%' . $query . '%')
            ->orWhere('is_referral', 'like', '%' . $query . '%')
            ->orWhere('is_mail', 'like', '%' . $query . '%')
            ->orWhere('referral', 'like', '%' . $query . '%')
            ->orWhere('gender', 'like', '%' . $query . '%')
            ->orWhere('zona', 'like', '%' . $query . '%')
            ->orWhere('status', 'like', '%' . $query . '%');
    }
}
