@extends('dashboards.index')

@section('content')

<main class="dashboard-content">

    <div class="container-fluid px-3 px-lg-4 py-4">

        <!-- PAGE HEADER -->
        <div class="page-heading d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">

            <div class="page-heading-copy d-flex align-items-center gap-3">

                <span class="page-icon">
                    <i class="bi bi-journal-text" aria-hidden="true"></i>
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
                                <a href="{{ route('rapports.index') }}">
                                    Rapports
                                </a>
                            </li>
                            <li class="breadcrumb-item active text-secondary" aria-current="page">
                                {{ $mission->reference }}
                            </li>
                        </ol>
                    </nav>

                    <h1 class="h3 mb-1 fw-bold d-flex align-items-center gap-2">
                        Compléter le rapport de mission
                        <span class="badge rounded-pill px-3 py-2"
                              style="background-color:rgba(22,131,255,.12); color:#1683ff; font-size: 0.7rem; font-weight: 600;">
                            {{ $mission->reference }}
                        </span>
                    </h1>

                    <p class="text-muted mb-0" style="font-size: 0.9rem;">
                        Saisie des informations complémentaires du rapport de mission.
                    </p>

                </div>

            </div>

            <div class="heading-actions">

                <a href="{{ route('rapports.index') }}"
                   class="btn btn-outline-secondary btn-sm rounded-pill px-3"
                   style="font-weight: 500;">
                    <i class="bi bi-arrow-left me-1"></i>
                    Retour
                </a>

            </div>

        </div>

        <!-- STATUT DU RAPPORT -->
        <div class="mb-4">

            @php
                $estComplet = $mission->fiche_signee_par && $mission->compte_rendu;
            @endphp

            <div class="d-flex align-items-center gap-3 p-3 rounded-4 bg-light"
                 style="border-left: 4px solid {{ $estComplet ? '#059e33' : '#ffc107' }};">

                <span class="badge rounded-pill px-4 py-2
                      {{ $estComplet ? 'bg-success' : 'bg-warning' }}"
                      style="font-weight: 600; font-size: 0.85rem; color: {{ $estComplet ? '#fff' : '#212529' }};">
                    @if($estComplet)
                        <i class="bi bi-check-circle-fill me-1"></i>
                        Rapport complet
                    @else
                        <i class="bi bi-clock me-1"></i>
                        À compléter
                    @endif
                </span>

                <span class="badge rounded-pill px-3 py-1"
                      style="background-color:rgba(108,117,125,.12); color:#6c757d; font-weight: 500; font-size: 0.7rem;">
                    <i class="bi bi-calendar3 me-1"></i>
                    {{ $mission->periode_debut->format('d/m/Y') }} - {{ $mission->periode_fin->format('d/m/Y') }}
                </span>

                <span class="badge rounded-pill px-3 py-1"
                      style="background-color:rgba(22,131,255,.12); color:#1683ff; font-weight: 500; font-size: 0.7rem;">
                    <i class="bi bi-geo-alt me-1"></i>
                    {{ $mission->localites }}
                </span>

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

        <!-- FORMULAIRE -->
        <div class="panel card border-0 shadow-sm rounded-4">

            <div class="card-header bg-transparent border-0 px-4 pt-4 pb-3">

                <h2 class="h5 mb-0 fw-bold d-flex align-items-center gap-2 section-title">
                    <i class="bi bi-info-circle me-2"></i>
                    <span>Informations du rapport</span>
                </h2>

            </div>

            <div class="card-body px-4 pt-0 pb-4">

                <form action="{{ route('rapports.update', $mission) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="row g-3">

                        <!-- Référence mission (lecture seule) -->
                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Référence mission
                            </label>

                            <input type="text"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef; background-color: #f8f9fc; font-weight: 600;"
                                   value="{{ $mission->reference }}"
                                   readonly>

                        </div>

                        <!-- Localités (lecture seule) -->
                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Localités
                            </label>

                            <input type="text"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef; background-color: #f8f9fc;"
                                   value="{{ $mission->localites }}"
                                   readonly>

                        </div>

                        <!-- Fiche signée par -->
                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Fiche signée par <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   name="fiche_signee_par"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('fiche_signee_par', $mission->fiche_signee_par) }}"
                                   placeholder="Nom du signataire"
                                   required>

                            @error('fiche_signee_par')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <!-- Compte rendu -->
                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Compte rendu de mission <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   name="compte_rendu"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('compte_rendu', $mission->compte_rendu) }}"
                                   placeholder="Résumé du compte rendu"
                                   required>

                            @error('compte_rendu')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <div class="col-12">
                            <hr class="my-2" style="border-color: #f1f3f5;">
                            <h6 class="text-muted text-uppercase fw-semibold mb-3"
                                style="font-size: 0.7rem; letter-spacing: 0.04em;">
                                <i class="bi bi-bar-chart me-1" style="color:#ffc107;"></i>
                                Statistiques de la mission
                            </h6>
                        </div>

                        <!-- Boutiques contrôlées -->
                        <div class="col-6 col-md-4">

                            <label class="form-label fw-semibold" style="font-size: 0.75rem;">
                                Boutiques contrôlées <span class="text-danger">*</span>
                            </label>

                            <input type="number"
                                   min="0"
                                   name="nb_boutiques_controlees"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('nb_boutiques_controlees', $mission->nb_boutiques_controlees) }}"
                                   placeholder="0"
                                   required>

                            @error('nb_boutiques_controlees')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <!-- Instruments contrôlés -->
                        <div class="col-6 col-md-4">

                            <label class="form-label fw-semibold" style="font-size: 0.75rem;">
                                Instruments contrôlés <span class="text-danger">*</span>
                            </label>

                            <input type="number"
                                   min="0"
                                   name="nb_instruments_controles"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('nb_instruments_controles', $mission->nb_instruments_controles) }}"
                                   placeholder="0"
                                   required>

                            @error('nb_instruments_controles')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <!-- Préemballés contrôlés -->
                        <div class="col-6 col-md-4">

                            <label class="form-label fw-semibold" style="font-size: 0.75rem;">
                                Préemballés contrôlés <span class="text-danger">*</span>
                            </label>

                            <input type="number"
                                   min="0"
                                   name="nb_preemballes_controles"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('nb_preemballes_controles', $mission->nb_preemballes_controles) }}"
                                   placeholder="0"
                                   required>

                            @error('nb_preemballes_controles')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <!-- Instruments mis en conformité -->
                        <div class="col-6 col-md-4">

                            <label class="form-label fw-semibold" style="font-size: 0.75rem;">
                                Instruments mis en conformité <span class="text-danger">*</span>
                            </label>

                            <input type="number"
                                   min="0"
                                   name="nb_instruments_mis_conformite"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('nb_instruments_mis_conformite', $mission->nb_instruments_mis_conformite) }}"
                                   placeholder="0"
                                   required>

                            @error('nb_instruments_mis_conformite')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <!-- Frais de vérification -->
                        <div class="col-6 col-md-4">

                            <label class="form-label fw-semibold" style="font-size: 0.75rem;">
                                Frais de vérification (FCFA) <span class="text-danger">*</span>
                            </label>

                            <input type="number"
                                   min="0"
                                   name="montant_frais_verification"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('montant_frais_verification', $mission->montant_frais_verification) }}"
                                   placeholder="0"
                                   required>

                            @error('montant_frais_verification')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                    </div>

                    <!-- Actions -->
                    <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mt-4 pt-3" style="border-top: 1px solid #f1f3f5;">

                        <a href="{{ route('rapports.index') }}"
                           class="btn btn-outline-secondary rounded-pill px-4 py-2"
                           style="font-weight: 500;">
                            <i class="bi bi-x-circle me-2"></i>
                            Annuler
                        </a>

                        <button type="submit"
                                class="btn btn-primary rounded-pill px-4 py-2"
                                style="font-weight: 500; background-color:#059e33; border-color:#059e33;">
                            <i class="bi bi-check-circle me-2"></i>
                            Enregistrer le rapport
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</main>

@endsection