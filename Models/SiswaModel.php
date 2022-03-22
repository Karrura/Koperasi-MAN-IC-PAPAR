<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaModel extends Model
{
    use HasFactory;
    protected $table = 'siswa';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function cekLog($nisn, $password)
    {
        // dd($nisn, $password);
        $data = \DB::table('siswa')->where('nisn', $nisn)->first();
    	// dd($data->nisn);
    	if($data){
            if($password == $data->nisn){
                return $data;
            }else{
                return false;
            }
    	}else{
    		return false;
    	}
 	}

}
