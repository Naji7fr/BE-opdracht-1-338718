@vite(['resources/css/app.css', 'resources/js/app.js'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overzicht Allergenen</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <h3>Overzicht Allergenen</h3>
                
                <div class="mt-3 d-flex gap-2">   
                    <a href="{{ route('magazijn.index') }}" class="btn btn-secondary btn-sm me-auto">Terug</a>
                </div>

                <!-- Product Info Header -->
                <div class="mt-4 p-3 bg-light rounded">
                    <strong>Naam Product:</strong> {{ $product->Naam ?? 'Onbekend' }}<br>
                    <strong>Barcode:</strong> {{ $product->Barcode ?? 'Onbekend' }}
                </div>

                <!-- Allergens Table -->
                <table class="table table-striped table-bordered table-hover mt-4 align-middle shadow-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>Naam</th>
                            <th>Omschrijving</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($allergens as $allergen)
                            <tr>
                                <td>{{ $allergen->Naam }}</td>
                                <td>{{ $allergen->Omschrijving }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center">
                                    In dit product zitten geen stoffen die een allergische reactie kunnen veroorzaken
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                @if(count($allergens) == 0)
                    <script>
                        setTimeout(function() {
                            // Show redirect message
                            document.body.innerHTML = `
                                <div class="container mt-5">
                                    <div class="row justify-content-center">
                                        <div class="col-md-6 text-center">
                                            <div class="alert alert-info">
                                                <i class="bi bi-arrow-left-circle"></i> U wordt doorverwezen naar het overzicht...
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                            
                            // Redirect after showing message
                            setTimeout(function() {
                                window.location.href = "{{ route('magazijn.index') }}";
                            }, 1500);
                        }, 4000);
                    </script>
                @endif

            </div>
        </div>
    </div>
</body>
</html>