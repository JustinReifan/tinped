<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodePembayaran extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public static function search($search)
    {
        $src = trim($search);
        return empty($src) ? static::query()
            : static::query()->where([['id', 'like', '%' . $src . '%']])
            ->orWhere('provider', 'like', '%' . $src . '%')
            ->orWhere('type_payment', 'like', '%' . $src . '%')
            ->orWhere('code', 'like', '%' . $src . '%')
            ->orWhere('name', 'like', '%' . $src . '%')
            ->orWhere('rate_type', 'like', '%' . $src . '%')
            ->orWhere('rate', 'like', '%' . $src . '%')
            ->orWhere('bonus', 'like', '%' . $src . '%')
            ->orWhere('max_nominal', 'like', '%' . $src . '%')
            ->orWhere('account_number', 'like', '%' . $src . '%')
            ->orWhere('account_name', 'like', '%' . $src . '%')
            ->orWhere('status', 'like', '%' . $src . '%');
    }
}
