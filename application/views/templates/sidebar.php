 <!-- Sidebar -->
 <ul class="nav navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

   <!-- Sidebar - Brand -->
   <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
     <div class="sidebar-brand-icon rotate-n-15">
       <i class="fas fa-sitemap"></i>
     </div>
     <div class="sidebar-brand-text mx-3">SIPETA IF</div>
   </a>


   <!-- SIDE BAR MENU UNTUK ADMINISTRATOR -->

   <?php if ($this->session->userdata('role_id') == '1') : ?>
     <!-- Divider -->
     <hr class="sidebar-divider my-0">

     <!-- Nav Item - Dashboard -->
     <li class="nav-item active">
       <a class="nav-link" href="<?= base_url('admin') ?>">
         <i class="fas fa-fw fa-tachometer-alt"></i>
         <span>Dashboard</span></a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
       User
     </div>

     <!-- Nav Item - User -->
     <li class="nav-item">
       <a class="nav-link" href="<?= base_url('user') ?>">
         <i class="fas fa-fw fa-user"></i>
         <span>User</span></a>
     </li>

     <!-- Nav Item - Edit User -->
     <li class="nav-item">
       <a class="nav-link" href="<?= base_url('user/edit') ?>">
         <i class="fas fa-fw fa-user-edit"></i>
         <span>Edit User</span></a>
     </li>

     <!-- Nav Item - Change Password -->
     <li class="nav-item">
       <a class="nav-link" href="<?= base_url('user/changepassword') ?>">
         <i class="fas fa-fw fa-key"></i>
         <span>Ubah Password</span></a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
       Menu Admin
     </div>

     <!-- Nav Item - Pages Collapse Menu -->
     <li class="nav-item">
       <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dataPages" aria-expanded="true" aria-controls="collapsePages">
         <i class="fas fa-fw fa-folder"></i>
         <span>Data Dosen</span>
       </a>
       <div id="dataPages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
         <div class="bg-white py-2 collapse-inner rounded">
           <a class="collapse-item" href="<?= base_url('menu/data_dosen') ?>">Data Dosen</a>
           <!-- <a class="collapse-item" href="<?= base_url('menu/data_jadwal_dosen'); ?>">Data Jadwal Dosen</a> -->
           <div class="collapse-divider"></div>
         </div>
       </div>
     </li>

     <!-- Nav Item - Pages Collapse Menu -->
     <li class="nav-item">
       <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dataPagesMahasiswa" aria-expanded="true" aria-controls="collapsePages">
         <i class="fas fa-fw fa-folder"></i>
         <span>Data Pendaftaran</span>
       </a>
       <div id="dataPagesMahasiswa" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
         <div class="bg-white py-2 collapse-inner rounded">
           <a class="collapse-item" href="<?= base_url('menu/data_mahasiswa_proposal') ?>">Data Seminar Proposal</a>
           <a class="collapse-item" href="<?= base_url('menu/data_mahasiswa_sidang') ?>">Data Sidang Akhir</a>
           <div class="collapse-divider"></div>
         </div>
       </div>
     </li>

     <!-- History Data Mahasiswa Sempro dan Sidang -->
     <!-- <li class="nav-item">
     <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dataPagesHistoryMahasiswa" aria-expanded="true"
       aria-controls="collapsePages">
       <i class="fas fa-fw fa-folder"></i>
       <span>History</span>
     </a>
     <div id="dataPagesHistoryMahasiswa" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
       <div class="bg-white py-2 collapse-inner rounded">
         <a class="collapse-item" href="<?= base_url('menu/data_mahasiswa_proposal') ?>">History Seminar Proposal</a>
         <a class="collapse-item" href="<?= base_url('menu/data_mahasiswa_sidang') ?>">History Sidang Akhir</a>
         <div class="collapse-divider"></div>
       </div>
     </div>
   </li> -->

     <!-- Navigation Buat Jadwal -->
     <li class="nav-item">
       <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#buatjadwalPages" aria-expanded="true" aria-controls="collapsePages">
         <i class="fas fa-fw fa-calendar-plus"></i>
         <span>Buat Penjadwalan</span>
       </a>
       <div id="buatjadwalPages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
         <div class="bg-white py-2 collapse-inner rounded">
           <a class="collapse-item" href="<?= base_url('menu/buat_jadwal_proposal') ?>">Buat Jadwal Sempro</a>
           <a class="collapse-item" href="<?= base_url('menu/buat_jadwal_sidang') ?>">Buat Jadwal Sidang</a>
           <div class="collapse-divider"></div>
         </div>
       </div>
     </li>

     <!-- Navigation Jadwal -->
     <li class="nav-item">
       <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#jadwalPages" aria-expanded="true" aria-controls="collapsePages">
         <i class="fas fa-fw fa-calendar-week"></i>
         <span>Jadwal</span>
       </a>
       <div id="jadwalPages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
         <div class="bg-white py-2 collapse-inner rounded">
           <a class="collapse-item" href="<?= base_url('jadwal/jadwal_proposal') ?>">Jadwal Sempro</a>
           <a class="collapse-item" href="<?= base_url('jadwal/jadwal_sidang') ?>">Jadwal Sidang</a>
           <div class="collapse-divider"></div>
         </div>
       </div>
     </li>

     <!-- Nav Item - User -->
     <li class="nav-item">
       <a class="nav-link" href="<?= base_url('menu/data_user') ?>">
         <i class="fas fa-fw fa-users"></i>
         <span>Data User</span></a>
     </li>

     <!-- Nav Item - Tables -->
     <li class="nav-item">
       <a class="nav-link" href="<?= base_url('auth/logout') ?>">
         <i class="fas fa-fw fa-sign-out-alt"></i>
         <span>Logout</span></a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider d-none d-md-block">

     <!-- Sidebar Toggler (Sidebar) -->
     <div class="text-center d-none d-md-inline">
       <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div>

     <!-- SIDE BAR MENU UNTUK USER/MAHASISWA -->

   <?php elseif ($this->session->userdata('role_id') == '2') : ?>
     <hr class="sidebar-divider my-2">

     <!-- Heading -->
     <div class="sidebar-heading">
       Menu User
     </div>

     <!-- Nav Item - User -->
     <li class="nav-item active">
       <a class="nav-link" href="<?= base_url('user') ?>">
         <i class="fas fa-fw fa-user"></i>
         <span>User</span></a>
     </li>

     <!-- Nav Item - Edit User -->
     <li class="nav-item">
       <a class="nav-link" href="<?= base_url('user/edit') ?>">
         <i class="fas fa-fw fa-user-edit"></i>
         <span>Edit User</span></a>
     </li>

     <!-- Nav Item - Change Password -->
     <li class="nav-item">
       <a class="nav-link" href="<?= base_url('user/changepassword') ?>">
         <i class="fas fa-fw fa-key"></i>
         <span>Ubah Password</span></a>
     </li>

     <!-- Nav Item - Daftar -->
     <li class="nav-item">
       <a class="nav-link" href="<?= base_url('user/daftar_sidang'); ?>">
         <i class="fas fa-fw fa-file-alt"></i>
         <span>Daftar Sidang</span></a>
     </li>

     <!-- Nav Item - Jadwal -->
     <li class="nav-item">
       <a class="nav-link" href="<?= base_url('user/jadwal_sidang') ?>">
         <i class="fas fa-fw fa-calendar-alt"></i>
         <span>Jadwal Sidang</span></a>
     </li>

     <!-- Nav Item - Tables -->
     <li class="nav-item">
       <a class="nav-link" href="<?= base_url('auth/logout') ?>">
         <i class="fas fa-fw fa-sign-out-alt"></i>
         <span>Logout</span></a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider d-none d-md-block">

     <!-- Sidebar Toggler (Sidebar) -->
     <div class="text-center d-none d-md-inline">
       <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div>

   <?php endif; ?>
 </ul>
 <!-- End of Sidebar -->