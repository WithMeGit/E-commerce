@extends('admin.layouts.nav')
@section('content')
    <a href="/admin/brands/create" class="ml-6 px-6 py-2.5 bg-green-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out">
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
                                Id
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Name
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Description
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Content
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Active
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Created at
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Update at
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($brandlist as $key => $brand)
                            <tr class="border-b">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{$brand -> id}}</td>
                                <td class="text-sm text-gray-900 font-mono px-6 py-4 whitespace-nowrap">
                                    {{$brand -> name}}
                                </td>
                                <td class="text-sm text-gray-900 font-mono px-6 py-4 whitespace-nowrap">
                                    {{$brand -> description}}
                                </td>
                                <td class="text-sm text-gray-900 font-mono px-6 py-4 whitespace-nowrap">
                                    {{$brand -> content}}
                                </td>
                                <td class="text-sm text-gray-900 font-mono px-6 py-4 whitespace-nowrap">
                                    {{($brand -> active == '1') ? 'active' : 'no active'}}
                                </td>
                                <td class="text-sm text-gray-900 font-mono px-6 py-4 whitespace-nowrap">
                                    {{$brand -> created_at}}
                                </td>
                                <td class="text-sm text-gray-900 font-mono px-6 py-4 whitespace-nowrap">
                                    {{$brand -> updated_at}}
                                </td>
                                <td>
                                    <!-- Button view category modal -->
                                    <button onclick="detailItem('{{ $brand->id }}', '/admin/brands/{{ $brand->id }}')" data-bs-toggle='modal'  data-bs-target='#viewModal'
                                            class="px-6 py-2.5 bg-green-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-500 hover:shadow-lg focus:bg-green-500 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-600 active:shadow-lg transition duration-150 ease-in-out" ><i class="fas fa-eye fa-xs"></i></button>
                                    <button onclick="editItem('/admin/brands/{{ $brand->id }}/edit')" class="px-6 py-2.5 bg-blue-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-500 hover:shadow-lg focus:bg-blue-500 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-600 active:shadow-lg transition duration-150 ease-in-out"><i class="fas fa-pen fa-xs"></i></button>
                                    <button onclick="deleteItem('{{ $brand->id }}', '/admin/brands/{{ $brand->id }}')" class="px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out "><i class="fas fa-trash fa-xs"></i></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-center mt-4">
                    {{$brandlist->links()}}
                </div>
            </div>
        </div>
    </div>

    <!-- View Category Modal -->
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="viewModal" tabIndex={-1} aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog relative w-auto pointer-events-none">
            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                    <h5 class="text-xl font-medium leading-normal text-gray-800 viewCategoryModal" id="viewModal">Deltail Brand</h5>
                    <button type="button" class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline" data-bs-dismiss="modal" aria-label="Close" />
                </div>
                <div class="modal-body relative p-4" id="name"></div>
                <div class="modal-body relative p-4" id="description"></div>
                <div class="modal-body relative p-4" id="content"></div>
                <div class="modal-body relative p-4" id="active"></div>
                <div class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                    <button type="button" class="px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-72"></div>
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
