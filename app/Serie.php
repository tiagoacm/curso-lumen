<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model{
    // não tem na tabela
    public $timestamps = false;

    //campos obrigatórios
    protected $fillable = ['nome'];

    //usado para adicionar link na resposta
    protected $appends = ['links'];

    public function episodios(){
        return $this->hasMany(Episodio::class);
    }

    public function getLinksAttribute(): array {
        return [
            'self' => '/api/series/' . $this->id,
            'episodios' => '/api/series/' . $this->id . '/episodios'
        ];
    }


}