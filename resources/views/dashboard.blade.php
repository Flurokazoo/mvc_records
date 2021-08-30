@extends ('app')

@section('content')

    @if (auth()->user()->admin)
        {{ auth()->user()->isAuth }}
        <div class="flex justify-center mt-8">
            <div class="w-6/12 p-4 bg-white rounded-lg">
                <form action="{{ route('dashboard') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mt-4">
                        <label for="artist">Artist:</label>
                        <input type="text" name="artist" id="artist" placeholder="What is the name of the artist?"
                            class="bg-gray-200 w-full p-3 rounded-md mt-4" value="{{ old('artist') }}">
                        @error('artist')
                            <div class="text-red-300">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <label for="name">Title:</label>
                        <input type="text" name="name" id="name" placeholder="What is the name of the album?"
                            class="bg-gray-200 w-full p-3 rounded-md mt-4" value="{{ old('name') }}">
                        @error('name')
                            <div class="text-red-300">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label for="year">Year of release:</label>
                        <input type="text" name="year" id="year" placeholder="What is the release year of the album?"
                            class="bg-gray-200 w-full p-3 rounded-md mt-4" value="{{ old('year') }}">
                        @error('year')
                            <div class="text-red-300">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <label for="image">Select image:</label>
                        <input type="file" name="image" id="image" class="bg-gray-200 w-full p-3 rounded-md mt-4"
                            value="{{ old('image') }}">
                        @error('image')
                            <div class="text-red-300">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-4">

                        <label for="tags">Select genre(s):</label>

                        @foreach ($tags as $tag)

                            <div class="w-3/12 bg-gray-200 w-full p-3 rounded-md mt-4">
                                <input type="checkbox" multiple name="tag[]" placeholder="" value="{{ $tag->id }}">
                                <span class="ml-3">{{ $tag->name }} </span>
                            </div>



                        @endforeach
                        @error('image')
                            <div class="text-red-300">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-8">
                        <button type="submit" class="bg-blue-500 w-full text-white rounded py-4">Add album</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
    <div class="flex justify-center mt-8">
        <div class="w-6/12 p-4 bg-white rounded-lg">
            <form action="{{ route('dashboard.search') }}" method="post">
                @csrf
                <div class="mt-4">
                    <label for="body">Search:</label>
                    <input type="text" name="body" id="body" placeholder="Enter your search term"
                        class="bg-gray-200 w-full p-3 rounded-md mt-4" value="{{ old('text') }}">
                    @error('text')
                        <div class="text-red-300">{{ $message }}</div>
                    @enderror
                </div>

                <label for="tags">Select genre(s):</label>

                @foreach ($tags as $tag)
                    <div class="w-3/12 bg-gray-200 w-full p-3 rounded-md mt-4">
                        <input type="radio" name="tag" placeholder="" value="{{ $tag->id }}">
                        <span class="ml-3">{{ $tag->name }} </span>
                    </div>



                @endforeach

                <div class="mt-8">
                    <button type="submit" class="bg-blue-500 w-full text-white rounded py-4">Search</button>
                </div>
            </form>
        </div>
    </div>
    @if ($albums->count())

        <div class="flex justify-center mt-8">
            <div class="w-8/12 bg-none rounded-lg grid text-center grid-cols-4 gap-4">
                @foreach ($albums as $album)
                    <div class="bg-gray-200 w-full rounded-md p-4 justify-center m-4">
                        <a href="{{ url('albums/' . $album->id) }}">
                            <h1 class="text-3xl mb-3">{{ $album->name }}</h1>
                            <h2 class="text-2xl mb-3">{{ $album->artist }}</h2>
                            <span class="italic mb-3">{{ $album->year }}</span>
                            <img class="mt-4 mx-auto" src="{{ asset('img/' . $album->image_path) }}" alt="image">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="flex justify-center mt-8 mb-6">
        </div>

    @else

    @endif
@endsection
