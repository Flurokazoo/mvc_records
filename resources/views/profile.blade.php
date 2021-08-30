@extends ('app')

@section('content')
    <div class="flex justify-center mt-8">
        <div class="w-1/3 p-4 bg-white rounded-lg">
            @foreach (auth()->user()->reviews as $review)
                <div class="bg-gray-200 w-full rounded-md p-4 justify-center">
                    <h1 class="text-3xl mb-3">Review:'{{ $review->body }}'</h1>
                    <h2 class="text-2xl mb-3">Posted at '{{ $review->album->name }}'' by '{{ $review->album->artist }}'.</h2>
                    <p class="text-xl mb-3">{{$review->likes->count()}} likes.</p>
                    <img class="mt-4 mx-auto" src="{{ asset('img/' . $review->album->image_path) }}" alt="image">
                </div>
            @endforeach
        </div>
    </div>
@endsection
