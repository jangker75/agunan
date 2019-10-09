<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;
	use File;
	use Excel;

	class AdminAgunan41Controller extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "nama_area";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = false;
			$this->button_edit = false;
			$this->button_delete = false;
			$this->button_detail = false;
			$this->button_show = false;
			$this->button_filter = false;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "agunan";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Area","name"=>"id_area","join"=>"area,nama"];
			$this->col[] = ["label"=>"Nama Area","name"=>"nama_area"];
			$this->col[] = ["label"=>"Sertifikat","name"=>"id_sertifikat","join"=>"sertifikat,nama"];
			$this->col[] = ["label"=>"Nama Sertifikat","name"=>"nama_sertifikat"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Area','name'=>'id_area','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'area,nama'];
			$this->form[] = ['label'=>'Nama Area','name'=>'nama_area','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Sertifikat','name'=>'id_sertifikat','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'sertifikat,nama'];
			$this->form[] = ['label'=>'Nama Sertifikat','name'=>'nama_sertifikat','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Luas Tanah','name'=>'luas_tanah','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Luas Bangunan','name'=>'luas_bangunan','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Jenis Jaminan','name'=>'id_jenis_jaminan','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'jenis_jaminan,nama'];
			$this->form[] = ['label'=>'Nama Jenis Jaminan','name'=>'nama_jenis_jaminan','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Status Jaminan','name'=>'id_status_jaminan','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'status_jaminan,nama'];
			$this->form[] = ['label'=>'Nama Status Jaminan','name'=>'nama_status_jaminan','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Kode Jaminan','name'=>'kode_jaminan','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Harga Jual','name'=>'harga_jual','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Alamat','name'=>'alamat','type'=>'textarea','validation'=>'required|string|min:5|max:5000','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Latitude','name'=>'latitude','type'=>'hidden','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Longitude','name'=>'longitude','type'=>'hidden','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Surveyor','name'=>'id_surveyor','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'surveyor,id'];
			$this->form[] = ['label'=>'Nama Surveyor','name'=>'nama_surveyor','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Keterangan','name'=>'keterangan','type'=>'textarea','validation'=>'required|string|min:5|max:5000','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Baki Debet','name'=>'baki_debet','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Biaya','name'=>'biaya','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Amu Bwu','name'=>'amu_bwu','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Draft Pu','name'=>'draft_pu','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Gol','name'=>'gol','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Product','name'=>'product','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Status Survey','name'=>'status_survey','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Sales','name'=>'id_sales','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'sales,id'];
			$this->form[] = ['label'=>'Status','name'=>'status','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Ltv','name'=>'ltv','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Grade','name'=>'grade','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Nilai Likuidasi','name'=>'nilai_likuidasi','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Nilai Pasar','name'=>'nilai_pasar','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Nilai Margin','name'=>'nilai_margin','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Nama Debitur','name'=>'nama_debitur','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"Area","name"=>"id_area","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"area,nama"];
			//$this->form[] = ["label"=>"Nama Area","name"=>"nama_area","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Sertifikat","name"=>"id_sertifikat","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"sertifikat,nama"];
			//$this->form[] = ["label"=>"Nama Sertifikat","name"=>"nama_sertifikat","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Luas Tanah","name"=>"luas_tanah","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Luas Bangunan","name"=>"luas_bangunan","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Jenis Jaminan","name"=>"id_jenis_jaminan","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"jenis_jaminan,nama"];
			//$this->form[] = ["label"=>"Nama Jenis Jaminan","name"=>"nama_jenis_jaminan","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Status Jaminan","name"=>"id_status_jaminan","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"status_jaminan,nama"];
			//$this->form[] = ["label"=>"Nama Status Jaminan","name"=>"nama_status_jaminan","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Kode Jaminan","name"=>"kode_jaminan","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Harga Jual","name"=>"harga_jual","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Alamat","name"=>"alamat","type"=>"textarea","required"=>TRUE,"validation"=>"required|string|min:5|max:5000"];
			//$this->form[] = ["label"=>"Latitude","name"=>"latitude","type"=>"hidden","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Longitude","name"=>"longitude","type"=>"hidden","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Surveyor","name"=>"id_surveyor","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"surveyor,id"];
			//$this->form[] = ["label"=>"Nama Surveyor","name"=>"nama_surveyor","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Keterangan","name"=>"keterangan","type"=>"textarea","required"=>TRUE,"validation"=>"required|string|min:5|max:5000"];
			//$this->form[] = ["label"=>"Baki Debet","name"=>"baki_debet","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Biaya","name"=>"biaya","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Amu Bwu","name"=>"amu_bwu","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Draft Pu","name"=>"draft_pu","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Gol","name"=>"gol","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Product","name"=>"product","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Status Survey","name"=>"status_survey","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Sales","name"=>"id_sales","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"sales,id"];
			//$this->form[] = ["label"=>"Status","name"=>"status","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Ltv","name"=>"ltv","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Grade","name"=>"grade","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Nilai Likuidasi","name"=>"nilai_likuidasi","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Nilai Pasar","name"=>"nilai_pasar","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Nilai Margin","name"=>"nilai_margin","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Nama Debitur","name"=>"nama_debitur","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			# OLD END FORM

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

public function getIndex() {
  //First, Add an auth
   if(!CRUDBooster::isView()) CRUDBooster::denyAccess();
   
   //Create your own query 
   $data = [];
   $data['page_title'] = 'Import Excel';
    
   //Create a view. Please use `cbView` method instead of view method from laravel.
   $this->cbView('print.import_excel',$data);
}

    public function postImportdata(){
	        $extension = File::extension(Request::file('userfile')->getClientOriginalName());
	        if($extension == "xlsx" || $extension == "xls" || $extension == "csv"){
	            $path = Request::file('userfile')->getRealPath();
	            $data = Excel::load($path, function($reader) {
	            })->get();
	            $hit=count($data);

	            // $i = 1;
	            // foreach ($data as $key => $value) {
	            // 	echo $i++.'. ' .$value->nama_area.'<br>';
	            // }
	            $n=1;
	            if(!empty($data) && $data->count()){
	                $json = json_decode($data);
	                $save_agunan=[];
	                foreach($data as $value => $j){
	                	$area=DB::table('area')->where('nama','like','%'.$j->nama_area.'%')->first();
	                	$simpan['id_area']=$area->id;
	                    $simpan['nama_area'] = $j->nama_area;

	                    $sert=DB::table('sertifikat')->where('nama','like','%'.$j->nama_sertifikat.'%')->first();
	                    $simpan['id_sertifikat']=$sert->id;
	                    $simpan['nama_sertifikat'] = $j->nama_sertifikat;
	                    $simpan['luas_tanah']=$j->luas_tanah;
	                    $simpan['luas_bangunan']=$j->luas_bangunan;
	                    $simpan['nama_jenis_jaminan']=$j->nama_jenis_jaminan;
	                    $simapn['nama_status_jaminan']="Dilelang";
	                    $simpan['id_status_jaminan']=1;
	                    $simpan['kode_jaminan']=$j->kode_jaminan;
	                   	$simpan['harga_jual']=$j->harga_jual;
	                   	$simpan['alamat']=$j->alamat;
	                   	$simpan['nama_debitur']=$j->nama_debitur;
	                   	$simpan['nilai_pasar']=$j->nilai_pasar;
	                   	// $simpan['kode_uniq']=CRUDBooster::generate_uuid();
	                   	// $simpan['nama_surveyor']=$j->nama_surveyor;
	                   	// $simpan['keterangan']=$j->keterangan;
	                   	$simpan['baki_debet']=$j->baki_debet;
	                   	$simpan['biaya']=$j->biaya;
	                   	$simpan['amu_bwu']=$j->amu_bwu;
	                   	$simpan['draft_pu']=$j->draft_pu;
	                   	$simpan['gol']=$j->gol;
	                   	$simpan['product']=$j->product;
	                   	// $simpan['status_survey']=$j->status_survey;
	                   	$simpan['nilai_likuidasi']=$j->nilai_likuidasi;
	                   	$simpan['status']="Dilelang";
	                    $simpan['created_at'] = date('Y-m-d H:i:s');
	                    $simpan['latitude']=$j->latitude;
	                    $simpan['longitude']=$j->longitude;
	                    if($j->baki_debet >0 && $j->nilai_pasar >0){
	                    $ltv=100*($j->baki_debet/$j->nilai_pasar);
	                    }else{
	                    $ltv=1;
	                    }
	                    $simpan['ltv']=ceil($ltv);
	                    if($simpan['ltv']>=70){
	                    	$poin_1=2;
	                    }else{
	                    	$poin_1=1;
	                    }
	                    $simpan['grade']=$poin_1;

	                    $cek_err=$n++;
                 
		                    // $data=DB::table('agunan')->where('id',$getid)->first();
		                    // $nilai_pasar=$data->nilai_pasar;
		                    // $nilai['ltv']=($data->baki_debet/$nilai_pasar)*100;

	                    $tes=DB::table('agunan')->where('kode_uniq',$j->kode_uniq)->first();
	                    if($tes==null){
	                    	$simpan['kode_uniq']=$j->kode_uniq;
	                    	$save_agunan[] = $simpan;
	                    }else{
	                    	$list=$cek_err;
	                    	$no_error[]=$list;
	                    }
	                    // $tes=DB::table('agunan')->where('kode_uniq',$j->kode_uniq)->first();
	                    // if($tes){
	                    // 	$uniq="";
	                    // }else{
	                    // 	$uniq=$j->kode_uniq;
	                    // }
	                   	// $simpan['kode_uniq']=$uniq;
		                   
		                // $save_agunan[] = $simpan;

		                }
		                // dd(json_encode($save_agunan));
		                if(count($save_agunan)==$hit){
		                	$getid=DB::table('agunan')->insert($save_agunan);
		                	return redirect()->back()->with(['message_type'=>'success','message'=>'Berhasil mengimport data']);

		                }elseif(count($save_agunan)!=$hit){
		                	$r=count($no_error);
		                	for ($i=0; $i <$r ; $i++) { 
		                		$list1.=$no_error[$i].',';
		                	}
		                	return redirect()->back()->with(['message_type'=>'warning','message'=>'Nomor kode aset double data tidak dapat di simpan di nomor = '.$list1.'']);
		                }
	            }else{
	                return redirect()->back()->with(['message_type'=>'error','message'=>'Tidak berhasil mengimport data']);
	            }
	        }else {
	            return redirect()->back()->with(['message_type'=>'error','message'=>'File is a '.$extension.' file.!! Please upload a valid xls/csv file..!!']);
	        }
	    }



	    //By the way, you can still create your own method in here... :) 


	}