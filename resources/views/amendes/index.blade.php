@extends('dashboards.index')

@section('content')

<main class="dashboard-content">

    <div class="container-fluid px-3 px-lg-4 py-4">

        <!-- PAGE HEADER -->
        <div class="page-heading d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">

            <div class="page-heading-copy d-flex align-items-center gap-3 section-title">

                <span class="page-icon">
                    <i class="bi bi-cash-stack" aria-hidden="true"></i>
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
                                Amendes
                            </li>
                        </ol>
                    </nav>

                    <h1 class="h3 mb-1 fw-bold">
                        Gestion des amendes
                    </h1>

                    <p class="text-muted mb-0" style="font-size: 0.9rem;">
                        Suivi des amendes issues des inspections
                    </p>

                </div>

            </div>

        </div>

        <!-- RECHERCHE -->
        <form method="GET"
      action="{{ route('amendes.index') }}"
      class="row g-3 align-items-end mb-4">

    {{-- Recherche --}}
    <div class="col-md-5">

        <label class="form-label fw-semibold">
            Recherche
        </label>

        <input type="text"
               name="search"
               class="form-control"
               placeholder="IFU ou établissement..."
               value="{{ request('search') }}">

    </div>

    {{-- Mois --}}
    <div class="col-md-2">

        <label class="form-label fw-semibold">
            Mois
        </label>

        <select name="mois" class="form-select">

            @foreach(range(1,12) as $m)

                <option value="{{ $m }}"
                    {{ $mois == $m ? 'selected' : '' }}>

                    {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}

                </option>

            @endforeach

        </select>

    </div>

    {{-- Année --}}
    <div class="col-md-2">

        <label class="form-label fw-semibold">
            Année
        </label>

        <select name="annee" class="form-select">

            @for($a = now()->year; $a >= now()->year-5; $a--)

                <option value="{{ $a }}"
                    {{ $annee == $a ? 'selected' : '' }}>

                    {{ $a }}

                </option>

            @endfor

        </select>

    </div>

    {{-- Boutons --}}
    <div class="col-md-3 d-flex gap-2">

        <button class="btn btn-primary w-100">

            <i class="bi bi-funnel"></i>

            Filtrer

        </button>

        <a href="{{ route('amendes.index') }}"
           class="btn btn-outline-secondary">

            <i class="bi bi-arrow-clockwise"></i>

        </a>

    </div>

</form>


