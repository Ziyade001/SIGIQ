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
                                <a href="{{ route('missions.index') }}">
                                    Missions
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('missions.show', $mission) }}">
                                    {{ $mission->reference }}
                                </a>
                            </li>
                            <li class="breadcrumb-item active text-secondary" aria-current="page">
                                Modifier
                            </li>
                        </ol>
                    </nav>

                    <h1 class="h3 mb-1 fw-bold d-flex align-items-center gap-2">
                        Modifier la mission
                        <span class="badge rounded-pill px-3 py-2" 
                              style="background-color:rgba(5,158,51,.12); color:#059e33; font-size: 0.7rem; font-weight: 600;">
                            {{ $mission->reference }}
                        </span>
                    </h1>

                    <p class="text-muted mb-0" style="font-size: 0.9rem;">
                        Mise à jour des informations de la mission.
                    </p>

                </div>

            </div>

            <div class="heading-actions">

                <a href="{{ route('missions.show', $mission) }}" 
                   class="btn btn-outline-secondary btn-sm rounded-pill px-3" 
                   style="font-weight: 500;">
                    <i class="bi bi-arrow-left me-1"></i>
                    Retour
                </a>

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

        <!-- FORMULAIRE -->
        <form action="{{ route('missions.update', $mission) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="row g-4">

                <!-- COLONNE GAUCHE : INFORMATIONS GÉNÉRALES -->
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

                                <!-- Date début -->
                                <div class="col-12 col-md-6">

                                    <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                        Date de début <span class="text-danger">*</span>
                                    </label>

                                    <input type="date"
                                           name="periode_debut"
                                           value="{{ old('periode_debut', $mission->periode_debut) }}"
                                           class="form-control form-control-sm rounded-3"
                                           style="border-color: #e9ecef;"
                                           required>

                                    @error('periode_debut')
                                        <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                                    @enderror

                                </div>

                                <!-- Date fin -->
                                <div class="col-12 col-md-6">

                                    <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                        Date de fin <span class="text-danger">*</span>
                                    </label>

                                    <input type="date"
                                           name="periode_fin"
                                           value="{{ old('periode_fin', $mission->periode_fin) }}"
                                           class="form-control form-control-sm rounded-3"
                                           style="border-color: #e9ecef;"
                                           required>

                                    @error('periode_fin')
                                        <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                                    @enderror

                                </div>

                                <!-- Type de mission -->
                                <div class="col-12 col-md-6">

                                    <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                        Type de mission <span class="text-danger">*</span>
                                    </label>

                                    @php
                                        $typesMission = [
                                            'Préemballés',
                                            'Instruments de mesures',
                                        ];
                                    @endphp

                                    <select name="type_mission"
                                            class="form-select form-select-sm rounded-3"
                                            style="border-color: #e9ecef;"
                                            >

                                        <option value="">
                                            -- Sélectionner un type --
                                        </option>

                                        @foreach ($typesMission as $type)
                                            <option value="{{ $type }}"
                                                {{ old('type_mission', $mission->type_mission) == $type ? 'selected' : '' }}>
                                                {{ $type }}
                                            </option>
                                        @endforeach

                                    </select>

                                    @error('type_mission')
                                        <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                                    @enderror

                                </div>

                                <!-- Catégorie -->
                                <div class="col-12 col-md-6">

                                    <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                        Catégorie <span class="text-danger">*</span>
                                    </label>

                                    @php
                                        $categories = [
                                            'Plaintes',
                                            'Ordre de Mission',
                                        ];
                                    @endphp

                                    <select name="categorie"
                                            class="form-select form-select-sm rounded-3"
                                            style="border-color: #e9ecef;"
                                            >

                                        <option value="">
                                            -- Sélectionner une catégorie --
                                        </option>

                                        @foreach ($categories as $categorie)
                                            <option value="{{ $categorie }}"
                                                {{ old('categorie', $mission->categorie) == $categorie ? 'selected' : '' }}>
                                                {{ $categorie }}
                                            </option>
                                        @endforeach

                                    </select>

                                    @error('categorie')
                                        <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                                    @enderror

                                </div>

                                <!-- Localités -->
                                <div class="col-12 col-md-6">

                                    <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                        Localités concernées <span class="text-danger">*</span>
                                    </label>

                                    <input type="text"
                                           name="localites"
                                           value="{{ old('localites', $mission->localites) }}"
                                           class="form-control form-control-sm rounded-3"
                                           style="border-color: #e9ecef;"
                                           placeholder="Ex : Cotonou, Porto-Novo"
                                           >

                                    @error('localites')
                                        <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                                    @enderror

                                </div>

                                <!-- Véhicule -->
                                <div class="col-12 col-md-6">

                                    <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                        Véhicule affecté
                                    </label>

                                    <input type="text"
                                           name="vehicule"
                                           value="{{ old('vehicule', $mission->vehicule) }}"
                                           class="form-control form-control-sm rounded-3"
                                           style="border-color: #e9ecef;"
                                           placeholder="Immatriculation ou modèle">

                                    @error('vehicule')
                                        <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                                    @enderror

                                </div>

                                <!-- Conducteur -->
                                <div class="col-12 col-md-6">

                                    <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                        Conducteur (CVA)
                                    </label>

                                    @php
                                        $conducteurs = ['Alban', 'Fiacre', 'Jacob', 'Paul'];
                                    @endphp

                                    <select name="conducteur_cva"
                                            class="form-select form-select-sm rounded-3"
                                            style="border-color: #e9ecef;">

                                        <option value="">
                                            -- Sélectionner un conducteur --
                                        </option>

                                        @foreach ($conducteurs as $conducteur)
                                            <option value="{{ $conducteur }}"
                                                {{ old('conducteur_cva', $mission->conducteur_cva) == $conducteur ? 'selected' : '' }}>
                                                {{ $conducteur }}
                                            </option>
                                        @endforeach

                                    </select>

                                    @error('conducteur_cva')
                                        <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                                    @enderror

                                </div>

                                <!-- Activités -->
                                <div class="col-12">

                                    <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                        Activités prévues
                                    </label>

                                    <textarea name="activites"
                                              rows="5"
                                              class="form-control form-control-sm rounded-3"
                                              style="border-color: #e9ecef;"
                                              placeholder="Décrivez les activités prévues durant la mission...">{{ old('activites', $mission->activites) }}</textarea>

                                    @error('activites')
                                        <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                                    @enderror

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- COLONNE DROITE : PARTICIPANTS -->
                <div class="col-12 col-lg-4">

                    <div class="panel card border-0 shadow-sm rounded-4">

                        <div class="card-header bg-transparent border-0 px-4 pt-4 pb-3">

                            <h2 class="h5 mb-0 fw-bold d-flex align-items-center gap-2 section-title">
                                <i class="bi bi-people me-2"></i>
                                <span>Participants</span>
                                <span class="badge rounded-pill ms-auto" 
                                      style="background-color:rgba(5,158,51,.12); color:#059e33; font-size: 0.7rem; font-weight: 600;">
                                    {{ $mission->participants->count() }}
                                </span>
                            </h2>

                        </div>

                        <div class="card-body px-4 pt-0 pb-4">

                            <label class="form-label fw-semibold mb-3" style="font-size: 0.85rem;">
                                Techniciens assermentés participants
                            </label>

                            <div style="max-height: 300px; overflow-y: auto;">

                                @foreach($inspecteurs as $inspecteur)

                                    <div class="form-check mb-2">

                                        <input class="form-check-input participant-checkbox"
                                               type="checkbox"
                                               name="participants[]"
                                               value="{{ $inspecteur->id }}"
                                               id="participant_{{ $inspecteur->id }}"
                                               style="border-color: #ced4da;"
                                               {{ $mission->participants->contains($inspecteur->id) ? 'checked' : '' }}>

                                        <label class="form-check-label" for="participant_{{ $inspecteur->id }}" style="font-size: 0.9rem;">
                                            {{ $inspecteur->name }}
                                        </label>

                                    </div>

                                @endforeach

                            </div>

                            <hr class="my-3">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Chef d'équipe
                            </label>

                            <select name="chef_equipe"
                                    class="form-select form-select-sm rounded-3"
                                    style="border-color: #e9ecef;">

                                <option value="">
                                    -- Sélectionner --
                                </option>

                                @foreach($inspecteurs as $inspecteur)

                                    @php
                                        $isChef = $mission->participants()
                                                          ->where('users.id', $inspecteur->id)
                                                          ->wherePivot('chef_equipe', true)
                                                          ->exists();
                                    @endphp

                                    <option value="{{ $inspecteur->id }}"
                                        {{ old('chef_equipe', $isChef ? $inspecteur->id : '') == $inspecteur->id ? 'selected' : '' }}>
                                        {{ $inspecteur->name }}
                                    </option>

                                @endforeach

                            </select>

                            @error('chef_equipe')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                    </div>

                    <!-- Résumé -->
                    <div class="panel card border-0 shadow-sm rounded-4 mt-3">

                        <div class="card-body px-4 py-3">

                            <h6 class="fw-bold mb-3 d-flex align-items-center gap-2 section-title">
                                <i class="bi bi-list-check me-2"></i>
                                Résumé
                            </h6>

                            <div class="d-flex justify-content-between align-items-center">

                                <span class="text-muted" style="font-size: 0.85rem;">
                                    Participants sélectionnés
                                </span>

                                <span class="badge rounded-pill px-3 py-2"
                                      style="background-color:rgba(22,131,255,.12); color:#1683ff; font-weight: 700; font-size: 0.9rem;"
                                      id="participantCount">
                                    {{ $mission->participants->count() }}
                                </span>

                            </div>

                        </div>

                    </div>

                    <!-- Actions -->
                    <div class="d-grid gap-2 mt-3">

                        <button type="submit"
                                class="btn btn-warning rounded-pill py-2"
                                style="font-weight: 500; color:#212529;">
                            <i class="bi bi-pencil me-2"></i>
                            Mettre à jour
                        </button>

                        <a href="{{ route('missions.show', $mission) }}"
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

<!-- JavaScript pour le compteur de participants -->
<script>

    document.addEventListener('DOMContentLoaded', function () {

        const checkboxes = document.querySelectorAll('.participant-checkbox');
        const counter = document.getElementById('participantCount');

        function updateCount() {
            const checked = document.querySelectorAll('.participant-checkbox:checked').length;
            counter.textContent = checked;
        }

        checkboxes.forEach(item => {
            item.addEventListener('change', updateCount);
        });

        // Initialisation
        updateCount();

    });

</script>

@endsection