<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pengaduan extends Model
{
    protected $table = 'pengaduan';

    protected $fillable = [
        'user_id',
        'jenis_pengaduan',
        'judul',
        'isi_pengaduan',
        'rw',
        'lokasi_kejadian',
        'status',
        'tanggapan',
    ];

    // Pilihan dropdown jenis pengaduan
    public const JENIS_PENGADUAN = [
        'Pelayanan Administrasi',
        'Infrastruktur',
        'Kebersihan dan Lingkungan',
        'Sosial dan Masyarakat',
        'Lainnya',
    ];

    // Pilihan dropdown RW
    public const PILIHAN_RW = [
        'RW.01',
        'RW.02',
        'RW.03',
        'RW.04',
        'RW.05',
        'RW.06',
        'RW.07',
        'RW.08',
    ];

    // Pilihan status pengaduan
    public const STATUS_PENGADUAN = [
        'diajukan',
        'diverifikasi',
        'diproses',
        'ditanggapi',
        'selesai',
    ];

    // Relasi pengaduan dengan akun warga
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relasi pengaduan dengan daftar tanggapan admin
    public function tanggapan(): HasMany
    {
        return $this->hasMany(
            Tanggapan::class,
            'pengaduan_id',
            'id'
        );
    }

    // Relasi daftar tanggapan untuk halaman cek status warga
    public function daftarTanggapan(): HasMany
    {
        return $this->hasMany(
            Tanggapan::class,
            'pengaduan_id',
            'id'
        );
    }
}