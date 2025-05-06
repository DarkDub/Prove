<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Trabajadores y Mapa</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 300px;
            padding: 20px;
            background-color: #f8f9fa;
            overflow-y: auto;
            border-right: 1px solid #ddd;
        }

        .sidebar h2 {
            margin-top: 0;
        }

        .worker {
            margin-bottom: 15px;
            padding: 10px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        #map {
            flex: 1;
        }

        #map-container {
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="sidebar">
            <h2>Trabajadores</h2>
            @foreach ($trabajadores as $trabajador)
                <div class="worker" onclick="centrarTrabajador({{ $trabajador->id }})">
                    <strong>{{ $trabajador->nombre }}</strong><br>
                    Skill: {{ $trabajador->skill }}
                </div>
            @endforeach
        </div>
    
        <div id="map">
            <div id="map-container"></div>
        </div>
    </div>
    
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        const map = L.map('map-container').setView([4.5709, -74.2973], 6);
    
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);
    
        const trabajadores = @json($trabajadores);
        const marcadores = {};
    
        trabajadores.forEach(t => {
            const marcador = L.marker([t.latitude, t.longitude])
                .addTo(map)
                .bindPopup(`<strong>${t.nombre}</strong><br>Skill: ${t.skill}`);
    
            marcadores[t.id] = marcador;
        });
    
        function centrarTrabajador(id) {
            const marcador = marcadores[id];
            if (marcador) {
                map.setView(marcador.getLatLng(), 14);
                marcador.openPopup();
            }
        }
    </script>
</body>
</html>
