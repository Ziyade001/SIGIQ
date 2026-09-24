@extends('dashboards.index')

@section('content')

<main class="dashboard-content">

    <div class="container-fluid px-3 px-lg-4 py-4">

        <!-- PAGE HEADER -->
        <div class="page-heading d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">

            <div class="page-heading-copy d-flex align-items-center gap-3">

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
                                Inspections
                            </li>
                        </ol>
                    </nav>

                    <h1 class="h3 mb-1 fw-bold">
                        Inspections
                    </h1>

                    <p class="text-muted mb-0" style="font-size: 0.9rem;">
                        Gestion et suivi des inspections réalisées sur le terrain.
                    </p>

                </div>

            </div>

            <div class="heading-actions">

                <a href="{{ route('inspections.create') }}"
                   class="btn btn-primary btn-sm rounded-pill px-3"
                   style="font-weight: 500; background-color:#059e33; border-color:#059e33;">
                    <i class="bi bi-plus-circle me-1"></i>
                    Nouvelle inspection
                </a>

            </div>

        </div>

        <!-- RECHERCHE -->
        <form method="GET" action="{{ route('inspections.index') }}" class="mb-4">

    <div class="row g-2 align-items-end">

        <div class="col-md-5">

            <label class="form-label small fw-semibold">
                Recherche
            </label>

            <input type="text"
                   name="search"
                   class="form-control form-control-sm"
                   placeholder="Référence, établissement, IFU..."
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

            <a href="{{ route('inspections.index') }}"
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

        <!-- TABLEAU -->
        <div class="panel card border-0 shadow-sm rounded-4">

            <div class="panel-header card-header bg-transparent border-0 d-flex flex-wrap align-items-center justify-content-between gap-2 px-4 pt-4 pb-3">

                <div>

                    <h2 class="h5 mb-1 fw-bold d-flex align-items-center gap-2 section-title">
                        <i class="bi bi-table me-2"></i>
                        <span>Liste des inspections</span>
                    </h2>

                    <p class="text-muted mb-0" style="font-size: 0.85rem;">
                        {{ $inspections->total() }} inspection(s) trouvée(s)
                    </p>

                </div>

                <span class="badge rounded-pill px-3 py-2"
                      style="background-color:rgba(22,131,255,.12); color:#1683ff; font-weight: 600; font-size: 0.75rem;">
                    <i class="bi bi-clipboard-check me-1"></i>
                    {{ $inspections->total() }}
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
                                Date
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary"
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Mission
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary"
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Type
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary"
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Établissement
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary"
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Propriétaire
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary"
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Technicien
                            </th>
                            <th class="text-end text-uppercase small fw-semibold text-secondary"
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($inspections as $inspection)

                            <tr style="border-bottom: 1px solid #f1f3f5; transition: background 0.15s;"
                                onmouseover="this.style.background='#f8f9fc'"
                                onmouseout="this.style.background='transparent'">

                                <td class="fw-semibold py-2 px-2" style="font-size: 0.8rem;">
                                    <span class="badge bg-light text-dark rounded-pill px-3 py-1" style="font-weight: 600; font-size: 0.7rem;">
                                        {{ $inspection->reference }}
                                    </span>
                                </td>

                                <td class="py-2 px-2" style="font-size: 0.8rem;">
                                    <i class="bi bi-calendar3 text-secondary me-1" style="font-size: 0.65rem;"></i>
                                    {{ \Carbon\Carbon::parse($inspection->date)->format('d/m/Y') }}
                                </td>

                                <td class="py-2 px-2">
                                    @if($inspection->mission)
                                        <span class="badge rounded-pill px-3 py-1"
                                              style="background-color:rgba(22,131,255,.12); color:#1683ff; font-weight: 500; font-size: 0.7rem;">
                                            <i class="bi bi-briefcase me-1"></i>
                                            {{ $inspection->mission->reference }}
                                        </span>
                                    @else
                                        <span class="text-muted" style="font-size: 0.75rem;">
                                            <i class="bi bi-dash-circle me-1"></i>
                                            Non assignée
                                        </span>
                                    @endif
                                </td>

                                <td class="py-2 px-2">

                                    @if($inspection->type_inspection == 'preemballe')

                                        <span class="badge rounded-pill px-3 py-1"
                                              style="background-color:rgba(5,158,51,.12); color:#059e33; font-weight: 500;">
                                            <i class="bi bi-box me-1"></i>
                                            Préemballé
                                        </span>

                                    @elseif($inspection->type_inspection == 'pesage')

                                        <span class="badge rounded-pill px-3 py-1"
                                              style="background-color:rgba(255,193,7,.12); color:#ffc107; font-weight: 500;">
                                            <i class="bi bi-scale me-1"></i>
                                            Pesage
                                        </span>

                                    @else

                                        <span class="badge rounded-pill px-3 py-1"
                                              style="background-color:rgba(22,131,255,.12); color:#1683ff; font-weight: 500;">
                                            <i class="bi bi-droplet me-1"></i>
                                            Volume
                                        </span>

                                    @endif

                                </td>

                                <td class="py-2 px-2" style="font-size: 0.85rem;">
                                    <i class="bi bi-building text-secondary me-1" style="font-size: 0.65rem;"></i>
                                    {{ $inspection->etablissement }}
                                </td>

                                <td class="py-2 px-2" style="font-size: 0.85rem;">
                                    <i class="bi bi-person text-secondary me-1" style="font-size: 0.65rem;"></i>
                                    {{ $inspection->nom_proprietaire }}
                                </td>

                                <td class="py-2 px-2">
                                    @if($inspection->inspecteur)
                                        <span class="badge rounded-pill px-3 py-1"
                                              style="background-color:rgba(108,117,125,.12); color:#6c757d; font-weight: 500; font-size: 0.7rem;">
                                            <i class="bi bi-person-badge me-1"></i>
                                            {{ $inspection->inspecteur->name }}
                                        </span>
                                    @else
                                        <span class="text-muted" style="font-size: 0.75rem;">
                                            <i class="bi bi-dash-circle me-1"></i>
                                            Non assigné
                                        </span>
                                    @endif
                                </td>

                                <td class="text-end py-2 px-2">

                                    <div class="d-flex justify-content-end gap-1">

                                        <!-- Voir -->
                                        <a href="{{ route('inspections.show', $inspection) }}"
                                           class="btn btn-outline-primary btn-sm rounded-pill px-2"
                                           style="font-size: 0.7rem; font-weight: 500;"
                                           data-bs-toggle="tooltip"
                                           title="Voir les détails">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <!-- Modifier -->
                                        <a href="{{ route('inspections.edit', $inspection) }}"
                                           class="btn btn-outline-warning btn-sm rounded-pill px-2"
                                           style="font-size: 0.7rem; font-weight: 500;"
                                           data-bs-toggle="tooltip"
                                           title="Modifier">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <!-- Supprimer -->
                                        <form action="{{ route('inspections.destroy', $inspection) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette inspection ? Cette action est irréversible.')">

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

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="8" class="text-center text-muted py-5">

                                    <div class="empty-state">

                                        <i class="bi bi-clipboard-x display-4 text-muted d-block mb-3" style="font-size: 3rem;"></i>

                                        <h5 class="mt-3 fw-bold">
                                            Aucune inspection trouvée
                                        </h5>

                                        <p class="text-muted mb-3" style="font-size: 0.9rem;">
                                            {{ request()->anyFilled(['search']) ?
                                                'Aucune inspection ne correspond à vos critères de recherche.' :
                                                'Commencez par enregistrer votre première inspection.' }}
                                        </p>

                                        @if(request()->anyFilled(['search']))
                                            <a href="{{ route('inspections.index') }}"
                                               class="btn btn-outline-primary btn-sm rounded-pill px-3"
                                               style="font-weight: 500;">
                                                <i class="bi bi-arrow-counterclockwise me-1"></i>
                                                Réinitialiser les filtres
                                            </a>
                                        @else
                                            <a href="{{ route('inspections.create') }}"
                                               class="btn btn-primary btn-sm rounded-pill px-3"
                                               style="font-weight: 500; background-color:#059e33; border-color:#059e33;">
                                                <i class="bi bi-plus-circle me-1"></i>
                                                Nouvelle inspection
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
@if($inspections->hasPages())

<div class="d-flex flex-wrap align-items-center justify-content-between gap-2 p-3 border-top">

    <div class="text-muted small">
        Affichage de {{ $inspections->firstItem() ?? 0 }}
        à {{ $inspections->lastItem() ?? 0 }}
        sur {{ $inspections->total() }} inspections
    </div>

    <nav>
        {{ $inspections->appends(request()->query())->onEachSide(1)->links() }}
    </nav>

</div>

@endif

        </div>

    </div>

</main>

@endsection