@if($inspection->type_inspection == 'volume' && $inspection->volume)

<div class="panel card border-0 shadow-sm rounded-4 mb-4">

    {{-- EN-TÊTE --}}
    <div class="card-header bg-transparent border-0 d-flex flex-wrap align-items-center justify-content-between gap-2 px-4 pt-4 pb-3">

        <div class="d-flex align-items-center gap-2">

            <span class="d-flex align-items-center justify-content-center rounded-circle"
                  style="width: 36px; height: 36px; background:rgba(22,131,255,.12); color:#1683ff; flex-shrink:0;">
                <i class="bi bi-droplet-half" style="font-size: 1.1rem;"></i>
            </span>

            <h2 class="h5 mb-0 fw-bold section-title">
                <span style="color:#1683ff;">Volume</span> — Détails
            </h2>

        </div>

        <a href="{{ route('inspections.volumes.edit', $inspection) }}"
           class="btn btn-outline-warning btn-sm rounded-pill px-3"
           style="font-weight: 500;">
            <i class="bi bi-pencil me-1"></i>
            Modifier
        </a>

    </div>

    <div class="card-body px-4 pt-0 pb-4">

        {{-- IDENTIFICATION DU DISTRIBUTEUR --}}
        <div class="mb-4">

            <h6 class="text-muted text-uppercase fw-semibold mb-3 section-title"
                style="font-size:0.7rem; letter-spacing:0.04em;">
                <i class="bi bi-info-circle me-1"></i>
                Identification du distributeur
            </h6>

            <div class="row g-3">

                <div class="col-12 col-md-6">
                    <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                        Nom commercial
                    </label>
                    <span class="fw-semibold" style="font-size:0.95rem;">
                        {{ $inspection->volume->nom_commercial ?? '—' }}
                    </span>
                </div>

                <div class="col-12 col-md-6">
                    <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                        Identification distributeur
                    </label>
                    <span class="fw-semibold" style="font-size:0.95rem;">
                        {{ $inspection->volume->identification_distributeur ?? '—' }}
                    </span>
                </div>

                <div class="col-12 col-md-4">
                    <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                        Produit
                    </label>
                    <span class="fw-semibold" style="font-size:0.95rem;">
                        {{ $inspection->volume->produit ?? '—' }}
                    </span>
                </div>

                <div class="col-12 col-md-4">
                    <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                        Prix unitaire affiché
                    </label>
                    <span style="font-size:0.95rem;">
                        {{ $inspection->volume->prix_unitaire_affiche ?? '—' }}
                    </span>
                </div>

                <div class="col-12 col-md-4">
                    <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                        Retour cuve
                    </label>
                    <span style="font-size:0.95rem;">
                        {{ $inspection->volume->retour_cuve ?? '—' }}
                    </span>
                </div>

                <div class="col-12 col-md-6">
                    <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                        Lecture totalisateur début
                    </label>
                    <span style="font-size:0.95rem;">
                        {{ $inspection->volume->lecture_totalisateur_debut ?? '—' }}
                    </span>
                </div>

                <div class="col-12 col-md-6">
                    <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                        Lecture totalisateur fin
                    </label>
                    <span style="font-size:0.95rem;">
                        {{ $inspection->volume->lecture_totalisateur_fin ?? '—' }}
                    </span>
                </div>

            </div>

        </div>

        <hr class="my-4" style="border-color: #f1f3f5;">

        {{-- IDENTIFICATION MÉTROLOGIQUE --}}
        <div class="mb-4">

            <h6 class="text-muted text-uppercase fw-semibold mb-3 section-title"
                style="font-size:0.7rem; letter-spacing:0.04em;">
                <i class="bi bi-speedometer2 me-1"></i>
                Identification métrologique
            </h6>

            <div class="row g-3">

                <div class="col-12 col-md-6">
                    <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                        Marque cabine
                    </label>
                    <span style="font-size:0.95rem;">
                        {{ $inspection->volume->marque_cabine ?? '—' }}
                    </span>
                </div>

                <div class="col-12 col-md-6">
                    <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                        N° série cabine
                    </label>
                    <span style="font-size:0.95rem;">
                        {{ $inspection->volume->numero_serie_cabine ?? '—' }}
                    </span>
                </div>

                <div class="col-12 col-md-6">
                    <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                        Marque mesureur
                    </label>
                    <span style="font-size:0.95rem;">
                        {{ $inspection->volume->marque_mesureur ?? '—' }}
                    </span>
                </div>

                <div class="col-12 col-md-6">
                    <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                        N° série mesureur
                    </label>
                    <span style="font-size:0.95rem;">
                        {{ $inspection->volume->numero_serie_mesureur ?? '—' }}
                    </span>
                </div>

                <div class="col-12 col-md-6">
                    <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                        Numéro vignette
                    </label>
                    <span style="font-size:0.95rem;">
                        {{ $inspection->volume->numero_vignette ?? '—' }}
                    </span>
                </div>

                <div class="col-12 col-md-6">
                    <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                        Numéro scellé
                    </label>
                    <span style="font-size:0.95rem;">
                        {{ $inspection->volume->numero_scelle ?? '—' }}
                    </span>
                </div>

            </div>

        </div>

        <hr class="my-4" style="border-color: #f1f3f5;">

        {{-- VÉRIFICATIONS FONCTIONNELLES --}}
        <div class="mb-4">

            <h6 class="text-muted text-uppercase fw-semibold mb-3 section-title"
                style="font-size:0.7rem; letter-spacing:0.04em;">
                <i class="bi bi-check2-square me-1"></i>
                Vérifications fonctionnelles
            </h6>

            @php
                $checks = [
                    'verification_dispositifs_indicateurs' => 'Dispositifs indicateurs',
                    'mise_a_zero' => 'Mise à zéro',
                    'calcul_prix' => 'Calcul du prix',
                    'coupure_flexible_pistolet' => 'Coupure flexible pistolet',
                ];
            @endphp

            <div class="row g-3">

                @foreach($checks as $field => $label)

                    <div class="col-12 col-md-6">

                        <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                            {{ $label }}
                        </label>

                        @if($inspection->volume->$field)
                            <span class="badge rounded-pill px-3 py-1"
                                  style="background-color:rgba(5,158,51,.12); color:#059e33; font-weight:500;">
                                <i class="bi bi-check-circle-fill me-1" style="font-size:0.6rem;"></i>
                                Oui
                            </span>
                        @else
                            <span class="badge rounded-pill px-3 py-1"
                                  style="background-color:rgba(220,53,69,.12); color:#dc3545; font-weight:500;">
                                <i class="bi bi-x-circle-fill me-1" style="font-size:0.6rem;"></i>
                                Non
                            </span>
                        @endif

                    </div>

                @endforeach

                <div class="col-12">

                    <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                        Conformité globale
                    </label>

                    @if($inspection->volume->conformite)
                        <span class="badge rounded-pill px-4 py-2"
                              style="background-color:rgba(5,158,51,.12); color:#059e33; font-weight:600; font-size:0.85rem;">
                            <i class="bi bi-check-circle-fill me-1"></i>
                            Conforme
                        </span>
                    @else
                        <span class="badge rounded-pill px-4 py-2"
                              style="background-color:rgba(220,53,69,.12); color:#dc3545; font-weight:600; font-size:0.85rem;">
                            <i class="bi bi-x-circle-fill me-1"></i>
                            Non conforme
                        </span>
                    @endif

                </div>

            </div>

        </div>

        <hr class="my-4" style="border-color: #f1f3f5;">

        {{-- ESSAIS VOLUMÉTRIQUES --}}
        <div class="mb-4">

            <h6 class="text-muted text-uppercase fw-semibold mb-3 section-title"
                style="font-size:0.7rem; letter-spacing:0.04em;">
                <i class="bi bi-beaker me-1"></i>
                Essais volumétriques
            </h6>

            <div class="table-responsive">

                <table class="table align-middle mb-0" style="font-size:0.85rem;">

                    <thead style="background: #f8f9fc; border-bottom: 2px solid #e9ecef;">
                        <tr>
                            <th class="text-uppercase small fw-semibold text-secondary"
                                style="letter-spacing:0.04em; font-size:0.6rem; padding:0.5rem;">
                                Essai
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary"
                                style="letter-spacing:0.04em; font-size:0.6rem; padding:0.5rem;">
                                Volume nominal
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary"
                                style="letter-spacing:0.04em; font-size:0.6rem; padding:0.5rem;">
                                VDR
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary"
                                style="letter-spacing:0.04em; font-size:0.6rem; padding:0.5rem;">
                                VREF
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary"
                                style="letter-spacing:0.04em; font-size:0.6rem; padding:0.5rem;">
                                EDR
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary"
                                style="letter-spacing:0.04em; font-size:0.6rem; padding:0.5rem;">
                                EMT
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($inspection->volume->essais as $essai)

                            <tr style="border-bottom: 1px solid #f1f3f5;">

                                <td class="py-2 px-2 text-center fw-semibold" style="font-size:0.85rem;">
                                    {{ $essai->numero_essai }}
                                </td>

                                <td class="py-2 px-2">
                                    {{ $essai->volume_nominal ?? '—' }}
                                </td>

                                <td class="py-2 px-2">
                                    {{ $essai->vdr ?? '—' }}
                                </td>

                                <td class="py-2 px-2">
                                    {{ $essai->vref ?? '—' }}
                                </td>

                                <td class="py-2 px-2">
                                    {{ $essai->edr ?? '—' }}
                                </td>

                                <td class="py-2 px-2">
                                    {{ $essai->emt ?? '—' }}
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox d-block mb-2" style="font-size:1.5rem;"></i>
                                    Aucun essai enregistré
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <hr class="my-4" style="border-color: #f1f3f5;">

        {{-- SIGNATAIRES --}}
        <div>

            <h6 class="text-muted text-uppercase fw-semibold mb-3"
                style="font-size:0.7rem; letter-spacing:0.04em;">
                <i class="bi bi-pen me-1" style="color:#ffc107;"></i>
                Signataires
            </h6>

            <div class="row g-3">

                <div class="col-12 col-md-6">
                    <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                        Représentant utilisateur
                    </label>
                    <span style="font-size:0.95rem;">
                        {{ $inspection->volume->representant_utilisateur ?? '—' }}
                    </span>
                </div>

                <div class="col-12 col-md-6">
                    <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                        Technicien réparateur
                    </label>
                    <span style="font-size:0.95rem;">
                        {{ $inspection->volume->technicien_reparateur ?? '—' }}
                    </span>
                </div>

            </div>

        </div>

    </div>

</div>

@endif