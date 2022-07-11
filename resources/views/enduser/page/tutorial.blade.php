@extends("enduser.layout")

@section('content')

    @include("enduser.partials.breadcrumb",[ 'mainpage' => "Trang chủ",'name' =>'Hướng dẫn'])

   <div class="user-layout">
       <div class="container">

           <div class="user-layout-wrapper">
               <!-- Modal -->

               <div class="tab-wrapper">
                   <div class="tabs-group d-flex">
                       <a href="#thongbao" class="tab-item ">Thông báo</a>
                       <a href="#sukien" class="tab-item">Sự kiện</a>
                       <a href="#cauhoithuonggap" class="tab-item">Câu hỏi thường gặp</a>
                       <a href="#thacmac" class="tab-item">Thắc mắc</a>
                   </div>
                   <div class="tabs-main-group">
                       <div class="tab-item tab-content">
                           @php
                               $notification = \App\Notification::where('status','active')->get();
                           @endphp
                           <div class="user-layout-table">
                               @if($notification->count()>0)
                               <table>
                                   <thead>
                                   <tr>
                                       <td class="col-center col-min-width">STT</td>
                                       <td class="course-content">Tiêu đề</td>
                                       <td class="">Ngày</td>
                                   </tr>
                                   </thead>
                                   <tbody>
                                   @foreach($notification as $k => $e)
                                       <tr>
                                           <td class="col-center col-min-width">{{$k+1}}</td>
                                           <td class="course-content"><a href="{{route('page.showNotice',['id'=>$e->id])}}">{{$e->name}}</a></td>

                                           <td class="tags">{{ $e->date_notification }}</td>
                                       </tr>
                                   @endforeach
                                   </tbody>
                               </table>
                               @else
                               <div class="table-placeholder d-flex align-items-center justify-content-center flex-column"> <img src="{{asset("enduser/assets/icons/icon-folder.svg")}}" alt="">Hiện bạn không có thông báo</div>
                           @endif
                           </div>
                           <div class="pagination-wrapper d-flex justify-content-center align-items-center flex-wrap">
{{--                               <div class="pagination-item arrow-left">&lt;</div>--}}
{{--                               <div class="pagination-item active">1</div>--}}
{{--                               <div class="pagination-item">2</div>--}}
{{--                               <div class="pagination-item">3</div>--}}
{{--                               <div class="pagination-item arrow-right">&gt;</div>--}}

                           </div>
                       </div>
                       <div class="tab-item tab-content">
                           <div class="user-layout-table">
                               <table>
                                   <thead>
                                   <tr>
                                       <td class="col-center col-min-width">STT</td>
                                       <td class="course-content">Tiêu đề</td>
                                       <td class="col-center">Trạng thái</td>
                                   </tr>
                                   </thead>
                                   <tbody>
                                   @php
                                   $events = \App\Event::where('status','active')->latest()->paginate(10);
                                   @endphp
                                   @foreach($events as $k => $e)
                                   <tr>
                                       <td class="col-center col-min-width">{{$k+1}}</td>
                                       <td class="course-content"><a href="{{route('page.showEvent',['id'=>$e->id])}}">{{$e->name}}</a></td>

                                       <td class="tags">
                                           <div class="tag-group d-flex flex-wrap justify-content-center">
                                               <div class="tag-item {{(date("oW", strtotime($e->start_time)) - date("oW", strtotime($e->end_time))) == 0 ? "unactive" : "active"}} ">{{(date("oW", strtotime($e->start_time)) - date("oW", strtotime($e->end_time))) == 0 ? "Hết hạn" : "Tiến hành"}}</div>
                                           </div>
                                       </td>
                                   </tr>
                                   @endforeach
                                   </tbody>
                               </table>
                           </div>
                           <div class="pagination-wrapper d-flex justify-content-center align-items-center flex-wrap">
{{--                               <div class="pagination-item arrow-left">&lt;</div>--}}
{{--                               <div class="pagination-item active">1</div>--}}
{{--                               <div class="pagination-item">2</div>--}}
{{--                               <div class="pagination-item">3</div>--}}
{{--                               <div class="pagination-item arrow-right">&gt;</div>--}}
                               {{$events->links()}}
                           </div>
                       </div>
                       <div class="tab-item tab-content">
                           <div class="usually-question-wrapper">
                               @php
                               $question = \App\QA_Question::where('status','active')->where('thuonggap', 'yes')->get();
                               @endphp
{{--                               <h3 class="usually-question-title">Basic Questions</h3>--}}
                               @foreach($question as $q)
                               <div class="queston-item expand-click">
                                   <div class="question-quiz d-flex align-items-center justify-content-between">
                                       <div class="d-flex align-items-center"><img class="icon-image " src="{{asset("enduser/assets/icons/icon-question.svg")}}" alt="">
                                           <p>{{$q->name}}</p>
                                       </div>
                                       <img class="icon-angle " src="{{asset("enduser/assets/icons/icon-angle-right.svg")}}" alt="">
                                   </div>
                                   <div class="question-content expand-target">
                                       <p>{{ $q->answer }}</p>
                                   </div>
                               </div>
                              @endforeach
                           </div>
                       </div>
                       <div class="tab-item tab-content">
                           <div class="table-header-action row">
                               <div class="col-lg-4"></div>
                               <div class="col-lg-4"></div>
                               <div class="col-lg-4">
                                   <div class="action-item d-flex align-items-center search">
                                       <input type="text" placeholder="Tìm kiếm câu hỏi ID, Title">
                                       <button><img  src="{{asset('enduser/assets/icons/icon-search-white.svg')}}" alt=""></button>
                                   </div>
                               </div>
                           </div>
                           <div class="user-layout-table">
                               <table>
                                   <thead>
                                   <tr>
                                       <td class="col-center col-min-width">STT</td>
                                       <td class="course-content">Nội dung</td>
                                       <td class="col-center nowrap">Người đặt câu hỏi</td>
                                       <td class="col-center">Ngày</td>
                                   </tr>
                                   </thead>
                                   <tbody>
                                   @php
                                       $questionClient = \App\QA_Question::where('hidden','0')->where('status','active')->where('thuonggap','!=', 'yes')->orderBy('id','desc')->get();
                                   @endphp
                                   @foreach($questionClient as $que)
                                   <tr>
                                       <td class="col-center col-min-width">{{$que->id}}</td>
                                       <td class="course-content"><a href="#" style="color: #6a3073;
    white-space: normal;
    word-break: break-word;
    height: 20px;
    line-height: 20px;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    display: -moz-box;
    display: box;
    -webkit-line-clamp: 1;
    -moz-line-clamp: 2;
    -line-clamp: 2;
    -webkit-box-orient: vertical;
    cursor: pointer;" data-toggle="modal" data-target="#modalQuestion{{$que->id}}">{{$que->name}}</a></td>
                                        @php
                                            $user_hoi = \App\User::find($que->users_id);
                                        @endphp
                                       <td class="col-center nowrap">{{ isset($user_hoi) ? $user_hoi->fullName() : "Chưa rõ" }}</td>
                                       <td class="col-center nowrap">{{$que->created_at}}</td>
                                   </tr>
                                   <div class="modal fade" id="modalQuestion{{$que->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                       <div class="modal-dialog" role="document">
                                           <div class="modal-content">
                                               <div class="modal-header ">
                                                   <h5 class="modal-title" id="exampleModalLongTitle">Chỉnh sửa</h5>
                                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                       <span aria-hidden="true">&times;</span>
                                                   </button>
                                               </div>
                                               <div class="modal-body">

                                                   <form class="user-quick-question authen-form" action="{{route('page.updatequestionClient',['id'=>$que->id])}}" method="post">
                                                       @csrf
                                                       <div class="form-group">
                                                           <div class="form-item">
                                                               <textarea name="name" placeholder="Sửa câu hỏi của bạn.." style="    padding: 15px;
    border: 1px solid #ddd;
    min-height: 120px;
    width: 100%;
    border-radius: 4px;">{{$que->name}}</textarea>
                                                           </div>
                                                       </div>

                                                       <div class="form-group">
                                                           @if(Auth::check())
                                                               <div class="form-item button-checkout">
                                                                   <button class="btn primary" type="submit">Gửi</button>
                                                               </div>
                                                           @else
                                                               <button class="btn primary" type="button"><a style="color: white" href="{{route('user.login')}}">Đăng nhập để sửa</a> </button>
                                                           @endif

                                                       </div>

                                                   </form>
                                               </div>

                                           </div>
                                       </div>
                                   </div>
                                   @endforeach
                                   </tbody>
                               </table>
                           </div>
{{--                           <div class="pagination-wrapper d-flex justify-content-center align-items-center flex-wrap">--}}
{{--                               <div class="pagination-item arrow-left">&lt;</div>--}}
{{--                               <div class="pagination-item active">1</div>--}}
{{--                               <div class="pagination-item">2</div>--}}
{{--                               <div class="pagination-item">3</div>--}}
{{--                               <div class="pagination-item arrow-right">&gt;</div>--}}
{{--                           </div>--}}

                           <h3 class="layout-title">Hãy để lại câu hỏi của bạn</h3>
                           <form class="user-quick-question authen-form" action="{{route('page.questionClient')}}" method="post">
                               @csrf
                               <div class="form-group">
                                   <div class="form-item">
                                       <textarea name="name" placeholder="Để lại câu hỏi của bạn tại đây"></textarea>
                                   </div>
                               </div>
                               <div class="form-group">
                                   <div class="form-item checkbox">
                                       <input type="checkbox" name="hide" value="1" id="hide-question">
                                       <label for="hide-question">Ẩn câu hỏi ?</label>
                                   </div>
                               </div>
                               <div class="form-group">
                                   <div class="form-item button-checkout">
                                       @if(Auth::check())
                                           <button class="btn primary" type="submit">Gửi</button>
                                           @else
                                           <button class="btn primary" type="button"><a style="color: white" href="{{route('user.login')}}">Đăng nhập để gửi thắc mắc</a> </button>
                                       @endif

                                   </div>
                               </div>

                           </form>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>


@stop
<script src="{{ asset('enduser/assets/js/custom.js') }}" ></script>
