@extends('dashboards.index')

@section('content')

<main class="dashboard-content">

    <div class="container-fluid px-3 px-lg-4 py-4">

        <!-- PAGE HEADER -->
        <div class="page-heading d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">

            <div class="page-heading-copy d-flex align-items-center gap-3 section-title">

                <span class="page-icon">
                    <i class="bi bi-clipboard-check" aria-hidden="true"></i>
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
                                <a href="{{ route('inspections.index') }}">
                                    Inspections
                                </a>
                            </li>
                            <li class="breadcrumb-item active text-secondary" aria-current="page">
                                {{ $inspection->reference }}
                            </li>
                        </ol>
                    </nav>

                    <h1 class="h3 mb-1 fw-bold d-flex align-items-center gap-2">
                        Détails de l'inspection
                        <span class="badge rounded-pill px-3 py-2"
                              style="background-color:rgba(5,158,51,.12); color:#059e33; font-size: 0.7rem; font-weight: 600;">
                            {{ $inspection->reference }}
                        </span>
                    </h1>

                    <p class="text-muted mb-0" style="font-size: 0.9rem;">
                        Consultation complète de l'inspection réalisée.
                    </p>

                </div>

            </div>

            <div class="heading-actions d-flex flex-wrap gap-2">

                <a href="{{ route('convocations.generer', $inspection) }}"
                   class="btn btn-warning btn-sm rounded-pill px-3"
                   style="font-weight: 500; color:#212529;">
                    <i class="bi bi-file-earmark-text me-1"></i>
                    Générer la convocation
                </a>

                <a href="{{ route('inspections.edit', $inspection) }}"
                   class="btn btn-outline-warning btn-sm rounded-pill px-3"
                   style="font-weight: 500;">
                    <i class="bi bi-pencil me-1"></i>
                    Modifier
                </a>

                <a href="{{ route('inspections.index') }}"
                   class="btn btn-outline-secondary btn-sm rounded-pill px-3"
                   style="font-weight: 500;">
                    <i class="bi bi-arrow-left me-1"></i>
                    Retour
                </a>

            </div>

        </div>

        <!-- STATUT DE L'INSPECTION -->
        <div class="mb-4">

            @php
                $typeClasses = [
                    'preemballe' => ['bg' => 'rgba(5,158,51,.12)', 'color' => '#059e33', 'icon' => 'bi-box', 'label' => 'Préemballé'],
                    'pesage' => ['bg' => 'rgba(255,193,7,.12)', 'color' => '#ffc107', 'icon' => 'bi-scale', 'label' => 'Pesage'],
                    'volume' => ['bg' => 'rgba(22,131,255,.12)', 'color' => '#1683ff', 'icon' => 'bi-droplet', 'label' => 'Volume'],
                ];
                $type = $inspection->type_inspection ?? 'preemballe';
                $classe = $typeClasses[$type] ?? $typeClasses['preemballe'];
            @endphp

            <div class="d-flex align-items-center gap-3 p-3 rounded-4 bg-light"
                 style="border-left: 4px solid {{ $classe['color'] }};">

                <span class="badge rounded-pill px-4 py-2"
                      style="background-color:{{ $classe['bg'] }}; color:{{ $classe['color'] }}; font-weight: 600; font-size: 0.85rem;">
                    <i class="bi {{ $classe['icon'] }} me-1"></i>
                    {{ $classe['label'] }}
                </span>

                <span class="badge rounded-pill px-3 py-1"
                      style="background-color:rgba(108,117,125,.12); color:#6c757d; font-weight: 500; font-size: 0.7rem;">
                    <i class="bi bi-calendar3 me-1"></i>
                    {{ \Carbon\Carbon::parse($inspection->date)->format('d/m/Y') }}
                </span>

                <span class="text-muted small">
                    {{ ucfirst(str_replace('_', ' ', $inspection->type_essai ?? 'Inspection')) }}
                </span>

            </div>

        </div>

        <!-- INFORMATIONS GÉNÉRALES -->
        <div class="panel card border-0 shadow-sm rounded-4 mb-4">

            <div class="card-header bg-transparent border-0 px-4 pt-4 pb-3">

                <h2 class="h5 mb-0 fw-bold d-flex align-items-center gap-2 section-title">
                    <i class="bi bi-info-circle me-2"></i>
                    <span>Informations générales</span>
                </h2>

            </div>

            <div class="card-body px-4 pt-0 pb-4">

                <div class="row g-3">

                    <div class="col-12 col-md-4">
                        <label class="text-muted d-block" style="font-size: 0.75rem; letter-spacing: 0.03em; font-weight: 600;">
                            Mission
                        </label>
                        <div class="fw-semibold" style="font-size: 0.95rem;">
                            @if($inspection->mission)
                                <span class="badge rounded-pill px-3 py-1"
                                      style="background-color:rgba(22,131,255,.12); color:#1683ff; font-weight: 500;">
                                    <i class="bi bi-briefcase me-1"></i>
                                    {{ $inspection->mission->reference }}
                                </span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="text-muted d-block" style="font-size: 0.75rem; letter-spacing: 0.03em; font-weight: 600;">
                            Type d'inspection
                        </label>
                        <div>
                            <span class="badge rounded-pill px-3 py-1"
                                  style="background-color:{{ $classe['bg'] }}; color:{{ $classe['color'] }}; font-weight: 500;">
                                <i class="bi {{ $classe['icon'] }} me-1"></i>
                                {{ $classe['label'] }}
                            </span>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="text-muted d-block" style="font-size: 0.75rem; letter-spacing: 0.03em; font-weight: 600;">
                            Type d'essai
                        </label>
                        <div class="fw-semibold" style="font-size: 0.95rem;">
                            {{ ucfirst(str_replace('_', ' ', $inspection->type_essai ?? 'Non spécifié')) }}
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="text-muted d-block" style="font-size: 0.75rem; letter-spacing: 0.03em; font-weight: 600;">
                            Date
                        </label>
                        <div class="fw-semibold" style="font-size: 0.95rem;">
                            <i class="bi bi-calendar3 text-secondary me-1" style="font-size: 0.7rem;"></i>
                            {{ \Carbon\Carbon::parse($inspection->date)->format('d/m/Y') }}
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="text-muted d-block" style="font-size: 0.75rem; letter-spacing: 0.03em; font-weight: 600;">
                            Heure
                        </label>
                        <div class="fw-semibold" style="font-size: 0.95rem;">
                            <i class="bi bi-clock text-secondary me-1" style="font-size: 0.7rem;"></i>
                            {{ $inspection->heure ?? 'Non spécifiée' }}
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <label class="text-muted d-block" style="font-size: 0.75rem; letter-spacing: 0.03em; font-weight: 600;">
                            Technicien assermenté
                        </label>
                        <div class="fw-semibold" style="font-size: 0.95rem;">
                            @if($inspection->inspecteur)
                                <span class="badge rounded-pill px-3 py-1"
                                      style="background-color:rgba(108,117,125,.12); color:#6c757d; font-weight: 500;">
                                    <i class="bi bi-person-badge me-1"></i>
                                    {{ $inspection->inspecteur->name }}
                                </span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <!-- ÉTABLISSEMENT CONTRÔLÉ -->
        <div class="panel card border-0 shadow-sm rounded-4 mb-4">

            <div class="card-header bg-transparent border-0 px-4 pt-4 pb-3">

                <h2 class="h5 mb-0 fw-bold d-flex align-items-center gap-2 section-title">
                    <i class="bi bi-shop me-2"></i>
                    <span>Établissement contrôlé</span>
                </h2>

            </div>

            <div class="card-body px-4 pt-0 pb-4">

                <div class="row g-3">

                    <div class="col-12 col-md-6">
                        <label class="text-muted d-block" style="font-size: 0.75rem; letter-spacing: 0.03em; font-weight: 600;">
                            Établissement
                        </label>
                        <div class="fw-semibold" style="font-size: 0.95rem;">
                            <i class="bi bi-building text-secondary me-1" style="font-size: 0.7rem;"></i>
                            {{ $inspection->etablissement }}
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="text-muted d-block" style="font-size: 0.75rem; letter-spacing: 0.03em; font-weight: 600;">
                            Propriétaire
                        </label>
                        <div class="fw-semibold" style="font-size: 0.95rem;">
                            <i class="bi bi-person text-secondary me-1" style="font-size: 0.7rem;"></i>
                            {{ $inspection->nom_proprietaire }}
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="text-muted d-block" style="font-size: 0.75rem; letter-spacing: 0.03em; font-weight: 600;">
                            Téléphone
                        </label>
                        <div style="font-size: 0.95rem;">
                            <i class="bi bi-telephone text-secondary me-1" style="font-size: 0.7rem;"></i>
                            {{ $inspection->telephone ?? '-' }}
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="text-muted d-block" style="font-size: 0.75rem; letter-spacing: 0.03em; font-weight: 600;">
                            IFU / RCCM
                        </label>
                        <div style="font-size: 0.95rem;">
                            {{ $inspection->ifu ?? '-' }}
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="text-muted d-block" style="font-size: 0.75rem; letter-spacing: 0.03em; font-weight: 600;">
                            Adresse
                        </label>
                        <div style="font-size: 0.95rem;">
                            <i class="bi bi-geo-alt text-secondary me-1" style="font-size: 0.7rem;"></i>
                            {{ $inspection->adresse }}
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="text-muted d-block" style="font-size: 0.75rem; letter-spacing: 0.03em; font-weight: 600;">
                            Activité
                        </label>
                        <div class="p-3 rounded-3" style="background: #f8f9fc; font-size: 0.95rem; line-height: 1.6;">
                            {{ $inspection->activite }}
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <!-- OBSERVATIONS -->
        <div class="panel card border-0 shadow-sm rounded-4 mb-4">

            <div class="card-header bg-transparent border-0 px-4 pt-4 pb-3">

                <h2 class="h5 mb-0 fw-bold d-flex align-items-center gap-2 section-title">
                    <i class="bi bi-exclamation-circle me-2"></i>
                    <span>Observations</span>
                </h2>

            </div>

            <div class="card-body px-4 pt-0 pb-4">

                <div class="row g-3">

                    <div class="col-12 col-md-6">
                        <label class="text-muted d-block" style="font-size: 0.75rem; letter-spacing: 0.03em; font-weight: 600;">
                            Anomalies constatées
                        </label>
                        <div class="p-3 rounded-3" style="background: #f8f9fc; font-size: 0.95rem; min-height: 60px; border-left: 3px solid #dc3545;">
                            {{ $inspection->anomalies ?: 'Aucune anomalie renseignée.' }}
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="text-muted d-block" style="font-size: 0.75rem; letter-spacing: 0.03em; font-weight: 600;">
                            Amendes
                        </label>
                        <div class="p-3 rounded-3" style="background: #f8f9fc; font-size: 0.95rem; min-height: 60px; border-left: 3px solid #ffc107;">
                            @if($inspection->amendes)
                                <span class="fw-bold text-danger">
                                    {{ number_format((float)$inspection->amendes, 0, ',', ' ') }} FCFA
                                </span>
                            @else
                                Aucune amende renseignée.
                            @endif
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="text-muted d-block" style="font-size: 0.75rem; letter-spacing: 0.03em; font-weight: 600;">
                            Commentaires
                        </label>
                        <div class="p-3 rounded-3" style="background: #f8f9fc; font-size: 0.95rem; min-height: 60px; border-left: 3px solid #1683ff;">
                            {{ $inspection->commentaires ?: 'Aucun commentaire.' }}
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <!-- RÉSULTATS DÉTAILLÉS -->
        <div class="panel card border-0 shadow-sm rounded-4 mb-4">

            <div class="card-header bg-transparent border-0 px-4 pt-4 pb-3">

                <h2 class="h5 mb-0 fw-bold d-flex align-items-center gap-2 section-title">
                    <i class="bi bi-file-earmark-text me-2"></i>
                    <span>Résultats détaillés de l'inspection</span>
                </h2>

            </div>

            <div class="card-body px-4 pt-0 pb-4">

                @if($inspection->type_inspection == 'preemballe')

                    @include('inspections.preemballes.show')

                @elseif($inspection->type_inspection == 'pesage')

                    @include('inspections.pesages.show')

                @elseif($inspection->type_inspection == 'volume')

                    @include('inspections.volumes.show')

                @else

                    <p class="text-muted text-center py-3 mb-0" style="font-size: 0.9rem;">
                        <i class="bi bi-info-circle me-1"></i>
                        Aucun résultat détaillé disponible pour ce type d'inspection.
                    </p>

                @endif

            </div>

        </div>

    </div>

</main>

@endsection