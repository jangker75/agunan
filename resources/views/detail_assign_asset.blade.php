<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')
@section('content')
  <!-- Your html goes here -->
 <!--  <div style="margin-bottom: 20px">
    <a href="{{url(CRUDBooster::mainpath())}}"><i class="fa fa-chevron-circle-left"></i> Back To List Apprasial</a> &nbsp;
     <button class="btn btn-sm btn-primary" onclick="sub()" style="padding-left: 20px;padding-right: 20px">Submit</button>
  </div> -->

  <div class='panel panel-default'>
    <div class='panel-heading'><b>Detail Apprasial</b></div>
    <div class='panel-body'>      
        <div class='form-group'>
        <form method="post" action="{{CRUDBooster::mainpath('editapp')}}" id="myform">
          {{csrf_field()}}
          <input type="hidden" name="id_agunan" value="{{$row->id_agunan}}">
          <input type="hidden" name="id" value="{{$id_survey}}"> 
         <table class="table">
          <tbody>
            <tr>
              <th scope="row"><b>Nomor Kode Jaminan</b></th>
              <td>{{$row->kode_uniq}}</td>
              <td><b>Baki Debet</b></td>
              <td>Rp.&nbsp;{{number_format($row->baki_debet)}}</td>
            </tr>
            <tr>
              <th scope="row"><b>Sertivikat</b></th>
              <td>{{$row->nama_sertifikat}}</td>
              <td><b>Nilai Likuidasi</b></td>
              <td>Rp.&nbsp;{{number_format($row->nilai_likuidasi)}}</td>
            </tr>
            <tr>
              <th scope="row"><b>LT(M2)</b></th>
              <td>{{$row->luas_tanah}}</td>
              <td><b>Harga Jual</b></td>
              <td>Rp.&nbsp;{{number_format($row->harga_jual)}}</td>
            </tr>
            <tr>
              <th scope="row"><b>LB(M2)</b></th>
              <td>{{$row->luas_bangunan}}</td>
              <td><b>LTV Awal</b></td>
              <td>{{ceil($row->ltv)}}&nbsp;%</td>
            </tr>
            <tr>
              <th scope="row"><b>Jenis Jaminan</b></th>
              <td>{{$row->nama_jenis_jaminan}}</td>
              <td><h3>Apprasial</h3></td>
              <td></td>
            </tr>

            <tr>
              <?php if($row->nilai_asset==1){
                $nilai_asset="Nilai Pasar > Nilai Likuidasi";
              }else{
                 $nilai_asset="Nilai Pasar <= Nilai Likuidasi";
              } ?>
              <th scope="row"><b>Area</b></th>
              <td>{{$area->nama}}</td>
              <td><b>Nilai Asset</b></td>
              <td>{{$nilai_asset}}</td>
            </tr>

          <tr>
                 <?php if($row->dokumen_legalitas==1){
                $dokumen="Lengkap";
              }else{
                 $dokumen="Tidak Lengkap";
              } ?>
              <th scope="row"><b>Kode Jaminan</b></th>
              <td>{{$row->kode_jaminan}}</td>
              <td><b>Dokumen Legalitas</b></td>
              <td>{{$dokumen}}</td>
            </tr>

             <tr>
              <th scope="row"><b>Product</b></th>
              <td>{{$row->product}}</td>
              <td><b>Estimasi Biaya</b></td>
              <td>Rp.&nbsp;{{number_format($row->estimasi_biaya)}}</td>
            </tr>

              <tr>
              <th scope="row"><b>Alamat</b></th>
              <td>{{$row->alamat}}</td>
              <td><b>Harga Jual Apprasial</b></td>
              <td>Rp.&nbsp;{{number_format($row->harga_jual_apprasial)}}</td>
            </tr>


              <tr>
              <th scope="row"><b>Keterangan</b></th>
              <td>{{$row->keterangan}}</td>
              <td><b>Nilai Pasar Appresial</b></td>
              <td>Rp.&nbsp;{{number_format($row->nilai_pasar_apprasial)}}</td>
            </tr>


              <tr>
              <th scope="row"><b>Awu Bwu</b></th>
              <td>{{$row->amu_bwu}}</td>
              <td><b>LTV Apprasial</b></td>
              <td>{{ceil($row->ltv_apprasial)}}&nbsp;%</td>
            </tr>


              <tr>
                <?php
            if($row->grade>=9){
                $column_value='A';
            }elseif($row->grade==8){
                $column_value='B';
            }elseif($row->grade==7){
                $column_value='C';
            }elseif($row->grade==6){
                 $column_value='D';
            }else{
                 $column_value='E';
            }
                 ?>
              <th scope="row"><b>Draft Pu</b></th>
              <td>{{$row->draft_pu}}</td>
              <td><b>Grade</b></td>
              <td>{{$column_value}}</td>
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


              <tr>
              <th scope="row"><b>Gol</b></th>
              <td>{{$row->gol}}</td>
              <td></td>
              <td></td>
            </tr>


              <tr>
              <th scope="row"><b>Status Jaminan</b></th>
              <td>{{$row->nama_status_jaminan}}</td>
              <td></td>
              <td></td>
            </tr>

              <tr>
              <th scope="row"><b>Biaya</b></th>
              <td>Rp.&nbsp;{{number_format($row->biaya)}}</td>
              <td></td>
              <td></td>
            </tr>

           <!--    <tr>
              <th scope="row"><b>Denda</b></th>
              <td>-</td>
              <td></td>
              <td></td>
            </tr> -->


              <tr>
              <th scope="row"><b>Nilai pasar</b></th>
              <td>Rp.&nbsp;{{number_format($row->nilai_likuidasi)}}</td>
              <td></td>
              <td></td>
            </tr>

               
            <tr>
              <th scope="row"><b>Foto 1</b></th>
              <td><img src="{{asset($row->image_1)}}" width="200px" alt="tidak ada gambar"></td>
              <td></td>
              <td></td>
            </tr>


               <tr>
              <th scope="row"><b>Foto 2</b></th>
              <td><img src="{{asset($row->image_2)}}" width="200px" alt="tidak ada gambar"></td>
              <td></td>
              <td></td>
            </tr>


               <tr>
              <th scope="row"><b>Foto 3</b></th>
              <td><img src="{{asset($row->image_3)}}" width="200px" alt="tidak ada gambar"></td>
              <td></td>
              <td></td>
            </tr>


               <tr>
              <th scope="row"><b>Foto 4</b></th>
              <td><img src="{{asset($row->image_4)}}" width="200px" alt="tidak ada gambar"></td>
              <td></td>
              <td></td>
            </tr>


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