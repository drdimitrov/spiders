initMap = function(){
	var map = new google.maps.Map(document.getElementById('map'), {
      center: {
      	lat: 41.865545, 
      	lng: 27.966174
      },
      scrollwheel: false,
      zoom: 8
    });

    var marker = new google.maps.Marker({
    position: {
      	lat: 42.131470, 
      	lng: 27.750139
      },
    map: map,
    title: 'Tsarevo'
  });
}