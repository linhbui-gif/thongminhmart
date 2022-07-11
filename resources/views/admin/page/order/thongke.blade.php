@extends("admin.layout")


@section('content-header')
    <section class="content-header">
        <h1>

        </h1>
    </section>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Thống kê đơn hàng doanh số</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Từ ngày</label>
                                <input name="from_date" class="form-control bs_datepicker" type="text">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Đến ngày</label>
                                <input name="to_date" class="form-control bs_datepicker" type="text">
                            </div>
                        </div>
                        <div class="col-md-3 btn_fillter_static">
                            <button type="button" class="btn btn-info btn-fillter-date">Lọc kết quả</button>
                        </div>
                    </div>
                    @include("admin.template.error")
                    @include("admin.template.notify")
                    <div class="row">
                        <div class="col-md-12">
                            <div id="myfirstchart" style="height: 250px;"></div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="el-form-item">
                            <div class="el-form-item__content">
                                <a href="{{ route('admin.' . $controllerName . ".index") }}" class="el-button el-button--default"><span>Back </span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script>
        var char =  new Morris.Bar({
            // ID of the element in which to draw the chart.
            element: 'myfirstchart',
            // Chart data records -- each entry in this array corresponds to a point on
            // the chart.
            // The name of the data record attribute that contains x-values.
            xkey: 'period',
            // A list of names of data record attributes that contain y-values.
            ykeys: ['sales'],
            // Labels for the ykeys -- will be displayed when you hover over the
            // chart.
            labels: ['Doanh thu']
        });
        // new Morris.Bar({
        //     // ID of the element in which to draw the chart.
        //     element: 'myfirstchart',
        //     // Chart data records -- each entry in this array corresponds to a point on
        //     // the chart.
        //     data: [
        //         { period: '2008', value: 20 },
        //         { year: '2009', value: 10 },
        //         { year: '2010', value: 5 },
        //         { year: '2011', value: 5 },
        //         { year: '2012', value: 20 }
        //     ],
        //     // The name of the data record attribute that contains x-values.
        //     xkey: 'period',
        //     // A list of names of data record attributes that contain y-values.
        //     ykeys: ['value'],
        //     // Labels for the ykeys -- will be displayed when you hover over the
        //     // chart.
        //     labels: ['Value']
        // });
        $(".btn-fillter-date").click(function(){
            var from_date = $("input[name='from_date']").val()
            var to_date = $("input[name='to_date']").val();
            $.ajax({
                url : "{{ route('admin.order.getDataStatistic') }}",
                data : { "from_date" : from_date, "to_date" : to_date },
                method : 'GET',
                dataType: "json", //parse the response data as JSON automatically
                success: function(data) {
                    char.setData(data);
                }
            });
        });
        $( document ).ready(function() {
            $.ajax({
                url : "{{ route('admin.order.getDataStatistic') }}",
                method : 'GET',
                dataType: "json", //parse the response data as JSON automatically
                success: function(data) {
                    char.setData(data);
                }
            });
        });

    </script>
    <script>

        $.fn.datepicker.dates['en'] = {
            days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
            daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
            daysMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
            months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            today: "Today",
            clear: "Clear",
            format: "mm/dd/yyyy",
            titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
            weekStart: 0
        };
        $.fn.datepicker.dates['vi'] = {
            days: ["Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ 7"],
            daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
            daysMin: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
            months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            today: "Today",
            clear: "Clear",
            format: "dd/mm/yyyy",
            titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
            weekStart: 0
        };

    </script>
    <script>
        $('.bs_datepicker').datepicker({
            language : 'vi'
        });
    </script>
@stop
