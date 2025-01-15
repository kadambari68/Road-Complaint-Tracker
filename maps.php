<?php
// Start the PHP section for server-side logic
session_start();
include("users/includes/config.php");

// Fetch data from the database
$result = mysqli_query($bd, "SELECT latitude, longitude, status FROM tblcomplaints");
$locations = [];
while ($row = mysqli_fetch_assoc($result)) {
    $locations[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map Display</title>
    <!-- Include Leaflet CSS and JavaScript -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <style>
        #map { height: 400px; }
    </style>
</head>
<body>

    <h2>Complaint Status Map</h2>
    <div id="map"></div>

    <!-- Initialize the map and add markers -->
    <script>
        var map = L.map('map').setView([26.2703, 72.8905], 10); // Example coordinates (Jodhpur)

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Pass the PHP data to JavaScript
        var locations = <?php echo json_encode($locations); ?>;

        locations.forEach(function(location) {
            var marker = L.marker([location.latitude, location.longitude]).addTo(map);
            if (location.status === 'solved') {
                marker.bindPopup("Status: Issue resolved").openPopup();
                marker.setIcon(L.icon({ iconUrl: 'https://www.flaticon.com/free-icon/gps_14035502', iconSize: [25, 41], iconAnchor: [12, 41] }));
            } else {
                marker.bindPopup("Status: Under construction").openPopup();
                marker.setIcon(L.icon({ iconUrl: 'https://cdn-icons-png.flaticon.com/128/5690/5690026.png', iconSize: [25, 41], iconAnchor: [12, 41] }));
            }
        });
    </script>

</body>
</html>
