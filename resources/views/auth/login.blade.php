



<!doctype html>
<html lang="{{ str_replace( '_', '-', app()->getLocale() ) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Moto Popular :: Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />

    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <link rel="stylesheet" type="text/css" href="{{ asset('architec-ui/css/base.css')}}">

</head>
<style>
    .app-container.blue{
        background: #19255a  !important;
    }
    .logoAdmin{
        width: 14rem;
        height: 4rem;
    }
    .boxLogoAdmin{
        width: 100%;
    }
</style>
<body>
<div class="app-container app-theme-white body-tabs-shadow">
        <div class="app-container blue">
            <div class="h-100">
                <div class="h-100 no-gutters row">
                    <div class="h-100 bg-animation d-flex justify-content-center align-items-center col-md-12 col-lg-12 ">
                        <div class="mx-auto app-login-box col-sm-12 col-md-8  ">
                            <div class="row m-2 pb-3 ">
                                <div class="boxLogoAdmin d-flex justify-content-center align-items-center">
                                    <img src="/logo.svg" class="logoAdmin" >
                                </div>
                            </div>
                            <div class="row  m-2 ">
                                <div class="col-lg-12 bg-white p-4">
                                    <h4 class="mb-0">
                                        <h4>
                                            <div>Bienvenido al sistema de gestión</div>
                                        </h4>
                                        <span>Inicia sesión en tu cuenta.</span></h4>
                                    {{--        <h6 class="mt-3">No account? <a href="javascript:void(0);" class="text-primary">Sign up now</a></h6>--}}
                                    <div class="divider row"></div>
                                    <div class="">
                                        {{--            <div class="card-header">{{ __('Login') }}</div>--}}
                                        <form method="POST"  action="{{ route('login') }}">
                                            @csrf
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="position-relative form-group">
                                                        <label for="exampleEmail" class="">Correo Electrónico</label>
                                                        <input name="email" id="exampleEmail" placeholder="Correo electrónico aquí..."
                                                               value="{{ old('email') }}"
                                                               type="email"
                                                               class="form-control @error('email') is-invalid @enderror"
                                                               autocomplete="email"
                                                               autofocus
                                                               required>
                                                        @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="position-relative form-group">
                                                        <label for="examplePassword" class="">Contraseña</label>
                                                        <input name="password" id="examplePassword" placeholder="Contraseña aquí..."
                                                               type="password"
                                                               class="form-control  @error('password') is-invalid @enderror" required
                                                               autocomplete="current-password"></div>
                                                </div>
                                            </div>
                                            {{--<div class="position-relative form-check">
                                                <input name="remember" id="exampleCheck"
                                                       type="checkbox" {{ old('remember') ? 'checked' : '' }}
                                                       class="form-check-input"><label
                                                    for="exampleCheck" class="form-check-label">Recuérdame</label></div>--}}
                                            <div class="divider row"></div>
                                            <div class="d-flex align-items-center">
                                
                                                <div class="ml-auto">
                                                    {{--<a href="{{ route('password.request') }}" class="btn-lg btn btn-link">Recordar
                                                        contraseña</a>--}}
                                                    <button class="btn btn-primary btn-lg"><i class="fa fa-arrow-circle-right pr-1"></i>
                                                        Ingresar
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>


<!--SCRIPTS INCLUDES-->

<!--CORE-->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/metismenu"></script>

<script src="{{ asset('architec-ui/js/scripts-init/app.js')}}"></script>
<script src="{{ asset('architec-ui/js/scripts-init/demo.js')}}"></script>
<!--RangeSlider-->

<!--Slick Carousel -->
<script src="{{ asset('architec-ui/js/vendors/carousel-slider.js')}}"></script>
<script src="{{ asset('architec-ui/js/scripts-init/carousel-slider.js')}}"></script>
</body>
</html>




