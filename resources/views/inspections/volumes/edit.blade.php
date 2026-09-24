@extends('dashboards.index')

@section('content')

<main class="dashboard-content">

    <div class="container-fluid px-3 px-lg-4 py-4">

        <!-- PAGE HEADER -->
        <div class="page-heading d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">

            <div class="page-heading-copy d-flex align-items-center gap-3 section-title">

                <span class="page-icon">
                    <i class="bi bi-droplet-half" aria-hidden="true"></i>
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
                                Modifier volume
                            </li>
                        </ol>
                    </nav>

                    <h1 class="h3 mb-1 fw-bold d-flex align-items-center gap-2">
                        Modifier l'inspection de volume
                        <span class="badge rounded-pill px-3 py-2"
                              style="background-color:rgba(22,131,255,.12); color:#1683ff; font-size: 0.7rem; font-weight: 600;">
                            {{ $inspection->reference }}
                        </span>
                    </h1>

                    <p class="text-muted mb-0" style="font-size: 0.9rem;">
                        Mise à jour des données de l'inspection volume.
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

        <form action="{{ route('inspections.volumes.update', $inspection->volume->id) }}" method="POST">

            @csrf
            @method('PUT')

            <!-- IDENTIFICATION DU DISTRIBUTEUR -->
            <div class="panel card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-header bg-transparent border-0 px-4 pt-4 pb-3">

                    <h2 class="h5 mb-0 fw-bold d-flex align-items-center gap-2 section-title">
                        <i class="bi bi-building me-2"></i>
                        <span>Identification du distributeur</span>
                    </h2>

                </div>

                <div class="card-body px-4 pt-0 pb-4">

                    <div class="row g-3">

                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Nom commercial
                            </label>

                            <input type="text"
                                   name="nom_commercial"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('nom_commercial', $inspection->volume->nom_commercial) }}"
                                   placeholder="Nom commercial du distributeur">

                            @error('nom_commercial')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Identification distributeur <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   name="identification_distributeur"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('identification_distributeur', $inspection->volume->identification_distributeur) }}"
                                   placeholder="Identifiant du distributeur"
                                   required>

                            @error('identification_distributeur')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <div class="col-12 col-md-4">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Produit <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   name="produit"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('produit', $inspection->volume->produit) }}"
                                   placeholder="Gasoil, Super..."
                                   required>

                            @error('produit')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <div class="col-12 col-md-4">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Prix unitaire affiché
                            </label>

                            <input type="number"
                                   step="0.01"
                                   name="prix_unitaire_affiche"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('prix_unitaire_affiche', $inspection->volume->prix_unitaire_affiche) }}"
                                   placeholder="0.00">

                            @error('prix_unitaire_affiche')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <div class="col-12 col-md-4">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Retour cuve
                            </label>

                            <input type="number"
                                   step="0.001"
                                   name="retour_cuve"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('retour_cuve', $inspection->volume->retour_cuve) }}"
                                   placeholder="0.000">

                            @error('retour_cuve')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Lecture totalisateur début
                            </label>

                            <input type="number"
                                   step="0.001"
                                   name="lecture_totalisateur_debut"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('lecture_totalisateur_debut', $inspection->volume->lecture_totalisateur_debut) }}"
                                   placeholder="0.000">

                            @error('lecture_totalisateur_debut')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Lecture totalisateur fin
                            </label>

                            <input type="number"
                                   step="0.001"
                                   name="lecture_totalisateur_fin"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('lecture_totalisateur_fin', $inspection->volume->lecture_totalisateur_fin) }}"
                                   placeholder="0.000">

                            @error('lecture_totalisateur_fin')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                    </div>

                </div>

            </div>

            <!-- IDENTIFICATION MÉTROLOGIQUE -->
            <div class="panel card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-header bg-transparent border-0 px-4 pt-4 pb-3">

                    <h2 class="h5 mb-0 fw-bold d-flex align-items-center gap-2 section-title">
                        <i class="bi bi-tools me-2"></i>
                        <span>Identification métrologique</span>
                    </h2>

                </div>

                <div class="card-body px-4 pt-0 pb-4">

                    <div class="row g-3">

                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Marque cabine
                            </label>

                            <input type="text"
                                   name="marque_cabine"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('marque_cabine', $inspection->volume->marque_cabine) }}"
                                   placeholder="Marque de la cabine">

                            @error('marque_cabine')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                N° série cabine
                            </label>

                            <input type="text"
                                   name="numero_serie_cabine"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('numero_serie_cabine', $inspection->volume->numero_serie_cabine) }}"
                                   placeholder="Numéro de série">

                            @error('numero_serie_cabine')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Marque mesureur
                            </label>

                            <input type="text"
                                   name="marque_mesureur"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('marque_mesureur', $inspection->volume->marque_mesureur) }}"
                                   placeholder="Marque du mesureur">

                            @error('marque_mesureur')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                N° série mesureur
                            </label>

                            <input type="text"
                                   name="numero_serie_mesureur"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('numero_serie_mesureur', $inspection->volume->numero_serie_mesureur) }}"
                                   placeholder="Numéro de série">

                            @error('numero_serie_mesureur')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Numéro vignette
                            </label>

                            <input type="text"
                                   name="numero_vignette"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('numero_vignette', $inspection->volume->numero_vignette) }}"
                                   placeholder="Numéro de la vignette">

                            @error('numero_vignette')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Numéro scellé
                            </label>

                            <input type="text"
                                   name="numero_scelle"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('numero_scelle', $inspection->volume->numero_scelle) }}"
                                   placeholder="Numéro du scellé">

                            @error('numero_scelle')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                    </div>

                </div>

            </div>

            <!-- VÉRIFICATIONS FONCTIONNELLES -->
            <div class="panel card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-header bg-transparent border-0 px-4 pt-4 pb-3">

                    <h2 class="h5 mb-0 fw-bold d-flex align-items-center gap-2 section-title">
                        <i class="bi bi-check-all me-2"></i>
                        <span>Vérifications fonctionnelles</span>
                    </h2>

                </div>

                <div class="card-body px-4 pt-0 pb-4">

                    @php
                        $checks = [
                            'verification_dispositifs_indicateurs' => 'Dispositifs indicateurs',
                            'mise_a_zero' => 'Mise à zéro',
                            'calcul_prix' => 'Calcul du prix',
                            'coupure_flexible_pistolet' => 'Coupure flexible pistolet',
                        ];
                    @endphp

                    <div class="row g-3">

                        @foreach($checks as $field => $label)

                            <div class="col-12 col-md-6">
                                <div class="form-check">

                                    <input class="form-check-input"
                                           type="checkbox"
                                           name="{{ $field }}"
                                           value="1"
                                           id="{{ $field }}"
                                           {{ old($field, $inspection->volume->$field) ? 'checked' : '' }}>

                                    <label class="form-check-label" for="{{ $field }}" style="font-size: 0.9rem;">
                                        {{ $label }}
                                    </label>

                                </div>
                            </div>

                        @endforeach

                        <div class="col-12">
                            <div class="form-check">

                                <input class="form-check-input"
                                       type="checkbox"
                                       name="conformite"
                                       value="1"
                                       id="conformite"
                                       {{ old('conformite', $inspection->volume->conformite) ? 'checked' : '' }}>

                                <label class="form-check-label fw-bold" for="conformite" style="font-size: 0.95rem; color:#059e33;">
                                    <i class="bi bi-check-circle-fill me-1"></i>
                                    Conforme
                                </label>

                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <!-- ESSAIS VOLUMÉTRIQUES -->
            <div class="panel card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-header bg-transparent border-0 d-flex flex-wrap align-items-center justify-content-between gap-2 px-4 pt-4 pb-3">

                    <h2 class="h5 mb-0 fw-bold d-flex align-items-center gap-2 section-title">
                        <i class="bi bi-flask me-2"></i>
                        <span>Essais volumétriques</span>
                    </h2>

                    <button type="button"
                            id="addEssai"
                            class="btn btn-success btn-sm rounded-pill px-3"
                            style="font-weight: 500; background-color:#059e33; border-color:#059e33;">
                        <i class="bi bi-plus-circle me-1"></i>
                        Ajouter un essai
                    </button>

                </div>

                <div class="card-body px-4 pt-0 pb-4">

                    <div class="table-responsive">

                        <table class="table align-middle mb-0" style="font-size: 0.85rem;">

                            <thead style="background: #f8f9fc; border-bottom: 2px solid #e9ecef;">
                                <tr>
                                    <th class="text-uppercase small fw-semibold text-secondary"
                                        style="letter-spacing: 0.04em; font-size: 0.6rem; padding: 0.5rem;">
                                        Essai
                                    </th>
                                    <th class="text-uppercase small fw-semibold text-secondary"
                                        style="letter-spacing: 0.04em; font-size: 0.6rem; padding: 0.5rem;">
                                        Volume nominal
                                    </th>
                                    <th class="text-uppercase small fw-semibold text-secondary"
                                        style="letter-spacing: 0.04em; font-size: 0.6rem; padding: 0.5rem;">
                                        VDR
                                    </th>
                                    <th class="text-uppercase small fw-semibold text-secondary"
                                        style="letter-spacing: 0.04em; font-size: 0.6rem; padding: 0.5rem;">
                                        VREF
                                    </th>
                                    <th class="text-uppercase small fw-semibold text-secondary"
                                        style="letter-spacing: 0.04em; font-size: 0.6rem; padding: 0.5rem;">
                                        EDR
                                    </th>
                                    <th class="text-uppercase small fw-semibold text-secondary"
                                        style="letter-spacing: 0.04em; font-size: 0.6rem; padding: 0.5rem;">
                                        EMT
                                    </th>
                                    <th class="text-center text-uppercase small fw-semibold text-secondary"
                                        style="letter-spacing: 0.04em; font-size: 0.6rem; padding: 0.5rem; width: 60px;">
                                        Action
                                    </th>
                                </tr>
                            </thead>

                            <tbody id="essaisTable">

                                @foreach($inspection->volume->essais as $index => $essai)

                                    <tr style="border-bottom: 1px solid #f1f3f5;">

                                        <td class="py-2 px-2 text-center fw-semibold" style="font-size: 0.85rem;">
                                            {{ $essai->numero_essai }}

                                            <input type="hidden"
                                                   name="essais[{{ $index }}][id]"
                                                   value="{{ $essai->id }}">

                                            <input type="hidden"
                                                   name="essais[{{ $index }}][numero_essai]"
                                                   value="{{ $essai->numero_essai }}">
                                        </td>

                                        <td class="py-2 px-2">
                                            <input type="number"
                                                   step="0.001"
                                                   class="form-control form-control-sm rounded-3"
                                                   style="border-color: #e9ecef; min-width: 90px;"
                                                   name="essais[{{ $index }}][volume_nominal]"
                                                   value="{{ $essai->volume_nominal }}"
                                                   placeholder="0.000">
                                        </td>

                                        <td class="py-2 px-2">
                                            <input type="number"
                                                   step="0.001"
                                                   class="form-control form-control-sm rounded-3"
                                                   style="border-color: #e9ecef; min-width: 90px;"
                                                   name="essais[{{ $index }}][vdr]"
                                                   value="{{ $essai->vdr }}"
                                                   placeholder="0.000">
                                        </td>

                                        <td class="py-2 px-2">
                                            <input type="number"
                                                   step="0.001"
                                                   class="form-control form-control-sm rounded-3"
                                                   style="border-color: #e9ecef; min-width: 90px;"
                                                   name="essais[{{ $index }}][vref]"
                                                   value="{{ $essai->vref }}"
                                                   placeholder="0.000">
                                        </td>

                                        <td class="py-2 px-2">
                                            <input type="number"
                                                   step="0.0001"
                                                   class="form-control form-control-sm rounded-3"
                                                   style="border-color: #e9ecef; min-width: 90px;"
                                                   name="essais[{{ $index }}][edr]"
                                                   value="{{ $essai->edr }}"
                                                   placeholder="0.0000">
                                        </td>

                                        <td class="py-2 px-2">
                                            <input type="number"
                                                   step="0.0001"
                                                   class="form-control form-control-sm rounded-3"
                                                   style="border-color: #e9ecef; min-width: 90px;"
                                                   name="essais[{{ $index }}][emt]"
                                                   value="{{ $essai->emt }}"
                                                   placeholder="0.0000">
                                        </td>

                                        <td class="text-center py-2 px-2">

                                            @if($loop->count > 1)

                                                <button type="button"
                                                        class="btn btn-outline-danger btn-sm rounded-pill remove-essai"
                                                        style="font-size: 0.7rem; width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center;">
                                                    <i class="bi bi-trash"></i>
                                                </button>

                                            @else

                                                <button type="button"
                                                        class="btn btn-outline-danger btn-sm rounded-pill remove-essai"
                                                        style="font-size: 0.7rem; width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center; opacity: 0.4; cursor: not-allowed;"
                                                        disabled>
                                                    <i class="bi bi-trash"></i>
                                                </button>

                                            @endif

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

            <!-- SIGNATAIRES -->
            <div class="panel card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-header bg-transparent border-0 px-4 pt-4 pb-3">

                    <h2 class="h5 mb-0 fw-bold d-flex align-items-center gap-2 section-title">
                        <i class="bi bi-pen me-2"></i>
                        <span>Signataires</span>
                    </h2>

                </div>

                <div class="card-body px-4 pt-0 pb-4">

                    <div class="row g-3">

                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Représentant utilisateur
                            </label>

                            <input type="text"
                                   name="representant_utilisateur"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('representant_utilisateur', $inspection->volume->representant_utilisateur) }}"
                                   placeholder="Nom du représentant">

                            @error('representant_utilisateur')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Technicien réparateur
                            </label>

                            <input type="text"
                                   name="technicien_reparateur"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('technicien_reparateur', $inspection->volume->technicien_reparateur) }}"
                                   placeholder="Nom du technicien">

                            @error('technicien_reparateur')
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
                    Mettre à jour
                </button>

            </div>

        </form>

    </div>

