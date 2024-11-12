function fetchWeatherData() {
    const apiKey = 'f8c320633d6543ccb8a161745242410';
    const loadingDiv = document.getElementById('loading');
    const weatherDataDiv = document.getElementById('weatherData');
    const temperatureElem = document.getElementById('temperature');
    const weatherIconElem = document.getElementById('weatherIcon');

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(position => {
            const lat = position.coords.latitude;
            const lon = position.coords.longitude;
            const url = `https://api.weatherapi.com/v1/current.json?key=${apiKey}&q=${lat},${lon}&aqi=no`;

            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    temperatureElem.textContent = `${data.current.temp_c}°C`;

                    const conditionText = data.current.condition.text.toLowerCase();
                    weatherIconElem.src = getWeatherIcon(conditionText);
                    weatherIconElem.style.display = 'block';

                    loadingDiv.style.display = 'none';
                    weatherDataDiv.style.display = 'block';
                })
                .catch(error => {
                    console.error("Error in fetch:", error);
                    loadingDiv.textContent = 'Failed to load weather data.';
                });
        }, error => {
            console.error('Geolocation error:', error);
            loadingDiv.textContent = 'Error accessing location.';
            alert("Geolocation error: Pastikan izin lokasi diberikan dan tersedia.");
        });
    } else {
        alert("Geolocation tidak didukung oleh browser Anda.");
    }
}

function getWeatherIcon(condition) {
    if (condition.includes("clear")) return '{{ asset("assets/gif/clear.gif") }}';
    if (condition.includes("partly cloudy")) return '{{ asset("assets/gif/pcloudy.gif")  }}';
    if (condition.includes("overcast")) return '{{ asset("assets/gif/overcas.gif") }}';
    if (condition.includes("rain")) return '{{ asset("assets/gif/rain.gif") }}';
    if (condition.includes("thunderstorm")) return '{{ asset("assets/gif/storm.gif") }}';
    // if (condition.includes("snow")) return '{{ asset("assets/images/snow.png") }}';
    if (condition.includes("mist") || condition.includes("fog")) return '{{ asset("assets/gif/kabut.gif") }}';
    if (condition.includes("haze")) return '{{ asset("assets/gif/kabut.gif") }}';
    if (condition.includes("windy")) return '{{ asset("assets/gif/windy.gif") }}';
    return '{{ asset("assets/gif/clear.gif") }}';
}

window.onload = function() {
    fetchWeatherData();
}