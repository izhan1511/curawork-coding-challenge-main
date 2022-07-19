<table style="width:100%">
    @foreach ($data as $item)
        <tr>
            <td>{{ $item->user->name }} - {{ $item->user->email }}</td>
            <td class="d-flex justify-content-end">
                <button id="cancel_request_btn_" class="btn btn-danger me-1" onclick="Withdraw('{{ $item->user->id }}')" >Withdraw
                    Request</button>
            </td>
        </tr>
    @endforeach
</table>