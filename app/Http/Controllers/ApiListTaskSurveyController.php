<?php namespace App\Http\Controllers;

		use Session;
		use Request;
		use DB;
		use CRUDBooster;

		class ApiListTaskSurveyController extends \crocodicstudio\crudbooster\controllers\ApiController {

		    function __construct() {    
				$this->table       = "agunan";        
				$this->permalink   = "list_task_survey";    
				$this->method_type = "post";    
		    }
		

		    public function hook_before(&$postdata) {
		        //This method will be execute before run the main process
		        $cek = DB::table('agunan')->where('id_surveyor',g('id_surveyor'))->where('status_survey',null)->first();
		        if (empty($cek)) {
		        	$response['api_status']  	   = 1;
					$response['api_message'] 	   = 'success';
					$response['api_authorization'] = 'You are in debug mode !';
					$response['api_http']		   = 200;
					$response['data']     	 	   = [];
			    	response()->json($response)->send();
					exit();
		        }else{
		        	$limit	   = g('limit');
		        	$offset	   = g('offset');

		        	if ($limit!='' and $offset!='') {
			    		$kw  = DB::table('agunan')->where('id_surveyor',g('id_surveyor'))
		        		->where('status_survey',null)
		        		->OFFSET($offset)->LIMIT($limit)->get();
		        	}else{
		        		$kw  = DB::table('agunan')->where('id_surveyor',g('id_surveyor'))
			        	->where('status_survey',null)
			        	->get();
		        	}

			    	$data   = [];
			    	foreach ($kw as $row) {
			    		$list['id']			= $row->id;
			    		$list['kode_uniq']  =$row->kode_uniq;
			    		$list['kode_aset']=$row->kode_jaminan;
			    		$list['alamat']		= $row->alamat;
			    		$list['latitude']	= $row->latitude;
			    		$list['longitude']  = $row->longitude;
			    		array_push($data,$list);
			    	};
			    	$response['api_status']  	   = 1;
					$response['api_message'] 	   = 'success';
					$response['api_authorization'] = 'You are in debug mode !';
					$response['api_http']		   = 200;
					$response['data']     	 	   = $data;
			    	response()->json($response)->send();
					exit();

		        }
		    	
		    }

		    public function hook_query(&$query) {
		        //This method is to customize the sql query

		    }

		    public function hook_after($postdata,&$result) {
		        //This method will be execute after run the main process

		    }

		}