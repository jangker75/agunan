@extends('crudbooster::admin_template')

@section('content')

<div class='panel panel-default'>
    <div class='panel-heading' style="padding:20px"><b>Import File</b></div>
    <div class='panel-body'>  

              <!-- form start -->
              <form autocomplete="off" method="post" action="{{CRUDBooster::mainpath(importdata)}}" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Import Agunan</h4>
                </div>
                <div class="modal-body">
                  <input type="file" name="userfile" class="form-control" required>
                  <p style="font-size:14px;color:#777373">Contoh & format pengisian <a href="{{asset('assets/contoh.xlsx')}}" download><b>klik</b></a></p>
                </div>

                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>

    </div>
  </div>

@endsection