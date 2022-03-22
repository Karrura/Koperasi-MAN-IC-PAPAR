<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\Models\JenisModel as Jenis;

class JenisController extends Controller
{
    public function index()
    {
    	$data = \DB::table('jenis')->where('kode_hapus', 0)->get();

    	return view('jenis/jenis', compact('data'));
    }

    public function store(Request $request)
    {
    	// dd($request);
    	$store = Jenis::create([
    			'jenis'			=> $request->jenis,
    			'keterangan'	=> $request->keterangan,
    	]);
    	$store->save();

    	if($store){
    		return redirect('jenis-data')->with('success', 'Berhasil menambahkan data '.$request->jenis);
    	}else{
    		return redirect('jenis-data')->with('error', 'Gagal menambahkan data '.$request->jenis);
    	}
    }

    public function destroy($id)
    {
    	$data = \DB::table('jenis')->where('id', $id)->first();
    	$jenis = $data->jenis;
    	$destroy = \DB::table('jenis')->where('id', $id)->update(['kode_hapus' => 1]);

    	if($destroy){
    		return redirect('jenis-data')->with('success', 'Berhasil menghapus data '.$jenis);
    	}else{
    		return redirect('jenis-data')->with('error', 'Gagal menambahkan data '.$jenis);
    	}
    }

    public function update(Request $request, $id)
    {
    	$update = Jenis::where('id', $id)->update([
				    'jenis'			=> $request->jenis,
				    'keterangan'	=> $request->keterangan,
				]);

    	if($update){
    		return redirect('jenis-data')->with('success', 'Berhasil mengubah data '.$request->jenis);
    	}else{
    		return redirect('jenis-data')->with('error', 'Gagal mengubah data '.$request->jenis);
    	}
    }
}
