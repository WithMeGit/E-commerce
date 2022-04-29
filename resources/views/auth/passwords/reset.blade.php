@extends('app.layouts.header')

@section('content')
    <div class="container py-16">
        <div class="max-w-lg mx-auto shadow px-6 py-7 rounded overflow-hidden">
            <h2 class="text-2xl uppercase font-medium mb-1">
                {{ __('Reset Password') }}
            </h2>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="space-y-4">
                    <div>
                        <label class="text-gray-600 mb-2 block">
                            {{ __('Email Address') }} <span class="text-primary">*</span>
                        </label>
                        <input id="email" type="email" class="input-box @error('email') is-invalid @enderror" name="email"
                            value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                    </div>
                    @error('email')
                        <div class="bg-yellow-100 rounded-lg py-5 px-6 mb-3 text-base text-yellow-700 inline-flex items-center w-full"
                            role="alert">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="exclamation-triangle"
                                class="w-4 h-4 mr-2 fill-current" role="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 576 512">
                                <path fill="currentColor"
                                    d="M569.517 440.013C587.975 472.007 564.806 512 527.94 512H48.054c-36.937 0-59.999-40.055-41.577-71.987L246.423 23.985c18.467-32.009 64.72-31.951 83.154 0l239.94 416.028zM288 354c-25.405 0-46 20.595-46 46s20.595 46 46 46 46-20.595 46-46-20.595-46-46-46zm-43.673-165.346l7.418 136c.347 6.364 5.609 11.346 11.982 11.346h48.546c6.373 0 11.635-4.982 11.982-11.346l7.418-136c.375-6.874-5.098-12.654-11.982-12.654h-63.383c-6.884 0-12.356 5.78-11.981 12.654z">
                                </path>
                            </svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="text-gray-600 mb-2 block">
                            {{ __('Password') }} <span class="text-primary">*</span>
                        </label>
                        <input id="password" type="password" class="input-box @error('password') is-invalid @enderror"
                            name="password" required autocomplete="new-password">
                    </div>
                    @error('password')
                        <div class="bg-yellow-100 rounded-lg py-5 px-6 mb-3 text-base text-yellow-700 inline-flex items-center w-full"
                            role="alert">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="exclamation-triangle"
                                class="w-4 h-4 mr-2 fill-current" role="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 576 512">
                                <path fill="currentColor"
                                    d="M569.517 440.013C587.975 472.007 564.806 512 527.94 512H48.054c-36.937 0-59.999-40.055-41.577-71.987L246.423 23.985c18.467-32.009 64.72-31.951 83.154 0l239.94 416.028zM288 354c-25.405 0-46 20.595-46 46s20.595 46 46 46 46-20.595 46-46-20.595-46-46-46zm-43.673-165.346l7.418 136c.347 6.364 5.609 11.346 11.982 11.346h48.546c6.373 0 11.635-4.982 11.982-11.346l7.418-136c.375-6.874-5.098-12.654-11.982-12.654h-63.383c-6.884 0-12.356 5.78-11.981 12.654z">
                                </path>
                            </svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="text-gray-600 mb-2 block">
                            {{ __('Confirm Password') }} <span class="text-primary">*</span>
                        </label>
                        <input id="password-confirm" type="password" class="input-box" name="password_confirmation"
                            required autocomplete="new-password">

                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit"
                        class="block w-full py-2 text-center text-white bg-primary border border-primary rounded hover:bg-transparent hover:text-primary transition uppercase font-roboto font-medium">
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
