@if($inspection->type_inspection == 'pesage' && $inspection->pesage)

<div class="panel card border-0 shadow-sm rounded-4 mb-4">

    {{-- EN-TÊTE --}}
    <div class="card-header bg-transparent border-0 d-flex flex-wrap align-items-center justify-content-between gap-2 px-4 pt-4 pb-3">

        <div class="d-flex align-items-center gap-2">

            <span class="d-flex align-items-center justify-content-center rounded-circle section-title">
                <i class="bi bi-speedometer2 me-2"></i>
            </span>

            <h2 class="h5 mb-0 fw-bold section-title">
                <span class="text-primary">Instrument de pesage</span> — Détails
            </h2>

        </div>

        <a href="{{ route('inspections.pesages.edit', $inspection) }}"
           class="btn btn-outline-warning btn-sm rounded-pill px-3"
           style="font-weight: 500;">
            <i class="bi bi-pencil me-1"></i>
            Modifier
        </a>

    </div>

    <div class="card-body px-4 pt-0 pb-4">

        <div class="row g-3">

            {{-- Instrument --}}
            <div class="col-12 col-md-6">
                <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                    Instrument
                </label>
                <span class="fw-semibold" style="font-size:0.95rem;">
                    {{ $inspection->pesage->instrument ?? '—' }}
                </span>
            </div>

            {{-- Marque --}}
            <div class="col-12 col-md-6">
                <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                    Marque
                </label>
                <span style="font-size:0.95rem;">
                    {{ $inspection->pesage->marque ?? '—' }}
                </span>
            </div>

            {{-- N° série --}}
            <div class="col-12 col-md-6">
                <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                    N° de série
                </label>
                <span class="font-monospace" style="font-size:0.95rem;">
                    {{ $inspection->pesage->numero_serie ?? '—' }}
                </span>
            </div>

            {{-- Portée max --}}
            <div class="col-6 col-md-3">
                <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                    Portée max
                </label>
                <span style="font-size:0.95rem;">
                    {{ $inspection->pesage->portee_max ?? '—' }}
                </span>
            </div>

            {{-- Portée min --}}
            <div class="col-6 col-md-3">
                <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                    Portée min
                </label>
                <span style="font-size:0.95rem;">
                    {{ $inspection->pesage->portee_min ?? '—' }}
                </span>
            </div>

            {{-- Échelon vérification --}}
            <div class="col-12 col-md-6">
                <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                    Échelon de vérification
                </label>
                <span style="font-size:0.95rem;">
                    {{ $inspection->pesage->echelon_verification ?? '—' }}
                </span>
            </div>

            {{-- Échelon affichage --}}
            <div class="col-12 col-md-6">
                <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                    Échelon d'affichage
                </label>
                <span style="font-size:0.95rem;">
                    {{ $inspection->pesage->echelon_affichage ?? '—' }}
                </span>
            </div>

            {{-- Année fabrication --}}
            <div class="col-12 col-md-6">
                <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                    Année de fabrication
                </label>
                <span style="font-size:0.95rem;">
                    {{ $inspection->pesage->annee_fabrication ?? '—' }}
                </span>
            </div>

            {{-- Approbation modèle --}}
            <div class="col-12 col-md-6">
                <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                    Approbation modèle
                </label>
                <span class="font-monospace" style="font-size:0.95rem;">
                    {{ $inspection->pesage->numero_approbation_modele ?? '—' }}
                </span>
            </div>

            {{-- Infractions constatées --}}
            <div class="col-12">
                <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                    Infractions constatées
                </label>

                @if($inspection->pesage->infractions_constatees)

                    <div class="p-3 rounded-3 d-flex align-items-start gap-3"
                         style="background: #fff8e1; border-left: 4px solid #ffc107;">

                        <i class="bi bi-exclamation-triangle-fill text-warning mt-1" style="font-size: 1.2rem;"></i>

                        <span style="font-size:0.95rem; line-height:1.6;">
                            {{ $inspection->pesage->infractions_constatees }}
                        </span>

                    </div>

                @else

                    <div class="p-3 rounded-3 d-flex align-items-center gap-2"
                         style="background: #f8f9fc; border-left: 4px solid #059e33;">

                        <i class="bi bi-check-circle-fill text-success" style="font-size: 1rem;"></i>

                        <span class="text-muted" style="font-size:0.95rem;">
                            Aucune infraction constatée
                        </span>

                    </div>

                @endif

            </div>

        </div>

    </div>

</div>

@endif