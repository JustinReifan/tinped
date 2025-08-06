<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Favorit extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public static function search($search)
    {
        $src = trim($search);
        return empty($src)
        ? static::query()
            : static::query()
            ->where('user_id', Auth::user()->id)
            ->where(function ($query) use ($src) {
                $query->where('id', 'like', '%' . $src . '%')
                    ->orWhere('service_id', 'like', '%' . $src . '%')
                    ->orWhere('category', 'like', '%' . $src . '%')
                    ->orWhere('layanan', 'like', '%' . $src . '%')
                    ->orWhere('price', 'like', '%' . $src . '%')
                    ->orWhere('created_at', 'like', '%' . $src . '%')
                    ->orWhere('updated_at', 'like', '%' . $src . '%');
            });

    }
    // class where userid
    public function scopeUser($query)
    {
        return $query->where('user_id', Auth::user()->id)->withDefault();
    }
}
