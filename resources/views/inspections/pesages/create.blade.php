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
                                Pesage
                            </li>
                        </ol>
                    </nav>

                    <h1 class="h3 mb-1 fw-bold d-flex align-items-center gap-2">
                        Inspection de pesage
                        <span class="badge rounded-pill px-3 py-2"
                              style="background-color:rgba(5,158,51,.12); color:#059e33; font-size: 0.7rem; font-weight: 600;">
                            {{ $inspection->reference }}
                        </span>
                    </h1>

                    <p class="text-muted mb-0" style="font-size: 0.9rem;">
                        Contrôle des instruments de pesage.
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
                    'preemballe' => ['bg' => 'rgba(5,158,51,.12)', 'color' => '#059e33', 'icon' => 'bi-box-seam', 'label' => 'Préemballé'],
                    'pesage' => ['bg' => 'rgba(255,193,7,.12)', 'color' => '#ffc107', 'icon' => 'bi-scale', 'label' => 'Pesage'],
                    'volume' => ['bg' => 'rgba(22,131,255,.12)', 'color' => '#1683ff', 'icon' => 'bi-droplet', 'label' => 'Volume'],
                ];
                $type = $inspection->type_inspection ?? 'pesage';
                $classe = $typeClasses[$type] ?? $typeClasses['pesage'];
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

        <form method="POST" action="{{ route('inspections.pesages.store', $inspection) }}">

            @csrf

            <!-- IDENTIFICATION DE L'INSTRUMENT -->
            <div class="panel card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-header bg-transparent border-0 px-4 pt-4 pb-3">

                    <h2 class="h5 mb-0 fw-bold d-flex align-items-center gap-2 section-title">
                        <i class="bi bi-info-circle me-2"></i>
                        <span>Identification de l'instrument</span>
                    </h2>

                </div>

                <div class="card-body px-4 pt-0 pb-4">

                    <div class="row g-3">

                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Instrument <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   name="instrument"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('instrument') }}"
                                   placeholder="Nom de l'instrument"
                                   required>

                            @error('instrument')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Marque
                            </label>

                            <input type="text"
                                   name="marque"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('marque') }}"
                                   placeholder="Marque de l'instrument">

                            @error('marque')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Numéro de série
                            </label>

                            <input type="text"
                                   name="numero_serie"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('numero_serie') }}"
                                   placeholder="Numéro de série">

                            @error('numero_serie')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <div class="col-12 col-md-3">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Portée max
                            </label>

                            <input type="number"
                                   step="0.001"
                                   name="portee_max"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('portee_max') }}"
                                   placeholder="0.000">

                            @error('portee_max')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <div class="col-12 col-md-3">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Portée min
                            </label>

                            <input type="number"
                                   step="0.001"
                                   name="portee_min"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('portee_min') }}"
                                   placeholder="0.000">

                            @error('portee_min')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Échelon vérification
                            </label>

                            <input type="text"
                                   name="echelon_verification"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('echelon_verification') }}"
                                   placeholder="Ex : 0.001 g">

                            @error('echelon_verification')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Échelon affichage
                            </label>

                            <input type="text"
                                   name="echelon_affichage"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('echelon_affichage') }}"
                                   placeholder="Ex : 0.001 g">

                            @error('echelon_affichage')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Année fabrication
                            </label>

                            <input type="number"
                                   name="annee_fabrication"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('annee_fabrication') }}"
                                   placeholder="AAAA"
                                   min="1900"
                                   max="{{ date('Y') }}">

                            @error('annee_fabrication')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Approbation modèle
                            </label>

                            <input type="text"
                                   name="numero_approbation_modele"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('numero_approbation_modele') }}"
                                   placeholder="Numéro d'approbation">

                            @error('numero_approbation_modele')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <div class="col-12">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Infractions constatées
                            </label>

                            <textarea name="infractions_constatees"
                                      rows="3"
                                      class="form-control form-control-sm rounded-3"
                                      style="border-color: #e9ecef;"
                                      placeholder="Listez les infractions éventuelles...">{{ old('infractions_constatees') }}</textarea>

                            @error('infractions_constatees')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                    </div>

                </div>

            </div>

            <!-- ACTIONS -->
            <div class="d-flex flex-wrap align-items-center justify-content-end gap-2">

                <a href="{{ route('inspections.show', $inspection) }}"
                   class="btn btn-outline-secondary rounded-pill px-4 py-2"
                   style="font-weight: 500;">
                    <i class="bi bi-x-circle me-2"></i>
                    Annuler
                </a>

                <button type="submit"
                        class="btn btn-primary rounded-pill px-4 py-2"
                        style="font-weight: 500; background-color:#059e33; border-color:#059e33;">
                    <i class="bi bi-check-circle me-2"></i>
                    Enregistrer
                </button>

            </div>

        </form>

    </div>

</main>

@endsection