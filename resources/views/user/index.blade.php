@extends('layouts.login_template')
<?php
/*extract($_POST);
session_start();
asset('dbconfig.php');
asset ('User_Class.php');
$user_obj=new user_ns\User_Class($conn);
if(isset($save))
{
    $err=" ";
    $username=$conn->real_escape_string($uname);
    $password=$conn->real_escape_string($pass);
    $err=$user_obj->LoginCheck($username,$password,$err);
}
*/
?>

@section('content')
<div class="limiter" >
    <div class="container-login100">
        <div class="wrap-login100 p-l-50 p-r-50 p-t-77 p-b-30">
            <form class="login100-form validate-form" method="post" action="{{Route('user.login')}}">
                @csrf
					<span class="login100-form-title p-b-55">
						Login
					</span>

                <div class="wrap-input100" >
                    <input class="input100" type="text" name="username" placeholder="EXXXXXXX" required>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<span class="lnr lnr-envelope"></span>
						</span>
                </div>

                <div class="wrap-input100 validate-input m-b-16" data-validate = "Password is required">
                    <input class="input100" type="password" name="password" placeholder="DD-MM-YYYY" required data-toggle="tooltip" title="DD-MM-YYYY(Default)">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<span class="lnr lnr-lock"></span>
						</span>

                <div class="container-login100-form-btn p-t-25">
                    <button  type="submit" name="save" class="login100-form-btn">
                        Login
                    </button>
                </div>
                <div>
                    <?php
                    echo "<font color='red'>".@$err."</font>";
                    ?>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection


