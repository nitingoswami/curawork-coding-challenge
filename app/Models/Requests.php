<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_id',
        'to_id',
        'status',
    ];

    public function sentUser(){
        return $this->hasOne(User::class, 'id', 'to_id');
    }

    public function recivedUser(){
        return $this->hasOne(User::class, 'id', 'from_id');
    }
}

