@extends('layouts.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
            Data Pendaftar Awal
            <small>Control panel</small>
        </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            {{-- table --}}
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>Asal Sekolah</th>
                                <th>Pilihan Jurusan</th>
                                <th>No. HP Siswa</th>
                                <th>No. HP Orang Tua/Wali</th>
                                <th>Alamat</th>
                                <th>Pilihan</th>
                                </tr>
                                <tr>
                                <td>1</td>
                                <td>Aji Bagaskara</td>
                                <td>SMPN 21 Samarinda</td>
                                <td>PPLG</td>
                                <td>085346713897</td>
                                <td>085366641649</td>
                                <td>Jl. Sana Sini Capek</td>
                                </tr>
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
                        <form role="form">
                            <div class="box-body">
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Nama Siswa</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputPassword1">Asal Sekolah</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">No. HP Siswa</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">No. HP Orang Tua/Wali</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="exampleInputEmail1">Alamat</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Pilih Jurusan</label>
                                    <select class="form-control">
                                      <option>option 1</option>
                                      <option>option 2</option>
                                      <option>option 3</option>
                                      <option>option 4</option>
                                      <option>option 5</option>
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
