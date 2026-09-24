@extends('dashboards.index')

@section('content')

<main class="dashboard-content">

    <div class="container-fluid px-3 px-lg-4 py-4">

        <!-- PAGE HEADER -->
        <div class="page-heading d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">

            <div class="page-heading-copy d-flex align-items-center gap-3 section-title">

                <span class="page-icon">
                    <i class="bi bi-person-plus" aria-hidden="true"></i>
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
                                <a href="{{ route('users.index') }}">
                                    Utilisateurs
                                </a>
                            </li>
                            <li class="breadcrumb-item active text-secondary" aria-current="page">
                                Nouvel utilisateur
                            </li>
                        </ol>
                    </nav>

                    <h1 class="h3 mb-1 fw-bold">
                        Nouvel utilisateur
                    </h1>

                    <p class="text-muted mb-0" style="font-size: 0.9rem;">
                        Création d'un nouveau compte utilisateur.
                    </p>

                </div>

            </div>

            <div class="heading-actions">

                <a href="{{ route('users.index') }}"
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

        <!-- FORMULAIRE -->
        <div class="panel card border-0 shadow-sm rounded-4">

            <div class="card-header bg-transparent border-0 px-4 pt-4 pb-3">

                <h2 class="h5 mb-0 fw-bold d-flex align-items-center gap-2 section-title">
                    <i class="bi bi-info-circle me-2"></i>
                    <span>Informations de l'utilisateur</span>
                </h2>

            </div>

            <div class="card-body px-4 pt-0 pb-4">

                <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf

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
                                   value="{{ old('name') }}"
                                   placeholder="Nom et prénom"
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
                                   value="{{ old('email') }}"
                                   placeholder="utilisateur@domaine.com"
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
                                   value="{{ old('telephone') }}"
                                   placeholder="Ex : 01 23 45 67 89">

                            @error('telephone')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <!-- Fonction -->
                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Fonction
                            </label>

                            <input type="text"
                                   name="fonction"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   value="{{ old('fonction') }}"
                                   placeholder="Fonction de l'utilisateur">

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
                                    style="border-color: #e9ecef;">

                                <option value="">-- Choisir --</option>

                                <option value="Homme" {{ old('sexe') == 'Homme' ? 'selected' : '' }}>
                                    Homme
                                </option>

                                <option value="Femme" {{ old('sexe') == 'Femme' ? 'selected' : '' }}>
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
                                   value="{{ old('date_naissance') }}">

                            @error('date_naissance')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <!-- Rôle -->
                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Rôle <span class="text-danger">*</span>
                            </label>

                            <select name="role"
                                    class="form-select form-select-sm rounded-3"
                                    style="border-color: #e9ecef;"
                                    required>

                                @php
                                    $roles = [
                                        'admin' => 'Administrateur',
                                        'dg' => 'Directeur Général',
                                        'dt' => 'Directeur Technique',
                                        'inspecteur' => 'Inspecteur',
                                    ];
                                @endphp

                                @foreach($roles as $value => $label)
                                    <option value="{{ $value }}" {{ old('role') == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach

                            </select>

                            @error('role')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <!-- Photo -->
                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Photo de profil
                            </label>

                            <input type="file"
                                   name="photo"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   accept="image/*">

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
                                      style="border-color: #e9ecef;"
                                      placeholder="Adresse complète de l'utilisateur">{{ old('adresse') }}</textarea>

                            @error('adresse')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <!-- Mot de passe -->
                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Mot de passe <span class="text-danger">*</span>
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
                        <div class="col-12 col-md-6">

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

                        <a href="{{ route('users.index') }}"
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

        </div>

    </div>

</main>

@endsection