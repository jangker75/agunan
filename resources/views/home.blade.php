
@include('tema.header')
<body class="hold-transition fixed skin-black layout-top-nav">
<div class="wrapper">

@include('tema.head')
<style type="text/css">
  .slider.slider-horizontal .slider-track{
    height: 3px !important;
    margin-top: 3px !important;
  }
  .slider-handle{
    background-color: #fff !important;
    border: 2px solid #337ab7 !important;
    margin-top: -8px !important
  }
</style>
<div class="content-wrapper">
  <div class="menu-nav-home">
    <div class="container">
      <div class="col-sm-12">
        <div class="col-sm-8 pd-0">
          <button type="button" data-toggle="modal" data-target="#filter-modal" class="btn btn-white">Filter <img class="ml-10" src="assets/image/ic-filter-a.png"></button>
         <!--  <button type="button" data-toggle="modal" data-target="#sort-modal" class="btn btn-white">Sorting <img class="ml-10" src="assets/image/ic-sort-a.png"></button> -->
               <div class="btn-group btn-custom-group">
              <a  class="caret-drop-down dropdown-toggle btn btn-white" data-toggle="dropdown"><span id="change-year-order" class="text-info-custom">
              Sorting
           <span class="caret"></span> </span></a>
              <ul class="dropdown-menu drop-custom" role="menu">
                <li><a href="{{url('home?selected=survey.created_at')}}">Date</a></li>
                 <li><a href="{{url('home?selected=survey.harga_jual_apprasial')}}">Harga Jual</a></li>
                 <li><a href="{{url('home?selected=agunan.luas_tanah')}}">Luas Tanah</a></li>
                  <li><a href="{{url('home?selected=agunan.luas_bangunan')}}">Luas Bangunan</a></li>
                   <li><a href="{{url('home?selected=agunan.grade')}}">Grade</a></li>
              </ul>
            </div>
          <button type="button" data-toggle="modal" data-target="#history-modal" class="btn btn-white">History <img class="ml-10" src="assets/image/ic-history-a.png"></button>
        </div>
        <div class="col-sm-4 pd-0">
          <div class="text-right" >
            <form action="cari" method="GET">
              <button type="submit" class="btn btn_confir_welcome btn_setuju_syarat btn-primary" style="width: 100px;margin-top: 0;">Search</button>
              <input type="text" placeholder="Alamat Agunan" class="form-control input-search-agunan" name="alamat">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container pd-0 conitainer-list-data">

      <!-- Main content -->
      <section class="content content-agunan">
        @if(Request::get('alamat'))
        <h4 style="margin-left: 15px">Menampilkan query pencarian berdasarkan alamat "{{Request::get('alamat')}}"</h4>
        @endif
        @foreach($agunan as $row)
          <a href="{{url('bidding?id_agunan='.$row->id)}}">
             <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 list-agunan-data">
              <div class="img-agunan">
                <img src="{{$row->foto_agunan}}">
                <span class="info-luas">
                  <p class="lt">LT : {{$row->luas_tanah}} M2</p>
                  <p class="lb">LB : {{$row->luas_bangunan}} M2</p>
                </span>
              </div>
              <div class="info-agunan">
                <p class="nama">
                  {{$row->nama_jenis_jaminan}}
                </p>
                <p class="alamat">
                  {{$row->alamat}}
                </p>
                <p class="harga">
                  <!-- {{$row->harga}} -->
                  {{$row->harga_jual_apprasial}}

                </p>
              </div>
            </div>
          </a>
        @endforeach
        <!-- /.box -->
      </section>
      <!-- /.content -->
    </div>

    <!-- filter -->
    <div class="modal fade in" id="filter-modal" role="dialog">
        <div class="modal-dialog modal-">
           <div class="modal-content" style="border-radius: 7px">
              <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal">×</button>
                 <h4 class="modal-title">Filter Data Agunan</h4>
              </div>
              <form action="{{url('home')}}" method="POST">
                {{csrf_field()}}
                <div class="modal-body detail-agunan">
                   <div class="side-left">
                      <div class="box-detail">
                          <!-- <table class="table-bidding">
                            <tr>
                              <td>Area</td>                      
                            </tr>
                            <tr>
                              <th>
                                <select class="form-control" style="margin-left: -5px">
                                  <option>Select area</option>
                                  <option>Semarang</option>
                                  <option>Jepara</option>
                                </select>
                              </th>
                            </tr>
                          </table> -->
                          <table class="table-bidding">
                            <tr>
                              <td>Harga (Rp)</td>                      
                            </tr>
                            <tr>
                              <td>
                                <input id="harga1" name="harga_awal" value="0" type="text" readonly="" style="background-color: #fff" class="form-control" placeholder="0">
                              </td>
                              <td>
                                <input id="harga2" name="harga_akhir" type="text" readonly="" style="background-color: #fff" class="form-control" placeholder="80000000" value="80000000" name="">
                              </td>
                            </tr>
                            
                          </table>
                          <table class="table-bidding">
                            <tr>
                              <th>
                                <input type="text" name="" value="" id="harga_slider" class="slider form-control" data-slider-min="0" data-slider-max="200000000"
                                data-slider-step="5" data-slider-value="[0,80000000]" data-slider-orientation="horizontal"
                                data-slider-selection="before" data-slider-tooltip="hide" data-slider-id="blue">
                              </th>                      
                            </tr>
                          </table>

                          <table class="table-bidding">
                            <tr>
                              <td>Luas Tanah (m2)</td>                      
                            </tr>
                            <tr>
                              <td>
                                <input id="luas1" name="luas_tanah_satu" value="0" type="text" readonly="" style="background-color: #fff" class="form-control" placeholder="0" name="">
                              </td>
                              <td>
                                <input id="luas2" name="luas_tanah_dua" type="text" readonly="" style="background-color: #fff" class="form-control" placeholder="200" value="200" name="">
                              </td>
                            </tr>
                            
                          </table>
                          <table class="table-bidding">
                            <tr>
                              <th>
                                <input type="text" value="" id="luas_slider" class="form-control" data-slider-min="0" data-slider-max="500"
                                data-slider-step="5" data-slider-value="[0,200]" data-slider-orientation="horizontal"
                                data-slider-selection="before" data-slider-tooltip="hide" data-slider-id="blue">
                              </th>                      
                            </tr>
                          </table>
                         
                          <table class="table-bidding">
                            <tr>
                              <td>Luas Bangunan (m2)</td>                      
                            </tr>
                            <tr>
                              <td>
                                <input id="luas_b1" name="luas_bangunan_satu" value="0" type="text" readonly="" style="background-color: #fff" class="form-control" placeholder="0" name="">
                              </td>
                              <td>
                                <input id="luas_b2" type="text" name="luas_bangunan_dua" value="200" readonly="" style="background-color: #fff" class="form-control" placeholder="200" name="">
                              </td>
                            </tr>
                            
                          </table>
                          <table class="table-bidding">
                            <tr>
                              <th>
                                <input type="text" value="" id="luas_bangunan" class="form-control" data-slider-min="0" data-slider-max="500"
                                data-slider-step="5" data-slider-value="[0,200]" data-slider-orientation="horizontal"
                                data-slider-selection="before" data-slider-tooltip="hide" data-slider-id="blue">
                              </th>                      
                            </tr>
                          </table>
                          
                      </div>
                    </div>
                </div>
                <div class="modal-footer">
                   <button type="submit" style="width: 100px" class="btn btn-primary">Submit</button>
                </div>
              </form>
           </div>
        </div>
    </div>

 <!--    sort -->
    <div class="modal fade in" id="sort-modal" role="dialog">
        <div class="modal-dialog modal-">
           <div class="modal-content" style="border-radius: 7px">
              <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal">×</button>
                 <h4 class="modal-title">Sorting Data Agunan</h4>
              </div>
              <form action="filter" method="GET">
                <div class="modal-body detail-agunan">
                   <div class="side-left">
                      <div class="box-detail">
                          <table class="table-bidding">
                            <tr>
                              <td>Harga (Rp)</td>                      
                            </tr>
                            <tr>
                              <td>
                                <input id="harga1" name="harga_awal" value="0" type="text" readonly="" style="background-color: #fff" class="form-control" placeholder="0" name="">
                              </td>
                              <td>
                                <input id="harga2" name="harga_akhir" type="text" readonly="" style="background-color: #fff" class="form-control" placeholder="200.000.000" value="80000000" name="">
                              </td>
                            </tr>
                            
                          </table>
                          <table class="table-bidding">
                            <tr>
                              <th>
                                <input type="text" name="" value="" id="harga_slider" class="slider form-control" data-slider-min="0" data-slider-max="200000000"
                                data-slider-step="5" data-slider-value="[0,80000000]" data-slider-orientation="horizontal"
                                data-slider-selection="before" data-slider-tooltip="hide" data-slider-id="blue">
                              </th>                      
                            </tr>
                          </table>

                          <table class="table-bidding">
                            <tr>
                              <td>Luas Tanah (m2)</td>                      
                            </tr>
                            <tr>
                              <td>
                                <input id="luas1" name="luas_tanah_satu" value="0" type="text" readonly="" style="background-color: #fff" class="form-control" placeholder="0" name="">
                              </td>
                              <td>
                                <input id="luas2" name="luas_tanah_dua" type="text" readonly="" style="background-color: #fff" class="form-control" placeholder="500" value="200" name="">
                              </td>
                            </tr>
                            
                          </table>
                          <table class="table-bidding">
                            <tr>
                              <th>
                                <input type="text" value="" id="luas_slider" class="form-control" data-slider-min="0" data-slider-max="500"
                                data-slider-step="5" data-slider-value="[0,200]" data-slider-orientation="horizontal"
                                data-slider-selection="before" data-slider-tooltip="hide" data-slider-id="blue">
                              </th>                      
                            </tr>
                          </table>
                         
                          <table class="table-bidding">
                            <tr>
                              <td>Luas Bangunan (m2)</td>                      
                            </tr>
                            <tr>
                              <td>
                                <input id="luas_b1" name="luas_bangunan_satu" value="0" type="text" readonly="" style="background-color: #fff" class="form-control" placeholder="0" name="">
                              </td>
                              <td>
                                <input id="luas_b2" type="text" name="luas_bangunan_dua" value="200" readonly="" style="background-color: #fff" class="form-control" placeholder="500" name="">
                              </td>
                            </tr>
                            
                          </table>
                          <table class="table-bidding">
                            <tr>
                              <th>
                                <input type="text" value="" id="luas_bangunan" class="form-control" data-slider-min="0" data-slider-max="500"
                                data-slider-step="5" data-slider-value="[0,200]" data-slider-orientation="horizontal"
                                data-slider-selection="before" data-slider-tooltip="hide" data-slider-id="blue">
                              </th>                      
                            </tr>
                          </table>
                          
                      </div>
                    </div>
                </div>
                <div class="modal-footer">
                   <button type="submit" style="width: 100px" class="btn btn-primary">Submit</button>
                </div>
              </form>
           </div>
        </div>
    </div>

    <!-- history -->

    <div class="modal fade in" id="history-modal" role="dialog">
        <div class="modal-dialog modal-lg">
           <div class="modal-content">
              <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal">×</button>
                 <h4 class="modal-title" style="font-size: 25px">History</h4>
              </div>
              <div class="modal-body detail-agunan modal-history">
                @foreach($history as $his)
                <div class="list-history">
                  <div class="pull-right text-right">
                    <label class="tanggal">{{$his->created_at}}</label><br>
                    <label class="harga">{{$his->nominal}}</label>
                  </div>
                  <img src="{{$his->foto_agunan}}" class="img-history">
                  <div class="history-info-agunana">
                    <div class="nama">{{$his->nama_jenis_jaminan}}</div>
                    <div class="sales cl-blue">{{$his->nama}}</div>
                    <div class="telp">{{$his->telp}}</div>
                  </div>
                  
                </div>
                @endforeach
              </div>
               
           </div>
        </div>
    </div>



