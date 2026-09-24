@extends('dashboards.index')

@section('content')

<main class="dashboard-content">

    <div class="container-fluid px-3 px-lg-4 py-4">

        <!-- PAGE HEADER -->
        <div class="page-heading d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">

            <div class="page-heading-copy d-flex align-items-center gap-3 section-title">

                <span class="page-icon">
                    <i class="bi bi-person-badge" aria-hidden="true"></i>
                </span>

                <div>

                    <nav aria-label="breadcrumb" class="mb-1">
                        <ol class="breadcrumb mb-0" style="font-size: 0.8rem;">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    Tableau de bord
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('users.index') }}">
                                    Utilisateurs
                                </a>
                            </li>
                            <li class="breadcrumb-item active text-secondary" aria-current="page">
                                {{ $user->name }}
                            </li>
                        </ol>
                    </nav>

                    <h1 class="h3 mb-1 fw-bold d-flex align-items-center gap-2">
                        Détails de l'utilisateur
                        <span class="badge rounded-pill px-3 py-2"
                              style="background-color:rgba(22,131,255,.12); color:#1683ff; font-size: 0.7rem; font-weight: 600;">
                            {{ $user->matricule }}
                        </span>
                    </h1>

                    <p class="text-muted mb-0" style="font-size: 0.9rem;">
                        Consultation des informations de l'utilisateur.
                    </p>

                </div>

            </div>

            <div class="heading-actions d-flex flex-wrap gap-2">

                <a href="{{ route('users.edit', $user) }}"
                   class="btn btn-outline-warning btn-sm rounded-pill px-3"
                   style="font-weight: 500;">
                    <i class="bi bi-pencil me-1"></i>
                    Modifier
                </a>

                <a href="{{ route('users.index') }}"
                   class="btn btn-outline-secondary btn-sm rounded-pill px-3"
                   style="font-weight: 500;">
                    <i class="bi bi-arrow-left me-1"></i>
                    Retour
                </a>

            </div>

        </div>

        <!-- CARTE PRINCIPALE -->
        <div class="panel card border-0 shadow-sm rounded-4">

            <div class="card-body p-4">

                <div class="row g-4">

                    <!-- COLONNE GAUCHE : PHOTO -->
                    <div class="col-12 col-md-3 text-center">

                        @if($user->photo)

                            <img src="{{ asset('storage/'.$user->photo) }}"
                                 class="rounded-circle border border-3 mb-3"
                                 style="width: 180px; height: 180px; object-fit: cover; border-color: #e9ecef !important;"
                                 alt="Photo de {{ $user->name }}">

                        @else

                            <div class="d-flex align-items-center justify-content-center mx-auto rounded-circle bg-light"
                                 style="width: 180px; height: 180px; color: #6c757d;">
                                <i class="bi bi-person-circle" style="font-size: 150px;"></i>
                            </div>

                        @endif

                        <div class="mt-2">

                            @php
                                $roleColors = [
                                    'admin' => ['bg' => 'rgba(220,53,69,.12)', 'color' => '#dc3545'],
                                    'dg' => ['bg' => 'rgba(5,158,51,.12)', 'color' => '#059e33'],
                                    'dt' => ['bg' => 'rgba(255,193,7,.12)', 'color' => '#ffc107'],
                                    'inspecteur' => ['bg' => 'rgba(22,131,255,.12)', 'color' => '#1683ff'],
                                ];
                                $role = strtolower($user->role);
                                $style = $roleColors[$role] ?? ['bg' => 'rgba(108,117,125,.12)', 'color' => '#6c757d'];
                            @endphp

                            <span class="badge rounded-pill px-4 py-2"
                                  style="background-color:{{ $style['bg'] }}; color:{{ $style['color'] }}; font-weight: 600; font-size: 0.75rem;">
                                {{ strtoupper($user->role) }}
                            </span>

                            <span class="badge rounded-pill px-3 py-1 ms-1"
                                  style="background-color:rgba(108,117,125,.12); color:#6c757d; font-weight: 500; font-size: 0.65rem;">
                                <i class="bi bi-calendar3 me-1"></i>
                                Créé le {{ $user->created_at->format('d/m/Y') }}
                            </span>

                        </div>

                    </div>

                    <!-- COLONNE DROITE : INFORMATIONS -->
                    <div class="col-12 col-md-9">

                        <h3 class="fw-bold mb-1" style="font-size: 1.5rem;">
                            {{ $user->name }}
                        </h3>

                        <p class="text-muted mb-3" style="font-size: 0.95rem;">
                            {{ $user->fonction }}
                        </p>

                        <hr class="my-3" style="border-color: #f1f3f5;">

                        <div class="row g-3">

                            <div class="col-12 col-md-6">
                                <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                                    Matricule
                                </label>
                                <p class="fw-semibold mb-0" style="font-size: 0.95rem;">
                                    {{ $user->matricule }}
                                </p>
                            </div>

                            <div class="col-12 col-md-6">
                                <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                                    Email
                                </label>
                                <p class="mb-0" style="font-size: 0.95rem;">
                                    <i class="bi bi-envelope text-secondary me-1" style="font-size: 0.65rem;"></i>
                                    {{ $user->email }}
                                </p>
                            </div>

                            <div class="col-12 col-md-6">
                                <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                                    Téléphone
                                </label>
                                <p class="mb-0" style="font-size: 0.95rem;">
                                    <i class="bi bi-telephone text-secondary me-1" style="font-size: 0.65rem;"></i>
                                    {{ $user->telephone ?? '-' }}
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
                                    <i class="bi bi-calendar3 text-secondary me-1" style="font-size: 0.65rem;"></i>
                                    {{ $user->date_naissance ? \Carbon\Carbon::parse($user->date_naissance)->format('d/m/Y') : '-' }}
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

                        <!-- Actions rapides -->
                        <div class="d-flex flex-wrap gap-2 mt-4 pt-3" style="border-top: 1px solid #f1f3f5;">

                            <a href="{{ route('users.edit', $user) }}"
                               class="btn btn-outline-warning rounded-pill px-3 py-1"
                               style="font-weight: 500; font-size: 0.85rem;">
                                <i class="bi bi-pencil me-1"></i>
                                Modifier
                            </a>

                            <form action="{{ route('users.destroy', $user) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Voulez-vous vraiment supprimer cet utilisateur ? Cette action est irréversible.')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-outline-danger rounded-pill px-3 py-1"
                                        style="font-weight: 500; font-size: 0.85rem;">
                                    <i class="bi bi-trash me-1"></i>
                                    Supprimer
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</main>

@endsection