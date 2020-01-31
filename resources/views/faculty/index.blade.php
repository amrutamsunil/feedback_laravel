@extends('layouts.login_template')

@section('content')
    <div class="limiter" >
        <div class="container-login100">
            <div class="wrap-login100 p-l-50 p-r-50 p-t-77 p-b-30">
                <form class="login100-form validate-form" method="post" action="{{Route('faculty.login')}}">
                    @csrf
                    <span class="login100-form-title p-b-55">
						Login
					</span>

                    <div class="wrap-input100" >
                        <input class="input100" type="text" name="username" placeholder="username" required>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
							<span class="lnr lnr-envelope"></span>
						</span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-16" data-validate = "Password is required">
                        <input class="input100" type="password" name="password" placeholder="Password" required>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
							<span class="lnr lnr-lock"></span>
						</span>
                    </div>

                    <div class="container-login100-form-btn p-t-25">
                        <button  type="submit" name="save" class="login100-form-btn">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