</div>


@include('tema.footer')

</div>
</body>
@include('tema.script')
@if (\Session::has('message'))
  <script type="text/javascript">
    swal({   
        title: "Selamat",   
        text: '{!!  \Session::get('message') !!}',
        confirmButtonColor: "#196AC8",   
    });
  </script>
@endif
<script>
  $(function () {
    /* BOOTSTRAP SLIDER */
    $('#harga_slider').slider()
    $('#luas_slider').slider()
    $('#luas_bangunan').slider()
    $('#harga_slider').on('slide', function (ev) {
        var bil = ev.value[0];
  
        var string_harga = bil.toString(),
        ss_h  = string_harga.length % 3,
        rp  = string_harga.substr(0, ss_h),
        ribu  = string_harga.substr(ss_h).match(/\d{3}/g);
          
        if (ribu) {
          sp = ss_h ? '.' : '';
          rp += sp + ribu.join('.');
        }

        $("#harga1").val(rp)
        var bilangan = ev.value[1];
  
        var number_string = bilangan.toString(),
        sisa  = number_string.length % 3,
        rupiah  = number_string.substr(0, sisa),
        ribuan  = number_string.substr(sisa).match(/\d{3}/g);
          
        if (ribuan) {
          separator = sisa ? '.' : '';
          rupiah += separator + ribuan.join('.');
        }
        $("#harga2").val(rupiah)

    });

    $('#luas_slider').on('slide', function (ev) {
        $("#luas1").val(ev.value[0])
        $("#luas2").val(ev.value[1])

    });
    $('#luas_bangunan').on('slide', function (ev) {
        $("#luas_b1").val(ev.value[0])
        $("#luas_b2").val(ev.value[1])

    });
     
  })
</script>
<style type="text/css">
  @media(max-width: 580px){
    .fixed .content-wrapper, .fixed .right-side{
          padding-top: 110px;
    }
    .content-agunan{
      padding-top: 142px;
    }
  }
</style>