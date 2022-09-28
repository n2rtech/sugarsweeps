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
<script>
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {

        var platform_id = $('#platform').val();

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

        var redeem_platform_id = $('#redeem_platform').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: "{{ route('populate') }}",
            data: {
                platform_id: redeem_platform_id
            },
            success: function(data) {
                $('#redeem_username').val(data.success);
            }
        });

        showPaymentOptions();

    });
</script>
<script>
    function showPaymentOptions() {
        var value = $('#payment_method').val();

        switch (value) {
            case '1':
                $('.bitcoin_address').show();
                $('.cashtag').hide();
                break;
            case '2':
                $('.bitcoin_address').hide();
                $('.cashtag').show();
                break;
            default:
                $('.cashtag').hide();
                $('.bitcoin_address').hide();
                break;
        }

    }
</script>
