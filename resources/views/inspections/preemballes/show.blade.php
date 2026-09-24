@if($inspection->type_inspection == 'preemballe' && $inspection->preemballe)

<div class="panel card border-0 shadow-sm rounded-4 mb-4">

    {{-- EN-TÊTE --}}
    <div class="card-header bg-transparent border-0 d-flex flex-wrap align-items-center justify-content-between gap-2 px-4 pt-4 pb-3">

        <div class="d-flex align-items-center gap-2">

            <span class="d-flex align-items-center justify-content-center rounded-circle"
                  style="width: 36px; height: 36px; background:rgba(5,158,51,.12); color:#059e33; flex-shrink:0;">
                <i class="bi bi-box-seam" style="font-size: 1.1rem;"></i>
            </span>

            <h2 class="h5 mb-0 fw-bold section-title">
                <span style="color:#059e33;">Préemballés</span> — Détails
            </h2>

        </div>

        <a href="{{ route('inspections.preemballes.edit', $inspection) }}"
           class="btn btn-outline-warning btn-sm rounded-pill px-3"
           style="font-weight: 500;">
            <i class="bi bi-pencil me-1"></i>
            Modifier
        </a>

    </div>

    <div class="card-body px-4 pt-0 pb-4">

        {{-- INFORMATIONS GÉNÉRALES --}}
        <div class="mb-4">

            <h6 class="text-muted text-uppercase fw-semibold mb-3"
                style="font-size:0.7rem; letter-spacing:0.04em;">
                <i class="bi bi-info-circle me-1" style="color:#1683ff;"></i>
                Informations générales
            </h6>

            <div class="row g-3">

                <div class="col-12 col-md-6">
                    <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                        Produit
                    </label>
                    <span class="fw-semibold" style="font-size:0.95rem;">
                        {{ $inspection->preemballe->produit ?? '—' }}
                    </span>
                </div>

                <div class="col-12 col-md-6">
                    <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                        Marque
                    </label>
                    <span style="font-size:0.95rem;">
                        {{ $inspection->preemballe->marque ?? '—' }}
                    </span>
                </div>

                <div class="col-12 col-md-4">
                    <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                        Quantité nominale
                    </label>
                    <span class="fw-semibold" style="font-size:0.95rem;">
                        {{ $inspection->preemballe->quantite_nominale ?? '—' }}
                    </span>
                </div>

                <div class="col-12 col-md-4">
                    <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                        Effectif du lot
                    </label>
                    <span class="fw-semibold" style="font-size:0.95rem;">
                        {{ $inspection->preemballe->effectif_lot ?? '—' }}
                    </span>
                </div>

                <div class="col-12 col-md-4">
                    <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                        Effectif échantillon
                    </label>
                    <span class="fw-semibold" style="font-size:0.95rem;">
                        {{ $inspection->preemballe->effectif_echantillon ?? '—' }}
                    </span>
                </div>

            </div>

        </div>

        <hr class="my-4" style="border-color: #f1f3f5;">

        {{-- POIDS DES EMBALLAGES VIDES --}}
        <div class="mb-4">

            <h6 class="text-muted text-uppercase fw-semibold mb-3"
                style="font-size:0.7rem; letter-spacing:0.04em;">
                <i class="bi bi-box me-1" style="color:#ffc107;"></i>
                Poids des emballages vides
            </h6>

            <div class="table-responsive">

                <table class="table align-middle mb-0" style="font-size:0.85rem;">

                    <thead style="background: #f8f9fc; border-bottom: 2px solid #e9ecef;">
                        <tr>
                            <th class="text-uppercase small fw-semibold text-secondary text-center"
                                style="letter-spacing:0.04em; font-size:0.6rem; padding:0.5rem; width:80px;">
                                N°
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary"
                                style="letter-spacing:0.04em; font-size:0.6rem; padding:0.5rem;">
                                Poids (kg)
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($inspection->preemballe->emballagesVides as $poids)

                            <tr style="border-bottom: 1px solid #f1f3f5;">

                                <td class="text-center fw-semibold text-muted py-2 px-2" style="font-size:0.85rem;">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="py-2 px-2">
                                    {{ $poids->poids }}
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="2" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox d-block mb-2" style="font-size:1.5rem;"></i>
                                    Aucun poids enregistré
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <hr class="my-4" style="border-color: #f1f3f5;">

        {{-- ÉCHANTILLONS --}}
        <div class="mb-4">

            <h6 class="text-muted text-uppercase fw-semibold mb-3"
                style="font-size:0.7rem; letter-spacing:0.04em;">
                <i class="bi bi-collection me-1" style="color:#1683ff;"></i>
                Échantillons
            </h6>

            <div class="table-responsive">

                <table class="table align-middle mb-0" style="font-size:0.85rem;">

                    <thead style="background: #f8f9fc; border-bottom: 2px solid #e9ecef;">
                        <tr>
                            <th class="text-uppercase small fw-semibold text-secondary text-center"
                                style="letter-spacing:0.04em; font-size:0.6rem; padding:0.5rem; width:80px;">
                                N°
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary"
                                style="letter-spacing:0.04em; font-size:0.6rem; padding:0.5rem;">
                                Poids brut (kg)
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary"
                                style="letter-spacing:0.04em; font-size:0.6rem; padding:0.5rem;">
                                Poids net (kg)
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($inspection->preemballe->echantillons as $echantillon)

                            <tr style="border-bottom: 1px solid #f1f3f5;">

                                <td class="text-center fw-semibold text-muted py-2 px-2" style="font-size:0.85rem;">
                                    {{ $echantillon->numero }}
                                </td>

                                <td class="py-2 px-2">
                                    {{ $echantillon->poids_brut }}
                                </td>

                                <td class="py-2 px-2">
                                    {{ $echantillon->poids_net }}
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="3" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox d-block mb-2" style="font-size:1.5rem;"></i>
                                    Aucun échantillon enregistré
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <hr class="my-4" style="border-color: #f1f3f5;">

        {{-- RÉSULTATS DU CONTRÔLE --}}
        <div>

            <h6 class="text-muted text-uppercase fw-semibold mb-3"
                style="font-size:0.7rem; letter-spacing:0.04em;">
                <i class="bi bi-clipboard-check me-1" style="color:#059e33;"></i>
                Résultats du contrôle
            </h6>

            @php
                $hasResults = $inspection->preemballe->moyenne_emballage_vide !== null ||
                              $inspection->preemballe->ecart_type_emballage_vide !== null ||
                              $inspection->preemballe->emt !== null ||
                              $inspection->preemballe->emt_sur_5 !== null ||
                              $inspection->preemballe->eave !== null ||
                              $inspection->preemballe->ecart_type !== null ||
                              $inspection->preemballe->fce !== null ||
                              $inspection->preemballe->quantite_corrigee !== null ||
                              $inspection->preemballe->t1 !== null ||
                              $inspection->preemballe->t2 !== null ||
                              $inspection->preemballe->resultat_moyenne !== null ||
                              $inspection->preemballe->resultat_t1 !== null ||
                              $inspection->preemballe->resultat_t2 !== null;
            @endphp

            @if(!$hasResults)

                <div class="p-4 rounded-3 text-center" style="background: #f8f9fc; border: 2px dashed #e9ecef;">
                    <i class="bi bi-hourglass-split d-block mb-2" style="font-size:2rem; color:#ffc107;"></i>
                    <p class="text-muted mb-0" style="font-size:0.95rem;">
                        Les résultats du contrôle seront disponibles après la finalisation de l'inspection.
                    </p>
                </div>

            @else

                <div class="row g-3 mb-4">

                    <div class="col-6 col-md-4">
                        <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                            Moy. emballage vide
                        </label>
                        <span class="fw-semibold" style="font-size:0.95rem;">
                            {{ $inspection->preemballe->moyenne_emballage_vide ?? '—' }}
                        </span>
                    </div>

                    <div class="col-6 col-md-4">
                        <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                            Écart type emb. vide
                        </label>
                        <span style="font-size:0.95rem;">
                            {{ $inspection->preemballe->ecart_type_emballage_vide ?? '—' }}
                        </span>
                    </div>

                    <div class="col-6 col-md-4">
                        <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                            EMT
                        </label>
                        <span style="font-size:0.95rem;">
                            {{ $inspection->preemballe->emt ?? '—' }}
                        </span>
                    </div>

                    <div class="col-6 col-md-4">
                        <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                            EMT / 5
                        </label>
                        <span style="font-size:0.95rem;">
                            {{ $inspection->preemballe->emt_sur_5 ?? '—' }}
                        </span>
                    </div>

                    <div class="col-6 col-md-4">
                        <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                            EAVE
                        </label>
                        <span style="font-size:0.95rem;">
                            {{ $inspection->preemballe->eave ?? '—' }}
                        </span>
                    </div>

                    <div class="col-6 col-md-4">
                        <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                            Écart type
                        </label>
                        <span style="font-size:0.95rem;">
                            {{ $inspection->preemballe->ecart_type ?? '—' }}
                        </span>
                    </div>

                    <div class="col-6 col-md-4">
                        <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                            FCE
                        </label>
                        <span style="font-size:0.95rem;">
                            {{ $inspection->preemballe->fce ?? '—' }}
                        </span>
                    </div>

                    <div class="col-6 col-md-4">
                        <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                            Quantité corrigée
                        </label>
                        <span style="font-size:0.95rem;">
                            {{ $inspection->preemballe->quantite_corrigee ?? '—' }}
                        </span>
                    </div>

                    <div class="col-6 col-md-4">
                        <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                            T1
                        </label>
                        <span style="font-size:0.95rem;">
                            {{ $inspection->preemballe->t1 ?? '—' }}
                        </span>
                    </div>

                    <div class="col-6 col-md-4">
                        <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                            T2
                        </label>
                        <span style="font-size:0.95rem;">
                            {{ $inspection->preemballe->t2 ?? '—' }}
                        </span>
                    </div>

                </div>

                <div class="p-3 rounded-3" style="background: #f8f9fc; border-left: 4px solid #059e33;">

                    <div class="row g-3">

                        <div class="col-12 col-md-4">
                            <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                                Résultat moyenne
                            </label>
                            <span class="fw-semibold" style="font-size:0.95rem; color:#059e33;">
                                {{ $inspection->preemballe->resultat_moyenne ?? '—' }}
                            </span>
                        </div>

                        <div class="col-12 col-md-4">
                            <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                                Résultat T1
                            </label>
                            <span class="fw-semibold" style="font-size:0.95rem; color:#1683ff;">
                                {{ $inspection->preemballe->resultat_t1 ?? '—' }}
                            </span>
                        </div>

                        <div class="col-12 col-md-4">
                            <label class="text-muted d-block" style="font-size:0.7rem; letter-spacing:0.03em; font-weight:600;">
                                Résultat T2
                            </label>
                            <span class="fw-semibold" style="font-size:0.95rem; color:#ffc107;">
                                {{ $inspection->preemballe->resultat_t2 ?? '—' }}
                            </span>
                        </div>

                    </div>

                </div>

            @endif

        </div>

    </div>

</div>

@endif