<?php

namespace App\Models;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'userId';
    public $incrementing = false;
    protected $keyType = 'string';
    public function employee(){
        return $this->belongsTo(Employee::class, 'employeeId');
    }
}
