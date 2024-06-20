<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
    */
    protected $fillable = [
        'kode',
        'nama_material',
        'keterangan',
    ];
}
