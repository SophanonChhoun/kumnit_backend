@extends("admin.layout.default")

@section("content")
    <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Products</h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <div class="d-md-flex">
                    <ol class="breadcrumb ms-auto">
                        <li><a href="{{ url('admin/product/list') }}" class="fw-normal">Product</a></li>
                    </ol>
                    <a href="https://www.wrappixel.com/templates/ampleadmin/" target="_blank"
                       class="btn btn-danger  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Dashboard</a>
                </div>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="container-fluid">
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
                        <div class="form-group has-search">
                            <form action="/admin/product/list" method="get">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search" name="search" value="{{ request()->get('search') }}">
                                    <button type="submit" class="btn-success"><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
                        <form action="/admin/product/list" method="get">
                            <label for="">Status: </label>
                            <div class="columns columns-left btn-group">
                                <select name="is_enable" class="form-control" onchange="this.form.submit()">
                                    <option value="">All</option>
                                    <option value="1" {{ request()->get('is_enable') == '1' ? 'selected' : '' }}>
                                        Active
                                    </option>
                                    <option value="0" {{ request()->get('is_enable') == '0' ? 'selected' : '' }}>
                                        Inactive
                                    </option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
                        <a href="/admin/product/create" class="btn btn-primary btn-lg" style="margin-bottom: 30px">Create</a>
                    </div>

                </div>
                <div class="table-responsive">
                    @include("admin.product.table")
                    @include("admin.layout.pagination")
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script>
        const data = @json($data);
    </script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        function status(item)
        {
            $(document).ready(function(){
                $("#myBtn"+item.id).click(function(){
                    $("#myModal"+item.id).modal('show');
                });
                $(".deleteClose"+item.id).click(function(){
                    $("#myModal"+item.id).modal('hide');
                });
                $("#itemStatus"+item.id).click(function(){
                    $("#status"+item.id).modal('show');
                });
                $(".statusClose"+item.id).click(function(){
                    $("#status"+item.id).modal('hide');
                });
            });
        }
        function updateOrder(item)
        {
            $('#input' + item.id).keypress(function (e) {
                if (e.which == 13) {
                    var order = $("#input" + item.id).val();
                    axios.patch('http://127.0.0.1:8000/admin/product/update/order/'+item.id, {
                        "sequence_order": order
                    })
                        .then(response => {
                            if(response.data.success) {
                                alert("You have already update order of " + item.name);
                            }else {
                                alert("You cannot update order of " + item.name);
                            }
                        })
                        .catch(error => console.error(error));
                }
            });
        }

        function updatePrice(item)
        {
            $('#inputPrice' + item.id).keypress(function (e) {
                if (e.which == 13) {
                    var price = $("#inputPrice" + item.id).val();
                    axios.patch('http://127.0.0.1:8000/admin/product/update/price/'+item.id, {
                        "price": price
                    })
                        .then(response => {
                            if(response.data.success) {
                                alert("You have already update price of " + item.name);
                            }else {
                                alert("You cannot update price of " + item.name);
                            }
                        })
                        .catch(error => console.error(error));
                }
            });
        }

        function updateQuantity(item)
        {
            $('#inputQuantity' + item.id).keypress(function (e) {
                if (e.which == 13) {
                    var quantity = $("#inputQuantity" + item.id).val();
                    axios.patch('http://127.0.0.1:8000/admin/product/update/quantity/'+item.id, {
                        "quantity": quantity
                    })
                        .then(response => {
                            if(response.data.success) {
                                alert("You have already update quantity of " + item.name);
                            }else {
                                alert("You cannot update quantity of " + item.name);
                            }
                        })
                        .catch(error => console.error(error));
                }
            });
        }

        data.data.forEach(status);
        data.data.forEach(updateOrder);
        data.data.forEach(updatePrice);
        data.data.forEach(updateQuantity);
    </script>
@endsection
