@foreach ($products as $index => $item)
    <tr>
        <th style="padding-left: 1rem" scope="row">{{ $products->firstItem() + $index }}</th>
        <td style="padding-left: 0.3rem;padding-right: 0.3rem">{{ $item->title }}</td>
        <td>{{ $item->content }}</td>
        <td>{{ $item->price }}</td>
        <td><img class="table-image" src="{{ asset($item->file_path) }}" alt="">
        </td>
        <td>
            <a class="btn btn-success mt-1 btn-sm" href="{{ route('product.detail', ['id' => $item->id]) }}">
                <i class="fas fa-eye">
                </i>
            </a>
            <a class="btn btn-info mt-1 btn-sm" href="{{ route('product.edit', ['id' => $item->id]) }}">
                <i class="fas fa-pencil-alt">
                </i>
            </a>
            <button id="deleteProduct" type="button" data-url="{{ route('product.delete', ['id' => $item->id]) }}"
                class="btn btn-danger my-1 btn-sm">
                <i class="fas fa-trash">
                </i>
            </button>
        </td>
    </tr>
@endforeach
