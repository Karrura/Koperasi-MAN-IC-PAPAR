<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\Models\GolonganModel as Golongan;

class GolonganController extends Controller
{
    public function index()
    {
    	$data = \DB::table('golongan')->where('kode_hapus', 0)->get();

    	return view('golongan/golongan', compact('data'));
    }

    public function store(Request $request)
    {
    	// dd($request);
    	$store = Golongan::create([
    			'golongan'		=> $request->golongan,
    			'uang_makan'	=> $request->uang_makan,
    	]);
    	$store->save();

    	if($store){
    		return redirect('golongan-data')->with('success', 'Berhasil menambahkan data '.$request->golongan);
    	}else{
    		return redirect('golongan-data')->with('error', 'Gagal menambahkan data '.$request->golongan);
    	}
    }

    public function destroy($id)
    {
    	$data = \DB::table('golongan')->where('id', $id)->first();
    	$golongan = $data->golongan;
    	$destroy = \DB::table('golongan')->where('id', $id)->update(['kode_hapus' => 1]);

    	if($destroy){
    		return redirect('golongan-data')->with('success', 'Berhasil menghapus data '.$golongan);
    	}else{
    		return redirect('golongan-data')->with('error', 'Gagal menambahkan data '.$golongan);
    	}
    }

    public function update(Request $request, $id)
    {
    	$update = Golongan::where('id', $id)->update([
				    'golongan'		=> $request->golongan,
				    'uang_makan'	=> $request->uang_makan,
				]);

    	if($update){
    		return redirect('golongan-data')->with('success', 'Berhasil mengubah data '.$request->golongan);
    	}else{
    		return redirect('golongan-data')->with('error', 'Gagal mengubah data '.$request->golongan);
    	}
    }
}
