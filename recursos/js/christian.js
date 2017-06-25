
//Variables Globales
var latitudgloorigen;
var longitudgloorigen;
var latitudglodestino;
var longitudglodestino;
var longitudpunto;
var latitudpunto;

var PuntoLatlng;
var map;
var salto = 0 ;

//Trazar Ruta
url_base= 'https://maps.googleapis.com/maps/api/distancematrix/json?origins=';
url_destino='&destinations=';
var url_ok;
//
//Geocoding Inverso
url_base_geocoding = 'https://maps.googleapis.com/maps/api/geocode/json?';
url_lugar ='address=';
var url_geocoding_ok;
var direccion_ok;
//
//Key ApiGoogle
url_key = '&key=AIzaSyBtN8tuxmc0L7v_AzrfJj1znoH7dMvsEkQ';
//
//eventos
var event_click_marker;
var datos_geocoding;
//Cargar Mapa
//
var markers = [];


var id_div;


//window.onload = function (){


function inicio_map(){
  //var myLatlng = {lat: -28.4595997, lng: -65.7825866};
  var myLatlng = new google.maps.LatLng(-28.4595997,-65.7825866);
  //map = new GMaps({el: '#map',lat: -28.4595997,lng: -65.7825866});

  map = new google.maps.Map(document.getElementById('map'), {
    zoom: 15,
    disableDefaultUI: true,
    center: myLatlng
  });

  

  /*if (true) {
     map.addListener('click', function(event) {
          addMarker(event.latLng);
          alert(event.latLng);
        });
  };
 */

  //infoWindow = new google.maps.InfoWindow();
   




}




function punto_obten_direccion(){
  
  var punto = document.getElementById('Punto').value;
  geocoder(punto,'geocodificacion',1);

}

function geocoder(punto,tipo = 'geocodificacion',funcion,input = false){
//'latLng': latlng si lo que queremos ejecutar en geocodificación inversa

  var geocoder = new google.maps.Geocoder();
  // Función completa de Geocoding
  if(tipo == "geocodificacion"){
    
      geocoder.geocode({'address': punto}, 
        function (results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
              var latitud = results[0].geometry.location.lat().toFixed(6);
              var longitud = results[0].geometry.location.lng().toFixed(6);
              var direccion = results[0].formatted_address;
              switch(funcion) {
                  case 1:
                      PuntoLatlng = new google.maps.LatLng(latitud,longitud);
                      agregar_Marker(PuntoLatlng,true);
                      break;
                  case 2:
                      break;    
                }
            }
        else {
          alert('Geocode no tuvo éxito por la siguiente razón: ' + status);
           }
      });
  }
  if (tipo == "inversa") {
    
      geocoder.geocode({'latLng': punto}, 
        function (results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
            console.log(results);
              var latitud = results[0].geometry.location.lat().toFixed(6);
              var longitud = results[0].geometry.location.lng().toFixed(6);
              var direccion = results[0].formatted_address;
              switch(funcion) {
                  case 1:
                      PuntoLatlng = new google.maps.LatLng(latitud,longitud);
                      agregar_Marker(PuntoLatlng,true);
                      break;
                  case 2:
                      
                      escribir_input(input,direccion);
                      break;    
                }
            }
        else {
          alert('Geocode no tuvo éxito por la siguiente razón: ' + status);
           }
      });
  };
 
}


function habilita_seleccion_mapa(){
  id_div = document.getElementById("Punto");
  id_boton_dibujar = document.getElementById("boton_dibujar_punto");
  for (i=0;i<document.puntos.radio_button.length;i++){ 
      if (document.puntos.radio_button.checked) 
        break; 
      }

  input = document.puntos.radio_button;
  if (input.value == "punto_") {
      
      id_div.disabled = true; 
      id_div.value = "";
      id_boton_dibujar.disabled = true;
      
    event_click_marker = map.addListener('click', function(event) {
      
      if (input.value == "punto_") {
          
          agregar_Marker(event.latLng);
          geocoder(event.latLng,'inversa',2,id_div);
      }
      if (input.value == "ruta_origen") {
                      
      }
      if (input.value == "ruta_destino") {
                  
      }

    });
    
  }
  else{
    //google.maps.event.clearInstanceListeners(map);
    id_div.disabled = false;
    id_boton_dibujar.disabled = false;
     
    google.maps.event.removeListener(event_click_marker);
  }
  

}

