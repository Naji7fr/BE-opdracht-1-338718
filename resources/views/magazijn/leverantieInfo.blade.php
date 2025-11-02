@vite(['resources/css/app.css', 'resources/js/app.js'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Levering Informatie</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <h3>Levering Informatie</h3>
                
                <div class="mt-3 d-flex gap-2">   
                    <a href="{{ route('magazijn.index') }}" class="btn btn-secondary btn-sm me-auto">Terug</a>
                </div>

                <!-- Supplier Info Header -->
                @if($supplier)
                <div class="mt-4 p-3 bg-light rounded">
                    <strong>Naam leverancier:</strong> {{ $supplier->Naam }}<br>
                    <strong>Contactpersoon leverancier:</strong> {{ $supplier->ContactPersoon }}<br>
                    <strong>Leveranciernummer:</strong> {{ $supplier->LeverancierNummer }}<br>
                    <strong>Mobiel:</strong> {{ $supplier->Mobiel }}
                </div>
                @endif

                <!-- Deliveries Table -->
                <table class="table table-striped table-bordered table-hover mt-4 align-middle shadow-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>Datum laatste levering</th>
                            <th>Product Naam</th>
                            <th class="text-center">Aantal</th>
                            <th>Datum eerstvolgende levering</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($deliveries as $delivery)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($delivery->DatumLevering)->format('d-m-Y') }}</td>
                                <td>{{ $product->Naam ?? 'Onbekend' }}</td>
                                <td class="text-center">{{ $delivery->Aantal }}</td>
                                <td>
                                    @if($delivery->DatumEerstVolgendeLevering)
                                        {{ \Carbon\Carbon::parse($delivery->DatumEerstVolgendeLevering)->format('d-m-Y') }}
                                    @else
                                        Niet gepland
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">
                                    Er is van dit product op dit moment geen voorraad aanwezig, de verwachte eerstvolgende levering is: 30-04-2023
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                @if(count($deliveries) == 0)
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