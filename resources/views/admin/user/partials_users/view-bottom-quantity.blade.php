<div class="col-12">
    <div class=" float-left card px-4 py-2 ">
        @if ($users->total() == 0)
            Danh sách trống
        @else
            Hiển thị
            {{ $users->firstItem() }}
            đến
            {{ $users->lastItem() }}
            có tất cả
            {{ $users->total() }}
            người dùng
        @endif
    </div>
    <div class=" float-right">
        {{ $users->onEachSide(1)->links() }}
    </div>
</div>
