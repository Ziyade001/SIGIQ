@extends('dashboards.index')

@section('content')

<main class="dashboard-content">

    <div class="container-fluid px-3 px-lg-4 py-4">

        <!-- PAGE HEADER -->
        <div class="page-heading d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">

            <div class="page-heading-copy d-flex align-items-center gap-3">

                <span class="page-icon">
                    <i class="bi bi-person-check-fill" aria-hidden="true"></i>
                </span>

                <div>
                    <p class="eyebrow mb-1 text-uppercase small fw-semibold text-secondary" style="letter-spacing: 0.05em; font-size: 0.7rem;">
                        Technicien Assermenté
                    </p>

                    <h1 class="h3 mb-1 fw-bold">
                        Tableau de bord
                    </h1>

                    <p class="text-muted mb-0">
                        Consultez vos missions, gérez vos inspections et assurez le suivi des opérations de contrôle qualité.
                    </p>
                </div>

            </div>

        </div>

        <!-- METRICS -->
        <section class="row g-3 mt-1" aria-label="Statistiques inspecteur">

            <!-- Carte 1 : Inspections -->
            <div class="col-12 col-sm-6 col-xl-3">

                <article class="card border-0 shadow-sm h-100 rounded-4" style="border-top:4px solid #059e33 !important;">

                    <div class="card-body p-3">

                        <div class="d-flex justify-content-between align-items-start mb-2">

                            <span class="badge text-uppercase small fw-semibold"
                                  style="background-color:rgba(5,158,51,.12); color:#059e33; letter-spacing: 0.04em; font-size: 0.65rem;">

                                Inspections réalisées
                            </span>

                            <span class="badge bg-opacity-10 p-2 rounded-3"
                                  style="background-color:rgba(5,158,51,.12); color:#059e33; font-size: 1.1rem; line-height: 1;">
                                <i class="bi bi-clipboard-check"></i>
                            </span>

                        </div>

                        <div class="fs-1 fw-bold lh-1 mb-1">
                            {{ $inspectionsCount }}
                        </div>

                        <div class="small text-secondary d-flex align-items-center gap-1">
                            <span class="d-inline-block rounded-circle" 
                                  style="width: 6px; height: 6px; background:#059e33;"></span>
                            Total des missions
                        </div>

                    </div>

                </article>

            </div>

            <!-- Carte 2 : Instruments de mesure -->
            <div class="col-12 col-sm-6 col-xl-3">

                <article class="card border-0 shadow-sm h-100 rounded-4"
                         style="border-top:4px solid #1683ff !important;">

                    <div class="card-body p-3">

                        <div class="d-flex justify-content-between align-items-start mb-2">

                            <span class="badge text-uppercase small fw-semibold"
                                  style="background-color:rgba(22,131,255,.12); color:#1683ff; letter-spacing: 0.04em; font-size: 0.65rem; ">
                                Instruments inspectés
                            </span>

                            <span class="badge bg-opacity-10 p-2 rounded-3"
                                  style="background-color:rgba(22,131,255,.12); font-size: 1.1rem; line-height: 1; color:#1683ff;">
                                <i class="bi bi-check-circle"></i>
                            </span>

                        </div>

                        <div class="fs-1 fw-bold lh-1 mb-1">
                            {{ $mesuresCount }}
                        </div>

                        <div class="small text-secondary d-flex align-items-center gap-1">
                            <span class="d-inline-block rounded-circle" 
                                  style="width: 6px; height: 6px; background:#1683ff;"></span>
                            Instruments de mesure
                        </div>

                    </div>

                </article>

            </div>

            <!-- Carte 3 : Préemballés -->
            <div class="col-12 col-sm-6 col-xl-3">

                <article class="card border-0 shadow-sm h-100 rounded-4"
                        style="border-top:4px solid #059e33 !important;">

                    <div class="card-body p-3">

                        <div class="d-flex justify-content-between align-items-start mb-2">

                            <span class="badge text-uppercase small fw-semibold"
                                  style="background-color:rgba(5,158,51,.12); color:#059e33; letter-spacing: 0.04em; font-size: 0.65rem;">

                                Préemballés inspectés
                            </span>

                            <span class="badge bg-opacity-10 p-2 rounded-3"
                                  style="background-color:rgba(5,158,51,.12); color:#059e33; font-size: 1.1rem; line-height: 1;">
                                <i class="bi bi-hourglass-split"></i>
                            </span>

                        </div>

                        <div class="fs-1 fw-bold lh-1 mb-1">
                            {{ $preemballesCount }}
                        </div>

                        <div class="small text-secondary d-flex align-items-center gap-1">
                            <span class="d-inline-block rounded-circle" 
                                  style="width: 6px; height: 6px; background:#059e33;"></span>
                            Préemballés contrôlés
                        </div>

                    </div>

                </article>

            </div>

            <!-- Carte 4 : Amendes -->
            <div class="col-12 col-sm-6 col-xl-3">

                <article class="card border-0 shadow-sm h-100 rounded-4"
                         style="border-top:4px solid #dc3545 !important;" >

                    <div class="card-body p-3">

                        <div class="d-flex justify-content-between align-items-start mb-2">

                            <span class="badge text-uppercase small fw-semibold"
                                  style="background-color:rgba(220,53,69,.12); color:#dc3545; letter-spacing: 0.04em; font-size: 0.65rem; ">
                                Total des amendes
                            </span>

                            <span class="badge bg-opacity-10 p-2 rounded-3"
                                  style="background-color:rgba(220,53,69,.12); font-size: 1.1rem; line-height: 1; color:#dc3545;">
                                <i class="bi bi-exclamation-triangle"></i>
                            </span>

                        </div>

                        <div class="fs-1 fw-bold lh-1 mb-1">
                            {{ number_format($totalAmendes, 0, ',', ' ') }}
                        </div>

                        <div class="small text-secondary d-flex align-items-center gap-1">
                            <span class="d-inline-block rounded-circle" 
                                  style="width: 6px; height: 6px; background:#dc3545;"></span>
                            FCFA d'amendes
                        </div>

                    </div>

                </article>

            </div>

        </section>

        <!-- CONTENT -->
        <section class="row g-3 mt-1">

            <!-- INSPECTIONS -->
            <div class="col-12 col-xl-8">

                <div class="panel card border-0 shadow-sm rounded-4">

                    <div class="panel-header card-header bg-transparent border-0 d-flex flex-wrap align-items-center justify-content-between gap-2 px-4 pt-4 pb-3">

                        <div>

                            <h2 class="h5 mb-1 fw-bold d-flex align-items-center gap-2 section-title">
                                <i class="bi bi-list-task me-2"></i>
                                <span>Mes inspections récentes</span>
                            </h2>

                            <p class="text-muted mb-0" style="font-size: 0.85rem;">
                                Historique des dernières missions effectuées.
                            </p>

                        </div>

                        <a class="btn btn-light btn-sm rounded-pill px-3" href="{{ route('inspections.index') }}" style="font-weight: 500;">
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
                                        Établissement
                                    </th>
                                    <th class="text-uppercase small fw-semibold text-secondary" 
                                        style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                        Type
                                    </th>
                                    <th class="text-uppercase small fw-semibold text-secondary" 
                                        style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                        Date
                                    </th>
                                    <th class="text-end text-uppercase small fw-semibold text-secondary" 
                                        style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                        Action
                                    </th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($inspections as $inspection)

                                <tr style="border-bottom: 1px solid #f1f3f5; transition: background 0.15s;"
                                    onmouseover="this.style.background='#f8f9fc'" 
                                    onmouseout="this.style.background='transparent'">

                                    <td class="fw-semibold py-2 px-2">
                                        {{ $inspection->reference }}
                                    </td>

                                    <td class="py-2 px-2">
                                        {{ $inspection->etablissement }}
                                    </td>

                                    <td class="py-2 px-2">
                                        <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-1" 
                                              style="font-weight: 500; font-size: 0.75rem;">
                                            {{ ucfirst($inspection->type_inspection) }}
                                        </span>
                                    </td>

                                    <td class="py-2 px-2">
                                        {{ \Carbon\Carbon::parse($inspection->date)->format('d/m/Y') }}
                                    </td>

                                    <td class="text-end py-2 px-2">

                                        <a href="{{ route('inspections.show', $inspection) }}"
                                           class="btn btn-outline-primary btn-sm rounded-pill px-3"
                                           style="font-size: 0.75rem; font-weight: 500; transition: all 0.15s;">
                                           <i class="bi bi-eye me-1"></i> Voir
                                        </a>

                                    </td>

                                </tr>

                                @empty

                                <tr>

                                    <td colspan="5" class="text-center text-muted py-4">
                                        <i class="bi bi-inbox d-block mb-2" style="font-size: 2rem;"></i>
                                        Aucune inspection enregistrée
                                    </td>

                                </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

            <!-- SITUATION DES AMENDES -->
            <div class="col-12 col-xl-4">

                <div class="panel card border-0 shadow-sm rounded-4 h-100">

                    <div class="panel-header card-header bg-transparent border-0 px-4 pt-4 pb-3">

                        <div>

                            <h2 class="h5 mb-1 fw-bold d-flex align-items-center gap-2 section-title">
                                <i class="bi bi-cash-stack me-2"></i>
                                Situation des amendes
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
                                            {{ number_format($totalAmendes, 0, ',', ' ') }}
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
                                        {{ number_format($totalPaye, 0, ',', ' ') }}
                                    </h5>

                                </div>

                            </div>

                            {{-- Montant impayé --}}
                            <div class="col-md-6">

                                <div class="border rounded-3 p-3 h-100">

                                    <small class="text-muted d-block mb-1" style="font-size: 0.7rem; letter-spacing: 0.03em;">
                                        Reste à recouvrer
                                    </small>

                                    <h5 class="fw-bold mb-0 text-danger">
                                        {{ number_format($totalImpaye, 0, ',', ' ') }}
                                    </h5>

                                </div>

                            </div>

                            {{-- Taux de recouvrement --}}
                            <div class="col-12">

                                <div class="border rounded-3 p-3">

                                    <div class="d-flex justify-content-between align-items-center">

                                        <span class="fw-semibold" style="font-size: 0.85rem;">
                                            Taux de recouvrement
                                        </span>

                                        <span class="badge px-3 py-2 rounded-pill fw-semibold 
                                            @if($tauxRecouvrement >= 80) bg-success 
                                            @elseif($tauxRecouvrement >= 50) bg-warning 
                                            @else bg-danger @endif" 
                                            style="font-size: 0.75rem;">
                                            
                                            @if($tauxRecouvrement >= 80) 
                                                <i class="bi bi-check-circle me-1"></i> 
                                            @elseif($tauxRecouvrement >= 50) 
                                                <i class="bi bi-clock me-1"></i> 
                                            @else 
                                                <i class="bi bi-exclamation-circle me-1"></i> 
                                            @endif
                                            
                                            {{ $tauxRecouvrement }} %
                                        </span>

                                    </div>

                                    <div class="progress" style="height: 8px; border-radius: 10px; background: #e9ecef;">

                                        <div class="progress-bar 
                                            @if($tauxRecouvrement >= 80) bg-success 
                                            @elseif($tauxRecouvrement >= 50) bg-warning 
                                            @else bg-danger @endif" 
                                             role="progressbar"
                                             style="width: {{ min($tauxRecouvrement, 100) }}%; border-radius: 10px; transition: width 0.5s ease;"
                                             aria-valuenow="{{ $tauxRecouvrement }}"
                                             aria-valuemin="0"
                                             aria-valuemax="100">
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        <!-- MISSIONS PROGRAMMÉES -->
        <section class="panel card border-0 shadow-sm rounded-4 mt-3">

            <div class="panel-header card-header bg-transparent border-0 d-flex flex-wrap align-items-center justify-content-between gap-2 px-4 pt-4 pb-3">

                <div>

                    <h2 class="h5 mb-1 fw-bold d-flex align-items-center gap-2 section-title">
                        <i class="bi bi-geo-alt me-2"></i>
                        <span>Missions programmées</span>
                    </h2>

                    <p class="text-muted mb-0" style="font-size: 0.85rem;">
                        Liste des prochaines opérations prévues.
                    </p>

                </div>

                <a class="btn btn-light btn-sm rounded-pill px-3" href="{{ route('missions.index') }}" style="font-weight: 500;">
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
                                Mission
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary" 
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Activités
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary" 
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Localité
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary" 
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Date
                            </th>
                            <th class="text-end text-uppercase small fw-semibold text-secondary" 
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Action
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($missions as $mission)

                        <tr style="border-bottom: 1px solid #f1f3f5; transition: background 0.15s;"
                            onmouseover="this.style.background='#f8f9fc'" 
                            onmouseout="this.style.background='transparent'">

                            <td class="fw-semibold py-2 px-2">
                                {{ $mission->reference }}
                            </td>

                            <td class="py-2 px-2">
                                <span class="d-inline-block text-truncate" style="max-width: 120px;" title="{{ $mission->activites }}">
                                    {{ $mission->activites }}
                                </span>
                            </td>

                            <td class="py-2 px-2">
                                <i class="bi bi-geo-alt-fill text-secondary me-1" style="font-size: 0.7rem;"></i>
                                {{ $mission->localites }}
                            </td>

                            <td class="py-2 px-2">
                                <i class="bi bi-calendar-event text-secondary me-1" style="font-size: 0.7rem;"></i>
                                {{ \Carbon\Carbon::parse($mission->date_debut)->format('d/m/Y') }}
                            </td>

                            <td class="text-end py-2 px-2">

                                <a href="{{ route('missions.show', $mission) }}"
                                   class="btn btn-outline-info btn-sm rounded-pill px-3"
                                   style="font-size: 0.75rem; font-weight: 500; transition: all 0.15s;">
                                   <i class="bi bi-box-arrow-up-right me-1"></i> Ouvrir
                                </a>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="5" class="text-center text-muted py-4">
                                <i class="bi bi-inbox d-block mb-2" style="font-size: 2rem;"></i>
                                Aucune mission trouvée
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