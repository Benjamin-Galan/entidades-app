<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body>
    <div class="container mx-auto mt-5 p-4">
        <h1 class="text-3xl font-semibold mb-6 text-center">Extracción de Entidades Predominantes</h1>

        <form id="entidadForm" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
            <div class="mb-4">
                <label for="url" class="block text-lg font-medium text-gray-700">Ingresa una URL:</label>
                <input type="text"
                    class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    id="url" name="url" required>
            </div>
            <button type="submit"
                class="w-full py-2 bg-blue-500 text-white rounded-lg font-semibold hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Enviar</button>
        </form>

        <div id="resultados" class="mt-8">
            <h2 class="text-2xl font-semibold text-center mb-4">Resultados</h2>
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-lg font-medium text-gray-700">Entidad</th>
                        <th class="px-6 py-3 text-left text-lg font-medium text-gray-700">Relevancia</th>
                    </tr>
                </thead>
                <tbody id="tabla-resultados">
                    <!-- Acá se añaden los resultados con jquery -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#entidadForm').on('submit', function(event) {
                event.preventDefault();
    
                var url = $('#url').val();
    
                $.ajax({
                    url: '/procesar',
                    method: 'POST',
                    data: {
                        url: url,
                        _token: '{{ csrf_token() }}'
                    },
    
                    success: function(response) {
                        $('#tabla-resultados').empty();
                        response.forEach(function(entidad) {
                            $('#tabla-resultados').append('<tr class="border-b hover:bg-gray-50"><td class="px-6 py-4 text-gray-800">' + entidad.nombre + '</td><td class="px-6 py-4 text-gray-600">' + entidad.saliencia + '</td></tr>');
                        });
                    },
    
                    error: function() {
                        alert('Ocurrió un error al procesar la solicitud.');
                    }
                });
            });
        });
    </script>

</body>

</html>