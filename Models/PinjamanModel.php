<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PinjamanModel extends Model
{
    use HasFactory;
    protected $table = 'pinjaman';
    protected $primaryKey = 'id';
    protected $guarded = [];

}
