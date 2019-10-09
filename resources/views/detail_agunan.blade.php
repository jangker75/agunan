<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')
@section('content')

 <div style="margin-bottom: 20px">
    <a href="{{url(CRUDBooster::mainpath())}}"><i class="fa fa-chevron-circle-left"></i> Back To List Agunan</a> &nbsp;
    <!--  <button class="btn btn-sm btn-primary" onclick="sub()" style="padding-left: 20px;padding-right: 20px">Submit</button> -->
  </div>

  <div class='panel panel-default'>
    <div class='panel-heading' style="padding:20px"><b>Detail Apprasial</b> 
    	<buttom data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-sm pull-right" >Export Pdf&nbsp; <i class="fa fa-upload"></i></button></div>
    <div class='panel-body'>      

      <table class="table">
        <tbody>
          <?php $cek=DB::table('area_cakupan')
          ->join('provinsi','area_cakupan.id_provinsi','=','provinsi.id')
          ->join('kabupaten','area_cakupan.id_kabupaten','=','kabupaten.id')
          ->where('id_area',$row->id_area)
          ->select('kabupaten.nama as kabupaten','provinsi.nama as provinsi')
          ->first();
          ?>
           <tr>
          <td><b>Nomor Kode Aset</b></td>
          <td>{{$row->kode_uniq}}</td>
        </tr>
        <tr>
          <td><b>Area</b></td>
          <td>{{$row->nama_area}}</td>
        </tr>

         <tr>
          <td><b>Sertifikat</b></td>
          <td>{{$row->nama_sertifikat}}</td>
        </tr>

         <tr>
          <td><b>Luas Tanah</b></td>
          <td>{{$row->luas_tanah}} m2</td>
        </tr>

         <tr>
          <td><b>Luas Bangunan</b></td>
          <td>{{$row->luas_bangunan}} m2</td>
        </tr>

         <tr>
          <td><b>Jenis jaminan</b></td>
          <td>{{$row->nama_jenis_jaminan}}</td>
        </tr>

         <tr>
          <td><b>Status jaminan</b></td>
          <td>{{$row->nama_status_jaminan}}</td>
        </tr>

         <tr>
          <td><b>Kode jaminan</b></td>
          <td>{{$row->kode_jaminan}}</td>
        </tr>

         <tr>
          <td><b>Harga jual</b></td>
          <td>Rp.{{number_format($row->harga_jual)}}</td>
        </tr>

         <tr>
          <td><b>Alamat</b></td>
          <td>{{$row->alamat}}</td>
        </tr>

             <tr>
          <td><b>Kelurahan</b></td>
          <td></td>
        </tr>


         <tr>
          <td><b>Kecamatan</b></td>
          <td></td>
        </tr>

            <tr>
          <td><b>Kabupaten</b></td>
          <td>{{$cek->kabupaten}}</td>
        </tr>


         <tr>
          <td><b>Provinsi</b></td>
          <td>{{$cek->provinsi}}</td>
        </tr>

<!-- 
         <tr>
          <td><b>Area</b></td>
          <td>{{$row->nama_area}}</td>
        </tr> -->

         <tr>
          <td><b>Surveyor</b></td>
          <td>{{$row->nama_surveyor}}</td>
        </tr>
