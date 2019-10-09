@include('tema.header')
<body class="hold-transition fixed skin-black layout-top-nav">
<div class="wrapper">

@include('tema.head')
<div class="content-wrapper">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <?php 
        $no=0;
        foreach ($image_agunan as $key) { 
          
          if ($no==0) {
            $act='active';
          }else{
            $act='';
          }
      ?>
      <li data-target="#myCarousel" data-slide-to="{{$no++}}" class="{{$act}}"></li>
      <?php } ?>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <?php 
        $no=0;
        foreach ($image_agunan as $key) { 
          $no++;
          if ($no==1) {
            $ac='active';
          }else{
            $ac='';
          }
      ?>

      <div class="item {{$ac}}">
        <figure>
        <a data-fancybox="gallery" href="{{$key->image}}"><img class="center" src="{{$key->image}}" style="object-fit: cover;width: 75%;height: 700px!important;"></a>
      </figure>
      </div>
      <?php } ?>
    </div>

 
  </div>

  <div class="container pd-0" style="word-break: break-all;">

      <!-- Main content -->
      <section class="content mt-10">
         <div class="col-lg-7 col-md-6 col-sm-6 col-xs-12 detail-agunan" style="margin-bottom: 30px">
            <div class="side-left">
              <div class="box-detail">
                  <a href="{{url('pdf/'.$_GET['id_agunan'])}}" style="margin-top: 5px;margin-right: 5px;" class="btn btn-primary btn-sm pull-right">Export Pdf&nbsp; <i class="fa fa-upload"></i></a>
                <div class="judul-detail pd-detail">
                  <p>Data Pengelola</p>
                </div>  
                <hr>
                <table class="table-detail">
                  <tr>
                    <td>Unit Pengelola</td>
                    <td class="text-right">{{$area}}</td>
                  </tr>
                  <tr>
                    <td>Nama PIC</td>
                    <td class="text-right">{{$nama_pic}}</td>
                  </tr>
                  <tr>
                    <td>No Telp PIC</td>
                    <td class="text-right">{{$telp_pic}}</td>
                  </tr>
                </table>
              </div>

              <div class="box-detail mt-50">
                <div class="judul-detail pd-detail">
                  <p>Informasi Agunan</p>
                </div>  
                <hr>
                <table class="table-detail">
                  <tr>
                    <td>Area</td>
                    <td class="text-right">{{$area}}</td>
                  </tr>
                  <tr>
                    <td>Alamat</td>
                    <td class="text-right">{{$alamat}}</td>
                  </tr>
                  <tr>
                    <td>Sertifikat</td>
                    <td class="text-right">{{$sertifikat}}</td>
                  </tr>
                  <tr>
                    <td>Luas Tanah</td>
                    <td class="text-right">{{$luas_tanah}} M2</td>
                  </tr>
                  <tr>
                    <td>Luas Bangunan</td>
                    <td class="text-right">{{$luas_bangunan}} M2</td>
                  </tr>
                  <tr>
                    <td>Jenis Jaminan</td>
                    <td class="text-right">{{$jenis_jaminan}}</td>
                  </tr>
                  <tr>
                    <td>Status Jaminan</td>
                    <td class="text-right">{{$status_jaminan}}</td>
                  </tr>
                  <tr>
                    <td>Kode Jaminan</td>
                    <td class="text-right">{{$kode_jaminan}}</td>
                  </tr>
                  <tr>
                    <td>Harga Jual</td>
                   <!--  <td class="text-right">{{$harga}}</td> -->
                    <td class="text-right">{{$harga_jual_apprasial}}</td>
                  </tr>
                </table>
              </div>


              <div class="mt-50">
                <div class="judul-detail pd-detail">
                  <p>Lokasi Agunan</p>
                </div>  
                <div id="map"></div>
              </div>


            </div>

         </div>
         <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12 detail-agunan">
           <div class="side-left">
              <div class="box-detail pd-detail">
                <form method="POST" action="bidding">
                  {{csrf_field()}}
                  <div class="judul-detail">
                    <p>Bidding</p>
                    <span>Harga Jual</span>
                <!--    <label class="pull-right harga-jual">{{$harga}}</label>  -->
                   <label class="pull-right harga-jual">{{$harga_jual_apprasial}}</label> 
                  </div> 
                  <div class="box-detail mt-20">
                    <table class="table-bidding">
                      <tr>
                        <td class="cl-blue">Nama Pembeli</td>                      
                      </tr>
                      <tr>
                        <th>
                          <input type="text" required class="form-control form-input" placeholder="Nama Pembeli" name="pembeli">
                          <input type="hidden" required class="form-control form-input" value="{{$id_agunan}}" name="id_agunan">
                        </th>
                      </tr>
                      <tr>
                        <td class="cl-blue">No. Telp</td>                      
                      </tr>
                      <tr>
                        <th>
                          <input type="text" required class="form-control form-input" placeholder="No. Telp" name="telp">
                        </th>
                      </tr>
                      <tr>
                        <td class="cl-blue">Alamat</td>                      
                      </tr>
                      <tr>
                       <th>
                        <textarea required class="form-control form-input" placeholder="Alamat" name="alamat" cols="3"></textarea>
                        </th>
                      </tr>
                      <tr>
                        <td class="cl-blue">Harga Penawaran</td>                      
                      </tr>
                      <tr>
                        <th>
                          <input type="money" id="harga_penawaran" required class="form-control form-input" placeholder="Harga Penawaran" name="penawaran">
                          <p class="see-password" style="font-size: 12px;color: #A0B0C9">Rp</p>
                        </th>
                      </tr>
                    </table>
                  </div>
                  <br>
                  <input type="submit" class="btn btn-block btn-primary" value="Submit">
                  <br>
                </form>
              </div>
            </div>
         </div>
        <!-- /.box -->
      </section>
      <!-- /.content -->
    </div>

    <?php if($latitude!=null){
      $lat=$latitude;
    }else{
      $lat=$chekin_lat;
    } 

    if($longitude!=null){
      $long=$longitude;
    }else{
      $long=$chekin_long;
    }



    ?>



