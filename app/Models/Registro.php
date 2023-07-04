<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    protected $table='registro';
    protected $primaryKey='idregistro';

    public $timestamps=false;
    
    protected $fillable =[
        'idempleado',
        'fecha_registro',
        'estado',
        'numero_comprobante'


    ];
    
    protected $guarded=[

    ];
    use HasFactory;
}
