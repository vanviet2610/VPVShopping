@foreach ($roles as $key => $item)
    <tr>
        <th scope="row">{{ $roles->firstItem() + $key }}</th>
        <td>{{ $item->name }}</td>
        <td>{{ $item->display_name }}</td>
        <td class="project-actions ">
            <button type="button" id="btnrestore" data-url="{{ route('role.restore', ['id' => $item->id]) }}"
                class="btn btn-info btn-sm">
                <i class="fas fa-trash-restore">
                </i>
            </button>
            <button type="button" data-url="{{ route('role.destroy', ['id' => $item->id]) }}"
                class="btn btn-danger btn-sm " id="destroy" type="submit">
                <i class="fas fa-trash">
                </i>

            </button>
        </td>
    </tr>
@endforeach
