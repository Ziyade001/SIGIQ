<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="{{ route('index') }}" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="{{ asset('/img/logo.png') }}" alt="">
        <h1 class="sitename" style="color: #059e33;">SIGIQ</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#about">À propos</a></li> 
          <li><a href="#services">Services</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="{{ route('login') }}">Connexion</a>

    </div>
  </header>