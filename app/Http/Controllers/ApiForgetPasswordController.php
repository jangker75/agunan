<?php namespace App\Http\Controllers;

		use Session;
		use Request;
		use DB;
		use CRUDBooster;
		use Hash;
		class ApiForgetPasswordController extends \crocodicstudio\crudbooster\controllers\ApiController {

		    function __construct() {    
				$this->table       = "users";        
				$this->permalink   = "forget_password";    
				$this->method_type = "post";    
		    }
			public function GenerateKode($email){
				/*
				 * pengecekan user yang ingin di berikan kode
				 */
				$users = DB::table('users')
					->where('email',$email)
					->first();

				if (empty($users)) { #jika tidak terdaftar menampilkan error
					$response['api_status']  = 0;
					$response['api_message'] = 'Error, Email not found';
					response()->json($response)->send();
					exit();
				}else{ #jika ada membuat kode baru
					/*
					 * Deklarasi kebutuhan pembuatan kode
					 */
					$length_abjad = 2;
					$length_angka = 4;
					$huruf        = "ABCDEFGHJKMNPRSTUVWXYZ";
					$i            = 1;
					$txt_abjad    = "";

					#loop huruf dengan random kode
					while ($i <= $length_abjad) {
						$txt_abjad .= $huruf{mt_rand(0,strlen($huruf))};
						$i++;
					}

					/*
					 * Penggabungan huruf dan angka
					 */
					$datejam  = date("His");
					$time_md5 = rand(time(), $datejam);
					$cut      = substr($time_md5, 0, $length_angka);	
					$acak     = str_shuffle($txt_abjad.$cut);

					/*
					 * mengecek apakah user memiliki kode yang sama atau tidak
					 */
					$cek = DB::table('users')
						->where('password','=',Hash::make($acak))
						->first(); 
					if(!empty($cek)) { 
						/*
						 * Jika kode terdaftar harus mencari kode baru
						 * Manual loop function untuk mencari kode baru
						 */
						$acak = self::GenerateKode(); 
					}
					return $acak;
				}
			}

		    public function hook_before(&$postdata) {
		        //This method will be execute before run the main process
		    	$email=g('email');
		    	$check = DB::table('users')
					->where('email',$email)
					->first();
				if (empty($check)) {
					
					/*
					 * Memabatalkan aksi karena email tidak tersedia
					 */
					$response['api_status']  = 0;
					$response['api_message'] = 'Email anda salah, atau belum terdaftar, silahkan masukkan email dengan bennar';
					response()->json($response)->send();
					exit();
				}else{
					/*
					 * mengirimkan ulang password
					 */
					$password_baru		   = self::GenerateKode($email);
					$password['password']  = $password_baru;
					CRUDBooster::sendEmail(['to'=>$email,'data'=>$password,'template'=>'forget_password']);
					$ganti['password']= Hash::make($password_baru);
					//melakukan pengubahan password
					$ubah=DB::table('users')
					->where('email',$email)
					->update($ganti);

					if ($ubah) {
						$response['api_status']  = 1;
						$response['api_message'] = 'Password telah dikirim kealamat email, silahkan cek email anda';
						response()->json($response)->send();
						exit();
					}else{
						$response['api_status']  = 0;
						$response['api_message'] = 'Gagal melakukan pengubahan password';
						response()->json($response)->send();
						exit();
					}
					

				}
		    }

		    public function hook_query(&$query) {
		        //This method is to customize the sql query

		    }

		    public function hook_after($postdata,&$result) {
		        //This method will be execute after run the main process

		    }

		}