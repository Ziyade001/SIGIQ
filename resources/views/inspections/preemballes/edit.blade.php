@extends('dashboards.index')

@section('content')

<main class="dashboard-content">

    <div class="container-fluid px-3 px-lg-4 py-4">

        <!-- PAGE HEADER -->
        <div class="page-heading d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">

            <div class="page-heading-copy d-flex align-items-center gap-3">

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
                                Modifier préemballés
                            </li>
                        </ol>
                    </nav>

                    <h1 class="h3 mb-1 fw-bold d-flex align-items-center gap-2">
                        Modifier l'inspection préemballés
                        <span class="badge rounded-pill px-3 py-2"
                              style="background-color:rgba(255,193,7,.12); color:#ffc107; font-size: 0.7rem; font-weight: 600;">
                            {{ $inspection->reference }}
                        </span>
                    </h1>

                    <p class="text-muted mb-0" style="font-size: 0.9rem;">
                        Mise à jour des informations de contrôle.
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

        <form action="{{ route('inspections.preemballes.update', $inspection) }}" method="POST">

            @csrf
            @method('PUT')

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
                                   value="{{ old('produit', $preemballe->produit) }}"
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
                                   value="{{ old('marque', $preemballe->marque) }}"
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
                                   value="{{ old('quantite_nominale', $preemballe->quantite_nominale) }}"
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
                                   value="{{ old('effectif_lot', $preemballe->effectif_lot) }}"
                                   placeholder="0"
                                   required>

                            @error('effectif_lot')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <div class="col-12 col-md-4">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Effectif échantillon <span class="text-danger">*</span>
                            </label>

                            <input type="number"
                                   name="effectif_echantillon"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('effectif_echantillon', $preemballe->effectif_echantillon) }}"
                                   placeholder="0"
                                   required>

                            @error('effectif_echantillon')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                    </div>

                </div>

            </div>

            <!-- EMBALLAGES VIDES -->
            <div class="panel card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-header bg-transparent border-0 px-4 pt-4 pb-3">

                    <h2 class="h5 mb-0 fw-bold d-flex align-items-center gap-2 section-title">
                        <i class="bi bi-box me-2"></i>
                        <span>Emballages vides</span>
                    </h2>

                </div>

                <div class="card-body px-4 pt-0 pb-4">

                    <div class="row g-3">

                        @foreach($preemballe->emballagesVides as $index => $emballage)

                            <div class="col-6 col-md-3">

                                <label class="form-label fw-semibold" style="font-size: 0.75rem;">
                                    Poids {{ $index + 1 }}
                                </label>

                                <input type="hidden"
                                       name="emballages_ids[]"
                                       value="{{ $emballage->id }}">

                                <input type="number"
                                       step="0.001"
                                       class="form-control form-control-sm rounded-3"
                                       style="border-color: #e9ecef;"
                                       name="emballages[]"
                                       value="{{ old('emballages.' . $index, $emballage->poids) }}"
                                       placeholder="0.000">

                            </div>

                        @endforeach

                    </div>

                </div>

            </div>

            <!-- ÉCHANTILLONS -->
            <div class="panel card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-header bg-transparent border-0 px-4 pt-4 pb-3">

                    <h2 class="h5 mb-0 fw-bold d-flex align-items-center gap-2 section-title">
                        <i class="bi bi-list-check me-2"></i>
                        <span>Échantillons</span>
                    </h2>

                </div>

                <div class="card-body px-4 pt-0 pb-4">

                    <div class="table-responsive">

                        <table class="table align-middle mb-0" style="font-size: 0.85rem;">

                            <thead style="background: #f8f9fc; border-bottom: 2px solid #e9ecef;">
                                <tr>
                                    <th class="text-uppercase small fw-semibold text-secondary"
                                        style="letter-spacing: 0.04em; font-size: 0.6rem; padding: 0.5rem;">
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
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($preemballe->echantillons as $echantillon)

                                    <tr style="border-bottom: 1px solid #f1f3f5;">

                                        <td class="py-2 px-2 fw-semibold text-muted" style="font-size: 0.85rem;">
                                            {{ $echantillon->numero }}

                                            <input type="hidden"
                                                   name="echantillon_ids[]"
                                                   value="{{ $echantillon->id }}">
                                        </td>

                                        <td class="py-2 px-2">
                                            <input type="number"
                                                   step="0.001"
                                                   name="poids_brut[]"
                                                   class="form-control form-control-sm rounded-3"
                                                   style="border-color: #e9ecef; min-width: 120px;"
                                                   value="{{ old('poids_brut.' . $loop->index, $echantillon->poids_brut) }}"
                                                   placeholder="0.000">
                                        </td>

                                        <td class="py-2 px-2">
                                            <input type="number"
                                                   step="0.001"
                                                   name="poids_net[]"
                                                   class="form-control form-control-sm rounded-3"
                                                   style="border-color: #e9ecef; min-width: 120px;"
                                                   value="{{ old('poids_net.' . $loop->index, $echantillon->poids_net) }}"
                                                   placeholder="0.000">
                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

            <!-- RÉSULTATS DU CONTRÔLE -->
            <div class="panel card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-header bg-transparent border-0 px-4 pt-4 pb-3">

                    <h2 class="h5 mb-0 fw-bold d-flex align-items-center gap-2 section-title">
                        <i class="bi bi-clipboard-check me-2"></i>
                        <span>Résultats du contrôle</span>
                    </h2>

                </div>

                <div class="card-body px-4 pt-0 pb-4">

                    <div class="row g-3">

                        <div class="col-6 col-md-4">
                            <label class="form-label fw-semibold" style="font-size: 0.75rem;">
                                Moyenne emballage vide
                            </label>
                            <input type="number"
                                   step="0.001"
                                   name="moyenne_emballage_vide"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('moyenne_emballage_vide', $preemballe->moyenne_emballage_vide) }}"
                                   placeholder="0.000">
                        </div>

                        <div class="col-6 col-md-4">
                            <label class="form-label fw-semibold" style="font-size: 0.75rem;">
                                Écart type emb. vide
                            </label>
                            <input type="number"
                                   step="0.001"
                                   name="ecart_type_emballage_vide"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('ecart_type_emballage_vide', $preemballe->ecart_type_emballage_vide) }}"
                                   placeholder="0.000">
                        </div>

                        <div class="col-6 col-md-4">
                            <label class="form-label fw-semibold" style="font-size: 0.75rem;">
                                EMT
                            </label>
                            <input type="number"
                                   step="0.001"
                                   name="emt"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('emt', $preemballe->emt) }}"
                                   placeholder="0.000">
                        </div>

                        <div class="col-6 col-md-4">
                            <label class="form-label fw-semibold" style="font-size: 0.75rem;">
                                EMT / 5
                            </label>
                            <input type="number"
                                   step="0.001"
                                   name="emt_sur_5"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('emt_sur_5', $preemballe->emt_sur_5) }}"
                                   placeholder="0.000">
                        </div>

                        <div class="col-6 col-md-4">
                            <label class="form-label fw-semibold" style="font-size: 0.75rem;">
                                EAVE
                            </label>
                            <input type="number"
                                   step="0.001"
                                   name="eave"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('eave', $preemballe->eave) }}"
                                   placeholder="0.000">
                        </div>

                        <div class="col-6 col-md-4">
                            <label class="form-label fw-semibold" style="font-size: 0.75rem;">
                                Écart type
                            </label>
                            <input type="number"
                                   step="0.001"
                                   name="ecart_type"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('ecart_type', $preemballe->ecart_type) }}"
                                   placeholder="0.000">
                        </div>

                        <div class="col-6 col-md-4">
                            <label class="form-label fw-semibold" style="font-size: 0.75rem;">
                                FCE
                            </label>
                            <input type="number"
                                   step="0.001"
                                   name="fce"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('fce', $preemballe->fce) }}"
                                   placeholder="0.000">
                        </div>

                        <div class="col-6 col-md-4">
                            <label class="form-label fw-semibold" style="font-size: 0.75rem;">
                                Quantité corrigée
                            </label>
                            <input type="number"
                                   step="0.001"
                                   name="quantite_corrigee"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('quantite_corrigee', $preemballe->quantite_corrigee) }}"
                                   placeholder="0.000">
                        </div>

                        <div class="col-6 col-md-4">
                            <label class="form-label fw-semibold" style="font-size: 0.75rem;">
                                T1
                            </label>
                            <input type="number"
                                   step="0.001"
                                   name="t1"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('t1', $preemballe->t1) }}"
                                   placeholder="0.000">
                        </div>

                        <div class="col-6 col-md-4">
                            <label class="form-label fw-semibold" style="font-size: 0.75rem;">
                                T2
                            </label>
                            <input type="number"
                                   step="0.001"
                                   name="t2"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('t2', $preemballe->t2) }}"
                                   placeholder="0.000">
                        </div>

                    </div>

                    <hr class="my-4" style="border-color: #f1f3f5;">

                    <h6 class="text-muted text-uppercase fw-semibold mb-3"
                        style="font-size: 0.7rem; letter-spacing: 0.04em;">
                        <i class="bi bi-check-all me-1" style="color:#059e33;"></i>
                        Résultats finaux
                    </h6>

                    <div class="row g-3">

                        <div class="col-12 col-md-4">

                            <label class="form-label fw-semibold" style="font-size: 0.75rem;">
                                Résultat moyenne
                            </label>

                            <select name="resultat_moyenne"
                                    class="form-select form-select-sm rounded-3"
                                    style="border-color: #e9ecef;">

                                <option value="">-- Sélectionner --</option>

                                <option value="Conforme"
                                    {{ old('resultat_moyenne', $preemballe->resultat_moyenne) == 'Conforme' ? 'selected' : '' }}>
                                    Conforme
                                </option>

                                <option value="Non conforme"
                                    {{ old('resultat_moyenne', $preemballe->resultat_moyenne) == 'Non conforme' ? 'selected' : '' }}>
                                    Non conforme
                                </option>

                            </select>

                        </div>

                        <div class="col-12 col-md-4">

                            <label class="form-label fw-semibold" style="font-size: 0.75rem;">
                                Résultat T1
                            </label>

                            <select name="resultat_t1"
                                    class="form-select form-select-sm rounded-3"
                                    style="border-color: #e9ecef;">

                                <option value="">-- Sélectionner --</option>

                                <option value="Conforme"
                                    {{ old('resultat_t1', $preemballe->resultat_t1) == 'Conforme' ? 'selected' : '' }}>
                                    Conforme
                                </option>

                                <option value="Non conforme"
                                    {{ old('resultat_t1', $preemballe->resultat_t1) == 'Non conforme' ? 'selected' : '' }}>
                                    Non conforme
                                </option>

                            </select>

                        </div>

                        <div class="col-12 col-md-4">

                            <label class="form-label fw-semibold" style="font-size: 0.75rem;">
                                Résultat T2
                            </label>

                            <select name="resultat_t2"
                                    class="form-select form-select-sm rounded-3"
                                    style="border-color: #e9ecef;">

                                <option value="">-- Sélectionner --</option>

                                <option value="Conforme"
                                    {{ old('resultat_t2', $preemballe->resultat_t2) == 'Conforme' ? 'selected' : '' }}>
                                    Conforme
                                </option>

                                <option value="Non conforme"
                                    {{ old('resultat_t2', $preemballe->resultat_t2) == 'Non conforme' ? 'selected' : '' }}>
                                    Non conforme
                                </option>

                            </select>

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
                    Enregistrer les modifications
                </button>

            </div>

        </form>

    </div>

</main>

@endsection