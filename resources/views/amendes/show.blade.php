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

                    <h1 class="h3 mb-1 fw-bold d-flex align-items-center gap-2">
                        {{ $etablissement }}
                        <span class="badge rounded-pill px-3 py-2"
                              style="background-color:rgba(220,53,69,.12); color:#dc3545; font-size: 0.7rem; font-weight: 600;">
                            Amendes
                        </span>
                    </h1>

                    <p class="text-muted mb-0" style="font-size: 0.9rem;">
                        Détail des amendes de l'établissement
                    </p>

                </div>

            </div>

            <div class="heading-actions">

                <a href="{{ route('inspections.index') }}"
                   class="btn btn-outline-secondary btn-sm rounded-pill px-3"
                   style="font-weight: 500;">
                    <i class="bi bi-arrow-left me-1"></i>
                    Retour
                </a>

            </div>

        </div>

        <!-- RÉSUMÉ DES AMENDES -->
        @php
            $totalAmendes = $amendes->sum('montant_total');
            $totalPaye = $amendes->sum('montant_paye');
            $totalImpaye = $amendes->sum('montant_impaye');
            $nombreAmendes = $amendes->count();
            $tauxRecouvrement = $totalAmendes > 0 ? round(($totalPaye / $totalAmendes) * 100) : 0;
        @endphp

        <div class="row g-3 mb-4">

            <div class="col-6 col-md-3">

                <div class="card border-0 shadow-sm rounded-4 text-center p-3" style="border-top: 4px solid #1683ff;">

                    <small class="text-muted text-uppercase fw-semibold" style="font-size: 0.65rem; letter-spacing: 0.03em;">
                        Nombre d'amendes
                    </small>

                    <h3 class="fw-bold mb-0 mt-1" style="color: #1683ff;">
                        {{ $nombreAmendes }}
                    </h3>

                </div>

            </div>

            <div class="col-6 col-md-3">

                <div class="card border-0 shadow-sm rounded-4 text-center p-3" style="border-top: 4px solid #dc3545;">

                    <small class="text-muted text-uppercase fw-semibold" style="font-size: 0.65rem; letter-spacing: 0.03em;">
                        Montant total
                    </small>

                    <h3 class="fw-bold mb-0 mt-1" style="color: #dc3545;">
                        {{ number_format($totalAmendes, 0, ',', ' ') }}
                    </h3>

                </div>

            </div>

            <div class="col-6 col-md-3">

                <div class="card border-0 shadow-sm rounded-4 text-center p-3" style="border-top: 4px solid #059e33;">

                    <small class="text-muted text-uppercase fw-semibold" style="font-size: 0.65rem; letter-spacing: 0.03em;">
                        Montant recouvré
                    </small>

                    <h3 class="fw-bold mb-0 mt-1" style="color: #059e33;">
                        {{ number_format($totalPaye, 0, ',', ' ') }}
                    </h3>

                </div>

            </div>

            <div class="col-6 col-md-3">

                <div class="card border-0 shadow-sm rounded-4 text-center p-3" style="border-top: 4px solid #ffc107;">

                    <small class="text-muted text-uppercase fw-semibold" style="font-size: 0.65rem; letter-spacing: 0.03em;">
                        Taux de recouvrement
                    </small>

                    <h3 class="fw-bold mb-0 mt-1" style="color: #ffc107;">
                        {{ $tauxRecouvrement }}%
                    </h3>

                </div>

            </div>

        </div>

        <!-- TABLEAU DES AMENDES -->
        <div class="panel card border-0 shadow-sm rounded-4">

            <div class="panel-header card-header bg-transparent border-0 d-flex flex-wrap align-items-center justify-content-between gap-2 px-4 pt-4 pb-3">

                <div>

                    <h2 class="h5 mb-1 fw-bold d-flex align-items-center gap-2 section-title">
                        <i class="bi bi-table me-2"></i>
                        <span>Liste des amendes</span>
                    </h2>

                </div>

                <span class="badge rounded-pill px-3 py-2"
                      style="background-color:rgba(220,53,69,.12); color:#dc3545; font-weight: 600; font-size: 0.75rem;">
                    <i class="bi bi-cash-stack me-1"></i>
                    {{ number_format($totalAmendes, 0, ',', ' ') }} FCFA
                </span>

            </div>

            <div class="table-responsive px-1">

                <table class="table align-middle mb-0" style="font-size: 0.9rem;">

                    <thead style="background: #f8f9fc; border-bottom: 2px solid #e9ecef;">
                        <tr>
                            <th class="text-uppercase small fw-semibold text-secondary"
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Inspection
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary text-end"
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Montant total
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary text-end"
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Payé
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary text-end"
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Impayé
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary"
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Date
                            </th>
                            <th class="text-end text-uppercase small fw-semibold text-secondary"
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Action
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($amendes as $amende)

                            <tr style="border-bottom: 1px solid #f1f3f5; transition: background 0.15s;"
                                onmouseover="this.style.background='#f8f9fc'"
                                onmouseout="this.style.background='transparent'">

                                <td class="py-2 px-2">
                                    @if($amende->reference_inspection)
                                        <span class="badge rounded-pill px-3 py-1"
                                              style="background-color:rgba(22,131,255,.12); color:#1683ff; font-weight: 500; font-size: 0.7rem;">
                                            {{ $amende->reference_inspection }}
                                        </span>
                                    @else
                                        <span class="text-muted" style="font-size: 0.8rem;">-</span>
                                    @endif
                                </td>

                                <td class="fw-bold text-danger text-end py-2 px-2" style="font-size: 0.95rem;">
                                    {{ number_format($amende->montant_total, 0, ',', ' ') }}
                                </td>

                                <td class="fw-semibold text-success text-end py-2 px-2" style="font-size: 0.95rem;">
                                    {{ number_format($amende->montant_paye, 0, ',', ' ') }}
                                </td>

                                <td class="fw-semibold text-warning text-end py-2 px-2" style="font-size: 0.95rem;">
                                    {{ number_format($amende->montant_impaye, 0, ',', ' ') }}
                                </td>

                                <td class="py-2 px-2" style="font-size: 0.85rem;">
                                    <i class="bi bi-calendar3 text-secondary me-1" style="font-size: 0.65rem;"></i>
                                    {{ $amende->created_at->format('d/m/Y') }}
                                </td>

                                <td class="text-end py-2 px-2">

                                    <a href="{{ route('amendes.edit', $amende->id) }}"
                                       class="btn btn-outline-warning btn-sm rounded-pill px-2"
                                       style="font-size: 0.7rem; font-weight: 500;"
                                       data-bs-toggle="tooltip"
                                       title="Modifier">
                                        <i class="bi bi-pencil"></i>
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
                                            Aucune amende n'a été enregistrée pour cet établissement.
                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</main>

@endsection