@php
use App\Helper\NhanhService;
@endphp

@extends("enduser.layout")

@section('content')
<div class="CheckoutPage">
    <div class="container">
        <div class="CheckoutPage-wrapper">
            <div class="Card">
                <div class="Card-header">
                    <div class="Card-header-title color-black">Danh sách sản phẩm</div>
                </div>
                <div class="Card-body">
                    <div class="CheckoutPage-list-product">
                        <div class="CheckoutPage-list-product-wrapper">
                            @if(Session::has('Cart') != null)
                            @foreach(Session::get('Cart')->products as $key => $value)
                            <div class="CheckoutPage-list-product-item flex">
                                <div class="CheckoutPage-list-product-item-image"><a href="#"> <img src="{{$value['productInfo']['avatar']??''}}" alt=""></a></div>
                                <div class="CheckoutPage-list-product-item-info">
                                    <div class="CheckoutPage-list-product-item-info-header flex justify-between"><a class="CheckoutPage-list-product-item-info-title" href="#">{{$value['productInfo']['name']??''}}</a>
                                        <div class="CheckoutPage-list-product-item-info-price">{{ $value['productInfo']['price'] ? number_format($value['quanty'] * $value['productInfo']['price']). 'đ' : '' }}</div>
                                    </div>
                                    <div class="CheckoutPage-list-product-item-info-description"><span>Màu sắc: {{$value['productInfo']['color']??''}}</span><span>Kích cỡ: {{$value['productInfo']['size']??''}}</span></div>
                                    <div class="CheckoutPage-list-product-item-info-actions flex items-center justify-between">
                                        <div class="Button outline-gray only-icon middle">
                                            <button class="Button-control flex items-center justify-center" type="button"><span class="Button-control-icon"><svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path class="fill" d="M12.668 4.66675C12.4912 4.66675 12.3216 4.73699 12.1966 4.86201C12.0715 4.98703 12.0013 5.1566 12.0013 5.33341V12.7941C11.9822 13.1312 11.8306 13.4471 11.5796 13.673C11.3286 13.8989 10.9986 14.0165 10.6613 14.0001H5.3413C5.00403 14.0165 4.67396 13.8989 4.42297 13.673C4.17199 13.4471 4.02043 13.1312 4.0013 12.7941V5.33341C4.0013 5.1566 3.93106 4.98703 3.80604 4.86201C3.68102 4.73699 3.51145 4.66675 3.33464 4.66675C3.15782 4.66675 2.98826 4.73699 2.86323 4.86201C2.73821 4.98703 2.66797 5.1566 2.66797 5.33341V12.7941C2.687 13.4849 2.97902 14.14 3.48009 14.616C3.98115 15.0919 4.65042 15.3499 5.3413 15.3334H10.6613C11.3522 15.3499 12.0215 15.0919 12.5225 14.616C13.0236 14.14 13.3156 13.4849 13.3346 12.7941V5.33341C13.3346 5.1566 13.2644 4.98703 13.1394 4.86201C13.0143 4.73699 12.8448 4.66675 12.668 4.66675Z" fill="#929191" />
                                                        <path class="fill" d="M13.3353 2.66675H10.6686V1.33341C10.6686 1.1566 10.5984 0.987034 10.4734 0.86201C10.3483 0.736986 10.1788 0.666748 10.002 0.666748H6.00195C5.82514 0.666748 5.65557 0.736986 5.53055 0.86201C5.40552 0.987034 5.33529 1.1566 5.33529 1.33341V2.66675H2.66862C2.49181 2.66675 2.32224 2.73699 2.19722 2.86201C2.07219 2.98703 2.00195 3.1566 2.00195 3.33341C2.00195 3.51023 2.07219 3.6798 2.19722 3.80482C2.32224 3.92984 2.49181 4.00008 2.66862 4.00008H13.3353C13.5121 4.00008 13.6817 3.92984 13.8067 3.80482C13.9317 3.6798 14.002 3.51023 14.002 3.33341C14.002 3.1566 13.9317 2.98703 13.8067 2.86201C13.6817 2.73699 13.5121 2.66675 13.3353 2.66675ZM6.66862 2.66675V2.00008H9.33529V2.66675H6.66862Z" fill="#929191" />
                                                        <path d="M7.33529 11.3333V6.66667C7.33529 6.48986 7.26505 6.32029 7.14002 6.19526C7.015 6.07024 6.84543 6 6.66862 6C6.49181 6 6.32224 6.07024 6.19722 6.19526C6.07219 6.32029 6.00195 6.48986 6.00195 6.66667V11.3333C6.00195 11.5101 6.07219 11.6797 6.19722 11.8047C6.32224 11.9298 6.49181 12 6.66862 12C6.84543 12 7.015 11.9298 7.14002 11.8047C7.26505 11.6797 7.33529 11.5101 7.33529 11.3333Z" fill="#929191" />
                                                        <path d="M10.0013 11.3333V6.66667C10.0013 6.48986 9.93106 6.32029 9.80604 6.19526C9.68102 6.07024 9.51145 6 9.33464 6C9.15782 6 8.98826 6.07024 8.86323 6.19526C8.73821 6.32029 8.66797 6.48986 8.66797 6.66667V11.3333C8.66797 11.5101 8.73821 11.6797 8.86323 11.8047C8.98826 11.9298 9.15782 12 9.33464 12C9.51145 12 9.68102 11.9298 9.80604 11.8047C9.93106 11.6797 10.0013 11.5101 10.0013 11.3333Z" fill="#929191" />
                                                    </svg></span>
                                            </button>
                                        </div>
                                        <div class="Amount flex">
                                            <div class="Amount-minus"><svg width="17" height="3" viewBox="0 0 17 3" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M0 0H16.8149V2.80248H0V0Z" fill="black" />
                                                </svg></div>
                                            <input class="Amount-control" type="number" value="{{$value['productInfo']['quantity']??''}}" min="1">
                                            <div class="Amount-plus">
                                                <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.90497 7.07477V0H7.07504V7.07477H0V9.90469H7.07504V16.9796H9.90497V9.90469H16.9796V7.07477H9.90497Z" fill="black" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                        <div class="CheckoutPage-row flex justify-between items-center">
                            <div class="CheckoutPage-text">Tạm tính:</div>
                            <div class="CheckoutPage-text big color-yellow-sea nowrap">{{ Session::get('Cart')->totalPrice ? number_format(Session::get('Cart')->totalPrice). 'đ' : '' }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="Card">
                <div class="Card-header">
                    <div class="Card-header-title color-black">Thông tin nhận hàng</div>
                </div>
                <div class="Card-body">
                    <div class="CheckoutPage-form">
                        <div class="CheckoutPage-form-row">
                            <div class="CheckoutPage-form-row-control">
                                <div class="Input middle">
                                    <input class="Input-control" type="text" placeholder="Họ tên người nhận hàng *">
                                </div>
                            </div>
                        </div>
                        <div class="CheckoutPage-form-row">
                            <div class="CheckoutPage-form-row-control">
                                <div class="Input middle">
                                    <input class="Input-control" type="text" placeholder="Số điện thoại *">
                                </div>
                            </div>
                        </div>
                        <div class="CheckoutPage-form-row">
                            <div class="CheckoutPage-form-row-control">
                                <div class="Input middle">
                                    <input class="Input-control" type="text" placeholder="Địa chỉ email *">
                                </div>
                            </div>
                        </div>
                        <div class="CheckoutPage-form-row-address">
                            <div class="CheckoutPage-form-row half">
                                <div class="CheckoutPage-form-row-control">
                                    <div class="Select middle">
                                        <select class="Select-control">
                                            <option value="">Tỉnh / thành phố *</option>
                                        </select>
                                        <div class="Select-arrow">
                                            <svg width="14" height="9" viewBox="0 0 14 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12.9248 1L6.89488 7L0.864954 0.999999" stroke="black" stroke-width="1.5" stroke-linecap="round" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="CheckoutPage-form-row-control">
                                    <div class="Select middle">
                                        <select class="Select-control">
                                            <option value="">Quận / huyện *</option>
                                        </select>
                                        <div class="Select-arrow">
                                            <svg width="14" height="9" viewBox="0 0 14 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12.9248 1L6.89488 7L0.864954 0.999999" stroke="black" stroke-width="1.5" stroke-linecap="round" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="CheckoutPage-form-row-control">
                                    <div class="Select middle">
                                        <select class="Select-control">
                                            <option value="">Phường / xã *</option>
                                        </select>
                                        <div class="Select-arrow">
                                            <svg width="14" height="9" viewBox="0 0 14 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12.9248 1L6.89488 7L0.864954 0.999999" stroke="black" stroke-width="1.5" stroke-linecap="round" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="CheckoutPage-form-row-control">
                                    <div class="Input middle">
                                        <input class="Input-control" type="text" placeholder="Địa chỉ *">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="CheckoutPage-form-row">
                            <div class="CheckoutPage-form-row-control">
                                <div class="TextArea middle">
                                    <textarea class="TextArea-control" placeholder="Ghi chú đơn hàng"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="Card">
                <div class="Card-header">
                    <div class="Card-header-title color-black">Thông tin khác</div>
                </div>
                <div class="Card-body">
                    <div class="CheckoutPage-form-row half js-banking-info-check">
                        <div class="CheckoutPage-form-row-control">
                            <div class="Radio middle">
                                <input class="Radio-control" type="radio" name="shippingType" data-key="">
                                <div class="Radio-wrapper flex items-center">
                                    <div class="Radio-wrapper-box"> </div>
                                    <div class="Radio-wrapper-label">Giao nhanh</div>
                                </div>
                            </div>
                        </div>
                        <div class="CheckoutPage-form-row-control">
                            <div class="Radio middle">
                                <input class="Radio-control" type="radio" name="shippingType" data-key="">
                                <div class="Radio-wrapper flex items-center">
                                    <div class="Radio-wrapper-box"> </div>
                                    <div class="Radio-wrapper-label">Giao chậm</div>
                                </div>
                            </div>
                        </div>
                        <div class="CheckoutPage-form-row-control">
                            <div class="Radio middle">
                                <input class="Radio-control" type="radio" name="shippingType" data-key="">
                                <div class="Radio-wrapper flex items-center">
                                    <div class="Radio-wrapper-box"> </div>
                                    <div class="Radio-wrapper-label">Thanh toán khi nhận hàng</div>
                                </div>
                            </div>
                        </div>
                        <div class="CheckoutPage-form-row-control">
                            <div class="Radio middle">
                                <input class="Radio-control" type="radio" name="shippingType" data-key="banking">
                                <div class="Radio-wrapper flex items-center">
                                    <div class="Radio-wrapper-box"> </div>
                                    <div class="Radio-wrapper-label">Thanh toán chuyển khoản</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="Card js-banking-info">
                <div class="Card-header">
                    <div class="Card-header-title color-black">Thông tin chuyển khoản</div>
                </div>
                <div class="Card-body">
                    <div class="CheckoutPage-row flex justify-between items-center">
                        <div class="CheckoutPage-text">Tên tài khoản</div>
                        <div class="CheckoutPage-text medium nowrap">CÔNG TY DỊCH VỤ VÀ CỔ PHẦN THONGMINHMART</div>
                    </div>
                    <div class="CheckoutPage-row flex justify-between items-center">
                        <div class="CheckoutPage-text">Số tài khoản</div>
                        <div class="CheckoutPage-text medium nowrap">1010101010</div>
                    </div>
                    <div class="CheckoutPage-row flex justify-between items-center">
                        <div class="CheckoutPage-text">Ngân hàng</div>
                        <div class="CheckoutPage-text medium nowrap">Vietcombank</div>
                    </div>
                </div>
            </div>
            <div class="Card">
                <div class="Card-body">
                    <div class="CheckoutPage-row flex justify-between items-center">
                        <div class="CheckoutPage-text">Phí vận chuyển: (miễn phí vận chuyển cho đơn hàng trị giá trên 1 triệu đồng)</div>
                        <div class="CheckoutPage-text medium nowrap">30 000 đ</div>
                    </div>
                    <div class="CheckoutPage-row flex justify-between items-center">
                        <div class="CheckoutPage-text">Thành tiền:</div>
                        <div class="CheckoutPage-text big color-yellow-sea nowrap">120 000 đ</div>
                    </div>
                    <div class="CheckoutPage-row">
                        <div class="Button primary big">
                            <button class="Button-control flex items-center justify-center" type="button"><span class="Button-control-title">ĐẶT MUA</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop