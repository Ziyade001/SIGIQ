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
                                <a href="{{ route('users.index') }}">
                                    Utilisateurs
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('users.show', $user) }}">
                                    {{ $user->name }}
                                </a>
                            </li>
                            <li class="breadcrumb-item active text-secondary" aria-current="page">
                                Modifier
                            </li>
                        </ol>
                    </nav>

                    <h1 class="h3 mb-1 fw-bold d-flex align-items-center gap-2">
                        Modifier un utilisateur
                        <span class="badge rounded-pill px-3 py-2"
                              style="background-color:rgba(255,193,7,.12); color:#ffc107; font-size: 0.7rem; font-weight: 600;">
                            {{ $user->matricule }}
                        </span>
                    </h1>

                    <p class="text-muted mb-0" style="font-size: 0.9rem;">
                        Mise à jour des informations de l'utilisateur.
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

        <!-- STATUT DE L'UTILISATEUR -->
        <div class="mb-4">

            @php
                $roleColors = [
                    'admin' => ['bg' => 'rgba(220,53,69,.12)', 'color' => '#dc3545'],
                    'dg' => ['bg' => 'rgba(5,158,51,.12)', 'color' => '#059e33'],
                    'dt' => ['bg' => 'rgba(255,193,7,.12)', 'color' => '#ffc107'],
                    'inspecteur' => ['bg' => 'rgba(22,131,255,.12)', 'color' => '#1683ff'],
                ];
                $role = strtolower($user->role);
                $style = $roleColors[$role] ?? ['bg' => 'rgba(108,117,125,.12)', 'color' => '#6c757d'];
            @endphp

            <div class="d-flex align-items-center gap-3 p-3 rounded-4 bg-light"
                 style="border-left: 4px solid {{ $style['color'] }};">

                <span class="badge rounded-pill px-4 py-2"
                      style="background-color:{{ $style['bg'] }}; color:{{ $style['color'] }}; font-weight: 600; font-size: 0.85rem;">
                    <i class="bi bi-person-badge me-1"></i>
                    {{ strtoupper($user->role) }}
                </span>

                <span class="badge rounded-pill px-3 py-1"
                      style="background-color:rgba(108,117,125,.12); color:#6c757d; font-weight: 500; font-size: 0.7rem;">
                    <i class="bi bi-calendar3 me-1"></i>
                    Créé le {{ $user->created_at->format('d/m/Y') }}
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
                    <span>Informations de l'utilisateur</span>
                </h2>

            </div>

            <div class="card-body px-4 pt-0 pb-4">

                <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">

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
                                   value="{{ old('email', $user->email) }}"
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
                                   value="{{ old('telephone', $user->telephone) }}"
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
                                   value="{{ old('fonction', $user->fonction) }}"
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
                                   value="{{ old('date_naissance', $user->date_naissance) }}">

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
                                    <option value="{{ $value }}" {{ old('role', $user->role) == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach

                            </select>

                            @error('role')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <!-- Matricule (lecture seule) -->
                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Matricule
                            </label>

                            <input type="text"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef; background-color: #f8f9fc; font-weight: 600;"
                                   value="{{ $user->matricule }}"
                                   readonly>

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
                                         alt="Photo de {{ $user->name }}">
                                    <small class="text-muted d-block" style="font-size: 0.7rem;">
                                        Photo actuelle
                                    </small>
                                </div>
                            @endif

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
                                      placeholder="Adresse complète de l'utilisateur">{{ old('adresse', $user->adresse) }}</textarea>

                            @error('adresse')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <!-- Mot de passe -->
                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Nouveau mot de passe
                            </label>

                            <input type="password"
                                   name="password"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   placeholder="••••••••">

                            <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">
                                Laisser vide pour conserver le mot de passe actuel.
                            </small>

                            @error('password')
                                <small class="text-danger d-block mt-1" style="font-size: 0.75rem;">{{ $message }}</small>
                            @enderror

                        </div>

                        <!-- Confirmation -->
                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold" style="font-size: 0.85rem;">
                                Confirmation
                            </label>

                            <input type="password"
                                   name="password_confirmation"
                                   class="form-control form-control-sm rounded-3"
                                   style="border-color: #e9ecef;"
                                   placeholder="••••••••">

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
                            Mettre à jour
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</main>

@endsection