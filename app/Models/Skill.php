<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'skillId';
    public $incrementing = false;
    protected $keyType = 'string';

    public function TechSkill() {
        return $this->hasOne(TechSkill::class, 'skillTechId', 'skillTechId');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'categoryId', 'categoryId');
    }
}
