<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Episodio extends Model{

    // não tem na tabela
    public $timestamps = false;

    //campos obrigatórios
    protected $fillable = ['temporada', 'numero', 'assistido', 'serie_id'];

    protected $appends = ['links'];

    public function serie(){
        return $this->belongsTo(Serie::class);
    }

    //Accessors do Eloquent (ORM utilizado pelo Lumen e Laravel).
    public function getAssistidoAttribute($assistido): bool {
        return $assistido;
    }

    public function getLinksAttribute(): array{
        return [
            'self' => '/api/espisodios/' . $this->id,
            'serie' => '/api/series/' . $this->serie_id
        ];
    }



}