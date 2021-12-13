<?php

namespace App\Http\Controllers;

use App\EarlyRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EarlyRegisterController extends Controller
{
    //show all data
    public function index()
    {
        $pendaftar = EarlyRegister::all();
        return view('pages.pendaftar_awal', compact('pendaftar'));
    }

    //store the data
    public function store(Request $request)
    {
        // validate the request data first here
        $validator = Validator::make($request->all(),[
            'nm_student' => 'required',
            'sch_student' => 'required',
            'mjr_student' => 'required',
            'phn_student' => 'required|numeric|min:11|max:13',
            'phn_parent' => 'required|numeric|min:11|max:13',
            'addrs_student' => 'required',
        ],
        [
            'nm_student.required' => 'Nama Siswa Wajib Diisi',
            'sch_student.required' => 'Asal Sekolah Wajib Diisi',
            'mjr_student.required' => 'Jurusan Wajib Dipilih',
            'phn_student.required' => 'Nomor Handphone Wajib Diisi',
            'phn_student.numeric' =>  'Nomor Harus Angka',
            'phn_student.min' => "Nomor Minimal 11 Digit",
            'phn_student.max' => "Nomor Maksimal 13 Digit",
            'phn_parent.required' => 'Nomor Handphone Wajib Diisi',
            'phn_parent.numeric' =>  'Nomor Harus Angka',
            'phn_parent.min' => "Nomor Minimal 11 Digit",
            'phn_parent.max' => "Nomor Maksimal 13 Digit",
            'addrs_student.required' => "Alamat Lengkap Wajib Diisi",
        ]);

        EarlyRegister::create($request->all());
        return redirect()->route('index.pendaftar')->with('success', 'Data Berhasil Di Tambahkan');
    }

    public function delete($id)
    {
        $data = EarlyRegister::find($id);
        $data->delete();
        return redirect()->route('index.pendaftar')->with('success', 'Data Telah Dihapus');
    }

    public function change(Request $request)
    {
        $pendaftar = EarlyRegister::find($request->id);
        $pendaftar->status = $request->status;
        $pendaftar->save();
    }

    public function form()
    {
        return view('pages.form_daftar');
    }

    public function register(Request $request)
    {
        EarlyRegister::create($request->all());
        return redirect()->route('siswa.pendaftar')->with('success', 'Terima Kasih Telah Mendaftar, Salam SMK Bisa');
    }
}
