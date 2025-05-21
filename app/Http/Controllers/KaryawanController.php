<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class KaryawanController extends Controller
{
    public function index(Request $request)
    {
        $query = Karyawan::query();
        $query->select('karyawan.*','nama_dept');
        $query->join('departemen','karyawan.kode_dept','=','departemen.kode_dept');
        $query->orderBy('nama_lengkap');
        if(!empty($request->nama_karyawan)){
            $query->where('nama_lengkap','like','%' . $request->nama_karyawan . '%');
        }

        if(!empty($request->kode_dept)){
            $query->where('karyawan.kode_dept',$request->kode_dept);
        }
        $karyawan = $query->paginate(2);

        $departemen = DB::table('departemen')->get();
        return view('karyawan.index', compact('karyawan','departemen'));
    }

    public function store(Request $request)
    {
        $nik = $request->nik;
        $nama_lengkap = $request->nama_lengkap;
        $jabatan = $request->jabatan;
        $no_hp = $request->no_hp;
        $kode_dept = $request->kode_dept;
        $password = Hash::make('asd');

        if($request->hasFile('foto')){
            $foto = $nik . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = null;
        }

        try {
            $data = [
                'nik' => $nik,
                'nama_lengkap' => $nama_lengkap,
                'no_hp' => $no_hp,
                'jabatan' => $jabatan,
                'kode_dept' => $kode_dept,
                'foto' => $foto,
                'password' => $password,
            ];
            $simpan = DB::table('karyawan')->insert($data);
            if($simpan){
                if($request->hasFile('foto')){
                    $folderPath = "uploads/karyawan/";
                    $request->file('foto')->storeAs($folderPath, $foto, 'public');
                }
                return Redirect::back()->with(['success'  => 'Data berhasil disimpan']);
            }
        } catch (\Exception $e) {
            //throw $th;
                return Redirect::back()->with(['warning'  => 'Data Error']);

        }

    }

    public function edit(Request $request)
    {
        $nik = $request->nik;
        $departemen = DB::table('departemen')->get();
        $karyawan = DB::table('karyawan')->where('nik', $nik)->first();
        return view('karyawan.edit', compact('departemen','karyawan'));
    }
    public function update($nik,Request $request)
    {
        $nik = $request->nik;
        $nama_lengkap = $request->nama_lengkap;
        $jabatan = $request->jabatan;
        $no_hp = $request->no_hp;
        $kode_dept = $request->kode_dept;
        $password = Hash::make('asd');
        $old_foto = $request->old_foto;

        if($request->hasFile('foto')){
            $foto = $nik . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = $old_foto ;
        }

        try {
            $data = [
                'nama_lengkap' => $nama_lengkap,
                'no_hp' => $no_hp,
                'jabatan' => $jabatan,
                'kode_dept' => $kode_dept,
                'foto' => $foto,
                'password' => $password,
            ];
            $update = DB::table('karyawan')->where('nik',$nik)->update($data);
            if($update){
                if($request->hasFile('foto')){
                    $folderPath = "uploads/karyawan/";
                    $folderPathOld = "uploads/karyawan/" . $old_foto;
                    // ✅ Tambahkan pengecekan file sebelum delete
                    if (Storage::disk('public')->exists($folderPathOld)) {
                        Storage::disk('public')->delete($folderPathOld); // ✅ Ganti delete pakai disk('public')
                    }

                    $request->file('foto')->storeAs($folderPath, $foto, 'public');
                }
                return Redirect::back()->with(['success'  => 'Data berhasil Diupdate']);
            }
        } catch (\Exception $e) {
            //throw $th;
                return Redirect::back()->with(['warning'  => 'Data Error']);

        }
    }

    public function delete($nik)
    {
        $delete = DB::table('karyawan')->where('nik',$nik)->delete();
        if($delete){
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        }else{
            return Redirect::back()->with(['warning' => 'Data Error']);
        }
    }
}
