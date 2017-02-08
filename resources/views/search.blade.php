@extends('layout.master')

@section('content')
    <div class="jumbotron text-center">
        <h2></h2>
        <p>Search Property</p> 
        <div class="col-sm-10 col-sm-pull-1 col-sm-push-1">
            <form id="searchProperty" enctype="multipart/form-data" autocomplete="off">
                <div class="col-sm-4">
                    <span>Property Name</span>
                    <div class="input-group">
                        <input type="text" id="name" name="name" class="form-control" size="50" placeholder="Property name">
                    </div>
                </div>
                <div class="col-sm-1">
                    <span>Bedrooms</span>
                    <div class="input-group">
                        <input type="text" name="bedroom" class="form-control onlyNumber" placeholder="" />
                    </div>
                </div>
                <div class="col-sm-1">
                    <span>Bathrooms</span>
                    <div class="input-group">
                        <input type="text" name="bathroom" class="form-control onlyNumber"  placeholder="" />
                    </div>
                </div>
                <div class="col-sm-1">
                    <span>Storeys</span>
                    <div class="input-group">
                        <input type="text" name="store" class="form-control onlyNumber" placeholder="" />
                    </div>
                </div>
                <div class="col-sm-1">
                    <span>Garages</span>
                    <div class="input-group">
                        <input type="text" name="garage" class="form-control onlyNumber" size="50" placeholder="" />
                    </div>
                </div>
                <div class="col-sm-1">
                    <span>MinPrice</span>
                    <div class="input-group">
                        <input type="text" name="min_price" class="form-control onlyNumber" size="50" placeholder="" />
                    </div>
                </div>
                <div class="col-sm-1">
                    <span>MaxPrice</span>
                    <div class="input-group">
                        <input type="text" name="max_price" class="form-control onlyNumber" size="50" placeholder="" />
                    </div>
                </div>
                <div class="col-sm-2">
                    <span>Search</span>
                    <div class="input-group-btn">
                        <input type="submit" value="Search" class="btn btn-success" id="searchSubmit" />
                        <input type="reset" value="Clear" class="btn btn-danger" />
                    </div>	
                </div>
            </form>    
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 col-sm-pull-2 col-sm-push-2">
                <table class="table table-bordered" id="propertyTable">
                    <thead>
                        <tr>
                            <th>name</th>
                            <th>price</th>
                            <th>bedroom</th>
                            <th>bathroom</th>
                            <th>store</th>
                            <th>garage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($properties as $key => $value)
                        <tr>
                            <td>{{($value->name)}}</td>
                            <td>{{($value->price)}}</td>
                            <td>{{($value->bedroom)}}</td>
                            <td>{{($value->bathroom)}}</td>
                            <td>{{($value->store)}}</td>
                            <td>{{($value->garage)}}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6"><center>No record found</center></td>
	                    </tr>
	                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="outer" style="display:none">
        <div class="inner">
            <div class="inn">
                <div class="sq"></div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script>
        $(document).ready(function() {
            var options = {
                bPaginate: true,
                sPaginationType: "full_numbers",
                aLengthMenu: [10, 25, 50, 100]
            }
            var table = $('#propertyTable').DataTable();
            $("#searchProperty").submit(function(e)
            {
                e.preventDefault();
                $(".outer").show();
                $("#searchSubmit").attr("disabled", 'disabled');
                var formData = new FormData(this);
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    url: "{{ url('/property-search')}}",
                    headers: {
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    cache: false,
                    success: function(response)
                    {
                        var objReturn = JSON.parse(response);
                        $(".outer").hide();
                        $("#searchSubmit").removeAttr("disabled", 'disabled');
                        //if(objReturn.status == 1 && objReturn.data.length > 0){
                        	initialize(objReturn.data);
                        //}
                    }
                });
            });

            function initialize(json)
            {
                options.aaData = json;
                options.aoColumns = [
                    {"mData": "name"},
                    {"mData": "price"},
                    {"mData": "bedroom"},
                    {"mData": "bathroom"},
                    {"mData": "store"},
                    {"mData": "garage"}
                ];
                var table = $('#propertyTable').DataTable();
                table.destroy();
                $("#propertyTable").dataTable(options);
            }
        });

        $('.onlyNumber').on('keyup', function() {
            this.value = this.value.replace(/[^0-9]/gi, '');
        });
    </script>
@stop
