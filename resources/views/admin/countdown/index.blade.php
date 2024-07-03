<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-primary">Atur Tanggal Countdown Pembukaan Hasil</h1>
    </div>

    <!-- Alert -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Countdown Form -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.countdown.update') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="target_date">Tanggal</label>
                    <input type="datetime-local" class="form-control" id="target_date" name="target_date" value="{{ $countdown ? $countdown->target_date->format('Y-m-d\TH:i') : '' }}" required>
                </div>
                <button type="submit" class="btn btn-success">Update</button>
            </form>
        </div>
    </div>

</x-layout>