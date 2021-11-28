@foreach ($users as $index => $item)
    <tr>
        <th scope="row">{{ $users->firstItem() + $index }}</th>
        <td style="padding-left: 0.5rem">{{ $item->name }}</td>
        <td>Otto</td>
        <td>Otto</td>
        <td>Otto</td>
        <td>
            <a href="{{ route('user.dashboard.views', ['id' => $item->id]) }}" class="btn btn-success btn-sm m-1">
                <i class="fas fa-eye"></i>
            </a>
            <button type="button" class="btn btn-danger btn-sm m-1">
                <i class="fas fa-trash-alt"></i>
            </button>
        </td>
    </tr>
@endforeach
