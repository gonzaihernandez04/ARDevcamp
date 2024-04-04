if (document.querySelector("#mapa")) {

    const lat =  -34.542494
    const lng = -58.444624;
   
    const zoom = 17;

  var map = L.map("mapa").setView([lat,lng ], zoom);

  L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution:
      '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
  }).addTo(map);

  L.marker([lat,lng ])
    .addTo(map)
    .bindPopup(`
        <h2 class="mapa__heading">ARGDevCamp &copy;</h2>
        <p class="mapa__texto">Ciudad universitaria - Buenos Aires</p>
    `)
    .openPopup();
}
