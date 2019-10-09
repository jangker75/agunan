<?php namespace App\Http\Controllers;

		use Session;
		use Request;
		use DB;
		use CRUDBooster;
		// use Storage;
		// use File;

		class ApiInputSurveyController extends \crocodicstudio\crudbooster\controllers\ApiController {

		    function __construct() {    
				$this->table       = "survey";        
				$this->permalink   = "input_survey";    
				$this->method_type = "post";    
		    }
		

		    public function hook_before(&$postdata) {
		        //This method will be execute before run the main process
		        $date=date('Y-m');

		    	$note			= g('note');
		    	$checkin_lat	= g('checkin_lat');
		    	$checkin_long	= g('checkin_long');
		    	$in_radius		= g('in_radius');
		    	$image_1		= Request::file('image_1');
		    	$image_2		= Request::file('image_2');
		    	$image_3		= Request::file('image_3');
		    	$image_4		= Request::file('image_4');

		    	$image_5		= Request::file('image_5');
		    	$image_6		= Request::file('image_6');

		    	$id_surveyor	= g('id_surveyor');
		    	$id_agunan		= g('id_agunan');

		    	$dokumen_legalitas	=g('dokumen_legalitas');
		    	$status_rumah		=g('status_rumah');
		    	$status_lokasi		=g('status_lokasi');

		    	// $cek=DB::table('agunan')->where('id',$id_agunan)->first();

		    	// dd($cek);

		    	$status_survey['status_survey']='Done';
		    	$status_survey['longitude']=g('checkin_long');
		    	$status_survey['latitude']=g('checkin_lat');
		    	DB::table('agunan')->where('id',$id_agunan)->update($status_survey);


		    	if($dokumen_legalitas==1){
		    		$point_1=2;
		    	}else{
		    		$point_1=1;
		    	}

		    	if($status_rumah==1){
		    		$point_2=2;
		    	}else{
		    		$point_2=1;
		    	}

		    	if($status_rumah==1){
		    		$point_3=2;
		    	}else{
		    		$point_3=1;
		    	}

		    	$total=$point_1+$point_2+$point_3;

		    	$grade=DB::table('agunan')->where('id',$id_agunan)->first();

		    	$rslt['grade']=$total+$grade->grade;

		    	DB::table('agunan')->where('id',$grade->id)->update($rslt);


                $folder = 'uploads/1/'.$date;
                 // File::makeDirectory($folder);
                $cek 	= DB::table('agunan')->where('id',$id_agunan)
                ->where('id_surveyor',$id_surveyor)
                ->first();


                if (empty($cek)) {
                	$response['api_status']  	   = 0;
					$response['api_message'] 	   = 'ID agunan not founf';
					$response['api_authorization'] = 'You are in debug mode !';
					$response['api_http']		   = 200;
			    	response()->json($response)->send();
					exit();
                }else{

                	if ($image_1!='') {
			    		$img_1     = rand(11111,99999).".jpg";
		                $image_1->move($folder,$img_1);
		                $image_1   = $folder.'/'.$img_1;
			    	}

			    	if ($image_2!='') {
			    		$img_2     = rand(11111,99999).".jpg";
		                $image_2->move($folder,$img_2);
		                $image_2   = $folder.'/'.$img_2;
			    	}

			    	if ($image_3!='') {
			    		$img_3     = rand(11111,99999).".jpg";
		                $image_3->move($folder,$img_3);
		                $image_3   = $folder.'/'.$img_3;
			    	}

			    	if ($image_4!='') {
			    		$img_4     = rand(11111,99999).".jpg";
		                $image_4->move($folder,$img_4);
		                $image_4   = $folder.'/'.$img_4;
			    	}
			    	if ($image_5!='') {
			    		$img_5     = rand(11111,99999).".jpg";
		                $image_5->move($folder,$img_5);
		                $image_5   = $folder.'/'.$img_5;
			    	}else{
			    		$image_5   = '';
			    	}
			    	if ($image_6!='') {
			    		$img_6     = rand(11111,99999).".jpg";
		                $image_6->move($folder,$img_6);
		                $image_6   = $folder.'/'.$img_6;
			    	}else{
			    		$image_6   = '';
			    	}


			    	// eksekusi menyimpan
			    	$save['created_at']		= date('Y-m-d H:i:s');
			    	$save['in_radius']		= $in_radius;
			    	$save['note']			= $note;
			    	$save['checkin_lat']	= $checkin_lat;
			    	$save['checkin_long']	= $checkin_long;
			    	$save['image_1']		= $image_1;
			    	$save['image_2']		= $image_2;
			    	$save['image_3']		= $image_3;
			    	$save['image_4']		= $image_4;
			    	$save['image_5']		= $image_5;
			    	$save['image_6']		= $image_6;
			    	$save['id_surveyor']	= $id_surveyor;
			    	$save['id_agunan']		= $id_agunan;
			    	$save['dokumen_legalitas']=$dokumen_legalitas;
			    	$save['status_rumah']=$status_rumah;
			    	$save['status_lokasi']=$status_lokasi;

			    	$surv_foto=[];

			    	$list['id_agunan']=$id_agunan;
			    	$list['image']=url($image_1);
			    	$list['survey']="Done";

			    	$list1['id_agunan']=$id_agunan;
			    	$list1['image']=url($image_2);
			    	$list1['survey']="Done";

			    	$list2['id_agunan']=$id_agunan;
			    	$list2['image']=url($image_3);
			    	$list2['survey']="Done";

			    	$list3['id_agunan']=$id_agunan;
			    	$list3['image']=url($image_4);
			    	$list3['survey']="Done";

			    	array_push($surv_foto, $list);
			    	array_push($surv_foto, $list1);
			    	array_push($surv_foto, $list2);
			    	array_push($surv_foto, $list3);

			    	DB::table('agunan_image')->insert($surv_foto);


			    	$eks		= DB::table('survey')->insertGetId($save);
			    	if ($eks) {
			    		$response['api_status']  	   = 1;
						$response['api_message'] 	   = 'success';
						$response['api_authorization'] = 'You are in debug mode !';
						$response['api_http']		   = 200;
						$response['id_survey']     	   = $eks;
			    	}else{
			    		$response['api_status']  	   = 0;
						$response['api_message'] 	   = 'success';
						$response['api_authorization'] = 'You are in debug mode !';
						$response['api_http']		   = 200;
						$response['id_survey']     	   = '';
			    	}
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