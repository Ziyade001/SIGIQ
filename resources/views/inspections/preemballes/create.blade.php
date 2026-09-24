@extends('dashboards.index')

@section('content')

<main class="dashboard-content">

    <div class="container-fluid px-3 px-lg-4 py-4">

        <!-- PAGE HEADER -->
        <div class="page-heading d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">

            <div class="page-heading-copy d-flex align-items-center gap-3">

                <span class="page-icon">
                    <i class="bi bi-box-seam" aria-hidden="true"></i>
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
                                Préemballés
                            </li>
                        </ol>
                    </nav>

                    <h1 class="h3 mb-1 fw-bold d-flex align-items-center gap-2">
                        Fiche d'inspection des préemballés
                        <span class="badge rounded-pill px-3 py-2"
                              style="background-color:rgba(5,158,51,.12); color:#059e33; font-size: 0.7rem; font-weight: 600;">
                            {{ $inspection->reference }}
                        </span>
                    </h1>

                    <p class="text-muted mb-0" style="font-size: 0.9rem;">
                        Mission : {{ $inspection->mission->type_mission ?? 'Non définie' }}
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

        <form action="{{ route('inspections.preemballes.store', $inspection) }}" method="POST">

            @csrf

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

                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Produit <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   name="produit"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('produit') }}"
                                   placeholder="Nom du produit"
                                   required>

                            @error('produit')
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
                                   placeholder="Marque du produit">

                            @error('marque')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <div class="col-12 col-md-4">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Quantité nominale <span class="text-danger">*</span>
                            </label>

                            <input type="number"
                                   step="0.001"
                                   name="quantite_nominale"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('quantite_nominale') }}"
                                   placeholder="0.000"
                                   required>

                            @error('quantite_nominale')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <div class="col-12 col-md-4">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Effectif du lot <span class="text-danger">*</span>
                            </label>

                            <input type="number"
                                   name="effectif_lot"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('effectif_lot') }}"
                                   placeholder="0"
                                   required>

                            @error('effectif_lot')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <div class="col-12 col-md-4">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Effectif de l'échantillon <span class="text-danger">*</span>
                            </label>

                            <input type="number"
                                   name="effectif_echantillon"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('effectif_echantillon') }}"
                                   placeholder="0"
                                   required>

                            @error('effectif_echantillon')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                    </div>

                </div>

            </div>

            <!-- POIDS DES EMBALLAGES VIDES -->
            <div class="panel card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-header bg-transparent border-0 d-flex flex-wrap align-items-center justify-content-between gap-2 px-4 pt-4 pb-3">

                    <h2 class="h5 mb-0 fw-bold d-flex align-items-center gap-2 section-title">
                        <i class="bi bi-box me-2"></i>
                        <span>Poids des emballages vides</span>
                    </h2>

                    <button type="button"
                            class="btn btn-primary btn-sm rounded-pill px-3"
                            style="font-weight: 500; background-color:#1683ff; border-color:#1683ff;"
                            onclick="ajouterEmballage()">
                        <i class="bi bi-plus-circle me-1"></i>
                        Ajouter
                    </button>

                </div>

                <div class="card-body px-4 pt-0 pb-4">

                    <div class="table-responsive">

                        <table class="table align-middle mb-0" style="font-size: 0.85rem;">

                            <thead style="background: #f8f9fc; border-bottom: 2px solid #e9ecef;">
                                <tr>
                                    <th class="text-uppercase small fw-semibold text-secondary"
                                        style="letter-spacing: 0.04em; font-size: 0.6rem; padding: 0.5rem; width: 60px;">
                                        #
                                    </th>
                                    <th class="text-uppercase small fw-semibold text-secondary"
                                        style="letter-spacing: 0.04em; font-size: 0.6rem; padding: 0.5rem;">
                                        Poids (kg)
                                    </th>
                                    <th class="text-center text-uppercase small fw-semibold text-secondary"
                                        style="letter-spacing: 0.04em; font-size: 0.6rem; padding: 0.5rem; width: 80px;">
                                        Action
                                    </th>
                                </tr>
                            </thead>

                            <tbody id="emballagesTable">

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

            <!-- ÉCHANTILLONS -->
            <div class="panel card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-header bg-transparent border-0 d-flex flex-wrap align-items-center justify-content-between gap-2 px-4 pt-4 pb-3">

                    <h2 class="h5 mb-0 fw-bold d-flex align-items-center gap-2 section-title">
                        <i class="bi bi-list-check me-2"></i>
                        <span>Échantillons</span>
                    </h2>

                    <button type="button"
                            class="btn btn-success btn-sm rounded-pill px-3"
                            style="font-weight: 500; background-color:#059e33; border-color:#059e33;"
                            onclick="ajouterEchantillon()">
                        <i class="bi bi-plus-circle me-1"></i>
                        Ajouter
                    </button>

                </div>

                <div class="card-body px-4 pt-0 pb-4">

                    <div class="table-responsive">

                        <table class="table align-middle mb-0" style="font-size: 0.85rem;">

                            <thead style="background: #f8f9fc; border-bottom: 2px solid #e9ecef;">
                                <tr>
                                    <th class="text-uppercase small fw-semibold text-secondary"
                                        style="letter-spacing: 0.04em; font-size: 0.6rem; padding: 0.5rem; width: 60px;">
                                        N°
                                    </th>
                                    <th class="text-uppercase small fw-semibold text-secondary"
                                        style="letter-spacing: 0.04em; font-size: 0.6rem; padding: 0.5rem;">
                                        Poids brut (kg)
                                    </th>
                                    <th class="text-uppercase small fw-semibold text-secondary"
                                        style="letter-spacing: 0.04em; font-size: 0.6rem; padding: 0.5rem;">
                                        Poids net (kg)
                                    </th>
                                    <th class="text-center text-uppercase small fw-semibold text-secondary"
                                        style="letter-spacing: 0.04em; font-size: 0.6rem; padding: 0.5rem; width: 80px;">
                                        Action
                                    </th>
                                </tr>
                            </thead>

                            <tbody id="echantillonsTable">

                            </tbody>

                        </table>

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