<!-- STATISTIQUES -->
        <section class="row g-3 mb-4" aria-label="Statistiques des amendes">

            <div class="col-12 col-md-6">

                <article class="card border-0 shadow-sm rounded-4 h-100" style="border-top: 4px solid #dc3545;">

                    <div class="card-body p-3">

                        <div class="d-flex align-items-center gap-3 mb-2">

                            <span class="d-flex align-items-center justify-content-center rounded-circle"
                                  style="width: 48px; height: 48px; background: rgba(220,53,69,.12); color: #dc3545; flex-shrink: 0;">
                                <i class="bi bi-exclamation-triangle" style="font-size: 1.3rem;"></i>
                            </span>

                            <div>
                                <p class="text-muted mb-0" style="font-size: 0.75rem; letter-spacing: 0.03em; font-weight: 600;">
                                    Total amendes du mois
                                </p>
                                <h3 class="fw-bold text-danger mb-0">
                                    {{ number_format($totalMois, 0, ',', ' ') }}
                                    <small class="fs-6 text-muted fw-normal">FCFA</small>
                                </h3>
                            </div>

                        </div>

                        <div class="progress" style="height: 6px; border-radius: 10px; background: #e9ecef;">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 100%; border-radius: 10px;"></div>
                        </div>

                    </div>

                </article>

            </div>

            <div class="col-12 col-md-6">

                <article class="card border-0 shadow-sm rounded-4 h-100" style="border-top: 4px solid #059e33;">

                    <div class="card-body p-3">

                        <div class="d-flex align-items-center gap-3 mb-2">

                            <span class="d-flex align-items-center justify-content-center rounded-circle"
                                  style="width: 48px; height: 48px; background: rgba(5,158,51,.12); color: #059e33; flex-shrink: 0;">
                                <i class="bi bi-check-circle" style="font-size: 1.3rem;"></i>
                            </span>

                            <div>
                                <p class="text-muted mb-0" style="font-size: 0.75rem; letter-spacing: 0.03em; font-weight: 600;">
                                    Total payé ce mois
                                </p>
                                <h3 class="fw-bold text-success mb-0">
                                    {{ number_format($totalPayeMois, 0, ',', ' ') }}
                                    <small class="fs-6 text-muted fw-normal">FCFA</small>
                                </h3>
                            </div>

                        </div>

                        @php
                            $pourcentage = ($totalMois > 0) ? ($totalPayeMois / $totalMois) * 100 : 0;
                        @endphp

                        <div class="progress" style="height: 6px; border-radius: 10px; background: #e9ecef;">
                            <div class="progress-bar bg-success" role="progressbar"
                                 style="width: {{ min($pourcentage, 100) }}%; border-radius: 10px; transition: width 0.6s ease;"></div>
                        </div>

                        <small class="text-muted mt-2 d-block" style="font-size: 0.75rem;">
                            Taux de recouvrement :
                            <span class="fw-semibold
                                @if($pourcentage >= 80) text-success
                                @elseif($pourcentage >= 50) text-warning
                                @else text-danger @endif">
                                {{ number_format($pourcentage, 1) }}%
                            </span>
                        </small>

                    </div>

                </article>

            </div>

        </section>

        <!-- TABLEAU DES AMENDES PAR ÉTABLISSEMENT -->
        <div class="panel card border-0 shadow-sm rounded-4">

            <div class="panel-header card-header bg-transparent border-0 d-flex flex-wrap align-items-center justify-content-between gap-2 px-4 pt-4 pb-3">

                <div>

                    <h2 class="h5 mb-1 fw-bold d-flex align-items-center gap-2 section-title">
                        <i class="bi bi-list-ul me-2"></i>
                        <span>Liste des amendes par établissement</span>
                    </h2>

                    <p class="text-muted mb-0" style="font-size: 0.85rem;">
                        {{ $amendes->total() }} établissement(s) trouvé(s)
                    </p>

                </div>

                <span class="badge rounded-pill px-3 py-2"
                      style="background-color:rgba(220,53,69,.12); color:#dc3545; font-weight: 600; font-size: 0.75rem;">
                    <i class="bi bi-cash-stack me-1"></i>
                    {{ number_format($amendes->sum('total_amendes'), 0, ',', ' ') }} FCFA
                </span>

            </div>

            <div class="table-responsive px-1">

                <table class="table align-middle mb-0" style="font-size: 0.9rem;">

                    <thead style="background: #f8f9fc; border-bottom: 2px solid #e9ecef;">
                        <tr>
                            <th class="text-uppercase small fw-semibold text-secondary ps-4"
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                <i class="bi bi-building me-1"></i>
                                Établissement
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary text-center"
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                <i class="bi bi-hash me-1"></i>
                                Nb amendes
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary text-end"
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                <i class="bi bi-cash me-1"></i>
                                Total
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary text-end"
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                <i class="bi bi-check-lg me-1"></i>
                                Payé
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary text-end"
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                <i class="bi bi-exclamation-lg me-1"></i>
                                Impayé
                            </th>
                            <th class="text-end text-uppercase small fw-semibold text-secondary"
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                <i class="bi bi-gear me-1"></i>
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($amendes as $amende)

                            <tr style="border-bottom: 1px solid #f1f3f5; transition: background 0.15s;"
                                onmouseover="this.style.background='#f8f9fc'"
                                onmouseout="this.style.background='transparent'">

                                <td class="ps-4 py-2 px-2">
                                    <div class="d-flex align-items-center gap-2">

                                        <span class="d-flex align-items-center justify-content-center rounded-circle"
                                              style="width: 32px; height: 32px; background: rgba(22,131,255,.12); color: #1683ff; flex-shrink: 0;">
                                            <i class="bi bi-building" style="font-size: 0.8rem;"></i>
                                        </span>

                                        <span class="fw-semibold" style="font-size: 0.9rem;">
                                            {{ $amende->etablissement }}
                                        </span>

                                    </div>
                                </td>

                                <td class="text-center py-2 px-2">
                                    <span class="badge rounded-pill px-3 py-1"
                                          style="background-color:rgba(108,117,125,.12); color:#6c757d; font-weight: 500; font-size: 0.75rem;">
                                        {{ $amende->nombre_amendes }}
                                    </span>
                                </td>

                                <td class="fw-bold text-danger text-end py-2 px-2" style="font-size: 0.95rem;">
                                    {{ number_format($amende->total_amendes, 0, ',', ' ') }}
                                </td>

                                <td class="text-success fw-semibold text-end py-2 px-2" style="font-size: 0.95rem;">
                                    <i class="bi bi-arrow-up-circle-fill me-1" style="font-size: 0.6rem;"></i>
                                    {{ number_format($amende->total_paye, 0, ',', ' ') }}
                                </td>

                                <td class="text-warning fw-semibold text-end py-2 px-2" style="font-size: 0.95rem;">
                                    <i class="bi bi-arrow-down-circle-fill me-1" style="font-size: 0.6rem;"></i>
                                    {{ number_format($amende->total_impaye, 0, ',', ' ') }}
                                </td>

                                <td class="text-end py-2 px-2">

                                    <a href="{{ route('amendes.show', ['ifu' => $amende->ifu]) }}"
                                       class="btn btn-outline-primary btn-sm rounded-pill px-3"
                                       style="font-size: 0.75rem; font-weight: 500;"
                                       data-bs-toggle="tooltip"
                                       title="Voir les détails">
                                        <i class="bi bi-eye me-1"></i>
                                        Détails
                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="text-center text-muted py-5">

                                    <div class="empty-state">

                                        <i class="bi bi-inbox display-4 text-muted d-block mb-3" style="font-size: 3rem;"></i>

                                        <h5 class="mt-3 fw-bold">
                                            Aucune amende trouvée
                                        </h5>

                                        <p class="text-muted mb-0" style="font-size: 0.9rem;">
                                            Aucune amende enregistrée pour le moment.
                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <!-- Pagination -->
            @if($amendes->hasPages())

                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 p-3 border-top">

                    <div class="text-muted small" style="font-size: 0.8rem;">
                        Affichage de {{ $amendes->firstItem() ?? 0 }} à {{ $amendes->lastItem() ?? 0 }} sur {{ $amendes->total() }} résultats
                    </div>

                    <div>
                        {{ $amendes->appends(request()->query())->links() }}
                    </div>

                </div>

            @endif

        </div>

    </div>

</main>

@endsection