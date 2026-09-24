@extends('layouts.guest')

@section('content')

<div class="d-flex align-items-center justify-content-center"
     style="min-height: 100vh; padding: 40px 15px;">

    <div class="container" data-aos="zoom-in">

        <div class="row justify-content-center">

            <div class="col-lg-5 col-md-7">

                <!-- CARD -->
                <div class="card shadow-lg border-0 rounded-4 p-4 p-md-5">

                    <!-- HEADER -->
                    <div class="text-center mb-4">

                        <h3 class="fw-bold text-dark">
                            Confirmation de mot de passe
                        </h3>

                        <p class="text-muted small">
                            Zone sécurisée ANM-Inspect
                        </p>

                    </div>

                    <!-- INFO -->
                    <div class="alert alert-warning small">
                        Cette zone est sécurisée. Veuillez confirmer votre mot de passe avant de continuer.
                    </div>

                    <!-- FORM -->
                    <form method="POST" action="{{ route('password.confirm') }}">

                        @csrf

                        <!-- PASSWORD -->
                        <div class="mb-3">

                            <label class="form-label">
                                Mot de passe
                            </label>

                            <input type="password"
                                   name="password"
                                   class="form-control form-control-lg rounded-3"
                                   required
                                   autocomplete="current-password">

                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>

                        <!-- ACTION -->
                        <div class="d-flex justify-content-end">

                            <button type="submit"
                                    class="btn btn-success btn-lg px-4 rounded-3">
                                Confirmer
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection