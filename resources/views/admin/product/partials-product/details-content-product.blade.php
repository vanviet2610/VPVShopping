<h4 id="msgapproved" class="mb-0 text-gray">
    @if ($products->status == 0)
        Waiting for approval
    @else
        Approved
    @endif
</h4>
@if ($products->status == 1)
@else
    <button id="approved" data-id="{{ $products->id }}" data-url="{{ route('product.approved') }}"
        class="btn btn-warning">Accept
        Post</button>
@endif
