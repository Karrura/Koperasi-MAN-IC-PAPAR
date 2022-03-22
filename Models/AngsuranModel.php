<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AngsuranModel extends Model
{
    use HasFactory;
    protected $table = 'angsuran';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
