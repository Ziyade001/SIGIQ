@extends('dashboards.index')

@section('content')

@php
    $mustChangePassword = auth()->user()->must_change_password;
@endphp
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
                                <a href="{{ route('profile.show') }}">
                                    Profil
                                </a>
                            </li>
                            <li class="breadcrumb-item active text-secondary" aria-current="page">
                                Modifier
                            </li>
                        </ol>
                    </nav>

                    <h1 class="h3 mb-1 fw-bold">
                        Modifier mon profil
                    </h1>

                    <p class="text-muted mb-0" style="font-size: 0.9rem;">
                        Mettez à jour vos informations personnelles et professionnelles.
                    </p>

                </div>

            </div>

            <div class="heading-actions">

                <a href="{{ route('profile.show') }}"
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

@if(auth()->user()->must_change_password)

<div class="alert alert-warning border-0 shadow-sm rounded-4 mb-4">

    <div class="d-flex align-items-start">

        <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>

        <div>

            <h6 class="fw-bold mb-1">
                Changement de mot de passe obligatoire
            </h6>

            <p class="mb-0">
                Votre mot de passe a été réinitialisé par un administrateur.
                Pour des raisons de sécurité, vous devez définir un nouveau mot de passe avant de continuer à utiliser la plateforme.
            </p>

        </div>

    </div>

</div>

@endif

        <!-- INFORMATIONS PERSONNELLES -->
        <div class="panel card border-0 shadow-sm rounded-4 mb-4">

            <div class="card-header bg-transparent border-0 px-4 pt-4 pb-3">

                <h2 class="h5 mb-0 fw-bold d-flex align-items-center gap-2 section-title">
                    <i class="bi bi-person me-2"></i>
                    <span>Informations personnelles</span>
                </h2>

            </div>

            <div class="card-body px-4 pt-0 pb-4">
@if($mustChangePassword)

<div class="alert alert-info rounded-3 mb-3">

    <i class="bi bi-lock-fill me-2"></i>

    Les informations personnelles sont temporairement verrouillées.
    Vous devez d'abord modifier votre mot de passe.

</div>

@endif

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="row g-3">

                        <!-- Nom complet -->
                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Nom complet <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   name="name"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('name', $user->name) }}"
                                    {{ $mustChangePassword ? 'disabled' : '' }}
                                   placeholder="Votre nom complet"
                                   required>

                            @error('name')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <!-- Email -->
                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Email <span class="text-danger">*</span>
                            </label>

                            <input type="email"
                                   name="email"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('email', $user->email) }}"
                                    {{ $mustChangePassword ? 'disabled' : '' }}
                                   placeholder="votre@email.com"
                                   required>

                            @error('email')
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
                                   value="{{ old('telephone', $user->telephone) }}"
                                    {{ $mustChangePassword ? 'disabled' : '' }}
                                   placeholder="Ex : 01 23 45 67 89">

                            @error('telephone')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <!-- Fonction -->
                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Fonction <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   name="fonction"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('fonction', $user->fonction) }}"
                                    {{ $mustChangePassword ? 'disabled' : '' }}
                                   placeholder="Votre fonction"
                                   required>

                            @error('fonction')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <!-- Sexe -->
                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Sexe
                            </label>

                            <select name="sexe"
                                    class="form-select form-select-sm rounded-3"
                                    {{ $mustChangePassword ? 'disabled' : '' }}
                                    style="border-color: #e9ecef;">

                                <option value="">-- Choisir --</option>

                                <option value="Homme" {{ old('sexe', $user->sexe) == 'Homme' ? 'selected' : '' }}>
                                    Homme
                                </option>

                                <option value="Femme" {{ old('sexe', $user->sexe) == 'Femme' ? 'selected' : '' }}>
                                    Femme
                                </option>

                            </select>

                            @error('sexe')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <!-- Date de naissance -->
                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Date de naissance
                            </label>

                            <input type="date"
                                   name="date_naissance"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('date_naissance', $user->date_naissance) }}"
                                    {{ $mustChangePassword ? 'disabled' : '' }}>

                            @error('date_naissance')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <!-- Photo -->
                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Photo de profil
                            </label>

                            @if($user->photo)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/'.$user->photo) }}"
                                         class="rounded-circle"
                                         width="60"
                                         height="60"
                                         style="object-fit: cover;"
                                         alt="Photo actuelle">
                                    <small class="text-muted d-block" style="font-size: 0.7rem;">
                                        Photo actuelle
                                    </small>
                                </div>
                            @endif

                            <input type="file"
                                   name="photo"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   accept="image/*"
                                    {{ $mustChangePassword ? 'disabled' : '' }}>

                            @error('photo')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <!-- Adresse -->
                        <div class="col-12">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Adresse
                            </label>

                            <textarea name="adresse"
                                      rows="3"
                                      class="form-control form-control-sm rounded-3"
                                      {{ $mustChangePassword ? 'disabled' : '' }}
                                      style="border-color: #e9ecef;"
                                      placeholder="Votre adresse complète">{{ old('adresse', $user->adresse) }}</textarea>

                            @error('adresse')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                    </div>

                    <!-- Actions -->
                    @if(!$mustChangePassword)
                    <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mt-4 pt-3" style="border-top: 1px solid #f1f3f5;">
                        
                        <a href="{{ route('profile.show') }}"
                        {{ $mustChangePassword ? 'disabled' : '' }}
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
                    @endif
                </form>

            </div>

        </div>

        <!-- SÉCURITÉ DU COMPTE -->
        <div class="panel card border-0 shadow-sm rounded-4">

            <div class="card-header bg-transparent border-0 px-4 pt-4 pb-3">

                <h2 class="h5 mb-0 fw-bold d-flex align-items-center gap-2 section-title">
                    <i class="bi bi-shield-lock me-2"></i>
                    <span>Sécurité du compte</span>
                </h2>

            </div>

            <div class="card-body px-4 pt-0 pb-4">

                <form action="{{ route('profile.password') }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="row g-3">

                        <!-- Mot de passe actuel -->
                        <div class="col-12 col-md-4">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Mot de passe actuel <span class="text-danger">*</span>
                            </label>

                            <input type="password"
                                   name="current_password"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   placeholder="••••••••"
                                   required>

                            @error('current_password')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <!-- Nouveau mot de passe -->
                        <div class="col-12 col-md-4">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Nouveau mot de passe <span class="text-danger">*</span>
                            </label>

                            <input type="password"
                                   name="password"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   placeholder="••••••••"
                                   required>

                            @error('password')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <!-- Confirmation -->
                        <div class="col-12 col-md-4">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Confirmation <span class="text-danger">*</span>
                            </label>

                            <input type="password"
                                   name="password_confirmation"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   placeholder="••••••••"
                                   required>

                        </div>

                    </div>

                    <!-- Actions -->
                    <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mt-4 pt-3" style="border-top: 1px solid #f1f3f5;">

                        <button type="submit"
                                class="btn btn-success rounded-pill px-4 py-2"
                                style="font-weight: 500; background-color:#059e33; border-color:#059e33;">
                            <i class="bi bi-key me-2"></i>
                            Modifier le mot de passe
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</main>

@endsection