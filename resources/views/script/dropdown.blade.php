<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: '{{ route('jn') }}',
            cache: false,
            success: function(msg) {
                $("#jenjang").html(msg);
            }
        });

        $("#jenjang").change(function() {
            var jenjang_id = $("#jenjang").val();
            $.ajax({
                type: 'POST',
                url: '{{ route('l1n') }}',
                data: 'jenjang_id=' + jenjang_id,
                cache: false,
                success: function(msg) {
                    $("#l1").html(msg);
                }
            });
        });

        $("#l1").change(function() {
            var l1_id = $("#l1").val();
            $.ajax({
                type: 'POST',
                url: '{{ route('l2n') }}',
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
                url: '{{ route('l3n') }}',
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
                url: '{{ route('l4n') }}',
                data: 'l3_id=' + l3_id,
                cache: false,
                success: function(msg) {
                    $("#l4").html(msg);
                }
            });
        });



        //EDIT
        $.ajax({
            type: 'POST',
            url: '{{ route('jnu') }}',
            cache: false,
            success: function(msg) {
                $("#jenjangu").html(msg);
            }
        });

        $("#jenjangu").change(function() {
            var jenjang_id = $("#jenjangu").val();
            $.ajax({
                type: 'POST',
                url: '{{ route('l1nu') }}',
                data: 'jenjang_id=' + jenjang_id,
                cache: false,
                success: function(msg) {
                    $("#l1u").html(msg);
                }
            });
        });

        $("#l1u").change(function() {
            var l1_id = $("#l1u").val();
            $.ajax({
                type: 'POST',
                url: '{{ route('l2nu') }}',
                data: 'l1_id=' + l1_id,
                cache: false,
                success: function(msg) {
                    $("#l2u").html(msg);
                }
            });
        });

        $("#l2u").change(function() {
            var l2_id = $("#l2u").val();
            $.ajax({
                type: 'POST',
                url: '{{ route('l3nu') }}',
                data: 'l2_id=' + l2_id,
                cache: false,
                success: function(msg) {
                    $("#l3u").html(msg);
                }
            });
        });

        $("#l3u").change(function() {
            var l3_id = $("#l3u").val();
            $.ajax({
                type: 'POST',
                url: '{{ route('l4nu') }}',
                data: 'l3_id=' + l3_id,
                cache: false,
                success: function(msg) {
                    $("#l4u").html(msg);
                }
            });
        });

    });
</script>