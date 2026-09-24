@php
    $user = auth()->user();
@endphp

<aside class="admin-sidebar" id="adminSidebar" aria-label="Navigation principale">

    <!-- LOGO -->
    <div class="sidebar-header">
        <a class="brand-mark" href="{{ route('index') }}" aria-label="SIGIQ Dashboard">

            <span class="brand1-icon">
                <img src="{{ asset('img/logo.png') }}"
                     alt="SIGIQ Logo"
                     style="width:42px;height:42px;object-fit:contain;">
            </span>

            <span class="brand-copy">
                <span class="brand-title">SIGIQ</span>
                <span class="brand-subtitle">Gestion des inspections</span>
            </span>

        </a>
    </div>

    <!-- NAVIGATION -->
    <nav class="sidebar-nav" style="
    padding: 0.75rem 0.75rem 1.5rem;
    flex: 1;
    overflow-y: auto;
">

    <!-- TABLEAU DE BORD -->
    <a href="{{ route('dashboard') }}"
       class="nav-link d-flex align-items-center gap-3 rounded-3 px-3 py-2 text-decoration-none
              {{ request()->routeIs('dashboard') ? 'active' : '' }}"
       style="
           font-size: 0.85rem;
           font-weight: 500;
           color: #495057;
           transition: all 0.15s;
           margin-bottom: 0.15rem;
           {{ request()->routeIs('dashboard') ? 'background: rgba(5,158,51,.10); color: #059e33;' : '' }}
       "
       onmouseover="this.style.background='#f8f9fc'"
       onmouseout="this.style.background='{{ request()->routeIs('dashboard') ? 'rgba(5,158,51,.10)' : 'transparent' }}'">

        <span class="nav-icon" style="
            display: flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            font-size: 1.1rem;
            flex-shrink: 0;
            {{ request()->routeIs('dashboard') ? 'color: #059e33;' : 'color: #6c757d;' }}
        ">
            <i class="bi bi-speedometer2"></i>
        </span>

        <span class="nav-text">
            Tableau de bord
        </span>

    </a>

    {{-- ================= ADMIN ================= --}}
    @if($user->role === 'admin')

        <div class="nav-separator" style="
            height: 1px;
            background: #e9ecef;
            margin: 0.5rem 0.75rem;
        "></div>

        <span class="nav-section-title" style="
            display: block;
            padding: 0.25rem 0.75rem 0.5rem;
            font-size: 0.6rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #adb5bd;
        ">
            Administration
        </span>

        <a href="{{ route('users.index') }}"
           class="nav-link d-flex align-items-center gap-3 rounded-3 px-3 py-2 text-decoration-none
                  {{ request()->routeIs('users.index') ? 'active' : '' }}"
           style="
               font-size: 0.85rem;
               font-weight: 500;
               color: #495057;
               transition: all 0.15s;
               margin-bottom: 0.15rem;
               {{ request()->routeIs('users.index') ? 'background: rgba(5,158,51,.10); color: #059e33;' : '' }}
           "
           onmouseover="this.style.background='#f8f9fc'"
           onmouseout="this.style.background='{{ request()->routeIs('users.index') ? 'rgba(5,158,51,.10)' : 'transparent' }}'">

            <span class="nav-icon" style="
                display: flex;
                align-items: center;
                justify-content: center;
                width: 28px;
                font-size: 1.1rem;
                flex-shrink: 0;
                {{ request()->routeIs('users.index') ? 'color: #059e33;' : 'color: #6c757d;' }}
            ">
                <i class="bi bi-people"></i>
            </span>

            <span class="nav-text">
                Utilisateurs
            </span>

        </a>

        <a href="{{ route('users.create') }}"
           class="nav-link d-flex align-items-center gap-3 rounded-3 px-3 py-2 text-decoration-none
                  {{ request()->routeIs('users.create') ? 'active' : '' }}"
           style="
               font-size: 0.85rem;
               font-weight: 500;
               color: #495057;
               transition: all 0.15s;
               margin-bottom: 0.15rem;
               {{ request()->routeIs('users.create') ? 'background: rgba(5,158,51,.10); color: #059e33;' : '' }}
           "
           onmouseover="this.style.background='#f8f9fc'"
           onmouseout="this.style.background='{{ request()->routeIs('users.create') ? 'rgba(5,158,51,.10)' : 'transparent' }}'">

            <span class="nav-icon" style="
                display: flex;
                align-items: center;
                justify-content: center;
                width: 28px;
                font-size: 1.1rem;
                flex-shrink: 0;
                {{ request()->routeIs('users.create') ? 'color: #059e33;' : 'color: #6c757d;' }}
            ">
                <i class="bi bi-person-plus"></i>
            </span>

            <span class="nav-text">
                Ajouter un utilisateur
            </span>

        </a>

    @endif

    {{-- ================= MODULES COMMUNS ================= --}}
    <div class="nav-separator" style="
        height: 1px;
        background: #e9ecef;
        margin: 0.5rem 0.75rem;
    "></div>

    <span class="nav-section-title" style="
        display: block;
        padding: 0.25rem 0.75rem 0.5rem;
        font-size: 0.6rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #adb5bd;
    ">
        Gestion
    </span>

    {{-- Missions --}}
    @if(in_array($user->role, ['admin', 'dt', 'dg', 'inspecteur']))

        <a href="{{ route('missions.index') }}"
           class="nav-link d-flex align-items-center gap-3 rounded-3 px-3 py-2 text-decoration-none
                  {{ request()->routeIs('missions.*') ? 'active' : '' }}"
           style="
               font-size: 0.85rem;
               font-weight: 500;
               color: #495057;
               transition: all 0.15s;
               margin-bottom: 0.15rem;
               {{ request()->routeIs('missions.*') ? 'background: rgba(5,158,51,.10); color: #059e33;' : '' }}
           "
           onmouseover="this.style.background='#f8f9fc'"
           onmouseout="this.style.background='{{ request()->routeIs('missions.*') ? 'rgba(5,158,51,.10)' : 'transparent' }}'">

            <span class="nav-icon" style="
                display: flex;
                align-items: center;
                justify-content: center;
                width: 28px;
                font-size: 1.1rem;
                flex-shrink: 0;
                {{ request()->routeIs('missions.*') ? 'color: #059e33;' : 'color: #6c757d;' }}
            ">
                <i class="bi bi-briefcase"></i>
            </span>

            <span class="nav-text">
                {{ $user->role === 'inspecteur' ? 'Mes missions' : 'Missions' }}
            </span>

        </a>

    @endif

    {{-- Inspections --}}
    @if(in_array($user->role, ['admin', 'dt', 'inspecteur']))

        <a href="{{ route('inspections.index') }}"
           class="nav-link d-flex align-items-center gap-3 rounded-3 px-3 py-2 text-decoration-none
                  {{ request()->routeIs('inspections.*') ? 'active' : '' }}"
           style="
               font-size: 0.85rem;
               font-weight: 500;
               color: #495057;
               transition: all 0.15s;
               margin-bottom: 0.15rem;
               {{ request()->routeIs('inspections.*') ? 'background: rgba(5,158,51,.10); color: #059e33;' : '' }}
           "
           onmouseover="this.style.background='#f8f9fc'"
           onmouseout="this.style.background='{{ request()->routeIs('inspections.*') ? 'rgba(5,158,51,.10)' : 'transparent' }}'">

            <span class="nav-icon" style="
                display: flex;
                align-items: center;
                justify-content: center;
                width: 28px;
                font-size: 1.1rem;
                flex-shrink: 0;
                {{ request()->routeIs('inspections.*') ? 'color: #059e33;' : 'color: #6c757d;' }}
            ">
                <i class="bi bi-clipboard-check"></i>
            </span>

            <span class="nav-text">
                {{ $user->role === 'inspecteur' ? 'Mes inspections' : 'Inspections' }}
            </span>

        </a>

    @endif

    {{-- Rapports --}}
    @if(in_array($user->role, ['admin', 'dt', 'dg', 'inspecteur']))

        <a href="{{ route('rapports.index') }}"
           class="nav-link d-flex align-items-center gap-3 rounded-3 px-3 py-2 text-decoration-none
                  {{ request()->routeIs('rapports.*') ? 'active' : '' }}"
           style="
               font-size: 0.85rem;
               font-weight: 500;
               color: #495057;
               transition: all 0.15s;
               margin-bottom: 0.15rem;
               {{ request()->routeIs('rapports.*') ? 'background: rgba(5,158,51,.10); color: #059e33;' : '' }}
           "
           onmouseover="this.style.background='#f8f9fc'"
           onmouseout="this.style.background='{{ request()->routeIs('rapports.*') ? 'rgba(5,158,51,.10)' : 'transparent' }}'">

            <span class="nav-icon" style="
                display: flex;
                align-items: center;
                justify-content: center;
                width: 28px;
                font-size: 1.1rem;
                flex-shrink: 0;
                {{ request()->routeIs('rapports.*') ? 'color: #059e33;' : 'color: #6c757d;' }}
            ">
                <i class="bi bi-journal-text"></i>
            </span>

            <span class="nav-text">
                @if($user->role === 'dg')
                    Rapports de mission
                @elseif($user->role === 'inspecteur')
                    Rapports soumis
                @else
                    Rapports de mission
                @endif
            </span>

        </a>

    @endif

    {{-- Amendes --}}
    @if(in_array($user->role, ['admin', 'dt', 'dg', 'inspecteur']))

        <a href="{{ route('amendes.index') }}"
           class="nav-link d-flex align-items-center gap-3 rounded-3 px-3 py-2 text-decoration-none
                  {{ request()->routeIs('amendes.*') ? 'active' : '' }}"
           style="
               font-size: 0.85rem;
               font-weight: 500;
               color: #495057;
               transition: all 0.15s;
               margin-bottom: 0.15rem;
               {{ request()->routeIs('amendes.*') ? 'background: rgba(5,158,51,.10); color: #059e33;' : '' }}
           "
           onmouseover="this.style.background='#f8f9fc'"
           onmouseout="this.style.background='{{ request()->routeIs('amendes.*') ? 'rgba(5,158,51,.10)' : 'transparent' }}'">

            <span class="nav-icon" style="
                display: flex;
                align-items: center;
                justify-content: center;
                width: 28px;
                font-size: 1.1rem;
                flex-shrink: 0;
                {{ request()->routeIs('amendes.*') ? 'color: #059e33;' : 'color: #6c757d;' }}
            ">
                <i class="bi bi-cash-stack"></i>
            </span>

            <span class="nav-text">
                @if($user->role === 'dg')
                    Situation des amendes
                @elseif($user->role === 'inspecteur')
                    Gérer les amendes
                @else
                    Amendes
                @endif
            </span>

        </a>

    @endif

    {{-- Convocations --}}
    @if(in_array($user->role, ['admin', 'dt', 'inspecteur']))

        <a href="{{ route('convocations.index') }}"
           class="nav-link d-flex align-items-center gap-3 rounded-3 px-3 py-2 text-decoration-none
                  {{ request()->routeIs('convocations.*') ? 'active' : '' }}"
           style="
               font-size: 0.85rem;
               font-weight: 500;
               color: #495057;
               transition: all 0.15s;
               margin-bottom: 0.15rem;
               {{ request()->routeIs('convocations.*') ? 'background: rgba(5,158,51,.10); color: #059e33;' : '' }}
           "
           onmouseover="this.style.background='#f8f9fc'"
           onmouseout="this.style.background='{{ request()->routeIs('convocations.*') ? 'rgba(5,158,51,.10)' : 'transparent' }}'">

            <span class="nav-icon" style="
                display: flex;
                align-items: center;
                justify-content: center;
                width: 28px;
                font-size: 1.1rem;
                flex-shrink: 0;
                {{ request()->routeIs('convocations.*') ? 'color: #059e33;' : 'color: #6c757d;' }}
            ">
                <i class="bi bi-file-earmark-medical"></i>
            </span>

            <span class="nav-text">
                Convocations
            </span>

        </a>

    @endif

    {{-- ================= PROFIL ================= --}}
    <div class="nav-separator" style="
        height: 1px;
        background: #e9ecef;
        margin: 0.5rem 0.75rem;
    "></div>

    <span class="nav-section-title" style="
        display: block;
        padding: 0.25rem 0.75rem 0.5rem;
        font-size: 0.6rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #adb5bd;
    ">
        Compte
    </span>

    <a href="{{ route('profile.show') }}"
       class="nav-link d-flex align-items-center gap-3 rounded-3 px-3 py-2 text-decoration-none
              {{ request()->routeIs('profile.*') ? 'active' : '' }}"
       style="
           font-size: 0.85rem;
           font-weight: 500;
           color: #495057;
           transition: all 0.15s;
           margin-bottom: 0.15rem;
           {{ request()->routeIs('profile.*') ? 'background: rgba(5,158,51,.10); color: #059e33;' : '' }}
       "
       onmouseover="this.style.background='#f8f9fc'"
       onmouseout="this.style.background='{{ request()->routeIs('profile.*') ? 'rgba(5,158,51,.10)' : 'transparent' }}'">

        <span class="nav-icon" style="
            display: flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            font-size: 1.1rem;
            flex-shrink: 0;
            {{ request()->routeIs('profile.*') ? 'color: #059e33;' : 'color: #6c757d;' }}
        ">
            <i class="bi bi-person-badge"></i>
        </span>

        <span class="nav-text">
            Mon profil
        </span>

    </a>

