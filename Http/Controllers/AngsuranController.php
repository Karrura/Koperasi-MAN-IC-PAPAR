<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\Models\AngsuranModel as Angsuran;

class AngsuranController extends Controller
{
    public function index()
    {
    	
		if (session()->get('role')=='Anggota') {
			$data = \DB::table('pinjaman as p')
    			->join('user', 'user.id', '=', 'p.id_user')
    			->select('user.nama as nama_anggota', 'p.nominal', 'p.status', 'p.id', 'p.id_user')
    			->where('p.kode_hapus', 0)
    			->where('id_user', session()->get('id'))->get();
    	// dd($data);
		} else {
			$data = \DB::table('pinjaman as p')
    			->join('user', 'user.id', '=', 'p.id_user')
    			->select('user.nama as nama_anggota', 'p.nominal', 'p.status', 'p.id', 'p.id_user')
    			->where('p.kode_hapus', 0)->get();
    	// dd($data);
		}
		

    	return view('angsuran/angsuran', compact('data'));
    }

    public function laporan()
    {
		if (session()->get('role')=='Anggota') {
			$data = \DB::table('pinjaman as p')
    			->join('user', 'user.id', '=', 'p.id_user')
    			->select('user.nama as nama_anggota', 'p.nominal', 'p.status', 'p.id', 'p.id_user')
    			->where('p.kode_hapus', 0)
    			->where('id_user', session()->get('id'))->get();
    	// dd($data);
		} else {
			$data = \DB::table('pinjaman as p')
    			->join('user', 'user.id', '=', 'p.id_user')
    			->select('user.nama as nama_anggota', 'p.nominal', 'p.status', 'p.id', 'p.id_user')
    			->where('p.kode_hapus', 0)->get();
    	// dd($data);
		}

    	return view('angsuran/laporan', compact('data'));
    }



    public function detail($id)
    {
		if (session()->get('role')=='Anggota') {
			$data = \DB::table('angsuran')
    			// ->join('user', 'user.id', '=', 'angsuran.id_user')
    			->where('id_pinjam', $id)
    			->where('id_user', session()->get('id'))
    			->where('angsuran.kode_hapus', 0)
    			->get();
		} else {
			$data = \DB::table('angsuran')
    			// ->join('user', 'user.id', '=', 'angsuran.id_user')
    			->where('id_pinjam', $id)
    			->where('angsuran.kode_hapus', 0)
    			->get();
		}
		
    	$pinjaman = \DB::table('pinjaman')->where('id', $id)->first();
    	$id_pinjam = $id;

    	// dd($data, $id_pinjam, $pinjaman);
    	return view('angsuran/detail', compact('data', 'pinjaman', 'id_pinjam'));
    }

	public function detailind($id)
    {
		if (session()->get('role')=='Anggota') {
			$data = \DB::table('angsuran')
    			// ->join('user', 'user.id', '=', 'angsuran.id_user')
    			->where('id_pinjam', $id)
    			->where('id_user', session()->get('id'))
    			->where('angsuran.kode_hapus', 0)
    			->get();
		} else {
			$data = \DB::table('angsuran')
    			// ->join('user', 'user.id', '=', 'angsuran.id_user')
    			->where('id_pinjam', $id)
    			->where('angsuran.kode_hapus', 0)
    			->get();
		}
    	$pinjaman = \DB::table('pinjaman')->where('id', $id)->first();
    	$id_pinjam = $id;

    	// dd($data, $id_pinjam, $pinjaman);
    	return view('angsuran/detailind', compact('data', 'pinjaman', 'id_pinjam'));
    }

    public function detailPdf($id)
    {
    	if (session()->get('role')=='Anggota') {
			$data = \DB::table('angsuran')
    			// ->join('user', 'user.id', '=', 'angsuran.id_user')
    			->where('id_pinjam', $id)
    			->where('id_user', session()->get('id'))
    			->where('angsuran.kode_hapus', 0)
    			->get();
		} else {
			$data = \DB::table('angsuran')
    			// ->join('user', 'user.id', '=', 'angsuran.id_user')
    			->where('id_pinjam', $id)
    			->where('angsuran.kode_hapus', 0)
    			->get();
		}	
    	$pinjaman = \DB::table('pinjaman')->where('id', $id)->first();
    	$id_pinjam = $id;

    	// dd($data, $id_pinjam, $pinjaman);
    	return view('angsuran/detailPdf', compact('data', 'pinjaman', 'id_pinjam'));
    }

