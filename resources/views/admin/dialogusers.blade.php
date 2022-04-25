@extends('admin.layouts.nav')
@section('content')
    <div class="max-w-[700px] mx-auto px-3 lg:px-6">
        <h2 class="text-3xl font-bold mb-4 text-blue-600">{{$title}}</h2>
        @if(isset($user))
            <form action="/admin/users/{{$user->id}}" method="post">
                @csrf
                <div class="form-group mb-6">
                    <input type="text" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                           name="name" required
                           value="{{$user->name}}"
                           placeholder="Name">
                </div>
                <div class="form-group mb-6">
                    <input type="email" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                           name="email" required
                           value="{{$user->email}}"
                           placeholder="Email">
                </div>
                <div class="form-group mb-6">
                    <input type="password" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                           name="password" required
                           placeholder="Password">
                </div>
                <div class="form-group mb-6">
                    <div class="form-control">
                        <h1 class="text-base font-normal text-gray-700">Role</h1>
                        <input name="role" {{ ($user->role == '1') ? 'checked' : ''}}
                               class="appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" value="1" >
                        <label class="inline-block text-green-800" for="flexCheckDefault">
                            Admin
                        </label>
                    </div>
                    <div class="form-control">
                        <input name="role" {{ ($user->role == '0') ? 'checked' : ''}}
                               class="appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" value="0">
                        <label class="inline-block text-red-800" for="flexCheckChecked">
                            Customer
                        </label>
                    </div>
                </div>
                <button type="submit" class=" w-full px-6 py-2.5 bg-green-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out">{{$active}}</button>
                <div class="mt-4 w-full px-6 py-2.5 bg-blue-600 leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                    <a href="/admin/users" class="ml-60 px-6 py-2.5 text-white font-medium text-xs">Back To List</a>
                </div>
            </form>
        @else
            <form action="/admin/users" method="post">
                @csrf
                <div class="form-group mb-6">
                    <input type="text" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                           name="name" required
                           placeholder="Name">
                </div>
                <div class="form-group mb-6">
                    <input type="email" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                           name="email" required
                           placeholder="Email">
                </div>
                <div class="form-group mb-6">
                    <input type="password" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                           name="password" required
                           placeholder="Password">
                </div>
                <div class="form-group mb-6">
                    <input type="password" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                           name="password_confirmation" required
                           placeholder="Confirm Password">
                </div>
                <div class="form-group mb-6">
                    <div class="form-control">
                        <h1 class="text-base font-normal text-gray-700">Role</h1>
                        <input name="role" class="appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" value="1" >
                        <label class="inline-block text-green-800" for="flexCheckDefault">
                            Admin
                        </label>
                    </div>
                    <div class="form-control">
                        <input name="role" class="appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio" value="0" checked >
                        <label class="inline-block text-red-800" for="flexCheckChecked">
                            Customer
                        </label>
                    </div>
                </div>
                <button type="submit" class=" w-full px-6 py-2.5 bg-green-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out">{{$active}}</button>
                <div class="mt-4 w-full px-6 py-2.5 bg-blue-600 leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                    <a href="/admin/users" class="ml-60 px-6 py-2.5 text-white font-medium text-xs">Back To List</a>
                </div>
            </form>
        @endif
    </div>
    <div class="mb-52"></div>
    @error('name')
    <script>
        toastr.error('{{$message}}');
    </script>
    @enderror
    @error('email')
    <script>
        toastr.error('{{$message}}');
    </script>
    @enderror
    @error('password')
    <script>
        toastr.error('{{$message}}');
    </script>
    @enderror
@endsection
