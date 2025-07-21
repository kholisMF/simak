@php
    $adminName = session('nama') ?? 'Admin';
    $photo = session('foto') ?? asset('/img/default-user.png');
@endphp

<div class="navbar-custom shadow-sm">
    <div class="d-flex justify-content-between align-items-center w-100">
        <div>
            <h5 class="mb-0 text-light">{{ $pageTitle ?? '' }}</h5>
        </div>

        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ $photo }}" alt="User" width="35" height="35" class="rounded-circle object-fit-cover">
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-user shadow" style="background-color: #777777">
                <li class="text-center p-2">
                    <img src="{{ $photo }}" class="rounded mb-2" alt="User">
                    <div><strong class="text-light">{{ $adminName }}</strong></div>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-center text-info" href="#">Profil</a></li>
                <li><a class="dropdown-item text-center text-danger" href="{{ route('logout') }}">Logout</a></li>
            </ul>
        </div>
    </div>
</div>