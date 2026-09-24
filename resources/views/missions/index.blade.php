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
                            <li class="breadcrumb-item active text-secondary" aria-current="page">
                                Missions
                            </li>
                        </ol>
                    </nav>

                    @if(auth()->user()->role === 'dt')
                        <h1 class="h3 mb-1 fw-bold">
                            Liste des missions
                        </h1>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">
                            Consultez, gérez et suivez les missions d'inspection planifiées
                        </p>
                    @else
                        <h1 class="h3 mb-1 fw-bold">
                            Liste de mes missions
                        </h1>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">
                            Consultez vos missions d'inspection
                        </p>
                    @endif

                </div>

            </div>

            @if(auth()->user()->role === 'dt')
                <div class="heading-actions">

                    <a href="{{ route('missions.create') }}" 
                       class="btn btn-primary btn-sm rounded-pill px-3" 
                       style="font-weight: 500; background-color:#059e33; border-color:#059e33;">
                        <i class="bi bi-plus-circle me-1"></i>
                        Nouvelle mission
                    </a>

                </div>
            @endif

        </div>

        <!-- RECHERCHE -->
        <form method="GET" action="{{ route('missions.index') }}" class="mb-4">

    <div class="row g-2 align-items-end">

        <div class="col-md-5">

            <label class="form-label small fw-semibold">
                Recherche
            </label>

            <input type="text"
                   name="search"
                   class="form-control form-control-sm"
                   placeholder="Référence, objet, lieu..."
                   value="{{ request('search') }}">

        </div>

        <div class="col-md-2">

            <label class="form-label small fw-semibold">
                Mois
            </label>

            <select name="mois" class="form-select form-select-sm">

                @foreach(range(1,12) as $m)

                    <option value="{{ $m }}"
                        {{ $mois == $m ? 'selected' : '' }}>

                        {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}

                    </option>

                @endforeach

            </select>

        </div>

        <div class="col-md-2">

            <label class="form-label small fw-semibold">
                Année
            </label>

            <select name="annee" class="form-select form-select-sm">

                @for($a = now()->year; $a >= now()->year-5; $a--)

                    <option value="{{ $a }}"
                        {{ $annee == $a ? 'selected' : '' }}>

                        {{ $a }}

                    </option>

                @endfor

            </select>

        </div>

        <div class="col-md-3 d-flex gap-2">

            <button class="btn btn-primary btn-sm flex-fill">

                <i class="bi bi-search"></i>

                Filtrer

            </button>

            <a href="{{ route('missions.index') }}"
               class="btn btn-outline-secondary btn-sm">

                <i class="bi bi-arrow-clockwise"></i>

            </a>

        </div>

    </div>

