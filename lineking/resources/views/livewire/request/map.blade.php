<div class="mt-5 md:mt-0 md:col-span-2">
    <div id="map" style="width:100%;height:360px;" class="mt-1 rounded-lg shadow-sm"></div>
    <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=070ab20adcdb9a7b504725820ffd152c"></script>
    <script>
        var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
        mapOption = {
            center: new kakao.maps.LatLng(37.566826, 126.9786567), // 지도의 중심좌표
            level: 3 // 지도의 확대 레벨
        };
        //지도를 생성합니다
        var map = new kakao.maps.Map(mapContainer, mapOption);
        
        window.addEventListener('displayPlace', event => {
            var bounds = new kakao.maps.LatLngBounds();
            var placePosition = new kakao.maps.LatLng(event.detail.y, event.detail.x);
            var marker = new kakao.maps.Marker({
                position: placePosition
            });
            bounds.extend(placePosition);
            //마커가 지도 위에 표시되도록 설정합니다
            marker.setMap(map);
            // 검색된 장소 위치를 기준으로 지도 범위를 재설정합니다
            map.setBounds(bounds);
        });
    </script>
</div>