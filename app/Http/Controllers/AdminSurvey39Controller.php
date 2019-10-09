<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminSurvey39Controller extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "id";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = false;
			$this->button_edit = false;
			$this->button_delete = true;
			$this->button_detail = true;
			$this->button_show = true;
			$this->button_filter = false;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "survey";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Grade","name"=>"id_agunan","join"=>"agunan,grade"];
			$this->col[] = ["label"=>"Nama Debitur","name"=>"id_agunan","join"=>"agunan,nama_debitur"];
			$this->col[] = ["label"=>"Kode Jaminan","name"=>"id_agunan","join"=>"agunan,kode_jaminan"];
			$this->col[] = ["label"=>"Area","name"=>"id_area","join"=>"area,nama"];
			$this->col[] = ["label"=>"Luas Tanah","name"=>"id_agunan","join"=>"agunan,luas_tanah"];
			$this->col[] = ["label"=>"Luas Bangunan","name"=>"id_agunan","join"=>"agunan,luas_bangunan"];
			$this->col[] = ["label"=>"Jenis Jaminan","name"=>"id_agunan","join"=>"agunan,nama_jenis_jaminan"];
			$this->col[] = ["label"=>"Harga Jual","name"=>"harga_jual_apprasial"];
			// $this->col[] = ["label"=>"Sales Area","name"=>"id"];
			$this->col[] = ["label"=>"LTV","name"=>"id_agunan","join"=>"agunan,ltv"];
			$this->col[] = ["label"=>"Nomor Kode Aset","name"=>"id_agunan","join"=>"agunan,kode_uniq"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Note','name'=>'note','type'=>'textarea','validation'=>'required|string|min:5|max:5000','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Checkin Lat','name'=>'checkin_lat','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Checkin Long','name'=>'checkin_long','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'In Radius','name'=>'in_radius','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Image 1','name'=>'image_1','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Image 2','name'=>'image_2','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Image 3','name'=>'image_3','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Image 4','name'=>'image_4','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Image 5','name'=>'image_5','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Image 6','name'=>'image_6','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Surveyor','name'=>'id_surveyor','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'users,id'];
			$this->form[] = ['label'=>'Agunan','name'=>'id_agunan','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'agunan,nama_area'];
			$this->form[] = ['label'=>'Status','name'=>'status','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Area','name'=>'id_area','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'area,nama'];
			$this->form[] = ['label'=>'Dokumen Legalitas','name'=>'dokumen_legalitas','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Status Rumah','name'=>'status_rumah','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Status Lokasi','name'=>'status_lokasi','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Ltv Apprasial','name'=>'ltv_apprasial','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Nilai Asset','name'=>'nilai_asset','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Estimasi Biaya','name'=>'estimasi_biaya','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Harga Jual Apprasial','name'=>'harga_jual_apprasial','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Nilai Pasar Apprasial','name'=>'nilai_pasar_apprasial','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"Note","name"=>"note","type"=>"textarea","required"=>TRUE,"validation"=>"required|string|min:5|max:5000"];
			//$this->form[] = ["label"=>"Checkin Lat","name"=>"checkin_lat","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Checkin Long","name"=>"checkin_long","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"In Radius","name"=>"in_radius","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Image 1","name"=>"image_1","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Image 2","name"=>"image_2","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Image 3","name"=>"image_3","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Image 4","name"=>"image_4","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Image 5","name"=>"image_5","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Image 6","name"=>"image_6","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Surveyor","name"=>"id_surveyor","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"surveyor,id"];
			//$this->form[] = ["label"=>"Agunan","name"=>"id_agunan","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"agunan,nama_area"];
			//$this->form[] = ["label"=>"Status","name"=>"status","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Area","name"=>"id_area","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"area,nama"];
			//$this->form[] = ["label"=>"Dokumen Legalitas","name"=>"dokumen_legalitas","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Status Rumah","name"=>"status_rumah","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Status Lokasi","name"=>"status_lokasi","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Ltv Apprasial","name"=>"ltv_apprasial","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Nilai Asset","name"=>"nilai_asset","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Estimasi Biaya","name"=>"estimasi_biaya","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Harga Jual Apprasial","name"=>"harga_jual_apprasial","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Nilai Pasar Apprasial","name"=>"nilai_pasar_apprasial","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
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

	        $this->addaction[]=['label' => 'Detail Bidding', 'color' => 'success', 'url' => CRUDBooster::adminpath('detail_bidding') . '?id_agunan=[id_agunan]', "showIf" => "[status] != 'Terjual'"];


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

	           $this->script_js ="
	        	id_survey = 0;
	        	$(function(){
	        		$('.list_surveyor').html('".$drop."');
	        	});
	        	function setId(id){
	        		id_survey=id;
	        	}
	        	function setSales(id){
			        swal({
			            title: 'Do you want to set sales for this ?',
			            type:'info',
			            showCancelButton:true,
			            allowOutsideClick:true,
			            confirmButtonColor: '#DD6B55',
			            confirmButtonText: 'Yes',
			            cancelButtonText: 'No',
			            closeOnConfirm: false
			        }, function(){
			            location.href = '".CRUDBooster::mainpath("set_sales?id_sales=")."'+id+'&id_survey='+id_survey;
			        });
			    };
	        ";


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
	        $bid=DB::table('bidding')->get();
	        $data=[];
	        foreach ($bid as $key => $value) {
	        	$list=$value->id_agunan;
	        	array_push($data, $list);
	        }



	        $agunan=DB::table('agunan')->whereIn('id',$data)->where('status','Dilelang')->get();


	        $ag=[];
	        foreach ($agunan as $key => $value) {
	        	$list=$value->id;
	        	array_push($ag, $list);
	        }

	    	$query->whereIn('survey.id_agunan',$ag)->where('survey.status','Approved')->whereNotNull('survey.ltv_apprasial');
	            
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate row of index table html 
	    | ---------------------------------------------------------------------- 
	    |
	    */    
	    public function hook_row_index($column_index,&$column_value) {	        
	    	//Your code here
	    	if($column_index=='1'){
	    		if($column_value>=9){
	    			return $column_value='S';
	    		}elseif($column_value==8){
	    			return $column_value='A';
	    		}elseif($column_value==7){
	    			return $column_value='B';
	    		}elseif($column_value==6){
	    			return $column_value='C';
	    		}else{
	    			return $column_value='D';
	    		}
	    	}elseif ($column_index=='8') {
	    		return $column_value="Rp. ".number_format($column_value);
	    	}elseif ($column_index=='9') {
	    		return $column_value=$column_value." %";
	    	}

	   //  	  	if ($column_index=='8') {
	   //  		$id = $column_value;
	   //  		$query = DB::table('survey')->where('id',$id)->first();

	   //  		if(is_null($query->id_area)) {
				// 	$column_value= '<div class="btn-group">
				//     			<button type="button" class="btn btn-xs btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				//     				Select Area <span class="caret"></span>
				//     			</button>
				//     			<ul class="dropdown-menu list_surveyor" onclick="setId('.$id.')">
				    				
	   //  						</ul>
	   //  					</div>';
				// }elseif($query->id_area =='0') {
				// 	$column_value= '<div class="btn-group">
				//     			<button type="button" class="btn btn-xs btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				//     				All Sales <span class="caret"></span>
				//     			</button>
				//     			<ul class="dropdown-menu list_surveyor" onclick="setId('.$id.')">
				    				
	   //  						</ul>
	   //  					</div>';
				// }else{
				// 	$area = DB::table('area')->where('id',$query->id_area)->first();
				// 	$column_value= '<div class="btn-group">
				//     			<button type="button" class="btn btn-xs btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				//     				'.$area->nama.' <span class="caret"></span>
				//     			</button>
				//     			<ul class="dropdown-menu list_surveyor" onclick="setId('.$id.')">
				    				
	   //  						</ul>
	   //  					</div>';
				// }
				// // $column_value = $query->id_sales;
	   //  	}

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

	        public function getSet_sales(){
	    	$id_sales = g('id_sales');
	    	$id_survey= g('id_survey');
	    	$ub['id_area'] = $id_sales;
	    	$kw=DB::table('survey')->where('id',$id_survey)->update($ub);
	    	if ($kw) {
	    		$res = redirect()->back()->with(["message"=>"Succesfully change sales",'message_type'=>'success']);
	    	}else{
	    		$res = redirect()->back()->with(["message"=>"Error change sales",'message_type'=>'warning']);
	    	}
	    	\Session::driver()->save();
	    	$res->send();
	    	exit();
	    }

	    public function getDetail($id){
	    	if(!CRUDBooster::isRead() && $this->global_privilege==FALSE || $this->button_edit==FALSE) {    
	    		CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
	    	}

	    	$data = [];
	    	$data['page_title'] = 'Detail Data';
	    	$data['row'] = DB::table('survey')
	    	->join('agunan','survey.id_agunan','=','agunan.id')
	    	->where('survey.id',$id)
	    	->first();

	    	$data['area']=DB::table('survey')
	    	->join('area','survey.id_area','=','area.id')
	    	->where('survey.id',$id)
	    	->select('area.*','survey.*')
	    	->first();

	    	$data['id_survey']=$id;

	    	// dd($data);

	    	// $data['Jaminan']=DB::table('jenis_jaminan')
	    	// ->join('')


	    	$this->cbView('detail_assign_asset',$data);
	    }


	    //By the way, you can still create your own method in here... :) 


	}