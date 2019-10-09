<?php namespace App\Http\Controllers;

use Session;
use Request;
use DB;
use crocodicstudio\crudbooster\helpers\CRUDBooster;

class AdminHistoryBiddingController extends \crocodicstudio\crudbooster\controllers\CBController
{

    public function cbInit()
    {

        # START CONFIGURATION DO NOT REMOVE THIS LINE
        $this->title_field = "nama";
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
        $this->button_filter = true;
        $this->button_import = false;
        $this->button_export = false;
        $this->table = "bidding";
        # END CONFIGURATION DO NOT REMOVE THIS LINE

        # START COLUMNS DO NOT REMOVE THIS LINE
        $this->col = [];
        // $this->col[] = ["label" => "Kode Jaminan", "name" => "id_agunan", "join" => "agunan,kode_jaminan"];
        $this->col[] = ["label" => "Status", "name" => "status"];
        $this->col[] = ["label" => "Tanggal", "name" => "created_at", 'callback_php' => 'date("d-m-Y",strtotime($row->created_at))'];
        $this->col[] = ["label" => "Area", "name" => "id_agunan", "join" => "agunan,nama_area"];
        $this->col[] = ["label" => "LT(M2)", "name" => "id_agunan", "join" => "agunan,luas_tanah"];
        $this->col[] = ["label" => "LB(M2)", "name" => "id_agunan", "join" => "agunan,luas_bangunan"];
        $this->col[] = ["label" => "Jenis jaminan", "name" => "id_agunan", "join" => "agunan,nama_jenis_jaminan"];
        $this->col[] = ["label" => "Harga Jual", "name" => "id_agunan","callback"=>function($row) {
            $survey=DB::table('survey')->join('agunan','survey.id_agunan','=','agunan.id')
            ->where('survey.id_agunan',$row->id_agunan)->select('survey.harga_jual_apprasial')->first();

            return $survey->harga_jual_apprasial;
        }];
        $this->col[] = ["label" => "Nama Penawar", "name" => "nama"];
        $this->col[] = ["label" => "Harga Penawaran", "name" => "nominal"];
        $this->col[] = ["label" => "Sales", "name" => "id_sales", "join" => "users,nama"];
        $this->col[] = ["label"=>"Nomor Kode Aset","name"=>"id_agunan","callback"=>function($row){
            $cek=DB::table('agunan')->where('id',$row->id_agunan)->first();

            return $cek->kode_uniq;
        }];
        # END COLUMNS DO NOT REMOVE THIS LINE

        # START FORM DO NOT REMOVE THIS LINE
        $this->form = [];
        $this->form[] = ['label' => 'Kode Jaminan', 'name' => 'id_agunan', 'type' => 'select', 'validation' => 'required|string|min:3|max:70', 'width' => 'col-sm-10', 'datatable' => 'agunan,kode_jaminan'];
        $this->form[] = ['label' => 'Tanggal', 'name' => 'created_at', 'type' => 'text', 'validation' => 'required|string|min:5|max:5000', 'width' => 'col-sm-10'];
        $this->form[] = ['label' => 'Area', 'name' => 'id_agunan', 'type' => 'select', 'validation' => 'required|numeric', 'width' => 'col-sm-10', 'datatable' => 'agunan,nama_area'];
        $this->form[] = ['label' => 'LT(M2)', 'name' => 'id_agunan', 'type' => 'select', 'validation' => 'required|integer|min:0', 'width' => 'col-sm-10', 'datatable' => 'agunan,luas_tanah'];
        $this->form[] = ['label' => 'LB(M2)', 'name' => 'id_agunan', 'type' => 'select', 'validation' => 'required|integer|min:0', 'width' => 'col-sm-10', 'datatable' => 'agunan,luas_bangunan'];
        $this->form[] = ['label' => 'Jenis jaminan', 'name' => 'id_agunan', 'type' => 'select', 'validation' => 'required|integer|min:0', 'width' => 'col-sm-10', 'datatable' => 'agunan,nama_jenis_jaminan'];
        $this->form[] = ['label' => 'Harga Jual', 'name' => 'id_agunan', 'type' => 'select', 'validation' => 'required|integer|min:0', 'width' => 'col-sm-10', 'datatable' => 'agunan,harga_jual'];
        $this->form[] = ['label' => 'Nama Penawar', 'name' => 'nama', 'type' => 'text', 'validation' => 'required|min:1|max:255', 'width' => 'col-sm-10'];
        $this->form[] = ['label' => 'Harga Penawaran', 'name' => 'nominal', 'type' => 'text', 'validation' => 'required', 'width' => 'col-sm-10'];
        $this->form[] = ['label' => 'Sales', 'name' => 'id_sales', 'type' => 'select', 'validation' => 'required', 'width' => 'col-sm-10', 'datatable' => 'users,nama'];

        //baki debet
        //estimasi biaya
        //denda
        //nilai pasar appraisal
        //harga jual appraisal
        //nilai likuidasi
        //ltv appraisal
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
    public function actionButtonSelected($id_selected, $button_name)
    {
        //Your code here

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
        $query->where('bidding.status','Diterima')->orWhere('bidding.status','Ditolak');

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
        if ($column_index == '7') {
            return $column_value = 'Rp. ' . number_format($column_value, 0, '', '.');
        }
        if ($column_index == '9') {
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


    //By the way, you can still create your own method in here... :)


}