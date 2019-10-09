<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;
	use PDF;

	class AdminAgunan36Controller extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

	    $surveryor = DB::table('users')->where('deleted_at', null)->where('role', 'Surveyor')->get();
        $list .= '';
        foreach ($surveryor as $key) {
            $list .= '<li><a href="#" onclick="setSurveyor(' . $key->id . ')">' . $key->nama . '</a></li>';
        };
        $drop = '<div class="btn-group"><button type="button" class="btn btn-xs btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Select Surveyor<span class="caret"></span></button><ul class="dropdown-menu">' . $list . '</ul></div>';

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "nama_area";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = false;
			$this->button_edit = true;
			$this->button_delete = true;
			$this->button_detail = true;
			$this->button_show = true;
			$this->button_filter = false;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "agunan";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Kode Jaminan","name"=>"kode_jaminan"];
			$this->col[] = ["label"=>"Jenis Jaminan","name"=>"id_jenis_jaminan","join"=>"jenis_jaminan,nama"];
			$this->col[] = ["label"=>"Area","name"=>"id_area","join"=>"area,nama"];
			$this->col[] = ["label"=>"Sertifikat","name"=>"nama_sertifikat"];
			$this->col[] = ["label"=>"Harga Jual","name"=>"harga_jual","callback"=>function($row){
				return $cek="Rp.".number_format($row->harga_jual);
			}];
			$this->col[] = ["label"=>"LTV","name"=>"ltv"];
			$this->col[] = ["label"=>"Nomor Kode Aset","name"=>"kode_uniq"];
			$this->col[] = ["label" => "Surveyor", "name" => "id_surveyor", 'callback' => function ($row) {
            if ($row->id_surveyor == '') {
                return '<div class="list_surveyor" onclick="setId(' . $row->id . ')"></div>';
            } else {
                $nm=DB::table('users')->where('id',$row->id_surveyor)->first();
                return '<button type="button" class="btn btn-xs btn-warning dropdown-toggle">'.$nm->nama.'</button>';
            };
        }];
        // $this->col[] = ["label" => "Sale", "name" => "id", 'callback' => function ($row) {
        //     return '<button type="button" class="btn btn-xs btn-warning" onclick="directSale(' . $row->id . ')">Direct Sale</button>';
        // }];

        $this->col[]=["label"=>'Sale', 'name'=>'id', 'callback'=>function($row){
            return '<button type="button" class="btn btn-xs btn-warning btn-direct-sale" data-id="'.$row->id.'" data-toggle="modal" data-target="#myModal" id="sale">Direct Sale</button>';
        }];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			// $this->form[] = ['label'=>'Area','name'=>'id_area','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'area,nama'];
			// $this->form[] = ['label'=>'Nama Area','name'=>'nama_area','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			// $this->form[] = ['label'=>'Sertifikat','name'=>'id_sertifikat','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'sertifikat,nama'];
			// $this->form[] = ['label'=>'Nama Sertifikat','name'=>'nama_sertifikat','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			// $this->form[] = ['label'=>'Luas Tanah','name'=>'luas_tanah','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			// $this->form[] = ['label'=>'Luas Bangunan','name'=>'luas_bangunan','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			// $this->form[] = ['label'=>'Jenis Jaminan','name'=>'id_jenis_jaminan','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'jenis_jaminan,nama'];
			// $this->form[] = ['label'=>'Nama Jenis Jaminan','name'=>'nama_jenis_jaminan','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			// $this->form[] = ['label'=>'Status Jaminan','name'=>'id_status_jaminan','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'status_jaminan,nama'];
			// $this->form[] = ['label'=>'Nama Status Jaminan','name'=>'nama_status_jaminan','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			// $this->form[] = ['label'=>'Kode Jaminan','name'=>'kode_jaminan','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			// $this->form[] = ['label'=>'Harga Jual','name'=>'harga_jual','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			// $this->form[] = ['label'=>'Alamat','name'=>'alamat','type'=>'textarea','validation'=>'required|string|min:5|max:5000','width'=>'col-sm-10'];
			// $this->form[] = ['label'=>'Latitude','name'=>'latitude','type'=>'hidden','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			// $this->form[] = ['label'=>'Longitude','name'=>'longitude','type'=>'hidden','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			// $this->form[] = ['label'=>'Surveyor','name'=>'id_surveyor','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'users,id'];
			// $this->form[] = ['label'=>'Nama Surveyor','name'=>'nama_surveyor','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			// $this->form[] = ['label'=>'Keterangan','name'=>'keterangan','type'=>'textarea','validation'=>'required|string|min:5|max:5000','width'=>'col-sm-10'];
			// $this->form[] = ['label'=>'Baki Debet','name'=>'baki_debet','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			// $this->form[] = ['label'=>'Biaya','name'=>'biaya','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			// $this->form[] = ['label'=>'Amu Bwu','name'=>'amu_bwu','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			// $this->form[] = ['label'=>'Draft Pu','name'=>'draft_pu','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			// $this->form[] = ['label'=>'Gol','name'=>'gol','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			// $this->form[] = ['label'=>'Product','name'=>'product','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			// $this->form[] = ['label'=>'Status Survey','name'=>'status_survey','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			// $this->form[] = ['label'=>'Sales','name'=>'id_sales','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'sales,id'];
			// $this->form[] = ['label'=>'Status','name'=>'status','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			// $this->form[] = ['label'=>'Ltv','name'=>'ltv','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			// $this->form[] = ['label'=>'Grade','name'=>'grade','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			// $this->form[] = ['label'=>'Nilai Likuidasi','name'=>'nilai_likuidasi','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			// $this->form[] = ['label'=>'Nilai Pasar','name'=>'nilai_pasar','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			// $this->form[] = ['label'=>'Nilai Margin','name'=>'nilai_margin','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			# END FORM DO NOT REMOVE THIS LINE

			 $this->form = [];
        $this->form[] = ['label' => 'Area', 'name' => 'id_area', 'type' => 'select2', 'validation' => 'required|integer|min:0', 'width' => 'col-sm-10', 'datatable' => 'area,nama'];
        $this->form[] = ['label' => 'Sertifikat', 'name' => 'id_sertifikat', 'type' => 'select2', 'validation' => 'required|integer|min:0', 'width' => 'col-sm-10', 'datatable' => 'sertifikat,nama'];
        $this->form[] = ['label' => 'Luas Tanah', 'name' => 'luas_tanah', 'type' => 'number', 'validation' => 'required|integer|min:0', 'width' => 'col-sm-10'];
        $this->form[] = ['label' => 'Luas Bangunan', 'name' => 'luas_bangunan', 'type' => 'number', 'validation' => 'required|integer|min:0', 'width' => 'col-sm-10'];
        $this->form[] = ['label' => 'Jenis Jaminan', 'name' => 'id_jenis_jaminan', 'type' => 'select2', 'validation' => 'integer|min:0', 'width' => 'col-sm-10', 'datatable' => 'jenis_jaminan,nama'];
        $this->form[] = ['label' => 'Status Jaminan', 'name' => 'id_status_jaminan', 'type' => 'select2', 'validation' => 'integer|min:0', 'width' => 'col-sm-10', 'datatable' => 'status_jaminan,nama'];
        $this->form[] = ['label' => 'Kode Jaminan', 'name' => 'kode_jaminan', 'type' => 'text', 'validation' => 'required|min:1|max:255', 'width' => 'col-sm-10'];
        $this->form[] = ['label' => 'Product', 'name' => 'product', 'type' => 'text', 'validation' => 'min:1|max:255', 'width' => 'col-sm-10'];
        $this->form[] = ['label' => 'Alamat', 'name' => 'alamat', 'type' => 'googlemaps', 'validation' => 'string|min:5|max:5000', 'width' => 'col-sm-10', 'latitude' => 'latitude', 'longitude' => 'longitude'];
        $this->form[] = ['label' => 'Keterangan', 'name' => 'keterangan', 'type' => 'textarea', 'validation' => 'string|min:5|max:5000', 'width' => 'col-sm-10'];
        $this->form[] = ['label' => 'Amu Bwu', 'name' => 'amu_bwu', 'type' => 'text', 'validation' => 'min:1|max:255', 'width' => 'col-sm-10'];
        $this->form[] = ['label' => 'Draft Pu', 'name' => 'draft_pu', 'type' => 'text', 'validation' => 'min:1|max:255', 'width' => 'col-sm-10'];
        $this->form[] = ['label' => 'Gol', 'name' => 'gol', 'type' => 'text', 'validation' => 'min:1|max:255', 'width' => 'col-sm-10'];
        $this->form[] = ['label' => 'Biaya', 'name' => 'biaya', 'type' => 'money', 'validation' => 'integer|min:0', 'width' => 'col-sm-10'];
        //denda
        //nilai pasar

           $this->form[] = ['label' => 'Nilai Pasar', 'name' => 'nilai_pasar', 'type' => 'money', 'validation' => 'integer|min:0', 'width' => 'col-sm-10'];

                // $this->form[] = ['label' => 'Nilai Margin', 'name' => 'nilai_margin', 'type' => 'number', 'validation' => 'required|integer|min:0', 'width' => 'col-sm-10'];


          $this->form[] = ['label' => 'Nilai Likudasi', 'name' => 'nilai_likuidasi', 'type' => 'money', 'validation' => 'integer|min:0', 'width' => 'col-sm-10'];

        $this->form[] = ['label' => 'Baki Debet', 'name' => 'baki_debet', 'type' => 'money', 'validation' => 'integer|min:0', 'width' => 'col-sm-10'];

        // $this->form[] = ['label' => 'Harga Jual', 'name' => 'harga_jual', 'type' => 'money', 'validation' => 'required|integer|min:0', 'width' => 'col-sm-10'];

        //nilai likuidasi
        // $this->form[] = ['label' => 'Harga Jual', 'name' => 'harga_jual', 'type' => 'money', 'validation' => 'required|integer|min:0', 'width' => 'col-sm-10'];
        //ltv awal
        //appraisal
        //nilai asset
        //dokumen legalitas
        //estimasi biaya
        //harga jual appraisal
        //nilai pasar appraisal
        //ltv appraisal
        //grade

        if (Request::segment(3) == 'detail'){
            $this->form[] = ['label' => 'LTV(%)', 'name' => 'ltv', 'type' => 'number'];
            $this->form[] = ['label' => 'Grade', 'name' => 'grade', 'type' => 'text'];
        }

        $columns[] = ['label' => 'Gambar', 'name' => 'image', 'type' => 'upload', 'validation' => 'required|image|max:1000'];

        $this->form[] = ['label' => 'Gambar Agunan', 'name' => 'agunan_image', 'type' => 'child', 'columns' => $columns, 'table' => 'agunan_image', 'foreign_key' => 'id_agunan'];

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

	        // $this->sub_module[] = ['label'=>'Pilih','path'=>'assign_surveyor','button_color'=>'warning','foreign_key'=>'id','button_icon'=>'fa fa-bars'];


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
	          $users=DB::table('users')->where('role','Surveyor')->get();

        foreach ($users as $key) {
            # code...
            $this->button_selected[] = ['label'=>$key->nama,'icon'=>'fa fa-check','name'=>$key->id];
        }

	                
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
	         $this->script_js = "
	        	id_agunan = 0;
	        	$(function(){
	        		$('.list_surveyor').html('" . $drop . "');
	        	});
	        	function setId(id){
	        		id_agunan=id;
	        		console.log(id_agunan);
	        	}
	        	function setSurveyor(id){
			        swal({
			            title: 'Do you want to set surveyor for this ?',
			            type:'info',
			            showCancelButton:true,
			            allowOutsideClick:true,
			            confirmButtonColor: '#DD6B55',
			            confirmButtonText: 'Yes',
			            cancelButtonText: 'No',
			            closeOnConfirm: false
			        }, function(){
			            location.href = '" . CRUDBooster::mainpath("set_surveyor?id_surveyor=") . "'+id+'&id_agunan='+id_agunan;
			        });
			    };

                $('.btn-direct-sale').on('click',function() {

                   var dataId =$(this).data('id');
                    console.log(dataId);
                document.getElementById('agunan').value =dataId;
              });

              function modalclose(){
                $('#myModal').modal('toggle');
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

	         $this->pre_index_html = '
        <div id="directSaleModal" class="modal fade" role="dialog">
          <div class="modal-dialog">
        
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
              </div>
              <div class="modal-body">
                <p>Some text in the modal.</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
        
          </div>
        </div>
        ';

                    $this->pre_index_html ='<div class="modal fade" id="myModal" role="dialog">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title">Direct Sale</h4>
                                    </div>
                                    <div class="modal-body">
                                    <form method="get" action="'.CRUDBooster::mainpath("sale").'">

                                    <input type="hidden" id="agunan" name="id">
                                    <div class="form-group">
                                    <label>Nama Penjual</label>
                                     <input type="text" name="nama" class="form-control">
                                     </div>

                                     <div class="form-group">
                                     <label>Harga Jual</label>
                                     <input type="number" name="harga" class="form-control">
                                    </div>

                                    </div>
                                    <div class="modal-footer">
                                      <button type="submit" id="submit" onclick="modalclose()" class="btn btn-primary">Save</button>
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                    </form>
                                  </div>
                                  
                                </div>
                              </div>';
	        
	        
	        
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

	         $sur=DB::table('users')->where('id',$button_name)->first();

        $data['nama_surveyor']=$sur->nama;
        $data['id_surveyor']=$button_name;

        $cek=DB::table('agunan')
            ->whereIn('id',$id_selected)
            ->update($data);

            if($cek){
                $res = redirect()->back()->with(["message" => "Succesfully Selected Surveyor", 'message_type' => 'success']);
            }else{
                $res = redirect()->back()->with(["message" => "update failed", 'message_type' => 'danger']);
            }

	            
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

	        $query->where('ltv','<',70);
	            
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate row of index table html 
	    | ---------------------------------------------------------------------- 
	    |
	    */    
	    public function hook_row_index($column_index,&$column_value) {	        
	    	//Your code here
	    	if($column_index==6){
	    		return $column_value=ceil($column_value)." %";
	    	}
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

	     public function getSet_surveyor()
    {
        $id_surveyor = g('id_surveyor');
        $id_agunan = g('id_agunan');

        $surveyor = DB::table('users')->where('id', $id_surveyor)->first();
        $ubah['id_surveyor'] = $surveyor->id;
        $ubah['nama_surveyor'] = $surveyor->nama;
        $kw = DB::table('agunan')->where('id', $id_agunan)->update($ubah);
        if ($kw) {
            $res = redirect()->back()->with(["message" => "Succesfully change surveyor", 'message_type' => 'success']);
        } else {
            $res = redirect()->back()->with(["message" => "Error change surveyor", 'message_type' => 'warning']);
        }
        \Session::driver()->save();
        $res->send();
        exit();
    }


    public function getSale(){

        $id=g('id');
        $nama=g('nama');
        $harga=g('harga');

        $data['id_agunan']=$id;
        $data['nama']=$nama;
        $data['nominal']=$harga;
        $data['status']="Diterima";
        $data['created_at']= date('Y-m-d H:i:s');

        $status['status']="Terjual";

        DB::table('agunan')->where('id',$id)->update($status);

        $ok=DB::table('bidding')->insert($data);

           if ($ok) {
            $res = redirect()->back()->with(["message" => "Succesfully change surveyor", 'message_type' => 'success']);
        } else {
            $res = redirect()->back()->with(["message" => "Error change surveyor", 'message_type' => 'warning']);
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
            $data['page_title'] = 'Detail Data Agunan';

            $data['row']=DB::table('agunan')->where('id',$id)->first();

            
            // $data['Jaminan']=DB::table('jenis_jaminan')
            // ->join('')


            $this->cbView('detail_agunan',$data);
        }

public function getPdf($id){

            $kertas=g('kertas');


            if($kertas=="A4"){


                $data['data']=DB::table('agunan')->where('id',$id)->first();
            // $data['image']=DB::table('agunan_image')->where('id_agunan',$id)->limit(4)->get();
                $cek=DB::table('agunan_image')->where('id_agunan',$id)->where('survey','Done')->get();

                if(count($cek)!=0){
                    $data['image']=$cek;
                }else{
                    $cekk=DB::table('agunan_image')->where('id_agunan',$id)->whereNull('survey')->get();
                    $data['image']=$cekk;
                }
                $data['user']=DB::table('users')->where('id_area',$data['data']->id_area)->where('role','Sales')->limit(2)->get();

                $pdf = PDF::loadView('print.test3_vertikal',$data)
                ->setPaper('a4','potret');


            return $pdf->stream('Export agunan.pdf');   

            return view('print.test3_vertikal',$data);

        }else{

                $data['data']=DB::table('agunan')->where('id',$id)->first();
            // $data['image']=DB::table('agunan_image')->where('id_agunan',$id)->limit(4)->get();
                $cek=DB::table('agunan_image')->where('id_agunan',$id)->where('survey','Done')->get();
                if(count($cek)!=0){
                    $data['image']=$cek;
                }else{
                    $cekk=DB::table('agunan_image')->where('id_agunan',$id)->whereNull('survey')->get();
                    $data['image']=$cekk;
                }
                $data['user']=DB::table('users')->where('id_area',$data['data']->id_area)->where('role','Sales')->limit(2)->get();

            $pdf = PDF::loadView('print.test3_landscape',$data)
            ->setPaper('a5','landscape');
            return $pdf->stream('Export agunan.pdf'); 
            return view('print.test3_landscape',$data);  
        }


        }

	    //By the way, you can still create your own method in here... :) 


	}