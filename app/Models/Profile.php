<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $table = "profile";
    protected $fillable = [
        'user_id',
        'nik',
        'alamat',
        'gender',
        'nomor_hp',
        'village_id'
    ];
    public static function gender() :array
    {
        return [
            ' ' => 'Pilih Gender',
            'perempuan' => 'perempuan',
            'laki-laki' => 'laki-laki'
        ];
    }

}
