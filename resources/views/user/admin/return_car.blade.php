@extends('layout.home')
@section('title', 'Pengembalian Mobil')
@section('content')
     <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pengembalian Mobil</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">Pengembalian Mobil</li>
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
                  Pengembalian Mobil
                </h3>
                
              </div><!-- /.card-header -->
              <div class="card-body">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                  Pengembalian
                </button>

              <table class="table table-striped mt-4" id="table-return-car">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Tanggal Pengembalian</th>
                      <th scope="col">Plat Nomor</th>
                      <th scope="col">Lama Hari</th>
                      <th scope="col">Merek</th>
                      <th scope="col">Model</th>
                      <th scope="col">Total Sewa</th>
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
        <h5 class="modal-title" id="exampleModalLabel">Pengembalian Mobil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="#" id="frm-return-car">
        @csrf
      <div class="modal-body">
        <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}" />
        <div class="row">
          <div class="col-md-12">
            <label> Pilih Mobil Dikembalikan</label>
            <select class="form-control" name="car_id" id="car_id"> 
                <option value=""> Pilih Mobil</option>
            </select>
          </div>
          <div class="col-md-12">
            <label> Tanggal Mulai</label>
            <input type="text" class="form-control" name="start_date" id="start_date" readonly/>  
          </div>
          <div class="col-md-12">
            <label> Tanggal Selesai</label>
            <input type="text" class="form-control" name="end_date" id="end_date" readonly />
          </div>
          <div class="col-md-12">
            <label> Merek </label>
            <input type="text" class="form-control" name="brand_name" id="brand_name" readonly/>  
          </div>
          <div class="col-md-12">
            <label> Model </label>
            <input type="text" class="form-control" name="model" id="model" readonly/>  
          </div>
          <div class="col-md-12">
            <label> Plat Nomor </label>
            <input type="text" class="form-control" name="plat_number" id="plat_number" readonly/>  
          </div>
          <div class="col-md-12">
            <label> Harga Sewa </label>
            <input type="text" class="form-control" name="price_rent" id="price_rent" readonly/>  
          </div>

          <div class="col-md-12">
            <label> Lama Hari </label>
            <input type="text" class="form-control" name="total_day_rent" id="total_day_rent" readonly/>  
          </div>

          <div class="col-md-12">
            <label> Total Sewa </label>
            <input type="number" min="1" class="form-control" name="total_price_rent" id="total_price_rent" readonly/>  
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
    var car_id
    var start_date
    var end_date
    var price_rent
    $(document).ready(function () {

      getListBorrowCar()
      getReturnCar()

      $("#car_id").on("change", function(e){
        e.preventDefault()
        car_id = this.value
        getCar(car_id)
      })

      $("#frm-return-car").on("submit", function(e){
          e.preventDefault()

          $.ajax({
            type: "POST",
            url: "/return/car",
            data: {
              user_id : $("#user_id").val(),
              car_id : $("#car_id").val(),
              total_day_rent : $("#total_day_rent").val(),
              total_price_rent : $("#total_price_rent").val(),

            },
            dataType: "JSON",
            success: function (response) {
                if(response.status == 200){
                  window.location.href = '/return-car' 
                }
            }
          });
      })

    });

    function getListBorrowCar(){
      $.ajax({
        type: "GET",
        url: "/borrow",
        data: "data",
        dataType: "JSON",
        success: function (response) {
            var data = response.data
            var option = ""
            $("#car_id").html();
            $.each(data, function (i, val) { 
                option += "<option value="+val.car_id+"> "+val.cars.brand_name+" - "+val.cars.model+" </option>"
            });

            $("#car_id").append(option); 
        }
      });
    }

    function getCar(car_id = null){
      $.ajax({
        type: "GET",
        url: "/borrow",
        data: {
          car_id : car_id
        },
        dataType: "JSON",
        success: function (response) {
          var data = response.data
          start_date = data[0].start_date
          end_date = data[0].end_date
          price_rent = data[0].cars.price_rent

          $("#start_date").val(start_date)
          $("#end_date").val(end_date)
          $("#brand_name").val(data[0].cars.brand_name)
          $("#model").val(data[0].cars.model)
          $("#plat_number").val(data[0].cars.plat_number)
          $("#price_rent").val(data[0].cars.price_rent)

          calculateRent(start_date, end_date, price_rent)
        }
      });
    }

    function calculateRent(start_date = null, end_date = null, price_rent=null){
        var date1MS = new Date(start_date).getTime();
        var date2MS = new Date(end_date).getTime();
        // Calculate the difference in milliseconds
        var differenceMS = Math.abs(date2MS - date1MS);
        // Convert back to days and return
        var total_day_rent =  Math.floor(differenceMS / (1000 * 60 * 60 * 24));
        price_rent = total_day_rent * price_rent

        $("#total_day_rent").val(total_day_rent)
        $("#total_price_rent").val(price_rent)
    }

    function getReturnCar(){
      $.ajax({
        type: "GET",
        url: "/return-back",
        dataType: "JSON",
        success: function (response) {
    
            var data = response.data
            var row = ""
            var number = 1
            $("#table-return-car").find("tr:gt(0)").remove();
            $.each(data, function (i, val) { 
                row += "<tr><td>"+ (number++) +"</td> <td>"+val.return_date+"</td><td>"+val.cars.plat_number+"</td><td>"+val.total_day_rent+"</td><td>"+val.cars.brand_name+"</td><td>"+val.cars.model+" </td><td>"+val.total_price_rent+"</td></tr>"
            });
            $("#table-return-car > tbody:last-child").append(row); 
        }
      });
    }

</script>
 
@endsection
@section('pagespecificscripts')
   
@stop