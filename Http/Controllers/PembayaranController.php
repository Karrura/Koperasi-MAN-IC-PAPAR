<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use App\Models\PembayaranModel as Pembayaran;

class PembayaranController extends Controller
{
    public function index()
    {
    	if(session()->get('role')=='Admin'){
            $data = \DB::table('pembayaran as p')
                ->join('siswa', 'siswa.id', '=', 'p.id_siswa')
                ->join('golongan', 'siswa.id_golongan', '=', 'golongan.id')
                ->select('p.id', 'siswa.nama', 'p.tgl_bayar', 'p.status', 'p.nominal', 'p.keterangan', 'p.bukti_bayar', 'p.id_siswa as id_siswa', 'siswa.nama_ortu', 'siswa.nohp_ortu')
                ->where('p.kode_hapus', 0)->where('siswa.kode_hapus', 0)
                ->get();
    	// dd($data);
            
            }else if(session()->get('role')=='Siswa'){
                $data = \DB::table('pembayaran as p')
                ->join('siswa', 'siswa.id', '=', 'p.id_siswa')
                ->join('golongan', 'siswa.id_golongan', '=', 'golongan.id')
                ->select('p.id', 'siswa.nama', 'p.tgl_bayar', 'p.status', 'p.nominal', 'p.keterangan', 'p.bukti_bayar', 'p.id_siswa as id_siswa', 'siswa.nama_ortu', 'siswa.nohp_ortu')
                ->where('p.kode_hapus', 0)
                ->where('siswa.id', session()->get('id'))->get();
            }
        $siswa = \DB::table('siswa')
                ->join('golongan', 'siswa.id_golongan', '=', 'golongan.id')
                ->select('siswa.nama', 'siswa.id', 'golongan.id', 'golongan.golongan', 'golongan.uang_makan')
                ->where('siswa.kode_hapus', 0)->get();

    	return view('pembayaran/pembayaran', compact('data', 'siswa'));
    }

    public function laporan()
    {
        if(session()->get('role')=='Admin'){
            $data = \DB::table('pembayaran as p')
                ->join('siswa', 'siswa.id', '=', 'p.id_siswa')
                ->join('golongan', 'siswa.id_golongan', '=', 'golongan.id')
                ->select('p.id', 'siswa.nama', 'p.tgl_bayar', 'p.status', 'p.nominal', 'p.keterangan', 'p.bukti_bayar', 'p.id_siswa as id_siswa', 'siswa.nama_ortu', 'siswa.nohp_ortu')
                ->where('p.kode_hapus', 0)->where('siswa.kode_hapus', 0)
                ->get();
        // dd($data);
            
            }else if(session()->get('role')=='Siswa'){
                $data = \DB::table('pembayaran as p')
                ->join('siswa', 'siswa.id', '=', 'p.id_siswa')
                ->join('golongan', 'siswa.id_golongan', '=', 'golongan.id')
                ->select('p.id', 'siswa.nama', 'p.tgl_bayar', 'p.status', 'p.nominal', 'p.keterangan', 'p.bukti_bayar', 'p.id_siswa as id_siswa', 'siswa.nama_ortu', 'siswa.nohp_ortu')
                ->where('p.kode_hapus', 0)
                ->where('siswa.id', session()->get('id'))->get();
            }
        $siswa = \DB::table('siswa')
                ->join('golongan', 'siswa.id_golongan', '=', 'golongan.id')
                ->select('siswa.nama', 'siswa.id', 'golongan.id', 'golongan.golongan', 'golongan.uang_makan')
                ->where('siswa.kode_hapus', 0)->get();
        $bulan = 13;
        return view('pembayaran/laporan', compact('data', 'siswa', 'bulan'));
    }

    public function laporanSearch(Request $request)
    {
        $bulan = $request->bulan;
        if(session()->get('role')=='Admin'){
            $data = \DB::table('pembayaran as p')
                ->join('siswa', 'siswa.id', '=', 'p.id_siswa')
                ->join('golongan', 'siswa.id_golongan', '=', 'golongan.id')
                ->select('p.id', 'siswa.nama', 'p.tgl_bayar', 'p.status', 'p.nominal', 'p.keterangan', 'p.bukti_bayar', 'p.id_siswa as id_siswa', 'siswa.nama_ortu', 'siswa.nohp_ortu')
                ->where('p.kode_hapus', 0)->where('siswa.kode_hapus', 0)
                ->whereMonth('tgl_bayar', $bulan)
                ->get();            
            }
        $siswa = \DB::table('siswa')
                ->join('golongan', 'siswa.id_golongan', '=', 'golongan.id')
                ->select('siswa.nama', 'siswa.id', 'golongan.id', 'golongan.golongan', 'golongan.uang_makan')
                ->where('siswa.kode_hapus', 0)->get();

        return view('pembayaran/laporan', compact('data', 'siswa', 'bulan'));
    }

