<!-- resources/views/ubicacion.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Ubicación en tiempo real</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map { height: 500px; width: 100%; }
    </style>
</head>
<body>
    <h2>Mi ubicación en tiempo real</h2>
    <div id="map"></div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        let map, marker;

        function initMap(lat, lng) {
            map = L.map('map').setView([lat, lng], 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap'
            }).addTo(map);

            marker = L.marker([lat, lng]).addTo(map)
                .bindPopup("Estás aquí").openPopup();
        }

        function updateMarker(lat, lng) {
            marker.setLatLng([lat, lng]);
            map.setView([lat, lng], map.getZoom());
        }

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;

                initMap(lat, lng);

                // Detectar movimiento y actualizar
                navigator.geolocation.watchPosition((pos) => {
                    const newLat = pos.coords.latitude;
                    const newLng = pos.coords.longitude;
                    updateMarker(newLat, newLng);

                    // (Opcional) Enviar al servidor:
                    /*
                    fetch('/api/actualizar-ubicacion', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ latitude: newLat, longitude: newLng })
                    });
                    */
                });
            }, () => {
                alert("No se pudo obtener tu ubicación.");
            });
        } else {
            alert("Tu navegador no soporta geolocalización.");
        }
    </script>
</body>
</html>
