<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Ticket extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public static function search($search)
    {
        $src = $search;
        return empty($src) ? static::query()
            : static::query()->where([['id', 'like', '%' . $src . '%']])
            ->orWhere('ticket_id', 'like', '%' . $src . '%')
            ->orWhere('subject', 'like', '%' . $src . '%')
            ->orWhere('type_ticket', 'like', '%' . $src . '%')
            ->orWhere('status', 'like', '%' . $src . '%');
    }
    // class where userid
    public function scopeUser($query)
    {
        return $query->where('user_id', Auth::user()->id);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }
}
