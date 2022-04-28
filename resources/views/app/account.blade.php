@extends('app.layouts.layout_account')
@section('contents')
    <div class="col-span-9 grid md:grid-cols-2 gap-4 mt-6 lg:mt-0">
        <!-- single card -->
        <div class="shadow rounded bg-white px-4 pt-6 pb-8">
            <div class="flex justify-between items center mb-4">
                <h3 class="font-medium capitalize text-gray-800 text-lg">personal profile</h3>
                <a href="/accounts/profile" class="text-primary">Edit</a>
            </div>
            <div class="space-y-1">
                <h4 class="text-gray-700 font-medium">
                    {{ $user->name }}
                </h4>
                <p class="text-gray-800">
                    {{ $user->email }}
                </p>
            </div>
        </div>
        <!-- single card end -->
        <!-- single card -->
        @if (isset($shipping))
            <div class="shadow rounded bg-white px-4 pt-6 pb-8">
                <div class="flex justify-between items center mb-4">
                    <h3 class="font-medium capitalize text-gray-800 text-lg">Shipping Address</h3>
                    <a href="/accounts/manage-address" class="text-primary">Edit</a>
                </div>
                <div class="space-y-1">
                    <h4 class="text-gray-700 font-medium">{{ $shipping->name }}</h4>
                    <p class="text-gray-800">{{ $shipping->address }}</p>
                    <p class="text-gray-800">{{ $shipping->phone }}</p>
                </div>
            </div>
        @else
            <div class="shadow rounded bg-white px-4 pt-6 pb-8">
                <div class="flex justify-between items center mb-4">
                    <h3 class="font-medium capitalize text-gray-800 text-lg">Shipping Address</h3>
                    <a href="/accounts/manage-address" class="text-primary">Add</a>
                </div>
                <div class="space-y-1">
                    <h4 class="text-gray-700 font-medium">No Infomation</h4>
                    <p class="text-gray-800">No Infomation</p>
                    <p class="text-gray-800">No Infomation</p>
                </div>
            </div>
        @endif

        <!-- single card end -->
    </div>
    @if (Session::has('success'))
        <script>
            toastr.success('{{ Session::get('success') }}');
        </script>
    @endif
@endsection
