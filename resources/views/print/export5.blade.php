<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice - #123</title>

    <style type="text/css">
        @page {
            margin: 0px;
        }
        p{
            margin: 0px!important;
        }
        body {
            margin: 0px;
        }
        * {
            font-family: Arial;
        }
        a {
            color: #fff;
            text-decoration: none;
        }
        table {
            font-size: x-small;
        }
        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }
        .invoice table {
            margin: 10px;
        }
        .invoice h3 {
            margin-left: 15px;
        }
        .information {
            background-color:#0e99fb;
            color: #FFF;
        }
        .information .logo {
            margin: 5px;
        }
        .information table {
            padding: 0px;
        }

      table, th, td {
          /*border: 1px solid black;*/
         border: none;
          border-collapse: collapse;
      }
      th, td {
            border: none;
          padding: 0px;
          text-align: left;
      }
    </style>
     <link rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}">

</head>
<body>


<div class="information">
    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td style="width: 2%;color:white;text-align: center">
                <p style="font-size: 18px;font-family: Arial!important;">Katalog Penjualan Asset</p>
        </tr>

    </table>
</div>

@if($image!=null)
<table width="100%" class="table" style="margin-bottom: 0px!important">

       <?php $cek=[]; ?>

      @foreach($image as $key)
        <?php 

        $list['id']=$key->id;

        array_push($cek,$list);

        ?>
        @endforeach


        <?php 
        $str1=DB::table('agunan_image')->where('id',$cek[0]['id'])->whereNull('survey')->first(); 
        $str2=DB::table('agunan_image')->where('id',$cek[1]['id'])->whereNull('survey')->first(); 

        $storage=str_replace(Request::root(),"app", storage_path($str1->image));
        $url=str_replace("//", "/", $storage);

        $storage1=str_replace(Request::root(),"app", storage_path($str2->image));
        $url1=str_replace("//", "/", $storage1);

        $img1=DB::table('agunan_image')->where('id',$cek[0]['id'])->where('survey','Done')->first(); 
        $img2=DB::table('agunan_image')->where('id',$cek[1]['id'])->where('survey','Done')->first(); 

        ?>

        <?php 
        $image1=str_replace(Request::root(),"", public_path($img1->image));
        $image11=str_replace("//", "/", $image1);

        $image2=str_replace(Request::root(),"", public_path($img2->image));
        $image22=str_replace("//", "/", $image2);
        ?>


       @if($img1)
        <tr>
           <td style="text-align: center!important">
            <img src="{{$image11}}" width="200" height="120">
        </td>
    </tr>
        @elseif($str1)
         <tr>
           <td style="text-align: center!important">
            <img src="{{$url}}" width="200" height="120">
        </td>
    </tr>
        @else

        @endif  
          @if($img2)
        <tr>
           <td style="text-align: center!important">
            <img src="{{$image22}}" width="200" height="120">
        </td>
    </tr>
        @elseif($str1)
         <tr>
           <td style="text-align: center!important">
            <img src="{{$url1}}" width="200" height="120">
        </td>
    </tr>
        @else

        @endif    

</table>
 @endif
<?php $pic=DB::table('agunan')->join('users','agunan.id_surveyor','=','users.id')->select('users.*')->where('agunan.id',$data->id)->first(); 
    
    $us=DB::table('users')->join('area','users.id_area','=','area.id')->select('area.*')->where('users.id',$pic->id)->first();
?>
<p style="text-align: center;color: black;font-family: Arial!important"><b>Tanah & Bangunan</b></p>
<!-- <h2 style="text-align: center;color: red">{{$image2}}</h2> -->
<p style="text-align: center;color: black;font-family: Arial!important"><b>Kode Penjualan :&nbsp;{{$data->kode_jaminan}}</b></p>
<div class="invoice">

<!--     <h5 style="margin-left: 30px">Informasi Asset</h5> -->
 <table width="100%" class="table" style="margin-left: 20px" border="0">
        <tbody>
        <tr>
            <th style="padding: 2px;font-size: 12px;border-color: transparent;">Alamat</th>
            <td style="text-align: right;padding: 2px;border-color: transparent;">:</td>
            <td style="padding: 2px;font-size: 12px;border-color: transparent;">{{$data->alamat}}</td>
        </tr>
         <tr>
            <th style="padding: 2px;font-size: 12px;border-color: transparent;">Sertifikat</th>
            <td style="text-align: right;padding: 2px;border-color: transparent;">:</td>
            <td style="padding: 2px;font-size: 12px;border-color: transparent;">{{$data->nama_sertifikat}}</td>
        </tr>
            <tr>
            <th style="padding: 2px;font-size: 12px;border-color: transparent;">Luas Tanah</th>
            <td style="text-align: right;padding: 2px;border-color: transparent;">:</td>
            <td style="padding: 2px;font-size: 12px;border-color: transparent;">{{$data->luas_tanah}} M2</td>
        </tr>
            <tr>
            <th style="padding: 2px;font-size: 12px;border-color: transparent;">Luas Bangunan</th>
            <td style="text-align: right;padding: 2px;border-color: transparent;">:</td>
            <td style="padding: 2px;font-size: 12px;border-color: transparent;">{{$data->luas_bangunan}} M2</td>
        </tr>
            <tr>
            <th style="padding: 2px;font-size: 12px;border-color: transparent;">Legalitas Tanah</th>
            <td style="text-align: right;padding: 2px;border-color: transparent;">:</td>
            <td style="padding: 2px;font-size: 12px;border-color: transparent;">{{$data->nama_sertifikat}}</td>
        </tr>

        <?php $surv=DB::table('survey')->where('id_agunan',$data->id)->first();

        if($surv->status_lokasi==1){$lok="Sangat Strategis, Akses Jalan Lebar";}else{$lok="Kurang Strategis";}

        ?>
        <tr>
            <th style="padding: 2px;font-size: 12px;border-color: transparent;">Akses Lokasi</th>
            <td style="text-align: right;padding: 2px;border-color: transparent;">:</td>
            <td style="padding: 2px;font-size: 12px;border-color: transparent;">{{$lok}}</td>
        </tr>

        <?php if($data->longitude!=null && $data->latitude!=null){
            $lat=$data->latitude;
            $long=$data->longitude;
        }else{
            $lat=$surv->checkin_lat;
            $long=$surv->checkin_long;
        }

         ?>

        <tr>
            <th style="padding: 2px;font-size: 12px;border-color: transparent;">Lokasi Map</th>
            <td style="text-align: right;padding: 2px;border-color: transparent;">:</td>
            <td style="padding: 2px;font-size: 12px;border-color: transparent;">Lat.{{$lat}},&nbsp;Long.{{$long}}</td>
        </tr>

        <tr>
            <th style="padding: 2px;font-size: 12px;border-color: transparent;">Harga Jual</th>
            <td style="text-align: right;padding: 2px;border-color: transparent;">:</td>
            <td style="padding: 2px;font-size: 12px;border-color: transparent;">Rp.{{number_format($surv->harga_jual_apprasial)}}</td>
        </tr>
        <tr>
            <th style="padding: 2px;font-size: 12px;border-color: transparent;">Hubungi</th>
            <td style="text-align: right;padding: 2px;border-color: transparent;">:</td>
            @if($user)
            <td style="padding: 2px;font-size: 12px;border-color: transparent;">Bpk.{{$user[0]->nama}} &nbsp;&nbsp; Hp.{{$user[0]->telp}}</td>
            @else
            <td style="padding: 2px;font-size: 12px;border-color: transparent;">-</td>
            @endif
        </tr>
        </tbody>
    </table>
    <hr>
</div>


</body>
</html>