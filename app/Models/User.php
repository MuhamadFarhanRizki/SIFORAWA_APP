<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Nama tabel yang digunakan.
     */
    protected $table = 'users';

    /**
     * Kolom yang boleh diisi.
     */
    protected $fillable = [
        'username',
        'password',
        'no_telepon',
        'role',
    ];

    /**
     * Kolom yang disembunyikan ketika model diubah menjadi array/JSON.
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Casting atribut.
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Relasi User dengan Pengaduan.
     *
     * Satu warga dapat membuat banyak pengaduan.
     */
    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'user_id');
    }

    /**
     * Relasi User dengan Tanggapan.
     *
     * Satu admin dapat memberikan banyak tanggapan.
     */
    public function tanggapan()
    {
        return $this->hasMany(Tanggapan::class, 'user_id');
    }

    /**
     * Mengecek apakah user adalah admin.
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Mengecek apakah user adalah warga.
     */
    public function isWarga()
    {
        return $this->role === 'warga';
    }
}