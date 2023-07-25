<?php

namespace App\Models;
use App\Http\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
class Marcas extends Model
{
    use HasFactory;
    use SoftDeletes;
    use QueryFilter;
    protected $table = 'marcas';
    protected $fillable = ['slug','nombre','descripcion','logo_principal','logo_detalle','image_detalle','descripcion_historia_1','descripcion_historia_2','origen_pais_logo',
    'origen_pais','anios_en_mercado_mundial','anios_en_mercado_peru','tallares_oficiales','active'];

    public function ofertas(){
        return $this->hasMany(Ofertas::class,'marca_id');
    }
    public function oferta(){
        return $this->ofertas ?  $this->ofertas()->where('active',1)->first(): null;
    }

    public function tipoMarca()
    {
        return $this->belongsTo(Tipos::class, 'tipo_marca');
    }
    public function updateImages($images)
    {
        if ($images) {
            $fileName = $this->id . "-principal-" . time() . '.' . $images->getClientOriginalExtension();
            $path = Storage::disk('marcas')->putFileAs($this->id, $images, $fileName);
            $this->fill([
                'logo_principal' => basename($path)
            ])->save();
        }
    }
    public function updateLogoDetalle($images)
    {
        if ($images) {
            $fileName = $this->id . "-logodetalle-" . time() . '.' . $images->getClientOriginalExtension();
            $path = Storage::disk('marcas')->putFileAs($this->id, $images, $fileName);
            $this->fill([
                'logo_detalle' => basename($path)
            ])->save();
        }
    }
    public function updateImageDetalle($images)
    {
        if ($images) {
            $fileName = $this->id . "-detalle-" . time() . '.' . $images->getClientOriginalExtension();
            $path = Storage::disk('marcas')->putFileAs($this->id, $images, $fileName);
            $this->fill([
                'image_detalle' => basename($path)
            ])->save();
        }
    }
    public function updateImageOrigen($images)
    {
        if ($images) {
            $fileName = $this->id . "-origen-" . time() . '.' . $images->getClientOriginalExtension();
            $path = Storage::disk('marcas')->putFileAs($this->id, $images, $fileName);
            $this->fill([
                'origen_pais_logo' => basename($path)
            ])->save();
        }
    }

    public function scopeActivos($query)
    {
        return $query->where('active', 1);
    }
}
