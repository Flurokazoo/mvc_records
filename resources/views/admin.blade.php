@extends ('app')

@section('content')
    @if ($users->count())
        <div class="flex justify-center mt-8">
            <div class="w-6/12 bg-none rounded-lg">
                @foreach ($users as $user)
                    <div class="bg-gray-200 w-full rounded-md p-4 justify-center m-4">
                        <span class="mt-4 text-xl bold">{{ $user->username }}</span>
                        @if ($user->active)
                            <form action="{{ route('admin.user', $user) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="rounded mt-4 text-white bg-red-500 p-2 pl-3 pr-3">Deactivate
                                    account</button>
                            </form>
                        @else
                            <form action="{{ route('admin.user', $user) }}" method="post">
                                @csrf
                                <button type="submit" value="{{ $user->id }}"
                                    class="rounded mt-4 text-white bg-blue-500 p-2 pl-3 pr-3">Activate account</button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <div class="flex justify-center mt-8">
        <div class="w-6/12 bg-white p-4 rounded-lg">
            <form action="{{ route('admin.tag') }}" method="post">
                @csrf

                <div class="mt-4">
                    <label for="name">Tag name:</label>
                    <input type="name" name="name" id="name" placeholder="Enter the desired tag name"
                        class="bg-gray-200 w-full p-3 rounded-md mt-4" value="{{ old('name') }}">
                    @error('name')
                        <div class="text-red-300">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-8">
                    <button type="submit" class="bg-blue-500 w-full text-white rounded py-4">Add Tag</button>
                </div>
            </form>
        </div>
    </div>
@endsection
