<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('assets/images/logo.png') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>SMK TI AIRLANGGA</p>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>

        <li>
            <a href="{{ url('/') }}">
              <i class="fa fa-th"></i> <span>Dashboard</span>
            </a>
          </li>

        <li class=" treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Data Pendaftar</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              <small class="label pull-right bg-green">new</small>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="{{ url('/admin/pendaftar-awal') }}"><i class="fa fa-circle-o"></i>Pendaftar Awal</a></li>
            <li><a href="index2.html"><i class="fa fa-circle-o"></i>Pendaftar Ulang</a></li>
          </ul>
        </li>

        <li>
            <a href="#">
              <i class="fa fa-files-o"></i> <span>Laporan</span>
            </a>
        </li>       
    </section>
    <!-- /.sidebar -->
</aside>