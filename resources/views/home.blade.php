@extends ('app')

@section('content')
    <div class="flex justify-center mt-8">
        @if (session('unauthorised'))
            <div class="w-2/3 p-4 bg-white rounded-lg text-white bg-red-500">

                <div class="">
                    {{ session('unauthorised') }}
                </div>

            </div>
        @endif
    </div>
@endsection
