<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function search($search)
    {
        $src = trim($search);
        return empty($src) ? static::query()
            : static::query()->where([['sid', 'like', '%' . $src . '%']])
            ->orWhere('kategori', 'like', '%' . $src . '%');
    }
    public function smm()
    {
        return $this->hasMany(Smm::class, 'category', 'kategori');
    }
}
