$(document).ready(function () {
    function initMap() {
        const mapOptions = {
            center: { lat: -19.9318, lng: -44.0530 }, // Coordenadas do centro do mapa (Contagem, MG)
            zoom: 12, // Nível de zoom
        };

        const map = new google.maps.Map(document.getElementById("map-container"), mapOptions);

        let userMarker;

        // Verificar se o navegador suporta geolocalização
        if (navigator.geolocation) {
            // Usar watchPosition para rastrear a localização do usuário em tempo real
            const watchId = navigator.geolocation.watchPosition(
                function (position) {
                    const userLocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    // Remover o marcador anterior da localização do usuário, se existir
                    if (userMarker) {
                        userMarker.setMap(null);
                    }

                    // Criar um marcador para representar a localização do usuário
                    const customMarkerIcon = '/blaco/utils/img/person-circle.svg';
                    userMarker = new google.maps.Marker({
                        position: userLocation,
                        map: map,
                        icon:customMarkerIcon
                    });

                    // Definir o centro do mapa para a localização do usuário
                    map.setCenter(userLocation);
                },
                function (error) {
                    console.error("Erro ao obter a localização do usuário:", error);
                }
            );
        } else {
            // O navegador não suporta geolocalização
            console.error("Geolocalização não suportada pelo navegador.");
        }

        // Adicionar um ouvinte de evento para o botão "Centralizar"
        $('#centerButton').on('click', function () {
            if (userMarker && map) {
                // Centralizar o mapa na localização do usuário
                map.panTo(userMarker.getPosition());
            }
        });
    }

    // Verifique se a API do Google Maps já foi carregada
    if (typeof google === 'object' && typeof google.maps === 'object') {
        // A API já está carregada, inicialize o mapa
        initMap();
    } else {
        // A API ainda não foi carregada, espere até que ela esteja disponível
        window.initMap = initMap;
    }
});