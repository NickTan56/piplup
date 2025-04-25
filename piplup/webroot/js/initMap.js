window.initMap = initializeMap;

let markers = []; // To store all markers with info windows by index

function initializeMap() {
    const defaultLocation = { lat: -37.814, lng: 144.96332 };

    const map = new google.maps.Map(document.getElementById("map"), {
        center: defaultLocation,
        zoom: 13,
        disableDefaultUI: true,
        styles: [
            { featureType: "poi", elementType: "labels", stylers: [{ visibility: "off" }] },
            { featureType: "poi.business", stylers: [{ visibility: "off" }] },
            { featureType: "transit.station", stylers: [{ visibility: "off" }] }
        ]
    });

    const geocoder = new google.maps.Geocoder();

    if (Array.isArray(allPlaces)) {
        allPlaces.forEach((place, index) => {
            if (place.address) {
                geocoder.geocode({ address: place.address }, (results, status) => {
                    if (status === "OK") {
                        const position = results[0].geometry.location;

                        const marker = new google.maps.Marker({
                            position: position,
                            map: map,
                            title: place.name,
                            icon: {
                                url: 'img/piplup.png',
                                scaledSize: new google.maps.Size(50, 50),
                                origin: new google.maps.Point(0, 0),
                                anchor: new google.maps.Point(20, 40)
                            }
                        });

                        const infoWindow = new google.maps.InfoWindow({
                            content: `
                                <strong>Category:</strong> ${place.category}<br>
                                <strong>Subcategory:</strong> ${place.subcategory}<br>
                                <strong>Name:</strong> ${place.name}<br>
                                <strong>Description:</strong> ${place.description}
                            `,
                        });

                        marker.addListener("click", () => {
                            infoWindow.open(map, marker);
                        });

                        // Save both marker and its infoWindow
                        markers[index] = { marker, infoWindow, position };

                        // Hook list row click if it exists
                        const row = document.querySelector(`tr[data-index="${index}"]`);
                        if (row) {
                            row.addEventListener("click", () => {
                                map.setZoom(15);
                                map.setCenter(position);
                                map.panBy(-200, 0);
                                infoWindow.open(map, marker);                                
                            });
                        }
                    } else {
                        console.error(`Geocode failed for: ${place.address} — ${status}`);
                    }
                });
            }
        });
    }
}
