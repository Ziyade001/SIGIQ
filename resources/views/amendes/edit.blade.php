@extends('dashboards.index')

@section('content')

<main class="dashboard-content">

    <div class="container-fluid px-3 px-lg-4 py-4">

        <!-- PAGE HEADER -->
        <div class="page-heading d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">

            <div class="page-heading-copy d-flex align-items-center gap-3 section-title">

                <span class="page-icon">
                    <i class="bi bi-pencil-square" aria-hidden="true"></i>
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
                                <a href="{{ route('amendes.index') }}">
                                    Amendes
                                </a>
                            </li>
                            <li class="breadcrumb-item active text-secondary" aria-current="page">
                                Mise à jour du paiement
                            </li>
                        </ol>
                    </nav>

                    <h1 class="h3 mb-1 fw-bold d-flex align-items-center gap-2">
                        Mise à jour du paiement
                        <span class="badge rounded-pill px-3 py-2"
                              style="background-color:rgba(5,158,51,.12); color:#059e33; font-size: 0.7rem; font-weight: 600;">
                            {{ $amende->id }}
                        </span>
                    </h1>

                    <p class="text-muted mb-0" style="font-size: 0.9rem;">
                        Enregistrement du paiement d'une amende.
                    </p>

                </div>

            </div>

            <div class="heading-actions">

                <a href="{{ route('amendes.index') }}"
                   class="btn btn-outline-secondary btn-sm rounded-pill px-3"
                   style="font-weight: 500;">
                    <i class="bi bi-arrow-left me-1"></i>
                    Retour
                </a>

            </div>

        </div>

        <!-- ALERTES D'ERREURS -->
        @if($errors->any())

            <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4" style="border-left: 4px solid #dc3545;">

                <div class="d-flex align-items-start gap-2">

                    <i class="bi bi-exclamation-triangle-fill text-danger mt-1" style="font-size: 1.2rem;"></i>

                    <div>

                        <strong class="d-block mb-1">Veuillez corriger les erreurs suivantes :</strong>

                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $error)
                                <li style="font-size: 0.9rem;">{{ $error }}</li>
                            @endforeach
                        </ul>

                    </div>

                </div>

            </div>

        @endif

        <!-- RÉSUMÉ DE L'AMENDE -->
        @php
            $montantImpaye = $amende->montant_total - $amende->montant_paye;
            $pourcentagePaye = $amende->montant_total > 0 ? round(($amende->montant_paye / $amende->montant_total) * 100) : 0;
        @endphp

        <div class="row g-3 mb-4">

            <div class="col-12 col-md-4">

                <div class="card border-0 shadow-sm rounded-4 text-center p-3" style="border-top: 4px solid #dc3545;">

                    <small class="text-muted text-uppercase fw-semibold" style="font-size: 0.65rem; letter-spacing: 0.03em;">
                        Montant total
                    </small>

                    <h3 class="fw-bold mb-0 mt-1 text-danger">
                        {{ number_format($amende->montant_total, 0, ',', ' ') }} FCFA
                    </h3>

                </div>

            </div>

            <div class="col-12 col-md-4">

                <div class="card border-0 shadow-sm rounded-4 text-center p-3" style="border-top: 4px solid #059e33;">

                    <small class="text-muted text-uppercase fw-semibold" style="font-size: 0.65rem; letter-spacing: 0.03em;">
                        Montant déjà payé
                    </small>

                    <h3 class="fw-bold mb-0 mt-1 text-success">
                        {{ number_format($amende->montant_paye, 0, ',', ' ') }} FCFA
                    </h3>

                </div>

            </div>

            <div class="col-12 col-md-4">

                <div class="card border-0 shadow-sm rounded-4 text-center p-3" style="border-top: 4px solid #ffc107;">

                    <small class="text-muted text-uppercase fw-semibold" style="font-size: 0.65rem; letter-spacing: 0.03em;">
                        Reste à payer
                    </small>

                    <h3 class="fw-bold mb-0 mt-1 text-warning">
                        {{ number_format($montantImpaye, 0, ',', ' ') }} FCFA
                    </h3>

                </div>

            </div>

        </div>

        <!-- PROGRESSION DU PAIEMENT -->
        <div class="card border-0 shadow-sm rounded-4 mb-4 p-3">

            <div class="d-flex justify-content-between align-items-center mb-2">

                <span class="fw-semibold" style="font-size: 0.85rem;">
                    Progression du paiement
                </span>

                <span class="badge rounded-pill px-3 py-2
                    @if($pourcentagePaye >= 100) bg-success
                    @elseif($pourcentagePaye >= 50) bg-warning
                    @else bg-danger @endif"
                    style="font-size: 0.75rem; font-weight: 600;">
                    @if($pourcentagePaye >= 100)
                        <i class="bi bi-check-circle-fill me-1"></i>
                    @elseif($pourcentagePaye >= 50)
                        <i class="bi bi-clock me-1"></i>
                    @else
                        <i class="bi bi-exclamation-circle me-1"></i>
                    @endif
                    {{ $pourcentagePaye }}%
                </span>

            </div>

            <div class="progress" style="height: 8px; border-radius: 10px; background: #e9ecef;">

                <div class="progress-bar
                    @if($pourcentagePaye >= 100) bg-success
                    @elseif($pourcentagePaye >= 50) bg-warning
                    @else bg-danger @endif"
                    role="progressbar"
                    style="width: {{ min($pourcentagePaye, 100) }}%; border-radius: 10px; transition: width 0.5s ease;"
                    aria-valuenow="{{ $pourcentagePaye }}"
                    aria-valuemin="0"
                    aria-valuemax="100">
                </div>

            </div>

            @if($pourcentagePaye >= 100)
                <small class="text-success mt-2 d-flex align-items-center gap-1">
                    <i class="bi bi-check-circle-fill"></i>
                    Cette amende est entièrement payée.
                </small>
            @else
                <small class="text-muted mt-2" style="font-size: 0.75rem;">
                    Il reste <span class="fw-semibold">{{ number_format($montantImpaye, 0, ',', ' ') }} FCFA</span> à payer.
                </small>
            @endif

        </div>

        <!-- FORMULAIRE -->
        <div class="panel card border-0 shadow-sm rounded-4">

            <div class="card-header bg-transparent border-0 px-4 pt-4 pb-3">

                <h2 class="h5 mb-0 fw-bold d-flex align-items-center gap-2 section-title">
                    <i class="bi bi-info-circle me-2"></i>
                    <span>Informations du paiement</span>
                </h2>

            </div>

            <div class="card-body px-4 pt-0 pb-4">

                <form action="{{ route('amendes.update', $amende) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="row g-3">

                        <!-- Établissement (lecture seule) -->
                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Établissement
                            </label>

                            <input type="text"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef; background-color: #f8f9fc;"
                                   value="{{ $amende->ifu }}"
                                   readonly>

                        </div>

                        <!-- Montant total (lecture seule) -->
                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Montant total
                            </label>

                            <input type="text"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef; background-color: #f8f9fc; color: #dc3545; font-weight: 600;"
                                   value="{{ number_format($amende->montant_total, 0, ',', ' ') }} FCFA"
                                   readonly>

                        </div>

                        <!-- Référence inspection (lecture seule) -->
                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Référence inspection
                            </label>

                            <input type="text"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef; background-color: #f8f9fc;"
                                   value="{{ $amende->reference_inspection ?? 'Non spécifiée' }}"
                                   readonly>

                        </div>

                        <!-- Montant déjà payé (lecture seule) -->
                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Montant déjà payé
                            </label>

                            <input type="text"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef; background-color: #f8f9fc; color: #059e33; font-weight: 600;"
                                   value="{{ number_format($amende->montant_paye, 0, ',', ' ') }} FCFA"
                                   readonly>

                        </div>

                        <!-- Montant à payer (modifiable) -->
                        <div class="col-12">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Montant à payer <span class="text-danger">*</span>
                            </label>

                            <input type="number"
                                   name="montant_paye"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('montant_paye', $amende->montant_paye) }}"
                                   min="0"
                                   max="{{ $amende->montant_total }}"
                                   placeholder="0"
                                   required>

                            <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">
                                Montant maximum : {{ number_format($amende->montant_total, 0, ',', ' ') }} FCFA
                            </small>

                            @error('montant_paye')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                    </div>

                    <!-- Actions -->
                    <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mt-4">

                        <a href="{{ route('amendes.index') }}"
                           class="btn btn-outline-secondary rounded-pill px-4 py-2"
                           style="font-weight: 500;">
                            <i class="bi bi-x-circle me-2"></i>
                            Annuler
                        </a>

                        <button type="submit"
                                class="btn btn-success rounded-pill px-4 py-2"
                                style="font-weight: 500; background-color:#059e33; border-color:#059e33;">
                            <i class="bi bi-check-circle me-2"></i>
                            Enregistrer
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</main>

@endsection