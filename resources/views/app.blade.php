<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Records</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="bg-gray-800">
    <nav class="p-4 flex justify-between bg-black text-white">
        <ul class="flex items-center">
            <li class="p-2"><a href="{{ route('home') }}">Home</a></li>
            <li class="p-2"><a href="{{ route('dashboard') }}">Albums</a></li>
            @auth
                @if (auth()->user()->admin)
                    <li class="p-2"><a href="{{ route('admin') }}">Admin</a></li>
                @endif
            @endauth

        </ul>


        @auth
            <ul class="flex items-right">
                <li class="p-2"><a href="{{ route('profile') }}">{{ auth()->user()->username }}</a></li>
                <li class="p-2">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </li>
            </ul>
        @endauth

        @guest
            <ul class="flex items-right">
                <li class="p-2"><a href="{{ route('login') }}">Login</a></li>
                <li class="p-2"><a href="{{ route('register') }}">Register</a></li>
            </ul>
        @endguest
    </nav>

    @yield('content')
</body>

</html>
