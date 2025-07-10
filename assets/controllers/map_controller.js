import { Controller } from '@hotwired/stimulus';
import L from "leaflet";
import 'leaflet/dist/leaflet.css';

let map;

export default class extends Controller {

    static targets = ["map"]

    connect() {
        map = L.map(this.mapTarget);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

        if ("geolocation" in navigator) {
            /* geolocation is available */
            let setPosition = false

            navigator.geolocation.getCurrentPosition((position) => {
                // doSomething(position.coords.latitude, position.coords.longitude);
                map.setView([position.coords.latitude, position.coords.longitude], 13);
                setPosition = true
            });

            if (!setPosition) {
                /* geolocation IS NOT set */
                map.setView([52.2297, 21.0122], 13);
            }

        } else {
            /* geolocation IS NOT available */
            map.setView([52.2297, 21.0122], 13);
        }

        map.on('click', function(e) {
            const lat = e.latlng.lat.toFixed(6);
            const lng = e.latlng.lng.toFixed(6);

            const popupContent = `
                Współrzędne:<br>
                Lat: ${lat}<br>
                Lng: ${lng}<br><br>
                <a class="btn btn-primary btn-sm" href="/poster/new?lat=${lat}&lng=${lng}">
                  ➕ Dodaj plakat tutaj
                </a>
            `;

            L.popup()
                .setLatLng(e.latlng)
                .setContent(popupContent)
                .openOn(map);
        });

    }


}
