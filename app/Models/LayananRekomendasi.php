<?php

namespace App\Models;

use App\Models\Smm;
use Illuminate\Database\Eloquent\Model;
use App\Models\KategoriLayananRekomendasi;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LayananRekomendasi extends Model
{
    use HasFactory;
    protected $table = 'layanan_rekomendasi';
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriLayananRekomendasi::class, 'kategori_rekomendasi_id');
    }

    public function smm(): BelongsTo
    {
        return $this->belongsTo(Smm::class, 'service', 'service');
    }

    protected $guarded = ['id'];
}
