<?php

namespace App\Models;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'divisionId';
    public $incrementing = false;
    protected $keyType = 'string';
    
    public function employee(){
        return $this->hasMany(Employee::class, 'divisionId', 'divisionId');
    }
}
