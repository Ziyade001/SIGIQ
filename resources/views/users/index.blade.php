@extends('dashboards.index')

@section('content')

<main class="dashboard-content">

    <div class="container-fluid px-3 px-lg-4 py-4">

        <!-- PAGE HEADER -->
        <div class="page-heading d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">

            <div class="page-heading-copy d-flex align-items-center gap-3 section-title">

                <span class="page-icon">
                    <i class="bi bi-people" aria-hidden="true"></i>
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
                                Utilisateurs
                            </li>
                        </ol>
                    </nav>

                    <h1 class="h3 mb-1 fw-bold">
                        Gestion des utilisateurs
                    </h1>

                    <p class="text-muted mb-0" style="font-size: 0.9rem;">
                        Liste des utilisateurs du système
                    </p>

                </div>

            </div>

            <div class="heading-actions">

                <a href="{{ route('users.create') }}"
                   class="btn btn-primary btn-sm rounded-pill px-3"
                   style="font-weight: 500; background-color:#059e33; border-color:#059e33;">
                    <i class="bi bi-plus-circle me-1"></i>
                    Nouvel utilisateur
                </a>

            </div>

        </div>

@if(session('generated_password'))

<div class="alert alert-warning shadow-sm">

    <h6 class="fw-bold mb-2">

        Nouveau mot de passe

    </h6>

    <div class="fs-5">

        <code>{{ session('generated_password') }}</code>

    </div>

    <small class="text-muted">

        Copiez ce mot de passe et communiquez-le à l'utilisateur.
        Il ne sera plus affiché après cette page.

    </small>

</div>

