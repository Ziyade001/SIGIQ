@extends('dashboards.index')

@section('content')

<main class="dashboard-content">

    <div class="container-fluid px-3 px-lg-4 py-4">

        <!-- PAGE HEADER -->
        <div class="page-heading d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">

            <div class="page-heading-copy d-flex align-items-center gap-3 section-title">

                <span class="page-icon">
                    <i class="bi bi-envelope-paper" aria-hidden="true"></i>
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
                                Convocations
                            </li>
                        </ol>
                    </nav>

                    <h1 class="h3 mb-1 fw-bold">
                        Gestion des convocations
                    </h1>

                    <p class="text-muted mb-0" style="font-size: 0.9rem;">
                        Liste des convocations générées suite aux inspections.
                    </p>

                </div>

            </div>

        </div>

        <!-- RECHERCHE -->
        <form method="GET" action="{{ route('convocations.index') }}" class="mb-4">

    <div class="row g-2 align-items-end">

        <div class="col-md-5">

            <label class="form-label small fw-semibold">
                Recherche
            </label>

            <input type="text"
                   name="search"
                   class="form-control form-control-sm"
                   placeholder="Référence, inspection ou technicien..."
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

            <a href="{{ route('convocations.index') }}"
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

        <!-- TABLEAU DES CONVOCATIONS -->
        <div class="panel card border-0 shadow-sm rounded-4">

            <div class="panel-header card-header bg-transparent border-0 d-flex flex-wrap align-items-center justify-content-between gap-2 px-4 pt-4 pb-3">

                <div>

                    <h2 class="h5 mb-1 fw-bold d-flex align-items-center gap-2 section-title">
                        <i class="bi bi-list-ul me-2"></i>
                        <span>Liste des convocations</span>
                    </h2>

                    <p class="text-muted mb-0" style="font-size: 0.85rem;">
                        {{ $convocations->total() }} convocation(s) trouvée(s)
                    </p>

                </div>

                <span class="badge rounded-pill px-3 py-2"
                      style="background-color:rgba(22,131,255,.12); color:#1683ff; font-weight: 600; font-size: 0.75rem;">
                    <i class="bi bi-envelope-paper me-1"></i>
                    {{ $convocations->total() }}
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
                                Inspection
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary"
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Établissement
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary"
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Date & Heure
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

                        @forelse($convocations as $convocation)

                            <tr style="border-bottom: 1px solid #f1f3f5; transition: background 0.15s;"
                                onmouseover="this.style.background='#f8f9fc'"
                                onmouseout="this.style.background='transparent'">

                                <td class="py-2 px-2">
                                    <span class="fw-semibold" style="color:#1683ff; font-size: 0.85rem;">
                                        {{ $convocation->reference }}
                                    </span>
                                </td>

                                <td class="py-2 px-2">
                                    <span class="badge rounded-pill px-3 py-1"
                                          style="background-color:rgba(108,117,125,.12); color:#6c757d; font-weight: 500; font-size: 0.7rem;">
                                        {{ $convocation->inspection->reference }}
                                    </span>
                                </td>

                                <td class="py-2 px-2" style="font-size: 0.85rem;">
                                    <i class="bi bi-building text-secondary me-1" style="font-size: 0.65rem;"></i>
                                    {{ $convocation->inspection->etablissement }}
                                </td>

                                <td class="py-2 px-2" style="font-size: 0.85rem;">
                                    <i class="bi bi-calendar3 text-secondary me-1" style="font-size: 0.65rem;"></i>
                                    {{ \Carbon\Carbon::parse($convocation->date_convocation)->format('d/m/Y') }}
                                    <br>
                                    <small class="text-muted">
                                        <i class="bi bi-clock me-1" style="font-size: 0.5rem;"></i>
                                        {{ $convocation->heure_convocation }}
                                    </small>
                                </td>

                                <td class="py-2 px-2">
                                    <span class="badge rounded-pill px-3 py-1"
                                          style="background-color:rgba(22,131,255,.12); color:#1683ff; font-weight: 500; font-size: 0.7rem;">
                                        <i class="bi bi-person-badge me-1"></i>
                                        {{ $convocation->inspection->inspecteur->name ?? 'Non assigné' }}
                                    </span>
                                </td>

                                <td class="text-end py-2 px-2">

                                    <div class="d-flex justify-content-end gap-1">

                                        <!-- Voir -->
                                        <a href="{{ route('convocations.show', $convocation) }}"
                                           class="btn btn-outline-info btn-sm rounded-pill px-2"
                                           style="font-size: 0.7rem; font-weight: 500;"
                                           data-bs-toggle="tooltip"
                                           title="Voir la convocation">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <!-- Modifier -->
                                        <a href="{{ route('convocations.edit', $convocation) }}"
                                           class="btn btn-outline-warning btn-sm rounded-pill px-2"
                                           style="font-size: 0.7rem; font-weight: 500;"
                                           data-bs-toggle="tooltip"
                                           title="Modifier la convocation">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="text-center text-muted py-5">

                                    <div class="empty-state">

                                        <i class="bi bi-envelope-paper display-4 text-muted d-block mb-3" style="font-size: 3rem;"></i>

                                        <h5 class="mt-3 fw-bold">
                                            Aucune convocation trouvée
                                        </h5>

                                        <p class="text-muted mb-0" style="font-size: 0.9rem;">
                                            Aucune convocation disponible pour le moment.
                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <!-- Pagination -->
            @if($convocations->hasPages())

                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 p-3 border-top">

                    <div class="text-muted small" style="font-size: 0.8rem;">
                        Affichage de {{ $convocations->firstItem() ?? 0 }} à {{ $convocations->lastItem() ?? 0 }} sur {{ $convocations->total() }} convocations
                    </div>

                    <div>
                        {{ $convocations->appends(request()->query())->links() }}
                    </div>

                </div>

            @endif

        </div>

    </div>

</main>

@endsection