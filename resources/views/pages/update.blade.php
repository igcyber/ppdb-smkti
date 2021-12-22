@extends('layouts.master')

@section('content')
    <!-- Main content -->

    <div class="content-wrapper">
        <section class="content">
    
            <div class="row">
                <div class="col-xs-12">
                         
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Generate ID Pendaftar</h3>
                        </div>
                       
                        <!-- form start -->
                        <form action="{{ route('updateID',$pendaftar_data->id) }}" method="POST">
                            @csrf
                            <div class="box-body">
                                <div class="form-group col-md-12">
                                    <label >Nama Siswa</label>
                                    <input type="text" value="{{$pendaftar_data->nm_student}}" class="form-control" disabled>
                                </div>
                              
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Generate</button>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
                    
        </section>

    </div>

    
    <!-- /.content -->
@endsection