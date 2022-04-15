@extends('admin.layouts.nav')
@section('content')
    <a href="/admin/products/create" class="ml-6 px-6 py-2.5 bg-green-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out">
        Create Brand
    </a>
    <h1 class="flex justify-center font-medium leading-tight text-5xl mt-0 mb-2 text-blue-600">{{$title}}</h1>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="border-b">
                        <tr>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                ID
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Name
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Category Name
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Brand Name
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Description
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Image
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Price
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Quantity
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Active
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($productlist as $key => $products)
                        <tr class="border-b">
                            <td class="text-sm text-gray-900 font-mono px-6 py-4 whitespace-nowrap">
                                {{$products->id}}
                            </td>
                            <td class="text-sm text-gray-900 font-mono">
                                {{$products->name}}
                            </td>
                            <td class="text-sm text-gray-900 font-mono px-6 py-4 whitespace-nowrap">
                                @foreach($categorylist as $key => $cate)
                                    @if($cate->id == $products->category_id)
                                        {{$cate->name}}
                                    @endif
                                @endforeach
                            </td>
                            <td class="text-sm text-gray-900 font-mono px-6 py-4 whitespace-nowrap">
                                @foreach($brandlist as $key => $brand)
                                    @if($brand->id == $products->brand_id)
                                        {{$brand->name}}
                                    @endif
                                @endforeach
                            </td>
                            <td class="text-sm text-gray-900 font-mono px-6 py-4">
                                    {{$products->description}}
                            </td>
                            <td class="text-sm text-gray-900 font-mono px-6 py-4 whitespace-nowrap">
                                <img src="{{$products->image}}">
                            </td>
                            <td class="text-sm text-gray-900 font-mono px-6 py-4 whitespace-nowrap">
                                {{$products->price}}
                            </td>
                            <td class="text-sm text-gray-900 font-mono px-6 py-4 whitespace-nowrap">
                                {{$products->quantity}}
                            </td>
                            <td class="text-sm text-gray-900 font-mono px-6 py-4 whitespace-nowrap">
                                {{($products -> active == '1') ? 'active' : 'no active'}}
                            </td>
                            <td>
                                <!-- Button view category modal -->
                                <button onclick="editItem('/admin/products/{{$products->id}}')"
                                        class="px-6 py-2.5 bg-green-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-500 hover:shadow-lg focus:bg-green-500 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-600 active:shadow-lg transition duration-150 ease-in-out" ><i class="fas fa-eye fa-xs"></i></button>
                                <button onclick="editItem('/admin/products/{{$products->id}}/edit')"
                                        class="px-6 py-2.5 bg-blue-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-500 hover:shadow-lg focus:bg-blue-500 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-600 active:shadow-lg transition duration-150 ease-in-out"
                                ><i class="fas fa-pen fa-xs"></i></button>
                                <button onclick="deleteItem('/admin/products/{{$products->id}}')" class="px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out " ><i class="fas fa-trash fa-xs"></i></button>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-center mt-4">
                    {{$productlist->links()}}
                </div>
            </div>
        </div>
    </div>
    <div class="mb-96"></div>

    @if (Session::has('error'))
        <script>
            toastr.error('{{ Session::get('error') }}');
        </script>
    @endif
    @if (Session::has('success'))
        <script>
            toastr.success('{{ Session::get('success') }}');
        </script>
    @endif
@endsection