function agregar_Marker(location,centrar = false){
  
  
  marker = new google.maps.Marker({
       
        position: location,
        map: map,
        animation:google.maps.Animation.DROP,
        draggable:true,
        title: 'Punto'
    });
  if(centrar == true){
    map.setCenter(marker.getPosition());
  }

  google.maps.event.addListener(marker, 'click', (function(marker) {
        return function() {
          
          geocoder(marker.getPosition(),'inversa',2,id_div);
          
        }
      })(marker));
  google.maps.event.addListener(marker, 'dragend', (function(marker) {
        return function() {
          geocoder(marker.getPosition(),'inversa',2,id_div);
        }
      })(marker));

  markers.push(marker);
  /*alert(marker.getPosition());
  marker.addListener('click', function() {
          
          alert(marker.getPosition());
        });
  /*markers.push(marker);

  for (var i = 0; i < markers.length; i++) {
    markers[i].addListener('click', function() {
          
          alert(markers[i].getPosition());
        });
  };
  var tam = markers.length - 1;
  google.maps.event.addListener(markers[tam], "click", function(){
                               //click_mark(marker);
                               alert(markers[0].getPosition());
                               alert(markers[1].getPosition());
                            });
  google.maps.event.addListener(markers[tam], 'dragend', function(event) { 
                                       alert(marker.getPosition());
                                    } );*/

}

function escribir_input(input,direccion){
  
  input.value = direccion;
}

function punto_borrar(marker){

  marker.setMap(null);
  marker;
}

function mostrar_marcadores() {
    for (var i = 0; i < markers.length; i++) {
      markers[i].setMap(map);
    }
}

function click_mark(mark){
  alert(mark.getPosition());
  map.setCenter(mark.getPosition());
  alert("ok");
}


/*(function () {
   marker.addListener('click', function() {
          map.setZoom(8);
          map.setCenter(marker.getPosition());
        });
   alert("siii");
});*/





///////////////////////////////////////////////

function comprobar_punto(){

  var geocoder = new google.maps.Geocoder();
  var origen = document.getElementById('Punto').value;
  alert(origen);
  /*var pais = document.getElementById('Pais').value;
  if (pais == '') {
    pais =" Argentina";
  };
  var provincia = document.getElementById('Provincia').value;
  if (provincia == '') {
    provincia = " Catamarca";
  };
  var localidad = document.getElementById('Localidad').value;
  if (localidad == '') {
    localidad = " San Fernando del Valle de Catamarca";
  };
    var locprov= localidad.concat(provincia);
    var ubicacion = locprov.concat(pais);
    var origen = origeni.concat(ubicacion);*/

     // Función completa de Geocoding
      geocoder.geocode({
      'address': origen
    //'address': address  -28.484844  -65.778868 
  // 'latLng': latlng si lo que queremos ejecutar en geocodificación inversa
      }, function (results, status) {
       if (status == google.maps.GeocoderStatus.OK) {
       var latitud = results[0].geometry.location.lat().toFixed(6);
       var longitud = results[0].geometry.location.lng().toFixed(6);
       var direccion = results[0].formatted_address;
       //llama funcion graficar
           
       latitudgloorigen = latitud;
       longitudgloorigen = longitud;
        
       graficamarker (latitud,longitud);
        }
  // Se detallan los diferentes tipos de error
    else {
      alert('Geocode no tuvo éxito por la siguiente razón: ' + status) }
        });
}
//Funcion Inicio para Trazar Ruta
function comprobar() {
 

  var geocoder = new google.maps.Geocoder();
  var origen = document.getElementById('Origen').value;
  var destino = document.getElementById('Destino').value;
   
  //alert(origeni);
  /*var pais = document.getElementById('Pais').value;
  alert("okok");
  if (pais == '') {
    pais =" Argentina";
  //};

  var provincia = document.getElementById('Provincia').value;
  if (provincia == '') {
    provincia = " Catamarca";
  };
  var localidad = document.getElementById('Localidad').value;
  if (localidad == '') {
    localidad = " San Fernando del Valle de Catamarca";
  };
    var locprov= localidad.concat(provincia);
    var ubicacion = locprov.concat(pais);
    var origen = origeni.concat(ubicacion);
    var destino = destinoi.concat(ubicacion);*/
    
   
      // Función completa de Geocoding
      geocoder.geocode({
      'address': origen
    //'address': address  -28.484844  -65.778868 
	// 'latLng': latlng si lo que queremos ejecutar en geocodificación inversa
      }, function (results, status) {
       if (status == google.maps.GeocoderStatus.OK) {
       var latitud = results[0].geometry.location.lat().toFixed(6);
       var longitud = results[0].geometry.location.lng().toFixed(6);
       var direccion = results[0].formatted_address;
       //llama funcion graficar
           
       latitudgloorigen = latitud;
       longitudgloorigen = longitud;
        
       graficamarker (latitud,longitud);
        }
	// Se detallan los diferentes tipos de error
	  else {
      alert('Geocode no tuvo éxito por la siguiente razón: ' + status) }
        });
    
    geocoder.geocode({
      'address': destino
    //'address': address  -28.484844  -65.778868 
	// 'latLng': latlng si lo que queremos ejecutar en geocodificación inversa
      }, function (results, status) {
       if (status == google.maps.GeocoderStatus.OK) {
       var latitud = results[0].geometry.location.lat().toFixed(6);
       var longitud = results[0].geometry.location.lng().toFixed(6);
       var direccion = results[0].formatted_address;
       //llama funcion graficar
           
       latitudglodestino = latitud;
       longitudglodestino = longitud;
        
       graficamarker (latitud,longitud);
        }
	// Se detallan los diferentes tipos de error
	  else {
      alert('Geocode no tuvo éxito por la siguiente razón: ' + status) }
        });

} 


