<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LogMasuk extends Model
{
    use HasFactory;
    protected $table = 'log_masuk';
    protected $guarded = ['id'];
    public static function scopeSearch($query, $search)
    {
        $src = trim($search);
        return empty($src) ? static::query()
            : static::query()->where([['id', 'like', '%' . $src . '%'], ['user_id', Auth::user()->id]])
            ->orWhere('ip', 'like', '%' . $src . '%')
            ->orWhere('user_agent', 'like', '%' . $src . '%');
    }
    // class where userid
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }
}
