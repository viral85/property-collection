<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Property Collection</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
        <script src="{{ asset('/js/jquery.validate.min.js')}}"></script>
        <link rel="stylesheet" href="{{ asset('/css/custom.css')}}">
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
                        <li class="active"><a href="{{url('import-property')}}">Import Property</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="jumbotron text-center">
            <h2></h2>
            <p>Upload Property</p> 
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3"></div>
                @if ($message = Session::get('error'))
                <div class="col-md-8">
                    <div class="box-body">
                        <div class="alert alert-danger danger">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                            {{ $message }}
                        </div>
                    </div>
                </div>
                @endif
                @if ($message = Session::get('success'))
                <div class="col-md-8">
                    <div class="box-body">
                        <div class="alert alert-success success">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                            {{ $message }}
                        </div>
                    </div>
                </div>
                @endif
                @if (count($errors) > 0)
                <div class="col-md-8">
                    <div class="box-body">
                        <div class="alert alert-danger danger">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endif
                <div class="col-md-3"></div>
            </div>
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <p>* supported format .csv</p> 
                    <form id="add-property" action="{{ url('/property-save/') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="file" class="form-control" placeholder="Upload csv file" id="fileData" name="fileData" onchange="readURL(this);" accept=".csv">
                                </div>  
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="submit" id="submitData" value="Upload" class="btn btn-danger" />
                                </div>  
                            </div>
                        </div>
                        <span id="err" class="redColor"></span>
                    </form>
                </div>
                <div class="col-sm-4"></div>
            </div>
            <br/>
            <div class="row"><div class="col-sm-3"></div><div class="col-sm-5 "><center><a href="{{url('/')}}">View property</a></center></div><div class="col-sm-4"></div></div>
        </div>  
        <footer class="container-fluid text-center">
        </footer>
        <script>
                                        $(document).ready(function() {
                                            $('#table').DataTable();
                                        });

                                        var validationRules = {
                                            fileData: {
                                                required: true
                                            }
                                        };

                                        $("#add-property").validate({
                                            rules: validationRules,
                                            messages: {
                                                fileData: {
                                                    required: "Csv file is required!",
                                                }
                                            }
                                        });

                                        function readURL(input_file)
                                        {

                                            if (input_file.files && input_file.files[0])
                                            {
                                                var reader = new FileReader();
                                                reader.onload = function(e)
                                                {
                                                    var fileType = input_file.files[0];
                                                    if (fileType.type === "application/vnd.ms-excel")
                                                    {
                                                        $("#err").text('');
                                                        $("#submitData").removeAttr('disabled');

                                                        if (input_file.files[0].size > 6000000)
                                                        {
                                                            $("#err").text("File size is too large");
                                                            $("#submitData").attr('disabled', 'disabled');
                                                            $("#fileData").val('');
                                                        }
                                                        else
                                                        {
                                                            //If want to perform anything
                                                        }
                                                    }
                                                    else
                                                    {
                                                        $("#err").text("Only csv type format allow!");
                                                        $("#submitData").attr('disabled', 'disabled');
                                                        $("#fileData").val('');
                                                    }
                                                };
                                                reader.readAsDataURL(input_file.files[0]);
                                            }
                                            else
                                            {

                                            }
                                        }

        </script>
        @yield('script')
    </body>
</html>