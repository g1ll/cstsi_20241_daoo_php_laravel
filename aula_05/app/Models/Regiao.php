<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regiao extends Model
{
    use HasFactory;
    protected $table = 'regioes'; //personalizacao do nome da tabela
    protected $fillable = ['nome'];

    public function estados(){
        return $this->hasMany(Estado::class);
    }
}
