<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Property Collection</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" >
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
        <link rel="stylesheet" href="{{ asset('/css/custom.css')}}">
        @yield('header')
    </head>
    <body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>
                    <a class="navbar-brand" href="{{url('/')}}">Property Collection</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{url('import-property')}}">Import Property</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        @yield('content')
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
        @yield('footer')
        <footer class="container-fluid text-center">
        </footer>
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
        @yield('script')
    </body>
</html>
