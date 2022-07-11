@extends("admin.layout")


@section('content-header')
    @include("admin.partials.page-header")
@stop

@section('content')
    <div class="container">
        <div class="row">

            <form action="{{ route('admin.logs.checkLogs') }}" method="post"></form>

            <div class="col-lg">
                @if (isset($logs))
                    <select name="type" id="typeLogs" class="form-control">
                        <option value="default">-- Select type logs --</option>
                        @foreach ($logs as $key => $item)

                            <option>{{ $key }}</option>

                        @endforeach
                    </select>
                @endif
            </div>

            <div class="col-lg">
                <select name="date" id="dateLogs" class="form-control">
                    <option value="default">-- Select date --</option>
                </select>
            </div>

            <br>

            <div>
                <ul class="list-group" id="dataLogs">
                    
                </ul>
            </div>

            </form>

        </div>
    </div>
@stop

@section('script')

    <script>
        $("#typeLogs").change(function() {
            var folder = $(this).val();
            $.ajax({
                url: "{{ route('checkLogs') }}",
                data: {
                    "folder": folder
                },
                dataType: "json",
                method: "GET",
                success: function(res) {
                    if (res.status == "success") {
                        let data = res.data
                        $('#dateLogs').empty();
                        $('#dataLogs').empty();

                        $('#dateLogs').append('<option value="default">-- Select date --</option>')

                        data.map(d => {

                            option = `
                                <option value="${d}">${d}</option>
                            `
                            $('#dateLogs').append(option)

                        })
                    }
                },
                error: function() {
                    
                }
            })
        });

        $("#dateLogs").change(function() {
            var dateLogs = $(this).val();
            var folder = $('#typeLogs').val();

            $.ajax({
                url: "{{ route('checkLogs') }}",
                data: {
                    "dateLogs": dateLogs,
                    "folder": folder
                },
                dataType: "json",
                method: "GET",
                success: function(res) {
                    // console.log(res)
                    if (res.status == "success") {
                        let data = res.data
                        // console.log(data) dataLogs
                        $('#dataLogs').empty();
                        data.map(d => {
                            log = `
                                <li class="list-group-item">${d}</li>
                            `;

                            $('#dataLogs').append(log)
                        })
                        
                    }
                },
                error: function() {
                    
                }
            })
        });
    </script>

@stop
