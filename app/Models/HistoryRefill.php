<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class HistoryRefill extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public static function search($search)
    {
        $src = trim($search);
        return empty($src)
            ? static::query()
            : static::query()->where('user_id', Auth::user()->id)
            ->where(function ($query) use ($src) {
                $query->where('id', 'like', '%' . $src . '%')
                    ->orWhere('refill_id', 'like', '%' . $src . '%')
                    ->orWhere('provider', 'like', '%' . $src . '%')
                    ->orWhere('layanan', 'like', '%' . $src . '%')
                    ->orWhere('target', 'like', '%' . $src . '%')
                    ->orWhere('status', 'like', '%' . $src . '%')
                    ->orWhere('created_at', 'like', '%' . $src . '%')
                    ->orWhere('updated_at', 'like', '%' . $src . '%');
            });
    }
    public function scopeAdmin($query, $search)
    {
        $src = trim($search);
        return empty($src)
            ? static::query()
            : static::query()
            ->where(function ($query) use ($src) {
                $query->where('id', 'like', '%' . $src . '%')
                    ->orWhere('refill_id', 'like', '%' . $src . '%')
                    ->orWhere('provider', 'like', '%' . $src . '%')
                    ->orWhere('layanan', 'like', '%' . $src . '%')
                    ->orWhere('target', 'like', '%' . $src . '%')
                    ->orWhere('status', 'like', '%' . $src . '%')
                    ->orWhere('created_at', 'like', '%' . $src . '%')
                    ->orWhere('updated_at', 'like', '%' . $src . '%')
                    ->orWhereHas('user', function ($userQuery) use ($src) {
                        $userQuery->where('username', 'like', '%' . $src . '%');
                    });
            });
    }
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
