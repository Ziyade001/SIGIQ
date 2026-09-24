@extends('dashboards.index')

@section('content')

<main class="dashboard-content">

    <div class="container-fluid px-3 px-lg-4 py-4">

        <!-- PAGE HEADER -->
        <div class="page-heading d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">

            <div class="page-heading-copy d-flex align-items-center gap-3 section-title">

                <span class="page-icon">
                    <i class="bi bi-speedometer2" aria-hidden="true"></i>
                </span>

                <div>
                    <p class="eyebrow mb-1 text-uppercase small fw-semibold text-secondary" style="letter-spacing: 0.05em; font-size: 0.7rem;">
                        Administration générale
                    </p>

                    <h1 class="h3 mb-1 fw-bold">
                        Tableau de bord Administrateur
                    </h1>

                    <p class="text-muted mb-0" style="font-size: 0.9rem;">
                        Supervisez les utilisateurs, les inspections, les rapports et les activités globales de la plateforme SIGIQ.
                    </p>
                </div>

            </div>

        </div>

        <!-- KPI METRICS -->
        <section class="row g-3 mt-1" aria-label="Statistiques administrateur">

            <!-- Carte 1 : Utilisateurs -->
            <div class="col-12 col-sm-6 col-xl-3">

                <article class="card border-0 shadow-sm h-100 rounded-4" style="border-top:4px solid #1683ff !important;">

                    <div class="card-body p-3">

                        <div class="d-flex justify-content-between align-items-start mb-2">

                            <span class="badge text-uppercase small fw-semibold"
                                  style="background-color:rgba(22,131,255,.12); color:#1683ff; letter-spacing: 0.04em; font-size: 0.65rem;">
                                Utilisateurs
                            </span>

                            <span class="badge bg-opacity-10 p-2 rounded-3"
                                  style="background-color:rgba(22,131,255,.12); color:#1683ff; font-size: 1.1rem; line-height: 1;">
                                <i class="bi bi-people"></i>
                            </span>

                        </div>

                        <div class="fs-1 fw-bold lh-1 mb-1">
                            {{ number_format($totalUsers, 0, ',', ' ') }}
                        </div>

                        <div class="small d-flex align-items-center gap-1">
                            <span class="text-success fw-semibold">
                                +{{ $usersMois }}
                            </span>
                            <span class="text-secondary">nouveaux ce mois</span>
                            <span class="d-inline-block rounded-circle ms-1" 
                                  style="width: 6px; height: 6px; background:#1683ff;"></span>
                        </div>

                    </div>

                </article>

            </div>

            <!-- Carte 2 : Techniciens assermentés -->
            <div class="col-12 col-sm-6 col-xl-3">

                <article class="card border-0 shadow-sm h-100 rounded-4" style="border-top:4px solid #059e33 !important;">

                    <div class="card-body p-3">

                        <div class="d-flex justify-content-between align-items-start mb-2">

                            <span class="badge text-uppercase small fw-semibold"
                                  style="background-color:rgba(5,158,51,.12); color:#059e33; letter-spacing: 0.04em; font-size: 0.65rem;">
                                Techniciens assermentés
                            </span>

                            <span class="badge bg-opacity-10 p-2 rounded-3"
                                  style="background-color:rgba(5,158,51,.12); color:#059e33; font-size: 1.1rem; line-height: 1;">
                                <i class="bi bi-person-badge"></i>
                            </span>

                        </div>

                        <div class="fs-1 fw-bold lh-1 mb-1">
                            {{ number_format($totalInspecteurs, 0, ',', ' ') }}
                        </div>

                        <div class="small text-secondary d-flex align-items-center gap-1">
                            <span class="d-inline-block rounded-circle" 
                                  style="width: 6px; height: 6px; background:#059e33;"></span>
                            Comptes actifs
                        </div>

                    </div>

                </article>

            </div>

            <!-- Carte 3 : Inspections -->
            <div class="col-12 col-sm-6 col-xl-3">

                <article class="card border-0 shadow-sm h-100 rounded-4" style="border-top:4px solid #ffc107 !important;">

                    <div class="card-body p-3">

                        <div class="d-flex justify-content-between align-items-start mb-2">

                            <span class="badge text-uppercase small fw-semibold"
                                  style="background-color:rgba(255,193,7,.12); color:#ffc107; letter-spacing: 0.04em; font-size: 0.65rem;">
                                Inspections
                            </span>

                            <span class="badge bg-opacity-10 p-2 rounded-3"
                                  style="background-color:rgba(255,193,7,.12); color:#ffc107; font-size: 1.1rem; line-height: 1;">
                                <i class="bi bi-clipboard-check"></i>
                            </span>

                        </div>

                        <div class="fs-1 fw-bold lh-1 mb-1">
                            {{ number_format($totalInspections, 0, ',', ' ') }}
                        </div>

                        <div class="small d-flex align-items-center gap-1">
                            <span class="text-success fw-semibold">
                                +{{ $inspectionsMois }}
                            </span>
                            <span class="text-secondary">ce mois</span>
                            <span class="d-inline-block rounded-circle ms-1" 
                                  style="width: 6px; height: 6px; background:#ffc107;"></span>
                        </div>

                    </div>

                </article>

            </div>

            <!-- Carte 4 : Rapports -->
            <div class="col-12 col-sm-6 col-xl-3">

                <article class="card border-0 shadow-sm h-100 rounded-4" style="border-top:4px solid #dc3545 !important;">

                    <div class="card-body p-3">

                        <div class="d-flex justify-content-between align-items-start mb-2">

                            <span class="badge text-uppercase small fw-semibold"
                                  style="background-color:rgba(220,53,69,.12); color:#dc3545; letter-spacing: 0.04em; font-size: 0.65rem;">
                                Rapports
                            </span>

                            <span class="badge bg-opacity-10 p-2 rounded-3"
                                  style="background-color:rgba(220,53,69,.12); color:#dc3545; font-size: 1.1rem; line-height: 1;">
                                <i class="bi bi-file-earmark-text"></i>
                            </span>

                        </div>

                        <div class="fs-1 fw-bold lh-1 mb-1">
                            {{ number_format($totalRapports, 0, ',', ' ') }}
                        </div>

                        <div class="small d-flex align-items-center gap-1">
                            <span class="text-success fw-semibold">
                                +{{ $rapportsMois }}
                            </span>
                            <span class="text-secondary">validés ce mois</span>
                            <span class="d-inline-block rounded-circle ms-1" 
                                  style="width: 6px; height: 6px; background:#dc3545;"></span>
                        </div>

                    </div>

                </article>

            </div>

        </section>

        <!-- ACTIVITY + CHART -->
        <section class="row g-3 mt-3">

            <!-- ACTIVITÉ DU SYSTÈME -->
            <div class="col-12 col-lg-6">

                <div class="panel card border-0 shadow-sm rounded-4 h-100">

                    <div class="panel-header card-header bg-transparent border-0 d-flex flex-wrap align-items-center justify-content-between gap-2 px-4 pt-4 pb-3">

                        <div>

                            <h2 class="h5 mb-1 fw-bold d-flex align-items-center gap-2 section-title">
                                <i class="bi bi-activity me-2"></i>
                                <span>Activité du système</span>
                            </h2>

                            <p class="text-muted mb-0" style="font-size: 0.85rem;">
                                Résumé du mois en cours.
                            </p>

                        </div>

                    </div>

                    <div class="card-body px-4 pt-0 pb-4">

                        <div class="list-group list-group-flush">

                            <div class="list-group-item border-0 px-0 py-3 d-flex align-items-center gap-3"
                                 style="border-bottom: 1px solid #f1f3f5;">

                                <span class="d-flex align-items-center justify-content-center rounded-circle"
                                      style="width: 40px; height: 40px; background:rgba(22,131,255,.12); color:#1683ff; flex-shrink:0;">
                                    <i class="bi bi-people"></i>
                                </span>

                                <div class="flex-grow-1">

                                    <p class="fw-semibold mb-0">
                                        {{ $usersMois }} nouveaux utilisateurs
                                    </p>

                                    <small class="text-muted">
                                        Créés ce mois
                                    </small>

                                </div>

                                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-1">
                                    +{{ $usersMois }}
                                </span>

                            </div>

                            <div class="list-group-item border-0 px-0 py-3 d-flex align-items-center gap-3"
                                 style="border-bottom: 1px solid #f1f3f5;">

                                <span class="d-flex align-items-center justify-content-center rounded-circle"
                                      style="width: 40px; height: 40px; background:rgba(5,158,51,.12); color:#059e33; flex-shrink:0;">
                                    <i class="bi bi-clipboard-check"></i>
                                </span>

                                <div class="flex-grow-1">

                                    <p class="fw-semibold mb-0">
                                        {{ $inspectionsMois }} inspections
                                    </p>

                                    <small class="text-muted">
                                        Réalisées ce mois
                                    </small>

                                </div>

                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1">
                                    +{{ $inspectionsMois }}
                                </span>

                            </div>

                            <div class="list-group-item border-0 px-0 py-3 d-flex align-items-center gap-3"
                                 style="border-bottom: 1px solid #f1f3f5;">

                                <span class="d-flex align-items-center justify-content-center rounded-circle"
                                      style="width: 40px; height: 40px; background:rgba(255,193,7,.12); color:#ffc107; flex-shrink:0;">
                                    <i class="bi bi-briefcase"></i>
                                </span>

                                <div class="flex-grow-1">

                                    <p class="fw-semibold mb-0">
                                        {{ $missionsMois }} missions
                                    </p>

                                    <small class="text-muted">
                                        Enregistrées ce mois
                                    </small>

                                </div>

                                <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3 py-1">
                                    +{{ $missionsMois }}
                                </span>

                            </div>

                            <div class="list-group-item border-0 px-0 py-3 d-flex align-items-center gap-3">

                                <span class="d-flex align-items-center justify-content-center rounded-circle"
                                      style="width: 40px; height: 40px; background:rgba(220,53,69,.12); color:#dc3545; flex-shrink:0;">
                                    <i class="bi bi-file-earmark-text"></i>
                                </span>

                                <div class="flex-grow-1">

                                    <p class="fw-semibold mb-0">
                                        {{ $rapportsMois }} rapports validés
                                    </p>

                                    <small class="text-muted">
                                        Validés
                                    </small>

                                </div>

                                <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-1">
                                    +{{ $rapportsMois }}
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- RÉPARTITION DES UTILISATEURS -->
            <div class="col-12 col-lg-6">

                <div class="panel card border-0 shadow-sm rounded-4 h-100">

                    <div class="panel-header card-header bg-transparent border-0 d-flex flex-wrap align-items-center justify-content-between gap-2 px-4 pt-4 pb-3">

                        <div>

                            <h2 class="h5 mb-1 fw-bold d-flex align-items-center gap-2 section-title">
                                <i class="bi bi-pie-chart me-2"></i>
                                <span>Répartition des utilisateurs</span>
                            </h2>

                            <p class="text-muted mb-0" style="font-size: 0.85rem;">
                                Comptes enregistrés par rôle.
                            </p>

                        </div>

                    </div>

                    <div class="card-body pt-0 pb-4 px-4">

                        @php
                            $maxRole = max($admins, $dg, $dt, $inspecteurs, 1);
                        @endphp

                        <div class="d-flex align-items-end justify-content-around gap-2" 
                             style="height: 220px; padding-top: 10px;">

                            <div class="d-flex flex-column align-items-center flex-grow-1" 
                                 style="height: 100%; justify-content: flex-end;">

                                <span class="d-block rounded" 
                                      style="height: {{ ($admins / $maxRole) * 100 }}%; 
                                             width: 100%; 
                                             max-width: 50px;
                                             background: linear-gradient(180deg, #1683ff 0%, #059e33 100%);
                                             border-radius: 6px 6px 0 0;
                                             transition: height 0.5s ease;
                                             min-height: 4px;">
                                </span>

                                <small class="text-secondary mt-2 fw-semibold" style="font-size: 0.65rem;">
                                    Admin
                                </small>

                                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-2 py-1 mt-1" 
                                      style="font-size: 0.6rem; font-weight: 700;">
                                    {{ $admins }}
                                </span>

                            </div>

                            <div class="d-flex flex-column align-items-center flex-grow-1" 
                                 style="height: 100%; justify-content: flex-end;">

                                <span class="d-block rounded" 
                                      style="height: {{ ($dg / $maxRole) * 100 }}%; 
                                             width: 100%; 
                                             max-width: 50px;
                                             background: linear-gradient(180deg, #1683ff 0%, #059e33 100%);
                                             border-radius: 6px 6px 0 0;
                                             transition: height 0.5s ease;
                                             min-height: 4px;">
                                </span>

                                <small class="text-secondary mt-2 fw-semibold" style="font-size: 0.65rem;">
                                    DG
                                </small>

                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2 py-1 mt-1" 
                                      style="font-size: 0.6rem; font-weight: 700;">
                                    {{ $dg }}
                                </span>

                            </div>

                            <div class="d-flex flex-column align-items-center flex-grow-1" 
                                 style="height: 100%; justify-content: flex-end;">

                                <span class="d-block rounded" 
                                      style="height: {{ ($dt / $maxRole) * 100 }}%; 
                                             width: 100%; 
                                             max-width: 50px;
                                             background: linear-gradient(180deg, #1683ff 0%, #059e33 100%);
                                             border-radius: 6px 6px 0 0;
                                             transition: height 0.5s ease;
                                             min-height: 4px;">
                                </span>

                                <small class="text-secondary mt-2 fw-semibold" style="font-size: 0.65rem;">
                                    DT
                                </small>

                                <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-2 py-1 mt-1" 
                                      style="font-size: 0.6rem; font-weight: 700;">
                                    {{ $dt }}
                                </span>

                            </div>

                            <div class="d-flex flex-column align-items-center flex-grow-1" 
                                 style="height: 100%; justify-content: flex-end;">

                                <span class="d-block rounded" 
                                      style="height: {{ ($inspecteurs / $maxRole) * 100 }}%; 
                                             width: 100%; 
                                             max-width: 50px;
                                             background: linear-gradient(180deg, #1683ff 0%, #059e33 100%);
                                             border-radius: 6px 6px 0 0;
                                             transition: height 0.5s ease;
                                             min-height: 4px;">
                                </span>

                                <small class="text-secondary mt-2 fw-semibold" style="font-size: 0.65rem;">
                                    Inspecteurs
                                </small>

                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2 py-1 mt-1" 
                                      style="font-size: 0.6rem; font-weight: 700;">
                                    {{ $inspecteurs }}
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        <!-- DERNIERS UTILISATEURS -->
        <section class="panel card border-0 shadow-sm rounded-4 mt-3">

            <div class="panel-header card-header bg-transparent border-0 d-flex flex-wrap align-items-center justify-content-between gap-2 px-4 pt-4 pb-3">

                <div>

                    <h2 class="h5 mb-1 fw-bold d-flex align-items-center gap-2 section-title">
                        <i class="bi bi-people me-2"></i>
                        <span>Derniers utilisateurs enregistrés</span>
                    </h2>

                    <p class="text-muted mb-0" style="font-size: 0.85rem;">
                        Comptes créés récemment.
                    </p>

                </div>

                <a href="{{ route('users.index') }}" 
                   class="btn btn-light btn-sm rounded-pill px-3" style="font-weight: 500;">
                    <i class="bi bi-arrow-right me-1"></i>
                    Voir tous
                </a>

            </div>

            <div class="table-responsive px-1">

                <table class="table align-middle mb-0" style="font-size: 0.9rem;">

                    <thead style="background: #f8f9fc; border-bottom: 2px solid #e9ecef;">
                        <tr>
                            <th class="text-uppercase small fw-semibold text-secondary" 
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Matricule
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary" 
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Utilisateur
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary" 
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Fonction
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary" 
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Rôle
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary" 
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Date création
                            </th>
                            <th class="text-end text-uppercase small fw-semibold text-secondary" 
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Action
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($recentUsers as $user)

                        <tr style="border-bottom: 1px solid #f1f3f5; transition: background 0.15s;"
                            onmouseover="this.style.background='#f8f9fc'" 
                            onmouseout="this.style.background='transparent'">

                            <td class="fw-semibold py-2 px-2" style="font-size: 0.8rem;">
                                {{ $user->matricule }}
                            </td>

                            <td class="py-2 px-2">

                                <div class="d-flex align-items-center gap-2">

                                    @if($user->photo)

                                        <img src="{{ asset('storage/'.$user->photo) }}"
                                             class="rounded-circle"
                                             width="36"
                                             height="36"
                                             style="object-fit: cover;"
                                             alt="Photo de {{ $user->name }}">

                                    @else

                                        <span class="d-flex align-items-center justify-content-center rounded-circle bg-light"
                                              style="width: 36px; height: 36px; color:#6c757d;">
                                            <i class="bi bi-person-circle fs-4"></i>
                                        </span>

                                    @endif

                                    <div>

                                        <div class="fw-semibold" style="font-size: 0.85rem;">
                                            {{ $user->name }}
                                        </div>

                                        <small class="text-muted" style="font-size: 0.7rem;">
                                            {{ $user->email }}
                                        </small>

                                    </div>

                                </div>

                            </td>

                            <td class="py-2 px-2" style="font-size: 0.85rem;">
                                {{ $user->fonction }}
                            </td>

                            <td class="py-2 px-2">

                                @php
                                    $roleColors = [
                                        'admin' => 'rgba(22,131,255,.12)',
                                        'dg' => 'rgba(5,158,51,.12)',
                                        'dt' => 'rgba(255,193,7,.12)',
                                        'inspecteur' => 'rgba(220,53,69,.12)',
                                    ];
                                    $roleTextColors = [
                                        'admin' => '#1683ff',
                                        'dg' => '#059e33',
                                        'dt' => '#ffc107',
                                        'inspecteur' => '#dc3545',
                                    ];
                                    $role = strtolower($user->role ?? '');
                                @endphp

                                <span class="badge rounded-pill px-3 py-1" 
                                      style="background-color:{{ $roleColors[$role] ?? 'rgba(108,117,125,.12)' }}; 
                                             color:{{ $roleTextColors[$role] ?? '#6c757d' }}; 
                                             font-weight: 500; font-size: 0.7rem;">
                                    {{ strtoupper($user->role ?? 'Inconnu') }}
                                </span>

                            </td>

                            <td class="py-2 px-2" style="font-size: 0.8rem;">
                                <i class="bi bi-calendar3 text-secondary me-1" style="font-size: 0.65rem;"></i>
                                {{ $user->created_at->format('d/m/Y') }}
                            </td>

                            <td class="text-end py-2 px-2">

                                <a href="{{ route('users.show', $user) }}"
                                   class="btn btn-outline-primary btn-sm rounded-pill px-3"
                                   style="font-size: 0.75rem; font-weight: 500; transition: all 0.15s;">
                                   <i class="bi bi-eye me-1"></i> Voir
                                </a>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="bi bi-inbox d-block mb-2" style="font-size: 2rem;"></i>
                                Aucun utilisateur trouvé
                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </section>

    </div>

</main>

@endsection