<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container">
                <a class="navbar-brand" href="{{ route('admin.index') }}">Admin panel</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('admin.index') }}">События</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.showGenres') }}">Жанры</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.showSubgenres') }}">Поджанры</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.showPerformers') }}">Исполнители</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.showEventsPerformers') }}">События-Исполнители</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.showPlaces') }}">Развлекательные центры</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.showCities') }}">Города</a>
                        </li>
                    </ul>
                    <ul class="nav justify-content-end">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('signout') }}">Выход</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
</body>
    @if(session('alert'))
    <script>
        // Display alert based on the type
        var alertType = "{{ session('alert')['type'] }}";
        var alertMessage = "{{ session('alert')['message'] }}";

        if (alertType === 'success') {
            alert(alertMessage);
            // You can customize this part to use a more user-friendly alert library, such as SweetAlert
        } else if (alertType === 'error') {
            alert(alertMessage);
        }
    </script>
    @endif
</html>