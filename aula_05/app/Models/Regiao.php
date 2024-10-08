<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Regiao extends Model
{
    use HasFactory, HasRelationships;

    protected $table = 'regioes'; //personalizacao do nome da tabela
    protected $fillable = ['nome'];

    public function estados(){
        return $this->hasMany(Estado::class);
    }

    public function fornecedores(){
        return $this->hasManyThrough(
            Fornecedor::class,
            Estado::class
        );
    }

    public function produtos(){
        return $this->hasManyDeep(
            Produto::class,
            [Estado::class,Fornecedor::class]
        );
    }
}
