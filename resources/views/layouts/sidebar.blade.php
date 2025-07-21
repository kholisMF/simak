@php
use App\Models\Menu;
$menus = Menu::getActiveMenus();
@endphp

<div class="sidebar">
    <div class="sidebar-header text-center p-1">
        <img src="{{ asset('img/si_mak.png') }}" alt="SIMAK" width="140" height="42.5">
    </div>
    <div class="sidebar-menu">
        @foreach($menus as $menu)
            @if($menu->children->isEmpty())
                <a href="{{ url($menu->route) }}">
                    <i class="bi {{ $menu->icon }}"></i> {{ $menu->title }}
                </a>
            @else
                <div class="dropdown">
                    <a class="dropdown-toggle d-block px-3 py-2 text-white" href="#" data-bs-toggle="dropdown">
                        <i class="bi {{ $menu->icon }}"></i> {{ $menu->title }}
                    </a>
                    <ul class="dropdown-menu bg-dark border-0">
                        @foreach ($menu->children->where('is_active', 1) as $submenu)
                            <li class="nav-item">
                                <a class="dropdown-item text-white" href="{{ url($submenu->route) }}">
                                    <i class="bi {{ $submenu->icon }}"></i> {{ $submenu->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        @endforeach
    </div>
</div>
