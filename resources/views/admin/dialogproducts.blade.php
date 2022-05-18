@extends('admin.layouts.nav')
@section('content')
    <div class="max-w-[700px] mx-auto px-3 lg:px-6">
        <h2 class="text-3xl font-bold mb-4 text-blue-600">{{ $title }}</h2>
        @if (isset($editproduct))
            <form action="/admin/products/{{ $editproduct->id }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $editproduct->id }}" />
                <div class="form-group mb-6">
                    <input type="text"
                        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        name="name" required value="{{ $editproduct->name }}" placeholder="Name Product">
                </div>
                <div class="form-group mb-6">
                    <div class="mb-3 xl:w-96">
                        <select name="category_id"
                            class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            aria-label="Default select example">
                            <option selected>Open this select Categrory</option>
                            @foreach ($categorylist as $key => $cate)
                                <option value="{{ $cate->id }}"
                                    {{ $editproduct->category_id == $cate->id ? 'selected' : '' }}>{{ $cate->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group mb-6">
                    <div class="mb-3 xl:w-96">
                        <select name="brand_id"
                            class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            aria-label="Default select example">
                            <option selected>Open this select Brand</option>
                            @foreach ($brandlist as $key => $brands)
                                <option value="{{ $brands->id }}"
                                    {{ $editproduct->brand_id == $brands->id ? 'selected' : '' }}>{{ $brands->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group mb-6">
                    <textarea name="description" required
                        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        rows="3" placeholder="Description">{{ $editproduct->description }}</textarea>
                </div>
                <div class="form-group mb-6">
                    <div class="w-96">
                        <input name="image"
                            class="mb-2 form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            type="file">
                        <img class="rounded-lg w-32" alt="Avatar" src="{{ $editproduct->image }}">
                    </div>
                </div>
                <div class="form-group mb-6">
                    <input type="text"
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46'
                        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        name="promotion_price" required value="{{ $editproduct->promotion_price }}"
                        placeholder="Promotion Price Product">
                </div>
                <div class="form-group mb-6">
                    <input type="text"
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46'
                        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        name="original_price" required value="{{ $editproduct->original_price }}"
                        placeholder="Original Price Product">
                </div>
                <div class="form-group mb-6">
                    <input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        name="quantity" required value="{{ $editproduct->quantity }}" placeholder="Quantity Product">
                </div>
                <div class="form-group mb-6">
                    <div class="form-control">
                        <h1 class="text-base font-normal text-gray-700">Active</h1>
                        <input name="active" {{ $editproduct->active == '1' ? 'checked' : '' }}
                            class="appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                            type="radio" value="1">
                        <label class="inline-block text-green-800" for="flexCheckDefault">
                            Yes
                        </label>
                    </div>
                    <div class="form-control">
                        <input name="active" {{ $editproduct->active == '0' ? 'checked' : '' }}
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
                    <a href="/admin/products" class="ml-60 px-6 py-2.5 text-white font-medium text-xs">Back To List</a>
                </div>
            </form>
        @else
            @if (isset($detailproduct))
                <div class="form-group mb-6">
                    Name: {{ $detailproduct->name }}
                </div>
                <div class="form-group mb-6">
                    @foreach ($categorylist as $key => $cate)
                        @if ($detailproduct->category_id == $cate->id)
                            Category Name: {{ $cate->name }}
                        @endif
                    @endforeach
                </div>
                <div class="form-group mb-6">
                    @foreach ($brandlist as $key => $brands)
                        @if ($detailproduct->brand_id == $brands->id)
                            Brand Name: {{ $brands->name }}
                        @endif
                    @endforeach
                </div>
                <div class="form-group mb-6">
                    Description: {{ $detailproduct->description }}
                </div>
                <div class="form-group mb-6">
                    Image:
                    <img class="rounded-lg w-32" alt="Avatar" src="{{ $detailproduct->image }}">
                </div>
                <div class="form-group mb-6">
                    Promotion Price: {{ $detailproduct->promotion_price }}
                </div>
                <div class="form-group mb-6">
                    Original Price: {{ $detailproduct->original_price }}
                </div>
                <div class="form-group mb-6">
                    Quantity: {{ $detailproduct->quantity }}
                </div>
                <div class="form-group mb-6">
                    Active: {{ $detailproduct->active == '1' ? 'True' : 'False' }}
                </div>
                <a href="/admin/products"
                    class="w-full px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Back
                    To List</a>
            @else
                <form action="/admin/products" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-6">
                        <input type="text"
                            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            name="name" required placeholder="Name Product">
                    </div>
                    <div class="form-group mb-6">
                        <div class="mb-3 xl:w-96">
                            <select name="category_id"
                                class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                aria-label="Default select example">
                                <option value="" selected>Open this select Categrory</option>
                                @foreach ($category as $key => $cate)
                                    <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-6">
                        <div class="mb-3 xl:w-96">
                            <select name="brand_id"
                                class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                aria-label="Default select example">
                                <option value="" selected>Open this select Brand</option>
                                @foreach ($brand as $key => $brands)
                                    <option value="{{ $brands->id }}">{{ $brands->name }}</option>
                                @endforeach
                            </select>
                        </div>
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
                        <input type="text"
                            onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46'
                            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            name="promotion_price" required placeholder="Promotion Price Product">
                    </div>
                    <div class="form-group mb-6">
                        <input type="text"
                            onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46'
                            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            name="original_price" required placeholder="Original Price Product">
                    </div>
                    <div class="form-group mb-6">
                        <input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            name="quantity" required placeholder="Quantity Product">
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
                        <a href="/admin/products" class="ml-60 px-6 py-2.5 text-white font-medium text-xs">Back To List</a>
                    </div>
                </form>
            @endif
        @endif

    </div>
    @error('name')
        <script>
            toastr.error('{{ $message }}');
        </script>
    @enderror
    @error('category_id')
        <script>
            toastr.error('The Category field is required.');
        </script>
    @enderror
    @error('brand_id')
        <script>
            toastr.error('The Category field is required.');
        </script>
    @enderror
    @error('image')
        <script>
            toastr.error('{{ $message }}');
        </script>
    @enderror
    <div class="mb-52"></div>
@endsection
