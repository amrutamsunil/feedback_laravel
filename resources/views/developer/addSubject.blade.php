@extends('layouts.developer_nav')
@section('content')
    <html>
    <head>
        <script src="{{asset('lib/jquery/jquery.min.js')}}"></script>
        <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('vendor/select2/dist/css/select2.css')}}">
        <script src="{{asset('vendor/select2/dist/js/select2.full.js')}}"></script>
        <script src="{{asset('vendor/Export2Excel.js')}}"></script>
        <script src="{{asset('vendor/tableexport-2.1.min.js')}}"></script></head>
    <body>
    <form method="post" action="{{Route('developer.add_subject')}}" style="margin:7%">
        @csrf
        <div class="form-group">
            <label for="emp_reg">Subject Name</label>
            <input type="text" name="subject_name" id="emp_reg" class="form-control" placeholder="Enter Subject Name in CAPS" required>
        </div>
        <div class="form-group">
            <label for="nam">Short Name</label>
            <input type="text" name="short_name" id="nam" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="short_n">Short Type</label>
            <input type="text" name="subject_type" id="short_n" class="form-control" required>
        </div>
        <div class="form-group">
        </div>
        <button type="submit" name="sub" class="btn btn-primary">Submit</button>
    </form>
    </body>
    <script>
        $(".chosen").select2();
    </script>
    </html>
@endsection
