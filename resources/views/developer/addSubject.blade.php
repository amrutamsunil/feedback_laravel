<?php
include ('../dbconfig.php');
include ('Developer.php');
$obj_add_subject=new \dev\Developer($conn);
?>
    <html>
    <head>

        <script src="{{asset('lib/jquery/jquery.min.js')}}"></script>
        <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('vendor/select2/dist/css/select2.css')}}">
        <script src="{{asset('vendor/select2/dist/js/select2.full.js')}}"></script>
        <script src="{{asset('vendor/Export2Excel.js')}}"></script>
        <script src="{{asset('vendor/tableexport-2.1.min.js')}}"></script></head>
    <body>
    <form method="post" style="margin:7%">
        <div class="form-group">
            <label for="emp_reg">Subject Name</label>
            <input type="text" name="subject_name" id="emp_reg" class="form-control" placeholder="Enter Subject Name in CAPS" required>
        </div>
        <div class="form-group">
            <label for="nam">Short Name</label>
            <input type="text" name="short_name" id="nam" class="form-control" required>
        </div>
        <div class="form-group">
            <?php echo "<center>".@$status."</center>"; ?>
        </div>
        <button type="submit" name="sub" class="btn btn-primary">Submit</button>
    </form>
    </body>
    <script>
        $(".chosen").select2();
    </script>
    </html>
<?php
extract($_POST);
if(isset($sub)) {
    echo  $obj_add_subject->add_new_subject($_POST['subject_name'], $_POST['short_name']);

}
?>