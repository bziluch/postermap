import { Controller } from '@hotwired/stimulus';
import L from "leaflet";
import 'leaflet/dist/leaflet.css';

export default class extends Controller {

    static targets = ["map"]

    connect() {
        const map = L.map(this.mapTarget).setView([52.235, 21.000], 12);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
    }
}
