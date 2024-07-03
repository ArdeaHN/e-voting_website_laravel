<!DOCTYPE html>
<html lang="en" oncontextmenu="return false">

<x-header>{{ $title }}</x-header>

    <body style="background-image: url('{{ asset('assets/img/gedungDC.jpg') }}'); background-size: cover; background-position: center center;">

        <!-- Overlay layer -->
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(255, 255, 255, 0.8); "></div>

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow text-center"
            style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; max-width: 100vw;">
            <div class="mx-auto">
                <strong>PEMILIHAN RAYA MAHASISWA TEKNIK INFORMATIKA</strong>
            </div>
        </nav>

        <div class="container" style="min-height: 80vh; display: flex; flex-direction: column;" onmousedow>
            <div class="row justify-content-center align-items-center flex-grow-1">
                <div class="col-xl-10 col-lg-12 col-md-9">
                    <div class="row justify-content-center">
                        <div class="col-md-6 text-center my-0">
                            <img src="{{ asset('assets/img/Logo-HMIF.png') }}" alt="Logo HMIF" style="height: 20vh;">
                        </div>
                    </div>
                    <!-- Alert -->
                    @if ($errors->any() || session('success'))
                    <div class="alert alert-{{ $errors->any() ? 'danger' : 'success' }} alert-dismissible fade show mx-auto my-4"
                        role="alert">
                        @if ($errors->has('loginError'))
                        <strong>{{ $errors->first('loginError') }}</strong><br>
                        @else
                        @foreach ($errors->all() as $error)
                        <strong>{{ $error }}</strong><br>
                        @endforeach
                        @endif
                        @if (session('success'))
                        {{ session('success') }}
                        @endif
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <div class="card o-hidden border-0 shadow-lg my-4">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4"
                                                style="font-family: 'Montserrat', sans-serif;">Login</h1>
                                        </div>
                                        <!-- Login form -->
                                        <form class="user" method="POST" action="{{ route('authenticate') }}">
                                            @csrf
                                            <!-- Email input field -->
                                            <div class="form-group">
                                                <label for="exampleInputEmail" class="sr-only">Email</label>
                                                <input type="email" name="email" class="form-control form-control-user"
                                                    id="exampleInputEmail" placeholder="Email..." value="{{ old('email') }}"
                                                    required>
                                            </div>
                                            <!-- Password input field -->
                                            <div class="form-group">
                                                <label for="exampleInputPassword" class="sr-only">Password</label>
                                                <input type="password" name="password"
                                                    class="form-control form-control-user" id="exampleInputPassword"
                                                    placeholder="Password..." value="{{ old('password') }}" required>
                                            </div>
                                            <!-- Login button -->
                                            <button type="submit" class="btn btn-warning btn-user btn-block">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}" async></script>

        <!-- Core plugin JavaScript-->
        <script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}" defer></script>

        <!-- Custom scripts for all pages-->
        <script src="{{ asset('template/js/sb-admin-2.min.js') }}" defer></script>

    </body>

</html>