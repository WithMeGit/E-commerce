@extends('app.layouts.layout_account')
@section('contents')
    <!-- account content -->
    <div class="col-span-9 shadow rounded px-6 pt-5 pb-7 mt-6 lg:mt-0">
        <form action="/accounts/change-password" method="POST">
            @csrf()
            <h3 class="text-lg font-medium capitalize mb-4">
                Change password
            </h3>
            <div class="space-y-4 max-w-sm">
                <div>
                    <label class="text-gray-600 mb-2 block">
                        Current Password
                    </label>
                    <div class="relative">
                        <span class="absolute right-3 top-3 text-sm text-gray-500 cursor-pointer">
                            <i class="far fa-eye-slash"></i>
                        </span>
                        <input type="password" name="currentpassword" class="input-box" placeholder="current password"
                            required>
                    </div>
                </div>
                <div>
                    <label class="text-gray-600 mb-2 block">
                        New Password
                    </label>
                    <div class="relative">
                        <span class="absolute right-3 top-3 text-sm text-gray-500 cursor-pointer">
                            <i class="far fa-eye-slash"></i>
                        </span>
                        <input type="password" name="password" class="input-box" placeholder="new password" required>
                    </div>
                </div>
                <div>
                    <label class="text-gray-600 mb-2 block">
                        Confirm Password
                    </label>
                    <div class="relative">
                        <span class="absolute right-3 top-3 text-sm text-gray-500 cursor-pointer">
                            <i class="far fa-eye-slash"></i>
                        </span>
                        <input type="password" name="password_confirmation" class="input-box"
                            placeholder="confirm password" required>
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
    @error('password')
        <script>
            toastr.error('{{ $message }}');
        </script>
    @enderror
    @error('currentpassword')
        <script>
            toastr.error('{{ $message }}');
        </script>
    @enderror
    @if (Session::has('fail'))
        <script>
            toastr.error('{{ Session::get('fail') }}');
        </script>
    @endif
@endsection
