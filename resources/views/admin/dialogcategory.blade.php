@extends('admin.layouts.nav')
@section('content')
    <div class="max-w-[700px] mx-auto px-3 lg:px-6">
        <h2 class="text-3xl font-bold mb-12 text-blue-600">{{ $title }}</h2>
        @if (isset($category))
            <form action="/admin/category/{{ $category->id }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $category->id }}" />
                <div class="form-group mb-6">
                    <input type="text"
                        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        name="name" value="{{ $category->name }}" required placeholder="Name Category">
                </div>
                <div class="form-group mb-6">
                    <textarea name="description" required
                        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        rows="3" placeholder="Description">{{ $category->description }}</textarea>
                </div>
                <div class="form-group mb-6">
                    <div class="w-96">
                        <input name="image"
                            class="mb-2 form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            type="file">
                        <img class="rounded-lg w-32" alt="Avatar" src="{{ $category->image }}">
                    </div>
                </div>
                <div class="form-group mb-6">
                    <div class="form-control">
                        <h1 class="text-base font-normal text-gray-700">Active</h1>
                        <input name="active" {{ $category->active == '1' ? 'checked' : '' }}
                            class="appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                            type="radio" value="1" checked>
                        <label class="inline-block text-green-800" for="flexCheckDefault">
                            Yes
                        </label>
                    </div>
                    <div class="form-control">
                        <input name="active" {{ $category->active == '0' ? 'checked' : '' }}
                            class="appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                            type="radio" value="0">
                        <label class="inline-block text-red-800" for="flexCheckChecked">
                            No
                        </label>
                    </div>
                </div>
                <button type="submit"
                    class=" w-full px-6 py-2.5 bg-green-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out">{{ $active }}</button>
                <div
                    class="mt-4 w-full px-6 py-2.5 bg-blue-600 leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                    <a href="/admin/category" class="ml-60 px-6 py-2.5 text-white font-medium text-xs">Back To List</a>
                </div>
            </form>
        @else
            <form action="/admin/category" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-6">
                    <input type="text"
                        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        name="name" required placeholder="Name Category">
                </div>
                <div class="form-group mb-6">
                    <textarea name="description" required
                        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        rows="3" placeholder="Description"></textarea>
                </div>
                <div class="form-group mb-6">
                    <div class="w-96">
                        <input name="image"
                            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            type="file">
                    </div>
                </div>
                <div class="form-group mb-6">
                    <div class="form-control">
                        <h1 class="text-base font-normal text-gray-700">Active</h1>
                        <input name="active"
                            class="appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                            type="radio" value="1" checked>
                        <label class="inline-block text-green-800" for="flexCheckDefault">
                            Yes
                        </label>
                    </div>
                    <div class="form-control">
                        <input name="active"
                            class="appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                            type="radio" value="0">
                        <label class="inline-block text-red-800" for="flexCheckChecked">
                            No
                        </label>
                    </div>
                </div>
                <button type="submit"
                    class=" w-full px-6 py-2.5 bg-green-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out">{{ $active }}</button>
                <div
                    class="mt-4 w-full px-6 py-2.5 bg-blue-600 leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                    <a href="/admin/category" class="ml-60 px-6 py-2.5 text-white font-medium text-xs">Back To List</a>
                </div>
            </form>
        @endif

    </div>
    @error('name')
        <script>
            toastr.error('{{ $message }}');
        </script>
    @enderror
    @error('image')
        <script>
            toastr.error('{{ $message }}');
        </script>
    @enderror
    <div class="mb-20"></div>
@endsection
