<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimpananModel extends Model
{
    use HasFactory;
    protected $table = 'simpanan';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
