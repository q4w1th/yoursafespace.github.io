<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('{{ asset('images/background.png') }}'); 
            background-size: cover;
            background-position: center;
            color: black; 
        }

        .header {
            background-color: rgba(0, 0, 0, 0.5); 
            padding: 20px;
            text-align: center;
        }

        .logo {
            width: 300px;
            margin-bottom: 20px;
        }

        .survey-container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 10px;
        }

        .form-check-label {
            color: black; 
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo"> 
        <h1>Anonimowa ankieta sprawdzająca stan psychiczny</h1>
    </div>
    
    <div class="container mt-5 survey-container">
        <form method="POST" action="/test">
            @csrf
            @foreach($questions as $index => $question)
                <div class="mb-3">
                    <p>{{ $index + 1 }}. {{ $question['text'] }}</p>
                    <input type="hidden" name="answers[{{ $index }}][group]" value="{{ $question['group'] }}">
                    <div class="d-flex justify-content-between">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="answers[{{ $index }}][score]" value="-1" required>
                            <label class="form-check-label">Zdecydowanie nie</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="answers[{{ $index }}][score]" value="0">
                            <label class="form-check-label">Raczej nie</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="answers[{{ $index }}][score]" value="1">
                            <label class="form-check-label">Raczej tak</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="answers[{{ $index }}][score]" value="2">
                            <label class="form-check-label">Zdecydowanie tak</label>
                        </div>
                    </div>
                </div>
            @endforeach
            <button type="submit" class="btn btn-primary">Wyślij</button>
        </form>
    </div>
</body>
</html>
