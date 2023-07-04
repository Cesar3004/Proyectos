<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $table='articulo';
    protected $primaryKey='idarticulo';

    public $timestamps=false;
    
    protected $fillable =[
        'idcategoria',
        'idarea',
        'codigo',
        'nom_articulo',
        'descrip_articulo',
        'imagen',
        'estado',
        'stock'



    ];
    
    protected $guarded=[

    ];
    use HasFactory;
}
