<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Invoice - #123</title>
		<style type="text/css">
			@page {
				margin: 0px;
			}
			p {
				margin: 0px !important;
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
		
			.invoice table {
				margin: 10px;
			}
			.invoice h3 {
				margin-left: 15px;
			}
			.information {
				background-color: #0e99fb;
				color: #FFF;
			}
			.information .logo {
				margin: 5px;
			}
			.information table {
				padding: 10px;
			}
			.luar{
				border: 3px solid black;
				margin: 5px;
			}
			table {
				border: 0px solid black;
				font-size:15px;
				/*border: none;*/
				/*border-collapse: collapse;*/
			}
			th, td {
				border: 0px solid black;
				/*border: none;*/
				padding-left: 0px;
				text-align: left;
			}
		</style>
		<!-- <link rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}"> -->

	</head>

	<body>

		<div class="information">
			<table width="100%" >
				<tr>
					<td style="width: 2%;color:black;text-align: center">
					<p style="font-size:26px;text-align: center;color: black;font-family:Arial">
						<b>Katalog Aset</b>
					</p></td>
				</tr>

			</table>
		</div>
		<?php $pic = DB::table('agunan') -> join('users', 'agunan.id_surveyor', '=', 'users.id') -> select('users.*') -> where('agunan.id', $data -> id) -> first();

			$us = DB::table('users') -> join('area', 'users.id_area', '=', 'area.id') -> select('area.*') -> where('users.id', $pic -> id) -> first();
		?>
		<p style="text-align: center;color: black;font-family:Arial">
			<b>&nbsp;</b>
			 <!-- <b>{{$data->nama_jenis_jaminan}}</b> -->
		</p>
		<p style="text-align: center;color: black;font-family: Arial">
			<b>&nbsp;</b>
		 <!-- <b>Kode Penjualan :&nbsp;{{$data->kode_jaminan}}</b> -->
		</p>

		<table width="100%" class="luar">
			<tbody>
				<tr>
					<td width="30%"> @if($image!=null) <!-- table image -->
					<table style="margin-left: 0px">
						<tbody>
							<?php $cek = []; ?>

							@foreach($image as $key)
							<?php

							$list['id'] = $key -> id;

							array_push($cek, $list);
							?>
							@endforeach

							<?php
							$str1 = DB::table('agunan_image') -> where('id', $cek[0]['id']) -> whereNull('survey') -> first();
							$str2 = DB::table('agunan_image') -> where('id', $cek[1]['id']) -> whereNull('survey') -> first();

							$storage = str_replace(Request::root(), "app", storage_path($str1 -> image));
							$url = str_replace("//", "/", $storage);

							$storage1 = str_replace(Request::root(), "app", storage_path($str2 -> image));
							$url1 = str_replace("//", "/", $storage1);

							$img1 = DB::table('agunan_image') -> where('id', $cek[0]['id']) -> where('survey', 'Done') -> first();
							$img2 = DB::table('agunan_image') -> where('id', $cek[1]['id']) -> where('survey', 'Done') -> first();
							?>

							<?php
							$image1 = str_replace(Request::root(), "", public_path($img1 -> image));
							$image11 = str_replace("//", "/", $image1);

							$image2 = str_replace(Request::root(), "", public_path($img2 -> image));
							$image22 = str_replace("//", "/", $image2);
							?>

							@if($img1)
							<tr>
								@if($img1)
								<td style="padding:0;text-align: center"><img src="{{$image11}}" width="300px" height="230px"></td>
								@endif
							</tr>
							<tr>
								<!-- <td style="text-align: center!important;">MAP LOKASI</td> -->
								@if($img2)
								<td style="padding:0;text-align: center"><img src="{{$image22}}" width="300px" height="230px"></td>
								@endif
								<!-- <td style="text-align: center!important;">MAP LOKASI</td> -->
							</tr>
							@elseif($str1)
							<tr>
								@if($str1)
								<td style="padding:0;text-align: center"><img src="{{$url}}" width="300px" height="240px"></td>
								@endif
							</tr>
							<tr>
								@if($str2)
								<td style="padding:0;text-align: center"><img src="{{$url1}}" width="300px" height="240px"></td>
								@endif
							</tr>
							@else
							<tr>
							
								<td style="padding:0;text-align: center"><img src="https://tshop.r10s.com/00a/90f/8513/8dd3/c069/ff36/ac0b/11bbe8aa01a81e84d03674.jpg" width="300px" height="230px"></td>
							
							</tr>
							@endif
						</tbody>
					</table> @endif

					<?php $pic = DB::table('agunan') -> join('users', 'agunan.id_surveyor', '=', 'users.id') -> select('users.*') -> where('agunan.id', $data -> id) -> first();

	$us = DB::table('users') -> join('area', 'users.id_area', '=', 'area.id') -> select('area.*') -> where('users.id', $pic -> id) -> first();
					?> <!-- table data --></td>
					<td width="70%" valign="top">
					<table width="100%" style="margin-left: 0px;alignment-adjust: center">
						<tbody>
							<?php $surv = DB::table('survey') -> where('id_agunan', $data -> id) -> first();

							if ($surv -> status_lokasi == 1) {$lok = "Sangat Strategis, Akses Jalan Lebar";
							} else {$lok = "Kurang Strategis";
							}
							?>
							<tr>
								<th style="font-size: 15px">Alamat</th>
								<td style="text-align: right;padding: 0px">:</td>
								<td style="font-size: 15px">{{$data->alamat}}</td>
							</tr>
							<tr>
								<th style="font-size: 15px; ">Akses Lokasi</th>
								<td style="text-align: right;padding: 2px">:</td>
								<td style="padding: 2px;font-size: 15px;">{{$lok}}</td>
							</tr>
							<?php
							if ($data -> longitude != null && $data -> latitude != null) {
								$lat = $data -> latitude;
								$long = $data -> longitude;
							} else {
								$lat = $surv -> checkin_lat;
								$long = $surv -> checkin_long;
							}
							?>
							<tr>
								<th style="font-size: 15px; ">Sertifikat</th>
								<td style="text-align: right;padding: 2px">:</td>
								<td style="padding: 2px;font-size: 15px;">{{$data->nama_sertifikat}}</td>
							</tr>
							<tr>
								<th style="font-size: 15px; ">Koordinat Map</th>
								<td style="text-align: right;padding: 2px">:</td>
								<td style="padding: 2px;font-size: 15px;">Lat.{{$lat}},&nbsp;Long.{{$long}}</td>
							</tr>
							<tr>
								<th style="font-size: 15px; ">Luas Tanah</th>
								<td style="text-align: right;padding: 2px">:</td>
								<td style="padding: 2px;font-size: 15px;">{{$data->luas_tanah}} M2</td>
							</tr>
							<tr>
								<th style="font-size: 15px; ">Harga Jual</th>
								<td style="text-align: right;padding: 2px">:</td>
								<td style="padding: 2px;font-size: 15px;">Rp.{{number_format($surv->harga_jual_apprasial)}}</td>
							</tr>
							<tr>
								<th style="font-size: 15px; ">Luas Bangunan</th>
								<td style="text-align: right;padding: 2px">:</td>
								<td style="padding: 2px;font-size: 15px;">{{$data->luas_bangunan}} M2</td>
							</tr>
							<tr>
								<th style="font-size: 15px; ">Nomor Kode Aset</th>
								<td style="text-align: right;padding: 2px">:</td>
								<td style="padding: 2px;font-size: 15px;">{{$data->kode_uniq}}</td>

							</tr>

						</tbody>
					</table></td>
					</tr>
			</tbody>
		</table>

		<!-- </div> -->

	</body>

</html>