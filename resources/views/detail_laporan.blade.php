<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')
@section('content')

  <div class='panel panel-default'>
    <div class='panel-heading'><b>Detail Laporan</b></div>
    <div class='panel-body'>      
        <div class='form-group'>
        <form method="post" action="{{CRUDBooster::mainpath('editapp')}}" id="myform">
          {{csrf_field()}}
          <input type="hidden" name="id_agunan" value="{{$row->id_agunan}}">
          <input type="hidden" name="id" value="{{$id_survey}}"> 
         <table class="table">
          <tbody>
              <tr>
              <th scope="row"><b>Nomor Kode Aset</b></th>
              <td>{{$row->kode_uniq}}</td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <th scope="row"><b>Kode Jaminan</b></th>
              <td>{{$row->kode_jaminan}}</td>
              <td></td>
              <td></td>
            </tr>
            <tr>
             <?php if($row->nilai_asset==0){
              $cek='Checked';
              $cek_1='';
            }else{
               $cek_1='Checked';
              $cek='';
            } ?>

              <th scope="row"><b>Tanggal Survey</b></th>
              <td>{{$row->created_at}}</td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <th scope="row"><b>Area</b></th>
              <td>{{$row->nama_area}}</td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <th scope="row"><b>LT(M2)</b></th>
              <td>{{$row->luas_tanah}}</td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <th scope="row"><b>LB(M2)</b></th>
              <td>{{$row->luas_bangunan}}</td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <th scope="row"><b>Jenis Jaminan</b></th>
              <td>{{$row->nama_jenis_jaminan}}</td>
              <td></td>
              <td></td>
            </tr>
              <th scope="row"><b>Harga Jual</b></th>
              <td>Rp.&nbsp;{{number_format($row->harga_jual)}}</td>
              <td></td>
              <td></td>
            </tr>
          <tr>
              <th scope="row"><b>Surveyor</b></th>
              <td>{{$row->nama_surveyor}}</td>
              <td></td>
              <td></td>
            </tr>
             <tr>
              <th scope="row"><b>Alamat</b></th>
              <td>{{$row->alamat}}</td>
              <td></td>
              <td></td>
            </tr>

              <tr>
              <th >Lokasi Map</th>
              @if($row->checkin_lat!=null && $row->checkin_long!=null)
              <td><a href="https://www.google.com/maps/search/?api=1&query={{$row->checkin_lat}},{{$row->checkin_long}}" class="btn btn-sm btn-primary" target="_blank"><i class="fa fa-map-marker"></i>&nbsp;Lokasi</a></td>
              @else
              <td><a href="javascript:void(0)" onclick="alert('Data Lokasi Tidak Ada')" class="btn btn-sm btn-primary" target="_blank"><i class="fa fa-map-marker"></i>&nbsp;Lokasi</a></td>
              @endif
              <td></td>
              <td></td>
            </tr>
<!-- 
              <tr>
              <th scope="row"><b>Status Hunian</b></th>
              <td>{{$row->status_rumah}}</td>
              <td></td>
              <td></td>
            </tr>


              <tr>
              <th scope="row"><b>Status Lokasi Jalan</b></th>
              <td>-</td>
              <td></td>
              <td></td>
            </tr>

 -->
              <tr>
              <th scope="row"><b>Baki Debet</b></th>
              <td>Rp.&nbsp;{{number_format($row->baki_debet)}}</td>
              <td></td>
              <td></td>
            </tr>


       <!--        <tr>
              <th scope="row"><b>Biaya Awal</b></th>
              <td>Rp.&nbsp;{{number_format($row->harga)}}</td>
              <td></td>
              <td></td>
            </tr> -->

<!-- 
              <tr>
              <th scope="row"><b>Denda</b></th>
              <td>-</td>
              <td></td>
              <td></td>
            </tr>
 -->
              <tr>
              <th scope="row"><b>Nilai Pasar Awal</b></th>
              <td>Rp.&nbsp;{{number_format($row->nilai_pasar)}}</td>
              <td></td>
              <td></td>
            </tr>

              <tr>
              <th scope="row"><b>Harga Jual Awal</b></th>
              <td>Rp.&nbsp;{{number_format($row->harga_jual)}}</td>
              <td></td>
              <td></td>
            </tr>


              <tr>
              <th scope="row"><b>Nilai Likuidasi</b></th>
              <td>Rp.&nbsp;{{number_format($row->nilai_likuidasi)}}</td>
              <td></td>
              <td></td>
            </tr>

            <tr>
              <th scope="row"><b>LTV Awal</b></th>
              <td>{{$row->ltv}}&nbsp;%</td>
              <td></td>
              <td></td>
            </tr>

            <tr>
              <th scope="row"><b>Nama Debitur</b></th>
              <td>{{$row->nama_debitur}}</td>
              <td></td>
              <td></td>
            </tr>

            @if($row->image_1!=null)
               <tr>
              <th scope="row"><b>Foto 1</b></th>
              <td><img src="{{asset($row->image_1)}}" width="200px" alt="tidak ada gambar"></td>
              <td></td>
              <td></td>
            </tr>
            @endif

            @if($row->image_2!=null)
               <tr>
              <th scope="row"><b>Foto 2</b></th>
              <td><img src="{{asset($row->image_2)}}" width="200px" alt="tidak ada gambar"></td>
              <td></td>
              <td></td>
            </tr>
            @endif


            @if($row->image_3!=null)
               <tr>
              <th scope="row"><b>Foto 3</b></th>
              <td><img src="{{asset($row->image_3)}}" width="200px" alt="tidak ada gambar"></td>
              <td></td>
              <td></td>
            </tr>
            @endif

                @if($row->image_4!=null)
               <tr>
              <th scope="row"><b>Foto 4</b></th>
              <td><img src="{{asset($row->image_4)}}" width="200px" alt="tidak ada gambar"></td>
              <td></td>
              <td></td>
            </tr>
            @endif


          </tbody>
        </table>
      </form>
        </div>
    </div>
  </div>

  <script type="text/javascript">
function sub() {
  document.getElementById("myform").submit();
}
  </script>
@endsection

@push('bottom')

<script type="text/javascript">
  $(document).ready(function(){

  })
</script>

@endpush