<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>SIGIQ</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset('/img/favicon1.png') }}" rel="icon">
  <link href="{{ asset('/img/favicon1.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('/css/main.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Vesperr
  * Template URL: https://bootstrapmade.com/vesperr-free-bootstrap-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<body class="index-page">

  @include('partials.header')

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
            <h1>Optimisez vos opérations d’inspection avec <strong style="color: #059e33;">SIGIQ</strong></h1>
            <p>SIGIQ, Système Intégré de Gestion des Inspections et du Contrôle Qualité réalisées à l'ANM.</p>
            <div class="d-flex">
              <a href="{{ route('login') }}" class="btn-get-started">Commencer</a>
            </div>
          </div>
          <div class="col-lg-6 order-1 order-lg-2 hero-img">
            <img src="{{ asset('/img/hero-img1.png') }}" class="img-fluid animated" alt="">
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- Clients Section -->
    <section id="clients" class="clients section light-background">

      <div class="container" data-aos="fade-up">

        <div class="row gy-4">

          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="{{ asset('/img/clients/client-1.png') }}" class="img-fluid" alt="">
          </div><!-- End Client Item -->

          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="{{ asset('/img/clients/client-2.png') }}" class="img-fluid" alt="">
          </div><!-- End Client Item -->

          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="{{ asset('/img/clients/client-3.png') }}" class="img-fluid" alt="">
          </div><!-- End Client Item -->

          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="{{ asset('/img/clients/client-4.png') }}" class="img-fluid" alt="">
          </div><!-- End Client Item -->

          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="{{ asset('/img/clients/client-5.png') }}" class="img-fluid" alt="">
          </div><!-- End Client Item -->

          <div class="col-xl-2 col-md-3 col-6 client-logo">
            <img src="{{ asset('/img/clients/client-6.png') }}" class="img-fluid" alt="">
          </div><!-- End Client Item -->

        </div>

      </div>

    </section><!-- /Clients Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>À propos</h2>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-5">

          <div class="content col-xl-5 d-flex flex-column" data-aos="fade-up" data-aos-delay="100">
            <h3>Une solution moderne pour le contrôle qualité</h3>
            <p>
               SIGIQ facilite la gestion et le suivi des missions d’inspection sur le terrain.
              La plateforme permet aux techniciens assermentés, superviseurs et responsables de centraliser les données, suivre les opérations en temps réel et produire des rapports fiables et sécurisés.            </p>
            <a href="https://anm.bj/fr/actualites" class="about-btn align-self-center align-self-xl-start"><span>En savoir plus</span> <i class="bi bi-chevron-right"></i></a>
          </div>

          <div class="col-xl-7" data-aos="fade-up" data-aos-delay="200">
            <div class="row gy-4">

              <div class="col-md-6 icon-box position-relative">
                <i class="bi bi-speedometer2"></i>
                <h4><a href="" class="stretched-link">Contrôle des balances</a></h4>
                <p>Les balances et bascules utilisées pour vendre les produits
                  (poissonneries, boucheries, marchés, boutiques, etc.)</p>
              </div><!-- Icon-Box -->

              <div class="col-md-6 icon-box position-relative">
                <i class="bi bi-box-seam"></i>
                <h4><a href="" class="stretched-link">Vérification des poids</a></h4>
                <p>Le poids réel des produits emballés
                   (riz, farine, sucre, pain, produits préemballés…) pour vérifier qu’il correspond au poids affiché.</p>
              </div><!-- Icon-Box -->

              <div class="col-md-6 icon-box position-relative">
                <i class="bi bi-shield-check"></i>
                <h4><a href="" class="stretched-link">Hygiène des stands</a></h4>
                <p>Propreté générale du stand
                 (sol propre, absence de déchets, environnement sain)</p>
              </div><!-- Icon-Box -->

              <div class="col-md-6 icon-box position-relative">
                <i class="bi bi-fuel-pump"></i>
                <h4><a href="" class="stretched-link">Pompes des stations-service</a></h4>
                <p>Les pompes des stations-service
                 afin de vérifier que la quantité de carburant servie est correcte.</p>
              </div><!-- Icon-Box -->

            </div>
          </div>

        </div>

      </div>

    </section><!-- /About Section -->

    <!-- Stats Section -->
    <section id="stats" class="stats section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4 align-items-center">

          <div class="col-lg-5">
            <img src="{{ asset('/img/stats-img1.svg') }}" alt="" class="img-fluid">
          </div>

          <div class="col-lg-7">  

            <div class="row gy-4">

              <div class="col-lg-6">
                <div class="stats-item d-flex">
                  <i class="bi bi-emoji-smile flex-shrink-0"></i>
                  <div>
                    <span><strong>Plus de</strong></span><span data-purecounter-start="0" data-purecounter-end="7000" data-purecounter-duration="1" class="purecounter"></span>
                    <p><strong>Clients satisfaires</strong></p>
                  </div>
                </div>
              </div><!-- End Stats Item -->

              <div class="col-lg-6">
                <div class="stats-item d-flex">
                  <i class="bi bi-journal-richtext flex-shrink-0"></i>
                  <div>
                    <span><strong>Plus de</strong></span><span data-purecounter-start="0" data-purecounter-end="102521" data-purecounter-duration="1" class="purecounter"></span>
                    <p><strong>Inspections</strong> <span>réalisées</span></p>
                  </div>
                </div>
              </div><!-- End Stats Item -->

              <div class="col-lg-6">
                <div class="stats-item d-flex">
                  <i class="bi bi-headset flex-shrink-0"></i>
                  <div>
                    <span><strong>Plus de</strong></span><span data-purecounter-start="0" data-purecounter-end="1453" data-purecounter-duration="1" class="purecounter"></span>
                    <p><strong>Heures d'assistance</strong></p>
                  </div>
                </div>
              </div><!-- End Stats Item -->

              <div class="col-lg-6">
                <div class="stats-item d-flex">
                  <i class="bi bi-people flex-shrink-0"></i>
                  <div>
                    <span><strong>Plus de</strong></span><span data-purecounter-start="0" data-purecounter-end="50" data-purecounter-duration="1" class="purecounter"></span>
                    <p><strong>Techniciens assermentés Qualifiés</strong></p>
                  </div>
                </div>
              </div><!-- End Stats Item -->

            </div>

          </div>

        </div>

      </div>

    </section><!-- /Stats Section -->

    <!-- Services Section -->
    <section id="services" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Services / Fonctionnalités</h2>
        <p>Fonctionnalités principales</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item position-relative">
              <i class="bi bi-activity"></i>
              <h4><a href="" class="stretched-link">Suivi des inspections</a></h4>
              <p>Consultez et gérez toutes les opérations d’inspection depuis une interface centralisée.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item position-relative">
              <i class="bi bi-file-earmark-text"></i>
              <h4><a href="" class="stretched-link">Gestion des rapports</a></h4>
              <p>Générez automatiquement des rapports détaillés après chaque mission de contrôle.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item position-relative">
              <i class="bi bi-people-fill"></i>
              <h4><a href="" class="stretched-link">Gestion des Techniciens assermentés</a></h4>
              <p>Attribuez les missions et suivez les performances des équipes d’inspection.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="400">
            <div class="service-item position-relative">
              <i class="bi bi-archive-fill"></i>
              <h4><a href="" class="stretched-link">Archivage sécurisé</a></h4>
              <p>Conservez l’historique des inspections et des contrôles en toute sécurité.</p>
            </div>
          </div><!-- End Service Item -->

        </div>

      </div>

    </section><!-- /Services Section -->


    <!-- Faq Section -->
    <section id="faq" class="faq section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Pourquoi utiliser SIGIQ ?</h2>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row faq-item" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-5 d-flex">
            <i class="bi bi-check-circle"></i>
            <h4>Centralisation des données d’inspection</h4>
          </div>
          <div class="col-lg-7">
            <p>
              Toutes les informations liées aux inspections sont regroupées sur une seule plateforme afin de faciliter l’accès, la consultation et la gestion des données en temps réel.            
            </p>
          </div>
        </div><!-- End F.A.Q Item-->

        <div class="row faq-item" data-aos="fade-up" data-aos-delay="200">
          <div class="col-lg-5 d-flex">
            <i class="bi bi-check-circle"></i>
            <h4>Gain de temps dans le traitement des opérations</h4>
          </div>
          <div class="col-lg-7">
            <p>
              La digitalisation des processus permet d’accélérer la planification, l’exécution et le suivi des missions d’inspection, réduisant ainsi les tâches manuelles répétitives.
            </p>
          </div>
        </div><!-- End F.A.Q Item-->

        <div class="row faq-item" data-aos="fade-up" data-aos-delay="300">
          <div class="col-lg-5 d-flex">
            <i class="bi bi-question-circle"></i>
            <h4>Réduction des erreurs administratives</h4>
          </div>
          <div class="col-lg-7">
            <p>
              L’automatisation de la saisie et du traitement des informations limite les erreurs humaines et améliore la fiabilité des rapports et documents générés.
            </p>
          </div>
        </div><!-- End F.A.Q Item-->

        <div class="row faq-item" data-aos="fade-up" data-aos-delay="400">
          <div class="col-lg-5 d-flex">
            <i class="bi bi-check-circle"></i>
            <h4>Amélioration de la traçabilité</h4>
          </div>
          <div class="col-lg-7">
            <p>
              Chaque opération effectuée sur la plateforme est enregistrée, permettant un meilleur suivi des inspections, des décisions prises et des actions réalisées.
            </p>
          </div>
        </div><!-- End F.A.Q Item-->

        <div class="row faq-item" data-aos="fade-up" data-aos-delay="500">
          <div class="col-lg-5 d-flex">
            <i class="bi bi-check-circle"></i>
            <h4>Sécurisation des informations</h4>
          </div>
          <div class="col-lg-7">
            <p>
              Les données sont stockées de manière sécurisée afin de garantir leur confidentialité, leur intégrité et leur disponibilité pour les utilisateurs autorisés.
            </p>
          </div>
        </div><!-- End F.A.Q Item-->

        <div class="row faq-item" data-aos="fade-up" data-aos-delay="500">
          <div class="col-lg-5 d-flex">
            <i class="bi bi-check-circle"></i>
            <h4>Meilleure collaboration entre les équipes</h4>
          </div>
          <div class="col-lg-7">
            <p>
              Les techniciens assermentés, superviseurs et responsables peuvent travailler efficacement sur une même plateforme, facilitant le partage d’informations et la coordination des missions.
            </p>
          </div>
        </div><!-- End F.A.Q Item-->


      </div>

    </section><!-- /Faq Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>APPEL À L’ACTION</h2>
      </div><!-- End Section Title -->

      <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
            <h1>Simplifiez vos opérations d’inspection dès aujourd’hui</h1>
            <p>SIGIQ vous accompagne dans la digitalisation des processus de contrôle qualité et de suivi des inspections.</p>
            <div class="d-flex">
              <button type="button" class="btn-call-action" onclick="location.href='{{ route('login') }}'">
                Commencer
              </button> 
            </div>
          </div>
          <div class="col-lg-6 order-1 order-lg-2 hero-img">
            <img src="{{ asset('/img/hero-img2.png') }}" class="img-fluid animated" alt="">
          </div>
        </div>

      </div>

    </section><!-- /Contact Section -->

  </main>

  @include('partials.footer')

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('/js/main.js') }}"></script>

</body>

</html>