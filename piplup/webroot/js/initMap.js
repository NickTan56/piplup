window.initMap = initializeMap;

function initializeMap() {
    // Initialize the map centered at a default location
    const defaultLocation = { lat: -37.814, lng: 144.96332 }; // Example: Melbourne CBD
    const map = new google.maps.Map(document.getElementById("map"), {
        center: defaultLocation,
        zoom: 13,
        styles: [
            {
                featureType: "poi",
                elementType: "labels",
                stylers: [{ visibility: "off" }]
            },
            {
                featureType: "poi.business",
                stylers: [{ visibility: "off" }]
            },
            {
                featureType: "transit.station",
                stylers: [{ visibility: "off" }]
            }
        ],
        disableDefaultUI: true
    });

    const geocoder = new google.maps.Geocoder();

    // Add pins for all places by geocoding their addresses
    if (Array.isArray(allPlaces)) {
        allPlaces.forEach(place => {
            if (place.address) {
                geocodeAddress(
                    geocoder,
                    map,
                    place.address,
                    place.category,
                    place.subcategory,
                    place.name,
                    place.description
                );
            }
        });
    }
}

// Function to geocode an address and create a pin
function geocodeAddress(geocoder, map, address, category, subcategory, name, description) {
    geocoder.geocode({ address: address }, (results, status) => {
        if (status === "OK") {
            const position = results[0].geometry.location;
            createPin(map, position, category, subcategory, name, description);
        } else {
            console.error(`Geocode was not successful for the following reason: ${status}`);
        }
    });
}

function createPin(map, position, category, subcategory, name, description) {
    const marker = new google.maps.Marker({
        position: position,
        map: map,
        title: name,
        icon: {
            url: 'img/piplup.png', // adjust this path to your actual image location
            scaledSize: new google.maps.Size(50, 50), // resize the icon as needed
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(20, 40) // center-bottom anchor
        }
    });

    const infoWindow = new google.maps.InfoWindow({
        content: `
            <strong>Category:</strong> ${category}<br>
            <strong>Subcategory:</strong> ${subcategory}<br>
            <strong>Name:</strong> ${name}<br>
            <strong>Description:</strong> ${description}
        `,
    });

    marker.addListener("click", () => {
        infoWindow.open(map, marker);
    });
}
