@extends('dashboards.index')

@section('content')

<main class="dashboard-content">

    <div class="container-fluid px-3 px-lg-4 py-4">

        <!-- PAGE HEADER -->
        <div class="page-heading d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">

            <div class="page-heading-copy d-flex align-items-center gap-3 section-title">

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
                            <li class="breadcrumb-item active text-secondary" aria-current="page">
                                Rapports
                            </li>
                        </ol>
                    </nav>

                    <h1 class="h3 mb-1 fw-bold">
                        Rapports de missions
                    </h1>

                    <p class="text-muted mb-0" style="font-size: 0.9rem;">
                        Gestion et suivi des rapports des missions terminées.
                    </p>

                </div>

            </div>

        </div>

        <!-- RECHERCHE -->
        <form method="GET" action="{{ route('rapports.index') }}" class="mb-4">

    <div class="row g-2 align-items-end">

        <div class="col-md-5">

            <label class="form-label small fw-semibold">
                Recherche
            </label>

            <input type="text"
                   name="search"
                   class="form-control form-control-sm"
                   placeholder="Référence, objet ou zone..."
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

            <a href="{{ route('rapports.index') }}"
               class="btn btn-outline-secondary btn-sm">

                <i class="bi bi-arrow-clockwise"></i>

            </a>

        </div>

    </div>

</form>

        <!-- MESSAGE DE SUCCÈS -->
        @if(session('success'))

            <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4" style="border-left: 4px solid #059e33;">

                <div class="d-flex align-items-start gap-2">

                    <i class="bi bi-check-circle-fill text-success mt-1" style="font-size: 1.2rem;"></i>

                    <div>
                        {{ session('success') }}
                    </div>

                </div>

            </div>

        @endif

        <!-- TABLEAU DES RAPPORTS -->
        <div class="panel card border-0 shadow-sm rounded-4">

            <div class="panel-header card-header bg-transparent border-0 d-flex flex-wrap align-items-center justify-content-between gap-2 px-4 pt-4 pb-3">

                <div>

                    <h2 class="h5 mb-1 fw-bold d-flex align-items-center gap-2 section-title">
                        <i class="bi bi-list-ul me-2"></i>
                        <span>Liste des rapports</span>
                    </h2>

                    <p class="text-muted mb-0" style="font-size: 0.85rem;">
                        {{ $missions->total() }} rapport(s) trouvé(s)
                    </p>

                </div>

                @php
                    $rapportsComplets = $missions->filter(function($m) {
                        return $m->fiche_signee_par && $m->compte_rendu;
                    })->count();
                @endphp

                <span class="badge rounded-pill px-3 py-2"
                      style="background-color:rgba(5,158,51,.12); color:#059e33; font-weight: 600; font-size: 0.75rem;">
                    <i class="bi bi-check-circle-fill me-1"></i>
                    {{ $rapportsComplets }} complets
                </span>

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
                                Catégorie
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary"
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Type
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary"
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Localités
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary text-center"
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Rapport
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
                                    <span class="fw-semibold" style="font-size: 0.85rem;">
                                        {{ $mission->reference }}
                                    </span>
                                </td>

                                <td class="py-2 px-2" style="font-size: 0.8rem;">
                                    <i class="bi bi-calendar-event text-secondary me-1" style="font-size: 0.65rem;"></i>
                                    {{ $mission->periode_debut->format('d/m/Y') }}
                                    <br>
                                    <small class="text-muted">
                                        <i class="bi bi-arrow-right me-1" style="font-size: 0.5rem;"></i>
                                        {{ $mission->periode_fin->format('d/m/Y') }}
                                    </small>
                                </td>

                                <td class="py-2 px-2">
                                    <span class="badge rounded-pill px-3 py-1"
                                          style="background-color:rgba(22,131,255,.12); color:#1683ff; font-weight: 500; font-size: 0.7rem;">
                                        {{ $mission->categorie }}
                                    </span>
                                </td>

                                <td class="py-2 px-2" style="font-size: 0.85rem;">
                                    {{ $mission->type_mission }}
                                </td>

                                <td class="py-2 px-2" style="font-size: 0.85rem;">
                                    <i class="bi bi-geo-alt text-secondary me-1" style="font-size: 0.65rem;"></i>
                                    {{ $mission->localites }}
                                </td>

                                <td class="text-center py-2 px-2">

                                    @if($mission->fiche_signee_par && $mission->compte_rendu)

                                        <span class="badge rounded-pill px-3 py-1"
                                              style="background-color:rgba(5,158,51,.12); color:#059e33; font-weight: 500;">
                                            <i class="bi bi-check-circle-fill me-1"></i>
                                            Complet
                                        </span>

                                    @else

                                        <span class="badge rounded-pill px-3 py-1"
                                              style="background-color:rgba(255,193,7,.12); color:#ffc107; font-weight: 500;">
                                            <i class="bi bi-clock me-1"></i>
                                            À renseigner
                                        </span>

                                    @endif

                                </td>

                                <td class="text-end py-2 px-2">

                                    <div class="d-flex justify-content-end gap-1">

                                        <!-- Voir -->
                                        <a href="{{ route('rapports.show', $mission) }}"
                                           class="btn btn-outline-primary btn-sm rounded-pill px-2"
                                           style="font-size: 0.7rem; font-weight: 500;"
                                           data-bs-toggle="tooltip"
                                           title="Voir le rapport">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <!-- Modifier -->
                                        @if(auth()->user()->role === 'dt')
                                            <a href="{{ route('rapports.edit', $mission) }}"
                                               class="btn btn-outline-warning btn-sm rounded-pill px-2"
                                               style="font-size: 0.7rem; font-weight: 500;"
                                               data-bs-toggle="tooltip"
                                               title="Modifier le rapport">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="text-center text-muted py-5">

                                    <div class="empty-state">

                                        <i class="bi bi-journal-x display-4 text-muted d-block mb-3" style="font-size: 3rem;"></i>

                                        <h5 class="mt-3 fw-bold">
                                            Aucun rapport disponible
                                        </h5>

                                        <p class="text-muted mb-0" style="font-size: 0.9rem;">
                                            Aucune mission terminée disponible pour le moment.
                                        </p>

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
                        Affichage de {{ $missions->firstItem() ?? 0 }} à {{ $missions->lastItem() ?? 0 }} sur {{ $missions->total() }} rapports
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