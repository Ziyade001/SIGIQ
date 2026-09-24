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
                                Nouvelle inspection
                            </li>
                        </ol>
                    </nav>

                    <h1 class="h3 mb-1 fw-bold">
                        Créer une inspection
                    </h1>

                    <p class="text-muted mb-0" style="font-size: 0.9rem;">
                        Enregistrer une nouvelle opération d'inspection.
                    </p>

                </div>

            </div>

            <div class="heading-actions">

                <a href="{{ route('inspections.index') }}"
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

        <form action="{{ route('inspections.store') }}" method="POST">

            @csrf

            <div class="row g-4">

                <!-- COLONNE GAUCHE : INFORMATIONS PRINCIPALES -->
                <div class="col-12 col-lg-8">

                    <div class="panel card border-0 shadow-sm rounded-4">

                        <div class="card-header bg-transparent border-0 px-4 pt-4 pb-3">

                            <h2 class="h5 mb-0 fw-bold d-flex align-items-center gap-2 section-title">
                                <i class="bi bi-info-circle me-2"></i>
                                <span>Informations générales</span>
                            </h2>

                        </div>

                        <div class="card-body px-4 pt-0 pb-4">

                            <div class="row g-3">

                                <!-- Mission -->
                                <div class="col-12 col-md-6">

                                    <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                        Mission <span class="text-danger">*</span>
                                    </label>

                                    <select name="mission_id"
                                            id="mission_id"
                                            class="form-select form-select-sm rounded-3"
                                            style="border-color: #e9ecef;"
                                            required>

                                        <option value="">
                                            -- Sélectionner une mission --
                                        </option>

                                        @foreach($missions as $mission)

                                            @if($mission->statut === 'en_cours')

                                                <option value="{{ $mission->id }}"
                                                        data-type="{{ $mission->type_mission }}"
                                                        {{ old('mission_id') == $mission->id ? 'selected' : '' }}>
                                                    {{ $mission->reference }} - {{ $mission->type_mission }}
                                                </option>

                                            @endif

                                        @endforeach

                                    </select>

                                    @error('mission_id')
                                        <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                                    @enderror

                                </div>

                                <!-- Type d'inspection -->
                                <div class="col-12 col-md-6">

                                    <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                        Type d'inspection <span class="text-danger">*</span>
                                    </label>

                                    <div id="typeInspectionContainer">

                                        <select name="type_inspection"
                                                id="type_inspection"
                                                class="form-select form-select-sm rounded-3"
                                                style="border-color: #e9ecef;"
                                                required>

                                            <option value="">
                                                -- Sélectionner une mission d'abord --
                                            </option>

                                        </select>

                                    </div>

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

                                        <option value="">
                                            -- Sélectionner --
                                        </option>

                                        <option value="verification_primitive" {{ old('type_essai') == 'verification_primitive' ? 'selected' : '' }}>
                                            Vérification primitive
                                        </option>

                                        <option value="verification_periodique" {{ old('type_essai') == 'verification_periodique' ? 'selected' : '' }}>
                                            Vérification périodique
                                        </option>

                                    </select>

                                    @error('type_essai')
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
                                           value="{{ old('date') }}"
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
                                           value="{{ old('heure') }}"
                                           required>

                                    @error('heure')
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
                                           value="{{ old('etablissement') }}"
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
                                           value="{{ old('ifu') }}"
                                           placeholder="Ex : 3202112345678">

                                    @error('ifu')
                                        <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                                    @enderror

                                </div>

                                <!-- Propriétaire -->
                                <div class="col-12 col-md-6">

                                    <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                        Nom et prénoms du propriétaire <span class="text-danger">*</span>
                                    </label>

                                    <input type="text"
                                           name="nom_proprietaire"
                                           class="form-control form-control-sm rounded-3"
                                           style="border-color: #e9ecef;"
                                           value="{{ old('nom_proprietaire') }}"
                                           placeholder="Nom complet du propriétaire"
                                           required>

                                    @error('nom_proprietaire')
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
                                           value="{{ old('telephone') }}"
                                           placeholder="Ex : 01 23 45 67 89">

                                    @error('telephone')
                                        <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                                    @enderror

                                </div>

                                <!-- Adresse -->
                                <div class="col-12">

                                    <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                        Adresse <span class="text-danger">*</span>
                                    </label>

                                    <input type="text"
                                           name="adresse"
                                           class="form-control form-control-sm rounded-3"
                                           style="border-color: #e9ecef;"
                                           value="{{ old('adresse') }}"
                                           placeholder="Adresse complète"
                                           required>

                                    @error('adresse')
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
                                              required>{{ old('activite') }}</textarea>

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
                                              rows="2"
                                              class="form-control form-control-sm rounded-3"
                                              style="border-color: #e9ecef;"
                                              placeholder="Listez les anomalies éventuelles...">{{ old('anomalies') }}</textarea>

                                    @error('anomalies')
                                        <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                                    @enderror

                                </div>

                                <!-- Amendes -->
                                <div class="col-12 col-md-6">

                                    <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                        Amendes
                                    </label>

                                    <input type="text"
                                           name="amendes"
                                           class="form-control form-control-sm rounded-3"
                                           style="border-color: #e9ecef;"
                                           value="{{ old('amendes') }}"
                                           placeholder="Montant des amendes">

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
                                              rows="2"
                                              class="form-control form-control-sm rounded-3"
                                              style="border-color: #e9ecef;"
                                              placeholder="Commentaires supplémentaires...">{{ old('commentaires') }}</textarea>

                                    @error('commentaires')
                                        <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                                    @enderror

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- COLONNE DROITE : RÉSUMÉ -->
                <div class="col-12 col-lg-4">

                    <div class="panel card border-0 shadow-sm rounded-4">

                        <div class="card-header bg-transparent border-0 px-4 pt-4 pb-3">

                            <h2 class="h5 mb-0 fw-bold d-flex align-items-center gap-2 section-title">
                                <i class="bi bi-list-check me-2"></i>
                                <span>Résumé</span>
                            </h2>

                        </div>

                        <div class="card-body px-4 pt-0 pb-4">

                            <p class="text-muted mb-3" style="font-size: 0.9rem;">
                                Après validation, vous serez redirigé vers le formulaire spécifique correspondant au type d'inspection sélectionné.
                            </p>

                            <div class="border rounded-3 p-3 bg-light">

                                <h6 class="fw-semibold mb-2" style="font-size: 0.85rem;">
                                    <i class="bi bi-tags text-primary me-1"></i>
                                    Types d'inspection disponibles
                                </h6>

                                <ul class="list-unstyled mb-0 ps-2">

                                    <li class="py-1 d-flex align-items-center gap-2" style="font-size: 0.85rem;">
                                        <span class="badge rounded-pill"
                                              style="background-color:rgba(5,158,51,.12); color:#059e33; width: 8px; height: 8px; padding: 0; border-radius: 50%;"></span>
                                        Préemballé
                                    </li>

                                    <li class="py-1 d-flex align-items-center gap-2" style="font-size: 0.85rem;">
                                        <span class="badge rounded-pill"
                                              style="background-color:rgba(255,193,7,.12); color:#ffc107; width: 8px; height: 8px; padding: 0; border-radius: 50%;"></span>
                                        Instruments de pesage
                                    </li>

                                    <li class="py-1 d-flex align-items-center gap-2" style="font-size: 0.85rem;">
                                        <span class="badge rounded-pill"
                                              style="background-color:rgba(22,131,255,.12); color:#1683ff; width: 8px; height: 8px; padding: 0; border-radius: 50%;"></span>
                                        Instruments de volume
                                    </li>

                                </ul>

                            </div>

                        </div>

                    </div>

                    <!-- Actions -->
                    <div class="d-grid gap-2 mt-3">

                        <button type="submit"
                                class="btn btn-primary rounded-pill py-2"
                                style="font-weight: 500; background-color:#059e33; border-color:#059e33;">
                            <i class="bi bi-check-circle me-2"></i>
                            Continuer
                        </button>

                        <a href="{{ route('inspections.index') }}"
                           class="btn btn-outline-secondary rounded-pill py-2"
                           style="font-weight: 500;">
                            <i class="bi bi-x-circle me-2"></i>
                            Annuler
                        </a>

                    </div>

                </div>

            </div>

        </form>

    </div>

