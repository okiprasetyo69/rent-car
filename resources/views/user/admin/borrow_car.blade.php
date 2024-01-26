@extends('layout.home')
@section('title', 'Pinjam Mobil')
@section('content')
     <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pinjam Mobil</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">Pinjam Mobil</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Pinjam Mobil
                </h3>
                
              </div><!-- /.card-header -->
              <div class="card-body">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                  Pinjam
                </button>

                <table class="table table-striped mt-4" id="table-borrow-cars">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Tanggal Mulai Sewa</th>
                      <th scope="col">Tanggal Selesai Sewa</th>
                      <th scope="col">Plat Nomor</th>
                      <th scope="col">Harga Sewa</th>
                      <th scope="col">Merek</th>
                      <th scope="col">Model</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                  </tbody>
                </table>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

           
          </section>
          <!-- /.Left col -->

        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pinjam Mobil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="#" id="frm-borrow-car">
        @csrf
      <div class="modal-body">
        <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}" />
        <div class="row">
          <div class="col-md-12">
            <label> Tanggal Mulai</label>
            <input type="text" class="form-control" name="start_date" id="start_date"/>  
          </div>
          <div class="col-md-12">
            <label> Tanggal Selesai</label>
            <input type="text" class="form-control" name="end_date" id="end_date" />
          </div>
          <div class="col-md-12">
            <label> Pilih Mobil</label>
            <select class="form-control" name="car_id" id="car_id"> 

            </select>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>

      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
    
    $(document).ready(function () {
        getAvailableCar()
        //Date picker
        $('#start_date').datepicker({
            dateFormat: 'yy-mm-dd'
        });
      
        $('#end_date').datepicker({
            dateFormat: 'yy-mm-dd'
        });

        $("#frm-borrow-car").on("submit", function(e){
          e.preventDefault()
          $.ajax({
            type: "POST",
            url: "/borrow/create",
            data: {
              user_id :  $("#user_id").val(),
              start_date: $("#start_date").val(),
              end_date: $("#end_date").val(),
              car_id: $("#car_id option:selected").val(),
            },
            dataType: "JSON",
            success: function (response) {
                if(response.status == 200){
                   window.location.href = '/borrow-car'
                }
            }
          });
        })

        getListBorrowCar()

    });

    function getAvailableCar(){
      $.ajax({
        type: "GET",
        url: "/car/available",
        data: "data",
        dataType: "JSON",
        success: function (response) {
          var data = response.data
          $("#car_id").html()
          var option = ""
          $.each(data, function (i, val) { 
              option += "<option value="+val.id+"> "+val.brand_name+" - "+val.model+" - Rp."+val.price_rent+" </option>"
          });
          $("#car_id").append(option)
        }
      });
    }

    function getListBorrowCar(){
      $.ajax({
        type: "GET",
        url: "/borrow",
        data: "data",
        dataType: "JSON",
        success: function (response) {
            var data = response.data
            var row = ""
            var number = 1
            $("#table-borrow-cars").find("tr:gt(0)").remove();
            $.each(data, function (i, val) { 
                row += "<tr><td>"+ (number++) +"</td> <td>"+val.start_date+"</td><td> "+val.end_date+" </td><td>"+val.cars.plat_number+"</td><td>"+val.cars.price_rent+"</td><td>"+val.cars.brand_name+"</td><td>"+val.cars.model+" </td></tr>"
            });
            $("#table-borrow-cars > tbody:last-child").append(row); 
        }
      });
    }
</script>
 
@endsection
@section('pagespecificscripts')
   
@stop