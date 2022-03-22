<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Hash;

class UserModel extends Model
{
    use HasFactory; 
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function cekLog($username, $password)
    {
        // dd($username, $password);
        $data = DB::table('user')->where('username', $username)->first();
    	// dd($data);
    	if($data){
    		$gainAccess = Hash::check($password, $data->password);
    		if($gainAccess == TRUE){
    			return $data;
    		}else{
    			return false;
    		}
    	}else{
    		return false;
    	}
 	}
}
