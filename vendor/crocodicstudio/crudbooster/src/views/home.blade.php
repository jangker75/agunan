@extends('crudbooster::admin_template')

@section('content')
<style type="text/css">
	.progress-description a{
		color: #fff !important;
		font-weight: bold;
	}

    .rectangle {
      width: 20px;
      height: 20px;
      background: red;
    }
  

</style>
<?php 
  $j_agunan = DB::table('agunan')->where('status','Dilelang')
  ->where('deleted_at',null)
  ->count();
  $j_cola   = DB::table('survey')->where('status','Approved')
  ->where('deleted_at',null)
  ->count();
  $j_sales  = DB::table('users')->where('role','Sales')
  ->where('deleted_at',null)
  ->count();
  $j_survoyor=DB::table('users')->where('role','Surveyor')
  ->count();
  $j_jual   = DB::table('agunan')->where('status','Terjual')
  ->count();

  $asset_katalog=DB::table('survey')->where('status','Approved')->whereNotNull('ltv_apprasial')->count();

  $laporan_surveyor=DB::table('survey')->whereNull('ltv_apprasial')->where('status','Waiting')->count();

  $asset_belum_masuk_katalog=DB::table('survey')->whereNull('ltv_apprasial')->where('status','Approved')->count();

  $p_bid=DB::table('bidding')->get();
  $data=[];
  foreach ($p_bid as $key => $value) {
  	$list=$value->id_agunan;
  	array_push($data, $list);
  }

  $bidding=DB::table('agunan')->whereIn('id',$data)->where('status','Dilelang')->get();
  $data_bid=count($bidding);


  //agunan belum di survei

  $p_survey=DB::table('survey')->get();
  $surv=[];
  foreach ($p_survey as $row => $val) {
  	# code...
  	$list1=$value->id_agunan;
  	array_push($surv, $list1);
  }

  $b_survei=DB::table('agunan')->whereIn('id',$surv)->get();
  $total_agunan=DB::table('agunan')->count();

  $belum_survei=count($b_survei);

  $surve=$total_agunan-$belum_survei;

    $belum_di_survei=DB::table('agunan')->whereNull('status_survey')->count();

$da=[];
for ($i=1; $i <=12 ; $i++) { 
	if($_GET['selected']){
	$survey=DB::table('survey')->whereMonth('created_at', $i)->whereYear('created_at',$_GET['selected'])->count();
	}else{
	$survey=DB::table('survey')->whereMonth('created_at', $i)->whereYear('created_at',date('Y'))->count();
	}
	array_push($da, $survey);
}

$bid=[];
for ($i=1; $i <=12 ; $i++) {
	if($_GET['selected']){
	$bar_bid=DB::table('bidding')->whereMonth('created_at', $i)->whereYear('created_at',$_GET['selected'])->count();
	}else{
	$bar_bid=DB::table('bidding')->whereMonth('created_at', $i)->whereYear('created_at',date('Y'))->count();
	}
	array_push($bid, $bar_bid);
}

$ag=[];
for ($i=1; $i <=12 ; $i++) {
  if($_GET['selected']){
  $bar_ag=DB::table('agunan')->whereMonth('created_at', $i)->whereYear('created_at',$_GET['selected'])
  ->where('status','Terjual')->count();
  }else{
  $bar_ag=DB::table('agunan')->whereMonth('created_at', $i)->whereYear('created_at',date('Y'))
   ->where('status','Terjual')->count();  
  }
  array_push($ag, $bar_ag);
}



$t_biaya=[];
for ($i=0; $i <=12 ; $i++) { 
	if($_GET['selected']){
	$bar_biaya=DB::table('agunan')->whereMonth('created_at',$i)->whereYear('created_at',$_GET['selected'])->select(DB::raw('SUM(biaya) as biaya'))->first();
	}else{
	$bar_biaya=DB::table('agunan')->whereMonth('created_at',$i)->whereYear('created_at',date('Y'))->select(DB::raw('SUM(biaya) as biaya'))->first();	
	}


	if($bar_biaya->biaya==null){
		$bi=0;
	}elseif($bar_biaya==0){
		$bi=0;
	}else{
		$bi=$bar_biaya->biaya;
	}

	array_push($t_biaya, $bi);
}

