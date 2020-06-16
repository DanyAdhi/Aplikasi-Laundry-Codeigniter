<?php include('header.php');

$hal    = $this->uri->segment(2);
$aktif  = 'active';
?>



<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item <?=($hal=='dashboard')?$aktif:''; ?>">
        <a class="nav-link" href="<?=base_url('admin/dashboard')?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <li class="nav-item <?=($hal=='pakaian')?$aktif:''; ?>">
        <a class="nav-link" href="<?=base_url('admin/pakaian')?>">
          <i class="fas fa-fw fa-male"></i>
          <span>Data Pakaian</span></a>
      </li>
      <li class="nav-item <?=($hal=='tarif')?$aktif:''; ?>">
        <a class="nav-link" href="<?=base_url('admin/tarif') ?>">
          <i class="fas fa-fw fa-dollar-sign"></i>
          <span>Tarif</span></a>
      </li>
      <li class="nav-item <?=($hal=='transaksi')?$aktif:''; ?>">
        <a class="nav-link" href="<?=base_url('admin/transaksi') ?>">
          <i class="fas fa-fw fa-handshake"></i>
          <span>Transaksi Laundry</span></a>
      </li>
      <li class="nav-item <?=($hal=='status')?$aktif:''; ?>" >
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-stream"></i>
          <span>Status Laundry</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?=base_url('admin/status/proses') ?>">Proses</a>
            <a class="collapse-item" href="<?=base_url('admin/status/selesai') ?>">Selesai</a>
          </div>
        </div>
      </li>
      <li class="nav-item <?=($hal=='laporan')?$aktif:''; ?>">
        <a class="nav-link" href="<?=base_url('admin/laporan') ?>">
          <i class="fas fa-fw fa-file-alt"></i>
          <span>Laporan</span></a>
      </li>
      <li class="nav-item <?=($hal=='user')?$aktif:'';?>">
        <a class="nav-link" href="<?=base_url('admin/user') ?>">
          <i class="fas fa-fw fa-user"></i>
          <span>User</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">


      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Dany Adhi Prabowo</span>
                <img class="img-profile rounded-circle" src="<?=base_url('assets/img/admin.png')?>">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
            
          <!-- Page Heading -->
          
          <?php 
            if(!defined('BASEPATH')) exit ('No direct script access allowed');
            if($content){$this->load->view($content);}
           ?>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?=base_url('admin/auth/logout')?>">Logout</a>
        </div>
      </div>
    </div>
  </div>

  


<?php include('footer.php') ?>
