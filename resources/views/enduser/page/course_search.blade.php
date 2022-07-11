@extends("enduser.layout")

@section('content')

   @include("enduser.partials.breadcrumb")
   @include("enduser.components.banner_course")

   <section class="section section-product">
       <div class="container">
           <div class="section-header d-flex align-items-center justify-content-between">
               <h2 class="d-flex align-items-center"> <img src="{{ asset('enduser/assets/icons/icon-book.svg') }}" alt="">Kết quả tìm kiếm cho: {{ @$key_word }}
               </h2>
               <div class="sort-group d-flex align-items-center">
                   <form id="fillter" class="sort-group d-flex align-items-center" action="{{ route('course.search') }}">
                       @php
                            $select_status = Form::select('sort', ['0' => 'Mặc định', 'name-ASC' => 'A - Z', 'name-DESC' => 'Z - A', 'price_final-DESC' => 'Cao nhất', 'price_final-ASC' => 'Thấp nhất'], @$sort_by, ['class' => 'custom-select', "id" => "sort", "style" => "min-width: 120px", "onchange" => "sortChange()"]);
                            $data = [];
                            $data[0] = "Chọn danh mục";
                            foreach ($course_category as $key => $value){
                                $data[$value->id] = $value->name;
                            }
                            $select_category = Form::select('category', $data, @$category_id, ['class' => 'custom-select', "id" => "category", "onchange" => "categoryChange()"]);
                       @endphp
                       <label>Sort by</label>
                       {!! $select_status !!}
                       {!! $select_category !!}
                       <input name="key_word" type="hidden" value="{{ @$key_word }}">
                   </form>

               </div>
           </div>
           <div class="section-main">
               <div class="row">

                   @if(count($courses) > 0)
                       @foreach($courses as $k => $course)
                           @include("enduser.partials.item_loop_course", [ 'item' => $course,'class' => 'col-product' ])
                       @endforeach
                   @else
                       <p>Không tìm thấy kết quả</p>
                   @endif

               </div>
           </div>
       </div>
   </section>
   <div  class="pagination-wrapper d-flex justify-content-center align-items-center flex-wrap pagination">
       {!! count($courses) > 0 ? @$courses->links() : "" !!}
   </div>
{{--   <div class="pagination-wrapper d-flex justify-content-center align-items-center flex-wrap">--}}
{{--       <div class="pagination-item arrow-left">&lt;</div>--}}
{{--       <div class="pagination-item active">1</div>--}}
{{--       <div class="pagination-item">2</div>--}}
{{--       <div class="pagination-item">3</div>--}}
{{--       <div class="pagination-item arrow-right">&gt;</div>--}}
{{--   </div>--}}

@stop
@section('script')
    <script>
        $(document).ready(function(){
            $("#sort").change(function(){
                $("#fillter").submit();
            })
            $("#category").change(function(){
                $("#fillter").submit();
            })
        })
    </script>
@stop