$t_penjualan=[];
for ($i=0; $i <=12 ; $i++) { 
	if($_GET['selected']){
	$bar_penjualan=DB::table('agunan')->whereMonth('created_at',$i)->whereYear('created_at',$_GET['selected'])->select(DB::raw('SUM(harga_jual) as harga_jual'))->first();
	}else{
	$bar_penjualan=DB::table('agunan')->whereMonth('created_at',$i)->whereYear('created_at',date('Y'))->select(DB::raw('SUM(harga_jual) as harga_jual'))->first();	
	}

	if($bar_penjualan->harga_jual==null){
		$pen=0;
	}elseif($bar_penjualan->harga_jual==0){
		$pen=0;	
	}else{
		$pen=$bar_penjualan->harga_jual;
	}

	array_push($t_penjualan, $pen);
}



$t_laba=[];
for ($i=0; $i <=12 ; $i++) { 
	if($_GET['selected']){
	$bar=DB::table('agunan')->whereMonth('created_at',$i)->whereYear('created_at',$_GET['selected'])->select(DB::raw('SUM(harga_jual) as harga_jual'),DB::raw('SUM(biaya) as biaya'))->first();
	}else{
	$bar=DB::table('agunan')->whereMonth('created_at',$i)->whereYear('created_at',date('Y'))->select(DB::raw('SUM(harga_jual) as harga_jual'),DB::raw('SUM(biaya) as biaya'))->first();	
	}

	$laba=$bar->harga_jual-$bar->biaya;
	if($laba<=0){
		$labaa=0;
	}else{
		$labaa=$laba;
	}

	array_push($t_laba, $labaa);
}


$top_bidding=DB::table('bidding')
->join('users','bidding.id_sales','=','users.id')
->join('agunan','bidding.id_agunan','=','agunan.id')
->select('users.nama as nama_sales','bidding.*','agunan.nama_debitur as nama_debitur')->orderBy('bidding.created_at', 'desc')->limit(10)
->get();


$top_komite=DB::table('bidding')
->join('users','bidding.id_komite','=','users.id')
->select('bidding.*','users.nama as nama_komite')
->get();

// dd($top_komite);

$top=[];
foreach ($top_komite as $key => $value) {
	$list=$value->id_komite;

	array_push($top, $list);
}

$top_10=DB::table('users')->join('area','users.id_area','=','area.id')->whereIn('users.id',$top)->select('area.nama as nama_area','users.*')->get();

// dd(json_encode($ag));

// $top_komite=DB::table('agunan')->

  ?>
<div class="row">
    <div class="col-lg-4 col-xs-6">
      <div class="info-box bg-yellow">
        <span class="info-box-icon"><i class="fa fa-home"></i></span>

        <div class="info-box-content">
          <span class="info-box-text"><b>jumlah aset</b></span>
          <span class="info-box-number">{{$j_agunan}}</span>

          <div class="progress">
            <div class="progress-bar" style="width: 100%"></div>
          </div>
          <span class="progress-description">
               <a href="{{crudbooster::adminpath('agunan')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </span>
        </div>
        <!-- /.info-box-content -->
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-xs-6">
      <!-- small box -->
      <div class="info-box bg-green">
        <span class="info-box-icon"><i class="fa fa-random"></i></span>

        <div class="info-box-content">
          <span class="info-box-text"><b>aset di katalog</b></span>
          <span class="info-box-number">{{$asset_katalog}}</span>

          <div class="progress">
            <div class="progress-bar" style="width: 100%"></div>
          </div>
          <span class="progress-description">
                <a href="{{crudbooster::adminpath('assigned_collateral')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
           </span>
        </div>
        <!-- /.info-box-content -->
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-xs-6">
      <!-- small box -->
      <div class="info-box bg-red">
        <span class="info-box-icon"><i class="fa fa-random"></i></span>

        <div class="info-box-content">
          <span class="info-box-text"><b>Laporan Surveyor</b></span>
          <span class="info-box-number">{{$laporan_surveyor}}</span>

          <div class="progress">
            <div class="progress-bar" style="width: 100%"></div>
          </div>
          	<span class="progress-description">
                <a href="{{crudbooster::adminpath('laporan_surveyor')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
           	</span>
        </div>
        <!-- /.info-box-content -->
      </div>
    </div>

