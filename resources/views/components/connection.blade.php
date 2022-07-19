
<table style="width:100%">
    @foreach ($data as $item)
        <tr>
            @if ($item->firstUser->id != $user_id)
                <td>{{ $item->firstUser->name }} - {{ $item->firstUser->email }}</td>
                <td class="d-flex justify-content-end" id="td_get_connections_in_common_{{ $item->firstUser->id }}">
                    <button style="width: 220px" id="get_connections_in_common_" class="btn btn-primary" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapse_" aria-expanded="false"
                        aria-controls="collapseExample"
                        onclick="commonConnection('{{ $item->firstUser->id }}', {{ $user_id }})">
                        Connections in common ()
                    </button>
                    <button id="create_request_btn_" class="btn btn-danger me-1"
                        onclick="remove('{{ $item->firstUser->id }}')">Remove Connection</button>
                </td>
            @else
                <td>{{ $item->user->name }} - {{ $item->user->email }}</td>
                <td class="d-flex justify-content-end" id="td_get_connections_in_common_{{ $item->user->id }}">
                    <button style="width: 220px" id="get_connections_in_common_" class="btn btn-primary" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapse_" aria-expanded="false"
                        aria-controls="collapseExample"
                        onclick="commonConnection('{{ $item->user->id }}', {{ $user_id }})">
                        Connections in common ()
                    </button>
                    <button id="create_request_btn_" class="btn btn-danger me-1"
                        onclick="remove('{{ $item->user->id }}')">Remove Connection</button>
                      </td>
            @endif
        </tr>
        <tr id="content_common" class="p-2 d-grid">
         
        </tr>
    @endforeach
</table>
<script>
    function commonConnection(secUser, user_id) {
      if (document.querySelector('.common_content') && document.querySelector('.common_content').innerHTML != '') {
        document.querySelector('.common_content').innerHTML = '';
      }
      var commonContent = document.querySelector('.common_content');
        $.ajax({
            url: "/api/common-connections/" + user_id + "/" + secUser,
            type: "GET",

            success: function(response) {
                var inner_content = document.createElement("tr");
                inner_content.innerHTML=response;
                document.getElementById('td_get_connections_in_common_'+secUser).closest("tr").after(inner_content);
                // $("#content_common").html(response)

            },
            error: function(error) {
                console.log(error);

            }
        });
    }
</script>
