@extends("enduser.layout")

@section('content')

   @include("enduser.partials.breadcrumb")

   <div class="user-layout">
       <div class="container">
           <div class="user-layout-wrapper">
               <div class="row">
                   <div class="col-lg-3">
                       <div class="user-sidebar-component">
                           <div class="user-avatar"> <img src="./assets/images/image-avatar-placeholder.webp" alt="">
                               <div class="avatar-upload">
                                   <input type="file"><img src="./assets/icons/icon-image-white.svg" alt="">
                               </div>
                           </div>
                           <div class="user-name">Hello World </div>
                           <div class="user-sidebar-list"> <a class="list-item d-flex align-items-center justify-content-between" href="#"> <span>Thông tin</span><img src="./assets/icons/icon-information.svg" alt=""></a><a class="list-item d-flex align-items-center justify-content-between" href="#"> <span>Mã</span><img src="./assets/icons/icon-tickets.svg" alt=""></a><a class="list-item d-flex align-items-center justify-content-between" href="#"> <span>Yêu thích</span><img src="./assets/icons/icon-heart.svg" alt=""></a><a class="list-item d-flex align-items-center justify-content-between" href="#"> <span>Đơn hàng của tôi</span><img src="./assets/icons/icon-order.svg" alt=""></a><a class="list-item d-flex align-items-center justify-content-between" href="#"> <span>Khoá học</span><img src="./assets/icons/icon-book.svg" alt=""></a><a class="list-item d-flex align-items-center justify-content-between" href="#"> <span>Học</span><img src="./assets/icons/icon-study.svg" alt=""></a><a class="list-item d-flex align-items-center justify-content-between" href="#"> <span>Câu hỏi</span><img src="./assets/icons/icon-question.svg" alt=""></a></div>
                       </div>
                   </div>
                   <div class="col-lg-9">
                       <div class="user-layout-main">
                           <h3 class="layout-title">Thêm mới sổ địa chỉ</h3>
                           <form class="authen-form" action="#">
                               <div class="form-group half"></div>
                               <div class="form-group half">
                                   <div class="form-item">
                                       <label>Địa chỉ: <span style="color:red">*</span></label>
                                       <input type="text" placeholder="Địa chỉ">
                                   </div>
                                   <div class="form-item">
                                       <label>Số điện thoại:</label>
                                       <input type="text" placeholder="Số điện thoại">
                                   </div>
                               </div>
                               <div class="form-group half">
                                   <div class="form-item"></div>
                                   <div class="form-item button-checkout">
                                       <button class="btn primary">Thêm mới</button>
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
