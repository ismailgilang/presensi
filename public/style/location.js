
if ("geolocation" in navigator) {
    var options = {
        enableHighAccuracy: true, // Mencoba menggunakan metode yang lebih akurat
        timeout: 10000, // Batas waktu (dalam milidetik) sebelum panggilan dianggap gagal
        maximumAge: 0 // Maksimum umur cache lokasi (dalam milidetik)
    };
    navigator.geolocation.getCurrentPosition(function(position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;
        var locationInput = document.getElementById("locationInput");
        locationInput.value = "https://www.google.com/maps?q=" + latitude + "," + longitude;
        locationInput.setAttribute("target", "_blank"); // Buka link di tab baru
    }, function(error) {
        console.error("Kesalahan saat mendapatkan lokasi:", error);
    }, options);
} else {
    console.log("Geolocation tidak didukung oleh browser Anda.");
}

