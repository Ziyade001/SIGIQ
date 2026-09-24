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
                                <a href="{{ route('convocations.index') }}">
                                    Convocations
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('convocations.show', $convocation) }}">
                                    {{ $convocation->reference }}
                                </a>
                            </li>
                            <li class="breadcrumb-item active text-secondary" aria-current="page">
                                Modifier
                            </li>
                        </ol>
                    </nav>

                    <h1 class="h3 mb-1 fw-bold d-flex align-items-center gap-2">
                        Modifier la convocation
                        <span class="badge rounded-pill px-3 py-2"
                              style="background-color:rgba(255,193,7,.12); color:#ffc107; font-size: 0.7rem; font-weight: 600;">
                            {{ $convocation->reference }}
                        </span>
                    </h1>

                    <p class="text-muted mb-0" style="font-size: 0.9rem;">
                        Mise à jour des informations de la convocation.
                    </p>

                </div>

            </div>

            <div class="heading-actions">

                <a href="{{ route('convocations.index') }}"
                   class="btn btn-outline-secondary btn-sm rounded-pill px-3"
                   style="font-weight: 500;">
                    <i class="bi bi-arrow-left me-1"></i>
                    Retour
                </a>

            </div>

        </div>

        <!-- STATUT DE LA CONVOCATION -->
        <div class="mb-4">

            <div class="d-flex align-items-center gap-3 p-3 rounded-4 bg-light"
                 style="border-left: 4px solid {{ $convocation->remise ? '#059e33' : '#ffc107' }};">

                <span class="badge rounded-pill px-4 py-2
                      {{ $convocation->remise ? 'bg-success' : 'bg-warning' }}"
                      style="font-weight: 600; font-size: 0.85rem; color: {{ $convocation->remise ? '#fff' : '#212529' }};">
                    @if($convocation->remise)
                        <i class="bi bi-check-circle-fill me-1"></i>
                        Remise
                    @else
                        <i class="bi bi-clock me-1"></i>
                        En attente
                    @endif
                </span>

                <span class="badge rounded-pill px-3 py-1"
                      style="background-color:rgba(22,131,255,.12); color:#1683ff; font-weight: 500; font-size: 0.7rem;">
                    <i class="bi bi-building me-1"></i>
                    {{ $convocation->inspection->etablissement }}
                </span>

                <span class="badge rounded-pill px-3 py-1"
                      style="background-color:rgba(108,117,125,.12); color:#6c757d; font-weight: 500; font-size: 0.7rem;">
                    <i class="bi bi-calendar3 me-1"></i>
                    {{ \Carbon\Carbon::parse($convocation->date_convocation)->format('d/m/Y') }}
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
        <div class="row justify-content-center">

            <div class="col-12 col-lg-8">

                <div class="panel card border-0 shadow-sm rounded-4">

                    <div class="card-header bg-transparent border-0 px-4 pt-4 pb-3">

                        <h2 class="h5 mb-0 fw-bold d-flex align-items-center gap-2 section-title">
                            <i class="bi bi-info-circle me-2"></i>
                            <span>Informations de la convocation</span>
                        </h2>

                    </div>

                    <div class="card-body px-4 pt-0 pb-4">

                        <form method="POST" action="{{ route('convocations.update', $convocation) }}">

                            @csrf
                            @method('PUT')

                            <div class="row g-3">

                                <!-- Référence (lecture seule) -->
                                <div class="col-12">

                                    <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                        Référence
                                    </label>

                                    <input type="text"
                                           class="form-control form-control-sm rounded-3"
                                           style="border-color: #e9ecef; background-color: #f8f9fc; font-weight: 600; color: #1683ff;"
                                           value="{{ $convocation->reference }}"
                                           readonly>

                                </div>

                                <!-- Établissement (lecture seule) -->
                                <div class="col-12">

                                    <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                        Établissement
                                    </label>

                                    <input type="text"
                                           class="form-control form-control-sm rounded-3"
                                           style="border-color: #e9ecef; background-color: #f8f9fc;"
                                           value="{{ $convocation->inspection->etablissement }}"
                                           readonly>

                                </div>

                                <!-- Date de convocation -->
                                <div class="col-12 col-md-6">

                                    <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                        Date de convocation <span class="text-danger">*</span>
                                    </label>

                                    <input type="date"
                                           name="date_convocation"
                                           class="form-control form-control-sm rounded-3"
                                           style="border-color: #e9ecef;"
                                           value="{{ old('date_convocation', $convocation->date_convocation) }}"
                                           required>

                                    @error('date_convocation')
                                        <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                                    @enderror

                                </div>

                                <!-- Heure -->
                                <div class="col-12 col-md-6">

                                    <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                        Heure <span class="text-danger">*</span>
                                    </label>

                                    <input type="time"
                                           name="heure_convocation"
                                           class="form-control form-control-sm rounded-3"
                                           style="border-color: #e9ecef;"
                                           value="{{ old('heure_convocation', $convocation->heure_convocation) }}"
                                           required>

                                    @error('heure_convocation')
                                        <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                                    @enderror

                                </div>

                                <!-- Infraction -->
                                <div class="col-12">

                                    <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                        Infraction constatée
                                    </label>

                                    <textarea name="infraction"
                                              rows="4"
                                              class="form-control form-control-sm rounded-3"
                                              style="border-color: #e9ecef;"
                                              placeholder="Décrivez l'infraction constatée...">{{ old('infraction', $convocation->infraction) }}</textarea>

                                    @error('infraction')
                                        <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                                    @enderror

                                </div>

                                <!-- Remise -->
                                <div class="col-12">

                                    <div class="form-check">

                                        <input type="checkbox"
                                               class="form-check-input"
                                               name="remise"
                                               value="1"
                                               id="remise"
                                               {{ old('remise', $convocation->remise) ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remise" style="font-size: 0.9rem;">
                                            Convocation remise à l'opérateur économique
                                        </label>

                                    </div>

                                </div>

                            </div>

                            <!-- Actions -->
                            <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mt-4 pt-3" style="border-top: 1px solid #f1f3f5;">

                                <a href="{{ route('convocations.index') }}"
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

        </div>

    </div>

</main>

@endsection