<?php namespace App\Http\Controllers;

		use Session;
		use Request;
		use DB;
		use CRUDBooster;

		class ApiPersetujuanBindingController extends \crocodicstudio\crudbooster\controllers\ApiController {

		    function __construct() {    
				$this->table       = "bidding";        
				$this->permalink   = "persetujuan_binding";    
				$this->method_type = "post";    
		    }
		

		    public function hook_before(&$postdata) {
		        //This method will be execute before run the main process
		    	$id_komite		= g('id_komite');
		    	$id_bidding		= g('id_bidding');

		    	$ambil			= DB::table('bidding')->where('id',$id_bidding)->first();
		    	if (empty($ambil)) {
		    		$response['api_status']  	   = 0;
					$response['api_message'] 	   = 'error';
					$response['api_authorization'] = 'Tidak ada data untuk id ini !';
		    	}else{
		    		if (g('status')=='Terima') {
		    			$ub['jumlah_terima'] = $ambil->jumlah_terima+1;
		    			$ub['status']="Diterima";
		    			$status_agunan['status']="Terjual";
		    		}elseif(g('status')=='Tolak'){
		    			$ub['jumlah_tolak']  = $ambil->jumlah_tolak+1;
		    			$ub['status']="Ditolak";
		    		}else{
		    			$response['api_status']  	   = 0;
						$response['api_message'] 	   = 'error';
						$response['api_authorization'] = 'Status must Terima or Tolak';
						$response['api_http']		   = 200;
						response()->json($response)->send();
						exit();
		    		}
		    		
		    		$eks = DB::table('bidding')->where('id',$id_bidding)->update($ub);
		    		if ($eks) {
		    			$cek = DB::table('bidding_action')->where('id_bidding',$id_bidding)
		    			->where('id_komite',$id_komite)->first();

		    			if (empty($cek)) {
		    				$sv['created_at']	= date('Y-m-d H:i:s');
			    			$sv['id_bidding']	= $id_bidding;
			    			$sv['id_komite']	= $id_komite;
			    			DB::table('bidding_action')->insert($sv);
		    			}
		    			
		    			$response['api_status']  	   = 1;
						$response['api_message'] 	   = 'success';
						$response['api_authorization'] = 'You are in debug mode !';
						$response['api_http']		   = 200;
		    		}else{
		    			$response['api_status']  	   = 0;
						$response['api_message'] 	   = 'error';
						$response['api_authorization'] = 'You are in debug mode !';
						$response['api_http']		   = 200;
		    		}

		    	}
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