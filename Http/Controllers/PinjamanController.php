<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\Models\PinjamanModel as Pinjaman;

class PinjamanController extends Controller
{
    public function index()
    {
		if (session()->get('role')=='Anggota') {
			$data = \DB::table('pinjaman as p')
			->join('user', 'user.id', '=', 'p.id_user')
			->select('user.nama as nama_anggota', 'p.tgl_pinjam', 'p.nominal', 'p.id_user', 'p.id', 'p.keterangan', 'p.tgl_lunas', 'p.status', 'user.nohp')
			->where('p.kode_hapus', 0)
			->where('id_user', session()->get('id'))->get();
		} else {
			$data = \DB::table('pinjaman as p')
			->join('user', 'user.id', '=', 'p.id_user')
			->select('user.nama as nama_anggota', 'p.tgl_pinjam', 'p.nominal', 'p.id_user', 'p.id', 'p.keterangan', 'p.tgl_lunas', 'p.status', 'user.nohp')
			->where('p.kode_hapus', 0)->get();
		}

    	return view('pinjaman/pinjaman', compact('data'));
    }

	public function laporan()
	{
		if (session()->get('role')=='Anggota') {
			$data = \DB::table('pinjaman as p')
			->join('user', 'user.id', '=', 'p.id_user')
			->select('user.nama as nama_anggota', 'p.tgl_pinjam', 'p.nominal', 'p.id_user', 'p.id', 'p.keterangan', 'p.tgl_lunas', 'p.status', 'user.nohp')
			->where('p.kode_hapus', 0)
			->where('id_user', session()->get('id'))->get();
		} else {
			$data = \DB::table('pinjaman as p')
			->join('user', 'user.id', '=', 'p.id_user')
			->select('user.nama as nama_anggota', 'p.tgl_pinjam', 'p.nominal', 'p.id_user', 'p.id', 'p.keterangan', 'p.tgl_lunas', 'p.status', 'user.nohp')
			->where('p.kode_hapus', 0)->get();
		}
		$bulan = 13;
		return view('pinjaman/laporan', compact('data', 'bulan'));
	}

	public function laporanSearch(Request $request)
	{
		if (session()->get('role')=='Anggota') {
			$data = \DB::table('pinjaman as p')
			->join('user', 'user.id', '=', 'p.id_user')
			->select('user.nama as nama_anggota', 'p.tgl_pinjam', 'p.nominal', 'p.id_user', 'p.id', 'p.keterangan', 'p.tgl_lunas', 'p.status', 'user.nohp')
			->where('p.kode_hapus', 0)
			->where('id_user', session()->get('id'))->get();
		} else {
			$data = \DB::table('pinjaman as p')
			->join('user', 'user.id', '=', 'p.id_user')
			->select('user.nama as nama_anggota', 'p.tgl_pinjam', 'p.nominal', 'p.id_user', 'p.id', 'p.keterangan', 'p.tgl_lunas', 'p.status', 'user.nohp')
			->where('p.kode_hapus', 0)
			->whereMonth('p.tgl_pinjam', $request->bulan)->get();
		}
		$bulan = $request->bulan;
		return view('pinjaman/laporan', compact('data', 'bulan'));
	}

	public function detailpdf($bulan)
	{
		if (session()->get('role')=='Anggota') {
			$data = \DB::table('pinjaman as p')
			->join('user', 'user.id', '=', 'p.id_user')
			->select('user.nama as nama_anggota', 'p.tgl_pinjam', 'p.nominal', 'p.id_user', 'p.id', 'p.keterangan', 'p.tgl_lunas', 'p.status', 'user.nohp')
			->where('p.kode_hapus', 0)
			->where('id_user', session()->get('id'))->get();
		} else {
			if($bulan < 13){
				$data = \DB::table('pinjaman as p')
				->join('user', 'user.id', '=', 'p.id_user')
				->select('user.nama as nama_anggota', 'p.tgl_pinjam', 'p.nominal', 'p.id_user', 'p.id', 'p.keterangan', 'p.tgl_lunas', 'p.status', 'user.nohp')
				->where('p.kode_hapus', 0)
				->whereMonth('p.tgl_pinjam', $bulan)->get();
			}else{
				$data = \DB::table('pinjaman as p')
				->join('user', 'user.id', '=', 'p.id_user')
				->select('user.nama as nama_anggota', 'p.tgl_pinjam', 'p.nominal', 'p.id_user', 'p.id', 'p.keterangan', 'p.tgl_lunas', 'p.status', 'user.nohp')
				->where('p.kode_hapus', 0)->get();
			}
			
		}
		return view('pinjaman/detailpdf', compact('data'));
	}



    public function store(Request $request)
    {
    	// dd($request);
    	$store = Pinjaman::create([
    			'id_user'		=> $request->id_user,
			    'tgl_pinjam'	=> $request->tgl_pinjam,
			    'nominal'		=> $request->nominal,
			    'keterangan'	=> $request->keterangan,
    	]);
    	$store->save();

    	if($store){
    		return redirect('pinjaman-data')->with('success', 'Berhasil menambahkan data pinjaman');
    	}else{
    		return redirect('pinjaman-data')->with('error', 'Gagal menambahkan data pinjaman');
    	}
    }

    public function destroy($id)
    {
    	$data = \DB::table('pinjaman')->where('id', $id)->first();
    	$destroy = \DB::table('pinjaman')->where('id', $id)->update(['kode_hapus' => 1]);

    	if($destroy){
    		return redirect('pinjaman-data')->with('success', 'Berhasil menghapus data pinjaman');
    	}else{
    		return redirect('pinjaman-data')->with('error', 'Gagal menambahkan data pinjaman');
    	}
    }

    public function update(Request $request, $id)
    {
    	// dd($request);
    	$update = Pinjaman::where('id', $id)->update([
				    'id_user'		=> $request->id_user,
				    'tgl_pinjam'	=> $request->tgl_pinjam,
				    'nominal'		=> $request->nominal,
				    'keterangan'	=> $request->keterangan,
					]);

    	if($update){
    		return redirect('pinjaman-data')->with('success', 'Berhasil mengubah data pinjaman');
    	}else{
    		return redirect('pinjaman-data')->with('error', 'Gagal mengubah data pinjaman');
    	}
    }
}
