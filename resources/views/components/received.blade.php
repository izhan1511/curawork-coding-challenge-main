<table style="width:100%">
    @foreach ($data as $item)
        <tr>
            <td>{{ $item->firstUser->name }} - {{ $item->firstUser->email }}</td>
            <td class="d-flex justify-content-end">
                <button id="cancel_request_btn_" class="btn btn-primary me-1"
                    onclick="accept('{{ $item->firstUser->id }}')">Accept</button>
            </td>
        </tr>
    @endforeach
</table>