<!-- row 2 -->

   <div class="col-lg-4 col-xs-6">
      <div class="info-box bg-green">
        <span class="info-box-icon"><i class="fa fa-users"></i></span>

        <div class="info-box-content">
          <span class="info-box-text"><b>aset di bidding</b></span>
          <span class="info-box-number">{{$data_bid}}</span>

          <div class="progress">
            <div class="progress-bar" style="width: 100%"></div>
          </div>
          <span class="progress-description">
               <a href="{{crudbooster::adminpath('survey39')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </span>
        </div>
        <!-- /.info-box-content -->
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-xs-6">
      <!-- small box -->
      <div class="info-box bg-aqua">
        <span class="info-box-icon"><i class="fa fa-calendar"></i></span>

        <div class="info-box-content">
          <span class="info-box-text"><b>aset belum survey</b></span>
          <span class="info-box-number">{{$belum_di_survei}}</span>

          <div class="progress">
            <div class="progress-bar" style="width: 100%"></div>
          </div>
          <span class="progress-description">
                <a href="{{crudbooster::adminpath('assign_surveyor')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
           </span>
        </div>
        <!-- /.info-box-content -->
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-xs-6">
      <!-- small box -->
      <div class="info-box bg-yellow">
        <span class="info-box-icon"><i class="fa fa-shopping-cart"></i></span>

        <div class="info-box-content">
          <span class="info-box-text"><b>aset menunggu apprasial</b></span>
          <span class="info-box-number">{{$asset_belum_masuk_katalog}}</span>

          <div class="progress">
            <div class="progress-bar" style="width: 100%"></div>
          </div>
          	<span class="progress-description">
                <a href="{{crudbooster::adminpath('survey')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
           	</span>
        </div>
        <!-- /.info-box-content -->
      </div>
    </div>

    <!-- ./col -->
    <div class="col-lg-4 col-xs-6">
      <!-- small box -->
      <div class="info-box bg-green">
        <span class="info-box-icon"><i class="fa fa-users"></i></span>

        <div class="info-box-content">
          <span class="info-box-text"><b>jumlah sales</b></span>
          <span class="info-box-number">{{$j_sales}}</span>

          <div class="progress">
            <div class="progress-bar" style="width: 100%"></div>
          </div>
          	<span class="progress-description">
                <a href="{{crudbooster::adminpath('master_sales')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </span>
        </div>
        <!-- /.info-box-content -->
      </div>
 	  </div>
    <div class="col-lg-4 col-xs-6">
      <!-- small box -->
      <div class="info-box bg-aqua">
        <span class="info-box-icon"><i class="fa fa-calendar"></i></span>

        <div class="info-box-content">
          <span class="info-box-text"><b>jumlah surveyor</b></span>
          <span class="info-box-number">{{$j_survoyor}}</span>

          <div class="progress">
            <div class="progress-bar" style="width: 100%"></div>
          </div>
          <span class="progress-description">
                <a href="{{crudbooster::adminpath('surveyor')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
           </span>
        </div>
        <!-- /.info-box-content -->
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-xs-6">
      <!-- small box -->
      <div class="info-box bg-yellow">
        <span class="info-box-icon"><i class="fa fa-shopping-cart"></i></span>

        <div class="info-box-content">
          <span class="info-box-text"><b>agunan terjual</b></span>
          <span class="info-box-number">{{$j_jual}}</span>

          <div class="progress">
            <div class="progress-bar" style="width: 100%"></div>
          </div>
            <span class="progress-description">
                <a href="{{crudbooster::adminpath('history_penjualan')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </span>
        </div>
        <!-- /.info-box-content -->
      </div>
    </div>
    <!-- ./col -->


<div class="col-sm-6">
<div class="box box-info">
	<div class="box-header with-border">
		<h4 class="box-title"><b>TOP 10 KOMITE</b></h4>

		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
			</button>
			<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		</div>
	</div>

    <?php
     $bidding_last=DB::table('bidding')->get();

  $id_agunan_1=[];
  foreach ($bidding_last as $key) {
    $list=$key->id_agunan;
    array_push($id_agunan_1, $list);
  }


  $agunan_bid=DB::table('agunan')
  // ->join('bidding','agunan.id','=','bidding.id_agunan')
  ->whereIn('id',$id_agunan_1)
  // ->select('agunan.*')
  // ->orderByRaw('COUNT(agunan.id)')
  ->get();

  // dd($agunan_bid);
  foreach ($agunan_bid as $key) {
    $count['total_bidding']=DB::table('bidding')->where('id_agunan',$key->id)->count();
    DB::table('agunan')->where('id',$key->id)->Update($count);
  }

  $finish=DB::table('agunan')->whereIn('id',$id_agunan_1)->orderBy('total_bidding','desc')->limit(10)->get();

   ?>
	<!-- /.box-header -->
	<div class="box-body">
		<div class="table-responsive">
			<table class="table no-margin">
				<thead>
					<tr>
						<th>No</th>
						<th>Tanggal Update</th>
						<th>Kode Jaminan</th>
						<th>Alamat</th>
						<th>Total Terima</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $a=1; ?>
					@foreach($finish as $rows)
					<tr>
					<td>{{$a++}}</td>
					<td><?php echo date("j F, Y", strtotime($rows->created_at)) ?></td>
					<td>{{$rows->kode_jaminan}}</td>
					<td>{{$rows->nama_area}}</td>
					<td><?php $total_bid=DB::table('bidding')->where('id_agunan',$rows->id)->count(); echo $total_bid; ?></td>
					 <td><a href="{{CRUDBooster::mainpath('detail_bidding?id_agunan='.$rows->id)}}">view</a></td>
					</tr>
					@endforeach

				</tbody>
			</table>
		</div>
		<!-- /.table-responsive -->
	</div>
	<!-- /.box-body -->

	<!-- /.box-footer -->
