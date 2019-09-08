<?php
/**
 * Created by PhpStorm.
 * User: SUNIL
 * Date: 03-09-2019
 * Time: 15:40
 */

include ('dbconfig.php');
include ('Admin_Class.php');
extract($_POST);
$id=$_POST['id'];
if($id!=""){
if($query=mysqli_query($conn,"delete from subject_allocations where id=$id")){
    echo "Successfully Deleted!";
}else{
    echo "unable to delete !!";
}
}
