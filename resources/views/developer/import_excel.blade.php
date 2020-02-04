
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
    <form method="post" action="{{Route('upload')}}" enctype="multipart/form-data" style="margin:7%">
        @csrf
        <div class="form-group">
            <label >Input file</label>
            <input name="file" type="file" required>
        </div>

        <button type="submit" name="sub" class="btn btn-primary">Submit</button>
    </form>
    <hr/>

    </body>

    </html>
@endsection
