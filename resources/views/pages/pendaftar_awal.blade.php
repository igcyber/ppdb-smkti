@extends('layouts.master')
@section('bootstrap-toogle')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
            Data Pendaftar Awal
            {{-- <small>Control panel</small> --}}
        </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{$message}}
                </div>
            @endif
            {{-- table --}}
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No
                                            <br>
                                            Urut
                                        </th>
                                        <th>Nama <br>
                                            Siswa
                                        </th>
                                        <th>Asal <br>
                                            Sekolah
                                        </th>
                                        <th>Pilihan <br>
                                            Jurusan
                                        </th>
                                        <th>No. HP  <br>  
                                            Siswa
                                        </th>
                                        <th>No. HP <br>
                                            Orang Tua/Wali
                                        </th>
                                        <th>Alamat <br>
                                            Lengkap
                                        </th>
                                        <th>
                                            Staus <br>
                                            <span>Daftar Ulang</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i = 1)
                                    @foreach ($pendaftar as $row)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$row->nm_student}}</td>
                                        <td>{{$row->sch_student}}</td>
                                        <td>{{$row->mjr_student}}</td>
                                        <td>{{$row->phn_student}}</td>
                                        <td>{{$row->phn_parent}}</td>
                                        <td>{{$row->addrs_student}}</td>
                                        <td>
                                            <input data-id="{{$row->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Sudah" data-off="Belum" {{ $row->status ? 'checked' : ''}}>
                                        </td>
                                        <td>
                                            <a href="{{route('delete.pendaftar', $row->id)}}">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                        <h3 class="box-title">Tambah Pendaftar</h3>
                        </div>
                       
                        <!-- form start -->
                        <form action="{{ route('store.pendaftar') }}" method="POST">
                            @csrf
                            <div class="box-body">
                                <div class="form-group col-md-6">
                                    <label for="nameInput">Nama Siswa</label>
                                    <input type="text" class="form-control @error('nm_student') is-invalid @enderror" name="nm_student" id="nameInput" placeholder="Isi Nama Lengkap Siswa">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="sekolahInput">Asal Sekolah</label>
                                    <input type="text" class="form-control @error('sch_student') is-invalid @enderror" name="sch_student" id="sekolahInput" placeholder="Isikan Asal Sekolah Siswa">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="noInput">No. HP Siswa</label>
                                    <input type="number" class="form-control @error('phn_student') is-invalid @enderror" name="phn_student" id="noInput" placeholder="Isikan No. HP Siswa">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="noInputParent">No. HP Orang Tua/Wali</label>
                                    <input type="number" class="form-control @error('phn_parent') is-invalid @enderror" name="phn_parent" id="noInputParent" placeholder="Isikan No. HP Orang Tua / Wali">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="alamatInput">Alamat</label>
                                    <textarea class="form-control @error('addrs_student') is-invalid @enderror" rows="3" id="alamatInput" name="addrs_student" placeholder="Isikan Alamat Siswa"></textarea>
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Pilih Jurusan</label>
                                    <select class="form-control @error('mjr_student') is-invalid @enderror" name="mjr_student">
                                      <option value="DKV">DKV | Desain Komunikasi Visual</option>
                                      <option value="Broadcasting">BDP | Brodcasting & Perfilman</option>
                                      <option value="TJKT">TJKT | Teknik Jaringan Komputer Teknologi</option>
                                      <option value="Pemasaran">PPLG | Perancangan Perangkat Lunak & Gim</option>
                                      <option value="MPLB">MPLB | Manajamen Perkantoran Lembaga Bisnis </option>
                                      <option value="Pemasaran">DM | Digital Marketing</option>
                                    </select>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
                    
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@section('script')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $(function(){
            $('.toggle-class').change(function(){
                var status = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).data('id');
                $.ajax({
                    type:"GET",
                    dataType: "json",
                    url: "{{ route('changeStatus') }}",
                    data: {'status': status, 'id': id},
                    success: function(data){
                        console.log(data.success)
                    }
                });
            });
        });
    </script>
@endsection
