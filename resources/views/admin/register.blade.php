@extends('admin.layouts.header')
@section('contents')
    <body>
    <section class="h-screen">
        <div class="container px-6 py-12 h-full">
            <div class="flex justify-center items-center flex-wrap h-full g-6 text-gray-800">
                <div class="md:w-8/12 lg:w-6/12 mb-12 md:mb-0">
                    <img
                        src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
                        class="w-full"
                        alt="Phone image"
                    />
                </div>
                <div class="md:w-8/12 lg:w-5/12 lg:ml-20">
                    <form action="/admin/register" method="post">
                        @csrf
                        <!-- Email input -->
                        <div class="mb-6">
                            <input
                                name="name"
                                type="text"
                                required
                                class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"
                                placeholder="Name"
                            />
                        </div>
                        <div class="mb-6">
                            <input
                                type="email"
                                required
                                class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                placeholder="Email address"
                                @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                            />
                        </div>
                        <!-- Password input -->
                        <div class="mb-6">
                            <input
                                type="password"
                                required
                                class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                placeholder="Password"
                                @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}"
                            />
                        </div>
                        <div class="mb-6">
                            <input
                                name="password_confirmation"
                                type="password"
                                required
                                class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                placeholder="Confirm Password"
                            />
                        </div>
                        <!-- Submit button -->
                        <button
                            type="submit"
                            name="register"
                            class="inline-block px-7 py-3 bg-blue-600 text-white font-medium text-sm leading-snug uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out w-full"
                            data-mdb-ripple="true"
                            data-mdb-ripple-color="light"
                        >
                            Register
                        </button>

                        <div class="flex justify-between items-center mb-6 mt-6">
                            <a href="/admin/login"
                               class="text-blue-600 hover:text-blue-700 focus:text-blue-700 active:text-blue-800 duration-200 transition ease-in-out"
                            >Already Registered.</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
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
    </body>
@endsection
