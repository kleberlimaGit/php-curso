<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class Anime extends Model
{
    use HasFactory;
    
    protected  $fillable = ['name'];
    
    
    public function seasons() {
        return $this->hasMany(Season::class);
    }
    
    protected static function booted() {
        self::addGlobalScope('sorted', function (Builder $queryBuilder){
            $queryBuilder->orderBy('name');
        } );
    }
    
}
