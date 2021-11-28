<div class="col-12">
    <div class="float-left">
        {{ $products->links('vendor.pagination.bootstrap-4') }}
    </div>
    <div class="card px-4 py-2 float-right">
        @if ($products->total() == 0)
            Danh sách trống
        @else
            Hiển thị
            {{ $products->firstItem() }}
            đến
            {{ $products->lastItem() }}
            có tất cả
            {{ $products->total() }}
            người dùng
        @endif
    </div>

</div>
