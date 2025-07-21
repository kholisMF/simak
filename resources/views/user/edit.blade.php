@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <form id="editForm" action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" value="{{ $user->nama }}" required>
            </div>
            <div class="col-md-6">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" value="{{ $user->username }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}">
            </div>
            <div class="col-md-6">
                <label for="password" class="form-label">Password Baru (Opsional)</label>
                <div class="input-group">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Biarkan kosong jika tidak ingin mengganti password">
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
                        <option value="{{ $role->id }}" {{ $user->level == $role->id ? 'selected' : '' }}>
                            {{ $role->level }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="foto" class="form-label">Foto (opsional)</label><br>
                <div class="row">
                    <div class="col-md-9">
                        <input type="file" name="foto" id="foto" class="form-control">
                    </div>
                    <div class="col-md-3">
                        @if ($user->foto)
                            <img id="preview-image" src="data:image/jpeg;base64,{{ base64_encode($user->foto) }}" width="90" height="90" class="mb-2 rounded shadow">
                        @else
                            <img id="preview-image" src="{{ asset('/img/default-user.png') }}" width="90" height="90" class="mb-2 rounded shadow">
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-success me-2">Update</button>
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

    document.getElementById('foto').addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const preview = document.getElementById('preview-image');
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    document.getElementById("editForm").addEventListener("submit", function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Update Data?',
            text: "Pastikan data sudah benar!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Update',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Update data...',
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
                        document.getElementById("editForm").submit();
                    }
                });
            }
        });
    });
</script>
@endpush