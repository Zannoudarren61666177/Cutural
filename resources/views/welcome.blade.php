@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<style>
    /* Style moderne / glass effect */
    .card-modern {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(12px);
        border-radius: 18px;
        padding: 25px;
        border: 1px solid rgba(255, 255, 255, 0.25);
        transition: .3s;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }
    .card-modern:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 26px rgba(0,0,0,0.15);
    }
    .card-icon {
        font-size: 45px;
        opacity: 0.8;
    }
    .section-title {
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 12px;
    }
</style>

<div class="container-fluid">

    <!-- Statistiques -->
    <div class="row">

        <div class="col-md-3 mb-4">
            <div class="card-modern text-white" style="background: linear-gradient(135deg, #4b79a1, #283e51);">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3>{{ $totalContenus }}</h3>
                        <p>Contenus culturels</p>
                    </div>
                    <i class="fas fa-book card-icon"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card-modern text-white" style="background: linear-gradient(135deg, #56ab2f, #a8e063);">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3>{{ $totalLangues }}</h3>
                        <p>Langues nationales</p>
                    </div>
                    <i class="fas fa-language card-icon"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card-modern text-white" style="background: linear-gradient(135deg, #ff9966, #ff5e62);">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3>{{ $totalRegions }}</h3>
                        <p>Régions enregistrées</p>
                    </div>
                    <i class="fas fa-map card-icon"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card-modern text-white" style="background: linear-gradient(135deg, #8360c3, #2ebf91);">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3>{{ $totalUsers }}</h3>
                        <p>Utilisateurs inscrits</p>
                    </div>
                    <i class="fas fa-users card-icon"></i>
                </div>
            </div>
        </div>

    </div>

    <!-- Graphique + Derniers contenus -->
    <div class="row">

        <div class="col-md-8 mb-4">
            <div class="card-modern">
                <div class="section-title">Statistiques des contenus</div>
                <canvas id="chartContenus"></canvas>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card-modern">
                <div class="section-title">Derniers contenus</div>

                @foreach ($lastContenus as $contenu)
                    <div class="d-flex justify-content-between mb-3">
                        <strong>{{ Str::limit($contenu->titre, 20) }}</strong>
                        <small class="text-muted">{{ $contenu->created_at->diffForHumans() }}</small>
                    </div>
                @endforeach

            </div>
        </div>

    </div>

</div>

<!-- ChartJS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('chartContenus');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($chartLabels),
            datasets: [{
                label: 'Contenus ajoutés',
                data: @json($chartData),
                borderWidth: 3,
                borderColor: '#4b79a1',
                tension: 0.4
            }]
        }
    });
</script>

@endsection
