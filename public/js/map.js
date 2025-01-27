    function addMarker(lat, lng) {
    locations.forEach(location => {
        L.marker([location.latitude, location.longitude])
            .addTo(map)
            .bindPopup(`<b>${location.name}</b><br>${location.description}`);
    });
}