
@extends('layout.home')
@section('title', 'Management Mobil')
@section('content')
     <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Management Mobil</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">Management Mobil</li>
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
                  Management Mobil
                </h3>
                
              </div><!-- /.card-header -->
              <div class="card-body">
                
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                  Tambah
                </button>

                <div class="row mt-4">
                  <div class="col-md-4">
                    <label> Cari Merek </label>
                    <input type="text" class="form-control" id="filter-brand-name" placeholder="Masukkan merek" />
                  </div>

                  <div class="col-md-4">
                    <label> Model </label>
                    <input type="text" class="form-control" id="filter-model" placeholder="Masukkan model" />
                  </div>

                  <div class="col-md-4">
                    <label> Status </label>
                    <select class="form-control" name="is_available" id="filter-available"> 
                        <option value=""> Pilih Status </option>
                        <option value="1"> Tersedia</option>
                        <option value="0"> Tidak Tersedia</option>
                    </select>
                  </div>
                  
                </div>
             

                <table class="table table-striped mt-4" id="table-cars">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Merek</th>
                        <th scope="col">Model</th>
                        <th scope="col">Plat Nomor</th>
                        <th scope="col">Harga Sewa</th>
                        <th scope="col">Status</th>
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
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Mobil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="#" id="frm-cars">
        @csrf
      <div class="modal-body">

        <div class="row">
          <div class="col-md-12">
            <label> Merek</label>
            <input type="text" class="form-control" name="brand_name" id="brand_name" />
          </div>
          <div class="col-md-12">
            <label> Model</label>
            <input type="text" class="form-control" name="model" id="model" />
          </div>
          <div class="col-md-12">
            <label> Plat Nomor</label>
            <input type="text" class="form-control" name="plat_number" id="plat_number" />
          </div>
          <div class="col-md-12">
            <label> Harga Sewa</label>
            <input type="number" min="1" class="form-control" name="price_rent" id="price_rent" />
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

<script>
  var brand
  var model
  var is_available

    $(document).ready(function () {

        getCars()
        
        $("#filter-brand-name").on("keyup press", function(e){
          e.preventDefault()
          brand =  $("#filter-brand-name").val()
          getCars(brand)
        })

        $("#filter-model").on("keyup press", function(e){
          e.preventDefault()
          model =  $("#filter-model").val()
          getCars(brand, model)
        })

        $("#filter-available").on("change", function(e){
          e.preventDefault()
          var isAvailable = $(this).val();
          getCars(brand, model, isAvailable)
        })

        $("#frm-cars").on("submit", function(e){
          e.preventDefault()
          
          $.ajax({
            type: "POST",
            url: "/cars/create",
            data: {
              brand_name: $("#brand_name").val(),
              model: $("#model").val(),
              plat_number: $("#plat_number").val(),
              price_rent: $("#price_rent").val(),
            },
            dataType: "JSON",
           
            success: function (response) {
             
              if(response.status == 200){
                  window.location.href = '/management-car'
              }
            }
          });
        })
    });

    function getCars(brand = null, model = null, isAvailable = null){
        $.ajax({
          type: "GET",
          url: "/cars",
          data: {
            brand_name : brand,
            model : model,
            is_available : isAvailable
          },
          dataType: "JSON",
          success: function (response) {
            var data = response.data
            var row = ""
            var number = 1
            $("#table-cars").find("tr:gt(0)").remove();
            $.each(data, function (i, val) {
                var status = ""
                if(val.is_available == 1){
                  status = "Tersedia"
                } else {
                  status = "Tidak Tersedia"
                }
                row += "<tr><td>"+ (number++) +"</td> <td>"+val.brand_name+"</td><td> "+val.model+" </td><td>"+val.plat_number+"</td><td>"+val.price_rent+"</td><td>"+status+"</td></tr>"
            });
            $("#table-cars > tbody:last-child").append(row); 
          }
        });
    }

</script>
 
@endsection
@section('pagespecificscripts')
   
@stop