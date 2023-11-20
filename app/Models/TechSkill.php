<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechSkill extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'skillTechId';
    public $incrementing = false;
    protected $keyType = 'string';

    public function category(){
        return $this->belongsTo(Category::class, 'categoryId', 'categoryId');
    }

    public function user() {
        return $this->belongsTo(User::class, 'userId', 'userId');
    }
}
