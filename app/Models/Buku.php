<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Buku as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model; //Model Eloquent

class Buku extends Model //Definisi Model
{
    protected $table = 'Buku'; //Eloquents akan membuat model mahasiswa menyimpan record di tabel bukus
    public $timestamps = false;
    protected $primaryKey = 'id_buku'; //Memanggil isi DB dengan primarykey

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_buku' ,
        'Judul',
        'Kategori',
        'Penerbit',
        'Pengarang',
        'Jumlah',
        'Status',
    ];
};