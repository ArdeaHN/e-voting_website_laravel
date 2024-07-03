<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
<a class="navbar-brand" href="#">
            <img src="{{ asset('assets/img/Logo-IF.png') }}" alt="Logo IF" style="height: 30px;">
            <img src="{{ asset('assets/img/Logo-HMIF.png') }}" alt="Logo HMIF" style="height: 30px;">
        </a>
    @cannot('is-voter')
        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3" aria-label="Toggle Sidebar">
            <i class="fa fa-bars"></i>
        </button>
    @endcannot

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Nav Item - User Information -->
         <!-- Social Icons - Instagram and Website -->
        <li class="nav-item">
            <a class="nav-link" href="https://www.instagram.com/hmif_ittelkompwt/" target="_blank">
                <i class="fab fa-instagram"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="https://hmif.ittelkom-pwt.ac.id/" target="_blank">
                <i class="fas fa-globe"></i>
            </a>
        </li>
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <div style="display: grid; grid-template-columns: 1fr auto; max-width: 300px;">
                    <span class="mr-3 mt-2 d-lg-inline text-gray-600 small"
                        style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                        Hai, {{ \Str::limit(auth()->user()->name, 10) }}
                        ({{ ['admin' => 'Admin', 'voter' => 'Voter'][auth()->user()->role] ?? 'Voter' }})
                    </span>
                    <img class="img-profile rounded-circle" alt="profile icon"
                        src="{{ asset('template/img/undraw_profile.svg') }}">
                </div>
            </a>

            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>

</nav>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="exampleModalLabel">Anda yakin ingin keluar?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">Pilih "Logout" di bawah ini jika anda siap untuk mengakhiri sesi Anda saat ini.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>