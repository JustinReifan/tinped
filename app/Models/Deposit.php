<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Deposit extends Model
{
    use HasFactory;
    protected $table = 'deposit';
    protected $guarded = ['id'];
    public function metode()
    {
        return $this->belongsTo(MetodePembayaran::class, 'code', 'code')->withDefault();
    }
    public static function scopeSearch($query, $search)
    {
        $src = trim($search);
        return empty($src) ? static::query()
            : static::query()->where([['id', 'like', '%' . $src . '%'], ['user_id', Auth::user()->id]])
            ->orWhere('trxid', 'like', '%' . $src . '%')
            ->orWhere('code', 'like', '%' . $src . '%')
            ->orWhere('name_payment', 'like', '%' . $src . '%')
            ->orWhere('account_number', 'like', '%' . $src . '%')
            ->orWhere('amount', 'like', '%' . $src . '%')
            ->orWhere('status', 'like', '%' . $src . '%')
            ->orWhere('created_at', 'like', '%' . $src . '%')
            ->orWhere('updated_at', 'like', '%' . $src . '%');
    }
    // class where userid
    public function scopeUser($query)
    {
        return $query->where('user_id', Auth::user()->id);
    }
    // eager loading get user by user_id
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }
}
