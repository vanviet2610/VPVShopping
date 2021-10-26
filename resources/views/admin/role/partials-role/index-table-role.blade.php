@foreach ($roles as $key => $item)
    <tr>
        <th scope="row">{{ $roles->firstItem() + $key }}</th>
        <td>{{ $item->name }}</td>
        <td>{{ $item->display_name }}</td>
        <td class="project-actions ">
            <a class="btn btn-info btn-sm" href="{{ route('role.edit', ['id' => $item->id]) }}">
                <i class="fas fa-pencil-alt">
                </i>
            </a>
            <button class="btn btn-danger btn-sm deleteRole" data-url="{{ route('role.delete', ['id' => $item->id]) }}"
                type="button">
                <i class="fas fa-trash">
                </i>
            </button>
        </td>
    </tr>
@endforeach
