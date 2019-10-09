<?php namespace App\Http\Controllers;

use Session;
use Request;
use DB;
use PDF;
use crocodicstudio\crudbooster\helpers\CRUDBooster;

class AdminAgunanController extends \crocodicstudio\crudbooster\controllers\CBController
{

    public function cbInit()
    {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "nama_area";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = true;
			$this->button_edit = true;
			$this->button_delete = true;
			$this->button_detail = true;
			$this->button_show = false;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = true;
			$this->table = "agunan";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
        $this->col = [];
        $this->col[] = ["label" => "Kode Jaminan", "name" => "kode_jaminan"];
        $this->col[] = ["label" => "Jenis Jaminan", "name" => "nama_jenis_jaminan"];
        // $this->col[] = ["label"=>"Alamat","name"=>"alamat"];
        $this->col[] = ["label" => "Area", "name" => "nama_area"];
        $this->col[] = ["label" => "Sertifikat", "name" => "nama_sertifikat"];
        $this->col[] = ["label" => "Harga Jual", "name" => "harga_jual"];
        $this->col[] = ["label" => "Status", "name" => "status"];
        $this->col[] = ["label" => "LTV", "name" => "ltv", "callback"=>function($row){
            if ($row->ltv != ''){
                return ceil($row->ltv).'%';
            }
        }];
        $this->col[] = ["label" => "Grade", "name" => "grade"];
        $this->col[] = ["label" => "Nomor Kode Aset", "name" => "kode_uniq"];
        # END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
                    $this->form[] = ['label'=>'Kode Uniq','name'=>'kode_uniq','type'=>'text','width'=>'col-sm-10'];

			$this->form[] = ['label'=>'Area','name'=>'id_area','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'area,nama'];

			$this->form[] = ['label'=>'Nama Debitur','name'=>'nama_debitur','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Sertifikat','name'=>'id_sertifikat','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'sertifikat,nama'];
			$this->form[] = ['label'=>'Luas Tanah','name'=>'luas_tanah','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Luas Bangunan','name'=>'luas_bangunan','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Jenis Jaminan','name'=>'id_jenis_jaminan','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'jenis_jaminan,nama'];

			// $this->form[] = ['label'=>'Status Jaminan','name'=>'id_status_jaminan','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'status_jaminan,nama'];

			$this->form[] = ['label'=>'Kode Jaminan','name'=>'kode_jaminan','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Product','name'=>'product','type'=>'text','validation'=>'min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Alamat','name'=>'alamat','type'=>'googlemaps','validation'=>'string|min:5|max:5000','width'=>'col-sm-10','latitude'=>'latitude','longitude'=>'longitude'];
			$this->form[] = ['label'=>'Keterangan','name'=>'keterangan','type'=>'textarea','validation'=>'string|min:5|max:5000','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Amu Bwu','name'=>'amu_bwu','type'=>'text','validation'=>'min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Draft Pu','name'=>'draft_pu','type'=>'text','validation'=>'min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Gol','name'=>'gol','type'=>'text','validation'=>'min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Biaya','name'=>'biaya','type'=>'money','validation'=>'integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Nilai Pasar','name'=>'nilai_pasar','type'=>'money','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Harga Jual','name'=>'harga_jual','type'=>'money','validation'=>'integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Nilai Likudasi','name'=>'nilai_likuidasi','type'=>'money','validation'=>'integer|min:0','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Baki Debet','name'=>'baki_debet','type'=>'money','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			// $this->form[] = ['label'=>'Harga Jual','name'=>'harga_jual','type'=>'money','validation'=>'required|integer|min:0','width'=>'col-sm-9','table'=>'agunan_image','foreign_key'=>'id_agunan'];
			// $this->form[] = ['label'=>'Gambar Agunan','name'=>'agunan_image','type'=>'child','width'=>'col-sm-10'];
                $columns[] = ['label' => 'Gambar', 'name' => 'image', 'type' => 'upload','validation' => 'required|image|max:1000'];
            
            $this->form[] = ['label' => 'Gambar Agunan', 'name' => 'agunan_image', 'type' => 'child', 'columns' => $columns, 'table' => 'agunan_image', 'foreign_key' => 'id_agunan'];
			# END FORM DO NOT REMOVE THIS LINE

            // $this->form[] = ['label'=>'Provinsi','type'=>'select','name'=>'id_provinsi','datatable'=>'provinsi,nama'];
            // $this->form[] = ['label'=>'Kabupaten','type'=>'select','name'=>'id_kabupaten','datatable'=>'kabupaten,nama','parent_select'=>'id_provinsi'];
            // $this->form[] = ['label'=>'Kecamatan','type'=>'select','name'=>'id_kecamatan','datatable'=>'kecamatan,nama','parent_select'=>'id_kabupaten'];
            // $this->form[] = ['label'=>'kelurahan','type'=>'select','name'=>'id_kelurahan','datatable'=>'kelurahan,nama','parent_select'=>'id_kecamatan'];

            //   $this->form[] = ['label'=>'Kabupaten','type'=>'select','name'=>'id_area','datatable'=>'kabupaten,nama','parent_select'=>'id_provinsi'];
            // $this->form[] = ['label'=>'Kecamatan','type'=>'select','name'=>'id_kecamatan','datatable'=>'kecamatan,nama','parent_select'=>'id_kabupaten'];
            // $this->form[] = ['label'=>'kelurahan','type'=>'select','name'=>'id_kelurahan','datatable'=>'kelurahan,nama','parent_select'=>'id_kecamatan'];

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ['label' => 'Area', 'name' => 'id_area', 'type' => 'select2', 'validation' => 'required|integer|min:0', 'width' => 'col-sm-10', 'datatable' => 'area,nama'];
			//$this->form[] = ['label' => 'Nama Debitur', 'name' => 'nama_debitur', 'type' => 'text', 'validation' => 'required|min:1|max:255', 'width' => 'col-sm-10'];
			//$this->form[] = ['label' => 'Sertifikat', 'name' => 'id_sertifikat', 'type' => 'select2', 'validation' => 'required|integer|min:0', 'width' => 'col-sm-10', 'datatable' => 'sertifikat,nama'];
			//$this->form[] = ['label' => 'Luas Tanah', 'name' => 'luas_tanah', 'type' => 'number', 'validation' => 'required|integer|min:0', 'width' => 'col-sm-10'];
			//$this->form[] = ['label' => 'Luas Bangunan', 'name' => 'luas_bangunan', 'type' => 'number', 'validation' => 'required|integer|min:0', 'width' => 'col-sm-10'];
			//$this->form[] = ['label' => 'Jenis Jaminan', 'name' => 'id_jenis_jaminan', 'type' => 'select2', 'validation' => 'required|integer|min:0', 'width' => 'col-sm-10', 'datatable' => 'jenis_jaminan,nama'];
			//$this->form[] = ['label' => 'Status Jaminan', 'name' => 'id_status_jaminan', 'type' => 'select2', 'validation' => 'required|integer|min:0', 'width' => 'col-sm-10', 'datatable' => 'status_jaminan,nama'];
			//$this->form[] = ['label' => 'Kode Jaminan', 'name' => 'kode_jaminan', 'type' => 'text', 'validation' => 'required|min:1|max:255', 'width' => 'col-sm-10'];
			//$this->form[] = ['label' => 'Product', 'name' => 'product', 'type' => 'text', 'validation' => 'required|min:1|max:255', 'width' => 'col-sm-10'];
			//$this->form[] = ['label' => 'Alamat', 'name' => 'alamat', 'type' => 'googlemaps', 'validation' => 'required|string|min:5|max:5000', 'width' => 'col-sm-10', 'latitude' => 'latitude', 'longitude' => 'longitude'];
			//$this->form[] = ['label' => 'Keterangan', 'name' => 'keterangan', 'type' => 'textarea', 'validation' => 'required|string|min:5|max:5000', 'width' => 'col-sm-10'];
			//$this->form[] = ['label' => 'Amu Bwu', 'name' => 'amu_bwu', 'type' => 'text', 'validation' => 'required|min:1|max:255', 'width' => 'col-sm-10'];
			//$this->form[] = ['label' => 'Draft Pu', 'name' => 'draft_pu', 'type' => 'text', 'validation' => 'required|min:1|max:255', 'width' => 'col-sm-10'];
			//$this->form[] = ['label' => 'Gol', 'name' => 'gol', 'type' => 'text', 'validation' => 'required|min:1|max:255', 'width' => 'col-sm-10'];
			//$this->form[] = ['label' => 'Biaya', 'name' => 'biaya', 'type' => 'money', 'validation' => 'required|integer|min:0', 'width' => 'col-sm-10'];
			////denda
			////nilai pasar
			//
			//$this->form[] = ['label' => 'Nilai Pasar', 'name' => 'nilai_pasar', 'type' => 'money', 'validation' => 'required|integer|min:0', 'width' => 'col-sm-10'];
			//
			//$this->form[] = ['label' => 'Nilai Margin', 'name' => 'nilai_margin', 'type' => 'number', 'validation' => 'required|integer|min:0', 'width' => 'col-sm-10'];
			//
			//
			//$this->form[] = ['label' => 'Nilai Likudasi', 'name' => 'nilai_likuidasi', 'type' => 'money', 'validation' => 'required|integer|min:0', 'width' => 'col-sm-10'];
			//
			//$this->form[] = ['label' => 'Baki Debet', 'name' => 'baki_debet', 'type' => 'money', 'validation' => 'required|integer|min:0', 'width' => 'col-sm-10'];
			//
			//// $this->form[] = ['label' => 'Harga Jual', 'name' => 'harga_jual', 'type' => 'money', 'validation' => 'required|integer|min:0', 'width' => 'col-sm-10'];
			//
			////nilai likuidasi
			//// $this->form[] = ['label' => 'Harga Jual', 'name' => 'harga_jual', 'type' => 'money', 'validation' => 'required|integer|min:0', 'width' => 'col-sm-10'];
			////ltv awal
			////appraisal
			////nilai asset
			////dokumen legalitas
			////estimasi biaya
			////harga jual appraisal
			////nilai pasar appraisal
			////ltv appraisal
			////grade
			//
			//if (Request::segment(3) == 'detail'){
			//$this->form[] = ['label' => 'LTV(%)', 'name' => 'ltv', 'type' => 'number'];
			//$this->form[] = ['label' => 'Grade', 'name' => 'grade', 'type' => 'text'];
			//}
			//
			// $columns[] = ['label' => 'Gambar', 'name' => 'image', 'type' => 'upload','validation' => 'required|image|max:1000'];
			
			// $this->form[] = ['label' => 'Gambar Agunan', 'name' => 'agunan_image', 'type' => 'child', 'columns' => $columns, 'table' => 'agunan_image', 'foreign_key' => 'id_agunan'];
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
        $this->addaction[] = ['label' => 'Detail Bidding', 'color' => 'success', 'url' => CRUDBooster::adminpath('detail_bidding') . '?id_agunan=[id]', "showIf" => "[status] != 'Terjual'"];

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

         $this->index_button[] = ['label'=>'Import Excel','url'=> CRUDBooster::adminpath('agunan41'),'icon'=>'fa fa-print'];



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
        }elseif($column_index=='8'){
            if($column_value>=9){
                return $column_value='A';
            }elseif($column_value==8){
                return $column_value='B';
            }elseif($column_value==7){
                 return $column_value='C';
            }elseif($column_value==6){
                 return $column_value='D';
            }else{
                 return $column_value='E';
            }
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
        $id_area = $postdata['id_area'];
        $area = DB::table('area')->where('id', $id_area)->first();
        $postdata['nama_area'] = $area->nama;

        $id_sertifikat = $postdata['id_sertifikat'];
        $sertifikat = DB::table('sertifikat')->where('id', $id_sertifikat)->first();
        $postdata['nama_sertifikat'] = $sertifikat->nama;

        $id_jenis_jaminan = $postdata['id_jenis_jaminan'];
        $jenis_jaminan = DB::table('jenis_jaminan')->where('id', $id_jenis_jaminan)->first();
        $postdata['nama_jenis_jaminan'] = $jenis_jaminan->nama;

        $id_status_jaminan = $postdata['id_status_jaminan'];
        $status_jaminan = DB::table('status_jaminan')->where('id', $id_status_jaminan)->first();
        $postdata['nama_status_jaminan'] = $status_jaminan->nama;

        $kode=$postdata['kode_uniq'];
        $cek=DB::table('agunan')->where('kode_uniq',$kode)->first();
        if (!empty($cek)) {
            $res = redirect()->back()->with(["message"=>"Your Kode is al ready !",'message_type'=>'warning'])->withInput();
            \Session::driver()->save();
            $res->send();
            exit();
        }

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

        $data=DB::table('agunan')->where('id',$id)->first();
        $presentase_margin=$data->nilai_margin;
        $nilai_pasar=$data->nilai_pasar;

        $nilai['ltv']=($data->baki_debet/$nilai_pasar)*100;

        //grade

        if($nilai['ltv']>=70){
            $poin_1=2;
        }else{
            $poin_1=1;
        }

        $nilai['grade']=$poin_1;
        // $nilai['kode_uniq']=CRUDBooster::generate_uuid();

        DB::table('agunan')->where('id',$id)->update($nilai);






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
        $id_area = $postdata['id_area'];
        $area = DB::table('area')->where('id', $id_area)->first();
        $postdata['nama_area'] = $area->nama;

        $id_sertifikat = $postdata['id_sertifikat'];
        $sertifikat = DB::table('sertifikat')->where('id', $id_sertifikat)->first();
        $postdata['nama_sertifikat'] = $sertifikat->nama;

        $id_jenis_jaminan = $postdata['id_jenis_jaminan'];
        $jenis_jaminan = DB::table('jenis_jaminan')->where('id', $id_jenis_jaminan)->first();
        $postdata['nama_jenis_jaminan'] = $jenis_jaminan->nama;

        $id_status_jaminan = $postdata['id_status_jaminan'];
        $status_jaminan = DB::table('status_jaminan')->where('id', $id_status_jaminan)->first();
        $postdata['nama_status_jaminan'] = $status_jaminan->nama;

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
          $data=DB::table('agunan')->where('id',$id)->first();
        $presentase_margin=$data->nilai_margin;
        $nilai_pasar=$data->nilai_pasar;

        //nilai haraga jual
        $n1=$presentase_margin*$nilai_pasar/100;

        // $nilai['harga_jual']=$n1+$nilai_pasar;


        //LTV

        $nilai['ltv']=($data->baki_debet/$nilai_pasar)*100;

        //grade

        if($nilai['ltv']>=70){
            $poin_1=2;
        }else{
            $poin_1=1;
        }

        $nilai['grade']=$poin_1;

        DB::table('agunan')->where('id',$id)->update($nilai);


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


            if($kertas=="A5"){


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

            $pdf = PDF::loadView('print.test3_vertikal',$data)
                ->setPaper('a4','potret');


            return $pdf->stream('Export agunan.pdf');   

            return view('print.test3_vertikal',$data);
        }


        }

        public function postDelfoto($id){
            $cek=DB::table('agunan_image')->where('id',$id)->delete();

            if($cek){
                    return redirect()->back()->with(["message"=>"Succesfully delete file",'message_type'=>'success']);
            }else{
                return redirect()->back()->with(["message"=>"Failed delete file",'message_type'=>'danger']);
            }
        }

        public function postFotosurvey($id){
            $foto=g('foto');
            if($foto=='image_1'){
                $data['image_1']='';
            }elseif($foto=='image_2'){
                $data['image_2']='';
            }elseif($foto=='image_3'){
                $data['image_3']='';
            }elseif($foto=='image_4'){
                $data['image_4']='';
            }

            $survey=DB::table('survey')->where('id',$id)->update($data);
              if($survey){
                    return redirect()->back()->with(["message"=>"Succesfully delete file",'message_type'=>'success']);
            }else{
                return redirect()->back()->with(["message"=>"Failed delete file",'message_type'=>'danger']);
            }
        }


    //By the way, you can still create your own method in here... :)


}