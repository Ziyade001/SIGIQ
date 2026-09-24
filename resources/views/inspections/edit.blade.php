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
                                <a href="{{ route('inspections.index') }}">
                                    Inspections
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('inspections.show', $inspection) }}">
                                    {{ $inspection->reference }}
                                </a>
                            </li>
                            <li class="breadcrumb-item active text-secondary" aria-current="page">
                                Modifier
                            </li>
                        </ol>
                    </nav>

                    <h1 class="h3 mb-1 fw-bold d-flex align-items-center gap-2">
                        Modifier une inspection
                        <span class="badge rounded-pill px-3 py-2"
                              style="background-color:rgba(255,193,7,.12); color:#ffc107; font-size: 0.7rem; font-weight: 600;">
                            {{ $inspection->reference }}
                        </span>
                    </h1>

                    <p class="text-muted mb-0" style="font-size: 0.9rem;">
                        Mise à jour des informations de l'inspection.
                    </p>

                </div>

            </div>

            <div class="heading-actions">

                <a href="{{ route('inspections.show', $inspection) }}"
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

                @if($inspection->mission)
                    <span class="badge rounded-pill px-3 py-1"
                          style="background-color:rgba(22,131,255,.12); color:#1683ff; font-weight: 500; font-size: 0.7rem;">
                        <i class="bi bi-briefcase me-1"></i>
                        {{ $inspection->mission->reference }}
                    </span>
                @endif

            </div>

        </div>

        <!-- ALERTES D'ERREURS -->
        @if ($errors->any())

            <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4" style="border-left: 4px solid #dc3545;">

                <div class="d-flex align-items-start gap-2">

                    <i class="bi bi-exclamation-triangle-fill text-danger mt-1" style="font-size: 1.2rem;"></i>

                    <div>

                        <strong class="d-block mb-1">Veuillez corriger les erreurs suivantes :</strong>

                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li style="font-size: 0.9rem;">{{ $error }}</li>
                            @endforeach
                        </ul>

                    </div>

                </div>

            </div>

        @endif

        <form action="{{ route('inspections.update', $inspection) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="panel card border-0 shadow-sm rounded-4">

                <div class="card-header bg-transparent border-0 px-4 pt-4 pb-3">

                    <h2 class="h5 mb-0 fw-bold d-flex align-items-center gap-2 section-title">
                        <i class="bi bi-info-circle me-2"></i>
                        <span>Informations de l'inspection</span>
                    </h2>

                </div>

                <div class="card-body px-4 pt-0 pb-4">

                    <div class="row g-3">

                        <!-- Type d'inspection -->
                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Type d'inspection <span class="text-danger">*</span>
                            </label>

                            <select name="type_inspection"
                                    class="form-select form-select-sm rounded-3"
                                    style="border-color: #e9ecef;"
                                    required>

                                <option value="preemballe"
                                    {{ old('type_inspection', $inspection->type_inspection) == 'preemballe' ? 'selected' : '' }}>
                                    Préemballé
                                </option>

                                <option value="pesage"
                                    {{ old('type_inspection', $inspection->type_inspection) == 'pesage' ? 'selected' : '' }}>
                                    Pesage
                                </option>

                                <option value="volume"
                                    {{ old('type_inspection', $inspection->type_inspection) == 'volume' ? 'selected' : '' }}>
                                    Volume
                                </option>

                            </select>

                            @error('type_inspection')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <!-- Type d'essai -->
                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Type d'essai <span class="text-danger">*</span>
                            </label>

                            <select name="type_essai"
                                    class="form-select form-select-sm rounded-3"
                                    style="border-color: #e9ecef;"
                                    required>

                                <option value="verification_primitive"
                                    {{ old('type_essai', $inspection->type_essai) == 'verification_primitive' ? 'selected' : '' }}>
                                    Vérification primitive
                                </option>

                                <option value="verification_periodique"
                                    {{ old('type_essai', $inspection->type_essai) == 'verification_periodique' ? 'selected' : '' }}>
                                    Vérification périodique
                                </option>

                            </select>

                            @error('type_essai')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <!-- Établissement -->
                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Établissement <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   name="etablissement"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('etablissement', $inspection->etablissement) }}"
                                   placeholder="Nom de l'établissement"
                                   required>

                            @error('etablissement')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <!-- IFU / RCCM -->
                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Numéro IFU ou RCCM
                            </label>

                            <input type="text"
                                   name="ifu"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('ifu', $inspection->ifu) }}"
                                   placeholder="Ex : 3202112345678">

                            @error('ifu')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <!-- Adresse -->
                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Adresse <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   name="adresse"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('adresse', $inspection->adresse) }}"
                                   placeholder="Adresse complète"
                                   required>

                            @error('adresse')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <!-- Téléphone -->
                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Téléphone
                            </label>

                            <input type="text"
                                   name="telephone"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('telephone', $inspection->telephone) }}"
                                   placeholder="Ex : 01 23 45 67 89">

                            @error('telephone')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <!-- Nom propriétaire -->
                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Nom du propriétaire <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   name="nom_proprietaire"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('nom_proprietaire', $inspection->nom_proprietaire) }}"
                                   placeholder="Nom complet du propriétaire"
                                   required>

                            @error('nom_proprietaire')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <!-- Date -->
                        <div class="col-12 col-md-3">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Date <span class="text-danger">*</span>
                            </label>

                            <input type="date"
                                   name="date"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('date', $inspection->date) }}"
                                   required>

                            @error('date')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <!-- Heure -->
                        <div class="col-12 col-md-3">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Heure <span class="text-danger">*</span>
                            </label>

                            <input type="time"
                                   name="heure"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('heure', $inspection->heure) }}"
                                   required>

                            @error('heure')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <!-- Activité -->
                        <div class="col-12">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Activité <span class="text-danger">*</span>
                            </label>

                            <textarea name="activite"
                                      rows="3"
                                      class="form-control form-control-sm rounded-3"
                                      style="border-color: #e9ecef;"
                                      placeholder="Décrivez l'activité de l'établissement"
                                      required>{{ old('activite', $inspection->activite) }}</textarea>

                            @error('activite')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <!-- Anomalies -->
                        <div class="col-12">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Anomalies constatées
                            </label>

                            <textarea name="anomalies"
                                      rows="3"
                                      class="form-control form-control-sm rounded-3"
                                      style="border-color: #e9ecef;"
                                      placeholder="Listez les anomalies éventuelles...">{{ old('anomalies', $inspection->anomalies) }}</textarea>

                            @error('anomalies')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <!-- Amende -->
                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Amende
                            </label>

                            <input type="text"
                                   name="amendes"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('amendes', $inspection->amendes) }}"
                                   placeholder="Montant de l'amende">

                            @error('amendes')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <!-- Commentaires -->
                        <div class="col-12">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Commentaires
                            </label>

                            <textarea name="commentaires"
                                      rows="3"
                                      class="form-control form-control-sm rounded-3"
                                      style="border-color: #e9ecef;"
                                      placeholder="Commentaires supplémentaires...">{{ old('commentaires', $inspection->commentaires) }}</textarea>

                            @error('commentaires')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                    </div>

                </div>

                <div class="card-footer bg-transparent border-0 d-flex flex-wrap align-items-center justify-content-end gap-2 px-4 pb-4 pt-0">

                    <a href="{{ route('inspections.index') }}"
                       class="btn btn-outline-secondary rounded-pill px-4 py-2"
                       style="font-weight: 500;">
                        <i class="bi bi-x-circle me-2"></i>
                        Annuler
                    </a>

                    <button type="submit"
                            class="btn btn-primary rounded-pill px-4 py-2"
                            style="font-weight: 500; background-color:#059e33; border-color:#059e33;">
                        <i class="bi bi-check-circle me-2"></i>
                        Mettre à jour
                    </button>

                </div>

            </div>

        </form>

    </div>

</main>

@endsection