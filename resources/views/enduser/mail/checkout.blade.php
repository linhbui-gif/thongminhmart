<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Template NXB-XD PDF</title>
    <style>
        html {
            font-size: 10px;
        }

        @media (max-width: 1440px) {
            html {
                font-size: 8px;
            }
        }

        @media (max-width: 991px) {
            html {
                font-size: 7px;
            }
        }

        @media (max-width: 768px) {
            html {
                font-size: 6px;
            }
        }

        @media (max-width: 575px) {
            html {
                font-size: 5px;
            }
        }

        @media print {
            html {
                font-size: 5px;
            }
        }


    </style>
</head>
<body>
<?php
$address = $order->address;
?>
<div style="padding: 3.5rem 6rem; background: #fff;">
    <div style="height: 1px; background: #BDBDBD; margin: 2.8rem 0;"></div>
    <div style="display: flex; margin-bottom: 3.2rem;">
        <div style="flex: 0 0 50%; max-width: 50%; padding-right: 3.2rem; border-right: 1px solid #BDBDBD;">
            <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 700; margin-bottom: 2.4rem; text-transform: uppercase;">Thông tin khách hàng</div>
            <table style="width: 100%;">
                <tr style="vertical-align: top;">
                    <td style="padding: 0.6rem">
                        <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; white-space: nowrap;">Họ tên:</div>
                    </td>
                    <td style="padding: 0.6rem">
                        <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; ">{{$order->user_name}}</div>
                    </td>
                </tr>
                <tr style="vertical-align: top;">
                    <td style="padding: 0.6rem">
                        <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; white-space: nowrap;">SĐT:</div>
                    </td>
                    <td style="padding: 0.6rem">
                        <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; ">{{$order->user_phone}}</div>
                    </td>
                </tr>
                <tr style="vertical-align: top;">
                    <td style="padding: 0.6rem">
                        <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; white-space: nowrap;">Email:</div>
                    </td>
                    <td style="padding: 0.6rem">
                        <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; ">{{$order->user_email}}</div>
                    </td>
                </tr>
                <tr style="vertical-align: top;">
                    <td style="padding: 0.6rem">
                        <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; white-space: nowrap;">Địa chỉ:</div>
                    </td>
                    <td style="padding: 0.6rem">
                        <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; ">{{$address}}</div>
                    </td>
                </tr>
            </table>
        </div>
{{--        <?php--}}
{{--        $orderDetail = $order->details()->where('order_detail.type', 'product' )->get();--}}
{{--        dd($orderDetail);--}}
{{--        ?>--}}
{{--    <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 700; margin-bottom: 2.4rem; text-transform: uppercase;">Danh sách đơn hàng</div>--}}
{{--    <div style="margin-bottom: 3.6rem; overflow: hidden; border-radius: .5rem; border: 1px solid #BDBDBD;">--}}
{{--        <table style="border-collapse: collapse; width: 100%;">--}}
{{--            <thead>--}}
{{--            <tr>--}}
{{--                <td style="padding: 1.5rem; background: #E0E0E0; text-align: center;">--}}
{{--                    <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; font-weight: 700; color: #333333;">STT</div>--}}
{{--                </td>--}}
{{--                <td style="padding: 1.5rem; background: #E0E0E0;">--}}
{{--                    <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; font-weight: 700; color: #333333;">Tên sản phẩm</div>--}}
{{--                </td>--}}
{{--                <td style="padding: 1.5rem; background: #E0E0E0;">--}}
{{--                    <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; font-weight: 700; color: #333333; text-align: right;">Số lượng</div>--}}
{{--                </td>--}}
{{--                <td style="padding: 1.5rem; background: #E0E0E0;">--}}
{{--                    <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; font-weight: 700; color: #333333; text-align: right;">Đơn giá (đ)</div>--}}
{{--                </td>--}}
{{--                <td style="padding: 1.5rem; background: #E0E0E0;">--}}
{{--                    <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; font-weight: 700; color: #333333; text-align: right;">Phí Ship</div>--}}
{{--                </td>--}}
{{--                <td style="padding: 1.5rem; background: #E0E0E0;">--}}
{{--                    <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; font-weight: 700; color: #333333; text-align: right;">Tổng (đ)</div>--}}
{{--                </td>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody>--}}
{{--            <tr>--}}
{{--                <td style="padding: 1.5rem; border-bottom: 1px solid #BDBDBD; text-align: center;">--}}
{{--                    <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; ">1</div>--}}
{{--                </td>--}}
{{--                <td style="padding: 1.5rem; border-bottom: 1px solid #BDBDBD;">--}}
{{--                    <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; ">Thi công nhà cao tầng</div>--}}
{{--                </td>--}}
{{--                <td style="padding: 1.5rem; border-bottom: 1px solid #BDBDBD; text-align: right;">--}}
{{--                    <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; ">1</div>--}}
{{--                </td>--}}
{{--                <td style="padding: 1.5rem; border-bottom: 1px solid #BDBDBD; text-align: right;">--}}
{{--                    <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; ">132,000</div>--}}
{{--                </td>--}}
{{--                <td style="padding: 1.5rem; border-bottom: 1px solid #BDBDBD; text-align: right;">--}}
{{--                    <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; ">132,000</div>--}}
{{--                </td>--}}
{{--            </tr>--}}
{{--            </tbody>--}}
{{--        </table>--}}
{{--    </div>--}}
{{--    <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; font-weight: 700; margin-bottom: 1.2rem;">* Lưu ý</div>--}}
{{--    <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; ">Hàng dễ ướt, xin nhẹ tay</div>--}}
</div>
</body>
</html>
