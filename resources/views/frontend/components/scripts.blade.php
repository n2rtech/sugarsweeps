<script>
    function populateUsername(sel) {
        var platform_id = sel.value;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: "{{ route('populate') }}",
            data: {
                platform_id: platform_id
            },
            success: function(data) {
                $('#bitcoin_username').val(data.success);
            }
        });


    }
</script>
    <script>
        function populateRedeemUsername(sel) {
            var platform_id = sel.value;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: "{{ route('populate') }}",
                data: {
                    platform_id: platform_id
                },
                success: function(data) {
                    $('#redeem_username').val(data.success);
                }
            });


        }
    </script>
