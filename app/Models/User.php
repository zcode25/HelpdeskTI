<?php

namespace App\Models;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; 

class User extends Authenticatable
{
    use HasFactory;
    protected $guarded = [];
    // protected $fillable = [
    //     'employeeId',
    //     'role',
    //     'password',
    // ];

    protected $primaryKey = 'userId';
    public $incrementing = false;
    protected $keyType = 'string';

    public function employee(){
        return $this->belongsTo(Employee::class, 'employeeId');
    }

    public function ticket() {
        return $this->hasMany(Ticket::class);
    }
}
