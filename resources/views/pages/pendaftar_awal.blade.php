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
        <ol class="breadcrumb">
            <a href="{{ route('exportExcel') }}" class="btn btn-success btn-sm" title="Export Excel"><i class="fa fa-file-excel-o"></i>  Export Excel</a>
        </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Daftar Pendaftar</h3>
              
                            <div class="box-tools">
                              <div class="input-group input-group-sm hidden-xs" style="width: 250px;">
                                <form action="" method="GET">
                                    <input type="search" name="search" class="form-control pull-right" placeholder="Cari Nama">
                                </form>
              
                                <div class="input-group-btn">
                                    <a href="{{ route('index.pendaftar') }}"  class="btn btn-danger" type="button" title="Refresh page">
                                        <span class="fa fa-refresh"></span>
                                    </a>
                                </div>
                              </div>
                            </div>
                          </div>
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
                                            Gelombang <br>
                                            Pendaftar
                                        </th>
                                        <th>
                                            Status <br>
                                            <span>Daftar Ulang</span>
                                        </th>
                                        <th>
                                            Pilihan <br>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
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
                                    ?>

                                    @foreach ($pendaftar as $index => $row)
                                    <tr>
                                        <td>{{ $index + $pendaftar->firstItem() }}</td>
                                        <td>{{$row->nm_student}}</td>
                                        <td>{{$row->sch_student}}</td>
                                        <td>{{$row->mjr_student_ft}}|{{$row->mjr_student_snd}}</td>
                                        <td>{{$row->phn_student}}</td>
                                        <td>{{$row->phn_parent}}</td>
                                        <td>{{$row->addrs_student}}</td>
                                        <td>{{$row->created_at}}</td>
                                        
                                        <td>
                                            @if (($row->created_at >= $startDateK) && ($row->created_at <= $endDateK))
                                                <span class="label label-warning">Gelombang Khusus</span>
                                            @elseif(($row->created_at >= $startDate1) && ($row->created_at <= $endDate1))    
                                                <span class="label label-success">Gelombang Pertama</span> 
                                            @elseif(($row->created_at >= $startDate2) && ($row->created_at <= $endDate2))
                                                <span class="label label-primary">Gelombang Kedua</span>
                                            @elseif(($row->created_at >= $startDate3) && ($row->created_at <= $endDate3))
                                                <span class="label label-info">Gelombang Ketiga</span>
                                            @else 
                                                <span class="label label-danger">Gelombang Terakhir</span>
                                            @endif
                                        </td>
                                        <td>
                                            <input data-id="{{$row->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Sudah" data-off="Belum" {{ $row->status ? 'checked' : ''}}>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-danger btn-sm delete delete-btn" data-id="{{$row->id}}" data-toggle="tooltip" data-placement="bottom" title="Hapus">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div style="display: block;
                            margin-left: auto;
                            margin-right: auto;
                            width: 10%;">
                                {{ $pendaftar->links() }}
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                         
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Tambah Pendaftar</h3>
                        </div>
                       
                        <!-- form start -->
                        <form action="{{ route('store.pendaftar') }}" method="POST">
                            @csrf
                            <div class="box-body">
                                
                                <div class="form-group col-md-6">
                                    <label for="nameInput" >Nama Siswa</label>
                                    <span  class="text-danger">
                                         @error('nm_student')  (  {{$message}}  )@enderror
                                    </span>
                                    <input type="text" class="form-control" name="nm_student" id="nameInput" placeholder="Isi Nama Lengkap Siswa" value="{{ old('nm_student') }}">
                                </div>
                             
                                <div class="form-group col-md-6">
                                    <label for="sekolahInput">Asal Sekolah</label>
                                    <span  class="text-danger">
                                        @error('sch_student')  (  {{$message}}  )@enderror
                                   </span>
                                    <input type="text" class="form-control" name="sch_student" id="sekolahInput" placeholder="Isikan Asal Sekolah Siswa" value="{{ old('sch_student') }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="noInput">No. HP Siswa</label>
                                    <span  class="text-danger">
                                        @error('phn_student')  (  {{$message}}  )@enderror
                                   </span>
                                    <input type="text" class="form-control" name="phn_student" id="noInput" placeholder="Isikan No. HP Siswa" value="{{ old('phn_student') }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="noInputParent">No. HP Orang Tua/Wali</label>
                                    <span  class="text-danger">
                                        @error('phn_parent')  (  {{$message}}  )@enderror
                                   </span>
                                    <input type="text" class="form-control" name="phn_parent" id="noInputParent" placeholder="Isikan No. HP Orang Tua / Wali" value="{{ old('phn_parent') }}">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="alamatInput">Alamat</label>
                                    <span  class="text-danger">
                                        @error('addrs_student')  (  {{$message}}  )@enderror
                                   </span>
                                    <textarea class="form-control" rows="3" id="alamatInput" name="addrs_student" placeholder="Isikan Alamat Siswa">{{ old('addrs_student') }}</textarea>
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Pilih Jurusan Pertama</label>
                                    <span  class="text-danger">
                                        @error('mjr_student_ft')  (  {{$message}}  )@enderror
                                    </span>
                                    <select class="form-control" name="mjr_student_ft">
                                        <option value="" selected>--- Pilih Jurusan ---</option>
                                        <option value="DKV">DKV | Desain Komunikasi Visual</option>
                                        <option value="Broadcasting">BDP | Brodcasting & Perfilman</option>
                                        <option value="TJKT">TJKT | Teknik Jaringan Komputer Telekomunikasi</option>
                                        <option value="Pemasaran">PPLG | Perancangan Perangkat Lunak & Gim</option>
                                        <option value="MPLB">MPLB | Manajamen Perkantoran Lembaga Bisnis </option>
                                        <option value="Pemasaran">DM | Digital Marketing</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Pilih Jurusan Kedua</label>
                                    <span  class="text-danger">
                                        @error('mjr_student_snd')  (  {{$message}}  )@enderror
                                    </span>
                                    <select class="form-control" name="mjr_student_snd">
                                        <option value="" selected>--- Pilih Jurusan ---</option>
                                        <option value="DKV">DKV | Desain Komunikasi Visual</option>
                                        <option value="Broadcasting">BDP | Brodcasting & Perfilman</option>
                                        <option value="TJKT">TJKT | Teknik Jaringan Komputer Teknologi</option>
                                        <option value="Pemasaran">PPLG | Perancangan Perangkat Lunak & Gim</option>
                                        <option value="MPLB">MPLB | Manajamen Perkantoran Lembaga Bisnis </option>
                                        <option value="Pemasaran">DM | Digital Marketing</option>
                                    </select>
                                </div>
                                <input type="hidden" name="reg_id">
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
        $('.delete-btn').click( function(){
            var pendaftar_id = $(this).attr('data-id');
            swal({
                title: "Konfirmasi Penghapusan",
                text: "Apakah anda ingin menghapus data?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location = "/admin/pendaftar-awal/"+pendaftar_id+""
                } else {
                    swal("Proses Penghapusan Dibatalkan");
                }
            });
        });
    </script>
    <script>
        @if(Session::has('success'))
            toastr.success("{{ Session::get('success') }}")
        @endif
    </script>
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
