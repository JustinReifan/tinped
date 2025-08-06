<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class History extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function service()
    {
        return $this->belongsTo(Smm::class, 'service_id', 'service');
    }
    public static function search($search)
    {
        $src = trim($search);
        return empty($src) ? static::query()
            : static::query()->where([['id', 'like', '%' . $src . '%'], ['user_id', Auth::user()->id]])
            ->orWhere('trxid', 'like', '%' . $src . '%')
            ->orWhere('layanan', 'like', '%' . $src . '%')
            ->orWhere('target', 'like', '%' . $src . '%')
            ->orWhere('quantity', 'like', '%' . $src . '%')
            ->orWhere('price', 'like', '%' . $src . '%')
            ->orWhere('start_count', 'like', '%' . $src . '%')
            ->orWhere('remains', 'like', '%' . $src . '%')
            ->orWhere('refill', 'like', '%' . $src . '%')
            ->orWhere('status', 'like', '%' . $src . '%')
            ->orWhere('created_at', 'like', '%' . $src . '%')
            ->orWhere('updated_at', 'like', '%' . $src . '%');
    }
    public static function scopeAdmin($query, $search)
    {
        $src = trim($search);
        return empty($src) ? static::query()
            : static::query()->where([['id', 'like', '%' . $src . '%']])
            ->orWhereHas('user', function ($q) use ($src) {
                $q->where('username', 'like', '%' . $src . '%');
            })
            ->orWhere('trxid', 'like', '%' . $src . '%')
            ->orWhere('layanan', 'like', '%' . $src . '%')
            ->orWhere('target', 'like', '%' . $src . '%')
            ->orWhere('quantity', 'like', '%' . $src . '%')
            ->orWhere('price', 'like', '%' . $src . '%')
            ->orWhere('start_count', 'like', '%' . $src . '%')
            ->orWhere('remains', 'like', '%' . $src . '%')
            ->orWhere('refill', 'like', '%' . $src . '%')
            ->orWhere('status', 'like', '%' . $src . '%')
            ->orWhere('created_at', 'like', '%' . $src . '%')
            ->orWhere('updated_at', 'like', '%' . $src . '%');
    }
    // class where userid
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }
    public function providers()
    {
        return $this->belongsTo(Provider::class, 'provider', 'nama')->withDefault();
    }
}
