<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminLaporanSurveyorController extends \crocodicstudio\crudbooster\controllers\CBController {

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
			$this->button_show = false;
			$this->button_filter = false;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "survey";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Tanggal Survey","name"=>"created_at"];
			$this->col[] = ["label"=>"Nama Surveyor","name"=>"id_agunan","join"=>"agunan,nama_surveyor"];
			$this->col[] = ["label"=>"Kode Jaminan","name"=>"id_agunan","join"=>"agunan,kode_jaminan"];
			$this->col[] = ["label"=>"Nama Debitur","name"=>"id_agunan","join"=>"agunan,nama_debitur"];
			$this->col[] = ["label"=>"Area","name"=>"id_agunan","join"=>"agunan,nama_area"];
			$this->col[] = ["label"=>"Luas Tanah","name"=>"id_agunan","join"=>"agunan,luas_tanah"];
			$this->col[] = ["label"=>"Luas Bangunan","name"=>"id_agunan","join"=>"agunan,luas_bangunan"];
			$this->col[] = ["label"=>"Jenis Jaminan","name"=>"id_agunan","join"=>"agunan,nama_jenis_jaminan"];
			$this->col[] = ["label"=>"Nomor Kode Aset","name"=>"id_agunan","join"=>"agunan,kode_uniq"];
			$this->col[] = ["label"=>"Approve","name"=>"status",'callback'=>function($row){
				if ($row->status=='Waiting') {
					return '<div class="btn-group">
								<button type="button" class="btn btn-xs btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
									Waiting<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#" onclick="setApprove('.$row->id.')">Approve</a></li>
									<li><a href="#" onclick="setReject('.$row->id.')">Reject</a></li>
								</ul>
							</div>';
				}else{
					return '<button type="button" class="btn btn-xs btn-warning dropdown-toggle">'.$row->status.'</button>';
				};
			}];
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
			$this->form[] = ['label'=>'Surveyor','name'=>'id_surveyor','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'users,nama'];
			$this->form[] = ['label'=>'Agunan','name'=>'id_agunan','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'agunan,nama_area'];
			$this->form[] = ['label'=>'Status','name'=>'Status','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
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
			//$this->form[] = ["label"=>"Status","name"=>"Status","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
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
	        $this->script_js ="
	        	function setApprove(id){
			        swal({
			            title: 'Do you want to approve this ?',
			            type:'info',
			            showCancelButton:true,
			            allowOutsideClick:true,
			            confirmButtonColor: '#DD6B55',
			            confirmButtonText: 'Yes',
			            cancelButtonText: 'No',
			            closeOnConfirm: false
			        }, function(){
			            location.href = '".CRUDBooster::mainpath("approve?id_survey=")."'+id;
			        });
			    };
			    function setReject(id){
			        swal({
			            title: 'Do you want to reject this ?',
			            type:'info',
			            showCancelButton:true,
			            allowOutsideClick:true,
			            confirmButtonColor: '#DD6B55',
			            confirmButtonText: 'Yes',
			            cancelButtonText: 'No',
			            closeOnConfirm: false
			        }, function(){
			            location.href = '".CRUDBooster::mainpath("reject?id_survey=")."'+id;
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
	        $query->where('survey.status','Waiting')->get();
	            
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


	    public function getApprove(){
	    	$cek=DB::table('survey')->where('id',g('id_survey'))->first();
	    	$ub['status_survey'] = 'Done';
	    	DB::table('agunan')->where('id',$cek->id_agunan)->update($ub);
	    	$ubah['status']	= 'Approved';
	    	$eks = DB::table('survey')->where('id',g('id_survey'))->update($ubah);
	    	if ($eks) {
	    		$res = redirect()->back()->with(["message"=>"Succesfully approve survey",'message_type'=>'success']);
	    	}else{
	    		$res = redirect()->back()->with(["message"=>"Error approve survey",'message_type'=>'warning']);
	    	}
	    	\Session::driver()->save();
	    	$res->send();
	    	exit();
	    }
	    public function getReject(){
	    	$cek=DB::table('survey')->where('id',g('id_survey'))->first();
	    	$ubah['status']	= 'Rejected';
	    	$ub['status_survey'] = '';
	    	DB::table('agunan')->where('id',$cek->id_agunan)->update($ub);
	    	$eks = DB::table('survey')->where('id',g('id_survey'))->update($ubah);
	    	if ($eks) {
	    		$res = redirect()->back()->with(["message"=>"Succesfully reject survey",'message_type'=>'success']);
	    	}else{
	    		$res = redirect()->back()->with(["message"=>"Error reject survey",'message_type'=>'warning']);
	    	}
	    	\Session::driver()->save();
	    	$res->send();
	    	exit();
	    }

	    //By the way, you can still create your own method in here... :) 

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

	    	$data['id_survey']=$id;

	    	// dd($data);

	    	// $data['Jaminan']=DB::table('jenis_jaminan')
	    	// ->join('')
	    	$this->cbView('detail_laporan',$data);
	    }



	}