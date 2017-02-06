@extends('layout.master')

@section('content')

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
@stop

@section('script')
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
@stop