</form>

        <!-- STATISTIQUES RAPIDES -->
        @if(auth()->user()->role === 'dt')

        <section class="row g-3 mb-4" aria-label="Statistiques des missions">

            <!-- Total missions -->
            <div class="col-12 col-sm-6 col-xl-3">

                <article class="card border-0 shadow-sm h-100 rounded-4" style="border-top:4px solid #1683ff !important;">

                    <div class="card-body p-3">

                        <div class="d-flex justify-content-between align-items-start mb-2">

                            <span class="badge text-uppercase small fw-semibold"
                                  style="background-color:rgba(22,131,255,.12); color:#1683ff; letter-spacing: 0.04em; font-size: 0.65rem;">
                                Total missions
                            </span>

                            <span class="badge bg-opacity-10 p-2 rounded-3"
                                  style="background-color:rgba(22,131,255,.12); color:#1683ff; font-size: 1.1rem; line-height: 1;">
                                <i class="bi bi-clipboard-check"></i>
                            </span>

                        </div>

                        <div class="fs-1 fw-bold lh-1 mb-1">
                            {{ $totalMissions ?? $missions->count() }}
                        </div>

                        <div class="small text-secondary d-flex align-items-center gap-1">
                            <span class="d-inline-block rounded-circle" 
                                  style="width: 6px; height: 6px; background:#1683ff;"></span>
                            Mission(s) au total
                        </div>

                    </div>

                </article>

            </div>

            <!-- En cours -->
            <div class="col-12 col-sm-6 col-xl-3">

                <article class="card border-0 shadow-sm h-100 rounded-4" style="border-top:4px solid #ffc107 !important;">

                    <div class="card-body p-3">

                        <div class="d-flex justify-content-between align-items-start mb-2">

                            <span class="badge text-uppercase small fw-semibold"
                                  style="background-color:rgba(255,193,7,.12); color:#ffc107; letter-spacing: 0.04em; font-size: 0.65rem;">
                                En cours
                            </span>

                            <span class="badge bg-opacity-10 p-2 rounded-3"
                                  style="background-color:rgba(255,193,7,.12); color:#ffc107; font-size: 1.1rem; line-height: 1;">
                                <i class="bi bi-hourglass-split"></i>
                            </span>

                        </div>

                        <div class="fs-1 fw-bold lh-1 mb-1">
                            {{ $missions->where('statut', 'en_cours')->count() }}
                        </div>

                        <div class="small text-secondary d-flex align-items-center gap-1">
                            <span class="d-inline-block rounded-circle" 
                                  style="width: 6px; height: 6px; background:#ffc107;"></span>
                            Mission(s) active(s)
                        </div>

                    </div>

                </article>

            </div>

            <!-- Terminées -->
            <div class="col-12 col-sm-6 col-xl-3">

                <article class="card border-0 shadow-sm h-100 rounded-4" style="border-top:4px solid #059e33 !important;">

                    <div class="card-body p-3">

                        <div class="d-flex justify-content-between align-items-start mb-2">

                            <span class="badge text-uppercase small fw-semibold"
                                  style="background-color:rgba(5,158,51,.12); color:#059e33; letter-spacing: 0.04em; font-size: 0.65rem;">
                                Terminées
                            </span>

                            <span class="badge bg-opacity-10 p-2 rounded-3"
                                  style="background-color:rgba(5,158,51,.12); color:#059e33; font-size: 1.1rem; line-height: 1;">
                                <i class="bi bi-check-circle"></i>
                            </span>

                        </div>

                        <div class="fs-1 fw-bold lh-1 mb-1">
                            {{ $missions->where('statut', 'terminee')->count() }}
                        </div>

                        <div class="small text-secondary d-flex align-items-center gap-1">
                            <span class="d-inline-block rounded-circle" 
                                  style="width: 6px; height: 6px; background:#059e33;"></span>
                            @php
                                $total = $missions->count();
                                $terminees = $missions->where('statut', 'terminee')->count();
                                $pourcentage = $total > 0 ? round(($terminees / $total) * 100) : 0;
                            @endphp
                            {{ $pourcentage }}% du total
                        </div>

                        <div class="progress mt-2" style="height: 4px; border-radius: 4px; background: #e9ecef;">
                            <div class="progress-bar bg-success" 
                                 style="width: {{ $pourcentage }}%; border-radius: 4px; transition: width 0.5s ease;">
                            </div>
                        </div>

                    </div>

                </article>

            </div>

            <!-- Validées -->
            <div class="col-12 col-sm-6 col-xl-3">

                <article class="card border-0 shadow-sm h-100 rounded-4" style="border-top:4px solid #0d6efd !important;">

                    <div class="card-body p-3">

                        <div class="d-flex justify-content-between align-items-start mb-2">

                            <span class="badge text-uppercase small fw-semibold"
                                  style="background-color:rgba(13,110,253,.12); color:#0d6efd; letter-spacing: 0.04em; font-size: 0.65rem;">
                                Validées
                            </span>

                            <span class="badge bg-opacity-10 p-2 rounded-3"
                                  style="background-color:rgba(13,110,253,.12); color:#0d6efd; font-size: 1.1rem; line-height: 1;">
                                <i class="bi bi-file-text"></i>
                            </span>

                        </div>

                        <div class="fs-1 fw-bold lh-1 mb-1">
                            {{ $missions->where('statut', 'validee')->count() }}
                        </div>

                        <div class="small text-secondary d-flex align-items-center gap-1">
                            <span class="d-inline-block rounded-circle" 
                                  style="width: 6px; height: 6px; background:#0d6efd;"></span>
                            @php
                                $validees = $missions->where('statut', 'validee')->first();
                            @endphp
                            Dernière : {{ $validees ? \Carbon\Carbon::parse($validees->periode_debut)->format('d/m/Y') : 'N/A' }}
                        </div>

                    </div>

                </article>

            </div>

        </section>

        @endif

        <!-- TABLEAU -->
        <div class="panel card border-0 shadow-sm rounded-4">

            <div class="panel-header card-header bg-transparent border-0 d-flex flex-wrap align-items-center justify-content-between gap-2 px-4 pt-4 pb-3">

                <div>

                    <h2 class="h5 mb-1 fw-bold d-flex align-items-center gap-2 section-title">
                        <i class="bi bi-table me-2"></i>
                        @if(auth()->user()->role === 'dt')
                            <span>Missions enregistrées</span>
                        @else
                            <span>Mes missions</span>
                        @endif
                    </h2>

                    <p class="text-muted mb-0" style="font-size: 0.85rem;">
                        {{ $missions->total() }} mission(s) trouvée(s)
                    </p>

                </div>

            </div>

            <div class="table-responsive px-1">

                <table class="table align-middle mb-0" style="font-size: 0.9rem;">

                    <thead style="background: #f8f9fc; border-bottom: 2px solid #e9ecef;">
                        <tr>
                            <th class="text-uppercase small fw-semibold text-secondary" 
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Référence
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary" 
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Période
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary" 
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Catégorie & Type
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary" 
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Localités
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary" 
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Véhicule
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary" 
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Statut
                            </th>
                            <th class="text-end text-uppercase small fw-semibold text-secondary" 
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($missions as $mission)

                        <tr style="border-bottom: 1px solid #f1f3f5; transition: background 0.15s;"
                            onmouseover="this.style.background='#f8f9fc'" 
                            onmouseout="this.style.background='transparent'">

                            <td class="py-2 px-2">
                                <span class="badge bg-light text-dark rounded-pill px-3 py-1" style="font-weight: 600; font-size: 0.75rem;">
                                    {{ $mission->reference }}
                                </span>
                            </td>

                            <td class="py-2 px-2" style="font-size: 0.8rem;">

                                <div>

                                    <span class="fw-semibold">
                                        {{ \Carbon\Carbon::parse($mission->periode_debut)->format('d/m/Y') }}
                                    </span>

                                    <br>

                                    <small class="text-muted">
                                        <i class="bi bi-arrow-right"></i> 
                                        {{ \Carbon\Carbon::parse($mission->periode_fin)->format('d/m/Y') }}
                                    </small>

                                    <span class="badge bg-light text-dark ms-1 rounded-pill" style="font-size: 0.6rem;">
                                        {{ \Carbon\Carbon::parse($mission->periode_debut)->diffInDays($mission->periode_fin) }}j
                                    </span>

                                </div>

                            </td>

                            <td class="py-2 px-2">

                                <div class="d-flex flex-column gap-1">

                                    <span class="badge rounded-pill px-3 py-1" 
                                          style="background-color:rgba(5,158,51,.12); color:#059e33; font-weight: 500; font-size: 0.7rem;">
                                        <i class="bi bi-folder2-open me-1"></i>
                                        {{ $mission->categorie }}
                                    </span>

                                    <span class="badge rounded-pill px-3 py-1" 
                                          style="background-color:rgba(22,131,255,.12); color:#1683ff; font-weight: 500; font-size: 0.7rem;">
                                        <i class="bi bi-tag me-1"></i>
                                        {{ $mission->type_mission }}
                                    </span>

                                </div>

                            </td>

                            <td class="py-2 px-2">
                                <span class="text-truncate d-inline-block" 
                                      style="max-width: 130px; font-size: 0.85rem;"
                                      data-bs-toggle="tooltip" 
                                      title="{{ $mission->localites }}">
                                    <i class="bi bi-geo-alt me-1 text-muted" style="font-size: 0.7rem;"></i>
                                    {{ $mission->localites }}
                                </span>
                            </td>

                            <td class="py-2 px-2" style="font-size: 0.85rem;">
                                <i class="bi bi-truck me-1 text-muted" style="font-size: 0.7rem;"></i>
                                {{ $mission->vehicule }}
                            </td>

                            <td class="py-2 px-2">

                                @switch($mission->statut)

                                    @case('planifiee')
                                        <span class="badge rounded-pill px-3 py-1" 
                                              style="background-color:rgba(108,117,125,.12); color:#6c757d; font-weight: 500;">
                                            <i class="bi bi-calendar-event me-1"></i> Planifiée
                                        </span>
                                        @break

                                    @case('en_cours')
                                        <span class="badge rounded-pill px-3 py-1" 
                                              style="background-color:rgba(255,193,7,.12); color:#ffc107; font-weight: 500;">
                                            <i class="bi bi-hourglass-split me-1"></i> En cours
                                        </span>
                                        @break

                                    @case('terminee')
                                        <span class="badge rounded-pill px-3 py-1" 
                                              style="background-color:rgba(5,158,51,.12); color:#059e33; font-weight: 500;">
                                            <i class="bi bi-check-circle me-1"></i> Terminée
                                        </span>
                                        @break

                                    @case('validee')
                                        <span class="badge rounded-pill px-3 py-1" 
                                              style="background-color:rgba(22,131,255,.12); color:#1683ff; font-weight: 500;">
                                            <i class="bi bi-check-circle-fill me-1"></i> Validée
                                        </span>
                                        @break

                                    @default
                                        <span class="badge rounded-pill px-3 py-1 bg-light text-dark">
                                            {{ $mission->statut }}
                                        </span>

                                @endswitch

                            </td>

                            <td class="text-end py-2 px-2">

                                <div class="d-flex justify-content-end gap-1">

                                    <!-- Voir -->
                                    <a href="{{ route('missions.show', $mission) }}" 
                                       class="btn btn-outline-primary btn-sm rounded-pill px-2"
                                       style="font-size: 0.7rem; font-weight: 500;"
                                       data-bs-toggle="tooltip" 
                                       title="Voir les détails">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    @if(auth()->user()->role === 'dt')

                                        <!-- Modifier -->
                                        <a href="{{ route('missions.edit', $mission) }}" 
                                           class="btn btn-outline-warning btn-sm rounded-pill px-2"
                                           style="font-size: 0.7rem; font-weight: 500;"
                                           data-bs-toggle="tooltip" 
                                           title="Modifier">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <!-- Clôturer -->
                                        @if($mission->statut === 'en_cours')

                                            <form action="{{ route('missions.cloture', $mission) }}"
                                                  method="POST"
                                                  class="d-inline">

                                                @csrf
                                                @method('PATCH')

                                                <button type="submit"
                                                        class="btn btn-outline-success btn-sm rounded-pill px-2"
                                                        style="font-size: 0.7rem; font-weight: 500;"
                                                        data-bs-toggle="tooltip"
                                                        title="Clôturer la mission"
                                                        onclick="return confirm('Clôturer cette mission ?')">

                                                    <i class="bi bi-check2-square"></i>

                                                </button>

                                            </form>

                                        @endif

                                        <!-- Supprimer -->
                                        <form action="{{ route('missions.destroy', $mission) }}" 
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette mission ? Cette action est irréversible.')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-outline-danger btn-sm rounded-pill px-2"
                                                    style="font-size: 0.7rem; font-weight: 500;"
                                                    data-bs-toggle="tooltip"
                                                    title="Supprimer">
                                                <i class="bi bi-trash"></i>
                                            </button>

                                        </form>

                                    @endif

                                    <!-- Rapport -->
                                    @if(in_array($mission->statut, ['terminee', 'validee']))

                                        <a href="{{ route('rapports.show', $mission) }}"
                                           class="btn btn-outline-success btn-sm rounded-pill px-2"
                                           style="font-size: 0.7rem; font-weight: 500;"
                                           data-bs-toggle="tooltip"
                                           title="Afficher le rapport">

                                            <i class="bi bi-file-earmark-text"></i>

                                        </a>

                                    @endif

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="7" class="text-center text-muted py-5">

                                <div class="empty-state">

                                    <i class="bi bi-clipboard-x display-4 text-muted d-block mb-3" style="font-size: 3rem;"></i>

                                    <h5 class="mt-3 fw-bold">
                                        Aucune mission trouvée
                                    </h5>

                                    <p class="text-muted mb-3" style="font-size: 0.9rem;">
                                        {{ request()->anyFilled(['search', 'type_mission', 'statut']) ? 
                                            'Aucune mission ne correspond à vos critères de recherche.' : 
                                            'Commencez par créer votre première mission d\'inspection.' }}
                                    </p>

                                    @if(request()->anyFilled(['search', 'type_mission', 'statut']))
                                        <a href="{{ route('missions.index') }}" 
                                           class="btn btn-outline-primary btn-sm rounded-pill px-3"
                                           style="font-weight: 500;">
                                            <i class="bi bi-arrow-counterclockwise me-1"></i>
                                            Réinitialiser les filtres
                                        </a>
                                    @else
                                        <a href="{{ route('missions.create') }}" 
                                           class="btn btn-primary btn-sm rounded-pill px-3"
                                           style="font-weight: 500; background-color:#059e33; border-color:#059e33;">
                                            <i class="bi bi-plus-circle me-1"></i>
                                            Créer une mission
                                        </a>
                                    @endif

                                </div>

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <!-- Pagination -->
            @if($missions->hasPages())

                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 p-3 border-top">

                    <div class="text-muted small" style="font-size: 0.8rem;">
                        Affichage de {{ $missions->firstItem() ?? 0 }} à {{ $missions->lastItem() ?? 0 }} sur {{ $missions->total() }} missions
                    </div>

                    <div>
                        {{ $missions->appends(request()->query())->links() }}
                    </div>

                </div>

            @endif

        </div>

    </div>

</main>

@endsection