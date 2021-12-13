<?php

namespace App\Http\Controllers;

use App\EarlyRegister;
use App\Helpers\Helper;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
        $validator = $request->validate([
            'nm_student' => 'required',
            'sch_student' => 'required',
            'mjr_student_ft' => 'required',
            'mjr_student_snd' => 'required',
            'phn_student' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:11',
            'phn_parent' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:11',
            'addrs_student' => 'required',
        ],
        [
        'nm_student.required' => 'Nama Siswa Wajib Diisi',
        'sch_student.required' => 'Asal Sekolah Wajib Diisi',

        'mjr_student_ft.required' => 'Jurusan Pertama Wajib Dipilih',
        'mjr_student_snd.required' => 'Jurusan Kedua Wajib Dipilih', 

        'phn_student.required' => 'Nomor Handphone Wajib Diisi',
        'phn_student.regex' =>  'Nomor Harus Berupa Angka',
        'phn_student.not_regex' => 'Format Nomor Salah',
        'phn_student.min' => "Nomor Minimal 11 Digit",

        'phn_parent.required' => 'Nomor Handphone Wajib Diisi',
        'phn_parent.min' =>  'Nomor Minimal 11 Digit',
        'phn_parent.regex' => 'Nomor Harus Berupa Angka',
        'phn_parent.not_regex' => 'Format Nomor Salah',

        'addrs_student.required' => "Alamat Lengkap Wajib Diisi",
        ]);

         

        $register = EarlyRegister::create($request->all());

        // Tanggal Daftar
        $date = Carbon::now();

        $register->reg_id = 'PDB'.'-'.$date->format('Y').'-'.$register->id.'-'. str_replace(' ', '', strtoupper(substr($request->nm_student,0,4)));

        $register->save();

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
        // validate the request data first here
        $validator = $request->validate([
            'nm_student' => 'required',
            'sch_student' => 'required',
            'mjr_student_ft' => 'required',
            'mjr_student_snd' => 'required',
            'phn_student' => 'required|numeric|min:11',
            'phn_parent' => 'required|numeric|min:11',
            'addrs_student' => 'required',
        ],
        [
        'nm_student.required' => 'Nama Siswa Wajib Diisi',
        'sch_student.required' => 'Asal Sekolah Wajib Diisi',

        'mjr_student_ft.required' => 'Jurusan Pertama Wajib Dipilih',
        'mjr_student_snd.required' => 'Jurusan Kedua Wajib Dipilih', 

        'phn_student.required' => 'Nomor Handphone Wajib Diisi',
        'phn_student.numeric' =>  'Nomor Harus Angka',
        'phn_student.min' => "Nomor Minimal 11 Digit",

        'phn_parent.required' => 'Nomor Handphone Wajib Diisi',
        'phn_parent.numeric' =>  'Nomor Harus Angka',
        'phn_parent.min' => "Nomor Minimal 11 Digit",

        'addrs_student.required' => "Alamat Lengkap Wajib Diisi",
        ]);
        
        // EarlyRegister::create($request->all()); 
        //request store
        $nm_student = $request->nm_student;
        $sch_student = $request->sch_student;
        $mjr_student_ft = $request->mjr_student_ft;
        $mjr_student_snd = $request->mjr_student_snd;
        $phn_student = $request->phn_student;
        $phn_parent = $request->phn_parent;
        $addrs_student = $request->addrs_student;
        //Generate Token
        $generator = Helper::IDGenerator(new EarlyRegister,'token',5,'STI');
        $khmer = new EarlyRegister;
        $khmer->token->$generator;
        $khmer->nm_student->$nm_student;
        $khmer->sch_student->$sch_student;
        $khmer->mjr_student_ft->$mjr_student_ft;
        $khmer->mjr_student_snd->$mjr_student_snd;
        $khmer->phn_student->$phn_student;
        $khmer->phn_parent->$phn_parent;
        $khmer->addrs_student ->$addrs_student;


        return redirect()->route('form')->with('success', 'Terima Kasih Telah Mendaftar, Salam SMK Bisa');
    }
}
