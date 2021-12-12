<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SMKS TI Airlangga | Pendaftaran Awal</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  {{-- Favicon --}}
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/logo_smktia.png')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('assets/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/AdminLTE.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/iCheck/square/blue.css')}}">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition col-md-12 register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>SMKS TI Airlangga Samarinda </b></a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Formulir Pendaftaran Awal</p>

    @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{$message}}
        </div>
    @endif

    <form action="{{ route('siswa.pendaftar') }}" method="POST">
        @csrf
      <div class="form-group has-feedback">
        <input type="text" class="form-control @error('nm_student') is-invalid @enderror" placeholder="Nama Lengkap Anda" name="nm_student">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control @error('sch_student') is-invalid @enderror" name="sch_student" placeholder="Asal Sekolah(SMP) Anda">
        <span class="glyphicon glyphicon-education form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="number" name="phn_student" class="form-control @error('phn_student') is-invalid @enderror" placeholder="No.Handphone Aktif Anda">
        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="number" name="phn_parent" class="form-control @error('phn_parent') is-invalid @enderror" placeholder="No.Handphone Aktif Orang Tua/Wali Anda">
        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <textarea name="addrs_student" class="form-control  @error('addrs_student') is-invalid @enderror" cols="30" rows="10" placeholder="Alamat Lengkap Anda"></textarea>
        <span class="glyphicon glyphicon-home form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <select class="form-control @error('mjr_student') is-invalid @enderror" name="mjr_student">
            <option value="" selected>Peminatan Jurusan</option>
            <option value="DKV">DKV | Desain Komunikasi Visual</option>
            <option value="Broadcasting">BDP | Brodcasting & Perfilman</option>
            <option value="TJKT">TJKT | Teknik Jaringan Komputer Teknologi</option>
            <option value="Pemasaran">PPLG | Perancangan Perangkat Lunak & Gim</option>
            <option value="MPLB">MPLB | Manajamen Perkantoran Lembaga Bisnis </option>
            <option value="Pemasaran">DM | Digital Marketing</option>
        </select>
      </div>
      <div class="row">
        <div class="col-xs-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Daftar</button>
            <button type="reset" class="btn btn-primary btn-block btn-flat">Bersihkan</button>
          <div class="checkbox icheck">
            <label>
              {{-- <input type="checkbox"> I agree to the <a href="#">terms</a> --}}
              <p>Syarat dan Ketentuan:</p>
              <ul>
                  <li>1</li>
                  <li>2</li>
              </ul>
            </label>
          </div>
        </div>
      </div>
    </form>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3 -->
<script src="{{ asset('assets/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- iCheck -->
<script src="{{ asset('assets/plugins/iCheck/icheck.min.js')}}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
