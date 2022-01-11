<?php

namespace App\Http\Controllers;

use App\EarlyRegister;
use App\Helpers\Helper;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Exports\RegistrantExport;
use App\Imports\RegistrantImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class EarlyRegisterController extends Controller
{
    //show all data
    public function index(Request $request)
    {
        if($request->has('search')){
            $pendaftar = EarlyRegister::where('nm_student', 'LIKE', '%' .$request->search. '%')->orderBy('id','DESC')->paginate(5);
        }else{
            $pendaftar = EarlyRegister::orderBy('id','DESC')->paginate(5);
        }
       
        return view('pages.pendaftar_awal', compact('pendaftar'));
    }

    public function searchDate(Request $request)
    {   
        if($request->has('from')){
            $pendaftar = EarlyRegister::where('reg_date', '>=', $request->from)->where('reg_date', '<=', $request->to)->orderBy('id', 'DESC')->paginate(5);
        }else{
            $pendaftar = EarlyRegister::orderBy('id','DESC')->paginate(5);
        }
        return view('pages.pendaftar_awal', compact('pendaftar'));
    }

    //update registration id
    public function generate($id)
    {
        $pendaftar_data = EarlyRegister::find($id);
        // dd($pendaftar_data);
        return view('pages.update', compact('pendaftar_data'));
    }

    public function update(Request $request, $id)
    {
        $pendaftar_data = EarlyRegister::find($id);
        // dd($pendaftar_data);
        $pendaftar_data->update($request->all());

        // Date Gelombang Khusus
        $startDateK = date('Y-m-d', strtotime("2021-12-01"));
        $endDateK = date('Y-m-d', strtotime("2022-01-31"));  

        // Date Gelombang Pertama
        $startDate1 = date('Y-m-d', strtotime("2022-02-01"));
        $endDate1 = date('Y-m-d', strtotime("2022-03-31")); 

        // Date Gelombang Kedua
        $startDate2 = date('Y-m-d', strtotime("2022-04-01"));
        $endDate2 = date('Y-m-d', strtotime("2022-05-31"));
        
        // Date Gelombang Ketiga
        $startDate3 = date('Y-m-d', strtotime("2022-06-01"));
        $endDate3 = date('Y-m-d', strtotime("2022-07-31")); 

        // Tanggal Daftar
        $reg_date = $request->reg_date;

        // Periksa Kondisi Daftar Sesuai Tanggal Gelombang Pendaftaran
        if(($reg_date >=  $startDateK) && ($reg_date <= $endDateK)){
            $pendaftar_data->reg_id = 'PDB'.'-'.'GK'.'-'.$pendaftar_data->id.'-'. str_replace(' ', '', strtoupper(substr($pendaftar_data->nm_student,0,4)));
        }elseif(($reg_date >=  $startDate1) && ($reg_date <= $endDate1)){
            $pendaftar_data->reg_id = 'PDB'.'-'.'G1'.'-'.$pendaftar_data->id.'-'. str_replace(' ', '', strtoupper(substr($pendaftar_data->nm_student,0,4)));
        }elseif(($reg_date >=  $startDate2) && ($reg_date <= $endDate2)){
            $pendaftar_data->reg_id = 'PDB'.'-'.'G2'.'-'.$pendaftar_data->id.'-'. str_replace(' ', '', strtoupper(substr($pendaftar_data->nm_student,0,4)));
        }elseif(($reg_date >=  $startDate3) && ($reg_date <= $endDate3)){
            $pendaftar_data->reg_id = 'PDB'.'-'.'G3'.'-'.$pendaftar_data->id.'-'. str_replace(' ', '', strtoupper(substr($pendaftar_data->nm_student,0,4)));
        }else{
            $pendaftar_data->reg_id = 'PDB'.'-'.'GT'.'-'.$pendaftar_data->id.'-'. str_replace(' ', '', strtoupper(substr($pendaftar_data->nm_student,0,4)));
        }

        //Simpan
        $pendaftar_data->save();

        return redirect()->route('index.pendaftar')->with('success', 'Data Berhasil Diperbarui');

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
        
        // Date Gelombang Khusus
        $startDateK = date('Y-m-d', strtotime("2021-12-01"));
        $endDateK = date('Y-m-d', strtotime("2022-01-31"));  

        // Date Gelombang Pertama
        $startDate1 = date('Y-m-d', strtotime("2022-02-01"));
        $endDate1 = date('Y-m-d', strtotime("2022-03-31")); 

        // Date Gelombang Kedua
        $startDate2 = date('Y-m-d', strtotime("2022-04-01"));
        $endDate2 = date('Y-m-d', strtotime("2022-05-31"));
        
        // Date Gelombang Ketiga
        $startDate3 = date('Y-m-d', strtotime("2022-06-01"));
        $endDate3 = date('Y-m-d', strtotime("2022/07/31")); 

        // Tanggal Daftar
        $reg_date = $request->reg_date;

        // Periksa Kondisi Daftar Sesuai Tanggal Gelombang Pendaftaran
        if(($reg_date >=  $startDateK) && ($reg_date <= $endDateK)){
            $register->reg_id = 'PDB'.'-'.'GK'.'-'.$register->id.'-'. str_replace(' ', '', strtoupper(substr($request->nm_student,0,4)));
        }elseif(($reg_date >=  $startDate1) && ($reg_date <= $endDate1)){
            $register->reg_id = 'PDB'.'-'.'G1'.'-'.$register->id.'-'. str_replace(' ', '', strtoupper(substr($request->nm_student,0,4)));
        }elseif(($reg_date >=  $startDate2) && ($reg_date <= $endDate2)){
            $register->reg_id = 'PDB'.'-'.'G2'.'-'.$register->id.'-'. str_replace(' ', '', strtoupper(substr($request->nm_student,0,4)));
        }elseif(($reg_date >=  $startDate3) && ($reg_date <= $endDate3)){
            $register->reg_id = 'PDB'.'-'.'G3'.'-'.$register->id.'-'. str_replace(' ', '', strtoupper(substr($request->nm_student,0,4)));
        }else{
            $register->reg_id = 'PDB'.'-'.'GT'.'-'.$register->id.'-'. str_replace(' ', '', strtoupper(substr($request->nm_student,0,4)));
        }

        //Simpan
        $register->save();

        return redirect()->route('index.pendaftar')->with('success', 'Data Berhasil Di Tambahkan');
    }

    public function edit($id)
    {
        $pendaftar = EarlyRegister::findOrFail($id);
        if($pendaftar)
        {
            return response()->json([
                'status'=>200,
                'pendaftar'=>$pendaftar
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'Data Tidak Ditemukan'
            ]);
        }
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

    public function loginForm()
    {
        return view('auth.login');
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

        // Date Gelombang Khusus
        $startDateK = date('Y-m-d', strtotime("2021-12-01"));
        $endDateK = date('Y-m-d', strtotime("2022-01-31"));  

        // Date Gelombang Pertama
        $startDate1 = date('Y-m-d', strtotime("2022-02-01"));
        $endDate1 = date('Y-m-d', strtotime("2022-03-31")); 

        // Date Gelombang Kedua
        $startDate2 = date('Y-m-d', strtotime("2022-04-01"));
        $endDate2 = date('Y-m-d', strtotime("2022-05-31"));
        
        // Date Gelombang Ketiga
        $startDate3 = date('Y-m-d', strtotime("2022-06-01"));
        $endDate3 = date('Y-m-d', strtotime("2022/07/31")); 


        // Tanggal Daftar
        $reg_date = $request->reg_date;

        // Periksa Kondisi Daftar Sesuai Tanggal Gelombang Pendaftaran
        if(($reg_date >=  $startDateK) && ($reg_date <= $endDateK)){
            $register->reg_id = 'PDB'.'-'.'GK'.'-'.$register->id.'-'. str_replace(' ', '', strtoupper(substr($request->nm_student,0,4)));
        }elseif(($reg_date >=  $startDate1) && ($reg_date <= $endDate1)){
            $register->reg_id = 'PDB'.'-'.'G1'.'-'.$register->id.'-'. str_replace(' ', '', strtoupper(substr($request->nm_student,0,4)));
        }elseif(($reg_date >=  $startDate2) && ($reg_date <= $endDate2)){
            $register->reg_id = 'PDB'.'-'.'G2'.'-'.$register->id.'-'. str_replace(' ', '', strtoupper(substr($request->nm_student,0,4)));
        }elseif(($reg_date >=  $startDate3) && ($reg_date <= $endDate3)){
            $register->reg_id = 'PDB'.'-'.'G3'.'-'.$register->id.'-'. str_replace(' ', '', strtoupper(substr($request->nm_student,0,4)));
        }else{
            $register->reg_id = 'PDB'.'-'.'GT'.'-'.$register->id.'-'. str_replace(' ', '', strtoupper(substr($request->nm_student,0,4)));
        }

        //Simpan Registration Id
        $register->save();

        return redirect()->route('form')->with('success', 'Terima Kasih Telah Mendaftar, Salam SMK Bisa');
    }

    public function exportExcel()
    {
        return Excel::download(new RegistrantExport, 'dataPendaftarAwal.xlsx');
    }

    public function importExcel(Request $request)
    {
        $temp = $request->file('file')->store('temp');
        $path= storage_path('app').'/'.$temp;  
        Excel::import(new RegistrantImport, $path);
        return redirect()->back();
    }
}
