<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleRegistro extends Model
{
    protected $table='detalle_registro';
    protected $primaryKey='iddetalle_registro';

    public $timestamps=false;
    
    protected $fillable =[
        'idregistro',
        'idarticulo',
        'cantidad'


    ];
    
    protected $guarded=[

    ];
    use HasFactory;
}
