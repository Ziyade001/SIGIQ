@extends('dashboards.index')

@section('content')

<main class="dashboard-content">

    <div class="container-fluid px-3 px-lg-4 py-4">

        <!-- PAGE HEADER -->
        <div class="page-heading d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">

            <div class="page-heading-copy d-flex align-items-center gap-3 section-title">

                <span class="page-icon">
                    <i class="bi bi-person-circle" aria-hidden="true"></i>
                </span>

                <div>

                    <nav aria-label="breadcrumb" class="mb-1">
                        <ol class="breadcrumb mb-0" style="font-size: 0.8rem;">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    Tableau de bord
                                </a>
                            </li>
                            <li class="breadcrumb-item active text-secondary" aria-current="page">
                                Profil
                            </li>
                        </ol>
                    </nav>

                    <h1 class="h3 mb-1 fw-bold">
                        Mon profil
                    </h1>

                    <p class="text-muted mb-0" style="font-size: 0.9rem;">
                        Gérez vos informations personnelles et professionnelles.
                    </p>

                </div>

            </div>

            <div class="heading-actions">

                <a href="{{ route('profile.edit') }}"
                           class="btn btn-outline-primary btn-sm rounded-pill px-3"
                           style="font-weight: 500;">
                            <i class="bi bi-pencil-square me-1"></i>
                            Modifier
                        </a>

            </div>

        </div>

        <!-- CONTENU PRINCIPAL -->
        <div class="row g-4">

            <!-- COLONNE GAUCHE : PROFIL -->
            <div class="col-12 col-lg-4">

                <div class="panel card border-0 shadow-sm rounded-4 text-center">

                    <div class="card-body p-4">

                        <!-- Photo de profil -->
                        <div class="mb-3">

                            @if($user->photo)

                                <img src="{{ asset('storage/'.$user->photo) }}"
                                     class="rounded-circle border border-3"
                                     width="140"
                                     height="140"
                                     style="object-fit: cover; border-color: #e9ecef !important;"
                                     alt="Photo de {{ $user->name }}">

                            @else

                                <div class="d-flex align-items-center justify-content-center mx-auto rounded-circle bg-light"
                                     style="width: 140px; height: 140px; color: #6c757d;">
                                    <i class="bi bi-person-circle" style="font-size: 120px;"></i>
                                </div>

                            @endif

                        </div>

                        <h4 class="fw-bold mb-1" style="font-size: 1.2rem;">
                            {{ $user->name }}
                        </h4>

                        <p class="text-muted mb-2" style="font-size: 0.9rem;">
                            {{ $user->fonction }}
                        </p>

                        <span class="badge rounded-pill px-4 py-2"
                              style="background-color:rgba(22,131,255,.12); color:#1683ff; font-weight: 600; font-size: 0.7rem;">
                            {{ strtoupper($user->role) }}
                        </span>

                        <hr class="my-3" style="border-color: #f1f3f5;">

                        <div class="text-start" style="font-size: 0.9rem;">

                            <div class="mb-2 d-flex justify-content-between">
                                <span class="text-muted fw-semibold" style="font-size: 0.75rem; letter-spacing: 0.03em;">
                                    Matricule
                                </span>
                                <span class="fw-semibold">{{ $user->matricule }}</span>
                            </div>

                            <div class="mb-2 d-flex justify-content-between">
                                <span class="text-muted fw-semibold" style="font-size: 0.75rem; letter-spacing: 0.03em;">
                                    Email
                                </span>
                                <span class="fw-semibold" style="font-size: 0.85rem;">{{ $user->email }}</span>
                            </div>

                            <div class="d-flex justify-content-between">
                                <span class="text-muted fw-semibold" style="font-size: 0.75rem; letter-spacing: 0.03em;">
                                    Téléphone
                                </span>
                                <span>{{ $user->telephone ?? '-' }}</span>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- COLONNE DROITE : INFORMATIONS -->
            <div class="col-12 col-lg-8">

                <div class="panel card border-0 shadow-sm rounded-4">

                    <div class="card-header bg-transparent border-0 d-flex flex-wrap align-items-center justify-content-between gap-2 px-4 pt-4 pb-3">

                        <div>

                            <h2 class="h5 mb-1 fw-bold d-flex align-items-center gap-2 section-title">
                                <i class="bi bi-info-circle me-2"></i>
                                <span>Informations personnelles</span>
                            </h2>

                            <p class="text-muted mb-0" style="font-size: 0.85rem;">
                                Détails de votre compte utilisateur.
                            </p>

                        </div>

                    </div>

                    <div class="card-body px-4 pt-0 pb-4">

                        <div class="row g-3">

                            <div class="col-12 col-md-6">
                                <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                                    Nom complet
                                </label>
                                <p class="fw-semibold mb-0" style="font-size: 0.95rem;">
                                    {{ $user->name }}
                                </p>
                            </div>

                            <div class="col-12 col-md-6">
                                <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                                    Fonction
                                </label>
                                <p class="fw-semibold mb-0" style="font-size: 0.95rem;">
                                    {{ $user->fonction }}
                                </p>
                            </div>

                            <div class="col-12 col-md-6">
                                <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                                    Sexe
                                </label>
                                <p class="mb-0" style="font-size: 0.95rem;">
                                    {{ $user->sexe ?? '-' }}
                                </p>
                            </div>

                            <div class="col-12 col-md-6">
                                <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                                    Date de naissance
                                </label>
                                <p class="mb-0" style="font-size: 0.95rem;">
                                    {{ $user->date_naissance ? \Carbon\Carbon::parse($user->date_naissance)->format('d/m/Y') : '-' }}
                                </p>
                            </div>

                            <div class="col-12 col-md-6">
                                <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                                    Rôle
                                </label>
                                <p class="mb-0" style="font-size: 0.95rem;">
                                    <span class="badge rounded-pill px-3 py-1"
                                          style="background-color:rgba(22,131,255,.12); color:#1683ff; font-weight: 500;">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </p>
                            </div>

                            <div class="col-12 col-md-6">
                                <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                                    Date de création
                                </label>
                                <p class="mb-0" style="font-size: 0.95rem;">
                                    <i class="bi bi-calendar3 text-secondary me-1" style="font-size: 0.65rem;"></i>
                                    {{ $user->created_at->format('d/m/Y') }}
                                </p>
                            </div>

                            <div class="col-12">
                                <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                                    Adresse
                                </label>
                                <p class="mb-0" style="font-size: 0.95rem;">
                                    <i class="bi bi-geo-alt text-secondary me-1" style="font-size: 0.65rem;"></i>
                                    {{ $user->adresse ?? '-' }}
                                </p>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</main>

@endsection