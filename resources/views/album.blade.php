@extends ('app')

@section('content')
    <div class="flex justify-center mt-8">
        <div class="w-8/12 p-4 rounded-lg">
            <a href="{{ route('dashboard') }}" class="bg-blue-500 w-full text-white rounded p-4"">Back to dashboard</a></li>
        </div>
    </div>
    <div class="flex justify-center mt-8">

        <div class="w-8/12 rounded-lg grid text-center grid-cols-2 gap-4 bg-gray-200">
            <div class="w-full rounded-md p-4 justify-center m-4">
                <img class="mt-4 mx-auto" src="{{ asset('img/' . $album->image_path) }}" alt="image">
            </div>
            <div class="w-full rounded-md p-4 justify-center m-4 align-middle">
                <h1 class="text-5xl mt-4 mb-3">{{ $album->name }}</h1>
                <span class="text-3xl mt-4 mb-3">by</span>
                <h2 class="text-5xl mb-3">{{ $album->artist }}</h2>
                <span class="italic text-3xl mb-3">Released in:</span>
                <span class="italic text-3xl mb-6">{{ $album->year }}</span>
                <div class="justify-center mt-4">
                    @foreach ($album->tags as $tag)
                        <span class="rounded-xl text-white bg-green-500 mt-4 p-2 pl-3 pr-3">{{ $tag->name }}</span>
                    @endforeach
                </div>


            </div>
        </div>
    </div>
    @if (auth()->user()->canPost())
        <div class="flex justify-center mt-8">
            <div class="w-8/12 p-4 bg-white rounded-lg">
                <form action="{{ route('album', ['album' => $album->id]) }}" method="post">
                    @csrf
                    <div class="mt-4">
                        <label for="text">Post a comment</label>
                        <input type="text" name="body" id="body" placeholder="Post your review"
                            class="bg-gray-200 w-full p-3 rounded-md mt-4" value="{{ old('body') }}">
                        @error('body')
                            <div class="text-red-300">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-8">
                        <button type="submit" class="bg-blue-500 w-full text-white rounded py-4">Submit</button>
                    </div>
                </form>
            </div>

        </div>
    @endif

    <div class="flex justify-center mt-8">
        <div class="w-8/12 p-4 bg-white rounded-lg">
            @if ($reviews->count())
                @foreach ($reviews as $review)
                    <div class="p-2 mt-2 mb-2 border-t-2">
                        <div class="w-full rounded-md justify-items">
                            <h3 class="___class_+?23___">{{ $review->user->username }}</h3>
                            <span class="text-gray-400">{{ $review->created_at->diffForHumans() }}</span>
                            <p class="font-bold">{{ $review->body }}</h1>
                        </div>
                        <div class="w-full rounded-md justify-items">
                            @if (!$review->hasLiked(auth()->user()))
                                <form action="{{ route('review.likes', $review) }}" method="post">
                                    @csrf
                                    <button type="submit" class="rounded text-white bg-blue-500 p-2 pl-3 pr-3">Like</button>
                                </form>
                            @else
                                <form action="{{ route('review.likes', $review) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="rounded text-white bg-blue-500 p-2 pl-3 pr-3 mt-2">Remove
                                        Like</button>
                                </form>
                            @endif
                            @if ($review->isOwnedByUser(auth()->user()))
                                <form action="{{ route('review.destroy', $review) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="rounded text-white bg-red-500 p-2 pl-3 pr-3 mt-2">Delete
                                        review</button>
                                </form>
                                <a href="{{ route('review.edit', $review) }}"
                                    class="inline-block rounded text-white bg-yellow-500 p-2 pl-3 pr-3 mt-2">Edit Review</a>

                            @endif

                        </div>
                        <span>{{ $review->likes->count() }} likes</span>

                    </div>

                @endforeach
                {{ $reviews->links() }}
            @else
                <p>This album has no reviews. Be sure to add the first one!</p>
            @endif
        </div>
    </div>


@endsection
