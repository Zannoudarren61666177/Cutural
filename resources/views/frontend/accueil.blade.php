<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'CultureBénin') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

<style>
    body {
        margin: 0;
        font-family: 'Figtree', sans-serif;
        background: #f5f5f5;
        line-height: 1.7;
        color: #333;
    }

    /* ======== NAVBAR ======== */
    nav {
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 1000;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.9rem 2rem;
        background: #0a1d3f;
        color: white;
        box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        transition: 0.3s;
    }

    nav.scrolled {
        background: #081830;
        padding: 0.7rem 2rem;
    }

    nav .title {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        font-size: 1.6rem;
        font-weight: 700;
        color: white;
    }

    nav a {
        color: white;
        text-decoration: none;
        font-weight: 600;
        margin-left: 1rem;
        transition: opacity 0.2s;
    }

    nav a:hover {
        opacity: 0.85;
    }

    nav .logo img {
        width: 70px;
    }

    /* ======== HERO ======== */
    .hero {
        min-height: 100vh;
        padding-top: 120px;
        background-image: url('{{ asset("images/bio.webp") }}');
        background-size: cover;
        background-position: center;
        color: white;
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .hero::after {
        content: "";
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.5);
    }

    .hero * {
        position: relative;
        z-index: 2;
    }

    .hero h1 { 
        font-size: 3rem; 
        margin-bottom: 1rem;
    }

    .hero p { 
        font-size: 1.2rem; 
        max-width: 650px;
        margin-bottom: 2rem;
    }

    /* ======== BOUTONS ======== */
    .btn {
        padding: 0.75rem 2rem;
        border-radius: 0.5rem;
        margin: 0.5rem;
        text-decoration: none;
        font-weight: 600;
        cursor: pointer;
        display: inline-block;
        transition: transform 0.1s ease, box-shadow 0.1s ease, background-color 0.2s ease;
    }

    .btn-login {
        background: #f4b400;
        color: #222;
        box-shadow: 0 5px #c89f00;
    }
    .btn-register {
        background: white;
        color: #0a1d3f;
        box-shadow: 0 5px #081830;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px rgba(0,0,0,0.2);
    }

    .btn:active {
        transform: translateY(4px) scale(0.95);
        box-shadow: 0 2px rgba(0,0,0,0.3);
    }
    .btn-login:active {
        background-color: #e0a800;
    }
    .btn-register:active {
        background-color: #e6e6e6;
    }

    /* ======== SECTION A PROPOS ======== */
    .apropos {
        padding: 4rem 2rem;
        background: #ffe8c2;
        text-align: center;
    }

    .apropos h2 {
        font-size: 2.3rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
    }

    .apropos p {
        max-width: 850px;
        margin: auto;
        font-size: 1.2rem; /* légèrement plus grand pour lisibilité */
        line-height: 1.8; /* espace amélioré */
        color: #333;
    }

    /* ======== FEATURES ======== */
    .sections {
        padding: 4rem 2rem;
        background: #fff7ea;
        text-align: center;
    }

    .sections h2 {
        font-size: 2.3rem;
        margin-bottom: 2rem;
    }

    .features {
        display: flex;
        justify-content: center;
        gap: 2rem;
        flex-wrap: wrap;
    }

    .feature {
        background: white;
        border-radius: 0.75rem;
        padding: 2rem;
        width: 280px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.15);
        transition: 0.3s;
    }

    .feature:hover {
        transform: translateY(-7px);
    }

    .feature i {
        font-size: 2.7rem;
        color: #0a1d3f;
        margin-bottom: 1rem;
    }

    footer {
        text-align: center;
        padding: 2rem;
        background: #0a1d3f;
        color: white;
    }

    /* RESPONSIVE TEXT */
    @media (max-width: 768px) {
        .hero h1 {
            font-size: 2.2rem;
        }
        .hero p {
            font-size: 1rem;
            max-width: 90%;
        }
        .apropos h2, .sections h2 {
            font-size: 2rem;
        }
        .apropos p, .feature p {
            font-size: 1rem;
        }
    }
</style>
</head>
<body>

<!-- NAVBAR -->
<nav id="navbar">
    <div class="logo">
        <a href="/">
            <x-application-logo class="w-16 h-16" />
        </a>
    </div>

    <div class="title">Culture Bénin</div>

    <div>
        <a href="{{ route('login') }}">Connexion</a>
        <a href="{{ route('register') }}">Inscription</a>
    </div>
</nav>

<!-- HERO -->
<section class="hero">
    <h1>Bienvenue sur CultureBénin</h1>
    <p>Découvrez les richesses culturelles du Bénin et explorez un patrimoine unique.</p>

    <div>
        <a href="{{ route('login') }}" class="btn btn-login">Se connecter</a>
        <a href="{{ route('register') }}" class="btn btn-register">Créer un compte</a>
    </div>
</section>

<!-- A PROPOS -->
<section class="apropos">
    <h2>À propos du Bénin</h2>
    <p>
        Le Bénin est une terre d’histoire, de traditions et de diversité culturelle. 
        Berceau du royaume du Dahomey et haut lieu du patrimoine vaudou, 
        le pays regorge de rites, d’arts, de langues et de savoir-faire uniques. 
        CultureBénin met en lumière ce patrimoine vivant.
    </p>
</section>

<!-- FEATURES -->
<section class="sections">
    <h2>Pourquoi nous rejoindre ?</h2>
    <div class="features">
        <div class="feature">
            <i class="fa-solid fa-mask"></i>
            <h3>Traditions</h3>
            <p>Découvrez les coutumes, danses et rituels du pays.</p>
        </div>

        <div class="feature">
            <i class="fa-solid fa-drum"></i>
            <h3>Musique & Art</h3>
            <p>Explorez la richesse artistique et musicale du Bénin.</p>
        </div>

        <div class="feature">
            <i class="fa-solid fa-map"></i>
            <h3>Territoires</h3>
            <p>Apprenez l'histoire, les régions et les lieux emblématiques.</p>
        </div>
    </div>
</section>

<footer>
    &copy; {{ date('Y') }} CultureBénin — Tous droits réservés.
</footer>

<!-- Script navbar scroll -->
<script>
    window.addEventListener("scroll", () => {
        const nav = document.getElementById("navbar");
        if (window.scrollY > 50) nav.classList.add("scrolled");
        else nav.classList.remove("scrolled");
    });
</script>

<script src="https://kit.fontawesome.com/a2d9d6c05b.js" crossorigin="anonymous"></script>

</body>
</html>
