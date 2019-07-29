<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CONTROLASO</title>
    @include('includes.recursos')
</head>
<body>
    <nav class="navbar navbar-dark navbar-expand-md bg-dark text-left">
        <div class="container-fluid"><a class="navbar-brand" href="/">ASO-EMP</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon text-center"></span></button>
            <div class="collapse navbar-collapse"
                id="navcol-1">
                <ul class="nav navbar-nav">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="/">Empleados</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="{{route('listado_aportantes')}}">Socios</a></li>
                    <li class="nav-item" role="presentation"></li>
                </ul>
            </div>
        </div>
    </nav>
    <div style="margin:12px; padding:12px" id="app">
        @yield('content')
    </div>
    @include('includes.footer')
    @yield('scripts')
</body>
</html>