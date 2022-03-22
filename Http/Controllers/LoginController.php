<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel as User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\SimpananModel as Simpanan;
use App\Models\SiswaModel as Siswa;

class LoginController extends Controller
{   //FORMLOGIN ANGGOTA, ADMIN, DAN ATASAN
    public function index()
    {
    	return view('manajamen.login');
    }

    //FORM LOGIN SISWA
    public function indexsiswa()
    {
        return view('manajamen.loginsiswa');
    }

    //LOGIN ANGGOTA, ATASAN, DAN ADMIN
    public function login(Request $request)
    {
    	$username = $request->username;
    	$password = $request->password;
    	$data_user = User::cekLog($username, $password);

        if($data_user)
        {   
            Session::put('id', $data_user->id);
            Session::put('username', $data_user->username);
            Session::put('role', $data_user->role);
            Session::put('foto', $data_user->foto);
            Session::put('tempat_lahir', $data_user->tempat_lahir);
            Session::put('nama', $data_user->nama);
            return redirect('/dashboard');

        } else {
            return back()->with("error","Gagal login, Username atau Password salah!");
        }
    }

    //LOGIN SISWA
    public function login_siswa(Request $request)
    {   
        // dd($request);
        $nisn = $request->nisn;
        $password = $request->password;
        $data_user = Siswa::cekLog($nisn, $password);

        if($data_user)
        {   
            Session::put('id', $data_user->id);
            Session::put('role', 'Siswa');
            Session::put('nisn', $data_user->nisn);
            Session::put('id_golongan', $data_user->id_golongan);
            Session::put('nama', $data_user->nama);
            Session::put('gender', $data_user->gender);
            Session::put('alamat', $data_user->alamat);
            Session::put('nama_ortu', $data_user->nama_ortu);
            Session::put('nohp_ortu', $data_user->nohp_ortu);
            return redirect('/dashboard-siswa');

        } else {
            return back()->with("error","Gagal login, Username atau Password salah!");
        }
    }

