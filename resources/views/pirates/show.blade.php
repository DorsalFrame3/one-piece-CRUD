<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pirate Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('{{ asset('image/one-piece-background.jpg') }}');
            background-size: cover;
            font-family: 'Treasure Map', sans-serif;
        }
        .pirate-details-container {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 30px;
            margin-top: 50px;
        }
        .pirate-details-title {
            text-align: center;
            color: #F7D716;
            text-shadow: 2px 2px 4px #000000;
        }
        .pirate-details-info {
            margin-top: 20px;
            font-size: 18px;
            color: #333;
        }
        .pirate-details-info span {
            font-weight: bold;
        }
       
        .image-container img {
            text-align: center;
            max-width: 100%; /* Ensure the image fits within the container */
            height: auto; /* Maintain aspect ratio */
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 pirate-details-container">
                <h1 class="pirate-details-title">Pirate Details: {{ $pirate->name }}</h1>

                <div class="pirate-details-info">
                    <p><span>Name:</span> {{ $pirate->name }}</p>
                    <p><span>Role:</span> {{ $pirate->role }}</p>
                    <p><span>Bounty:</span> {{ number_format($pirate->bounty) }} Berries</p>
                </div>

                <!-- You can optionally add an image of the pirate if available -->
                @if ($pirate->image)
                    <div class="image-container">
                    <img src="{{ asset('storage/' . $pirate->image) }}" alt="{{ $pirate->name }}" class="pirate-image">
                    </div>
                @endif
                <div class="mt-4 text-center">
                    <a href="{{ route('pirates.index') }}" class="btn btn-secondary">Back to Crew List</a>
                    <a href="{{ route('pirates.edit', $pirate->id) }}" class="btn btn-primary">Edit Pirate</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>