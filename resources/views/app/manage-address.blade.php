@extends('app.layouts.layout_account')
@section('contents')
    <div class="col-span-9 shadow rounded px-6 pt-5 pb-7 mt-6 lg:mt-0">
        <form action="/accounts/manage-address" method="POST">
            @csrf()
            <h3 class="text-lg font-medium capitalize mb-4">
                Manage Address
            </h3>
            <div class="space-y-4">
                <!-- Form row -->
                @if (isset($shipping))
                    <div class="grid sm:grid-cols-2 gap-4">
                        <!-- Single input -->
                        <div>
                            <label class="text-gray-600 mb-2 block">
                                Full Name
                            </label>
                            <input type="text" name="name" class="input-box" value="{{ $shipping->name }}" required>
                        </div>
                        <!-- single input end -->
                        <!-- single input -->
                        <div>
                            <label class="text-gray-600 mb-2 block">
                                Email Address
                            </label>
                            <input type="email" name="email" class="input-box" value="{{ $shipping->email }}"
                                required>
                        </div>
                        <!-- Single input end -->
                        <!-- single input -->
                        <div>
                            <label class="text-gray-600 mb-2 block">
                                Phone Number
                            </label>
                            <input type="phone" name="phone" class="input-box" value="{{ $shipping->phone }}"
                                required>
                        </div>
                        <!-- Single input end -->
                    </div>
                    <!-- Form row end -->
                    <div>
                        <label class="text-gray-600 mb-2 block">
                            Address
                        </label>
                        <input type="text" name="address" class="input-box" value="{{ $shipping->address }}"
                            required>
                    </div>
                @else
                    <div class="grid sm:grid-cols-2 gap-4">
                        <!-- Single input -->
                        <div>
                            <label class="text-gray-600 mb-2 block">
                                Full Name
                            </label>
                            <input type="text" name="name" class="input-box" required>
                        </div>
                        <!-- single input end -->
                        <!-- single input -->
                        <div>
                            <label class="text-gray-600 mb-2 block">
                                Email Address
                            </label>
                            <input type="email" name="email" class="input-box" required>
                        </div>
                        <!-- Single input end -->
                        <!-- single input -->
                        <div>
                            <label class="text-gray-600 mb-2 block">
                                Phone Number
                            </label>
                            <input type="phone" name="phone" class="input-box" required>
                        </div>
                        <!-- Single input end -->
                    </div>
                    <!-- Form row end -->
                    <div>
                        <label class="text-gray-600 mb-2 block">
                            Address
                        </label>
                        <input type="text" name="address" class="input-box" required>
                    </div>
                @endif
            </div>
            <div class="mt-6">
                <button type="submit"
                    class="px-6 py-2 text-center text-white bg-primary border border-primary rounded hover:bg-transparent hover:text-primary transition uppercase font-roboto font-medium">
                    Save change
                </button>
            </div>
        </form>
    </div>
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
@endsection
