<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\Models\SiswaModel as Siswa;

class SiswaController extends Controller
{
    public function index()
    {
    	$data = \DB::table('siswa as s')
    			->join('golongan', 'golongan.id', '=', 's.id_golongan')
    			->select('s.id', 's.nisn', 's.id_golongan', 's.nama', 's.gender', 's.alamat', 's.nama_ortu', 's.nohp_ortu', 'golongan.id as id_golongan', 'golongan.golongan')
    			->where('s.kode_hapus', 0)->get();
    	// dd($data);

    	return view('siswa/siswa', compact('data'));
    }

    public function store(Request $request)
    {
    	// dd($request);
    	$store = Siswa::create([
    			'nisn'			=> $request->nisn,
			    'id_golongan'	=> $request->id_golongan,
			    'nama'			=> $request->nama,
			    'gender'		=> $request->gender,
			    'alamat'		=> $request->alamat,
			    'nama_ortu'		=> $request->nama_ortu,
			    'nohp_ortu'		=> $request->nohp_ortu,
    	]);
    	$store->save();

    	if($store){
    		return redirect('siswa-data')->with('success', 'Berhasil menambahkan data '.$request->nama);
    	}else{
    		return redirect('siswa-data')->with('error', 'Gagal menambahkan data '.$request->nama);
    	}
    }

    public function destroy($id)
    {
    	$data = \DB::table('siswa')->where('id', $id)->first();
    	$siswa = $data->nama;
    	$destroy = \DB::table('siswa')->where('id', $id)->update(['kode_hapus' => 1]);

    	if($destroy){
    		return redirect('siswa-data')->with('success', 'Berhasil menghapus data '.$siswa);
    	}else{
    		return redirect('siswa-data')->with('error', 'Gagal menambahkan data '.$siswa);
    	}
    }

    public function update(Request $request, $id)
    {
    	// dd($request);
    	$update = Siswa::where('id', $id)->update([
				    'nisn'			=> $request->nisn,
				    'id_golongan'	=> $request->id_golongan,
				    'nama'			=> $request->nama,
				    'gender'		=> $request->gender,
				    'alamat'		=> $request->alamat,
				    'nama_ortu'		=> $request->nama_ortu,
				    'nohp_ortu'		=> $request->nohp_ortu,
				]);
    	if($update){
    		return redirect('siswa-data')->with('success', 'Berhasil mengubah data '.$request->nama);
    	}else{
    		return redirect('siswa-data')->with('error', 'Gagal mengubah data '.$request->nama);
    	}
    }
}