    public function detailPdf($bulan)
    {
        if(session()->get('role')=='Admin'){
            if($bulan == 13){
                $data = \DB::table('pembayaran as p')
                ->join('siswa', 'siswa.id', '=', 'p.id_siswa')
                ->join('golongan', 'siswa.id_golongan', '=', 'golongan.id')
                ->select('p.id', 'siswa.nama', 'p.tgl_bayar', 'p.status', 'p.nominal', 'p.keterangan', 'p.bukti_bayar', 'p.id_siswa as id_siswa', 'siswa.nama_ortu', 'siswa.nohp_ortu')
                ->where('p.kode_hapus', 0)->where('siswa.kode_hapus', 0)
                ->get();
            }else{
                $data = \DB::table('pembayaran as p')
                ->join('siswa', 'siswa.id', '=', 'p.id_siswa')
                ->join('golongan', 'siswa.id_golongan', '=', 'golongan.id')
                ->select('p.id', 'siswa.nama', 'p.tgl_bayar', 'p.status', 'p.nominal', 'p.keterangan', 'p.bukti_bayar', 'p.id_siswa as id_siswa', 'siswa.nama_ortu', 'siswa.nohp_ortu')
                ->where('p.kode_hapus', 0)->where('siswa.kode_hapus', 0)
                ->whereMonth('tgl_bayar', $bulan)
                ->get();
            }
        }else if(session()->get('role')=='Siswa'){
            $data = \DB::table('pembayaran as p')
            ->join('siswa', 'siswa.id', '=', 'p.id_siswa')
            ->join('golongan', 'siswa.id_golongan', '=', 'golongan.id')
            ->select('p.id', 'siswa.nama', 'p.tgl_bayar', 'p.status', 'p.nominal', 'p.keterangan', 'p.bukti_bayar', 'p.id_siswa as id_siswa', 'siswa.nama_ortu', 'siswa.nohp_ortu')
            ->where('p.kode_hapus', 0)
            ->where('siswa.id', session()->get('id'))->get();
        }

        return view('pembayaran/detailPdf', compact('data'));
    }

    public function store(Request $request)
    {
    	// dd($request);
    	$namafile = null;
    	if($request->file('bukti_bayar')){
    		$pict = $request->bukti_bayar;
            $namafile = time().rand(100, 99).".".$pict->getClientOriginalName();
            $request->bukti_bayar->move(public_path('image/pembayaran'), $namafile);
    	}
    	$store = Pembayaran::create([
    			'id_siswa'		=> $request->id_siswa,
			    'tgl_bayar'		=> $request->tgl_bayar,
			    'nominal'		=> $request->nominal,
			    'keterangan'	=> $request->keterangan,
			    'bukti_bayar'	=> $namafile,
    	]);
    	$store->save();

    	if($store){
    		return redirect('pembayaran-data')->with('success', 'Berhasil menambahkan data pembayaran');
    	}else{
    		return redirect('pembayaran-data')->with('error', 'Gagal menambahkan data pembayaran');
    	}
    }

    public function destroy($id)
    {
    	$data = \DB::table('pembayaran')->where('id', $id)->first();
    	$destroy = \DB::table('pembayaran')->where('id', $id)->update(['kode_hapus' => 1]);

    	if($destroy){
    		return redirect('pembayaran-data')->with('success', 'Berhasil menghapus data pembayaran');
    	}else{
    		return redirect('pembayaran-data')->with('error', 'Gagal menambahkan data pembayaran');
    	}
    }

    public function update(Request $request, $id)
    {
    	// dd($request->id_siswa);
    	$update = Pembayaran::where('id', $id)->update([
				    'id_siswa'		=> $request->id_siswa,
				    'tgl_bayar'		=> $request->tgl_bayar,
				    'nominal'		=> $request->nominal,
				    'keterangan'	=> $request->keterangan,
					]);

    	$namafile = null;
    	if($request->file('bukti_bayar')){
    		$pict = $request->bukti_bayar;
            $namafile = time().rand(100, 99).".".$pict->getClientOriginalName();
            $request->bukti_bayar->move(public_path('image/pembayaran'), $namafile);
            $ubahFoto = \DB::table('pembayaran')->where('id', $id)->update(['bukti_bayar' => $namafile]);
    	}

    	if($update){
    		return redirect('pembayaran-data')->with('success', 'Berhasil mengubah data pembayaran');
    	}else{
    		return redirect('pembayaran-data')->with('error', 'Gagal mengubah data pembayaran');
    	}
    }

    public function verifikasi($id)
    {
    	$databayar = \DB::table('pembayaran')->where('id', $id)->first();
    	// dd($databayar);
    	$status = $databayar->status;

    	if($status == 'Menunggu Konfirmasi'){
    		$status = 'Dikonfirmasi';
    	}else{
    		$status = 'Menunggu Konfirmasi';
    	}

    	$siswa = \DB::table('siswa')
    			->where('kode_hapus', 0)
    			->where('id', $databayar->id_siswa)->first();

    	$siswa = $siswa->nama;

    	$data = \DB::table('pembayaran')->where('id', $id)->update(['status' => $status]);

    	if($data){
    		return redirect('pembayaran-data')->with('success', 'Berhasil mengubah statu pembayaran '.$siswa);
    	}else{
    		return redirect('pembayaran-data')->with('error', 'Gagal mengubah status pembayaran '.$siswa);
    	}
    }
}
