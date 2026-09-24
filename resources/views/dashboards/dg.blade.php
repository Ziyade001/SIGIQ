@extends('dashboards.index')

@section('content')

<main class="dashboard-content">

    <div class="container-fluid px-3 px-lg-4 py-4">

        <!-- PAGE HEADER -->
        <div class="page-heading d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">

            <div class="page-heading-copy d-flex align-items-center gap-3 section-title">
                <span class="page-icon">
                    <i class="bi bi-building-fill-check" aria-hidden="true"></i>
                </span>

                <div>
                    <p class="eyebrow mb-1 text-uppercase small fw-semibold text-secondary" style="letter-spacing: 0.05em; font-size: 0.7rem;">
                        Direction Générale
                    </p>

                    <h1 class="h3 mb-1 fw-bold">
                        Tableau de bord stratégique
                    </h1>

                    <p class="text-muted mb-0" style="font-size: 0.9rem;">
                        Supervisez les performances globales des inspections, les statistiques opérationnelles et les indicateurs de conformité.
                    </p>
                </div>

            </div>

        </div>

        <!-- METRICS -->
        <section class="row g-3 mt-1" aria-label="Statistiques stratégiques">

            <!-- Carte 1 : Missions en cours -->
            <div class="col-12 col-sm-6 col-xl-3">

                <article class="card border-0 shadow-sm h-100 rounded-4" style="border-top:4px solid #1683ff !important;">

                    <div class="card-body p-3">

                        <div class="d-flex justify-content-between align-items-start mb-2">

                            <span class="badge text-uppercase small fw-semibold"
                                  style="background-color:rgba(22,131,255,.12); color:#1683ff; letter-spacing: 0.04em; font-size: 0.65rem;">
                                Missions en cours
                            </span>

                            <span class="badge bg-opacity-10 p-2 rounded-3"
                                  style="background-color:rgba(22,131,255,.12); color:#1683ff; font-size: 1.1rem; line-height: 1;">
                                <i class="bi bi-briefcase-fill"></i>
                            </span>

                        </div>

                        <div class="fs-1 fw-bold lh-1 mb-1">
                            {{ $missionsEnCours }}
                        </div>

                        <div class="small text-secondary d-flex align-items-center gap-1">
                            <span class="d-inline-block rounded-circle" 
                                  style="width: 6px; height: 6px; background:#1683ff;"></span>
                            Missions actives
                        </div>

                    </div>

                </article>

            </div>

            <!-- Carte 2 : Missions terminées -->
            <div class="col-12 col-sm-6 col-xl-3">

                <article class="card border-0 shadow-sm h-100 rounded-4" style="border-top:4px solid #059e33 !important;">

                    <div class="card-body p-3">

                        <div class="d-flex justify-content-between align-items-start mb-2">

                            <span class="badge text-uppercase small fw-semibold"
                                  style="background-color:rgba(5,158,51,.12); color:#059e33; letter-spacing: 0.04em; font-size: 0.65rem;">
                                Missions terminées
                            </span>

                            <span class="badge bg-opacity-10 p-2 rounded-3"
                                  style="background-color:rgba(5,158,51,.12); color:#059e33; font-size: 1.1rem; line-height: 1;">
                                <i class="bi bi-check-circle-fill"></i>
                            </span>

                        </div>

                        <div class="fs-1 fw-bold lh-1 mb-1">
                            {{ $missionsTerminees }}
                        </div>

                        <div class="small text-secondary d-flex align-items-center gap-1">
                            <span class="d-inline-block rounded-circle" 
                                  style="width: 6px; height: 6px; background:#059e33;"></span>
                            Missions finalisées
                        </div>

                    </div>

                </article>

            </div>

            <!-- Carte 3 : Inspections réalisées -->
            <div class="col-12 col-sm-6 col-xl-3">

                <article class="card border-0 shadow-sm h-100 rounded-4" style="border-top:4px solid #1683ff !important;">

                    <div class="card-body p-3">

                        <div class="d-flex justify-content-between align-items-start mb-2">

                            <span class="badge text-uppercase small fw-semibold"
                                  style="background-color:rgba(22,131,255,.12); color:#1683ff; letter-spacing: 0.04em; font-size: 0.65rem;">
                                Inspections réalisées
                            </span>

                            <span class="badge bg-opacity-10 p-2 rounded-3"
                                  style="background-color:rgba(22,131,255,.12); color:#1683ff; font-size: 1.1rem; line-height: 1;">
                                <i class="bi bi-search"></i>
                            </span>

                        </div>

                        <div class="fs-1 fw-bold lh-1 mb-1">
                            {{ $inspectionsTotal }}
                        </div>

                        <div class="small text-secondary d-flex align-items-center gap-1">
                            <span class="d-inline-block rounded-circle" 
                                  style="width: 6px; height: 6px; background:#1683ff;"></span>
                            Total général
                        </div>

                    </div>

                </article>

            </div>

            <!-- Carte 4 : Amendes émises -->
            <div class="col-12 col-sm-6 col-xl-3">

                <article class="card border-0 shadow-sm h-100 rounded-4" style="border-top:4px solid #dc3545 !important;">

                    <div class="card-body p-3">

                        <div class="d-flex justify-content-between align-items-start mb-2">

                            <span class="badge text-uppercase small fw-semibold"
                                  style="background-color:rgba(220,53,69,.12); color:#dc3545; letter-spacing: 0.04em; font-size: 0.65rem;">
                                Amendes émises
                            </span>

                            <span class="badge bg-opacity-10 p-2 rounded-3"
                                  style="background-color:rgba(220,53,69,.12); color:#dc3545; font-size: 1.1rem; line-height: 1;">
                                <i class="bi bi-cash-stack"></i>
                            </span>

                        </div>

                        <div class="fs-1 fw-bold lh-1 mb-1">
                            {{ number_format($montantTotalAmendes, 0, ',', ' ') }}
                        </div>

                        <div class="small text-secondary d-flex align-items-center gap-1">
                            <span class="d-inline-block rounded-circle" 
                                  style="width: 6px; height: 6px; background:#dc3545;"></span>
                            FCFA au total
                        </div>

                    </div>

                </article>

            </div>

        </section>

        <!-- CONTENT -->
        <section class="row g-3 mt-1">

            <!-- PERFORMANCE - Evolution des amendes -->
            <div class="col-12 col-xl-8">

                <div class="panel card border-0 shadow-sm rounded-4">

                    <div class="panel-header card-header bg-transparent border-0 d-flex flex-wrap align-items-center justify-content-between gap-2 px-4 pt-4 pb-3">

                        <div>

                            <h2 class="h5 mb-1 fw-bold d-flex align-items-center gap-2 section-title">
                                <i class="bi bi-bar-chart-line-fill me-2"></i>
                                <span>Evolution des amendes</span>
                            </h2>

                            <p class="text-muted mb-0" style="font-size: 0.85rem;">
                                Evolution des montants des amendes sur les six derniers mois.
                            </p>

                        </div>

                    </div>

                    <div class="card-body pt-0 pb-4 px-4">

                        <div class="chart-bars d-flex align-items-end justify-content-between gap-2" 
                             style="height: 220px; padding-top: 10px;">

                            @foreach($chartData as $item)

                                <div class="chart-column d-flex flex-column align-items-center flex-grow-1" 
                                     style="height: 100%; justify-content: flex-end;">

                                    <span class="d-block rounded" 
                                          style="height: {{ $item['hauteur'] }}%; 
                                                 width: 100%; 
                                                 max-width: 40px;
                                                 background: linear-gradient(180deg, #059e33 0%, #1683ff 100%);
                                                 border-radius: 6px 6px 0 0;
                                                 transition: height 0.5s ease;
                                                 min-height: 4px;">
                                    </span>

                                    <small class="text-secondary mt-2" style="font-size: 0.65rem; font-weight: 600;">
                                        {{ $item['mois'] }}
                                    </small>

                                    <div class="fw-semibold small mt-1" style="font-size: 0.7rem; color:#059e33;">
                                        {{ number_format($item['montant'], 0, ',', ' ') }}
                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>

                </div>

            </div>

            <!-- SITUATION DES AMENDES -->
            <div class="col-12 col-xl-4">

                <div class="panel card border-0 shadow-sm rounded-4 h-100">

                    <div class="panel-header card-header bg-transparent border-0 d-flex flex-wrap align-items-center justify-content-between gap-2 px-4 pt-4 pb-3">

                        <div>

                            <h2 class="h5 mb-1 fw-bold d-flex align-items-center gap-2 section-title">
                                <i class="bi bi-cash-stack me-2"></i>
                                <span>Situation des amendes</span>
                            </h2>

                        </div>

                    </div>

                    <div class="card-body px-4 pt-0 pb-4">

                        <div class="row g-3">

                            {{-- Nombre d'amendes --}}
                            <div class="col-12">

                                <div class="border rounded-3 p-3 bg-light d-flex justify-content-between align-items-center">

                                    <div>

                                        <small class="text-muted d-block" style="font-size: 0.7rem; letter-spacing: 0.03em;">
                                            Nombre d'amendes
                                        </small>

                                        <h5 class="mb-0 fw-bold">
                                            {{ $nombreAmendes }}
                                        </h5>

                                    </div>

                                    <i class="bi bi-receipt-cutoff fs-2 text-success opacity-75"></i>

                                </div>

                            </div>

                            {{-- Montant total --}}
                            <div class="col-12">

                                <div class="border rounded-3 p-3">

                                    <small class="text-muted d-block mb-1" style="font-size: 0.7rem; letter-spacing: 0.03em;">
                                        Montant total des amendes
                                    </small>

                                    <h4 class="fw-bold mb-0 d-flex align-items-center gap-2">
                                        <span class="text-danger">
                                            {{ number_format($montantTotalAmendes, 0, ',', ' ') }}
                                        </span>
                                        <small class="fw-normal text-secondary" style="font-size: 0.7rem;">FCFA</small>
                                    </h4>

                                </div>

                            </div>

                            {{-- Montant payé --}}
                            <div class="col-md-6">

                                <div class="border rounded-3 p-3 h-100">

                                    <small class="text-muted d-block mb-1" style="font-size: 0.7rem; letter-spacing: 0.03em;">
                                        Montant recouvré
                                    </small>

                                    <h5 class="fw-bold mb-0 text-success">
                                        {{ number_format($montantPaye, 0, ',', ' ') }}
                                    </h5>

                                </div>

                            </div>

                            {{-- Montant impayé --}}
                            <div class="col-md-6">

                                <div class="border rounded-3 p-3 h-100">

                                    <small class="text-muted d-block mb-1" style="font-size: 0.7rem; letter-spacing: 0.03em;">
                                        Reste à recouvrer
                                    </small>

                                    <h5 class="fw-bold mb-0 text-warning">
                                        {{ number_format($montantImpaye, 0, ',', ' ') }}
                                    </h5>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- ACTIVITÉ NATIONALE -->
            <div class="col-12">

                <div class="panel card border-0 shadow-sm rounded-4">

                    <div class="panel-header card-header bg-transparent border-0 d-flex flex-wrap align-items-center justify-content-between gap-2 px-4 pt-4 pb-3">

                        <div>

                            <h2 class="h5 mb-1 fw-bold d-flex align-items-center gap-2 section-title">
                                <i class="bi bi-globe-africa me-2"></i>
                                <span>Activité nationale</span>
                            </h2>

                            <p class="text-muted mb-0" style="font-size: 0.85rem;">
                                Indicateurs de contrôle à l'échelle nationale.
                            </p>

                        </div>

                    </div>

                    <div class="card-body pt-0 pb-4 px-4">

                        <div class="row g-3">

                            <div class="col-6 col-md-3">

                                <div class="border rounded-3 p-3 text-center bg-light">

                                    <h3 class="fw-bold mb-1" style="color:#1683ff;">
                                        {{ $boutiquesControlees }}
                                    </h3>

                                    <small class="text-muted d-block" style="font-size: 0.7rem;">
                                        Boutiques contrôlées
                                    </small>

                                </div>

                            </div>

                            <div class="col-6 col-md-3">

                                <div class="border rounded-3 p-3 text-center bg-light">

                                    <h3 class="fw-bold mb-1 text-danger">
                                        {{ $boutiquesNonConformes }}
                                    </h3>

                                    <small class="text-muted d-block" style="font-size: 0.7rem;">
                                        Boutiques non conformes
                                    </small>

                                </div>

                            </div>

                            <div class="col-6 col-md-3">

                                <div class="border rounded-3 p-3 text-center bg-light">

                                    <h3 class="fw-bold mb-1" style="color:#059e33;">
                                        {{ $instrumentsControles }}
                                    </h3>

                                    <small class="text-muted d-block" style="font-size: 0.7rem;">
                                        Instruments contrôlés
                                    </small>

                                </div>

                            </div>

                            <div class="col-6 col-md-3">

                                <div class="border rounded-3 p-3 text-center bg-light">

                                    <h3 class="fw-bold mb-1" style="color:#ffc107;">
                                        {{ $preemballesControles }}
                                    </h3>

                                    <small class="text-muted d-block" style="font-size: 0.7rem;">
                                        Préemballés contrôlés
                                    </small>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        <!-- DERNIERS RAPPORTS VALIDÉS -->
        <section class="panel card border-0 shadow-sm rounded-4 mt-3">

            <div class="panel-header card-header bg-transparent border-0 d-flex flex-wrap align-items-center justify-content-between gap-2 px-4 pt-4 pb-3">

                <div>

                    <h2 class="h5 mb-1 fw-bold d-flex align-items-center gap-2 section-title">
                        <i class="bi bi-journal-text me-2"></i>
                        <span>Derniers rapports validés</span>
                    </h2>

                    <p class="text-muted mb-0" style="font-size: 0.85rem;">
                        Rapports récents approuvés par la Direction.
                    </p>

                </div>

                <a class="btn btn-light btn-sm rounded-pill px-3" href="{{ route('rapports.index') }}" style="font-weight: 500;">
                    <i class="bi bi-arrow-right me-1"></i>
                    Voir tout
                </a>

            </div>

            <div class="table-responsive px-1">

                <table class="table align-middle mb-0" style="font-size: 0.9rem;">

                    <thead style="background: #f8f9fc; border-bottom: 2px solid #e9ecef;">
                        <tr>
                            <th class="text-uppercase small fw-semibold text-secondary" 
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Référence
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary" 
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Type
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary" 
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Période
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary" 
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Localité
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary" 
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Statut
                            </th>
                            <th class="text-end text-uppercase small fw-semibold text-secondary" 
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Action
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($rapports as $mission)

                        <tr style="border-bottom: 1px solid #f1f3f5; transition: background 0.15s;"
                            onmouseover="this.style.background='#f8f9fc'" 
                            onmouseout="this.style.background='transparent'">

                            <td class="fw-semibold py-2 px-2">
                                {{ $mission->reference }}
                            </td>

                            <td class="py-2 px-2">
                                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-1" 
                                      style="font-weight: 500; font-size: 0.75rem;">
                                    {{ $mission->type_mission }}
                                </span>
                            </td>

                            <td class="py-2 px-2" style="font-size: 0.8rem;">
                                <i class="bi bi-calendar-event text-secondary me-1" style="font-size: 0.7rem;"></i>
                                {{ $mission->periode_debut->format('d/m/Y') }}
                                -
                                {{ $mission->periode_fin->format('d/m/Y') }}
                            </td>

                            <td class="py-2 px-2">
                                <i class="bi bi-geo-alt-fill text-secondary me-1" style="font-size: 0.7rem;"></i>
                                {{ $mission->localites }}
                            </td>

                            <td class="py-2 px-2">

                                <span class="badge rounded-pill px-3 py-1" 
                                      style="background-color:rgba(5,158,51,.12); color:#059e33; font-weight: 500;">
                                    <i class="bi bi-check-circle-fill me-1"></i> Validé
                                </span>

                            </td>

                            <td class="text-end py-2 px-2">

                                <a href="{{ route('rapports.show', $mission) }}"
                                   class="btn btn-outline-primary btn-sm rounded-pill px-3"
                                   style="font-size: 0.75rem; font-weight: 500; transition: all 0.15s;">
                                   <i class="bi bi-eye me-1"></i> Consulter
                                </a>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="bi bi-inbox d-block mb-2" style="font-size: 2rem;"></i>
                                Aucun rapport validé disponible
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