</div>


@include('tema.footer')

</div>
</body>
@include('tema.script')
<script type="text/javascript">
	$('#harga_penawaran').on('keyup', function (ev) {
       var $this = $( this );
		var input = $this.val();
		var input = input.replace(/[\D\s\._\-]+/g, "");
		input = input ? parseInt( input, 10 ) : 0;
		$this.val( function() {
		    return ( input === 0 ) ? "" : input.toLocaleString( "id-ID" );
		} );

    });
</script>
<script>
  var lati = "{{$lat}}";
  var longi= "{{$long}}";
  var latitude=Number(lati);
  var longitude=Number(longi)
      // This example displays a marker at the center of Australia.
      // When the user clicks the marker, an info window opens.

      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat:latitude, lng: longitude},
          zoom: 14,
          mapTypeId: 'roadmap',
          styles: [ { "elementType": "geometry", "stylers": [ { "color": "#f5f5f5" } ] }, { "elementType": "labels.icon", "stylers": [ { "visibility": "off" } ] }, { "elementType": "labels.text.fill", "stylers": [ { "color": "#616161" } ] }, { "elementType": "labels.text.stroke", "stylers": [ { "color": "#f5f5f5" } ] }, { "featureType": "administrative.land_parcel", "elementType": "labels.text.fill", "stylers": [ { "color": "#bdbdbd" } ] }, { "featureType": "poi", "elementType": "geometry", "stylers": [ { "color": "#eeeeee" } ] }, { "featureType": "poi", "elementType": "labels.text.fill", "stylers": [ { "color": "#757575" } ] }, { "featureType": "poi.park", "elementType": "geometry", "stylers": [ { "color": "#e5e5e5" } ] }, { "featureType": "poi.park", "elementType": "labels.text.fill", "stylers": [ { "color": "#9e9e9e" } ] }, { "featureType": "road", "elementType": "geometry", "stylers": [ { "color": "#ffffff" } ] }, { "featureType": "road.arterial", "elementType": "labels.text.fill", "stylers": [ { "color": "#757575" } ] }, { "featureType": "road.highway", "elementType": "geometry", "stylers": [ { "color": "#dadada" } ] }, { "featureType": "road.highway", "elementType": "labels.text.fill", "stylers": [ { "color": "#616161" } ] }, { "featureType": "road.local", "elementType": "labels.text.fill", "stylers": [ { "color": "#9e9e9e" } ] }, { "featureType": "transit.line", "elementType": "geometry", "stylers": [ { "color": "#e5e5e5" } ] }, { "featureType": "transit.station", "elementType": "geometry", "stylers": [ { "color": "#eeeeee" } ] }, { "featureType": "water", "elementType": "geometry", "stylers": [ { "color": "#c9c9c9" } ] }, { "featureType": "water", "elementType": "labels.text.fill", "stylers": [ { "color": "#9e9e9e" } ] } ]
        });

        var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<div id="bodyContent">'+
            '{{$alamat}} '+
            '</div>'+
            '</div>';

        var infowindow = new google.maps.InfoWindow({
          content: contentString
        });

        var marker = new google.maps.Marker({
          position: {lat:latitude, lng: longitude},
          map: map,
          title: 'Jalan Banyumanik Raya No 354, Banyumanik Semarang',
        });
        infowindow.open(map, marker);
      }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA7DDlBVVFGC4BSG8beDuZJdqShEJcGnbU&libraries=places&callback=initMap"
         async defer></script>