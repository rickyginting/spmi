@extends('template.BaseView')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Cari Berkas</h4>
                    <form action="/berkas/hasil" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Jenjang</label>
                            <select class="form-control" name="jenjang_id" id="jen" required>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Prodi</label>
                            <select class="form-control" name="prodi_id" id="pro" required>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Level 1</label>
                            <select class="form-control" name="l1_id[]" id="l1" multiple="multiple">
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Level 2</label>
                            <select class="form-control" name="l2_id[]" id="l2" multiple="multiple">
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Level 3</label>
                            <select class="form-control" name="l3_id[]" id="l3" multiple="multiple">
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Level 4</label>
                            <select class="form-control" name="l4_id[]" id="l4" multiple="multiple">
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn-primary btn-sm" type="submit">Cari Document</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            CKEDITOR.replace('dec');
            CKEDITOR.replace('name');
            $('#jen').select2();
            $('#pro').select2();
            $('#l1').select2();
            $('#l2').select2();
            $('#l3').select2();
            $('#l4').select2();
            $('#ind').select2();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: '{{ route('getJen') }}',
                cache: false,
                success: function(msg) {
                    $("#jen").html(msg);
                }
            });

            $("#jen").change(function() {
                var jenjang_id = $("#jen").val();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('getPro') }}',
                    data: 'jenjang_id=' + jenjang_id,
                    cache: false,
                    success: function(msg) {
                        $("#pro").html(msg);
                    }
                });
            });

            $("#pro").change(function() {
                var jenjang_id = $("#jen").val();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('l1') }}',
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

            $("#jen").change(function() {
                var jenjang_id = $("#jen").val();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('getInd') }}',
                    data: 'jenjang_id=' + jenjang_id,
                    cache: false,
                    success: function(msg) {
                        $("#ind").html(msg);
                    }
                });
            });

            // $("#ind").change(function() {
            //     var ind_id = $("#ind").val();
            //     $.ajax({
            //         type: 'POST',
            //         url: '{{ route('getScore') }}',
            //         data: 'ind_id=' + ind_id,
            //         cache: false,
            //         success: function(msg) {
            //             $("#score").html(msg);
            //         }
            //     })
            // });
        });
    </script>
@endsection
