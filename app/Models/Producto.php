<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    public function compras()
    {
        return $this->belongsToMany(Compra::class)->withPivot('cantidad', 'precio_compra', 'precio_venta')->withTimestamps();
    }

    public function ventas()
    {
        return $this->belongsToMany(Venta::class)->withPivot('cantidad', 'precio_venta', 'descuento')->withTimestamps();
    }

    public function categorias()
    {
        return $this->belongsToMany(Categoria::class)->withTimestamps();
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    public function presentacione()
    {
        return $this->belongsTo(Presentacione::class);
    }

    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'fecha_vencimiento',
        'marca_id',
        'presentacione_id',
        'img_path',
    ];

    public function handleUploadImage($image)
    {
        $file = $image;
        $name = time() . $file->getClientOriginalName();
        $file->move(public_path() . '/img/productos/', $name);
        return $name;
    }
}
