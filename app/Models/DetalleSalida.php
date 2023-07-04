<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleSalida extends Model
{
    protected $table='detalle_salida';
    protected $primaryKey='iddetalle_salida';

    public $timestamps=false;
    
    protected $fillable =[
        'idsalida',
        'idarticulo',
        'cantidad'


    ];
    
    protected $guarded=[

    ];
    use HasFactory;
}
