<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wyniki</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('{{ asset('images/background.png') }}');
            background-size: cover;
            background-position: center;
            color: white;
        }

        .header {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px;
            text-align: center;
        }

        .logo {
            width: 150px;
            margin-bottom: 20px;
        }

        .results-container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 10px;
        }

        .doctor-alert {
            background-color: #FF6347; /* Красный фон для рекомендации к врачу */
            color: white;
            border-radius: 5px;
            padding: 15px;
        }

        .treatment-alert {
            background-color: #FF0000; /* Красный фон для лечения */
            color: white;
            border-radius: 5px;
            padding: 15px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
        <h1>Wyniki</h1>
    </div>
    
    <div class="container mt-5 results-container">
        <ul class="list-group">
            @foreach($scores as $group => $score)
                <li class="list-group-item">Grupa {{ $group }}: {{ $score }} punktów</li>
            @endforeach
        </ul>

        <!-- Сообщение о состоянии здоровья с цветным фоном -->
        @if($message)
            <div class="alert {{ $statusClass }} mt-3">
                {{ $message }}
            </div>
        @endif

        <!-- Лечение на красном фоне -->
        @if($treatment)
            <div class="treatment-alert mt-3">
                {{ $treatment }}
            </div>
        @endif

        @if($doctorRecommendation)
            <div class="doctor-alert mt-3">
                {{ $doctorRecommendation }}
            </div>
        @endif

        <a href="/test" class="btn btn-primary mt-3">Wypełnij jeszcze raz</a>
    </div>
</body>
</html>
