<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'ticketId';
    public $incrementing = false;
    protected $keyType = 'string';

    public function client() {
        return $this->belongsTo(User::class, 'clientId', 'userId');
    }

    public function technician() {
        return $this->belongsTo(User::class, 'techId', 'userId');
    }
}