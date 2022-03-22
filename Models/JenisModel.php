<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisModel extends Model
{
    use HasFactory;
    protected $table = 'jenis';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
