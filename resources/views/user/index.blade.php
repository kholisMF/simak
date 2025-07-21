@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        @if ($currentLevel != 3)
        <a href="{{ route('user.create') }}" class="btn btn-success btn-sm">
            <i class="bi bi-plus-circle me-1"></i> Add User
        </a>
        @endif
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" id="success-alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-info">
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Level</th>
                    <th>Email</th>
                    @if ($currentLevel != 3)
                    <th colspan="2"></th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if($user->foto)
                                <img src="data:image/jpeg;base64,{{ base64_encode($user->foto) }}" width="40" height="40" class="rounded shadow">
                            @else
                                <img src="{{ asset('/img/default-user.png') }}" width="40" height="40" class="rounded shadow">
                            @endif
                        </td>
                        <td>{{ $user->nama }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->level_name }}</td>
                        <td>{{ $user->email ?? '-'}}</td>
                        @if ($currentLevel != 3)
                        <td>
                            @if ($currentLevel == 1)
                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-transparent me-1" title="Edit">
                                    <i class="bi bi-pencil-square text-warning"></i>
                                </a>
                                @if ($user->id != $currentUserId)
                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-transparent btn-sm btn-delete" data-id="{{ $user->id }}" title="hapus">
                                            <i class="bi bi-trash text-danger"></i>
                                        </button>
                                    </form>
                                @endif

                            @elseif ($currentLevel == 2)
                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-transparent me-1" title="Edit">
                                    <i class="bi bi-pencil-square text-warning"></i>
                                </a>
                            @endif
                        </td>
                        <td>
                            @if ($currentLevel != 3)
                                @if ($user->id != $currentUserId)
                                    <label class="switch">
                                        <input type="checkbox" class="toggle-active-user" data-id="{{ $user->id }}" {{ $user->flag_active ? '' : 'checked' }}>
                                        <span class="slider round"></span>
                                    </label>
                                @endif
                            @endif
                        </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-danger">Belum ada data user.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    setTimeout(function () {
        const alert = document.getElementById('success-alert');
        if (alert) {
            alert.classList.remove('show');
            alert.classList.add('fade');
            setTimeout(() => alert.remove(), 500);
        }
    }, 3000);

    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.btn-delete');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const userId = this.getAttribute('data-id');

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data user akan dihapus permanen.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Menghapus...',
                            html: `
                                <div style="display: flex; align-items: center; justify-content: center; flex-direction: column;">
                                    <i class="fas fa-trash fa-3x text-danger mb-3"></i>
                                    <div class="progress" style="width: 100%;">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" style="width: 100%"></div>
                                    </div>
                                </div>
                            `,
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            didOpen: () => {
                                // AJAX DELETE
                                fetch(`/user/${userId}`, {
                                    method: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                        'Accept': 'application/json'
                                    }
                                })
                                .then(response => {
                                    if (!response.ok) throw new Error('Gagal hapus');
                                    return response.json();
                                })
                                .then(data => {
                                    const row = document.getElementById(`row-${userId}`);
                                    if (row) row.remove();

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil!',
                                        text: 'Data berhasil dihapus.',
                                        timer: 2000,
                                        showConfirmButton: false
                                    });
                                })
                                .catch(error => {
                                    Swal.fire('Error', data.message, 'error');
                                });
                            }
                        });
                    }
                });
            });
        });
    });

    document.querySelectorAll('.toggle-active-user').forEach(function(toggle) {
        toggle.addEventListener('change', function(e) {
            e.preventDefault();
            const userId = this.dataset.id;
            const isChecked = this.checked;
            const toggleElement = this;

            Swal.fire({
                title: isChecked ? 'Aktifkan User?' : 'Non-Aktifkan User?',
                text: "Anda yakin ingin mengubah status user ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: isChecked ? '#28a745' : '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Lanjutkan!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch("{{ route('user.blokUser') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ id: userId })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('Berhasil!', data.message, 'success');
                        } else {
                            Swal.fire('Gagal!', data.message, 'error');
                            toggleElement.checked = !isChecked; // revert
                        }
                    })
                    .catch(() => {
                        Swal.fire('Gagal!', 'Terjadi kesalahan server.', 'error');
                        toggleElement.checked = !isChecked; // revert
                    });
                } else {
                    toggleElement.checked = !isChecked; // revert
                }
            });
        });
    });
</script>
@endpush