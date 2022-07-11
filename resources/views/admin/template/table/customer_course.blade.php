@php
    $course = [];
   $user = \Auth::user();
   if($user->is_giangvien() ){
       $course = $item->courses()->where('course_courses.teacher_id', $user->id)->get();

   }elseif($user->is_admin() ){
       $course = $item->courses;
   }

@endphp
<td>
    @if($course && count($course) > 0)
        <a href="{{ route('admin.customer.list_course', [ 'id_customer' => $item->id ]) }}" target="_blank">{{ count($course) }} khóa học</a>
    @else
        0 khóa học
    @endif

</td>

