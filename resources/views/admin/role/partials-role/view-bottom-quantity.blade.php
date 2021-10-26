<div class="col-12">
    <div class=" float-left card px-4 py-2 ">
        @if ($roles->total() == 0)
            Danh sách trống
        @else
            Hiển thị
            {{ $roles->firstItem() }}
            đến
            {{ $roles->lastItem() }}
            có tất cả
            {{ $roles->total() }}
        @endif
    </div>
    <div class=" float-right">
        {{ $roles->onEachSide(1)->links() }}
    </div>
</div>