<!-- 
         <tr>
          <td><b>Area</b></td>
          <td>{{$row->nama_area}}</td>
        </tr> -->

         <tr>
          <td><b>Keterangan</b></td>
          <td>{{$row->keterangan}}</td>
        </tr>

         <tr>
          <td><b>Baki debet</b></td>
          <td>Rp.{{number_format($row->baki_debet)}}</td>
        </tr>


         <tr>
          <td><b>Biaya</b></td>
          <td>Rp.{{number_format($row->biaya)}}</td>
        </tr>


         <tr>
          <td><b>Amu Bwu</b></td>
          <td>{{$row->amu_bwu}}</td>
        </tr>


         <tr>
          <td><b>Draft PU</b></td>
          <td>{{$row->draft_pu}}</td>
        </tr>


         <tr>
          <td><b>Gol</b></td>
          <td>{{$row->gol}}</td>
        </tr>


         <tr>
          <td><b>Product</b></td>
          <td>{{$row->product}}</td>
        </tr>


         <tr>
          <td><b>Status Survey</b></td>
          <td>{{$row->status_survey}}</td>
        </tr>


         <tr>
          <td><b>status</b></td>
          <td>{{$row->status}}</td>
        </tr>


         <tr>
          <td><b>Ltv</b></td>
          <td>{{$row->ltv}}%</td>
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
          <td><b>Grade</b></td>
          <td>{{$column_value}}</td>
        </tr>


         <tr>
          <td><b>Nilai Likuidasi</b></td>
          <td>Rp.{{number_format($row->nilai_likuidasi)}}</td>
        </tr>


         <tr>
          <td><b>Nilai Pasar</b></td>
          <td>Rp.{{number_format($row->nilai_pasar)}}</td>
        </tr>


         <tr>
          <td><b>Nama Debitur</b></td>
          <td>{{$row->nama_debitur}}</td>
        </tr>

        <?php $usr=DB::table('agunan')->join('users','agunan.id_sales','=','users.id')
        ->where('agunan.id',$row->id)
        ->select('users.nama')
        ->first();

        $img=DB::table('agunan_image')->where('id_agunan',$row->id)->get();

         ?>

         <tr>
          <td><b>Sales</b></td>
          <td>{{$usr->nama}}</td>
        </tr>

        @foreach($img as $key)
        <form method="post" action="{{CRUDBooster::mainpath('delfoto/'.$key->id)}}">
          {{csrf_field()}}
        <tr>
          <td><b>Foto</b></td>
          <input type="hidden" name="foto" value="{{$key->image}}">
          <td><img src="{{asset($key->image)}}" style="width: 200px;height: auto;"></td>
          <td><input type="submit" class="btn btn-danger btn-sm" value="Delete" name=""></td>
        </tr>
      </form>
        @endforeach

       <!--  <?php 
          $img=DB::table('survey')->join('agunan','survey.id_agunan','=','agunan.id')->where('agunan.id',$row->id)->select('survey.*')->first();
        ?>

      @if($img->status=='Approved')
        @if($img->image_1!=null)
        <form method="post" action="{{CRUDBooster::mainpath('fotosurvey/'.$img->id)}}">
          {{csrf_field()}}
        <tr>
          <input type="hidden" name="foto" value="image_1">
          <td><b>Foto Survey</b></td>
          <td><img src="{{asset($img->image_1)}}" style="width: 200px;height: auto;"></td>
          <td><input type="submit" class="btn btn-danger btn-sm" value="Delete" name=""></td>
        </tr>
      </form>
        @endif

        @if($img->image_2!=null)
        <form method="post" action="{{CRUDBooster::mainpath('fotosurvey/'.$img->id)}}">
          {{csrf_field()}}
        <tr>
           <input type="hidden" name="foto" value="image_2">
          <td></td>
          <td><img src="{{asset($img->image_2)}}" style="width: 200px;height: auto;"></td>
          <td><input type="submit" class="btn btn-danger btn-sm" value="Delete" name=""></td>
        </tr>
      </form>
        @endif

        @if($img->image_3!=null)
         <form method="post" action="{{CRUDBooster::mainpath('fotosurvey/'.$img->id)}}">
          {{csrf_field()}}
        <tr>
           <input type="hidden" name="foto" value="image_3">
          <td></td>
          <td><img src="{{asset($img->image_3)}}" style="width: 200px;height: auto;"></td>
          <td><input type="submit" class="btn btn-danger btn-sm" value="Delete" name=""></td>
        </tr>
      </form>
        @endif

        @if($img->image_4!=null)
         <form method="post" action="{{CRUDBooster::mainpath('fotosurvey/'.$img->id)}}">
          {{csrf_field()}}
        <tr>
          <input type="hidden" name="foto" value="image_4">
          <td></td>
          <td><img src="{{asset($img->image_4)}}" style="width: 200px;height: auto;"></td>
          <td><input type="submit" class="btn btn-danger btn-sm" value="Delete" name=""></td>
        </tr>
      </form>
        @endif
@endif -->

      </tbody>
      </table>
        
        </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Print PDF</h4>
        </div>
        <div class="modal-body">
          <form id="myform" method="get" action="{{url(CRUDBooster::mainpath('pdf/'.$row->id))}}">
            {{csrf_field()}} 
            <div class="form-group">
              <label>Pilih Kertas</label>
              <select class="form-control" name="kertas">
                <option value="A4">A4</option>
                <option value="A5">A5</option>
              </select>
            </div>
           <!--  <input type="submit" class="btn btn-sm btn-primary" value="Print"> -->
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" onclick="sub()" class="btn btn-primary">Print</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
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