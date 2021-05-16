
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>@yield('title')</title>

  <!-- Font Awesome -->
  <script defer src="{{ asset('js/all.js') }}"></script>
  
  <!-- Bootstrap & Custom CSS -->
  <link href="{{ asset('css/bootstrap/bootstrap.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="/plugins/datatables/dataTables.bootstrap4.css">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">

   <!-- Icon -->
   <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}"/>
   <script src="/vendor/jquery/jquery.min.js"></script>
   <!-- Animate CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

</head>

<body id="page-top">
  <div id="wrapper">
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
          <div class="sidebar-brand-icon">
              <img src="{{ asset('img/icon-logo.png') }}" alt="" width="50">
          </div>
          <div class="sidebar-brand-text mx-2">SPK Wisata</div>
      </a>

      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item {{ \Str::is('dashboard.*', Route::currentRouteName()) ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>&nbsp; Dashboard</span>
        </a>
      </li>

      <!-- Nav Item - Manajemen User -->
      <li class="nav-item  {{ \Str::is('account.*', Route::currentRouteName()) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('account.index') }}">
          <i class="far fa-user"></i>
          <span>&nbsp; Manajemen Account</span>
        </a>
      </li>    

      <!-- Nav Item - Manajemen Kriteria -->
      @if (Auth::user()->is_admin == 1)
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKriteria" aria-expanded="true" aria-controls="collapseUtilities">
              <i class="fas fa-tasks"></i>
              <span>&nbsp; Manajemen Kriteria <i class="fas fa-angle-right" 
              style="margin-top: 5px;
              width: 1rem;
              text-align: center;
              float: right;
              vertical-align: 0;
              border: 0;
              font-weight: 900;"></i>
              </span>
          </a>
          <div id="collapseKriteria" class="collapse {{ \Str::is('kriteria.*', Route::currentRouteName()) ? 'show' : '' }} {{ \Str::is('sub-kriteria.*', Route::currentRouteName()) ? 'show' : '' }}" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Manajemen Kriteria :</h6>
              <a class="collapse-item {{ \Str::is('kriteria.*', Route::currentRouteName()) ? 'active' : '' }}" href="{{ route('kriteria.index') }}">Kriteria</a>
              <a class="collapse-item {{ \Str::is('sub-kriteria.*', Route::currentRouteName()) ? 'active' : '' }}" href="{{ route('sub-kriteria.index') }}">Sub Kriteria</a>
              </div>
          </div>
        </li>
      @endif

      <!-- Nav Item - Manajemen Alternatif -->
      <li class="nav-item  {{ \Str::is('alternatif.*', Route::currentRouteName()) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('alternatif.index') }}">
          <i class="fa fa-location-arrow"></i>
          <span>&nbsp; Alternatif</span>
        </a>
      </li>

      <li class="nav-item  {{ \Str::is('bobot-kriteria.*', Route::currentRouteName()) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('bobot-kriteria.index') }}">
          <i class="fa fa-greater-than-equal"></i>
          <span>&nbsp; Bobot Kriteria</span>
        </a>
      </li>

      <!-- Nav Item - Hasil Perhitungan -->
      <li class="nav-item  {{ \Str::is('hasil-perhitungan.*', Route::currentRouteName()) ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/hasil-perhitungan') }}">
          <i class="fa fa-calculator"></i>
          <span>&nbsp; Hasil Perhitungan</span>
        </a>
      </li>
      <li class="nav-item  {{ \Str::is('unduh.hasil-perhitungan.*', Route::currentRouteName()) ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/unduh-hasil-perhitungan') }}">
          <i class="fa fa-download"></i>
          <span>&nbsp; Export Hasil Perhitungan</span>
        </a>
      </li>
    </ul>
    <!-- Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- Navbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle -->
          <div class="text-center d-md-inline d-sm-none">
            <button class="btn btn-light" id="sidebarToggle"><i class="fas fa-bars"></i></button>
          </div>

          <ul class="navbar-nav ml-auto">
            <!-- Nav Item - User -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                <img class="img-profile rounded-circle" src="{{ asset('img/avatar.jpg') }}">
                <div style="padding-left:0.5rem;"><i class="fas fa-angle-down"></i></div>
              </a>
              <!-- Dropdown - User -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
              </div>
            </li>

          </ul>

        </nav>
        <!-- Navbar -->

        <!-- Page Content -->
        {{-- @include('sweetalert::alert') --}}
        @yield('container')
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; SPK Wisata 2021</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->
    </div>
  </div>

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap JavaScript-->
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('js/jquery.easing.min.js') }}"></script>

  <!-- Page level plugins -->
  <script src="{{ asset('js/chart.js/Chart.min.js') }}"></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
  <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>

  {{-- <script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script> --}}

  <!-- Js Mask -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
  <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="/js/sb-admin-2.min.js"></script>
  @yield('script')

</body>

</html>