@endif

        <!-- TABLEAU DES UTILISATEURS -->
        <div class="panel card border-0 shadow-sm rounded-4">

            <div class="panel-header card-header bg-transparent border-0 d-flex flex-wrap align-items-center justify-content-between gap-2 px-4 pt-4 pb-3">

                <div>

                    <h2 class="h5 mb-1 fw-bold d-flex align-items-center gap-2 section-title">
                        <i class="bi bi-list-ul me-2"></i>
                        <span>Liste des utilisateurs</span>
                    </h2>

                    <p class="text-muted mb-0" style="font-size: 0.85rem;">
                        {{ $users->total() }} utilisateur(s) trouvé(s)
                    </p>

                </div>

                <span class="badge rounded-pill px-3 py-2"
                      style="background-color:rgba(22,131,255,.12); color:#1683ff; font-weight: 600; font-size: 0.75rem;">
                    <i class="bi bi-people me-1"></i>
                    {{ $users->total() }}
                </span>

            </div>

            <div class="table-responsive px-1">

                <table class="table align-middle mb-0" style="font-size: 0.9rem;">

                    <thead style="background: #f8f9fc; border-bottom: 2px solid #e9ecef;">
                        <tr>
                            <th class="text-uppercase small fw-semibold text-secondary"
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Matricule
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary"
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Nom
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary"
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Email
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary"
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Fonction
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary"
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Rôle
                            </th>
                            <th class="text-uppercase small fw-semibold text-secondary"
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Téléphone
                            </th>
                            <th class="text-end text-uppercase small fw-semibold text-secondary"
                                style="letter-spacing: 0.04em; font-size: 0.65rem; padding: 0.75rem 0.5rem;">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($users as $user)

                            <tr style="border-bottom: 1px solid #f1f3f5; transition: background 0.15s;"
                                onmouseover="this.style.background='#f8f9fc'"
                                onmouseout="this.style.background='transparent'">

                                <td class="py-2 px-2 fw-semibold" style="font-size: 0.85rem;">
                                    {{ $user->matricule }}
                                </td>

                                <td class="py-2 px-2" style="font-size: 0.9rem;">
                                    <div class="d-flex align-items-center gap-2">

                                        @if($user->photo)

                                            <img src="{{ asset('storage/'.$user->photo) }}"
                                                 class="rounded-circle"
                                                 width="32"
                                                 height="32"
                                                 style="object-fit: cover;"
                                                 alt="Photo de {{ $user->name }}">

                                        @else

                                            <span class="d-flex align-items-center justify-content-center rounded-circle bg-light"
                                                  style="width: 32px; height: 32px; color: #6c757d;">
                                                <i class="bi bi-person" style="font-size: 0.85rem;"></i>
                                            </span>

                                        @endif

                                        <span class="fw-semibold">{{ $user->name }}</span>

                                    </div>
                                </td>

                                <td class="py-2 px-2" style="font-size: 0.85rem;">
                                    {{ $user->email }}
                                </td>

                                <td class="py-2 px-2" style="font-size: 0.85rem;">
                                    {{ $user->fonction }}
                                </td>

                                <td class="py-2 px-2">

                                    @php
                                        $roleColors = [
                                            'admin' => ['bg' => 'rgba(220,53,69,.12)', 'color' => '#dc3545'],
                                            'dg' => ['bg' => 'rgba(5,158,51,.12)', 'color' => '#059e33'],
                                            'dt' => ['bg' => 'rgba(255,193,7,.12)', 'color' => '#ffc107'],
                                            'inspecteur' => ['bg' => 'rgba(22,131,255,.12)', 'color' => '#1683ff'],
                                        ];
                                        $role = strtolower($user->role);
                                        $style = $roleColors[$role] ?? ['bg' => 'rgba(108,117,125,.12)', 'color' => '#6c757d'];
                                    @endphp

                                    <span class="badge rounded-pill px-3 py-1"
                                          style="background-color:{{ $style['bg'] }}; color:{{ $style['color'] }}; font-weight: 500; font-size: 0.7rem;">
                                        {{ strtoupper($user->role) }}
                                    </span>

                                </td>

                                <td class="py-2 px-2" style="font-size: 0.85rem;">
                                    <i class="bi bi-telephone text-secondary me-1" style="font-size: 0.65rem;"></i>
                                    {{ $user->telephone ?? '-' }}
                                </td>

                                <td class="text-end py-2 px-2">

                                    <div class="d-flex justify-content-end gap-1">

                                        <!-- Voir -->
                                        <a href="{{ route('users.show', $user) }}"
                                           class="btn btn-outline-info btn-sm rounded-pill px-2"
                                           style="font-size: 0.7rem; font-weight: 500;"
                                           data-bs-toggle="tooltip"
                                           title="Voir l'utilisateur">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <!-- Modifier -->
                                        <a href="{{ route('users.edit', $user) }}"
                                           class="btn btn-outline-warning btn-sm rounded-pill px-2"
                                           style="font-size: 0.7rem; font-weight: 500;"
                                           data-bs-toggle="tooltip"
                                           title="Modifier l'utilisateur">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <form action="{{ route('users.reset-password', $user) }}"
      method="POST"
      class="d-inline"
      onsubmit="return confirm('Réinitialiser le mot de passe de {{ $user->name }} ?')">

    @csrf
    @method('PUT')

    <button class="btn btn-sm btn-outline-secondary"
            title="Réinitialiser le mot de passe">

        <i class="bi bi-key"></i>

    </button>

</form>

                                        <!-- Supprimer -->
                                        <form action="{{ route('users.destroy', $user) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Voulez-vous vraiment supprimer cet utilisateur ? Cette action est irréversible.')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-outline-danger btn-sm rounded-pill px-2"
                                                    style="font-size: 0.7rem; font-weight: 500;"
                                                    data-bs-toggle="tooltip"
                                                    title="Supprimer l'utilisateur">
                                                <i class="bi bi-trash"></i>
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="text-center text-muted py-5">

                                    <div class="empty-state">

                                        <i class="bi bi-people display-4 text-muted d-block mb-3" style="font-size: 3rem;"></i>

                                        <h5 class="mt-3 fw-bold">
                                            Aucun utilisateur trouvé
                                        </h5>

                                        <p class="text-muted mb-0" style="font-size: 0.9rem;">
                                            Commencez par créer votre premier utilisateur.
                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <!-- Pagination -->
            @if($users->hasPages())

                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 p-3 border-top">

                    <div class="text-muted small" style="font-size: 0.8rem;">
                        Affichage de {{ $users->firstItem() ?? 0 }} à {{ $users->lastItem() ?? 0 }} sur {{ $users->total() }} utilisateurs
                    </div>

                    <div>
                        {{ $users->appends(request()->query())->links() }}
                    </div>

                </div>

            @endif

        </div>

    </div>

</main>

@endsection