</div>
</div>
<!-- /.box -->
<div class="col-sm-6">
<div class="box box-warning">
	<div class="box-header with-border">
		<h4 class="box-title"><b>TOP 10 BIDDING</b></h4>

		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
			</button>
			<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
		</div>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<div class="table-responsive">
			<table class="table no-margin">
				<thead>
					<tr>
						<th>No</th>
						<th>Tanggal Update</th>
						<th>Nama Debitur</th>
						<th>Nama penawar</th>
						<th>Nama Salaes</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $i=1; ?>
					@foreach($top_bidding as $key)
					<tr>
						<td>{{$i++}}</td>
						<td><?php echo date("j F, Y", strtotime($key->created_at)) ?></td>
						<td>{{$key->nama_debitur}}</td>
						<td>{{$key->nama}}</td>
						<td>{{$key->nama_sales}}</td>
						<td><a href="{{CRUDBooster::mainpath('detail_bidding/detail/'.$key->id)}}">view</a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<!-- /.table-responsive -->
	</div>
	<!-- /.box-body -->
	</div>
	<!-- /.box-footer -->
</div>


    <div class="col-sm-12">
      <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Nilai Penjualan Aset</h3>

            <div class="box-tools pull-right">
               <div class="btn-group btn-custom-group">
              <a  class="caret-drop-down dropdown-toggle btn-sm btn btn-default btn-sm btn" data-toggle="dropdown"><span id="change-year-order" class="text-info-custom">
              	<?php if($_GET['selected']){
              		echo $_GET['selected'];
              	}else{
              		echo date('Y');
              	} ?>
           <span class="caret"></span> </span></a>
              <ul class="dropdown-menu drop-custom" role="menu">
              	<?php for ($i=2018; $i <=2030 ; $i++) { ?>
                <li><a href="{{crudbooster::mainpath('?selected='.$i)}}">{{$i}}</a></li>
                <?php } ?>
              </ul>
            </div>
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
              <div class="col-sm-11">  
            <div class="chart">
              <canvas id="barChart" style="height:230px"></canvas>
            </div>
          </div>
           <div class="col-sm-1">
                  <ul class="chart-legend clearfix">
                    <li><i class="fa fa-circle text-red"></i> Laba</li>
                    <li><i class="fa fa-circle text-green"></i> Total Penjualan</li>
                    <li><i class="fa fa-circle"  style="color: yellow"></i> Total Biaya</li>
                  </ul>
                </div>
          </div>
          <!-- /.box-body -->
        </div>
    </div>

    <div class="col-sm-12">
      <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Grafik Jumlah Aset</h3>

            <div class="box-tools pull-right">
               <div class="btn-group btn-custom-group">
              <a  class="caret-drop-down dropdown-toggle btn-sm btn btn-default btn-sm btn" data-toggle="dropdown"><span id="change-year-order" class="text-info-custom">
              	<?php if($_GET['selected']){
              		echo $_GET['selected'];
              	}else{
              		echo date('Y');
              	}?> <span class="caret"></span> </span></a>
              <ul class="dropdown-menu drop-custom" role="menu">
                <?php for ($i=2018; $i <=2030 ; $i++) { ?>
                <li><a href="{{crudbooster::mainpath('?selected='.$i)}}">{{$i}}</a></li>
                <?php } ?>
              </ul>
            </div>
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <div class="col-sm-11">
            <div class="chart">
              <canvas id="constChart" style="height:230px"></canvas>
            </div>
          </div>
          <div class="col-sm-1">
                 <ul class="chart-legend clearfix">
                    <li><i class="fa fa-circle text-red"></i> Terjual</li>
                    <li><i class="fa fa-circle text-green"></i> Bidding</li>
                    <li><i class="fa fa-circle" style="color: yellow"></i> Survey</li>
                  </ul>

          </div>
        </div>
          <!-- /.box-body -->
        </div>
    </div>

</div>


<?php 
foreach ($ag as $key => $value) {
	$bar_agunan_terjual .= $value.",";
} 

foreach ($da as $key1 => $value1) {
	$bar_survey .= $value1.",";
}

