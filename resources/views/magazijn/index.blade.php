@vite(['resources/css/app.css', 'resources/js/app.js'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overzicht Magazijn Jamin</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <h3>Overzicht Magazijn Jamin</h3>
                
                <div class="mt-3 d-flex gap-2">   
                    <a href="{{ route('home') }}" class="btn btn-secondary btn-sm me-auto">Terug</a>
                </div>

                <table class="table table-striped table-bordered table-hover mt-4 align-middle shadow-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>Barcode</th>
                            <th>Naam</th>
                            <th class="text-center">Verpakkingseenheid (kg)</th>
                            <th class="text-center">Aantal Aanwezig</th>
                            <th class="text-center">Allergenen Info</th>
                            <th class="text-center">Leverantie Info</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>{{ $product->Barcode }}</td>
                                <td>{{ $product->Naam }}</td>
                                <td class="text-center">{{ $product->VerpakkingsEenheid ?? 'N/A' }}</td>
                                <td class="text-center">
                                    @if($product->AantalAanwezig === null || $product->AantalAanwezig == 0)
                                        <span class="text-danger">0</span>
                                    @else
                                        {{ $product->AantalAanwezig }}
                                    @endif
                                </td>
                                <!-- RED CROSS = ALLERGENEN -->
                                <td class="text-center">
                                    <a href="{{ route('magazijn.allergenenInfo', $product->Id) }}" 
                                       class="btn btn-outline-danger btn-sm" 
                                       title="Allergenen Informatie">
                                        ❌
                                    </a>
                                </td>

                                <!-- QUESTION MARK = LEVERANTIE -->
                                <td class="text-center">
                                    <a href="{{ route('magazijn.leverantieInfo', $product->Id) }}" 
                                       class="btn btn-outline-primary btn-sm" 
                                       title="Leverantie Informatie">
                                        ❓
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Geen producten gevonden</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>