<?php

namespace App\Models;

use App\Models\LayananRekomendasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Smm extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'smm';
    public static function scopeSearch($query, $search)
    {
        $src = trim($search);

        return empty($src)
            ? static::query()
            : static::query()->where('status', 'aktif')
            ->where(function ($query) use ($src) {
                $query->where('id', 'like', '%' . $src . '%')
                    ->orWhere('service', 'like', '%' . $src . '%')
                    ->orWhere('category', 'like', '%' . $src . '%')
                    ->orWhere('name', 'like', '%' . $src . '%')
                    ->orWhere('price', 'like', '%' . $src . '%')
                    ->orWhere('min', 'like', '%' . $src . '%')
                    ->orWhere('max', 'like', '%' . $src . '%')
                    ->orWhere('type', 'like', '%' . $src . '%')
                    ->orWhere('created_at', 'like', '%' . $src . '%')
                    ->orWhere('updated_at', 'like', '%' . $src . '%');
            })
            ->when(!empty($src), function ($query) { // Hanya terapkan kondisi ini jika $src tidak kosong
                $query->where('category', 0)
                    ->where('type', 'like', '%%')
                    ->where('refill', 'like', '%%');
            });
    }
    public function kategori()
    {
        return $this->belongsTo(Category::class, 'category', 'kategori')->withDefault();
    }
    public static function searchKategori($search)
    {
        $src = $search;
        return empty($src) ? static::query()
            : static::query()->where('category', 'like', '%' . $src . '%');
    }
    public function icon(): HasMany
    {
        return $this->hasMany(IconLayanan::class, 'kategori', 'category')
            ->where('kategori', 'like', '%' . $this->category . '%');
    }


    public function layananRekomendasi(): HasOne
    {
        return $this->hasOne(LayananRekomendasi::class, 'service', 'service');
    }
}
