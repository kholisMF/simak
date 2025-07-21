@extends('layouts.app')

@section('content')
<div class="container">
    <form id="userForm" method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" name="nama" id="nama" required>
            </div>
            <div class="col-md-6">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="username" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email">
            </div>
            <div class="col-md-6">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" name="password" id="password" required>
                    <div class="input-group-append">
                        <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                            <i class="fa fa-eye-slash" id="eyeIcon"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="level" class="form-label">Level</label>
                <select name="level" id="level" class="form-control" required>
                    <option value="">-- User Sebagai --</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->level }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="photo">Foto</label>
                <div class="row">
                    <div class="col-md-9">
                        <input type="file" name="photo" id="photo" class="form-control @error('photo') is-invalid @enderror" accept=".jpg,.jpeg,.png">
                        @error('photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <img id="preview-image" src="{{ asset('img/default-user.png') }}" alt="Preview" width="90" height="90" class="rounded shadow">
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-success me-2">
                <i class="bi bi-save me-1"></i> Simpan
            </button>
            <a href="#" onclick="window.history.back(); return false;" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggle = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        toggle.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            eyeIcon.classList.toggle('fa-eye');
            eyeIcon.classList.toggle('fa-eye-slash');
        });
    });

    document.getElementById("photo").addEventListener("change", function(event) {
        const [file] = event.target.files;
        if (file) {
            document.getElementById("preview-image").src = URL.createObjectURL(file);
        }
    });

    document.getElementById("userForm").addEventListener("submit", function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Simpan Data?',
            text: "Pastikan data sudah benar!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Simpan',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Menyimpan...',
                    html: `
                        <div class="progress mt-3" style="height: 25px;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 100%">
                                Memproses data...
                            </div>
                        </div>
                    `,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                        document.getElementById("userForm").submit();
                    }
                });
            }
        });
    });
</script>

@if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Validasi Gagal',
            html: '{!! implode("<br>", $errors->all()) !!}'
        });
    </script>
@endif

@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session("success") }}',
        timer: 2000,
        showConfirmButton: false
    });
</script>
@endif

@endpush