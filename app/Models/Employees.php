<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;
    // Menentukan atribut mana yang dapat diisi secara massal ke model
    protected $fillable = ['nama', 'gender', 'phone', 'address', 'email', 'status', 'hired_on'];
}
