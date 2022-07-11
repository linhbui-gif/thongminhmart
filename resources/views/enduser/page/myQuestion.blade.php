@extends("enduser.layout")

@section('content')

    @include("enduser.partials.breadcrumb", [ 'mainpage' => "Trang chủ",'name' => 'Câu hỏi của tôi' ])


    <div class="user-layout">
       <div class="container">
           <div class="user-layout-wrapper">
               <div class="row">
                   <div class="col-lg-3">
                       @include("enduser.components.account.sidebar")
                   </div>
                   <div class="col-lg-9">
                       <div class="user-layout-main">
                           <h3 class="layout-title">Câu hỏi của tôi</h3>
                           <div class="user-layout-table">
                               @if(count($questions) > 0)
                               <table class="my-course-table">
                                   <thead>
                                   <tr>
                                       <td>Thời gian</td>
                                       <td class="course-content">Câu hỏi của tôi</td>
                                       <td class="course-content">Trả lời</td>
                                   </tr>
                                   </thead>
                                   <tbody>
                                   @foreach($questions as $k => $question)
                                   <tr>
                                       <td>{{ $question->created_at->format("d/m/Y") }}</td>
                                       <td class="course-content">{{ $question->name }}</td>
                                       <td class="course-content">
                                           @if(empty($question->answer))
                                           <span class="badge badge-danger">Chưa trả lời</span>
                                           @else
                                               {{ $question->answer }}
                                           @endif

                                       </td>
                                   </tr>
                                   @endforeach
                                   </tbody>
                               </table>
                               @endif
                           </div>

                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
@stop

@section('script')
    <script type="text/javascript">
        $(function() {
            $( ".datepicker" ).datepicker( $.datepicker.regional[ "vi" ] );
        });
    </script>
@endsection
