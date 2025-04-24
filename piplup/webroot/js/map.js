document.addEventListener("DOMContentLoaded", () => {
    const map = L.map('map').setView([-37.818, 144.9646], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    L.marker([-37.825, 144.936]).addTo(map)
        .bindPopup('Game4Padel<br>Pickleball courts')
        .openPopup();
});