foreach ($bid as $key2 => $value2) {
	$bar_bidding .= $value2.",";
}  


//bar 2

foreach ($t_biaya as $key3 => $value3) {
	// $biaya_bar .= number_format($value3,2,'.','').",";
	$biaya_bar .= $value3.",";
}

foreach ($t_penjualan as $key4 => $value4) {
	$penjualan_bar .= $value4.",";
}

foreach ($t_laba as $key5 => $value5) {
	$laba_bar .= $value5.",";
}

// dd($biaya_bar);
 ?>

@endsection
@push('bottom')
  <script src="{{url('js/Chart.js')}}"></script>
	<script type="text/javascript">
		$(function(){
			$('body').addClass('sidebar-collapse sidebar-mini');
			$('.logo').html('<b>AM</b>');
		      bil=0;
		      $(".sidebar-toggle").click(function(){
		        hasil=bil % 2
		        if (hasil==0) {
		          $('.logo').html('<b>Aset Management</b>');
		        }else {
		          $('.logo').html('<b>AM</b>');
		        }
		        bil++;
		      });
		})
	</script>


  <script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

      var DataMoney = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July','August','September','October','November','December'],
      datasets: [
        {
          label               : 'Electronics',
          fillColor           : 'rgba(255,255,0,1)',
          strokeColor         : 'rgba(255,255,0,1)',
          pointColor          : 'rgba(255,255,0,1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?php echo $bar_survey; ?>]
      },
        {
          label               : 'Digital Goods',
          fillColor           : 'rgba(0,128,0,1)',
          strokeColor         : 'rgba(0,128,0,1)',
          pointColor          : 'rgba(0,128,0,1)',
          pointStrokeColor    : '#3b8bba',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [<?php echo $bar_bidding; ?>]
        },
         {
          label               : 'Electronics',
          fillColor           : 'rgba(128,0,0,1)',
          strokeColor         : 'rgba(128,0,0,1)',
          pointColor          : 'rgba(128,0,0,1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?php echo $bar_agunan_terjual; ?>]
        }
      ],
    }


    var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July','August','September','October','November','December'],
      datasets: [
        {
          label               : 'Electronics',
          fillColor           : 'rgba(255,255,0,1)',
          strokeColor         : 'rgba(255,255,0,1)',
          pointColor          : 'rgba(255,255,0,1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?php echo $biaya_bar; ?>]
        },
        {
          label               : 'Digital Goods',
          fillColor           : 'rgba(0,128,0,1)',
          strokeColor         : 'rgba(0,128,0,1)',
          pointColor          : 'rgba(0,128,0,1)',
          pointStrokeColor    : '#3b8bba',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [<?php echo $penjualan_bar; ?>]
        },
         {
          label               : 'Electronics',
          fillColor           : 'rgba(128,0,0,1)',
          strokeColor         : 'rgba(128,0,0,1)',
          pointColor          : 'rgba(128,0,0,1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?php echo $laba_bar; ?>]
        }
      ]

    }

    var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale               : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : false,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - Whether the line is curved between points
      bezierCurve             : true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension      : 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot                : false,
      //Number - Radius of each point dot in pixels
      pointDotRadius          : 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth     : 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius : 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke           : true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth      : 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill             : true,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio     : true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive              : true,

      legend: {
        display: true,
        position: 'bottom',
        labels: {
          fontColor: 'rgb(255, 99, 132)'
        }
      }


    }


    //-------------

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
    var barChart                         = new Chart(barChartCanvas)
    var barChartData                     = areaChartData
    barChartData.datasets[1].fillColor   = '#00a65a'
    barChartData.datasets[1].strokeColor = '#00a65a'
    barChartData.datasets[1].pointColor  = '#00a65a'
    var barChartOptions                  = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero        : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - If there is a stroke on each bar
      barShowStroke           : true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth          : 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing         : 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing       : 1,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true
    }

    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions)




    var barChartCanvas                   = $('#constChart').get(0).getContext('2d')
    var barChart                         = new Chart(barChartCanvas)
    var moneyChartData                     = DataMoney 
    moneyChartData.datasets[1].fillColor   = '#00a65a'
    moneyChartData.datasets[1].strokeColor = '#00a65a'
    moneyChartData.datasets[1].pointColor  = '#00a65a'
    var barChartOptions                  = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero        : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - If there is a stroke on each bar
      barShowStroke           : true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth          : 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing         : 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing       : 1,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true

    }

    barChartOptions.datasetFill = false
    barChart.Bar(moneyChartData, barChartOptions)


    
  })
</script>
@endpush