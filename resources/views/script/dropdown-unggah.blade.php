<script>
    $(document).ready(function() {
        $('#l1').select2();
        $('#l2').select2();
        $('#l3').select2();
        $('#l4').select2();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: '{{ route('l1') }}',
            cache: false,
            success: function(msg) {
                $("#l1").html(msg);
            }
        });

        $("#l1").change(function() {
            var l1_id = $("#l1").val();
            $.ajax({
                type: 'POST',
                url: '{{ route('l2') }}',
                data: 'l1_id=' + l1_id,
                cache: false,
                success: function(msg) {
                    $("#l2").html(msg);
                }
            });
        });

        $("#l2").change(function() {
            var l2_id = $("#l2").val();
            $.ajax({
                type: 'POST',
                url: '{{ route('l3') }}',
                data: 'l2_id=' + l2_id,
                cache: false,
                success: function(msg) {
                    $("#l3").html(msg);
                }
            });
        });

        $("#l3").change(function() {
            var l3_id = $("#l3").val();
            $.ajax({
                type: 'POST',
                url: '{{ route('l4') }}',
                data: 'l3_id=' + l3_id,
                cache: false,
                success: function(msg) {
                    $("#l4").html(msg);
                }
            });
        });

    });
</script>