</main>

@endsection

@push('scripts')
<script>

document.addEventListener('DOMContentLoaded', function () {

    const missionSelect = document.getElementById('mission_id');
    const container = document.getElementById('typeInspectionContainer');

    function updateTypeInspection() {

        const selected = missionSelect.options[missionSelect.selectedIndex];
        const typeMission = selected.dataset.type;

        // Si aucune mission sélectionnée
        if (!missionSelect.value || !typeMission) {

            container.innerHTML = `
                <select name="type_inspection"
                        id="type_inspection"
                        class="form-select form-select-sm rounded-3"
                        style="border-color: #e9ecef;"
                        required>
                    <option value="">
                        -- Sélectionner une mission d'abord --
                    </option>
                </select>
            `;
            return;
        }

        // Mission Préemballés
        if (typeMission === 'Préemballés') {

            container.innerHTML = `
                <input type="text"
                       class="form-control form-control-sm rounded-3"
                       style="border-color: #e9ecef; background-color: #f8f9fc; font-weight: 500;"
                       value="Préemballé"
                       readonly>

                <input type="hidden"
                       name="type_inspection"
                       value="preemballe">
            `;
        }

        // Mission Instruments de mesures
        else if (typeMission === 'Instruments de mesures') {

            container.innerHTML = `
                <select name="type_inspection"
                        id="type_inspection"
                        class="form-select form-select-sm rounded-3"
                        style="border-color: #e9ecef;"
                        required>
                    <option value="">
                        -- Sélectionner --
                    </option>
                    <option value="pesage" {{ old('type_inspection') == 'pesage' ? 'selected' : '' }}>
                        Pesage
                    </option>
                    <option value="volume" {{ old('type_inspection') == 'volume' ? 'selected' : '' }}>
                        Volume
                    </option>
                </select>
            `;
        }

        else {

            container.innerHTML = `
                <select name="type_inspection"
                        id="type_inspection"
                        class="form-select form-select-sm rounded-3"
                        style="border-color: #e9ecef;"
                        required>
                    <option value="">
                        -- Sélectionner --
                    </option>
                </select>
            `;
        }
    }

    // Événement de changement
    missionSelect.addEventListener('change', updateTypeInspection);

    // Initialisation au chargement si une mission est pré-sélectionnée
    if (missionSelect.value) {
        updateTypeInspection();
    }

});

</script>
@endpush