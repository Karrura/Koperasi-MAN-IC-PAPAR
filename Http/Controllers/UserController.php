<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\Models\UserModel as User;

class UserController extends Controller
{
    public function index()
    {
    	$data = \DB::table('user')->where('kode_hapus', 0)->get();

    	return view('user/user', compact('data'));
    }

    public function store(Request $request)
    {
    	// dd($request);
    	$namafile = null;
    	if($request->file('foto')){
    		$pict = $request->foto;
            $namafile = time().rand(100, 99).".".$pict->getClientOriginalName();
            $request->foto->move(public_path('image/foto'), $namafile);
    	}
    	$store = User::create([
    			'username'		=> $request->username,
			    'password'		=> \Hash::make($request->password),
			    'role'			=> $request->status,
			    'nama'			=> $request->nama,
			    'tempat_lahir'	=> $request->tempat_lahir,
			    'tgl_lahir'		=> $request->tgl_lahir,
			    'alamat'		=> $request->alamat,
			    'nohp'			=> $request->nohp,
			    'pekerjaan'		=> $request->pekerjaan,
			    'foto'			=> $namafile,
    	]);
    	$store->save();

    	if($store){
    		return redirect('user-data')->with('success', 'Berhasil menambahkan data '.$request->nama);
    	}else{
    		return redirect('user-data')->with('error', 'Gagal menambahkan data '.$request->nama);
    	}
    }

    public function destroy($id)
    {
    	$data = \DB::table('user')->where('id', $id)->first();
    	$nama = $data->nama;
    	$destroy = \DB::table('user')->where('id', $id)->update(['kode_hapus' => 1]);

    	if($destroy){
    		return redirect('user-data')->with('success', 'Berhasil menghapus data '.$nama);
    	}else{
    		return redirect('user-data')->with('error', 'Gagal menambahkan data '.$nama);
    	}
    }

    public function update(Request $request, $id)
    {
    	// dd($request);
    	$update = User::where('id', $id)->update([
				    'username'		=> $request->username,
				    'role'			=> $request->status,
				    'nama'			=> $request->nama,
				    'tempat_lahir'	=> $request->tempat_lahir,
				    'tgl_lahir'		=> $request->tgl_lahir,
				    'alamat'		=> $request->alamat,
				    'nohp'			=> $request->nohp,
				    'pekerjaan'		=> $request->pekerjaan,
				]);

    	$namafile = null;
    	if($request->file('foto')){
    		$pict = $request->foto;
            $namafile = time().rand(100, 99).".".$pict->getClientOriginalName();
            $request->foto->move(public_path('image/foto'), $namafile);
            $ubahFoto = \DB::table('user')->where('id', $id)->update(['foto' => $namafile]);
    	}
    	if($request->password){
    		$ubahFoto = \DB::table('user')->where('id', $id)->update(['password' => \Hash::make($request->password)]);
    	}

    	if($update){
    		return redirect('user-data')->with('success', 'Berhasil mengubah data '.$request->nama);
    	}else{
    		return redirect('user-data')->with('error', 'Gagal mengubah data '.$request->nama);
    	}
    }
}
