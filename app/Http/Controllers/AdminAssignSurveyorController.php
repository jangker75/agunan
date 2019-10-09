<?php namespace App\Http\Controllers;

use Session;
use Request;
use DB;
use crocodicstudio\crudbooster\helpers\CRUDBooster;

class AdminAssignSurveyorController extends \crocodicstudio\crudbooster\controllers\CBController
{

    public function cbInit()
    {
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
        $this->button_edit = false;
        $this->button_delete = true;
        $this->button_detail = true;
        $this->button_show = false;
        $this->button_filter = false;
        $this->button_import = false;
        $this->button_export = false;
        $this->table = "agunan";
        # END CONFIGURATION DO NOT REMOVE THIS LINE

        # START COLUMNS DO NOT REMOVE THIS LINE
        $this->col = [];
            // $this->col[] = ["label"=>"Nama Debitur","name"=>"id_agunan","join"=>"agunan,nama_debitur"];
        $this->col[] = ["label" => "Nama Debitur", "name" => "nama_debitur"];
        $this->col[] = ["label" => "Jenis Jaminan", "name" => "nama_jenis_jaminan"];
        $this->col[] = ["label" => "Nama Surveyor", "name" => "nama_surveyor", 'visible' => false];
        $this->col[] = ["label" => "Area", "name" => "nama_area"];
        $this->col[] = ["label" => "Sertifikat", "name" => "nama_sertifikat"];
        $this->col[] = ["label" => "Harga Jual", "name" => "harga_jual"];
        $this->col[] = ["label"=>"Nomor Kode Aset","name"=>"kode_uniq"];
        $this->col[] = ["label" => "Surveyor", "name" => "id_surveyor", 'callback' => function ($row) {
            if ($row->id_surveyor == '') {
                return '<div class="list_surveyor" onclick="setId(' . $row->id . ')"></div>';
            } else {
                return '<button type="button" class="btn btn-xs btn-warning dropdown-toggle">' . $row->nama_surveyor . '</button>';
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
        $this->form[] = ['label' => 'Area', 'name' => 'id_area', 'type' => 'select2', 'validation' => 'required|integer|min:0', 'width' => 'col-sm-10', 'datatable' => 'area,nama'];

        $this->form[] = ['label' => 'Sertifikat', 'name' => 'id_sertifikat', 'type' => 'select2', 'validation' => 'required|integer|min:0', 'width' => 'col-sm-10', 'datatable' => 'sertifikat,nama'];

        $this->form[] = ['label' => 'Luas Tanah', 'name' => 'luas_tanah', 'type' => 'number', 'validation' => 'required|integer|min:0', 'width' => 'col-sm-10'];

        $this->form[] = ['label' => 'Luas Bangunan', 'name' => 'luas_bangunan', 'type' => 'number', 'validation' => 'required|integer|min:0', 'width' => 'col-sm-10'];

        $this->form[] = ['label' => 'Jenis Jaminan', 'name' => 'id_jenis_jaminan', 'type' => 'select2', 'validation' => 'required|integer|min:0', 'width' => 'col-sm-10', 'datatable' => 'jenis_jaminan,nama'];

        $this->form[] = ['label' => 'Status Jaminan', 'name' => 'id_status_jaminan', 'type' => 'select2', 'validation' => 'required|integer|min:0', 'width' => 'col-sm-10', 'datatable' => 'status_jaminan,nama'];


        $this->form[] = ['label' => 'Kode Jaminan', 'name' => 'kode_jaminan', 'type' => 'text', 'validation' => 'required|min:1|max:255', 'width' => 'col-sm-10'];

        $this->form[] = ['label' => 'Harga Jual', 'name' => 'harga_jual', 'type' => 'number', 'validation' => 'required|integer|min:0', 'width' => 'col-sm-10'];

        $this->form[] = ['label' => 'Alamat', 'name' => 'alamat', 'type' => 'googlemaps', 'validation' => 'required|string|min:5|max:5000', 'width' => 'col-sm-10', 'latitude' => 'latitude', 'longitude' => 'longitude'];

        $this->form[] = ['label' => 'Keterangan', 'name' => 'keterangan', 'type' => 'textarea', 'validation' => 'required|string|min:5|max:5000', 'width' => 'col-sm-10'];
        $this->form[] = ['label' => 'Baki Debet', 'name' => 'baki_debet', 'type' => 'number', 'validation' => 'required|integer|min:0', 'width' => 'col-sm-10'];
        $this->form[] = ['label' => 'Biaya', 'name' => 'biaya', 'type' => 'number', 'validation' => 'required|integer|min:0', 'width' => 'col-sm-10'];
        $this->form[] = ['label' => 'Amu Bwu', 'name' => 'amu_bwu', 'type' => 'text', 'validation' => 'required|min:1|max:255', 'width' => 'col-sm-10'];
        $this->form[] = ['label' => 'Draft Pu', 'name' => 'draft_pu', 'type' => 'text', 'validation' => 'required|min:1|max:255', 'width' => 'col-sm-10'];
        $this->form[] = ['label' => 'Gol', 'name' => 'gol', 'type' => 'text', 'validation' => 'required|min:1|max:255', 'width' => 'col-sm-10'];
        $this->form[] = ['label' => 'Product', 'name' => 'product', 'type' => 'text', 'validation' => 'required|min:1|max:255', 'width' => 'col-sm-10'];
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
        $this->alert = array();


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
    public function actionButtonSelected($id_selected, $button_name)
    {
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
    public function hook_query_index(&$query)
    {
        //Your code here
        // $query->where('id_surveyor', null)
        //     ->orWhere('status', '!=', 'Done')
        //     ->get();
        $query->where('status','!=','Terjual');
    }

    /*
    | ----------------------------------------------------------------------
    | Hook for manipulate row of index table html
    | ----------------------------------------------------------------------
    |
    */
    public function hook_row_index($column_index, &$column_value)
    {
        //Your code here
        if ($column_index == '5') {
            return $column_value = 'Rp. ' . number_format($column_value, 0, '', '.');
        }
    }

    /*
    | ----------------------------------------------------------------------
    | Hook for manipulate data input before add data is execute
    | ----------------------------------------------------------------------
    | @arr
    |
    */
    public function hook_before_add(&$postdata)
    {
        //Your code here

    }

    /*
    | ----------------------------------------------------------------------
    | Hook for execute command after add public static function called
    | ----------------------------------------------------------------------
    | @id = last insert id
    |
    */
    public function hook_after_add($id)
    {
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
    public function hook_before_edit(&$postdata, $id)
    {
        //Your code here

    }

    /*
    | ----------------------------------------------------------------------
    | Hook for execute command after edit public static function called
    | ----------------------------------------------------------------------
    | @id       = current id
    |
    */
    public function hook_after_edit($id)
    {
        //Your code here

    }

    /*
    | ----------------------------------------------------------------------
    | Hook for execute command before delete public static function called
    | ----------------------------------------------------------------------
    | @id       = current id
    |
    */
    public function hook_before_delete($id)
    {
        //Your code here

    }

    /*
    | ----------------------------------------------------------------------
    | Hook for execute command after delete public static function called
    | ----------------------------------------------------------------------
    | @id       = current id
    |
    */
    public function hook_after_delete($id)
    {
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
        $data['admin']=Session::get('admin_name');

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

    //By the way, you can still create your own method in here... :)


}