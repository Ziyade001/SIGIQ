@extends('dashboards.index')

@section('content')

<div class="container py-4">

    <div class="mb-3 no-print">

        <button onclick="window.print()"
                class="btn btn-success">

            <i class="bi bi-printer-fill me-2"></i>
            Imprimer le rapport

        </button>
        @if(auth()->user()->role === 'dt')
        <a href="{{ route('rapports.edit', $mission) }}"
           class="btn btn-warning">

            <i class="bi bi-pencil-square me-2"></i>
            Modifier

        </a>
        @endif
    </div>

    <div class="rapport-document bg-white shadow p-5">

        {{-- ENTETE --}}
        <div class="row align-items-center mb-4">

            <div class="col-6 text-start">

                <img src="{{ asset('img/logo-benin.png') }}"
                     alt="Logo Bénin"
                     style="height:60px;">

            </div>

            <div class="col-6 text-end">

                <img src="{{ asset('img/logo-anm.png') }}"
                     alt="Logo ANM"
                     style="height:55px;">

            </div>

        </div>

        <hr>

        {{-- TITRE --}}
        <div class="text-center mb-5">

            <h4 class="fw-bold text-decoration-underline">
                RAPPORT DE MISSION
            </h4>

            <p class="mb-0">
                Référence :
                <strong>{{ $mission->reference }}</strong>
            </p>

        </div>

        {{-- INFORMATIONS GENERALES --}}

        <div class="mb-4">

            <p>
                <span class="text-decoration-underline">
                    Période de mission
                </span>
                :
                Du
                <strong>{{ $mission->periode_debut->format('d/m/Y') }}</strong>
                au
                <strong>{{ $mission->periode_fin->format('d/m/Y') }}</strong>
            </p>

            <p>
                <span class="text-decoration-underline">
                    Catégorie
                </span>
                :
                {{ $mission->categorie }}
            </p>

            <p>
                <span class="text-decoration-underline">
                    Type de mission
                </span>
                :
                {{ $mission->type_mission }}
            </p>

            <p>
                <span class="text-decoration-underline">
                    Localités couvertes
                </span>
                :
                {{ $mission->localites }}
            </p>

            <p>
                <span class="text-decoration-underline">
                    Conducteur CVA
                </span>
                :
                {{ $mission->conducteur_cva }}
            </p>

        </div>

        {{-- PARTICIPANTS --}}

        <div class="mb-4">

            <p class="mb-2">

                <span class="text-decoration-underline">
                    Membres de l'équipe
                </span>

            </p>

            <ul>

                @foreach($mission->participants as $participant)

                    <li>{{ $participant->name }}</li>

                @endforeach

            </ul>

        </div>

        {{-- COMPTE RENDU --}}

        <div class="mb-5">

            <p>

                <span class="text-decoration-underline">
                    Compte rendu de mission
                </span>
                :
                {{ $mission->compte_rendu }}

            </p>
             
        </div>

        {{-- TABLEAU DES RESULTATS --}}

        <div class="mb-5">

            <p>

                <span class="text-decoration-underline">
                    Résultats obtenus
                </span>

            </p>

            <table class="table table-bordered">

                <tbody>

                    <tr>
                        <th>Nombre de boutiques contrôlées</th>
                        <td>{{ $mission->nb_boutiques_controlees }}</td>
                    </tr>

                    <tr>
                        <th>Nombre de boutiques non conformes</th>
                        <td>{{ $mission->nb_boutiques_non_conformes }}</td>
                    </tr>

                    <tr>
                        <th>Nombre d'instruments contrôlés</th>
                        <td>{{ $mission->nb_instruments_controles }}</td>
                    </tr>

                    <tr>
                        <th>Nombre d'instruments non conformes</th>
                        <td>{{ $mission->nb_instruments_non_conformes }}</td>
                    </tr>

                    <tr>
                        <th>Nombre de préemballés contrôlés</th>
                        <td>{{ $mission->nb_preemballes_controles }}</td>
                    </tr>

                    <tr>
                        <th>Nombre de préemballés non conformes</th>
                        <td>{{ $mission->nb_preemballes_non_conformes }}</td>
                    </tr>

                    <tr>
                        <th>Nombre d'amendes dressées</th>
                        <td>{{ $mission->nb_amendes }}</td>
                    </tr>

                    <tr>
                        <th>Montant total des amendes</th>
                        <td>
                            {{ number_format($mission->montant_amendes,0,',',' ') }}
                            FCFA
                        </td>
                    </tr>

                    <tr>
                        <th>Montant des frais de vérification</th>
                        <td>
                            {{ number_format($mission->montant_frais_verification,0,',',' ') }}
                            FCFA
                        </td>
                    </tr>

                    <tr>
                        <th>Instruments mis en conformité</th>
                        <td>
                            {{ $mission->nb_instruments_mis_conformite }}
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

        {{-- VALIDATION --}}

        <div class="mt-5">

            <p>

                <span class="text-decoration-underline">
                    Fiche signée par
                </span>
                :
                <strong>{{ $mission->fiche_signee_par }}</strong>

            </p>

        </div>

        {{-- CACHET --}}

        <div class="row mt-5 align-items-center">

            <div class="col-6">

            </div>

            <div class="col-6 text-end">

                <img src="{{ asset('img/cachet-anm.png') }}"
                     alt="Cachet"
                     style="height:120px;">

            </div>

        </div>

    </div>

</div>

<style>

.rapport-document{
    max-width:1000px;
    margin:auto;
    font-size:15px;
}

.table th{
    width:70%;
    background:#f8f9fa;
}

@media print {

    .no-print,
    .navbar,
    .sidebar,
    .admin-navbar,
    .admin-sidebar{
        display:none !important;
    }

    body{
        background:#fff !important;
    }

    .rapport-document{
        box-shadow:none !important;
        border:none !important;
    }
}

</style>

@endsection