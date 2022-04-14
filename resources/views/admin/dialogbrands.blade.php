@extends('admin.layouts.nav')
@section('content')
    <div class="max-w-[700px] mx-auto px-3 lg:px-6">
        <h2 class="text-3xl font-bold mb-12">{{$title}}</h2>
        @if(isset($brand))
            <form action="/admin/brand/{{$brand->id}}" method="post">
                @csrf
                <div class="form-group mb-6">
                    <input type="text" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                           name="name"
                           value="{{$brand->name}}"
                           placeholder="Name Brand">
                </div>
                <div class="form-group mb-6">
                    <div class="mb-3 xl:w-96">
                        <select name="category_id" class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example">
                            <option value="" selected>Open this select Categrory</option>
                            @foreach($category as $key => $cate)
                                <option value="{{ $cate->id }}" {{ $brand->category_id == $cate->id ? 'selected' : "" }}>{{ $cate->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group mb-6">
                    <textarea name="description"
                              class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" rows="3" placeholder="Description">{{$brand->description}}</textarea>
                </div>
                <div class="form-group mb-6">
                    <textarea name="content"
                              class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" rows="3" placeholder="Content">{{$brand->content}}</textarea>
                </div>
                <div class="form-group mb-6">
                    <div class="form-control">
                        <h1 class="text-base font-normal text-gray-700">Active</h1>
                        <input name="active" {{ ($brand->active == '1') ? 'checked' : ''}}
                               class="appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" value="1" checked>
                        <label class="inline-block text-green-800" for="flexCheckDefault">
                            Yes
                        </label>
                    </div>
                    <div class="form-control">
                        <input name="active" {{ ($brand->active == '0') ? 'checked' : ''}}
                               class="appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" value="0" >
                        <label class="inline-block text-red-800" for="flexCheckChecked">
                            No
                        </label>
                    </div>
                </div>
                <button type="submit" class=" w-full px-6 py-2.5 bg-green-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out">{{$active}}</button>
                <div class="mt-4 w-full px-6 py-2.5 bg-blue-600 leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                    <a href="/admin/brand" class="ml-60 px-6 py-2.5 text-white font-medium text-xs">Back To List</a>
                </div>
            </form>
        @else
            <form action="/admin/brand" method="post">
                @csrf
                <div class="form-group mb-6">
                    <input type="text" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                           name="name"
                           placeholder="Name Brand">
                </div>
                <div class="form-group mb-6">
                    <div class="mb-3 xl:w-96">
                        <select name="category_id" class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example">
                            <option value="" selected>Open this select Categrory</option>
                            @foreach($category as $key => $cate)
                                <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group mb-6">
                    <textarea name="description" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" rows="3" placeholder="Description"></textarea>
                </div>
                <div class="form-group mb-6">
                    <textarea name="content" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" rows="3" placeholder="Content"></textarea>
                </div>
                <div class="form-group mb-6">
                    <div class="form-control">
                        <h1 class="text-base font-normal text-gray-700">Active</h1>
                        <input name="active" class="appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" value="1" checked>
                        <label class="inline-block text-green-800" for="flexCheckDefault">
                            Yes
                        </label>
                    </div>
                    <div class="form-control">
                        <input name="active" class="appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" value="0" >
                        <label class="inline-block text-red-800" for="flexCheckChecked">
                            No
                        </label>
                    </div>
                </div>
                <button type="submit" class=" w-full px-6 py-2.5 bg-green-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out">{{$active}}</button>
                <div class="mt-4 w-full px-6 py-2.5 bg-blue-600 leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                    <a href="/admin/brand" class="ml-60 px-6 py-2.5 text-white font-medium text-xs">Back To List</a>
                </div>
            </form>
        @endif

    </div>

    @if (Session::has('error'))
        <script>
            toastr.error('{{ Session::get('error') }}');
        </script>
    @endif

    <div class="mb-20"></div>
@endsection
