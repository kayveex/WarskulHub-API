<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proker extends Model
{
    use HasFactory;
    
    protected $table = 'proker';
    protected $primaryKey = 'id';
    protected $fillable = [
        'bulan',
        'tahun',
        'pertemuan',
        'uraian_kegiatan',
        'keterangan',
        'class_id',
    ];

    // One to Many towards Classes
    public function prokerToClasses() {
        return $this->belongsTo(Classes::class, 'class_id', 'id');
    }


}
