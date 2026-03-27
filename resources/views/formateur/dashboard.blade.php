<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Formateur</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f7fa;
        }

        .sidebar {
            min-height: 100vh;
            background: #0f172a;
            color: white;
        }

        .sidebar a {
            color: #cbd5e1;
            display: block;
            padding: 12px;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .sidebar a:hover {
            background: #1e293b;
            color: white;
        }

        .topbar {
            background: white;
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }

        .card-stat {
            border-radius: 15px;
            color: white;
            padding: 20px;
        }

        .bg-blue { background: #4F3673; }
        .bg-green { background: #8451A6; }
        .bg-orange { background: #AE7CB7; }

        .box {
            background: white;
            border-radius: 15px;
            padding: 20px;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        <div class="col-md-2 sidebar p-3">
            <h4 class="text-center mb-4">Formateur</h4>

            <a href="#"><i class="fa fa-home me-2"></i> Dashboard</a>
            <a href="#"><i class="fa fa-book me-2"></i> Mes formations</a>
            <a href="#"><i class="fa fa-calendar me-2"></i> Sessions</a>
            <a href="#"><i class="fa fa-users me-2"></i> Apprenants</a>

            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf
                <button class="btn btn-danger w-100">Logout</button>
            </form>
        </div>

        <!-- Content -->
        <div class="col-md-10 p-0">

            <!-- Topbar -->
            <div class="topbar d-flex justify-content-between">
                <h4>Dashboard Formateur</h4>

                <div>
                    👋 {{ auth()->user()->nom }}
                    <span class="badge bg-success ms-2">
                        {{ auth()->user()->role->nom }}
                    </span>
                </div>
            </div>

            <div class="p-4">

                <!-- Welcome -->
                <div class="box mb-4">
                    <h5>Bienvenue {{ auth()->user()->nom }}</h5>
                    <p>Vous pouvez gérer vos formations et sessions ici.</p>
                </div>

                <!-- Stats -->
                <div class="row g-4 mb-4">

                    <div class="col-md-4">
                        <div class="card-stat bg-blue">
                            <h6>Mes formations</h6>
                            <h2>{{ $formations ?? 0 }}</h2>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card-stat bg-green">
                            <h6>Mes sessions</h6>
                            <h2>{{ $sessions ?? 0 }}</h2>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card-stat bg-orange">
                            <h6>Apprenants</h6>
                            <h2>{{ $apprenants ?? 0 }}</h2>
                        </div>
                    </div>

                </div>

                <!-- Table -->
                <div class="box">
                    <h5>Mes dernières formations</h5>

                    <table class="table mt-3">
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Niveau</th>
                                <th>Tarif</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($mesFormations ?? [] as $f)
                                <tr>
                                    <td>{{ $f->titre }}</td>
                                    <td>{{ $f->niveau }}</td>
                                    <td>{{ $f->tarif }} DT</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">Aucune formation</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
</div>

</body>
</html>