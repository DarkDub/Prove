<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mapa de Trabajadores</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Leaflet CSS -->
    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
    />

    <style>
        #map {
            height: 100vh;
            width: 100%;
        }
    </style>
</head>
<body>

<div id="map"></div>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

<script>
    // Inicializa el mapa centrado en Colombia
    const map = L.map('map').setView([4.60971, -74.08175], 12); // Bogotá

    // Capa base (mapa visual)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Obtener ubicaciones desde Laravel
    fetch('https://97b8-190-61-55-169.ngrok-free.app/api/ubicaciones-trabajadores')
    .then(response => response.json())
    .then(trabajadores => {
        trabajadores.forEach(t => {
            if (t.latitude && t.longitude) {
                L.marker([t.latitude, t.longitude])
                    .addTo(map)
                    .bindPopup(`<strong>${t.nombre}</strong>`);
            }
        });
    })
    .catch(error => {
        console.error('Error al obtener los trabajadores:', error);
    });

</script>

</body>
</html>
