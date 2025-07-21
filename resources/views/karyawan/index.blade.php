@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('karyawan.create') }}" class="btn btn-success btn-sm">
            <i class="bi bi-plus-circle sm-1"></i>
        </a>
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
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Departemen</th>
                    <th>Domisili</th>
                    <th>Foto</th>
                </tr>
            </thead>
            <tbody>
                {{-- @forelse ($users as $index => $user)
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
                @empty --}}
                    <tr>
                        <td colspan="7" class="text-center text-danger">Belum ada data karyawan.</td>
                    </tr>
                {{-- @endforelse --}}
            </tbody>
        </table>
    </div>
</div>
@endsection