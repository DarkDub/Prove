{{-- <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubicación del Trabajador</title>
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map { height: 500px; }
    </style>
</head>
<body>
    <h1>Ubicación del Trabajador</h1>
    <button id="obtenerUbicacion">Obtener mi ubicación</button>
    <div id="map"></div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // Inicializa el mapa (aún sin ubicación)
        let map = L.map('map').setView([0, 0], 13);  // Centro del mapa, lo pondremos en las coordenadas después

        // Cargar los tiles de OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

        // Función para obtener la ubicación
        function obtenerUbicacion() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;
                        
                        // Mostrar la ubicación en el mapa
                        map.setView([lat, lng], 13);  // Centra el mapa en la nueva ubicación
                        
                        // Agregar un marcador con la ubicación
                        L.marker([lat, lng]).addTo(map)
                            .bindPopup("Tu ubicación actual")
                            .openPopup();
                        
                        // Actualizar ubicación en tiempo real
                        actualizarUbicacionEnTiempoReal(lat, lng);
                    },
                    function(error) {
                        alert("No se pudo obtener la ubicación.");
                    }
                );
            } else {
                alert("Geolocalización no soportada en este navegador.");
            }
        }

        // Función para actualizar la ubicación en tiempo real (si el trabajador se mueve)
        function actualizarUbicacionEnTiempoReal(lat, lng) {
            navigator.geolocation.watchPosition(
                function(position) {
                    const newLat = position.coords.latitude;
                    const newLng = position.coords.longitude;
                    
                    // Actualizar el marcador con la nueva ubicación
                    map.setView([newLat, newLng], 13);  // Centra el mapa en la nueva ubicación
                    // Aquí puedes actualizar el marcador si quieres
                },
                function(error) {
                    alert("Error al actualizar la ubicación.");
                },
                { enableHighAccuracy: true, maximumAge: 0, timeout: 5000 }
            );
        }

        // Al hacer clic en el botón, obtener la ubicación
        document.getElementById("obtenerUbicacion").addEventListener("click", obtenerUbicacion);
    </script>
</body>
</html> --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Geolocalización del Trabajador</title>
    <!-- Agregar Leaflet.js -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        #map {
            height: 500px;
            width: 100%;
        }
        .container {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Geolocalización del Trabajador</h2>
        <p>Tu ubicación se actualizará periódicamente en el mapa.</p>
        <div id="map"></div>
    </div>

    <!-- Script de Leaflet y Geolocalización -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        let map, marker;

        // Función para inicializar el mapa
        function initMap() {
            map = L.map('map').setView([0, 0], 13); // Inicializa el mapa en coordenadas (0,0)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
        }

        // Función para actualizar la ubicación del trabajador
        function updateLocation(latitude, longitude) {
            if (marker) {
                marker.setLatLng([latitude, longitude]); // Mueve el marcador
            } else {
                marker = L.marker([latitude, longitude]).addTo(map); // Agrega un nuevo marcador
            }
            map.setView([latitude, longitude], 13); // Centra el mapa en la nueva ubicación

            // Enviar la ubicación al backend
            fetch('/api/actualizar-ubicacion', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    trabajador_id: 1, // Cambia esto por el ID real del trabajador
                    latitude: latitude,
                    longitude: longitude
                })
            }).then(response => response.json())
              .then(data => {
                  console.log("Ubicación actualizada:", data);
              }).catch(error => {
                  console.error("Error al actualizar la ubicación:", error);
              });
        }

        // Función para obtener la ubicación del trabajador
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition((position) => {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;
                    console.log(`Ubicación del trabajador: Lat: ${latitude}, Lng: ${longitude}`);
                    updateLocation(latitude, longitude);
                }, (error) => {
                    console.error("Error obteniendo la ubicación:", error);
                    alert("No se pudo obtener la ubicación.");
                });
            } else {
                alert("Geolocalización no soportada por este navegador.");
            }
        }

        // Iniciar el mapa
        initMap();

        // Obtener la ubicación inicial
        getLocation();

        // Actualizar la ubicación cada 10 segundos
        setInterval(() => {
            getLocation();
        }, 10000); // Actualizar cada 10 segundos
    </script>
</body>
</html>
