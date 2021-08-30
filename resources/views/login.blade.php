@extends ('app')

@section('content')
    <div class="flex justify-center mt-8">
        <div class="w-1/3 p-4 bg-white rounded-lg">
            @if (session('status'))
                {{ session('status') }}
            @endif
            <form action="{{ route('login') }}" method="post">
                @csrf

                <div class="mt-4">
                    <label for="email">E-mail:</label>
                    <input type="email" name="email" id="email" placeholder="Enter your e-mail"
                        class="bg-gray-200 w-full p-3 rounded-md mt-4" value="{{ old('email') }}">
                    @error('email')
                        <div class="text-red-300">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-4">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password"
                        class="bg-gray-200 w-full p-3 rounded-md mt-4" value="{{ old('password') }}">
                    @error('password')
                        <div class="text-red-300">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-8">
                    <button type="submit" class="bg-blue-500 w-full text-white rounded py-4">Login</button>
                </div>
            </form>
        </div>
    </div>
@endsection
