<script type="text/javascript">
    function getSuggestion() {
        var user = {!! auth()->user() !!};
        $.ajax({
            url: "/api/show-suggestions/" + user.id,
            type: "GET",

            success: function(response) {
                $("#content").html(response)
            },
            error: function(error) {
                console.log(error);

            }
        });
    }

    function connect(secUser) {
        var user = {!! auth()->user() !!};
        $.ajax({
            url: "/api/connect/" + user.id + "/" + secUser,
            type: "GET",

            success: function(response) {
                getSuggestion()
            },
            error: function(error) {
                console.log(error);

            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        //sendRequest
        document.querySelector('#get_sent_requests_btn').addEventListener('click', function() {
            var user = {!! auth()->user() !!};
            $.ajax({
                url: "/api/send-requests/" + user.id,
                type: "GET",

                success: function(response) {
                    $("#content").html(response)

                },
                error: function(error) {
                    console.log(error);

                }
            });
        });

    });

    function Withdraw(secUser) {
        var user = {!! auth()->user() !!};
        $.ajax({
            url: "/api/withdraw/" + user.id + "/" + secUser,
            type: "GET",

            success: function(response) {
                var user = {!! auth()->user() !!};
                $.ajax({
                    url: "/api/send-requests/" + user.id,
                    type: "GET",

                    success: function(response) {
                        $("#content").html(response)

                    },
                    error: function(error) {
                        console.log(error);

                    }
                });


            },
            error: function(error) {
                console.log(error);

            }
        });
    }



    function received() {
        var user = {!! auth()->user() !!};
        $.ajax({
            url: "/api/received-requests/" + user.id,
            type: "GET",
            success: function(response) {
                $("#content").html(response)
                console.log(response);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }


    function accept(secUser) {
        var user = {!! auth()->user() !!};
        $.ajax({
            url: "/api/accept/" + user.id + "/" + secUser,
            type: "GET",
            success: function(response) {
                received()
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function connections() {
        var user = {!! auth()->user() !!};
        $.ajax({
            url: "/api/connections/" + user.id,
            type: "GET",
            success: function(response) {
                $("#content").html(response)
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function remove(secUser) {
        var user = {!! auth()->user() !!};
        $.ajax({
            url: "/api/remove/" + user.id + "/" + secUser,
            type: "GET",
            success: function(response) {
                connections()
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    //Commen Connections
    // $.ajax({
    //     url: "/api/common-connections/" + user.id +"/2",
    //     type: "GET",

    //     success: function(response) {
    //       console.log('Commen Connections');
    //         console.log(response);

    //     },
    //     error: function(error) {
    //         console.log(error);

    //     }
    // });
</script>
