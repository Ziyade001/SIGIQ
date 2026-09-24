@extends('dashboards.index')

@section('content')

<div class="container py-4">

<div class="mb-3 no-print">

    <button onclick="window.print()"
            class="btn btn-success">

        <i class="bi bi-printer-fill me-2"></i>
        Imprimer la convocation

    </button>

</div>

<div class="convocation-document bg-white shadow p-5">

    {{-- ENTETE --}}
    <div class="row align-items-center mb-4">

        <div class="col-6 text-start">

            <img src="{{ asset('img/logo-benin.png') }}"
                 alt="ANM"
                 style="height:60px;">

        </div>
    
        <div class="col-6 text-end">

            <img src="{{ asset('img/logo-anm.png') }}"
                 alt="Bénin"
                 style="height:50px;">

        </div>

    </div>
    <hr>

    {{-- TITRE --}}
    <div class="mb-4">

        <span class="text-decoration-underline">
            Convocation
        </span>
        :
            <strong>{{ $convocation->reference }}</strong>
    </div>

    {{-- INFORMATIONS --}}
    <div class="mb-4">

        <p>
            <strong>Nom / Raison sociale :</strong>
            {{ $convocation->inspection->etablissement }}
        </p>

        <p>
            <strong>Adresse :</strong>
            {{ $convocation->inspection->adresse }}
        </p>
    </div>

    {{-- TEXTE --}}
    <div class="mb-4" style="line-height:2; text-align:justify;">

        Monsieur / Madame
        <strong>{{ $convocation->inspection->nom_proprietaire }}</strong>,

        est prié(e) de se présenter
        à l'Agence nationale de Normalisation, de Métrologie
        et du Contrôle Qualité (ANM), sise à St Jean dans la 6ème von en quittant l'Etoile rouge vers le carrefour Cossi à Cotonou,
        le :

        <strong>
            {{ \Carbon\Carbon::parse($convocation->date_convocation)->format('d/m/Y') }}
        </strong>

        à

        <strong>
            {{ $convocation->heure_convocation }}
        </strong>

        pour affaire le concernant.

    </div>
    
    <div class="mb-1">

        <span class="text-decoration-underline">
            Tel
        </span>
        : 0169374546 / 0169166365
    </div>

    <div class="mb-0">

        <p>
            <span class="text-decoration-underline">Infraction constatée </span>:
            {{ $convocation->infraction }}
        </p>

        <p>
            <span class="text-decoration-underline">Amende appliqée </span>:
            <strong> {{ number_format($convocation->inspection->amendes, 0, ',', ' ') }} FCFA </strong>
        </p>

    </div>

    {{-- SIGNATURE --}}

        <div class="row align-items-center mb-1 mx-0">

    <div class="col-6 text-start p-0">
        <!-- autre contenu -->
    </div>

    <div class="col-6 text-end p-0">
        <img src="{{ asset('img/cachet-anm.png') }}"
             alt="Cachet"
             style="height:120px;">
    </div>

</div>

</div>

</div>

<style>

@media print {

    .no-print,
    .navbar,
    .sidebar,
    .admin-navbar,
    .admin-sidebar {
        display:none !important;
    }

    body {
        background:#fff !important;
    }

    .convocation-document {
        box-shadow:none !important;
        border:none !important;
    }
}

.convocation-document{
    max-width:900px;
    margin:auto;
    font-size:15px;
}

</style>

@endsection
