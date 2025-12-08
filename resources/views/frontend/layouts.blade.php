<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Culture Bénin</title>

    <link rel="stylesheet" href="{{ asset('css/frontend.css') }}">
</head>
<body>

<header class="main-header">
    <div class="container">
        <h1 class="logo">Culture Bénin</h1>
        <nav>
            <ul class="menu">
                <li><a href="{{ route('accueil') }}">Accueil</a></li>
                <li><a href="{{ route('contenus.index.front') }}">Contenus</a></li>
                <li><a href="#">Régions</a></li>
                <li><a href="#">Langues</a></li>
            </ul>
        </nav>
    </div>
</header>

<main style="margin-top: 100px;">
    @yield('content')
</main>

<footer class="footer">
    © {{ date('Y') }} Culture Bénin — Tous droits réservés
</footer>

</body>
</html>
