<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'not found',
            'email' => 'not found',
        ]);
    }

    public function scopeSearch($query, $search)
    {
        $src = trim($search);
        return empty($src) ? static::query()
            : static::query()->where('user_id', 'like', '%' . $src . '%')
            ->orWhere('code', 'like', '%' . $src . '%')
            ->orWhere('level', 'like', '%' . $src . '%')
            ->orWhere('komisi', 'like', '%' . $src . '%')
            ->orWhere('visitors', 'like', '%' . $src . '%')
            ->orWhere('registered', 'like', '%' . $src . '%')
            ->orWhereHas('user', function ($query) use ($src) {
                $query->where('name', 'like', '%' . $src . '%')
                    ->orWhere('email', 'like', '%' . $src . '%');
            });
    }
}
