<nav class="navbar admin-navbar navbar-expand bg-white shadow-sm border-bottom">

    <div class="container-fluid px-3 px-lg-4">

        {{-- Sidebar Toggle --}}
        <button class="sidebar-toggle me-3"
                type="button"
                data-sidebar-toggle
                aria-controls="adminSidebar"
                aria-expanded="true">

            <span></span>
            <span></span>
            <span></span>

        </button>


        {{-- Actions --}}
        <div class="d-flex align-items-center gap-3 ms-auto">

            {{-- Theme Toggle --}}
            <button class="icon-button theme-toggle"
                    type="button"
                    data-theme-toggle
                    title="Changer le thème">

                <i class="bi bi-moon-stars" data-theme-icon></i>

            </button>

            {{-- User Profile --}}
@php
    $user = auth()->user();
@endphp

<div class="dropdown">

    <button class="profile-button border-0 bg-transparent d-flex align-items-center gap-2 rounded-3 px-2 py-1"
            type="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
            style="
                transition: background 0.15s;
                cursor: pointer;
                white-space: nowrap;
            "
            onmouseover="this.style.background='#f8f9fc'"
            onmouseout="this.style.background='transparent'">

        {{-- Avatar --}}
        <div class="profile-avatar-wrapper" style="position: relative; display: inline-block;">

            @if($user->photo)

                <img src="{{ asset('storage/'.$user->photo) }}"
                     style="
                        width: 38px;
                        height: 38px;
                        border-radius: 50%;
                        object-fit: cover;
                        border: 2px solid #059e33;
                     "
                     alt="{{ $user->name }}">

            @else

                <span style="
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    width: 38px;
                    height: 38px;
                    border-radius: 50%;
                    background: rgba(5,158,51,.12);
                    color: #059e33;
                    font-size: 1.2rem;
                ">
                    <i class="bi bi-person"></i>
                </span>

            @endif

            {{-- Indicateur en ligne --}}
            <span class="online-dot" style="
                display: inline-block;
                width: 10px;
                height: 10px;
                border-radius: 50%;
                background: #059e33;
                border: 2px solid #fff;
                position: absolute;
                bottom: -1px;
                right: -1px;
            "></span>

        </div>

        {{-- Name & Role --}}
        <div class="text-start d-none d-lg-block">
            <div class="fw-semibold text-dark" style="font-size: 0.85rem; line-height: 1.2;">
                {{ $user->name }}
            </div>
            <div style="font-size: 0.65rem; color: #6c757d; text-transform: capitalize;">
                {{ $user->role }}
            </div>
        </div>

        <i class="bi bi-chevron-down text-muted" style="font-size: 0.7rem; margin-left: 2px;"></i>

    </button>

    {{-- User Menu --}}
    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3 py-2"
        style="
            min-width: 220px;
            margin-top: 8px;
            animation: dropdownSlide 0.2s ease;
        ">

        {{-- En-tête du dropdown --}}
        <li class="px-3 py-2 border-bottom" style="border-color: #f1f3f5 !important;">

            <div class="fw-semibold" style="font-size: 0.9rem;">
                {{ $user->name }}
            </div>

            <small class="text-muted d-block" style="font-size: 0.75rem; margin-top: 1px;">
                {{ $user->email }}
            </small>

            <span class="badge rounded-pill mt-1 px-2 py-1"
                  style="
                      background-color: rgba(22,131,255,.12);
                      color: #1683ff;
                      font-size: 0.6rem;
                      font-weight: 600;
                      text-transform: uppercase;
                  ">
                {{ $user->role }}
            </span>

        </li>

        {{-- Mon profil --}}
        <li>
            <a class="dropdown-item d-flex align-items-center gap-2 px-3 py-2"
               href="{{ route('profile.show') }}"
               style="
                   font-size: 0.85rem;
                   color: #495057;
                   transition: background 0.15s;
               "
               onmouseover="this.style.background='#f8f9fc'"
               onmouseout="this.style.background='transparent'">

                <i class="bi bi-person-circle" style="font-size: 1rem; color: #6c757d;"></i>
                Mon profil

            </a>
        </li>

        {{-- Séparateur --}}
        <li><hr class="dropdown-divider" style="border-color: #f1f3f5; margin: 0.25rem 0;"></li>

        {{-- Déconnexion --}}
        <li>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                        class="dropdown-item d-flex align-items-center gap-2 px-3 py-2 text-danger"
                        style="
                            font-size: 0.85rem;
                            background: transparent;
                            border: none;
                            width: 100%;
                            transition: background 0.15s;
                            cursor: pointer;
                        "
                        onmouseover="this.style.background='#f8f9fc'"
                        onmouseout="this.style.background='transparent'">

                    <i class="bi bi-box-arrow-right" style="font-size: 1rem;"></i>
                    Déconnexion

                </button>

            </form>

        </li>

    </ul>

            </div>

        </div>

    </div>

</nav>

