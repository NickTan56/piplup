// Initialize Google Places Autocomplete
function initAutocomplete() {
    const input = document.getElementById('autocomplete');
    const autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.setFields(['address_components', 'geometry', 'icon', 'name']);
    autocomplete.setComponentRestrictions({ country: 'au' });
}

// Load the autocomplete function after the page loads
document.addEventListener('DOMContentLoaded', initAutocomplete);
