<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageDetail extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'messageDetailId';
    public $incrementing = false;
    protected $keyType = 'string';
}
