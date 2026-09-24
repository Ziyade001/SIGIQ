@extends('layouts.guest')

@section('content')

<div class="d-flex align-items-center justify-content-center">

    <div class="container" data-aos="zoom-in">

        <div class="row justify-content-center">

            <div class="col-lg-5 col-md-7">

                <div class="card border-0 rounded-4"
                     style="box-shadow:0 15px 40px rgba(0,0,0,.08);">

                    <div class="card-body p-4 p-md-5">

                        <!-- Logo -->
                        <div class="text-center mb-4">

                            <img src="{{ asset('img/logo.png') }}"
                                 alt="Logo ANM"
                                 class="mb-3"
                                 style="height:100px;">

                            <h4 class="fw-bold mb-2" style="color: #059e33;">
                                SIGIQ
                            </h4>

                            <p class="text-muted mb-0">
                                Accédez à votre espace de travail
                            </p>

                        </div>

                        <!-- Message de succès -->
                        @if(session('status'))
                            <div class="alert alert-success rounded-3">
                                {{ session('status') }}
                            </div>
                        @endif

                        <!-- Formulaire -->
                        <form method="POST" action="{{ route('login') }}">

                            @csrf

                            <!-- Adresse email -->
                            <div class="mb-4">

                                <label class="form-label fw-semibold">
                                    Adresse email
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="bi bi-envelope"></i>
                                    </span>

                                    <input type="email"
                                           name="email"
                                           value="{{ old('email') }}"
                                           class="form-control border-start-0 py-2"
                                           placeholder="exemple@email.com"
                                           required
                                           autofocus>

                                </div>

                                @error('email')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>

                            <!-- Mot de passe -->
                            <div class="mb-4">

                                <label class="form-label fw-semibold">
                                    Mot de passe
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="bi bi-lock"></i>
                                    </span>

                                    <input type="password"
                                           name="password"
                                           class="form-control border-start-0 py-2"
                                           placeholder="********"
                                           required>

                                </div>

                                @error('password')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>

                            <!-- Se souvenir de moi -->
                            <div class="form-check mb-4">

                                <input class="form-check-input"
                                       type="checkbox"
                                       name="remember"
                                       id="remember">

                                <label class="form-check-label" for="remember">
                                    Se souvenir de moi
                                </label>

                            </div>

                            <!-- Bouton -->
                            <div class="d-grid">

                                <button type="submit"
                                        class="btn btn-anm rounded-3 fw-semibold py-2">

                                    <i class="bi bi-box-arrow-in-right me-2"></i>

                                        Se connecter

                                </button>

                            </div>

                        </form>

                        <hr class="my-4">

                        <!-- Pied de page -->
                        <div class="text-center">

                            <small class="text-muted">

                                © {{ date('Y') }} SIGIQ

                                <br>

                                Agence Nationale de Normalisation,
                                de Métrologie et du Contrôle Qualité

                            </small>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection