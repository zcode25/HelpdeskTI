<?php

namespace App\Models;
use App\Models\Division;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'employeeId';
    public $incrementing = false;
    protected $keyType = 'string';
    public function division(){
        return $this->belongsTo(Division::class, 'divisionId');
    }
    public function user(){
        return $this->hasMany(User::class, 'userId', 'userId');
    }
}
