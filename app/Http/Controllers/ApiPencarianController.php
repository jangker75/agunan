<?php namespace App\Http\Controllers;

		use Session;
		use Request;
		use DB;
		use CRUDBooster;

		class ApiPencarianController extends \crocodicstudio\crudbooster\controllers\ApiController {

		    function __construct() {    
				$this->table       = "agunan";        
				$this->permalink   = "pencarian";    
				$this->method_type = "post";    
		    }
		

		    public function hook_before(&$postdata) {
		  //       $id_komite = g('id_komite');
		  //       $alamat = g('alamat');
		  //       $limit	   = g('limit');
		  //       $offset	   = g('offset');
		  //       if ($limit!='' and $offset!='') {

		  //       	$cek_survey=DB::table('survey')->where('status','Approved')->whereNotNull('ltv_apprasial')->get();
		  //       	$cek=[];
		  //       	foreach ($cek_survey as $key => $value) {
		  //       		$list['id']=$value->id_agunan;

		  //       		array_push($cek,$list);
		  //       	}

		  //       	$kw  = DB::table('agunan')
		  //       	->whereIn('id',$cek)
		  //       	->where('status_survey','Done')
			 //    	->where('alamat','like','%'.$alamat.'%')
		  //       	->OFFSET($offset)->LIMIT($limit)->get();
		  //       }else{$cek_survey=DB::table('survey')->where('status','Approved')->whereNotNull('ltv_apprasial')->get();

	   //      		$cek=[];
	   //      		foreach ($cek_survey as $key => $value) {
	   //      			$list['id']=$value->id_agunan;

	   //      			array_push($cek,$list);
	   //      		}

		  //       	$cek_survey=DB::table('survey')->where('status','Approved')->whereNotNull('ltv_apprasial')->get();

	   //      		$cek=[];
	   //      		foreach ($cek_survey as $key => $value) {
	   //      			$list['id']=$value->id_agunan;

	   //      			array_push($cek,$list);
	   //      		}

		  //       	$kw  = DB::table('agunan')
		  //       	->whereIn('id',$cek)
		  //       	->where('status_survey','Done')
			 //    	->where('alamat','like','%'.$alamat.'%')
		  //       	->get();
		  //       }
		    	
	   //      	$bidding_act= DB::table('bidding_action')->where('id_komite',$id_komite)->first();
		  //   	$data   = [];
		  //   	foreach ($kw as $row) {
		  //   		$sales = DB::table('users')->where('id',$row->id_sales)->where('role','Sales')->first();
		  //   		$list['jenis_jaminan']= $row->nama_jenis_jaminan;
		  //   		$list['id']			= $row->id;
		  //   		$list['alamat']		= $row->alamat;
		  //   		$list['latitude']	= $row->latitude;
		  //   		$list['longitude']  = $row->longitude;
		  //   		$list['sales']		= $sales->nama;

		  //   		$surv=DB::table('survey')->where('id_agunan',$row->id)->first();


		  //   		$detail				= DB::table('survey')->where('id_agunan',$row->id)->first();
		  //   		$dt['note']			= $detail->note;
		  //   		$dt['image_1']		= asset($detail->image_1);
		  //   		$dt['image_2']		= asset($detail->image_2);
		  //   		$dt['image_3']		= asset($detail->image_3);
		  //   		$dt['image_4']		= asset($detail->image_4);
		  //   		if ($detail->image_5!='') {
		  //   			$dt['image_5']	= asset($detail->image_5);
		  //   		}
		  //   		if ($detail->image_6!='') {
		  //   			$dt['image_6']	= asset($detail->image_6);
		  //   		}
		  //   		$list['detail_survey'] = $dt;

		  //   		$data_a['alamat']	= $row->alamat;
		  //   		$data_a['harga']	= 'Rp ' . number_format($surv->harga_jual_apprasial, 0 , '' , '.');
		  //   		$data_a['sales']	= $sales->nama;
		  //   		$data_a['telp']		= $sales->telp;
		  //   		$data_a['kode_jaminan']=$row->kode_jaminan;

		  //   		$list['data_agunan']= $data_a;
		    		
		  //   		if (empty($bidding_act)) {
		  //   			$binding	= DB::table('bidding')->where('id_agunan',$row->id)->get();
		  //   		}else{
		  //   			$binding	= DB::table('bidding')->where('id_agunan',$row->id)
		  //   			->where('id','!=',$bidding_act->id_bidding)
		  //   			->get();
		  //   		}
		    			
		  //   		$bind 		= [];
		  //   		foreach ($binding as $key) {
		  //   			$bdng['id']			= $key->id;
		  //   			$bdng['nama']		= $key->nama;
		  //   			$bdng['telp']		= $key->telp;
		  //   			$bdng['nominal']	= 'Rp ' . number_format($key->nominal, 0 , '' , '.');
		  //   			array_push($bind,$bdng);
		  //   		}
		  //   		$list['data_binding']	= $bind;
		  //   		array_push($data,$list);
		  //   	};
		  //   	$response['api_status']  	   = 1;
				// $response['api_message'] 	   = 'success';
				// $response['api_authorization'] = 'You are in debug mode !';
				// $response['api_http']		   = 200;
				// $response['data']       	   = $data;
		  //   	response()->json($response)->send();
				// exit();

				 $id_komite = g('id_komite');
		        $limit	   = g('limit');
		        $offset	   = g('offset');
		        $alamat    =g('alamat');

		        if ($limit!='' and $offset!='') {

		        	$cek_survey=DB::table('survey')->where('status','Approved')->whereNotNull('ltv_apprasial')->get();
		        	$cek=[];
		        	foreach ($cek_survey as $key => $value) {
		        		$list['id']=$value->id_agunan;

		        		array_push($cek,$list);
		        	}
		    		$kw  = DB::table('agunan')
		    		->whereIn('id',$cek)
		    		->where('status_survey','Done')
		    		->where('status','Dilelang')
	        		->OFFSET($offset)->LIMIT($limit)->get();
	        	}else{
	        		$cek_survey=DB::table('survey')->where('status','Approved')->whereNotNull('ltv_apprasial')->get();
	        		$cek=[];
	        		foreach ($cek_survey as $key => $value) {
	        			$list['id']=$value->id_agunan;

	        			array_push($cek,$list);
	        		}
	        		  $kw  = DB::table('agunan')
	        		  ->whereIn('id',$cek)
	        		  ->where('status_survey','Done')
	        		  ->where('status','Dilelang')
	        		 ->get();
	        	};

	        	//cek status pending di bidding

	        	$cek_bid=[];
	        	foreach ($kw as $key => $value) {
	        		$l=$value->id;
	        		array_push($cek_bid, $l);
	        	}

	        	$bid_agunan=DB::table('bidding')->join('agunan','bidding.id_agunan','=','agunan.id')
	        	->whereIn('id_agunan',$cek_bid)
	        	->where('bidding.status','Pending')
	        	->select('bidding.*')
	        	->get();

	        	$bid_agunan1=[];
	        	foreach ($bid_agunan as $key => $value1) {
	        		$d=$value1->id_agunan;
	        		array_push($bid_agunan1,$d);
	        	}

	        	$kww=DB::table('agunan')->whereIn('id',$bid_agunan1)->where('alamat','like','%'.$alamat.'%')->get();
	        	
		    	$data   = [];
		    	foreach ($kww as $row) {
		    		$sales = DB::table('users')->where('id',$row->id_sales)->where('role','Sales')->first();
		    		$list['jenis_jaminan']= $row->nama_jenis_jaminan;
		    		$list['id']			= $row->id;
		    		$list['alamat']		= $row->alamat;
		    		$list['latitude']	= $row->latitude;
		    		$list['longitude']  = $row->longitude;
		    		$list['sales']		= $sales->nama;

		    		$surv=DB::table('survey')->where('id_agunan',$row->id)->first();

		    		$detail				= DB::table('survey')->where('id_agunan',$row->id)->first();
		    		$dt['note']			= $detail->note;
		    		$dt['image_1']		= asset($detail->image_1);
		    		$dt['image_2']		= asset($detail->image_2);
		    		$dt['image_3']		= asset($detail->image_3);
		    		$dt['image_4']		= asset($detail->image_4);
		    		if ($detail->image_5!='') {
		    			$dt['image_5']	= asset($detail->image_5);
		    		}else{
		    			$dt['image_5']  = '';
		    		}
		    		if ($detail->image_6!='') {
		    			$dt['image_6']	= asset($detail->image_6);
		    		}else{
		    			$dt['image_6']	= '';
		    		}
		    		$list['detail_survey'] = $dt;

		    		$data_a['alamat']	= $row->alamat;
		    		$data_a['harga']	= 'Rp ' . number_format($surv->harga_jual_apprasial, 0 , '' , '.');
		    		$data_a['sales']	= $sales->nama;
		    		$data_a['telp']		= $sales->telp;
		    		$data_a['kode_jaminan']=$row->kode_jaminan;
		    		$list['data_agunan']= $data_a;
		    		
		   
		    		$binding	= DB::table('bidding')->where('id_agunan',$row->id)->where('status','Pending')->get();
		    		
		    		$bind 		= [];
		    		foreach ($binding as $key) {
		    			$bidding_act= DB::table('bidding_action')->where('id_komite',$id_komite)
		    			->where('id_bidding',$key->id)
		    			->first();
		    			if (empty($bidding_act)) {
		    				$bdng['id']			= $key->id;
			    			$bdng['nama']		= $key->nama;
			    			$bdng['telp']		= $key->telp;
			    			$bdng['nominal']	= 'Rp ' . number_format($key->nominal, 0 , '' , '.');
			    			array_push($bind,$bdng);
			    			$bidding = true;
		    			}else{
		    				$bdng['id']			= $key->id;
			    			$bdng['nama']		= $key->nama;
			    			$bdng['telp']		= $key->telp;
			    			$bdng['nominal']	= 'Rp ' . number_format($key->nominal, 0 , '' , '.');
			    			array_push($bind,$bdng);
		    				$bidding = true;
		    			}
		    			
		    		}
		    		if ($bidding==true) {
		    			$list['data_binding']	= $bind;
		    			array_push($data,$list);
		    		}
		    	};

		    	$response['api_status']  	   = 1;
				$response['api_message'] 	   = 'success';
				$response['api_authorization'] = 'You are in debug mode !';
				$response['api_http']		   = 200;
				$response['data']       	   = $data;
		    	response()->json($response)->send();
				exit();

		    }

		    public function hook_query(&$query) {
		        //This method is to customize the sql query

		    }

		    public function hook_after($postdata,&$result) {
		        //This method will be execute after run the main process

		    }

		}