    public function store(Request $request)
    {
    	// dd($request);
    	$namafile = null;
    	if($request->file('bukti_bayar')){
    		$pict = $request->bukti_bayar;
            $namafile = time().rand(100, 99).".".$pict->getClientOriginalName();
            $request->bukti_bayar->move(public_path('image/angsuran'), $namafile);
    	}
    	$store = Angsuran::create([
    			'id_user'		=> $request->id_user,
			    'id_pinjam'		=> $request->id_pinjam,
			    'tgl_bayar'		=> $request->tgl_bayar,
			    'periode_bayar'	=> $request->periode_bayar,
			    'nominal'		=> $request->nominal,
			    'keterangan'	=> $request->keterangan,
			    'bukti_bayar'	=> $namafile,
    	]);
    	$store->save();

    	$angsur = \DB::table('angsuran')->where('kode_hapus', 0)->where('id_pinjam', $request->id_pinjam)->get();

    	$pinjam = \DB::table('pinjaman')->where('kode_hapus', 0)->where('id', $request->id_pinjam)->first();

    	$nominal_pinjam = $pinjam->nominal;

    	$nominal_angsur = 0;

    	foreach ($angsur as $key => $v) {
    		$nominal_angsur += $v->nominal;
    	}

    	if($nominal_angsur >= $nominal_pinjam){
    		$ubahStatus = \DB::table('pinjaman')->where('id', $request->id_pinjam)
    						->update([
    							'status' 	=> 'Lunas',
    							'tgl_lunas'	=> \carbon\Carbon::now()
    						]);
    	}else{
    		$ubahStatus = \DB::table('pinjaman')->where('id', $request->id_pinjam)
    						->update([
    							'status' 	=> 'Belum Lunas',
    							'tgl_lunas'	=> null,
    						]);
    	}

    	if($store){
    		return redirect('angsuran-detail/'. $request->id_pinjam)->with('success', 'Berhasil menambahkan data angsuran');
    	}else{
    		return redirect('angsuran-detail/'. $request->id_pinjam)->with('error', 'Gagal menambahkan data angsuran');
    	}
    }

    public function destroy($id)
    {
    	$data = \DB::table('angsuran')->where('id', $id)->first();
    	$id_pinjam = $data->id_pinjam;
    	$destroy = \DB::table('angsuran')->where('id', $id)->update(['kode_hapus' => 1]);

    	$angsur = \DB::table('angsuran')->where('kode_hapus', 0)->where('id_pinjam', $id_pinjam)->get();

    	$pinjam = \DB::table('pinjaman')->where('kode_hapus', 0)->where('id', $id_pinjam)->first();

    	$nominal_pinjam = $pinjam->nominal;

    	$nominal_angsur = 0;

    	foreach ($angsur as $key => $v) {
    		$nominal_angsur += $v->nominal;
    	}

    	if($nominal_angsur >= $nominal_pinjam){
    		$ubahStatus = \DB::table('pinjaman')->where('id', $id_pinjam)
    						->update([
    							'status' 	=> 'Lunas',
    							'tgl_lunas'	=> \carbon\Carbon::now(),
    						]);
    	}else{
    		$ubahStatus = \DB::table('pinjaman')->where('id', $id_pinjam)
    						->update([
    							'status' 	=> 'Belum Lunas',
    							'tgl_lunas'	=> null,
    						]);
    	}

    	if($destroy){
    		return redirect('angsuran-detail/'.$id_pinjam)->with('success', 'Berhasil menghapus data angsuran');
    	}else{
    		return redirect('angsuran-detail/'.$id_pinjam)->with('error', 'Gagal menambahkan data angsuran');
    	}
    }

    public function update(Request $request, $id)
    {
    	// dd($request);
    	$update = Angsuran::where('id', $id)->update([
				    'id_user'		=> $request->id_user,
				    'id_pinjam'		=> $request->id_pinjam,
				    'tgl_bayar'		=> $request->tgl_bayar,
				    'periode_bayar'	=> $request->periode_bayar,
				    'nominal'		=> $request->nominal,
				    'keterangan'	=> $request->keterangan,
					]);

    	$namafile = null;
    	if($request->file('bukti_bayar')){
    		$pict = $request->bukti_bayar;
            $namafile = time().rand(100, 99).".".$pict->getClientOriginalName();
            $request->bukti_bayar->move(public_path('image/angsuran'), $namafile);
            $ubahFoto = \DB::table('angsuran')->where('id', $id)->update(['bukti_bayar' => $namafile]);
    	}

    	$angsur = \DB::table('angsuran')->where('kode_hapus', 0)->where('id_pinjam', $request->id_pinjam)->get();

    	$pinjam = \DB::table('pinjaman')->where('kode_hapus', 0)->where('id', $request->id_pinjam)->first();

    	$nominal_pinjam = $pinjam->nominal;

    	$nominal_angsur = 0;

    	foreach ($angsur as $key => $v) {
    		$nominal_angsur += $v->nominal;
    	}

    	if($nominal_angsur >= $nominal_pinjam){
    		$ubahStatus = \DB::table('pinjaman')->where('id', $request->id_pinjam)
    						->update([
    							'status' 	=> 'Lunas',
    							'tgl_lunas'	=> \carbon\Carbon::now()
    						]);
    	}else{
    		$ubahStatus = \DB::table('pinjaman')->where('id', $request->id_pinjam)
    						->update([
    							'status' 	=> 'Belum Lunas',
    							'tgl_lunas'	=> null,
    						]);
    	}

    	if($update){
    		return redirect('angsuran-detail/'. $request->id_pinjam)->with('success', 'Berhasil mengubah data angsuran');
    	}else{
    		return redirect('angsuran-detail/'. $request->id_pinjam)->with('error', 'Gagal mengubah data angsuran');
    	}
    }
}
