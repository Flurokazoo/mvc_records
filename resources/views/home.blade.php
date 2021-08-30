@extends ('app')

@section('content')
    <div class="flex justify-center mt-8">
        @if (session('unauthorised'))
            <div class="w-2/3 p-4 bg-white rounded-lg text-white bg-red-500">
                <span>{{ session('unauthorised') }}</span>
            </div>
        @endif
    </div>
    <div class="flex justify-center mt-8">
        <div class="w-2/3">
            <h1 class="text-white text-5xl text-center block">Welkom bij Records!</h1>
        </div>
    </div>
 
    @if ($albums->count())

        <div class="flex justify-center mt-8">
            <div class="w-8/12 bg-none rounded-lg grid text-center grid-cols-4 gap-4">
                @foreach ($albums as $album)
                    <div class="bg-gray-200 w-full rounded-md p-4 justify-center">


                        <img class="mx-auto" src="{{ asset('img/' . $album->image_path) }}" alt="image">

                    </div>
                @endforeach
            </div>
        </div>
        <div class="flex justify-center mt-8 mb-6">
        </div>

    @else

    @endif
    </div>
@endsection
