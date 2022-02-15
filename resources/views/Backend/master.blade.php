<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    @stack('css')
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <title>Task Manager</title>
</head>
<body class="d-flex flex-column h-100">
<main class="header">
    <nav class="py-2 bg-light border-bottom">
        <div class="container d-flex flex-wrap">
            <ul class="nav me-auto">
                <li class="nav-item"><a href="{{route('dashboard')}}" class="nav-link link-dark px-2 active" aria-current="page">Dashboard</a></li>
                <li class="nav-item"><a href="{{route('task.index')}}" class="nav-link link-dark px-2">Task</a></li>
                <li class="nav-item"><a href="{{route('employee.index')}}" class="nav-link link-dark px-2">Employee</a></li>
            </ul>
            <ul class="nav">
{{--                <li class="nav-item"><a href="#" class="nav-link link-dark px-2">Login</a></li>--}}
{{--                <li class="nav-item"><a href="#" class="nav-link link-dark px-2">Sign up</a></li>--}}
            </ul>
        </div>
    </nav>
    <header class="py-3 mb-4 border-bottom">
        <div class="container d-flex flex-wrap justify-content-center">
            <a href="{{route('task.index')}}" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-dark text-decoration-none">
                <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
                <span class="fs-4">Task Manager</span>
            </a>
        </div>
    </header>
    <div class="container">
            <div class="d-flex justify-content-between p-3 my-3 text-white bg-purple rounded shadow-sm">
                <div class="lh-1">
                    <h6 class="mb-0 text-white">@yield('header_title')</h6>
                </div>
               <div>
                   @yield('top_button')
               </div>
            </div>
        @yield('content')
    </div>



</main>

<!-- <footer class="footer py-3 bg-light">
    <div class="container">
        <span class="text-muted">Copright &copy; 2022 Developed by Jahir Chowdhury</span>
    </div>
</footer> -->

<script crossorigin="anonymous"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js">
</script>
@stack('script')
</body>
</html>
