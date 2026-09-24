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
                                <a href="{{ route('missions.index') }}">
                                    Missions
                                </a>
                            </li>
                            <li class="breadcrumb-item active text-secondary" aria-current="page">
                                {{ $mission->reference }}
                            </li>
                        </ol>
                    </nav>

                    <h1 class="h3 mb-1 fw-bold d-flex align-items-center gap-2">
                        Détails de la mission
                        <span class="badge rounded-pill px-3 py-2" 
                              style="background-color:rgba(5,158,51,.12); color:#059e33; font-size: 0.7rem; font-weight: 600;">
                            {{ $mission->reference }}
                        </span>
                    </h1>

                    <p class="text-muted mb-0" style="font-size: 0.9rem;">
                        Consultation des informations de mission.
                    </p>

                </div>

            </div>

            <div class="heading-actions d-flex gap-2">

                @if(auth()->user()->role === 'dt')
                    <a href="{{ route('missions.edit', $mission) }}" 
                       class="btn btn-outline-warning btn-sm rounded-pill px-3" 
                       style="font-weight: 500;">
                        <i class="bi bi-pencil me-1"></i>
                        Modifier
                    </a>
                @endif

                <a href="{{ route('missions.index') }}" 
                   class="btn btn-outline-secondary btn-sm rounded-pill px-3" 
                   style="font-weight: 500;">
                    <i class="bi bi-arrow-left me-1"></i>
                    Retour
                </a>

            </div>

        </div>

        <!-- STATUT DE LA MISSION -->
        <div class="mb-4">

            @php
                $statutClasses = [
                    'planifiee' => ['bg' => 'rgba(108,117,125,.12)', 'color' => '#6c757d', 'icon' => 'bi-calendar-event'],
                    'en_cours' => ['bg' => 'rgba(255,193,7,.12)', 'color' => '#ffc107', 'icon' => 'bi-hourglass-split'],
                    'terminee' => ['bg' => 'rgba(5,158,51,.12)', 'color' => '#059e33', 'icon' => 'bi-check-circle'],
                    'validee' => ['bg' => 'rgba(22,131,255,.12)', 'color' => '#1683ff', 'icon' => 'bi-check-circle-fill'],
                ];
                $statut = $mission->statut ?? 'planifiee';
                $classe = $statutClasses[$statut] ?? $statutClasses['planifiee'];
            @endphp

            <div class="d-flex align-items-center gap-3 p-3 rounded-4 bg-light" 
                 style="border-left: 4px solid {{ $classe['color'] }};">

                <span class="badge rounded-pill px-4 py-2" 
                      style="background-color:{{ $classe['bg'] }}; color:{{ $classe['color'] }}; font-weight: 600; font-size: 0.85rem;">
                    <i class="bi {{ $classe['icon'] }} me-1"></i>
                    {{ ucfirst(str_replace('_', ' ', $statut)) }}
                </span>

                <span class="text-muted small">
                    @if($statut === 'planifiee')
                        Mission planifiée, en attente de démarrage.
                    @elseif($statut === 'en_cours')
                        Mission en cours d'exécution.
                    @elseif($statut === 'terminee')
                        Mission terminée, en attente de validation.
                    @elseif($statut === 'validee')
                        Mission validée et clôturée.
                    @endif
                </span>

            </div>

        </div>

        <!-- CONTENU PRINCIPAL -->
        <div class="row g-4">

            <!-- COLONNE GAUCHE -->
            <div class="col-12 col-lg-8">

                <!-- Informations générales -->
                <div class="panel card border-0 shadow-sm rounded-4">

                    <div class="card-header bg-transparent border-0 px-4 pt-4 pb-3">

                        <h2 class="h5 mb-0 fw-bold d-flex align-items-center gap-2 section-title">
                            <i class="bi bi-info-circle me-2"></i>
                            <span>Informations générales</span>
                        </h2>

                    </div>

                    <div class="card-body px-4 pt-0 pb-4">

                        <div class="table-responsive">

                            <table class="table table-borderless mb-0" style="font-size: 0.9rem;">

                                <tbody>

                                    <tr style="border-bottom: 1px solid #f1f3f5;">
                                        <th style="width: 35%; padding: 0.75rem 0.5rem; color: #6c757d; font-weight: 600; font-size: 0.85rem;">
                                            <i class="bi bi-tag me-2 text-muted"></i>
                                            Type de mission
                                        </th>
                                        <td style="padding: 0.75rem 0.5rem; font-weight: 500;">
                                            <span class="badge rounded-pill px-3 py-1"
                                                  style="background-color:rgba(22,131,255,.12); color:#1683ff; font-weight: 500;">
                                                {{ $mission->type_mission }}
                                            </span>
                                        </td>
                                    </tr>

                                    <tr style="border-bottom: 1px solid #f1f3f5;">
                                        <th style="padding: 0.75rem 0.5rem; color: #6c757d; font-weight: 600; font-size: 0.85rem;">
                                            <i class="bi bi-folder2-open me-2 text-muted"></i>
                                            Catégorie
                                        </th>
                                        <td style="padding: 0.75rem 0.5rem; font-weight: 500;">
                                            <span class="badge rounded-pill px-3 py-1"
                                                  style="background-color:rgba(5,158,51,.12); color:#059e33; font-weight: 500;">
                                                {{ $mission->categorie }}
                                            </span>
                                        </td>
                                    </tr>

                                    <tr style="border-bottom: 1px solid #f1f3f5;">
                                        <th style="padding: 0.75rem 0.5rem; color: #6c757d; font-weight: 600; font-size: 0.85rem;">
                                            <i class="bi bi-calendar-range me-2 text-muted"></i>
                                            Période
                                        </th>
                                        <td style="padding: 0.75rem 0.5rem;">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="fw-semibold">
                                                    {{ \Carbon\Carbon::parse($mission->periode_debut)->format('d/m/Y') }}
                                                </span>
                                                <i class="bi bi-arrow-right text-muted"></i>
                                                <span class="fw-semibold">
                                                    {{ \Carbon\Carbon::parse($mission->periode_fin)->format('d/m/Y') }}
                                                </span>
                                                <span class="badge bg-light text-dark rounded-pill ms-1" style="font-size: 0.65rem;">
                                                    {{ \Carbon\Carbon::parse($mission->periode_debut)->diffInDays($mission->periode_fin) }} jours
                                                </span>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr style="border-bottom: 1px solid #f1f3f5;">
                                        <th style="padding: 0.75rem 0.5rem; color: #6c757d; font-weight: 600; font-size: 0.85rem;">
                                            <i class="bi bi-geo-alt me-2 text-muted"></i>
                                            Localités
                                        </th>
                                        <td style="padding: 0.75rem 0.5rem;">
                                            {{ $mission->localites }}
                                        </td>
                                    </tr>

                                    <tr style="border-bottom: 1px solid #f1f3f5;">
                                        <th style="padding: 0.75rem 0.5rem; color: #6c757d; font-weight: 600; font-size: 0.85rem;">
                                            <i class="bi bi-truck me-2 text-muted"></i>
                                            Véhicule
                                        </th>
                                        <td style="padding: 0.75rem 0.5rem;">
                                            {{ $mission->vehicule ?? 'Non spécifié' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th style="padding: 0.75rem 0.5rem; color: #6c757d; font-weight: 600; font-size: 0.85rem;">
                                            <i class="bi bi-person me-2 text-muted"></i>
                                            Conducteur
                                        </th>
                                        <td style="padding: 0.75rem 0.5rem;">
                                            {{ $mission->conducteur_cva ?? 'Non spécifié' }}
                                        </td>
                                    </tr>

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

                <!-- Activités prévues -->
                <div class="panel card border-0 shadow-sm rounded-4 mt-3">

                    <div class="card-header bg-transparent border-0 px-4 pt-4 pb-3">

                        <h2 class="h5 mb-0 fw-bold d-flex align-items-center gap-2 section-title">
                            <i class="bi bi-list-task me-2"></i>
                            <span>Activités prévues</span>
                        </h2>

                    </div>

                    <div class="card-body px-4 pt-0 pb-4">

                        @if($mission->activites)

                            <div class="p-3 rounded-3" style="background: #f8f9fc; font-size: 0.95rem; line-height: 1.8;">
                                {!! nl2br(e($mission->activites)) !!}
                            </div>

                        @else

                            <p class="text-muted text-center py-3 mb-0" style="font-size: 0.9rem;">
                                <i class="bi bi-info-circle me-1"></i>
                                Aucune activité prévue pour cette mission.
                            </p>

                        @endif

                    </div>

                </div>

            </div>

            <!-- COLONNE DROITE -->
            <div class="col-12 col-lg-4">

                <!-- Participants -->
                <div class="panel card border-0 shadow-sm rounded-4">

                    <div class="card-header bg-transparent border-0 px-4 pt-4 pb-3">

                        <h2 class="h5 mb-0 fw-bold d-flex align-items-center gap-2 section-title">
                            <i class="bi bi-people me-2"></i>
                            <span>Participants</span>
                            <span class="badge rounded-pill ms-auto" 
                                  style="background-color:rgba(22,131,255,.12); color:#1683ff; font-size: 0.7rem; font-weight: 600;">
                                {{ $mission->participants->count() }}
                            </span>
                        </h2>

                    </div>

                    <div class="card-body px-4 pt-0 pb-4">

                        @if($mission->participants->count() > 0)

                            <div class="list-group list-group-flush">

                                @foreach($mission->participants as $participant)

                                    <div class="list-group-item border-0 px-0 py-3 d-flex align-items-center justify-content-between"
                                         style="border-bottom: 1px solid #f1f3f5;">

                                        <div class="d-flex align-items-center gap-3">

                                            <span class="d-flex align-items-center justify-content-center rounded-circle"
                                                  style="width: 36px; height: 36px; background:rgba(22,131,255,.12); color:#1683ff; flex-shrink:0; font-weight: 600; font-size: 0.8rem;">
                                                {{ substr($participant->name, 0, 2) }}
                                            </span>

                                            <div>

                                                <span class="fw-semibold" style="font-size: 0.9rem;">
                                                    {{ $participant->name }}
                                                </span>

                                                @if($participant->pivot->chef_equipe)
                                                    <br>
                                                    <span class="badge rounded-pill px-2 py-1" 
                                                          style="background-color:rgba(5,158,51,.12); color:#059e33; font-size: 0.6rem; font-weight: 600;">
                                                        <i class="bi bi-star-fill me-1" style="font-size: 0.5rem;"></i>
                                                        Chef d'équipe
                                                    </span>
                                                @endif

                                            </div>

                                        </div>

                                        @if($participant->pivot->chef_equipe)
                                            <i class="bi bi-crown text-warning" style="font-size: 1.1rem;"></i>
                                        @endif

                                    </div>

                                @endforeach

                            </div>

                        @else

                            <p class="text-muted text-center py-3 mb-0" style="font-size: 0.9rem;">
                                <i class="bi bi-people me-1"></i>
                                Aucun participant assigné.
                            </p>

                        @endif

                    </div>

                </div>

                <!-- Actions rapides -->
                <div class="panel card border-0 shadow-sm rounded-4 mt-3">

                    <div class="card-header bg-transparent border-0 px-4 pt-4 pb-3">

                        <h2 class="h5 mb-0 fw-bold d-flex align-items-center gap-2 section-title">
                            <i class="bi bi-lightning me-2"></i>
                            <span>Actions rapides</span>
                        </h2>

                    </div>

                    <div class="card-body px-4 pt-0 pb-4">

                        <div class="d-grid gap-2">

                            @if($mission->statut === 'en_cours' && auth()->user()->role === 'dt')

                                <form action="{{ route('missions.cloture', $mission) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" 
                                            class="btn btn-outline-success w-100 rounded-pill py-2"
                                            style="font-weight: 500;"
                                            onclick="return confirm('Confirmer la clôture de cette mission ?')">
                                        <i class="bi bi-check2-square me-2"></i>
                                        Clôturer la mission
                                    </button>
                                </form>

                            @endif

                            @if(in_array($mission->statut, ['terminee', 'validee']))

                                <a href="{{ route('rapports.show', $mission) }}" 
                                   class="btn btn-outline-primary w-100 rounded-pill py-2"
                                   style="font-weight: 500;">
                                    <i class="bi bi-file-earmark-text me-2"></i>
                                    Voir le rapport
                                </a>

                            @endif

                            <a href="{{ route('missions.index') }}" 
                               class="btn btn-outline-secondary w-100 rounded-pill py-2"
                               style="font-weight: 500;">
                                <i class="bi bi-arrow-left me-2"></i>
                                Retour à la liste
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</main>

@endsection