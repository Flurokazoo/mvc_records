@extends ('app')

@section('content')

    <div class="flex justify-center mt-8">
        <div class="w-8/12 p-4 bg-white rounded-lg">
            <form action="{{ route('review.update', $review) }}" method="post">
                @method('PUT')
                @csrf
                <div class="mt-4">
                    <label for="text">Post a comment</label>
                    <input type="text" name="body" id="body" placeholder="Post your review"
                        class="bg-gray-200 w-full p-3 rounded-md mt-4" value="{{ $review->body }}">
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

@endsection