function graficamarker (lat ,long){

map.addMarker({lat: lat,lng: long,color: 'blue',
click: function(e) {alert('You clicked in this marker');}, infoWindow: {content: '<p>Origen/Destino</p>'}});
    salto = salto +1;
    if(salto == 2) {
       
        graficaruta ();
        calculardt ();
        //salto = 0;
    }
    
}

function grafica_market(){
  var direccion = document.getElementById('Punto').value;
  GMaps.geocode({
  address: $(direccion).val(),
  callback: function(results, status) {
    if (status == 'OK') {
      var latlng = results[0].geometry.location;
      map.setCenter(latlng.lat(), latlng.lng());
      map.addMarker({
        lat: latlng.lat(),
        lng: latlng.lng()
      });
    }
  }
});
}



function marker_arrastrable(){

  map.addListener('click', function() {
    alert("asd");
     
  });
  marker.addListener('click', function() {
    alert("asd");
    map.setZoom(8);
    map.setCenter(marker.getPosition());
  });
  
   /*map.addListener('click', function() {


    var marker = new google.maps.Marker({
    position: myLatlng,
    draggable: true,
    map: map,
    title:"Ejemplo marcador arrastrable";
  });

  var markerLatLng = marker.getPosition();
    infoWindow.setContent([
        '&lt;b&gt;La posicion del marcador es:&lt;/b&gt;&lt;br/&gt;',
        markerLatLng.lat(),
        ', ',
        markerLatLng.lng(),
        '&lt;br/&gt;&lt;br/&gt;Arr&amp;aacute;strame y haz click para actualizar la posici&amp;oacute;n.'
    ].join(''));
    infoWindow.open(map, marker);*/

   //}


  

}

function calculardt (){
 


  //var diti= "https://maps.googleapis.com/maps/api/distancematrix/json?origins=Bobcaygeon+ON|latitudgloorigen,longitudgloorigen&destinations=Bobcaygeon+ON|latitudglodestino,longitudglodestino&key=AIzaSyDFgJOKL2eU6-oXE7jLveKppr-RyzgMM9U";
  url_ok = url_base.concat(latitudgloorigen);
  url_ok = url_ok.concat(",");
  url_ok = url_ok.concat(longitudgloorigen);
  url_ok = url_ok.concat(url_destino);
  url_ok = url_ok.concat(latitudglodestino);
  url_ok = url_ok.concat(",");
  url_ok = url_ok.concat(longitudglodestino);
  url_ok = url_ok.concat(url_key);
  lee_json();
 



}
function graficaruta (){
   
    //map.panTo({lat: latitudgloorigen, lng: longitudgloorigen};
    //map.setCenter({lat: latitudgloorigen, lng: longitudgloorigen});
    
    // (latLng:LatLng|LatLngLiteral)
    map.drawRoute ({origin : [latitudgloorigen , longitudgloorigen ],destination : [latitudglodestino , longitudglodestino],travelMode : 'driving' , 
strokeColor : '#754850' ,strokeOpacity : 0.6 ,strokeWeight : 6 }); 
 map.setCenter(latitudgloorigen,longitudgloorigen);


  pasar_php('ruta');
    
}

function pasar_php(rp){

  if (rp == 'ruta') {
    //origen
    document.getElementById("p1_lat").value=latitudgloorigen;
    document.getElementById("p1_lng").value=longitudgloorigen;
    document.getElementById("geocoding_origen").value= document.getElementById('Origen').innerHTML=this.value;
    
    //destino
    document.getElementById("p2_lat").value=latitudglodestino;
    document.getElementById("p2_lng").value=longitudglodestino;
    document.getElementById("geocoding_destino").value=document.getElementById('Destino').innerHTML=this.value;
  }
  else{

  }

}