</nav>

{{-- Styles d'optimisation pour la sidebar --}}


    <div class="sidebar-footer">

        SIGIQ v1.0

    </div>

</aside>

<style>
    /* Scrollbar personnalisée */
    .sidebar-nav::-webkit-scrollbar {
        width: 4px;
    }

    .sidebar-nav::-webkit-scrollbar-track {
        background: transparent;
    }

    .sidebar-nav::-webkit-scrollbar-thumb {
        background: #e9ecef;
        border-radius: 4px;
    }

    .sidebar-nav::-webkit-scrollbar-thumb:hover {
        background: #ced4da;
    }

    /* Active state avec indicateur */
    .nav-link.active {
        position: relative;
    }

    .nav-link.active::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 3px;
        height: 20px;
        background: #059e33;
        border-radius: 0 4px 4px 0;
    }

    /* Transition douce */
    .nav-link {
        transition: background 0.15s, color 0.15s, transform 0.1s;
    }

    .nav-link:active {
        transform: scale(0.97);
    }

    /* Section titles */
    .nav-section-title {
        font-family: inherit;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .sidebar-nav {
            padding: 0.5rem 0.5rem 1rem;
        }

        .nav-link {
            font-size: 0.8rem !important;
            padding: 0.4rem 0.75rem !important;
        }

        .nav-icon {
            width: 24px !important;
            font-size: 1rem !important;
        }
    }
</style>