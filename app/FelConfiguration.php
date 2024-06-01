<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FelConfiguration extends Model
{
    use HasFactory;

    protected $table = 'fel_configurations';

    protected $fillable = [
        'business_id',
        'location_id',
        'fel_active',
        'fel_predeterm',
        'tipo_fact',
        'codigo_establecimiento',
        'nit_emisor',
        'nombre_emisor',
        'tipo_frase',
        'codigo_escenario',
        'link_firma',
        'link_certificar',
        'link_anular',
        'Content_Type',
        'usuario_firma',
        'llave_firma',
        'usuario_api',
        'llave_api'
    ];
}
