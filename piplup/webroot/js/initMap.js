window.initMap = initializeMap;

let markers = [];
let activeInfoWindow = null;

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
                                <div style="
                                    font-family: 'Pixelify Sans', sans-serif;
                                    background: #ffffff;
                                    padding: 14px;
                                    border: 3px solid #303030;
                                    border-radius: 5px;
                                    font-size: 14px;
                                    color: #303030;
                                    max-width: 280px;
                                    white-space: pre-line;
                                ">
                                    <div class="fw-bold">Category:</div>${place.category}

                                    <div class="fw-bold">Subcategory:</div>${place.subcategory}

                                    <div class="fw-bold">Name:</div>${place.name}

                                    <div class="fw-bold">Description:</div>${place.description}
                                </div>
                            `,
                        });

                        marker.addListener("click", () => {
                            if (activeInfoWindow) activeInfoWindow.close();
                            infoWindow.open(map, marker);
                            activeInfoWindow = infoWindow;
                        });

                        markers[index] = { marker, infoWindow, position };

                        const row = document.querySelector(`tr[data-index="${index}"]`);
                        if (row) {
                            row.addEventListener("click", () => {
                                if (activeInfoWindow) activeInfoWindow.close();
                                map.setZoom(15);
                                map.setCenter(position);
                                map.panBy(-200, 0);
                                infoWindow.open(map, marker);
                                activeInfoWindow = infoWindow;
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
