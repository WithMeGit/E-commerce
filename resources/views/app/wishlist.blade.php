@extends('app.layouts.layout_account')
@section('contents')
    <div class="col-span-9 mt-6 lg:mt-0 space-y-4">
        @foreach ($wishlists as $key => $wishlist)
            <!-- single wishlist -->
            <div
                class="flex items-center md:justify-between gap-4 md:gap-6 p-4 border border-gray-200 rounded flex-wrap md:flex-nowrap">
                <!-- cart image -->
                <div class="w-28 flex-shrink-0">
                    <img src="{{ $wishlist->imageProduct }}" class="w-full">
                </div>
                <!-- cart image end -->
                <!-- cart content -->
                <div class="md:w-1/3 w-full">
                    <h2 class="text-gray-800 mb-1 xl:text-xl textl-lg font-medium uppercase">
                        {{ $wishlist->nameProduct }}
                    </h2>
                    <p class="text-gray-500 text-sm">Availability:
                        @if ($wishlist->quantityProduct <= 0)
                            <span class="text-red-600">Out of Stock</span>
                        @else
                            <span class="text-green-600">In Stock</span>
                        @endif
                    </p>
                </div>
                <!-- cart content end -->
                <div class="">
                    <p class="text-primary text-lg font-semibold">{{ $wishlist->priceProduct }} VNĐ</p>
                </div>
                @if ($wishlist->quantityProduct <= 0)
                    <a
                        class="ml-auto md:ml-0 block px-6 py-2 text-center text-sm text-white bg-primary border border-primary rounded
                            uppercase font-roboto font-medium cursor-not-allowed bg-opacity-80">
                        Add to cart
                    </a>
                @else
                    <form action="/carts" method="post">
                        @csrf()
                        <input type="hidden" name="product_id" value="{{ $wishlist->idProduct }}">
                        <input type="hidden" name="check_wishlist" value="1">
                        <input type="hidden" name="wishlist_id" value="{{ $wishlist->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <input type="hidden" name="size" value="40">
                        <input type="hidden" name="color" value="white">
                        <button type="submit"
                            class="ml-auto md:ml-0 block px-6 py-2 text-center text-sm text-white bg-primary border border-primary rounded hover:bg-transparent hover:text-primary transition uppercase font-roboto font-medium">
                            Add to cart
                        </button>
                    </form>
                @endif
                <div class="text-gray-600 hover:text-primary cursor-pointer">
                    <form action="/wishlist/{{ $wishlist->id }}" method="post">
                        @csrf()
                        @method('DELETE')
                        <button type="submit"><i class="fas fa-trash"></i></button>
                    </form>
                </div>
            </div>
            <!-- single wishlist end -->
        @endforeach
    </div>
@endsection
