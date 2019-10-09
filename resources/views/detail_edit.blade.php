<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')
@section('content')
  <!-- Your html goes here -->
  <div style="margin-bottom: 20px">
    <a href="{{url(CRUDBooster::mainpath())}}"><i class="fa fa-chevron-circle-left"></i> Back To List Apprasial</a> &nbsp;
     <button class="btn btn-sm btn-primary" onclick="sub()" style="padding-left: 20px;padding-right: 20px">Submit</button>
  </div>
<!-- 
   @if (Session::get('message')!='')
              <div class='alert alert-{{ Session::get("message_type") }}' style="text-align: left;">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h4><i class="icon fa fa-info"></i> {{ trans("crudbooster.alert_".Session::get("message_type")) }}</h4>
                  {!!Session::get('message')!!}
              </div>
              @endif -->

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
              <th scope="row"><b>Kode Jaminan</b></th>
              <td>{{$row->kode_jaminan}}</td>
              <td><h3>Approval</h3></td>
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

              <th scope="row"><b>Nomor Kode Aset</b></th>
              <td>{{$row->kode_uniq}}</td>
              <td><b>Nilai Asset</b></td>
              <td><input type="radio" class="form-check-input" required name="nilai_asset" <?php echo ($row->nilai_asset==1)?'checked':'' ?> id="n1" value="1">Nilai Pasar > Nilai Likuidasi</td>
            </tr>
            <tr>
              <th scope="row"><b>Area</b></th>
              <td>{{$area->nama_area}}</td>
              <td></td>
              <td><input type="radio" class="form-check-input" required <?php echo ($row->nilai_asset==0)?'checked':'' ?> name="nilai_asset" id="n1" value="0">Nilai Pasar < Nilai Likuidasi</td>
            </tr>
            <tr>
              <th scope="row"><b>LT(M2)</b></th>
              <td>{{$row->luas_tanah}}</td>
                  <th scope="row"><b>Dokumen Legalitas</b></th>
               <td><?php if($row->dokumen_legalitas==1){
                echo "Dokumen Lengkap";
              }else{
                echo "Dokumen Tidak Lengkap";
              } ?></td>
            <!--   <td><b>Dokumen Legalistas</b></td>
              <td><input type="radio" class="form-check-input" required <?php echo ($row->nilai_asset==1)?'checked':'' ?>  name="dokumen" id="dokumen1" value="1">Lengkap</td> -->
            </tr>
            <tr>
              <th scope="row"><b>LB(M2)</b></th>
              <td>{{$row->luas_bangunan}}</td>
                 <th scope="row"><b>Status Hunian</b></th>
              <td><?php if($row->status_rumah==1){
                echo "Dihuni";
              }else{
                echo "Tidak Dihuni";
              } ?></td>
       <!--        <td><input type="radio" class="form-check-input" required <?php echo ($row->nilai_asset==0)?'checked':'' ?> name="dokumen" id="dokumen1" value="0">Tidak/Kurang Lengkap</td> -->
            </tr>
            <tr>
              <?php if($row->estimasi_biaya==''){
                $estimasi_biaya='';
              }else{
                $estimasi_biaya=$row->estimasi_biaya;
              } ?>
              <th scope="row"><b>Jenis Jaminan</b></th>
              <td>{{$row->nama_jenis_jaminan}}</td>
              <td><b>Estimasi Biaya</b></td>
              <td><input type="money" class="form-control" required name="estimasi_biaya" value="{{$estimasi_biaya}}"></td>
            </tr>
              <tr>
              <?php if($row->harga_jual_apprasial==''){
                $harga_jual_apprasial='';
              }else{
                $harga_jual_apprasial=$row->harga_jual_apprasial;
              } ?>
              <th scope="row"><b>Harga Jual</b></th>
              <td>Rp.&nbsp;{{number_format($row->harga_jual)}}</td>
              <td><b>Harga Jual Apprasial</b></td>
              <td><input type="money" class="form-control" required name="harga_jual_apprasial" value="{{$harga_jual_apprasial}}"></td>
            </tr>
          <tr>
                   <?php if($row->nilai_pasar_apprasial==''){
                $nilai_pasar_apprasial='';
              }else{
                $nilai_pasar_apprasial=$row->nilai_pasar_apprasial;
              } ?>
              <th scope="row"><b>Surveyor</b></th>
              <td>{{$row->nama_surveyor}}</td>
              <td><b>Nilai Pasar Apprasial</b></td>
              <td><input type="money" class="form-control" required name="nilai_pasar_apprasial" value="{{$nilai_pasar_apprasial}}"></td>
            </tr>
             <tr>
              <th scope="row"><b>Alamat</b></th>
              <td>{{$row->alamat}}</td>
              <td><b>LTV Apprasial</b></td>
              <td>{{ceil($row->ltv_apprasial)}} %</td>
            </tr>
        <!--      <tr>
              <th scope="row"><b>Lokasi Check In</b></th>
              <td><a href="" class="btn btn-sm btn-primary">Lihat Map</a></td>
              <td></td>
              <td></td>
            </tr> -->

        <!--    <tr>
              <th scope="row"><b>Dokumen Legalitas</b></th>
              <td><?php if($row->dokumen_legalitas==1){
                echo "Dokumen Lengkap";
              }else{
                echo "Dokumen Tidak Lengkap";
              } ?></td>
              <td></td>
              <td></td>
            </tr>


              <tr>
              <th scope="row"><b>Status Hunian</b></th>
              <td><?php if($row->status_rumah==1){
                echo "Dihuni";
              }else{
                echo "Tidak Dihuni";
              } ?></td>
              <td></td>
              <td></td>
            </tr> -->


           <!--    <tr>
              <th scope="row"><b>Status Lokasi Jalan</b></th>
              <td><?php if($row->status_lokasi==1){
                echo "Dekat Jalan Raya";
              }else{
                echo "Jauh Jalan Raya";
              } ?></td>
              <td></td>
              <td></td>
            </tr> -->

              <tr>
              <th scope="row"><b>Baki Debet</b></th>
              <td>Rp.&nbsp;{{number_format($row->baki_debet)}}</td>
                <th scope="row"><b>Status Lokasi Jalan</b></th>
              <td><?php if($row->status_lokasi==1){
                echo "Dekat Jalan Raya";
              }else{
                echo "Jauh Jalan Raya";
              } ?></td>
            </tr>
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

              <tr>
              <th scope="row"><b>Biaya Awal</b></th>
              <td>Rp.&nbsp;{{number_format($row->harga)}}</td>
              <td><b>Grade</b></td>
              <td>{{$column_value}}</td>
            </tr>


            <!--   <tr>
              <th scope="row"><b>Denda</b></th>
              <td>-</td>
              <td></td>
              <td></td>
            </tr> -->

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
              <td>{{ceil($row->ltv)}}&nbsp;%</td>
              <td></td>
              <td></td>
            </tr>

            <tr>
              <th scope="row"><b>Nama Debitur</b></th>
              <td>{{$row->nama_debitur}}</td>
              <td></td>
              <td></td>
            </tr>

            <tr>
              <th scope="row"><b>Tanggal Survey</b></th>
              <td>{{$row->created_at}}</td>
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