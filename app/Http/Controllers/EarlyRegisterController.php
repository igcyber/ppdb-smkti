<?php

namespace App\Http\Controllers;

use App\EarlyRegister;
use App\Helpers\Helper;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Exports\RegistrantExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class EarlyRegisterController extends Controller
{
    //show all data
    public function index(Request $request)
    {
        if($request->has('search')){
            $pendaftar = EarlyRegister::where('nm_student', 'LIKE', '%' .$request->search. '%')->paginate(5);
        }else{
            $pendaftar = EarlyRegister::paginate(5);
        }
       
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
            'phn_student' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:11|max:13',
            'phn_parent' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:11|max:13',
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
        'phn_student.max' => "Nomor Maksimal 13 Digit",

        'phn_parent.required' => 'Nomor Handphone Wajib Diisi',
        'phn_parent.min' =>  'Nomor Minimal 11 Digit',
        'phn_parent.max' =>  'Nomor Maksimal 13 Digit',
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
            'phn_student' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:11|max:13',
            'phn_parent' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:11|max:13',
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
        'phn_student.max' => "Nomor Maksimal 13 Digit",

        'phn_parent.required' => 'Nomor Handphone Wajib Diisi',
        'phn_parent.min' =>  'Nomor Minimal 11 Digit',
        'phn_parent.max' =>  'Nomor Maksimal 13 Digit',
        'phn_parent.regex' => 'Nomor Harus Berupa Angka',
        'phn_parent.not_regex' => 'Format Nomor Salah',

        'addrs_student.required' => "Alamat Lengkap Wajib Diisi",
        ]);
        
        // Ambil semua request
        $register = EarlyRegister::create($request->all());

        // Tanggal Daftar
        $date = Carbon::now();

        //Generate Registration Id
        $register->reg_id = 'PDB'.'-'.$date->format('Y').'-'.$register->id.'-'. str_replace(' ', '', strtoupper(substr($request->nm_student,0,4)));

        //Simpan Registration Id
        $register->save();

        return redirect()->route('form')->with('success', 'Terima Kasih Telah Mendaftar, Salam SMK Bisa');
    }

    public function exportExcel()
    {
        return Excel::download(new RegistrantExport, 'dataPendaftarAwal.xlsx');
    }
}
