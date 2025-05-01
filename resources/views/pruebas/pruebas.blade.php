<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa de Trabajo</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<!-- Cargar Font Awesome para los iconos -->

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        body {
            margin: 0;
            font-family: sans-serif;
            background: #f8f9fa;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        #map {
            height: 500px;
            width: 90%;
            max-width: 800px;
            margin: 20px auto;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .info {
            margin-top: -10px;
            font-size: 1.1rem;
            color: #333;
        }
    </style>
</head>
<body>

    <h2>Ubicación del Usuario y Trabajador</h2>
    <div id="map"></div>
    <div class="info" id="distancia">Calculando distancia...</div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // Coordenadas de usuario y trabajador, pasadas desde Laravel
        const user = @json($userCoords);
        const worker = @json($workerCoords);

        // Crear mapa con Leaflet
        const map = L.map('map').setView([user.lat, user.lng], 13);

        // Capa de mapa minimalista (CartoDB Positron)
        L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, &copy; <a href="https://carto.com/attributions">CartoDB</a>'
        }).addTo(map);

        // Marcadores
        L.marker([user.lat, user.lng]).addTo(map).bindPopup(`
    <div class="popup-card">
        <i class="${user.icon}" style="font-size: 40px; color: #3498db;"></i>
        <h3>luis</h3>
        <p>Distancia: Calculando...</p>
    </div>
`);
        L.marker([worker.lat, worker.lng]).addTo(map).bindPopup('trabjador');

        // Función para calcular la distancia en km entre dos puntos
        function distanciaKm(lat1, lon1, lat2, lon2) {
            const R = 6371; // Radio de la Tierra en km
            const dLat = (lat2 - lat1) * Math.PI / 180;
            const dLon = (lon2 - lon1) * Math.PI / 180;
            const a = Math.sin(dLat / 2) ** 2 +
                      Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                      Math.sin(dLon / 2) ** 2;
            return (R * 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a))).toFixed(2); // Distancia en km
        }

        // Mostrar la distancia calculada en el elemento con id "distancia"
        const distancia = distanciaKm(user.lat, user.lng, worker.lat, worker.lng);
        document.getElementById('distancia').innerText = `📏 Distancia: ${distancia} km`;
    </script>
</body>
</html>
