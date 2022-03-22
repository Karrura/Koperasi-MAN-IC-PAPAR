<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\Models\SimpananModel as Simpanan;

class SimpananController extends Controller
{
    public function index()
    {
		
    	$data = \DB::table('simpanan as s')
    			->join('jenis', 'jenis.id', '=', 's.id_jenis')
    			->join('user', 'user.id', '=', 's.id_user')
    			->select('user.nama as nama_anggota', 'jenis.jenis as nama_jenis', 's.tgl_simpan', 's.nominal', 's.keterangan', 's.bukti_bayar', 's.id_user', 's.id_jenis', 's.id', 'user.nohp')
    			->where('s.kode_hapus', 0)->get();
    	// dd($data);

    	return view('simpanan/simpanan', compact('data'));
    }

	public function laporan()
    {
		if (session()->get('role')=='Anggota') {
			$data = \DB::table('simpanan as s')
			->join('jenis', 'jenis.id', '=', 's.id_jenis')
			->join('user', 'user.id', '=', 's.id_user')
			->select('user.nama as nama_anggota', 'jenis.jenis as nama_jenis', 's.tgl_simpan', 's.nominal', 's.keterangan', 's.bukti_bayar', 's.id_user', 's.id_jenis', 's.id', 'user.nohp')
			->where('s.kode_hapus', 0)
			->where('id_user', session()->get('id'))->get();
		} else { 
			$data = \DB::table('simpanan as s')
    			->join('jenis', 'jenis.id', '=', 's.id_jenis')
    			->join('user', 'user.id', '=', 's.id_user')
    			->select('user.nama as nama_anggota', 'jenis.jenis as nama_jenis', 's.tgl_simpan', 's.nominal', 's.keterangan', 's.bukti_bayar', 's.id_user', 's.id_jenis', 's.id', 'user.nohp')
    			->where('s.kode_hapus', 0)->get();
    	// dd($data);

		}
        $bulan = 13;
    	return view('simpanan/laporan', compact('data', 'bulan'));
    }

    public function laporanSearch(Request $request)
    {
        // dd($request->bulan);
        if (session()->get('role')=='Anggota') {
            $data = \DB::table('simpanan as s')
            ->join('jenis', 'jenis.id', '=', 's.id_jenis')
            ->join('user', 'user.id', '=', 's.id_user')
            ->select('user.nama as nama_anggota', 'jenis.jenis as nama_jenis', 's.tgl_simpan', 's.nominal', 's.keterangan', 's.bukti_bayar', 's.id_user', 's.id_jenis', 's.id', 'user.nohp')
            ->where('s.kode_hapus', 0)
            ->where('id_user', session()->get('id'))->get();
        } else { 
            $data = \DB::table('simpanan as s')
                ->join('jenis', 'jenis.id', '=', 's.id_jenis')
                ->join('user', 'user.id', '=', 's.id_user')
                ->select('user.nama as nama_anggota', 'jenis.jenis as nama_jenis', 's.tgl_simpan', 's.nominal', 's.keterangan', 's.bukti_bayar', 's.id_user', 's.id_jenis', 's.id', 'user.nohp')
                ->where('s.kode_hapus', 0)
                ->whereMonth('s.tgl_simpan', $request->bulan)
                ->get();
        }
        // dd($data);
        $bulan = $request->bulan;
        return view('simpanan/laporan', compact('data', 'bulan'));
    }

	public function detailPdf($bulan)
    {
		if (session()->get('role')=='Anggota') {
			$data = \DB::table('simpanan as s')
			->join('jenis', 'jenis.id', '=', 's.id_jenis')
			->join('user', 'user.id', '=', 's.id_user')
			->select('user.nama as nama_anggota', 'jenis.jenis as nama_jenis', 's.tgl_simpan', 's.nominal', 's.keterangan', 's.bukti_bayar', 's.id_user', 's.id_jenis', 's.id', 'user.nohp')
			->where('s.kode_hapus', 0)
			->where('id_user', session()->get('id'))->get();
		} else {
            if($bulan < 13){
                $data = \DB::table('simpanan as s')
                ->join('jenis', 'jenis.id', '=', 's.id_jenis')
                ->join('user', 'user.id', '=', 's.id_user')
                ->select('user.nama as nama_anggota', 'jenis.jenis as nama_jenis', 's.tgl_simpan', 's.nominal', 's.keterangan', 's.bukti_bayar', 's.id_user', 's.id_jenis', 's.id', 'user.nohp')
                ->whereMonth('tgl_simpan', $bulan)
                ->where('s.kode_hapus', 0)->get();
            }else{
                $data = \DB::table('simpanan as s')
                ->join('jenis', 'jenis.id', '=', 's.id_jenis')
                ->join('user', 'user.id', '=', 's.id_user')
                ->select('user.nama as nama_anggota', 'jenis.jenis as nama_jenis', 's.tgl_simpan', 's.nominal', 's.keterangan', 's.bukti_bayar', 's.id_user', 's.id_jenis', 's.id', 'user.nohp')
                ->where('s.kode_hapus', 0)->get();
            }
    	// dd($data);

		}

    	return view('simpanan/detailpdf', compact('data'));
    }

    public function store(Request $request)
    {
    	// dd($request);
    	$namafile = null;
    	if($request->file('bukti_bayar')){
    		$pict = $request->bukti_bayar;
            $namafile = time().rand(100, 99).".".$pict->getClientOriginalName();
            $request->bukti_bayar->move(public_path('image/simpanan'), $namafile);
    	}
    	$store = Simpanan::create([
    			'id_user'		=> $request->id_user,
			    'id_jenis'		=> $request->id_jenis,
			    'tgl_simpan'	=> $request->tgl_simpan,
			    'nominal'		=> $request->nominal,
			    'keterangan'	=> $request->keterangan,
			    'bukti_bayar'	=> $namafile,
    	]);
    	$store->save();

    	if($store){
    		return redirect('simpanan-data')->with('success', 'Berhasil menambahkan data simpanan');
    	}else{
    		return redirect('simpanan-data')->with('error', 'Gagal menambahkan data simpanan');
    	}
    }

    public function destroy($id)
    {
    	$data = \DB::table('simpanan')->where('id', $id)->first();
    	$destroy = \DB::table('simpanan')->where('id', $id)->update(['kode_hapus' => 1]);

    	if($destroy){
    		return redirect('simpanan-data')->with('success', 'Berhasil menghapus data simpanan');
    	}else{
    		return redirect('simpanan-data')->with('error', 'Gagal menambahkan data simpanan');
    	}
    }

    public function update(Request $request, $id)
    {
    	// dd($request);
    	$update = Simpanan::where('id', $id)->update([
				    'id_user'		=> $request->id_user,
				    'id_jenis'		=> $request->id_jenis,
				    'tgl_simpan'	=> $request->tgl_simpan,
				    'nominal'		=> $request->nominal,
				    'keterangan'	=> $request->keterangan,
					]);

    	$namafile = null;
    	if($request->file('bukti_bayar')){
    		$pict = $request->bukti_bayar;
            $namafile = time().rand(100, 99).".".$pict->getClientOriginalName();
            $request->bukti_bayar->move(public_path('image/simpanan'), $namafile);
            $ubahFoto = \DB::table('simpanan')->where('id', $id)->update(['bukti_bayar' => $namafile]);
    	}

    	if($update){
    		return redirect('simpanan-data')->with('success', 'Berhasil mengubah data simpanan');
    	}else{
    		return redirect('simpanan-data')->with('error', 'Gagal mengubah data simpanan');
    	}
    }
}
