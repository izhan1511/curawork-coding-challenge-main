    <table style="width:100%">
        @foreach ($data as $item)
            <tr>
                <td>{{ $item->name }} - {{ $item->email }}</td>
                <td class="d-flex justify-content-end">
                    <button id="create_request_btn_" class="btn btn-primary me-1"
                        onclick="connect('{{ $item->id }}')">Connect</button>
                </td>
            </tr>
        @endforeach
    </table>
