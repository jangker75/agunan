<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice - #123</title>

    <style type="text/css">
        @page {
            margin: 0px;
        }
        body {
            margin: 0px;
        }
        * {
            font-family: sans-serif;
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
            margin: 15px;
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
            padding: 5px;
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
            <td style="width: 40%;color:white;text-align: center">
                <h1 style="font-size: 42px;font-family: sans-serif!important;">Katalog Penjualan Asset</h1>
        </tr>

    </table>
</div>


<br/>

@if($image!=null)
<table width="100%" class="table">

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
        $str3=DB::table('agunan_image')->where('id',$cek[2]['id'])->whereNull('survey')->first(); 
        $str4=DB::table('agunan_image')->where('id',$cek[3]['id'])->whereNull('survey')->first(); 

        $storage=str_replace(Request::root(),"app", storage_path($str1->image));
        $url=str_replace("//", "/", $storage);

        $storage1=str_replace(Request::root(),"app", storage_path($str2->image));
        $url1=str_replace("//", "/", $storage1);

        $storage2=str_replace(Request::root(),"app", storage_path($str3->image));
        $url2=str_replace("//", "/", $storage2);

        $storage3=str_replace(Request::root(),"app", storage_path($str4->image));
        $url3=str_replace("//", "/", $storage3);

        $img1=DB::table('agunan_image')->where('id',$cek[0]['id'])->where('survey','Done')->first(); 
        $img2=DB::table('agunan_image')->where('id',$cek[1]['id'])->where('survey','Done')->first(); 
        $img3=DB::table('agunan_image')->where('id',$cek[2]['id'])->where('survey','Done')->first(); 
        $img4=DB::table('agunan_image')->where('id',$cek[3]['id'])->where('survey','Done')->first(); 
        ?>

        <?php 
        $image1=str_replace(Request::root(),"", public_path($img1->image));

        $image11=str_replace("//", "/", $image1);

        $image2=str_replace(Request::root(),"", public_path($img2->image));
        $image22=str_replace("//", "/", $image2);


        // $image3=str_replace(Request::root(),"app", storage_path($img3->image));
        $image3=str_replace(Request::root(),"", public_path($img3->image));
        $image33=str_replace("//", "/", $image3);

        $image4=str_replace(Request::root(),"", public_path($img4->image));
        $image44=str_replace("//", "/", $image4);


        ?>

 @if($img1)
        <tr>
           @if($img1)
           <td style="text-align: center!important">
            <img src="{{$image11}}" width="300" height="200">
        </td>  
        @endif    
        @if($img2)
        <td style="text-align: center!important">
            <img src="{{$image22}}" width="300" height="200">
        </td>
        @endif   
    </tr>
    <tr>
        @if($img3)
        <td style="text-align: center!important">
            <img src="{{$image33}}" width="300" height="200">
        </td> 
        @endif  
        @if($img4) 
        <td style="text-align: center!important">
            <img src="{{$image44}}" width="300" height="200">
        </td>    
        @endif  
    </tr>
@elseif($str1!=null)

<tr>
 @if($str1)
 <td style="text-align: center!important">
    <img src="{{$url}}" width="300" height="200">
</td>  
@endif    
@if($str2)
<td style="text-align: center!important">
    <img src="{{$url1}}" width="300" height="200">
</td>
@endif   
</tr>
<tr>
    @if($str3)
    <td style="text-align: center!important">
        <img src="{{$url2}}" width="300" height="200">
    </td> 
    @endif  
    @if($str4) 
    <td style="text-align: center!important">
        <img src="{{$url3}}" width="300" height="200">
    </td>    
    @endif  
</tr>
@else
<?php echo "no file";?>

@endif
</table>
 @endif
<?php $pic=DB::table('agunan')->join('users','agunan.id_surveyor','=','users.id')->select('users.*')->where('agunan.id',$data->id)->first(); 
    
    $us=DB::table('users')->join('area','users.id_area','=','area.id')->select('area.*')->where('users.id',$pic->id)->first();
?>
<h2 style="text-align: center;color: black;font-family: sans-serif!important">Tanah & Bangunan</h2>
<!-- <h2 style="text-align: center;color: red">{{$image2}}</h2> -->
<h4 style="text-align: center;color: black;font-family: sans-serif!important">Kode Penjualan :&nbsp;{{$data->kode_jaminan}}</h4>
<div class="invoice">

    <h3 style="margin-left: 60px">Informasi Asset</h3>
 <table width="100%" class="table" style="margin-left: 40px" border="none">
        <tbody>
        <tr>
            <th style="padding: 5px;font-size: 14px">Alamat</th>
            <td style="text-align: right">:</td>
            <td style="padding: 5px;font-size: 14px">{{$data->alamat}}</td>
        </tr>
         <tr>
            <th style="padding: 5px;font-size: 14px">Sertifikat</th>
            <td style="text-align: right">:</td>
            <td style="padding: 5px;font-size: 14px">{{$data->nama_sertifikat}}</td>
        </tr>

            <tr>
            <th style="padding: 5px;font-size: 14px">Luas Tanah</th>
            <td style="text-align: right">:</td>
            <td style="padding: 5px;font-size: 14px">{{$data->luas_tanah}} M2</td>
        </tr>

            <tr>
            <th style="padding: 5px;font-size: 14px">Luas Bangunan</th>
            <td style="text-align: right">:</td>
            <td style="padding: 5px;font-size: 14px">{{$data->luas_bangunan}} M2</td>
        </tr>

            <tr>
            <th style="padding: 5px;font-size: 14px">Legalitas Tanah</th>
            <td style="text-align: right">:</td>
            <td style="padding: 5px;font-size: 14px">{{$data->nama_sertifikat}}</td>
        </tr>

        <?php $surv=DB::table('survey')->where('id_agunan',$data->id)->first();

        if($surv->status_lokasi==1){$lok="Sangat Strategis, Akses Jalan Lebar";}else{$lok="Kurang Strategis";}

        ?>


        <tr>
            <th style="padding: 5px;font-size: 14px">Akses Lokasi</th>
            <td style="text-align: right">:</td>
            <td style="padding: 5px;font-size: 14px">{{$lok}}</td>
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
            <th style="padding: 5px;font-size: 14px">Lokasi Map</th>
            <td style="text-align: right">:</td>
            <td style="padding: 5px;font-size: 14px">Lat.{{$lat}},&nbsp;Long.{{$long}}</td>
        </tr>

        <tr>
            <th style="padding: 5px;font-size: 14px">Harga Jual</th>
            <td style="text-align: right">:</td>
            <td style="padding: 5px;font-size: 14px">Rp.{{number_format($surv->harga_jual_apprasial)}}</td>
        </tr>
           <tr>
            <th style="padding: 5px;font-size: 14px">Kode Uniq</th>
            <td style="text-align: right">:</td>
            <td style="padding: 5px;font-size: 14px">{{$data->kode_uniq}}</td>
        </tr>
        <tr>
            <th style="padding: 5px;font-size: 14px">Hubungi</th>
            <td style="text-align: right">:</td>
            @if($user)
            <td style="padding: 5px;font-size: 14px">Bpk.{{$user[0]->nama}} &nbsp;&nbsp; Hp.{{$user[0]->telp}}</td>
            @else
            <td style="padding: 5px;font-size: 14px">-</td>
            @endif
        </tr>

        <tr>
            <th style="font-size: 14px"></th>
            <td style="text-align:left;"></td>
               @if($user[1]->nama)
            <td style="padding: 5px;font-size: 14px">Bpk.{{$user[1]->nama}} &nbsp;&nbsp; Hp.{{$user[1]->telp}}</td>
            @else
            <td style="padding: 5px;font-size: 14px">-</td>
            @endif
        </tr>
      
        </tbody>
    </table>
</div>

<div class="information" style="position: absolute; bottom: 0;">
    <table width="100%">
        <tr>
            <td align="left" style="width: 50%;">
                &copy; {{ date('Y-m-d') }}.
            </td>
            <td align="right" style="width: 50%;">
                <!-- Agunan Revinit -->
            </td>
        </tr>

    </table>
</div>
</body>
</html>