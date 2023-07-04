<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table='empleado';
    protected $primaryKey='idempleado';

    public $timestamps=false;
    
    protected $fillable =[
        'estado',
        'nombre',
        'apellido',
        'tipo_documento',
        'idarea',
        'num_documento',
        'direccion',
        'telefono',
        'email',
        


    ];
    
    protected $guarded=[

    ];
    use HasFactory;
}
