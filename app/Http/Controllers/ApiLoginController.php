<?php namespace App\Http\Controllers;

		use Session;
		use Request;
		use DB;
		use CRUDBooster;
		use Hash;

		class ApiLoginController extends \crocodicstudio\crudbooster\controllers\ApiController {

		    function __construct() {    
				$this->table       = "users";        
				$this->permalink   = "login";    
				$this->method_type = "post";    
		    }
		

		    public function hook_before(&$postdata) {
		        //This method will be execute before run the main process

		    }

		    public function hook_query(&$query) {
		        //This method is to customize the sql query
		    	$email    = g('email');
				$password = g('password');
				$regid    = g('regid');
				$role 	  = g('role');
				// definisi parameter yang diminta

				$users	  = DB::table('users')
				->where('deleted_at',null)
				->where('email',$email)
				->where('role',$role)->first();

				if (empty($users)) {

					$response['api_status']  = 0;
					$response['api_message'] = 'Email anda masukkan belum terdaftar, silahkan cek kembali';

				}else{


					if (!Hash::check($password,$users->password)) {
						$response['api_status']  = 0;
						$response['api_message'] = 'Password yang anda masukan tidak sesuai, silahkan cek kembali';
					}else{
						$ubah['regid']			   = $regid;
						DB::table('users')->where('id',$users->id)->update($ubah);

						$response['api_status']    = 1;
						$response['api_message']   = 'Login berhasil, anda login sebagai '.$users->role.'';
						$response['user_id']            = $users->id;
						$response['user_nama']     = $users->nama;
						$response['user_email']    = $users->email;
						$response['user_telp']     = $users->telp;
						$response['user_foto']     = asset($users->photo);
						$response['user_role'] 	   = $users->role;
						$response['user_id_area']  = $users->id_area;

					}
				}
				response()->json($response)->send();
				exit();
		    }

		    public function hook_after($postdata,&$result) {
		        //This method will be execute after run the main process

		    }

		}