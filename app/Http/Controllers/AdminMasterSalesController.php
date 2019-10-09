<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;
	use Hash;

	class AdminMasterSalesController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {
	    	# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->table 			   = "users";	        
			$this->title_field         = "nama";
			$this->limit               = 20;
			$this->orderby             = "id,desc";
			$this->show_numbering      = FALSE;
			$this->global_privilege    = FALSE;	        
			$this->button_table_action = TRUE;   
			$this->button_action_style = "button_icon";     
			$this->button_add          = TRUE;
			$this->button_delete       = TRUE;
			$this->button_edit         = TRUE;
			$this->button_detail       = TRUE;
			$this->button_show         = false;
			$this->button_filter       = TRUE;        
			$this->button_export       = FALSE;	        
			$this->button_import       = FALSE;
			$this->button_bulk_action  = TRUE;	
			$this->sidebar_mode		   = "normal"; //normal,mini,collapse,collapse-mini
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Photo","name"=>"photo","image"=>true];
			$this->col[] = ["label"=>"Nama","name"=>"nama"];
			$this->col[] = ["label"=>"Email","name"=>"email"];
			$this->col[] = ["label"=>"Telp","name"=>"telp"];
			$this->col[] = ["label"=>"Area","name"=>"id_area","join"=>"area,nama"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Nama','name'=>'nama','type'=>'text','validation'=>'required|string|min:3|max:70','width'=>'col-sm-10','placeholder'=>'You can only enter the letter only'];
			$this->form[] = ['label'=>'Telp','name'=>'telp','type'=>'number','validation'=>'required|string|min:3','width'=>'col-sm-10','placeholder'=>'You can only enter the letter only'];
			$this->form[] = ['label'=>'Area','name'=>'id_area','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'area,nama'];
			$this->form[] = ['label'=>'Email','name'=>'email','type'=>'email','validation'=>'required|min:1|max:255|email|unique:users','width'=>'col-sm-10','placeholder'=>'Please enter a valid email address'];
			$this->form[] = ['label'=>'Password','name'=>'password','type'=>'password','validation'=>'min:3|max:32','width'=>'col-sm-10','help'=>'Minimum 5 characters. Please leave empty if you did not change the password.'];
			$this->form[] = ['label'=>'Photo','name'=>'photo','type'=>'upload','validation'=>'required|image|max:3000','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Role','name'=>'role','type'=>'hidden','validation'=>'required|min:1|max:255','width'=>'col-sm-10','value'=>'Sales'];
			# END FORM DO NOT REMOVE THIS LINE     

			/* 
	        | ---------------------------------------------------------------------- 
	        | Sub Module
	        | ----------------------------------------------------------------------     
			| @label          = Label of action 
			| @path           = Path of sub module
			| @foreign_key 	  = foreign key of sub table/module
			| @button_color   = Bootstrap Class (primary,success,warning,danger)
			| @button_icon    = Font Awesome Class  
			| @parent_columns = Sparate with comma, e.g : name,created_at
	        | 
	        */
	        $this->sub_module = array();


	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add More Action Button / Menu
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @url         = Target URL, you can use field alias. e.g : [id], [name], [title], etc
	        | @icon        = Font awesome class icon. e.g : fa fa-bars
	        | @color 	   = Default is primary. (primary, warning, succecss, info)     
	        | @showIf 	   = If condition when action show. Use field alias. e.g : [id] == 1
	        | 
	        */
	        $this->addaction = array();


	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add More Button Selected
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @icon 	   = Icon from fontawesome
	        | @name 	   = Name of button 
	        | Then about the action, you should code at actionButtonSelected method 
	        | 
	        */
	        $this->button_selected = array();

	                
	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add alert message to this module at overheader
	        | ----------------------------------------------------------------------     
	        | @message = Text of message 
	        | @type    = warning,success,danger,info        
	        | 
	        */
	        $this->alert        = array();
	                

	        
	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add more button to header button 
	        | ----------------------------------------------------------------------     
	        | @label = Name of button 
	        | @url   = URL Target
	        | @icon  = Icon from Awesome.
	        | 
	        */
	        $this->index_button = array();



	        /* 
	        | ---------------------------------------------------------------------- 
	        | Customize Table Row Color
	        | ----------------------------------------------------------------------     
	        | @condition = If condition. You may use field alias. E.g : [id] == 1
	        | @color = Default is none. You can use bootstrap success,info,warning,danger,primary.        
	        | 
	        */
	        $this->table_row_color = array();     	          

	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | You may use this bellow array to add statistic at dashboard 
	        | ---------------------------------------------------------------------- 
	        | @label, @count, @icon, @color 
	        |
	        */
	        $this->index_statistic = array();



	        /*
	        | ---------------------------------------------------------------------- 
	        | Add javascript at body 
	        | ---------------------------------------------------------------------- 
	        | javascript code in the variable 
	        | $this->script_js = "function() { ... }";
	        |
	        */
	        $this->script_js = NULL;


            /*
	        | ---------------------------------------------------------------------- 
	        | Include HTML Code before index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it before index table
	        | $this->pre_index_html = "<p>test</p>";
	        |
	        */
	        $this->pre_index_html = null;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include HTML Code after index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it after index table
	        | $this->post_index_html = "<p>test</p>";
	        |
	        */
	        $this->post_index_html = null;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include Javascript File 
	        | ---------------------------------------------------------------------- 
	        | URL of your javascript each array 
	        | $this->load_js[] = asset("myfile.js");
	        |
	        */
	        $this->load_js = array();
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Add css style at body 
	        | ---------------------------------------------------------------------- 
	        | css code in the variable 
	        | $this->style_css = ".style{....}";
	        |
	        */
	        $this->style_css = NULL;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include css File 
	        | ---------------------------------------------------------------------- 
	        | URL of your css each array 
	        | $this->load_css[] = asset("myfile.css");
	        |
	        */
	        $this->load_css = array();
	        
	        
	    }


	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for button selected
	    | ---------------------------------------------------------------------- 
	    | @id_selected = the id selected
	    | @button_name = the name of button
	    |
	    */
	    public function actionButtonSelected($id_selected,$button_name) {
	        //Your code here
	            
	    }


	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate query of index result 
	    | ---------------------------------------------------------------------- 
	    | @query = current sql query 
	    |
	    */
	    public function hook_query_index(&$query) {
	        //Your code here
	        $query->where('role','Sales')->get();
	            
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate row of index table html 
	    | ---------------------------------------------------------------------- 
	    |
	    */    
	    public function hook_row_index($column_index,&$column_value) {	        
	    	//Your code here
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before add data is execute
	    | ---------------------------------------------------------------------- 
	    | @arr
	    |
	    */
	    public function hook_before_add(&$postdata) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after add public static function called 
	    | ---------------------------------------------------------------------- 
	    | @id = last insert id
	    | 
	    */
	    public function hook_after_add($id) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before update data is execute
	    | ---------------------------------------------------------------------- 
	    | @postdata = input post data 
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_edit(&$postdata,$id) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after edit public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_edit($id) {
	        //Your code here 

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command before delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_delete($id) {
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_delete($id) {
	        //Your code here

	    }

	    public function login(){
	    	$email 		= g('email');
	    	$password 	= g('password');

	    	$cek = DB::table('users')->where('email',$email)
	    	->where('deleted_at',null)
	    	->where('role','Sales')
	    	->first();
	    	if (empty($cek)) {
	    		return redirect()->back()->with('error','Email tersebut belum terdaftar. Pastikan email yang anda masukkan benar');
	    	}else{
	    		if (!Hash::check(g('password'),$cek->password)) {
						return redirect()->back()->with('error','Password yang anda masukkan salah. Pastikan password yang anda masukkan benar')->withInput();
				}else{
					Session::put('id_sales', $cek->id);
		            Session::put('nama_sales', $cek->nama);
		            Session::put('email_sales', $cek->email);
		            Session::put('foto_sales', asset($cek->photo));
		            Session::put('id_area_sales', $cek->id_area);

		           
					return redirect('home');
				}
	    	}
	    }


	    public function logout(){

	        Session::flush();

	        return redirect('/');
	    }



	  
	    public function home(){

	    	$select=$_GET['selected'];

	    	$harga_akhir=g('harga_akhir');
	    	$luas_tanah=g('luas_tanah_dua');
	    	$luas_bangunan=g('luas_bangunan_dua');
	    	$price1=str_replace(".","", g('harga_awal'));
	    	$price2=str_replace(".","", $harga_akhir);
	    	$p1 = (int)$price1;
	    	$p2 = (int)$price2;

	    	if (!Session::get('id_sales')) {
				return redirect('/');
			}elseif($harga_akhir!='' && $luas_tanah=='' && $luas_bangunan==''){

				$id_area=Session::get('id_area_sales');
				$kw  = DB::table('survey')
				->join('agunan','survey.id_agunan','=','agunan.id')
				->where('agunan.status','Dilelang')
				->whereBetween('survey.harga_jual_apprasial',[$p1,$p2])
				->where(function($query) use ($id_area){
					$query->where('survey.id_area',$id_area)
					->orWhere('survey.id_area',0);
				})
				->select('survey.*','agunan.*')
				->get();
				 // dd($id_area);
				foreach ($kw as $key) {
					$ambil = DB::table('agunan_image')->where('id_agunan',$key->id)->whereNotNull('image')->first();
					$key->foto_agunan = asset($ambil->image);
					$key->harga 	  = 'Rp. '.number_format($key->harga_jual, 0 , '' , '.');
					$key->harga_jual_apprasial= 'Rp. '.number_format($key->harga_jual_apprasial, 0 , '' , '.');
				}

				$query  = DB::table('bidding')->where('bidding.id_sales',Session::get('id_sales'))->join('agunan','bidding.id_agunan','=','agunan.id')->select('bidding.nama','bidding.telp','bidding.created_at','bidding.nominal','agunan.nama_jenis_jaminan','agunan.id')->get();
				 // dd($id_area);
				foreach ($query as $row) {
					$ambil = DB::table('agunan_image')->where('id_agunan',$row->id)->whereNotNull('image')->first();
					$row->foto_agunan = asset($ambil->image);
					$row->nominal 	  = 'Rp. '.number_format($row->nominal, 0 , '' , '.');
					$row->created_at  = date('d M Y',strtotime($row->created_at));
				}
				 	

			}

			elseif($harga_akhir!='' && $luas_tanah!='' && $luas_bangunan!=''){

				// $data['price1']=$price1;
				// $data['price2']=$price2;;
				$luas_tanah_satu=g('luas_tanah_satu');
				$luas_tanah_dua=g('luas_tanah_dua');
				$luas_bangunan_satu=g('luas_bangunan_satu');
				$luas_bangunan_dua=g('luas_bangunan_dua');

				$cek['a']=$luas_tanah_satu;
				$cek['b']=$luas_tanah_dua;
				$cek['c']=$luas_bangunan_satu;
				$cek['d']=$luas_bangunan_dua;
				$cek['p']=$p1;
				$cek['p2']=$p2;

				$id_area=Session::get('id_area_sales');
				$kw  = DB::table('survey')
				->join('agunan','survey.id_agunan','=','agunan.id')
				->where('agunan.status','Dilelang')
				->whereBetween('survey.harga_jual_apprasial',[$p1,$p2])
				->whereBetween('agunan.luas_tanah',[$luas_tanah_satu,$luas_tanah_dua])
				->whereBetween('agunan.luas_bangunan',[$luas_bangunan_satu,$luas_bangunan_dua])
				->where(function($query) use ($id_area){
					$query->where('survey.id_area',$id_area)
					->orWhere('survey.id_area',0);
				})
				->select('survey.*','agunan.*')
				->get();

				foreach ($kw as $key) {
					$ambil = DB::table('agunan_image')->where('id_agunan',$key->id)->whereNotNull('image')->first();
					$key->foto_agunan = asset($ambil->image);
					$key->harga 	  = 'Rp. '.number_format($key->harga_jual, 0 , '' , '.');
					$key->harga_jual_apprasial= 'Rp. '.number_format($key->harga_jual_apprasial, 0 , '' , '.');
				}

				$query  = DB::table('bidding')->where('bidding.id_sales',Session::get('id_sales'))->join('agunan','bidding.id_agunan','=','agunan.id')->select('bidding.nama','bidding.telp','bidding.created_at','bidding.nominal','agunan.nama_jenis_jaminan','agunan.id')->get();
				 // dd($id_area);
				foreach ($query as $row) {
					$ambil = DB::table('agunan_image')->where('id_agunan',$row->id)->whereNotNull('image')->first();
					$row->foto_agunan = asset($ambil->image);
					$row->nominal 	  = 'Rp. '.number_format($row->nominal, 0 , '' , '.');
					$row->created_at  = date('d M Y',strtotime($row->created_at));
				}
				 	

			}elseif($select!=null){

				$id_area=Session::get('id_area_sales');
				$kw  = DB::table('survey')
				->join('agunan','survey.id_agunan','=','agunan.id')
				->where('agunan.status','Dilelang')
				->where(function($query) use ($id_area){
					$query->where('survey.id_area',$id_area)
					->orWhere('survey.id_area',0);
				})
				->orderby($select,'asc')
				->select('survey.*','agunan.*')
				->get();
				 // dd($id_area);
	            foreach ($kw as $key) {
	            	$ambil = DB::table('agunan_image')->where('id_agunan',$key->id)->whereNotNull('image')->first();
	            	$key->foto_agunan = asset($ambil->image);
	            	$key->harga 	  = 'Rp. '.number_format($key->harga_jual, 0 , '' , '.');
	            	$key->harga_jual_apprasial= 'Rp. '.number_format($key->harga_jual_apprasial, 0 , '' , '.');
	            }

	            $query  = DB::table('bidding')->where('bidding.id_sales',Session::get('id_sales'))->join('agunan','bidding.id_agunan','=','agunan.id')->select('bidding.nama','bidding.telp','bidding.created_at','bidding.nominal','agunan.nama_jenis_jaminan','agunan.id')->get();
				 // dd($id_area);
	            foreach ($query as $row) {
	            	$ambil = DB::table('agunan_image')->where('id_agunan',$row->id)->whereNotNull('image')->first();
	            	$row->foto_agunan = asset($ambil->image);
	            	$row->nominal 	  = 'Rp. '.number_format($row->nominal, 0 , '' , '.');
	            	$row->created_at  = date('d M Y',strtotime($row->created_at));
	            }


			}else{
				$id_area=Session::get('id_area_sales');
				// $cek=DB::table('survey')->where('id_area',$id_area)->orWhere('survey.id_area',0)->get();
				$kw  = DB::table('survey')
				->join('agunan','survey.id_agunan','=','agunan.id')
				->where('agunan.status','Dilelang')
				->where(function($query) use ($id_area){
					$query->where('survey.id_area',$id_area)
					->orWhere('survey.id_area',0);
				})
				->select('survey.*','agunan.*')->get();
				 // dd($id_area);
	            foreach ($kw as $key) {
	            	$ambil = DB::table('agunan_image')->where('id_agunan',$key->id)->whereNotNull('image')->first();
	            	$key->foto_agunan = asset($ambil->image);
	            	$key->harga 	  = 'Rp. '.number_format($key->harga_jual, 0 , '' , '.');
	            	$key->harga_jual_apprasial= 'Rp. '.number_format($key->harga_jual_apprasial, 0 , '' , '.');
	            }

	            $query  = DB::table('bidding')->where('bidding.id_sales',Session::get('id_sales'))->join('agunan','bidding.id_agunan','=','agunan.id')->select('bidding.nama','bidding.telp','bidding.created_at','bidding.nominal','agunan.nama_jenis_jaminan','agunan.id')->get();
				 // dd($id_area);
	            foreach ($query as $row) {
	            	$ambil = DB::table('agunan_image')->where('id_agunan',$row->id)->whereNotNull('image')->first();
	            	$row->foto_agunan = asset($ambil->image);
	            	$row->nominal 	  = 'Rp. '.number_format($row->nominal, 0 , '' , '.');
	            	$row->created_at  = date('d M Y',strtotime($row->created_at));
	            }

		  //       $data['agunan'] = $kw;
		  //       $data['history']= $query;
				// return view('home',$data);
			}

			$data['agunan'] = $kw;
			$data['history']= $query;
			return view('home',$data);
	    }

	    public function cari(){
	    	if (!Session::get('id_sales')) {
				return redirect('/');
			}else{
				$alamat = g('alamat');

				$id_area=Session::get('id_area_sales');
				if ($alamat=='') {
					$kw  = DB::table('survey')->where('survey.id_area',$id_area)->orWhere('survey.id_area',0)->join('agunan','survey.id_agunan','=','agunan.id')->select('survey.id_area','agunan.*')->get();
				}else{
					$kw  = DB::table('survey')
					->where('agunan.alamat','like','%'.$alamat.'%')	
					->Where(function($query)use($id_area){
			    		$query->where('survey.id_area',$id_area)
								->orWhere('survey.id_area',0);
			    	})			 
				 ->join('agunan','survey.id_agunan','=','agunan.id')->select('survey.id_area','agunan.*')->get();
				 // dd($id_area);
				}
				// dd($kw);
	            foreach ($kw as $key) {
	            	$ambil = DB::table('agunan_image')->where('id_agunan',$key->id)->whereNotNull('image')->first();
	            	$key->foto_agunan = asset($ambil->image);
	            	$key->harga 	  = 'Rp. '.number_format($key->harga_jual, 0 , '' , '.');
	            }

	            $query  = DB::table('bidding')->where('bidding.id_sales',Session::get('id_sales'))->join('agunan','bidding.id_agunan','=','agunan.id')->select('bidding.nama','bidding.telp','bidding.created_at','bidding.nominal','agunan.nama_jenis_jaminan','agunan.id')->get();
				 // dd($id_area);
	            foreach ($query as $row) {
	            	$ambil = DB::table('agunan_image')->where('id_agunan',$row->id)->whereNotNull('image')->first();
	            	$row->foto_agunan = asset($ambil->image);
	            	$row->nominal 	  = 'Rp. '.number_format($row->nominal, 0 , '' , '.');
	            	$row->created_at  = date('d M Y',strtotime($row->created_at));
	            }
		        $data['agunan'] = $kw;
		        $data['history']= $query;
				return view('home',$data);
			}
	    }

	    public function listbidding(){
	    	$id_agunan = g('id_agunan');

	    	$key  = DB::table('survey')->where('survey.id_agunan',$id_agunan)->join('agunan','survey.id_agunan','=','agunan.id')->select('survey.id_area','survey.*','agunan.*')->first();
	    	$image= DB::table('agunan_image')->where('id_agunan',$id_agunan)->whereNotNull('image')->get();
	    	$list['image_agunan'] = $image;
    		$area = DB::table('area')->where('id',$key->id_area)->first();
    		$surveyor = DB::table('users')->where('id',$key->id_surveyor)->first();
    		$list['harga']  	= 'Rp. '.number_format($key->harga_jual, 0 , '' , '.');
    		$list['harga_jual_apprasial']='Rp. '.number_format($key->harga_jual_apprasial, 0 , '' , '.');
    		$list['area']       = $area->nama;
    		$list['nama_pic']   = $surveyor->nama;
    		$list['telp_pic']   = $surveyor->telp;

    		$list['alamat']     = $key->alamat;
    		$list['sertifikat'] = $key->nama_sertifikat;
    		$list['luas_tanah'] = $key->luas_tanah;
    		$list['luas_bangunan']= $key->luas_bangunan;
    		$list['jenis_jaminan']= $key->nama_jenis_jaminan;
    		// $list['status_jaminan']= $key->nama_status_jaminan;
    		$list['status_jaminan']= $key->status;
    		$list['kode_jaminan'] = $key->kode_jaminan;
    		$list['latitude']	= $key->latitude;
    		$list['longitude']  = $key->longitude;
    		$list['id_agunan']  = $id_agunan;
    		$list['chekin_lat'] =$key->checkin_lat;
    		$list['chekin_long']=$key->checkin_long;
    		return view('bidding',$list);
	    	
	    }


	    public function bidding(){
	    	$id_agunan 		= g('id_agunan');
	    	$pembeli		= g('pembeli');
	    	$telp 			= g('telp');
	    	$alamat			= g('alamat');
	    	$penawaran		= g('penawaran');

	    	$sv['created_at'] = date('Y-m-d H:i:s');
	    	$sv['nama']		  = $pembeli;
	    	$sv['alamat']		= $alamat;
	    	$sv['telp']			= $telp;
	    	DB::table('customer')->insert($sv);

	    	// $pen=rtrim($penawaran, ".");
	    	$pen=str_replace (".", "", $penawaran);

	    	$save['created_at']	= date('Y-m-d H:i:s');
	    	$save['nama']		  = $pembeli;
	    	$save['alamat']		= $alamat;
	    	$save['telp']			= $telp;
	    	$save['nominal']		= $pen;
	    	$save['id_sales']		= Session::get('id_sales');
	    	$save['id_agunan']		= $id_agunan;
	    	$save['id_komite']		= 0;
	    	$save['jumlah_terima']  = 0;
	    	$save['jumlah_tolak']   = 0;
	    	// dd($save);
	    	DB::table('bidding')->insert($save);


	    	return redirect('home')->with('message','Anda berhasil melakukan bidding');;

	    }


	    public function filter(){
	    	if (!Session::get('id_sales')) {
				return redirect('/');
			}else{
				$harga_awal = g('harga_awal');
				$harga_akhir= g('harga_akhir');

				$harga_awal=str_replace('.', '', $harga_awal);
				$harga_akhir=str_replace('.', '', $harga_akhir);
				$luas_tanah_satu = g('luas_tanah_satu');
				$luas_tanah_dua = g('luas_tanah_dua');


				$luas_bangunan_satu = g('luas_bangunan_satu');
				$luas_bangunan_dua = g('luas_bangunan_dua');

				$id_area=Session::get('id_area_sales');
				$kw  = DB::table('survey')
				->join('agunan','survey.id_agunan','=','agunan.id')->select('survey.id_area','agunan.*')
					->Where(function($query)use($id_area){
			    		$query->where('survey.id_area',$id_area)
								->orWhere('survey.id_area',0);
			    	})
			    	->whereBetween('agunan.harga_jual',[$harga_awal,$harga_akhir])
			    	->whereBetween('agunan.luas_tanah',[$luas_tanah_satu,$luas_tanah_dua])
			    	->whereBetween('agunan.luas_bangunan',[$luas_bangunan_satu,$luas_bangunan_dua])
				   ->where('agunan.status','Dilelang')
			    	->get();
				// dd($kw);
	            foreach ($kw as $key) {
	            	$ambil = DB::table('agunan_image')->where('id_agunan',$key->id)->whereNotNull('image')->first();
	            	$key->foto_agunan = asset($ambil->image);
	            	$key->harga 	  = 'Rp. '.number_format($key->harga_jual, 0 , '' , '.');
	            }



	            $query  = DB::table('bidding')->where('bidding.id_sales',Session::get('id_sales'))->join('agunan','bidding.id_agunan','=','agunan.id')->select('bidding.nama','bidding.telp','bidding.created_at','bidding.nominal','agunan.nama_jenis_jaminan','agunan.id')->get();
				 // dd($id_area);
	            foreach ($query as $row) {
	            	$ambil = DB::table('agunan_image')->where('id_agunan',$row->id)->whereNotNull('image')->first();
	            	$row->foto_agunan = asset($ambil->image);
	            	$row->nominal 	  = 'Rp. '.number_format($row->nominal, 0 , '' , '.');
	            	$row->created_at  = date('d M Y',strtotime($row->created_at));
	            }
		        $data['agunan'] = $kw;
		        $data['history']= $query;
				return view('home',$data);
			}
	    }
	    //By the way, you can still create your own method in here... :) 


	}