</main>

@endsection

@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    let essaiIndex = {{ $inspection->volume->essais->count() }};

    // Ajouter un essai
    document.getElementById('addEssai').addEventListener('click', function () {

        const table = document.getElementById('essaisTable');
        const rowCount = table.querySelectorAll('tr').length;

        const row = document.createElement('tr');
        row.style.borderBottom = '1px solid #f1f3f5';

        row.innerHTML = `

            <td class="py-2 px-2 text-center fw-semibold" style="font-size: 0.85rem;">
                ${rowCount + 1}
                <input type="hidden"
                       name="essais[${essaiIndex}][numero_essai]"
                       value="${rowCount + 1}">
            </td>

            <td class="py-2 px-2">
                <input type="number"
                       step="0.001"
                       class="form-control form-control-sm rounded-3"
                       style="border-color: #e9ecef; min-width: 90px;"
                       name="essais[${essaiIndex}][volume_nominal]"
                       placeholder="0.000">
            </td>

            <td class="py-2 px-2">
                <input type="number"
                       step="0.001"
                       class="form-control form-control-sm rounded-3"
                       style="border-color: #e9ecef; min-width: 90px;"
                       name="essais[${essaiIndex}][vdr]"
                       placeholder="0.000">
            </td>

            <td class="py-2 px-2">
                <input type="number"
                       step="0.001"
                       class="form-control form-control-sm rounded-3"
                       style="border-color: #e9ecef; min-width: 90px;"
                       name="essais[${essaiIndex}][vref]"
                       placeholder="0.000">
            </td>

            <td class="py-2 px-2">
                <input type="number"
                       step="0.0001"
                       class="form-control form-control-sm rounded-3"
                       style="border-color: #e9ecef; min-width: 90px;"
                       name="essais[${essaiIndex}][edr]"
                       placeholder="0.0000">
            </td>

            <td class="py-2 px-2">
                <input type="number"
                       step="0.0001"
                       class="form-control form-control-sm rounded-3"
                       style="border-color: #e9ecef; min-width: 90px;"
                       name="essais[${essaiIndex}][emt]"
                       placeholder="0.0000">
            </td>

            <td class="text-center py-2 px-2">
                <button type="button"
                        class="btn btn-outline-danger btn-sm rounded-pill remove-essai"
                        style="font-size: 0.7rem; width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center;">
                    <i class="bi bi-trash"></i>
                </button>
            </td>

        `;

        table.appendChild(row);
        essaiIndex++;

        updateRemoveButtons();
    });

    // Supprimer un essai
    document.addEventListener('click', function (e) {

        const btn = e.target.closest('.remove-essai');
        if (!btn) return;

        const rows = document.querySelectorAll('#essaisTable tr');

        if (rows.length > 1) {
            btn.closest('tr').remove();
            updateEssaiNumbers();
            updateRemoveButtons();
        }
    });

    // Mettre à jour les numéros d'essai
    function updateEssaiNumbers() {

        const rows = document.querySelectorAll('#essaisTable tr');

        rows.forEach((row, index) => {

            const numCell = row.querySelector('td:first-child');
            if (numCell) {
                numCell.childNodes[0].textContent = index + 1;

                const hiddenInput = row.querySelector('input[type="hidden"][name*="numero_essai"]');
                if (hiddenInput) {
                    hiddenInput.value = index + 1;
                }
            }

            // Mettre à jour les noms des champs
            const inputs = row.querySelectorAll('input:not([type="hidden"])');
            const fieldNames = ['volume_nominal', 'vdr', 'vref', 'edr', 'emt'];
            inputs.forEach((input, idx) => {
                if (idx < fieldNames.length) {
                    input.name = `essais[${index}][${fieldNames[idx]}]`;
                }
            });
        });
    }

    // Mettre à jour l'état des boutons supprimer
    function updateRemoveButtons() {

        const rows = document.querySelectorAll('#essaisTable tr');
        const removeBtns = document.querySelectorAll('.remove-essai');

        removeBtns.forEach((btn) => {
            if (rows.length <= 1) {
                btn.disabled = true;
                btn.style.opacity = '0.4';
                btn.style.cursor = 'not-allowed';
            } else {
                btn.disabled = false;
                btn.style.opacity = '1';
                btn.style.cursor = 'pointer';
            }
        });
    }

    // Initialisation
    updateRemoveButtons();

});

</script>

@endpush