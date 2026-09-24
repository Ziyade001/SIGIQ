<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm border-bottom sticky-top">

    <div class="container-fluid px-4">

        <!-- LOGO -->
        <a class="navbar-brand d-flex align-items-center gap-2"
           href="{{ route('dashboard') }}">

            <img src="{{ asset('/img/favicon1.png') }}"
                 alt="SIGIQ"
                 style="height: 42px; object-fit: contain;">

            <div class="d-flex flex-column">

                <span class="fw-bold text-dark">
                    SIGIQ
                </span>

                <small class="text-muted" style="font-size: 11px;">
                    Système de suivi des inspections
                </small>

            </div>

        </a>

        <!-- MOBILE BUTTON -->
        <button class="navbar-toggler border-0 shadow-none"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mainNavbar"
                aria-controls="mainNavbar"
                aria-expanded="false"
                aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>

        </button>

        <!-- NAVBAR CONTENT -->
        <div class="collapse navbar-collapse"
             id="mainNavbar">

            <!-- LEFT LINKS -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">

                <!-- DASHBOARD -->
                <li class="nav-item">

                    <a class="nav-link fw-medium {{ request()->routeIs('dashboard') ? 'active text-success' : 'text-dark' }}"
                       href="{{ route('dashboard') }}">

                        <i class="bi bi-speedometer2 me-1"></i>
                        Dashboard

                    </a>

                </li>

                <!-- ADMIN -->
                @if(auth()->user()->role === 'admin')

                    <li class="nav-item">

                        <a class="nav-link text-dark"
                           href="#">

                            <i class="bi bi-people me-1"></i>
                            Utilisateurs

                        </a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link text-dark"
                           href="#">

                            <i class="bi bi-clipboard-check me-1"></i>
                            Inspections

                        </a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link text-dark"
                           href="#">

                            <i class="bi bi-file-earmark-text me-1"></i>
                            Rapports

                        </a>

                    </li>

                @endif

                <!-- DG -->
                @if(auth()->user()->role === 'dg')

                    <li class="nav-item">

                        <a class="nav-link text-dark"
                           href="#">

                            <i class="bi bi-bar-chart-line me-1"></i>
                            Statistiques

                        </a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link text-dark"
                           href="#">

                            <i class="bi bi-journal-text me-1"></i>
                            Rapports stratégiques

                        </a>

                    </li>

                @endif

                <!-- INSPECTEUR -->
                @if(auth()->user()->role === 'inspecteur')

                    <li class="nav-item">

                        <a class="nav-link text-dark"
                           href="#">

                            <i class="bi bi-list-check me-1"></i>
                            Mes missions

                        </a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link text-dark"
                           href="#">

                            <i class="bi bi-exclamation-circle me-1"></i>
                            Observations

                        </a>

                    </li>

                @endif

            </ul>

            <!-- RIGHT SIDE -->
            <ul class="navbar-nav align-items-lg-center">

                <!-- ROLE BADGE -->
                <li class="nav-item me-lg-3 mb-2 mb-lg-0">

                    @if(auth()->user()->role === 'admin')

                        <span class="badge bg-primary px-3 py-2">
                            <i class="bi bi-person-gear me-1"></i>
                            Administrateur
                        </span>

                    @elseif(auth()->user()->role === 'dg')

                        <span class="badge bg-danger px-3 py-2">
                            <i class="bi bi-building me-1"></i>
                            Directeur Général
                        </span>

                    @elseif(auth()->user()->role === 'inspecteur')

                        <span class="badge bg-success px-3 py-2">
                            <i class="bi bi-person-check me-1"></i>
                            Technicien assermenté
                        </span>

                    @endif

                </li>

                <!-- USER DROPDOWN -->
                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle d-flex align-items-center fw-medium"
                       href="#"
                       id="userDropdown"
                       role="button"
                       data-bs-toggle="dropdown"
                       aria-expanded="false">

                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-2"
                             style="width: 36px; height: 36px;">

                            <i class="bi bi-person text-success"></i>

                        </div>

                        {{ Auth::user()->name }}

                    </a>

                    <!-- DROPDOWN MENU -->
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow rounded-3 p-2">

                        <li>

                            <a class="dropdown-item rounded-2 py-2"
                               href="{{ route('profile.edit') }}">

                                <i class="bi bi-person-circle me-2"></i>
                                Mon profil

                            </a>

                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>

                            <form method="POST"
                                  action="{{ route('logout') }}">

                                @csrf

                                <button type="submit"
                                        class="dropdown-item text-danger rounded-2 py-2">

                                    <i class="bi bi-box-arrow-right me-2"></i>
                                    Déconnexion

                                </button>

                            </form>

                        </li>

                    </ul>

                </li>

            </ul>

        </div>

    </div>

</nav>