    //DASHBOARD ANGGOTA, ADMIN, DAN ATASAN
    public function dashboard()
    {
    	$month = \Carbon\Carbon::now();
        $dataMonth = $month->isoFormat('MMMM');
        //DATA SIMPANAN POKOK DASHBOARD
        if (session()->get('role')=='Anggota'){
            $pokok = \DB::table('simpanan')
                ->join('jenis', 'jenis.id', '=', 'simpanan.id_jenis')->select('nominal', 'jenis')
                ->where('simpanan.kode_hapus', 0)->where('jenis.jenis', '=', 'Simpanan Pokok')
                ->where('id_user', session()->get('id'))
                ->get();
        }else{
            $pokok = \DB::table('simpanan')
                ->join('jenis', 'jenis.id', '=', 'simpanan.id_jenis')->select('nominal', 'jenis')
                ->where('simpanan.kode_hapus', 0)->where('jenis.jenis', '=', 'Simpanan Pokok')
                ->whereMonth('simpanan.tgl_simpan', $month)
                ->get();
        }
        $spokok = 0;
        foreach ($pokok as $key => $value) {
            $spokok += $value->nominal;
        }
        
        //DATA SIMPANAN WAJIB DASHBOARD
        if (session()->get('role')=='Anggota'){
            $wajib = \DB::table('simpanan')
                ->join('jenis', 'jenis.id', '=', 'simpanan.id_jenis')->select('nominal', 'jenis')
                ->where('simpanan.kode_hapus', 0)->where('jenis.jenis', '=', 'Simpanan Wajib')
                ->where('id_user', session()->get('id'))
                ->get();
        }else{
            $wajib = \DB::table('simpanan')
                ->join('jenis', 'jenis.id', '=', 'simpanan.id_jenis')->select('nominal', 'jenis')
                ->where('simpanan.kode_hapus', 0)->where('jenis.jenis', '=', 'Simpanan Wajib')
                ->whereMonth('simpanan.tgl_simpan', $month)
                ->get();
        }
        $swajib = 0;
        foreach ($wajib as $key => $value) {
            $swajib += $value->nominal;
        }

        //DATA SIMPANAN SUKARELA DASHBOARD
        if (session()->get('role')=='Anggota'){
            $sukarela = \DB::table('simpanan')
                ->join('jenis', 'jenis.id', '=', 'simpanan.id_jenis')->select('nominal', 'jenis')
                ->where('simpanan.kode_hapus', 0)->where('jenis.jenis', '=', 'Simpanan Sukarela')
                ->where('id_user', session()->get('id'))
                ->get();
        }else{
            $sukarela = \DB::table('simpanan')
                ->join('jenis', 'jenis.id', '=', 'simpanan.id_jenis')->select('nominal', 'jenis')
                ->where('simpanan.kode_hapus', 0)->where('jenis.jenis', '=', 'Simpanan Sukarela')
                ->whereMonth('simpanan.tgl_simpan', $month)
                ->get();
        }
        $ssukarela = 0;
        foreach ($sukarela as $key => $value) {
            $ssukarela += $value->nominal;
        }

        //DATA PINJAMAN DASHBOARD
        if (session()->get('role')=='Anggota'){
            $pinjaman = \DB::table('pinjaman')->where('pinjaman.kode_hapus', 0)->where('id_user', session()->get('id'))->get();
        }else{
            $pinjaman = \DB::table('pinjaman')->where('pinjaman.kode_hapus', 0)->whereMonth('pinjaman.tgl_pinjam', $month)->get();
        }
        $spinjaman = 0;
        foreach ($pinjaman as $key => $value) {
            $spinjaman += $value->nominal;
        }

        //DATA ANGSURAN DASHBOARD
        if (session()->get('role')=='Anggota'){
            $angsuran = \DB::table('angsuran')->where('angsuran.kode_hapus', 0)->where('id_user', session()->get('id'))->get();
        }else{
            $angsuran = \DB::table('angsuran')->where('angsuran.kode_hapus', 0)->whereMonth('angsuran.tgl_bayar', $month)->get();
        }
        $sangsuran = 0;
        foreach ($angsuran as $key => $value) {
            $sangsuran += $value->nominal;
        }

        //DATA PEMBAYARAN DASHBOARD
        $pembayaran = \DB::table('pembayaran')->where('pembayaran.kode_hapus', 0)->whereMonth('pembayaran.tgl_bayar', $month)->get();
        $spembayaran = 0;
        foreach ($pembayaran as $key => $value) {
            $spembayaran += $value->nominal;
        }

        //RETURN KE DASHBOARD SESUAI ROLE
        if (session()->get('role')=='Anggota'){
            return view('layout.dashboard_anggota', compact('spokok', 'swajib', 'ssukarela', 'spinjaman', 'sangsuran', 'dataMonth'));
        }else{
            return view('layout.dashboard', compact('spokok', 'swajib', 'ssukarela', 'spinjaman', 'sangsuran', 'spembayaran', 'dataMonth'));
        }
    }

    //DASHBOARD SISWA
    public function dashboard_siswa()
    {
        $month = \Carbon\Carbon::now();
        $dataMonth = $month->isoFormat('MMMM');
        //DATA PEMBAYARAN DI DASHBOARD
        $pembayaran = \DB::table('pembayaran')
            ->join('siswa', 'siswa.id', '=', 'pembayaran.id_siswa')
            ->where('pembayaran.kode_hapus', 0)
            ->where('siswa.id', session()->get('id'))
            ->get();
        $spembayaran = 0;
        foreach ($pembayaran as $key => $value) {
            $spembayaran += $value->nominal;
        }

        return view('layout.dashboardsiswa', compact('month', 'dataMonth', 'spembayaran'));
    }

    public function logout(Request $request)
    {
        // dd(session()->get('role'));
        if(session()->get('role')=='Siswa'){
            $request->session()->forget('id');
            $request->session()->forget('role');
            $request->session()->forget('nisn');
            $request->session()->forget('id_golongan');
            $request->session()->forget('nama');
            $request->session()->forget('gender');
            $request->session()->forget('alamat');
            $request->session()->forget('nama_ortu');
            $request->session()->forget('nohp_ortu');
            $request->session()->flush();
            return redirect('/login-siswa')->with("success","Berhasil Logout!");;
        }else{
            $request->session()->forget('id');
            $request->session()->forget('username');
            $request->session()->forget('nama');
            $request->session()->forget('role');
            $request->session()->flush();
            return redirect('/')->with("success","Berhasil Logout!");
        }
    }
}