function borrarruta(){
  map.removeMarkers();
  map.removePolylines();
  //self.parent.location.reload();
  location.reload()
    
}

function lee_json (){
  //alert("ok1");
$.getJSON('https://maps.googleapis.com/maps/api/distancematrix/json?origins=-28.484844,-65.778868&destinations=-28.482543,-65.778776&key=AIzaSyDFgJOKL2eU6-oXE7jLveKppr-RyzgMM9U', function(data) {
    //data is the JSON string
    //alert("okokok12312");
});
//alert("okokok");
}


function localizar (){

GMaps.geolocate({
  success: function(position) {
    map.setCenter(position.coords.latitude, position.coords.longitude);
    latitudgloorigen =  position.coords.latitude;
    longitudgloorigen = position.coords.longitude;
  },
  error: function(error) {
    alert('Fallo Geolocalizacion: '+error.message);
  },
  not_supported: function() {
    alert("Su navegador No soiporta Geolocalizacion");
  },
  always: function() {
    alert("Encontrado!!");
    
    graficamarker (latitudgloorigen,longitudgloorigen);
    direccion_posta = geocodificacion_inversa(latitudgloorigen,longitudgloorigen,'a');
    ///Problema con la asincronidad ddel ajax.
    alert(direccion_posta);
    //quitar_input_origen();
   
  }
});

}

function geocodificacion_inversa(lat,lng,funcionCallback){

url_lugar = url_lugar.concat(lat).concat(',').concat(lng);
url_geocoding_ok = url_base_geocoding.concat(url_lugar).concat(url_key);

/*
FUNCIONANDO LO MUESTRA EN CONSOLA*/
$.ajax({
    // En data puedes utilizar un objeto JSON, un array o un query string
    
    //Cambiar a type: POST si necesario
    type: "GET",
    // Formato de datos que se espera en la respuesta
    dataType: "json",
    // URL a la que se enviará la solicitud Ajax
    url: url_geocoding_ok,
    async:"false"
})
 .done(function( data, textStatus, jqXHR ) {
     if ( console && console.log ) {
         console.log( "La solicitud se ha completado correctamente." );

         console.log(data);
         //direccion = console.log(data['results']["0"]["formatted_address"]); 
         //$('.content').text(data['results']["0"]["formatted_address"])
         direccion_ok = data['results']["0"]["formatted_address"];
        // alert(direccion_ok);
        funcionCallback(direccion_ok);

        
     }
 })
 .fail(function( jqXHR, textStatus, errorThrown ) {
     if ( console && console.log ) {
         console.log( "La solicitud a fallado: " +  textStatus);
     }
})

 ;


 return direccion_ok;

}


    
        





    
/*
function lee_json() {
  url_base= 'https://maps.googleapis.com/maps/api/distancematrix/json?origins=Bobcaygeon+ON|';
  url_destino='&destinations=Bobcaygeon+ON|';
  url_key = '&key=AIzaSyDFgJOKL2eU6-oXE7jLveKppr-RyzgMM9U';
  url_ok = url_base.concat(latitudgloorigen);
  url_ok = url_ok.concat(",");
  url_ok = url_ok.concat(longitudgloorigen);
  url_ok = url_ok.concat()
  url_ok = latitudgloorigen.concat(url_destino);
  url_ok = url_base.concat(latitudglodestino);
  url_ok = url_ok.concat(",");
  url_ok = url_ok.concat(longitudglodestino);
  url_ok = url_ok.concat(url_key);


  url_basea='&destinations=Bobcaygeon+ON|';

  &key=AIzaSyDFgJOKL2eU6-oXE7jLveKppr-RyzgMM9U;
  
  $.getJSON("https://maps.googleapis.com/maps/api/distancematrix/json?origins=Bobcaygeon+ON|latitudgloorigen,longitudgloorigen&destinations=Bobcaygeon+ON|latitudglodestino,longitudglodestino&key=AIzaSyDFgJOKL2eU6-oXE7jLveKppr-RyzgMM9U;
  ", function(datos) {
    alert("Origen: " + datos.origin_addresses);
    for (var i = 0; i < datos.rows.length; i++) {     
      var filas = datos.rows[i];
      var elementos = filas.elements;       
      for (var j = 0; j < elementos.length; j++) {    
        alert ("Distancia: " + elementos[j].distance.value);
      }
    }           
  });
}

*/