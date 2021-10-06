<div id="map" class="w-full h-60 md:rounded-t-lg"></div>
<script>
    var mapContainer = document.getElementById('map'),
        mapOption = { 
            center: new kakao.maps.LatLng({{$latitude}}, {{$longitude}}),
            level: 5
        };
    var map = new kakao.maps.Map(mapContainer, mapOption);
    var markerPosition  = new kakao.maps.LatLng({{$latitude}}, {{$longitude}}); 
    var marker = new kakao.maps.Marker({
        position: markerPosition
    });
    marker.setMap(map);
</script>