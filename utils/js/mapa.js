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
                        icon: customMarkerIcon
                    });

                    const delegacias = [
                        {
                            nome: "1ª Delegacia Regional",
                            lat: -19.91335,
                            lng: -44.08175
                        },
                        {
                            nome: "2° Depart. Policia Civil Contagem", 
                            lat: -19.91640,
                            lng: -44.08091
                        },
                        {
                            nome: "3ª Delegacia de Polícia Civil", 
                            lat: -19.92390,
                            lng: -44.08278
                        }, 
                        {
                            nome: "Delegacia Especializada de Atendimento à Mulher de Contagem-MG", 
                            lat: -19.9340237,
                            lng: -44.0458075
                        }, 
                        {
                            nome: "2ª Delegacia de Polícia Civil de Contagem", 
                            lat: -19.93377, 
                            lng: -44.04438
                        },
                        {
                            nome: "4° Delegacia Distrital de Contagem", 
                            lat: -19.96057, 
                            lng: -44.05667
                        },
                        {
                            nome: "1ª Delegacia Regional de Polícia Civil de Contagem", 
                            lat: -19.96094,
                            lng: -44.02917
                        },
                        {
                            nome: "7a Delegacia de Polícia Civil", 
                            lat: -19.8969478,
                            lng: -44.0464237
                        },
                        {
                            nome: "1° Delegacia de Policia Civil de Contagem", 
                            lat: -19.874866, 
                            lng: -44.020987
                        },
                        {
                            nome: "5° Delegacia de Policia Civil de Contagem", 
                            lat: -19.827738,
                            lng: -44.150117
                        },
                        // Adicione mais delegacias conforme necessário
                    ];

                    // Itere pelo array de delegacias e crie marcadores para cada uma
                    delegacias.forEach(delegacia => {
                        const marker = new google.maps.Marker({
                            position: { lat: delegacia.lat, lng: delegacia.lng },
                            map: map,
                            title: delegacia.nome
                            // Outras opções personalizadas, como ícone personalizado, podem ser adicionadas aqui
                        });
                        const infoWindow = new google.maps.InfoWindow({
                            content: `
                              <div>
                                <h4 class="text-dark" >${delegacia.nome}</h4>
                                <button onclick="showRoute('${delegacia.lat}', '${delegacia.lng}')">Obter Rotas</button>
                              </div>
                            `
                        });

                        marker.addListener("click", () => {
                            infoWindow.open(map, marker);
                        });
                    });
                    function showRoute(lat, lng) {
                        const mapsUrl = `https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}`;
                        window.open(mapsUrl, "_blank");
                    }
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