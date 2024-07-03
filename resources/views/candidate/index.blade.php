<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h4 class="mb-0 text-primary">Daftar Kandidat Pemilihan Raya</h4>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" data-toggle="modal"
            data-target="#addCandidateModal">
            <i class="fas fa-plus fa-sm mr-1"></i> Tambah
        </a>
    </div>

    <!-- Alert -->
    @if ($errors->any() || session('message'))
    <div class="alert alert-{{ $errors->any() ? 'danger' : 'success' }} alert-dismissible fade show mx-auto my-4"
        role="alert">
        @foreach ($errors->all() as $error)
        <strong>{{ $error }}</strong><br>
        @endforeach
        @if (session('message'))
        {{ session('message') }}
        @endif
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <!-- DataTables Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Kandidat</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama1 - Nama2</th>
                            <th>Gambar</th>
                            <th>Visi</th>
                            <th>Misi</th>
                            <th>CV</th>
                            <th>Nomer Pemilihan</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($candidates as $candidate)
                        <tr>
                            <td>{{ $candidate->name }}</td>
                            <td>
                                <img src="{{ asset('storage/candidate-pictures/' . $candidate->picture) }}"
                                    alt="Candidate Picture" width="100">
                            </td>
                            <td>{{str_limit($candidate->vision, $limit=20, $end='...')}}</td>
                            <td>{{str_limit($candidate->mission, $limit=20, $end='...')}}</td>
                            <td>
                                <a href="{{ route('candidate.show', $candidate->id) }}" target="_blank"
                                    class="btn btn-primary btn-sm">CV</a>
                            </td>
                            <td>{{ $candidate->election_number }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm btn-block mb-2" data-toggle="modal"
                                    data-target="#editCandidateModal" data-id="{{ $candidate->id }}"
                                    data-name="{{ $candidate->name }}"
                                    data-election_number="{{ $candidate->election_number }}"
                                    data-picture="{{ $candidate->picture }}" data-resume="{{ $candidate->resume }}"
                                    aria-label="Edit Candidate {{ $candidate->name }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('candidate.destroy', $candidate->id) }}" method="post"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm btn-block"
                                        onclick="return confirm('Are you sure you want to delete this data?')"
                                        aria-label="Delete Candidate {{ $candidate->name }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Candidate Modal -->
    <div class="modal fade" id="addCandidateModal" tabindex="-1" aria-labelledby="addCandidateModalLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="addCandidateModalLabel">Tambah Kandidat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('candidate.store') }}" method="post" id="addCandidateForm"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name1 - Nama2</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="picture">Gambar</label>
                            <input type="file" class="form-control" id="picture" name="picture" accept="image/*"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="vision">Visi</label>
                            <input type="text" class="form-control" id="vision" name="vision"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="mission">Misi</label>
                            <input type="text" class="form-control" id="mission" name="mission" required>
                        </div>
                        <div class="form-group">
                            <label for="resume">CV</label>
                            <input type="file" class="form-control" id="resume" name="resume" accept="application/pdf"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="election_number">Nomer Pemilihan</label>
                            <input type="number" class="form-control" id="election_number" name="election_number"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="createBtn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Candidate Modal -->
    <div class="modal fade" id="editCandidateModal" tabindex="-1" aria-labelledby="editCandidateModalLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="editCandidateModalLabel">Edit Kandidat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editCandidateForm" method="post"
                    action="{{ isset($row) ? route('candidate.update', $row->id) : route('candidate.update', '') }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editId" name="id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="editName">Nama1 - Nama2</label>
                            <input type="text" class="form-control" id="editName" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="editPicture">Gambar</label>
                            <input type="file" class="form-control" id="editPicture" name="picture" accept="image/*">
                            <small class="form-text text-muted">Biarkan kosong jika Anda tidak ingin mengubah gambar.</small>
                            <label>Gambar Sekarang</label>
                            <img id="editPicturePreview" class="img-thumbnail">
                        </div>
                        <div class="form-group">
                            <label for="editVisi">Visi</label>
                            <input type="text" class="form-control" id="editVisi" name="vision" required>
                        </div>
                        <div class="form-group">
                            <label for="editMisi">Misi</label>
                            <input type="text" class="form-control" id="editMisi" name="mission" required>
                        </div>
                        <div class="form-group">
                            <label for="editResume">CV</label>
                            <input type="file" class="form-control" id="editResume" name="resume"
                                accept="application/pdf">
                            <small class="form-text text-muted">Biarkan kosong jika Anda tidak ingin mengubah
                            CV.</small>
                            <label>CV Sekarang</label>
                            <span id="editResumePreview"></span>
                        </div>
                        <div class="form-group">
                            <label for="editElectionNumber">Nomer Pemilihan</label>
                            <input type="number" class="form-control" id="editElectionNumber" name="election_number"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-layout>

<script>
    $('#editCandidateModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var name = button.data('name');
        var electionNumber = button.data('election_number');
        var picture = button.data('picture');
        var vision = button.data('vision');
        var mission = button.data('mission');
        var resume = button.data('resume');

        $('#editName').val(name);
        $('#editElectionNumber').val(electionNumber);
        $('#editId').val(id);
        $('#editPicturePreview').attr('src', '{{ asset("storage/app/public/candidate-pictures/") }}' + '/' + picture);
        $('#editVisi').val(vision);
        $('#editMisi').val(mission);
        $('#editResumePreview').text(resume);

        $('#editCandidateForm').attr('action', '/candidate/' + id).attr('enctype', 'multipart/form-data');
    });
</script>
