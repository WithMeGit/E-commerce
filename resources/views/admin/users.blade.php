@extends('admin.layouts.nav')
@section('content')
    <a href="/admin/users/create" class="ml-6 px-6 py-2.5 bg-green-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out">
        Create User
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
                                Email
                            </th>
                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                Role
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
                        @foreach($userlist as $key => $users)
                            <tr class="border-b">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{$users -> id}}</td>
                                <td class="text-sm text-gray-900 font-mono px-6 py-4 whitespace-nowrap">
                                    {{$users -> name}}
                                </td>
                                <td class="text-sm text-gray-900 font-mono px-6 py-4 whitespace-nowrap">
                                    {{$users -> email}}
                                </td>
                                <td class="text-sm text-gray-900 font-mono px-6 py-4 whitespace-nowrap">
                                    {{$users -> role == '1' ? 'Admin' : 'Customer'}}
                                </td>
                                <td class="text-sm text-gray-900 font-mono px-6 py-4 whitespace-nowrap">
                                    {{$users -> created_at}}
                                </td>
                                <td class="text-sm text-gray-900 font-mono px-6 py-4 whitespace-nowrap">
                                    {{$users -> updated_at}}
                                </td>
                                <td>
                                    <button onclick="editItem('/admin/users/{{$users->id}}/edit')"
                                            class="px-6 py-2.5 bg-blue-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-500 hover:shadow-lg focus:bg-blue-500 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-600 active:shadow-lg transition duration-150 ease-in-out"
                                    ><i class="fas fa-pen fa-xs"></i></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-center mt-4">
                    {{$userlist->links()}}
                </div>
            </div>
        </div>
    </div>

    <div class="mb-52"></div>
    @if (Session::has('success'))
        <script>
            toastr.success('{{ Session::get('success') }}');
        </script>
    @endif
@endsection
