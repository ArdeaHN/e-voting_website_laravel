<!DOCTYPE html >
<html lang="en" oncontextmenu="return false;" onkeydown="return false;" ondragstart="return false;" onselectstart="return false;">

<x-header>{{ $title }}</x-header>

<body id="page-top" oncontextmenu="return false;" onkeydown="return false;">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <x-topbar></x-topbar>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    
                    <h1 class="h5 mb-4 text-gray-800 text-center">Pemilihan Raya Mahasiswa Teknik Informatika</h1> <!-- Added title here -->

                    @if ($candidates->isEmpty())
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="card shadow">
                                    <div class="card-body text-center">
                                        <p class="lead">No candidates available at the moment.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Candidate Page -->
                        <div id="candidatePage" class="row justify-content-center">
                            @foreach ($candidates as $candidate)
                                <div class="col-lg-8 col-md-10 col-sm-12 mb-4 candidate-card">
                                    <div class="card shadow h-100">
                                        <div class="card-header bg-primary py-3">
                                            <h6 class="m-0 font-weight-bold text-white">
                                                {{ $candidate->election_number }} | {{ $candidate->name }}
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4 mb-3 mb-md-0">
                                                    <img class="img-fluid rounded"
                                                        style="max-width: 100%; height: auto;"
                                                        src="{{ asset('storage/candidate-pictures/' . $candidate->picture) }}"
                                                        alt="Candidate Picture">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="mb-3">
                                                        <h5>Visi:</h5>
                                                        <p class="vision-text">{{ $candidate->vision }}</p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h5>Misi:</h5>
                                                        <p class="mission-text">{{ $candidate->mission }}</p>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <a href="{{ route('voter.show', $candidate->id) }}"
                                                                target="_blank" class="btn btn-warning btn-block">View
                                                                CV</a>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <form action="{{ route('voter.store') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="candidate_id"
                                                                    value="{{ $candidate->id }}">
                                                                <button type="submit"
                                                                    class="btn btn-success btn-block">Vote</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <!-- Display Election Number -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Navigation Buttons -->
                        <div class="row justify-content-center mt-4">
                            <div class="col-md-6 text-center">
                                <button id="prevButton" class="btn btn-primary mr-2" style="display: none;">
                                    <i class="fas fa-arrow-left"></i> <!-- Icon for Previous -->
                                </button>
                                <button id="nextButton" class="btn btn-primary ml-2">
                                    <i class="fas fa-arrow-right"></i> <!-- Icon for Next -->
                                </button>
                            </div>
                        </div>

                    @endif
                </div>
                <!-- /.container-fluid -->

                <div style="height: 30px;"></div>

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('template/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('template/js/disablerightclick.js') }}"></script>
    <script>
        $(document).ready(function() {
            var currentPage = 0; // Start from 0 for indexing
            var totalCandidates = {{ $candidates->count() }};
            var totalPages = totalCandidates;

            // Hide all candidates initially
            $('.candidate-card').hide();

            // Show the first candidate
            showCandidate(currentPage);

            // Handle next button click
            $('#nextButton').on('click', function() {
                currentPage++;
                showCandidate(currentPage);
                updateNavigationButtons();
            });

            // Handle previous button click
            $('#prevButton').on('click', function() {
                currentPage--;
                showCandidate(currentPage);
                updateNavigationButtons();
            });

            // Function to show candidate for a specific page
            function showCandidate(index) {
                $('.candidate-card').hide();
                $('.candidate-card').eq(index).show();
            }

            // Function to update navigation buttons visibility
            function updateNavigationButtons() {
                if (currentPage <= 0) {
                    $('#prevButton').hide();
                } else {
                    $('#prevButton').show();
                }

                if (currentPage >= totalPages - 1) {
                    $('#nextButton').hide();
                } else {
                    $('#nextButton').show();
                }
            }
        });
        const observer = new MutationObserver((mutations) => {
            mutations.forEach((mutation) => {
                if (mutation.addedNodes.length) {
                    mutation.addedNodes.forEach((node) => {
                        if (node.tagName === 'SCRIPT' && node.id === 'allow-copy_script') {
                            node.parentNode.removeChild(node);
                            console.log('Unauthorized script removed!');
                        }
                    });
                }
            });
        });

        observer.observe(document, {
            childList: true,
            subtree: true
        });
    </script>

</body>

</html>