@php
    $details = \App\OrderDetail::where('order_id', $order->order_id)->get();
@endphp

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
<div style="padding: 3.5rem 6rem; background: #fff;">
    <div style="display: flex;">
        <div style="width: 100%; max-width: 24rem; margin-right: 3rem;"><svg style="width: 100%; height: auto;" width="239" height="71" viewBox="0 0 239 71" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_8554_267302)"><path fill-rule="evenodd" clip-rule="evenodd" d="M11.1689 55.8827H18.4012V48.6347H11.1689V55.8827ZM62.5638 21.2743V22.8432H37.6508V34.9702H36.082V22.9216H27.2024V21.2743L36.8664 13.3047L62.4383 21.2743H62.5638ZM29.9792 21.2743H36.082V16.0658L30.0106 21.2743H29.9792ZM37.6508 15.2814V21.2743H56.916L37.6508 15.2814ZM55.3315 37.9353H62.5638V30.6089H55.3315V37.9353ZM20.0171 37.9353H27.2338V30.6089H20.0171V37.9353ZM11.1689 37.9353H18.4012V30.6089H11.1689V37.9353ZM11.1689 46.909H18.4012V39.5826H11.1689V46.909ZM20.0171 46.909H27.2338V39.5826H20.0171V46.909ZM28.8653 46.909H36.082V39.5826H28.8653V46.909ZM37.6978 46.909H44.9145V39.5826H37.6508V46.909H37.6978ZM55.3315 55.8827H62.5638V48.6347H55.3315V55.9612V55.8827ZM46.499 55.8827H53.7156V48.6347H46.499V55.8827ZM37.6978 55.8827H44.9145V48.6347H37.6508V55.9612L37.6978 55.8827ZM28.8653 55.8827H36.082V48.6347H28.8653V55.8827ZM20.0171 55.8827H27.2338V48.6347H20.0171V55.9612V55.8827Z" fill="#1E2022"/><path fill-rule="evenodd" clip-rule="evenodd" d="M35.6909 70.7385C34.2789 68.5265 31.3609 65.4045 27.9252 65.2947H0V0H28.5841C31.273 0.204306 33.7973 1.37449 35.6909 3.29454C37.5909 1.37461 40.12 0.204785 42.8133 0H71.3817V65.2947H43.4723C40.0208 65.4045 37.1185 68.5265 35.6281 70.7385H35.6909ZM35.6909 9.88362C33.9338 8.45599 31.4864 5.77329 28.4272 5.77329H5.80467V59.6155H28.2389C29.6655 59.5492 31.087 59.8266 32.3839 60.4246C33.6808 61.0225 34.8149 61.9233 35.6909 63.0512C36.5677 61.9243 37.702 61.0242 38.9986 60.4264C40.2953 59.8285 41.7164 59.5505 43.1428 59.6155H65.5927V5.77329H42.9702C39.911 5.77329 37.4636 8.45599 35.6909 9.89931V9.88362Z" fill="#1E2022"/><path d="M97.9116 24.6449H95.4956L90.7891 17.2714V24.6449H88.3574V13.4277H90.7891L95.4956 20.8326V13.4277H97.8959L97.9116 24.6449Z" fill="#1E2022"/><path d="M111.246 24.6449H108.83V19.8442H104.123V24.6449H101.691V13.4277H104.107V17.9773H108.814V13.4277H111.23L111.246 24.6449Z" fill="#1E2022"/><path d="M121.803 22.341H117.567L116.752 24.6472H114.179L118.556 13.4301H120.799L125.208 24.6472H122.619L121.803 22.341ZM118.211 20.4741H121.16L119.685 16.2696L118.211 20.4741ZM120.878 12.8182H118.964L116.736 10.4336H119.23L120.878 12.8182Z" fill="#1E2022"/><path d="M137.931 17.2568L140.127 13.3818H142.92L139.499 18.9512L143.014 24.599H140.19L137.931 20.6769L135.672 24.599H132.848L136.362 18.9512L132.942 13.3818H135.719L137.931 17.2568Z" fill="#1E2022"/><path d="M154.779 13.4277V20.8169C154.81 21.3628 154.717 21.9086 154.508 22.4138C154.299 22.919 153.979 23.3705 153.571 23.7349C152.648 24.4963 151.47 24.8778 150.276 24.8017C149.099 24.865 147.939 24.4968 147.013 23.7663C146.607 23.4131 146.284 22.9733 146.07 22.4792C145.855 21.9851 145.754 21.4493 145.774 20.911V13.4277H148.19V20.8326C148.172 21.1175 148.211 21.4032 148.305 21.6727C148.4 21.9422 148.547 22.19 148.739 22.4014C149.18 22.7603 149.74 22.9395 150.308 22.9035C150.587 22.942 150.872 22.9155 151.14 22.8261C151.408 22.7367 151.651 22.5868 151.851 22.388C152.052 22.1891 152.204 21.9468 152.295 21.6798C152.386 21.4127 152.415 21.1282 152.379 20.8483V13.4277H154.779Z" fill="#1E2022"/><path d="M164.884 22.3401H160.633L159.833 24.6463H157.26L161.59 13.4291H163.833L168.226 24.6463H165.653L164.884 22.3401ZM161.292 20.4732H164.225L162.751 16.2687L161.292 20.4732ZM162.107 11.0602H163.425L165.731 12.833H163.99L162.766 11.8603L161.543 12.833H159.817L162.107 11.0602ZM166.453 9.69531H168.32L166.484 11.7975H165.135L166.453 9.69531Z" fill="#1E2022"/><path d="M178.846 15.3103H175.238V24.7233H172.884V15.3103H169.323V13.4277H178.846V15.3103Z" fill="#1E2022"/><path d="M187.239 24.6467V13.4295H191.397C192.534 13.3565 193.666 13.6301 194.644 14.214C195.005 14.4723 195.295 14.8177 195.487 15.2182C195.679 15.6186 195.767 16.0611 195.742 16.5044C195.754 17.025 195.6 17.5358 195.303 17.9635C194.995 18.3918 194.562 18.715 194.064 18.8891C194.626 18.9994 195.132 19.305 195.491 19.7519C195.836 20.2015 196.018 20.7544 196.009 21.3208C196.039 21.7841 195.957 22.2479 195.772 22.6736C195.586 23.0993 195.302 23.4745 194.942 23.7681C194.021 24.3951 192.916 24.6935 191.805 24.6153L187.239 24.6467ZM189.655 19.7676V22.7955H191.726C192.201 22.8268 192.672 22.6938 193.06 22.4189C193.22 22.2891 193.347 22.1235 193.432 21.9355C193.516 21.7475 193.555 21.5423 193.546 21.3364C193.546 20.301 192.981 19.7676 191.883 19.7676H189.655ZM189.655 18.1988H191.397C192.62 18.1988 193.232 17.7124 193.232 16.8025C193.251 16.5948 193.218 16.3856 193.136 16.1938C193.054 16.0021 192.925 15.8339 192.762 15.7043C192.32 15.4488 191.811 15.3339 191.303 15.3749H189.608L189.655 18.1988Z" fill="#1E2022"/><path d="M206.083 22.3406H201.831L201.031 24.6468H198.458L202.835 13.4297H205.078L209.471 24.6468H206.898L206.083 22.3406ZM202.49 20.4737H205.424L203.949 16.2693L202.49 20.4737ZM203.102 12.5198L202.976 11.4843C203.27 11.4888 203.562 11.441 203.839 11.3432C203.916 11.3196 203.984 11.2718 204.032 11.2068C204.08 11.1418 204.106 11.0631 204.106 10.9823C204.106 10.6372 203.714 10.4489 202.961 10.4489V9.41349C203.745 9.37169 204.529 9.51127 205.251 9.82139C205.473 9.90808 205.665 10.0586 205.802 10.2541C205.939 10.4495 206.014 10.6811 206.02 10.9196C206.024 11.0594 205.997 11.1984 205.94 11.3261C205.883 11.4538 205.797 11.5669 205.69 11.6569C205.442 11.8651 205.135 11.9911 204.812 12.0177V12.5512L203.102 12.5198Z" fill="#1E2022"/><path d="M221.784 24.6449H219.352L214.646 17.2714V24.6449H212.229V13.4277H214.646L219.352 20.8326V13.4277H221.768L221.784 24.6449Z" fill="#1E2022"/><path d="M95.996 41.4949L99.871 34.2783H104.781L98.8356 44.664L105.001 55.2379H99.9808L95.996 47.8958L92.0268 55.2379H87.0693L93.2505 44.664L87.2262 34.2783H92.121L95.996 41.4949Z" fill="#1E2022"/><path d="M121.663 50.9081H114.195L112.783 55.2381H108.249L115.936 34.2785H119.89L127.624 55.2381H123.09L121.663 50.9081ZM115.387 47.4096H120.564L117.96 39.5655L115.387 47.4096ZM123.467 32.694V32.945H120.156L117.976 30.78L115.779 32.945H112.642V32.6312L116.846 28.6621H119.231L123.467 32.694Z" fill="#1E2022"/><path d="M137.46 43.707L141.758 34.294H146.465L139.625 47.6291V55.2379H135.295V47.6291L128.518 34.2783H133.224L137.46 43.707Z" fill="#1E2022"/><path d="M155.313 55.2374V34.2778H161.683C163.386 34.2479 165.065 34.6759 166.546 35.5172C167.987 36.3461 169.154 37.5786 169.904 39.0628C170.734 40.6711 171.149 42.4616 171.112 44.2713V45.244C171.146 47.0465 170.737 48.83 169.919 50.4368C169.177 51.9113 168.021 53.1378 166.593 53.9666C165.106 54.809 163.424 55.2471 161.714 55.2374H155.313ZM159.581 37.7606V51.7703H161.589C162.309 51.8141 163.029 51.6879 163.692 51.4017C164.354 51.1155 164.939 50.6775 165.401 50.123C166.362 48.7483 166.837 47.0918 166.75 45.4165V44.3027C166.873 42.5912 166.415 40.8884 165.448 39.4707C164.989 38.9123 164.404 38.4706 163.742 38.1816C163.079 37.8926 162.357 37.7644 161.636 37.8077L159.581 37.7606Z" fill="#1E2022"/><path d="M192.762 34.2772V37.5561C193.322 37.5267 193.864 37.348 194.331 37.0383C194.742 36.7265 195.044 36.2927 195.194 35.799C195.408 34.9163 195.497 34.0081 195.461 33.1006H198.206C198.355 34.8778 197.884 36.6517 196.873 38.1208C196.335 38.6819 195.686 39.124 194.967 39.4185C194.249 39.7131 193.476 39.8535 192.699 39.8309V48.0672C192.749 49.0739 192.585 50.0797 192.217 51.0182C191.849 51.9566 191.286 52.8063 190.566 53.5111C188.974 54.9131 186.895 55.6341 184.777 55.5192C182.679 55.6316 180.619 54.9353 179.019 53.5738C178.302 52.8879 177.739 52.058 177.366 51.1386C176.992 50.2193 176.818 49.2313 176.854 48.2398V34.2772H181.106V48.0986C181.058 48.6402 181.12 49.1859 181.287 49.7033C181.454 50.2207 181.723 50.6993 182.078 51.1107C182.444 51.4379 182.87 51.6895 183.334 51.851C183.797 52.0126 184.287 52.0809 184.777 52.052C187.161 52.052 188.385 50.7656 188.417 48.2241V34.2772H192.762ZM183.114 58.7353C183.108 58.4644 183.163 58.1957 183.274 57.9487C183.385 57.7017 183.55 57.4827 183.757 57.3076C184.215 56.9184 184.804 56.7167 185.404 56.7428C186.01 56.7174 186.603 56.9188 187.067 57.3076C187.266 57.4871 187.424 57.7061 187.533 57.9507C187.642 58.1952 187.698 58.4598 187.698 58.7274C187.698 58.995 187.642 59.2596 187.533 59.5041C187.424 59.7487 187.266 59.9678 187.067 60.1472C186.595 60.524 186.009 60.7291 185.404 60.7291C184.8 60.7291 184.214 60.524 183.741 60.1472C183.541 59.9709 183.382 59.7535 183.273 59.5098C183.165 59.2661 183.111 59.0019 183.114 58.7353Z" fill="#1E2022"/><path d="M217.55 55.2379H213.361L205.062 41.4322V55.2379H200.811V34.2783H205.062L213.361 48.084V34.2783H217.613L217.55 55.2379Z" fill="#1E2022"/><path d="M238.462 52.5882C237.589 53.5838 236.469 54.3308 235.214 54.7532C233.704 55.2905 232.11 55.5509 230.508 55.5219C228.862 55.5582 227.237 55.1518 225.801 54.3453C224.434 53.5278 223.341 52.3205 222.664 50.8782C221.891 49.2187 221.505 47.4057 221.534 45.5755V44.1479C221.489 42.2854 221.842 40.4348 222.57 38.7197C223.197 37.272 224.247 36.0473 225.582 35.2056C227.186 34.3153 229.008 33.896 230.84 33.9959C232.672 34.0958 234.438 34.7109 235.936 35.7703C237.427 37.0893 238.335 38.9451 238.462 40.9318H234.32C234.227 39.929 233.776 38.9934 233.049 38.2961C232.29 37.705 231.343 37.4095 230.382 37.4647C229.734 37.433 229.089 37.5695 228.509 37.8609C227.929 38.1523 227.434 38.5886 227.072 39.1276C226.221 40.6239 225.823 42.3354 225.927 44.0538V45.3873C225.803 47.1344 226.237 48.8758 227.166 50.3604C227.581 50.9227 228.13 51.3723 228.763 51.6682C229.396 51.9641 230.093 52.097 230.79 52.0548C232.022 52.1727 233.251 51.8007 234.21 51.0194V47.3954H230.335V44.2577H238.462V52.5882Z" fill="#1E2022"/></g><defs><clipPath id="clip0_8554_267302"><rect width="238.462" height="70.7385" fill="white"/></clipPath></defs></svg></div>
        <div>
            <div style="font-family: Roboto, sans-serif; font-size: 4rem; color: #1E2022; font-weight: 600; margin-bottom: 2.4rem;">Thongminhmart.com</div>
            <div style="display: flex; flex-wrap: wrap;">
                <div style="display: flex; margin: 0 2.4rem 2.4rem 0;">
                    <div style="flex: 0 0 2.8rem; max-width: 2.8rem; height: 2.8rem; margin: 0.4rem 0.8rem 0 0"><svg style="width: 100%; height: 100%" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M24.5 14.28V23.3333C24.5 23.9777 23.9777 24.5 23.3333 24.5H18.6667C18.0223 24.5 17.5 23.9777 17.5 23.3333V16.9167C17.5 16.5945 17.2388 16.3333 16.9167 16.3333H11.0833C10.7612 16.3333 10.5 16.5945 10.5 16.9167V23.3333C10.5 23.9777 9.97767 24.5 9.33333 24.5H4.66667C4.02233 24.5 3.5 23.9777 3.5 23.3333V14.28C3.50082 13.3521 3.8701 12.4624 4.52667 11.8067L12.495 3.83833C12.7123 3.6228 13.0056 3.50129 13.3117 3.5H14.6883C14.9944 3.50129 15.2877 3.6228 15.505 3.83833L23.4733 11.8067C24.1299 12.4624 24.4992 13.3521 24.5 14.28Z" fill="#1E2022"/></svg></div>
                </div>
                <div style="display: flex; margin: 0 2.4rem 2.4rem 0;">
                    <div style="flex: 0 0 2.8rem; max-width: 2.8rem; height: 2.8rem; margin: 0.4rem 0.8rem 0 0"><svg style="width: 100%; height: 100%" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.8333 24.5001C17.904 24.4984 16.0047 24.0216 14.3033 23.1117L13.7783 22.8201C10.1509 20.8698 7.17698 17.8959 5.22667 14.2684L4.935 13.7434C4.00146 12.0323 3.50832 10.1159 3.5 8.16674V7.38507C3.49951 6.76319 3.74729 6.16683 4.18833 5.7284L6.16 3.75674C6.35148 3.56377 6.62177 3.47076 6.89145 3.50504C7.16113 3.53932 7.39956 3.697 7.53667 3.93174L10.1617 8.43507C10.4271 8.89344 10.3505 9.47312 9.975 9.84674L7.77 12.0517C7.58689 12.2328 7.54421 12.5126 7.665 12.7401L8.07333 13.5101C9.53988 16.2266 11.7708 18.4535 14.49 19.9151L15.26 20.3351C15.4875 20.4559 15.7672 20.4132 15.9483 20.2301L18.1533 18.0251C18.527 17.6496 19.1066 17.573 19.565 17.8384L24.0683 20.4634C24.3031 20.6005 24.4608 20.8389 24.495 21.1086C24.5293 21.3783 24.4363 21.6486 24.2433 21.8401L22.2717 23.8117C21.8332 24.2528 21.2369 24.5006 20.615 24.5001H19.8333Z" fill="#1E2022"/></svg></div>
                    <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; white-space: nowrap">0243 7265 180</div>
                </div>
                <div style="display: flex; margin: 0 2.4rem 2.4rem 0;">
                    <div style="flex: 0 0 2.8rem; max-width: 2.8rem; height: 2.8rem; margin: 0.4rem 0.8rem 0 0"><svg style="width: 100%; height: 100%" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M4.66634 4.66699H23.333C24.6217 4.66699 25.6663 5.71166 25.6663 7.00033V21.0003C25.6663 22.289 24.6217 23.3337 23.333 23.3337H4.66634C3.37768 23.3337 2.33301 22.289 2.33301 21.0003V7.00033C2.33301 5.71166 3.37768 4.66699 4.66634 4.66699ZM15.9247 18.0253L23.333 12.8337V10.3837L14.758 16.392C14.302 16.7085 13.6974 16.7085 13.2413 16.392L4.66634 10.3837V12.8337L12.0747 18.0253C13.2308 18.8335 14.7686 18.8335 15.9247 18.0253Z" fill="#1E2022"/></svg></div>
                    <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; white-space: nowrap">Thongminhmart@gmail.com</div>
                </div>
            </div>
        </div>
    </div>
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
                        <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; ">{{ $order->fullname }}</div>
                    </td>
                </tr>
                <tr style="vertical-align: top;">
                    <td style="padding: 0.6rem">
                        <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; white-space: nowrap;">SĐT:</div>
                    </td>
                    <td style="padding: 0.6rem">
                        <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; ">{{ $order->phone }}</div>
                    </td>
                </tr>
                <tr style="vertical-align: top;">
                    <td style="padding: 0.6rem">
                        <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; white-space: nowrap;">Email:</div>
                    </td>
                    <td style="padding: 0.6rem">
                        <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; ">{{ $order->email }}</div>
                    </td>
                </tr>
                <tr style="vertical-align: top;">
                    <td style="padding: 0.6rem">
                        <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; white-space: nowrap;">Địa chỉ:</div>
                    </td>
                    <td style="padding: 0.6rem">
                        <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; ">{{ $order->address }}</div>
                    </td>
                </tr>
            </table>
        </div>
        <div style="flex: 0 0 50%; max-width: 50%; padding-left: 3.2rem;">
            <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 700; margin-bottom: 2.4rem; text-transform: uppercase;">Thông tin đơn hàng</div>
            <table>
                <tr style="vertical-align: top;">
                    <td style="padding: 0.6rem">
                        <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; white-space: nowrap;">Ngày:</div>
                    </td>
                    <td style="padding: 0.6rem">
                        <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; font-weight: 700;">{{ date('d-m-Y') }}</div>
                    </td>
                </tr>

                <tr style="vertical-align: top;">
                    <td style="padding: 0.6rem">
                        <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; white-space: nowrap;">Mã đơn hàng:</div>
                    </td>
                    <td style="padding: 0.6rem">
                        <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; font-weight: 700;">#{{ $order->order_id }}</div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 700; margin-bottom: 2.4rem; text-transform: uppercase;">Danh sách đơn hàng</div>
    <div style="margin-bottom: 3.6rem; overflow: hidden; border-radius: .5rem; border: 1px solid #BDBDBD;">
        <table style="border-collapse: collapse; width: 100%;">
            <thead>
            <tr>
                <td style="padding: 1.5rem; background: #E0E0E0; text-align: center;">
                    <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; font-weight: 700; color: #333333;">STT</div>
                </td>
                <td style="padding: 1.5rem; background: #E0E0E0;">
                    <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; font-weight: 700; color: #333333;">Danh sách sản phẩm</div>
                </td>
                <td style="padding: 1.5rem; background: #E0E0E0;">
                    <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; font-weight: 700; color: #333333; text-align: right;">Số lượng</div>
                </td>
                <td style="padding: 1.5rem; background: #E0E0E0;">
                    <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; font-weight: 700; color: #333333; text-align: right;">Size</div>
                </td>
                <td style="padding: 1.5rem; background: #E0E0E0;">
                    <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; font-weight: 700; color: #333333; text-align: right;">Màu</div>
                </td>
                <td style="padding: 1.5rem; background: #E0E0E0;">
                    <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; font-weight: 700; color: #333333; text-align: right;">Đơn giá (đ)</div>
                </td>
                <td style="padding: 1.5rem; background: #E0E0E0;">
                    <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; font-weight: 700; color: #333333; text-align: right;">Tạm tính (đ)</div>
                </td>
            </tr>
            </thead>
            <tbody>
            @php
                $total = 0;
            @endphp
            @foreach($details as $k => $detail)
                @php
                    $total += $detail->product_price *  $detail->quantity;
                @endphp
            <tr>
                <td style="padding: 1.5rem; border-bottom: 1px solid #BDBDBD; text-align: center;">
                    <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; ">{{ ($k + 1) }}</div>
                </td>
                <td style="padding: 1.5rem; border-bottom: 1px solid #BDBDBD;">
                    <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; ">{{ $detail->product_name }}</div>
                </td>
                <td style="padding: 1.5rem; border-bottom: 1px solid #BDBDBD; text-align: right;">
                    <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; ">{{ $detail->quantity }}</div>
                </td>
                <td style="padding: 1.5rem; border-bottom: 1px solid #BDBDBD; text-align: right;">
                    <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; ">{{ $detail->size }}</div>
                </td>
                <td style="padding: 1.5rem; border-bottom: 1px solid #BDBDBD; text-align: right;">
                    <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; ">{{ $detail->color }}</div>
                </td>
                <td style="padding: 1.5rem; border-bottom: 1px solid #BDBDBD; text-align: right;">
                    <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; ">{{ number_format($detail->product_price) }}</div>
                </td>
                <td style="padding: 1.5rem; border-bottom: 1px solid #BDBDBD; text-align: right;">
                    <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; ">{{ number_format($detail->product_price *  $detail->quantity) }} </div>
                </td>
            </tr>
            @endforeach

            <tr>
                <td style="padding: 1.5rem;"></td>
                <td style="padding: 1.5rem;"></td>
                <td style="padding: 1.5rem;"></td>
                <td style="padding: 1.5rem;">
                    <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; font-weight: 700; text-align: right;">Tạm tính</div>
                </td>
                <td style="padding: 1.5rem;">
                    <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; font-weight: 700; text-align: right;">{{ number_format($total) }}</div>
                </td>
            </tr>
            <tr>
                <td style="padding: 1.5rem;"></td>
                <td style="padding: 1.5rem;"></td>
                <td style="padding: 1.5rem;"></td>
                <td style="padding: 1.5rem;">
                    <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; font-weight: 700; text-align: right;">Ship</div>
                </td>
                <td style="padding: 1.5rem;">
                    <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; font-weight: 700; text-align: right;">{{ number_format($order->ship) }}</div>
                </td>
            </tr>
            <tr>
                <td style="padding: 1.5rem;"></td>
                <td style="padding: 1.5rem;"></td>
                <td style="padding: 1.5rem;"></td>
                <td style="padding: 1.5rem;">
                    <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; font-weight: 700; text-align: right;">Thành tiền</div>
                </td>
                <td style="padding: 1.5rem;">
                    <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; font-weight: 700; text-align: right;">{{ number_format($order->ship + $total) }}</div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; font-weight: 700; margin-bottom: 1.2rem;">* Lưu ý</div>
    <div style="font-family: Roboto, sans-serif; font-size: 3.2rem; color: #1E2022; font-weight: 400; ">Hàng dễ ướt, xin nhẹ tay</div>
</div>
</body>
</html>
