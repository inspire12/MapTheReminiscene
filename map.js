var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
mapOption = {
	center : new daum.maps.LatLng(36.3620549, 127.3514235), // 지도의 중심좌표 
	level: 2, // 지도의 확대 레벨
	mapTypeId : daum.maps.MapTypeId.ROADMAP // 지도종류
}; 

// 지도를 생성한다 
var map = new daum.maps.Map(mapContainer, mapOption),
	customOverlay = new daum.maps.CustomOverlay({}),
	infowindow = new daum.maps.InfoWindow({removable: true}); 

var zoomControl = new daum.maps.ZoomControl();
	map.addControl(zoomControl, daum.maps.ControlPosition.RIGHT);

var Positions = [];
var i;
var markers = [];

dbGet();

function dbGet()
{
	// 지도 영역정보를 얻어옵니다 
    var bounds = map.getBounds();
    
    // 영역정보의 남서쪽 정보를 얻어옵니다 
    var swLatlng = bounds.getSouthWest();
    
    // 영역정보의 북동쪽 정보를 얻어옵니다 
    var neLatlng = bounds.getNorthEast();    
    console.log("./MapDBGet.php?latLow="+swLatlng.getLat()+"&latHigh="+neLatlng.getLat()+"&lngLow="+swLatlng.getLng()+"&lngHigh="+neLatlng.getLng());
    
   	var request = new XMLHttpRequest(); // XMLHttpRequest 생성
		request.open("GET", "./MapDBGet.php?latLow="+swLatlng.getLat()+"&latHigh="+neLatlng.getLat()+"&lngLow="+swLatlng.getLng()+"&lngHigh="+neLatlng.getLng(), true); // 데이터를 GET Method로 요청
		request.send(null);
		request.onreadystatechange = function() {
			if ( request.readyState === 4 && request.status === 200 ) { // request가 끝났으며(4), 성공적(200)인 경우.
				for (i = 0; i < markers.length; i++)
				{
					markers[i].setMap(null);
				}

				console.log(request.responseText);
				Positions = JSON.parse(request.responseText); // #content 태그 내의 내용을 받아온 텍스트로 교체.
				
				for (i = 0; i < Positions.length; i++)
				{
					displayArea(Positions[i]);
				}
			}
		}
}

function displayArea(area)
{
	var circle = new daum.maps.Circle({
	    center : new daum.maps.LatLng(Positions[i].lat, Positions[i].lng),  // 원의 중심좌표 입니다 
	    radius: 4, // 미터 단위의 원의 반지름입니다 
	    strokeOpacity: 0, // 선의 불투명도 입니다 1에서 0 사이의 값이며 0에 가까울수록 투명합니다
	    fillColor: '#000000', // 채우기 색깔입니다
	    fillOpacity: 0.7  // 채우기 불투명도 입니다   
	});

	circle.setMap(map); 

	daum.maps.event.addListener(circle, 'mouseover', function(mouseEvent) {
        customOverlay.setContent('<div class="mapOveray"><ul><li>' + area.pre3 + 
			'<li>' + area.pre2 + '<li>' + area.pre1 + '<li class="current">' + area.current +'</ul></div>');
        
        customOverlay.setPosition(mouseEvent.latLng); 
        customOverlay.setMap(map);
    });

	daum.maps.event.addListener(circle, 'mousemove', function(mouseEvent) {
        customOverlay.setPosition(mouseEvent.latLng); 
    });

	daum.maps.event.addListener(circle, 'mouseout', function() {
        customOverlay.setMap(null);
    }); 
	// circle를 클릭햇을때 일어나는 행동.
	daum.maps.event.addListener(circle, 'click', function(mouseEvent) {
//		var open = window.open('','_blank');
//        open.location.href="./building.php?"+area.building_no;
		var ptest = document.getElementById("ptesT");
		ptest.bPopup({
		//	content:'iframe',
			contentContainer:'.content',
			loadUrl:'./building.php?'+area.building_no
		});
    });

    markers.push(circle);
}

// 마우스 드래그로 지도 이동이 완료되었을 때 마지막 파라미터로 넘어온 함수를 호출하도록 이벤트를 등록합니다
daum.maps.event.addListener(map, 'dragend', function() {        
    
    dbGet();
    
});

// 지도가 확대 또는 축소되면 마지막 파라미터로 넘어온 함수를 호출하도록 이벤트를 등록합니다
daum.maps.event.addListener(map, 'zoom_changed', function() {        
    
    dbGet();
    
});

// 맵에 우클릭 이벤트를 등록한다 (우클릭 : rightclick)
daum.maps.event.addListener(map, 'rightclick', function(mouseEvent) {
	var html_latlng = document.getElementById("popupTestContents");
	html_latlng.innerHTML = "<a href='./buildingAddForm.php?lat="+mouseEvent.latLng.getLat()+"&lng="+mouseEvent.latLng.getLng()+"' target='_blank'>"+mouseEvent.latLng+"</a>";
	//console.log(mouseEvent.latLng);
});

function toggleOverlay(){
	var overlay = document.getElementById('overlay');
	var specialBox = document.getElementById('current');
	overlay.style.opacity = .8;
	if(overlay.style.display == "block"){
		overlay.style.display = "none";
		specialBox.style.display = "none";
	} else {
		overlay.style.display = "block";
		specialBox.style.display = "block";
	}
}
