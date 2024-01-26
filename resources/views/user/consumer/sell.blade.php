@extends('layout.home')
@section('title', 'Dashboard Member')

@section('content')
     <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Buy</li>
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
                  Buy
                </h3>
                <div class="card-tools">
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-2">
                    <label for="">Item Name</label>
                  </div>
                  <div class="col-md-4"> </div>
                  <div class="col-md-2">
                    <label for="">Brand Name</label>
                  </div>
                  <div class="col-md-4"> </div>
                </div>
                <div class="row">
                  <div class="col-md-2">
                    <input type="text" name="item_name" id="item_name" class="form-control" placeholder="search item name"/>
                  </div>
                  <div class="col-md-4"></div>
                  <div class="col-md-2">
                    <input type="text" name="brand_name" id="brand_name" class="form-control" placeholder="search brand name"/>
                  </div>
                  <div class="col-md-4">
                    <button type="button"class="btn btn-md btn-warning" id="btn-search"> Search </button>
                  </div>
                </div>

                <div class="row mt-4">
                  <table class="table table-striped" id="table-member">
                    <thead>
                      <tr>
                        <th scope="col">Items Code</th>
                        <th scope="col">Name</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Rack Number</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                  </table>
                </div>
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

  <script>
    $(document).ready(function () {
        getItems()
        var name = null
        var brand = null
        $("#btn-search").click(function (e) { 
            e.preventDefault();
            item_name = $("#item_name").val()
            brand_name = $("#brand_name").val()
            getItems(item_name, brand_name)
        });
    });

    function getItems(name=null, brand=null){
      var data = {
        name : name,
        brand : brand
      }
      $.ajax({
        type: "GET",
        url: "/items",
        data: data,
        dataType: "JSON",
        success: function (response) {
          var data = response.data
          var row = ""
          var number = 1
          $("#table-member").find("tr:gt(0)").remove();
          $.each(data, function (i, val) { 
              row += "<tr><td>"+ val.id +"</td> <td>"+val.name+"</td><td>"+val.brand+"</td><td>"+val.shelf_number+"</td><td>"+val.qty+"</td><td>"+val.price+"</td><td><button type='button' class='btn btn-sm btn-info' onclick='showModal("+val.id+")' > Buy </button> </td></tr>"
          });
          $("#table-member > tbody:last-child").append(row);
        }
      });
    }

    function showModal(id){
      $("#modalBuyMember").modal("toggle")
      $("#btn-buy-item").on("click", function(e){
        e.preventDefault()
        var data = {
          _token: "{{ csrf_token() }}",
          id : id,
          qty : $("#qty").val(),
          is_member : $("#member_status").val()
        }
        $.ajax({
          type: "POST",
          url: "/member-buy",
          data: data,
          dataType: "JSON",
          success: function (response) {
            alert("Success buy an item !")
            $("#modalBuyMember").hide()
            window.location.href = '/member'
          }
        });
      }) 
      
    }
</script>

<div class="modal fade bd-example-modal-lg" id="modalBuyMember" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Buy Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form>
        @csrf
        <div class="modal-body">
            <label for="">Quantity</label>
            <input type="number" class="form-control" min=1 name="qty" id="qty"/>
            <input type="hidden" name="member_status" class="form-control" id="member_status" value=" {{ auth()->user()->is_member }}" />
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="btn-buy-item">Buy</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection
@section('pagespecificscripts')
   
@stop