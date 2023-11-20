<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'categoryId';
    public $incrementing = false;
    protected $keyType = 'string';

    public function techSkill(){
        return $this->hasMany(TechSkill::class, 'skillTechId', 'skillTechId');
    }

    public function ticket(){
        return $this->hasMany(Ticket::class, 'ticketId', 'ticketId');
    }
}
