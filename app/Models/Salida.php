<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salida extends Model
{
    protected $table='salida';
    protected $primaryKey='idsalida';

    public $timestamps=false;
    
    protected $fillable =[
        'idempleado',
        'fecha_salida',
        'estado'
    


    ];
    
    protected $guarded=[

    ];
    use HasFactory;
}
