<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f7fa;
        }

        .sidebar {
            min-height: 100vh;
            background: #1e293b;
            color: white;
        }

        .sidebar a {
            color: #cbd5e1;
            text-decoration: none;
            display: block;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 8px;
            transition: 0.3s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #334155;
            color: #fff;
        }

        .topbar {
            background: white;
            border-bottom: 1px solid #ddd;
            padding: 15px 20px;
        }

        .card-stat {
            border: none;
            border-radius: 15px;
            color: white;
            padding: 20px;
        }

        .bg-users { background: linear-gradient(135deg, #3b82f6, #1d4ed8); }
        .bg-formations { background: linear-gradient(135deg, #10b981, #047857); }
        .bg-sessions { background: linear-gradient(135deg, #f59e0b, #d97706); }
        .bg-inscriptions { background: linear-gradient(135deg, #ef4444, #b91c1c); }

        .table-container {
            background: white;
            border-radius: 15px;
            padding: 20px;
        }

        .welcome-box {
            background: linear-gradient(135deg, #6366f1, #4338ca);
            color: white;
            border-radius: 15px;
            padding: 25px;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <div class="col-md-2 sidebar p-3">
            <h3 class="mb-4 text-center">Admin Panel</h3>

            <a href="#" class="active"><i class="fa fa-home me-2"></i> Dashboard</a>
            <a href="#"><i class="fa fa-users me-2"></i> Utilisateurs</a>
            <a href="#"><i class="fa fa-book me-2"></i> Formations</a>
            <a href="#"><i class="fa fa-calendar-alt me-2"></i> Sessions</a>
            <a href="#"><i class="fa fa-file-signature me-2"></i> Inscriptions</a>
            <a href="#"><i class="fa fa-user-shield me-2"></i> Rôles</a>
            <a href="#"><i class="fa fa-cog me-2"></i> Paramètres</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger w-100 mt-3">
                    <i class="fa fa-sign-out-alt me-2"></i> Déconnexion
                </button>
            </form>
        </div>

        <div class="col-md-10 p-0">
            <div class="topbar d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Dashboard Administrateur</h4>
                <div>
                    <span class="me-3">
                        Bienvenue,
                        <strong>{{ auth()->user()->nom }} {{ auth()->user()->prenom }}</strong>
                    </span>

                    <span class="badge bg-dark">
                        {{ auth()->user()->role->nom }}
                    </span>
                </div>
            </div>

            <div class="p-4">
                <div class="welcome-box mb-4">
                    <h3>Bienvenue {{ auth()->user()->nom }} 👋</h3>
                    <p class="mb-0">
                        Votre rôle est :
                        <strong>{{ auth()->user()->role->nom }}</strong>
                    </p>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-3">
                        <div class="card-stat bg-users">
                            <h6>Total Utilisateurs</h6>
                            <h2>3</h2>
                            <i class="fa fa-users fa-2x"></i>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card-stat bg-formations">
                            <h6>Total Formations</h6>
                            <h2>1</h2>
                            <i class="fa fa-book fa-2x"></i>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card-stat bg-sessions">
                            <h6>Total Sessions</h6>
                            <h2>1</h2>
                            <i class="fa fa-calendar-alt fa-2x"></i>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card-stat bg-inscriptions">
                            <h6>Total Inscriptions</h6>
                            <h2>1</h2>
                            <i class="fa fa-file-signature fa-2x"></i>
                        </div>
                    </div>
                </div>

                <div class="table-container shadow-sm">
                    <h5 class="mb-3">Informations du compte connecté</h5>

                    <table class="table table-bordered">
                        <tr>
                            <th>Nom</th>
                            <td>{{ auth()->user()->nom }}</td>
                        </tr>
                        <tr>
                            <th>Prénom</th>
                            <td>{{ auth()->user()->prenom }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ auth()->user()->email }}</td>
                        </tr>
                        <tr>
                            <th>Rôle</th>
                            <td>
                                @php
    $role = auth()->user()->role->nom;
@endphp

@if($role === 'administrateur')
    <span class="badge bg-danger">{{ $role }}</span>
@elseif($role === 'formateur')
    <span class="badge bg-success">{{ $role }}</span>
@else
    <span class="badge bg-primary">{{ $role }}</span>
@endif
                            </td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>

    </div>
</div>

</body>
</html>