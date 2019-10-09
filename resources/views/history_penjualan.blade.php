@extends('crudbooster::admin_template')
@section('content')
  <!-- Your html goes here -->
  <a href="{{CRUDBooster::mainpath($slug=NULL)}}"><i class="fa fa-chevron-circle-left">&nbsp;  Back To List Data Master Customer</i></a>
  <div class='panel panel-default'>
    <div class='panel-heading'><b>{{$page_title}}</b></div>
    <div class='panel-body'>   

    <div class="table-responsive">
      <table id="table-detail" class="table table-striped">
        <tbody>
          <tr>
            <td><b>Kode Jaminan</b></td>
            <td>{{$row->kode_jaminan}}</td>
          </tr>

          <tr>
            <td><b>Tanggal Terjual</b></td>
            <td>{{$row->created_at}}</td>
          </tr>

            <tr>
            <td><b>Area</b></td>
            <td>{{$row->nama_area}}</td>
          </tr>

            <tr>
            <td><b>Janis Jaminan</b></td>
            <td>{{$row->nama_jenis_jaminan}}</td>
          </tr>

          <tr>
            <td><b>Harga Terjual</b></td>
            <td>{{Rp.number_format($row->nominal)}}</td>
          </tr>

          <tr>
            <td><b>Nama Pembeli</b></td>
            <td>{{$row->nama}}</td>
          </tr>

          @if($row->sales)

           <tr>
            <td><b>Sales</b></td>
            <td>{{$row->sales}}</td>
          </tr>
          @else


           <tr>
            <td><b>Admin</b></td>
            <td>{{$row->admin}}</td>
          </tr>

          @endif
         
         
        </tbody>
      </table>
    </div>
         
         
      
    </div>
  </div>
@endsection