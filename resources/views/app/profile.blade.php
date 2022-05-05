@extends('app.layouts.layout_account')
@section('contents')
    <!-- account content -->
    <div class="col-span-9 shadow rounded px-6 pt-5 pb-7 mt-6 lg:mt-0">
        <form action="/accounts/profile" method="POST">
            @csrf()
            <h3 class="text-lg font-medium capitalize mb-4">
                Profile Information
            </h3>
            <div class="space-y-4">
                <div>
                    <label class="text-gray-600 mb-2 block">
                        Name
                    </label>
                    <input type="text" class="input-box" name="name"
                        value="@if (Auth::user()) {{ Auth::user()->name }} @endif" required>
                </div>

                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="text-gray-600 mb-2 block">
                            Birthday
                        </label>
                        <input type="date" name="birthday"
                            @if (isset($userdetail)) value="{{ $userdetail->birthday }}" @else value="1990-01-01" @endif
                            class="input-box">
                    </div>
                    <div>
                        <label class="text-gray-600 mb-2 block">
                            Gender
                        </label>
                        <select class="input-box" name="gender">
                            <option
                                @if (isset($userdetail)) {{ $userdetail->gender == '0' ? 'selected' : '' }} @else value="0" selected @endif
                                value="0">
                                Male</option>
                            <option
                                @if (isset($userdetail)) {{ $userdetail->gender == '1' ? 'selected' : '' }} @else value="1" @endif
                                value="1">Female</option>
                        </select>
                    </div>
                </div>
                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="text-gray-600 mb-2 block">
                            Email Address
                        </label>
                        <input type="email" name="email" class="input-box"
                            value="@if (Auth::user()) {{ Auth::user()->email }} @endif" required>
                    </div>
                    <div>
                        <label class="text-gray-600 mb-2 block">
                            Phone Number
                        </label>
                        <input type="phone" name="phone" class="input-box"
                            @if (isset($userdetail)) value="{{ $userdetail->phone }}" @else value="" @endif
                            required>
                    </div>
                </div>
            </div>
            <div class="mt-6">
                <button type="submit"
                    class="px-6 py-2 text-center text-white bg-primary border border-primary rounded hover:bg-transparent hover:text-primary transition uppercase font-roboto font-medium">
                    Save change
                </button>
            </div>
        </form>
    </div>
    <!-- account content end -->
    @error('phone')
        <script>
            toastr.error('{{ $message }}');
        </script>
    @enderror
    @error('email')
        <script>
            toastr.error('{{ $message }}');
        </script>
    @enderror
    @error('birthday')
        <script>
            toastr.error('{{ $message }}');
        </script>
    @enderror
    @error('gender')
        <script>
            toastr.error('{{ $message }}');
        </script>
    @enderror
@endsection
