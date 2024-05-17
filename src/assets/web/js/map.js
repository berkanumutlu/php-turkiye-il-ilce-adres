(g => {
    var h, a, k, p = "The Google Maps JavaScript API", c = "google", l = "importLibrary", q = "__ib__", m = document,
        b = window;
    b = b[c] || (b[c] = {});
    var d = b.maps || (b.maps = {}), r = new Set, e = new URLSearchParams,
        u = () => h || (h = new Promise(async (f, n) => {
            await (a = m.createElement("script"));
            e.set("libraries", [...r] + "");
            for (k in g) e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[k]);
            e.set("callback", c + ".maps." + q);
            a.src = `https://maps.${c}apis.com/maps/api/js?` + e;
            d[q] = f;
            a.onerror = () => h = n(Error(p + " could not load."));
            a.nonce = m.querySelector("script[nonce]")?.nonce || "";
            m.head.append(a)
        }));
    d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u().then(() => d[l](f, ...n))
})({
    key: "AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg",// YOUR_API_KEY
    v: "weekly",
    // callback: 'initMap'
    // Use the 'v' parameter to indicate the version to use (weekly, beta, alpha, etc.).
    // Add other bootstrap parameters as needed, using camel case.
});

let mapObject;

async function initMap(selector, latitude, longitude, coords, bounds) {
    // Request needed libraries.
    const {Map, Polygon} = await google.maps.importLibrary("maps");
    mapObject = new Map(selector, {
        center: {lat: latitude, lng: longitude},
        zoom: 8,
        mapTypeId: "terrain"
    });
    // Define the options for the polygon.
    let polygonOpts = {
        bounds: {north: bounds[0], south: bounds[1], west: bounds[2], east: bounds[3]},
        paths: [],
        strokeColor: "#FF0000",
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: "#FF0000",
        fillOpacity: 0.35,
    };
    // Define the LatLng coordinates for the polygon's path.
    for (let i = 0; i < coords.length; i++) {
        polygonOpts.paths.push({lat: coords[i][0], lng: coords[i][1]});
    }
    // Construct the polygon.
    let polygon = new Polygon(polygonOpts);
    polygon.setMap(mapObject);
}

// window.initMap = initMap;