<script>

    let emballageIndex = 0;
    let echantillonIndex = 0;

    function ajouterEmballage() {

        const tbody = document.getElementById('emballagesTable');
        const rowCount = tbody.querySelectorAll('tr').length;

        const html = `
            <tr style="border-bottom: 1px solid #f1f3f5;">

                <td class="py-2 px-2 text-center fw-semibold" style="font-size: 0.85rem;">
                    ${rowCount + 1}
                </td>

                <td class="py-2 px-2">
                    <input type="number"
                           step="0.001"
                           name="emballages_vides[]"
                           class="form-control form-control-sm rounded-3"
                           style="border-color: #e9ecef; min-width: 120px;"
                           placeholder="0.000"
                           required>
                </td>

                <td class="text-center py-2 px-2">
                    <button type="button"
                            class="btn btn-outline-danger btn-sm rounded-pill"
                            style="font-size: 0.7rem; width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center;"
                            onclick="this.closest('tr').remove(); reindexerEmballages();">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>

            </tr>
        `;

        tbody.insertAdjacentHTML('beforeend', html);
        emballageIndex++;
    }

    function reindexerEmballages() {

        const rows = document.querySelectorAll('#emballagesTable tr');

        rows.forEach((row, index) => {
            const numCell = row.querySelector('td:first-child');
            if (numCell) {
                numCell.textContent = index + 1;
            }
        });
    }

    function ajouterEchantillon() {

        const tbody = document.getElementById('echantillonsTable');
        const rowCount = tbody.querySelectorAll('tr').length;

        const html = `
            <tr style="border-bottom: 1px solid #f1f3f5;">

                <td class="py-2 px-2">
                    <input type="number"
                           name="echantillons[${echantillonIndex}][numero]"
                           class="form-control form-control-sm rounded-3"
                           style="border-color: #e9ecef; min-width: 60px;"
                           placeholder="N°"
                           required>
                </td>

                <td class="py-2 px-2">
                    <input type="number"
                           step="0.001"
                           name="echantillons[${echantillonIndex}][poids_brut]"
                           class="form-control form-control-sm rounded-3"
                           style="border-color: #e9ecef; min-width: 120px;"
                           placeholder="0.000"
                           required>
                </td>

                <td class="py-2 px-2">
                    <input type="number"
                           step="0.001"
                           name="echantillons[${echantillonIndex}][poids_net]"
                           class="form-control form-control-sm rounded-3"
                           style="border-color: #e9ecef; min-width: 120px;"
                           placeholder="0.000"
                           required>
                </td>

                <td class="text-center py-2 px-2">
                    <button type="button"
                            class="btn btn-outline-danger btn-sm rounded-pill"
                            style="font-size: 0.7rem; width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center;"
                            onclick="this.closest('tr').remove(); reindexerEchantillons();">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>

            </tr>
        `;

        tbody.insertAdjacentHTML('beforeend', html);
        echantillonIndex++;
    }

    function reindexerEchantillons() {

        const rows = document.querySelectorAll('#echantillonsTable tr');

        rows.forEach((row, index) => {
            const input = row.querySelector('input[name*="[numero]"]');
            if (input) {
                // Mettre à jour le name et la valeur
                const currentName = input.name;
                const newName = currentName.replace(/echantillons\[\d+\]/, `echantillons[${index}]`);
                input.name = newName;
                input.placeholder = `N° ${index + 1}`;
            }
        });
    }

    // Initialisation avec un élément par défaut
    document.addEventListener('DOMContentLoaded', function() {
        ajouterEmballage();
        ajouterEchantillon();
    });

</script>

@endsection