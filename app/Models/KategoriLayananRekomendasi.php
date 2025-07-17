<?php

namespace App\Models;

use App\Models\LayananRekomendasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriLayananRekomendasi extends Model
{
    use HasFactory;

    protected $table = 'kategori_layanan_rekomendasi';
    public function layananRekomendasi(): HasMany
    {
        return $this->hasMany(LayananRekomendasi::class, 'kategori_rekomendasi_id');
    }


    protected $guarded = ['id'];
}
