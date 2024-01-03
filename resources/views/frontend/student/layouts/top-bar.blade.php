@php
    $firstParam = Request::segment(1);
    $secondParam = Request::segment(2);
@endphp
<div class="top-bar">
    <div class="text-center">
        <a class="logo-class" href="{{ route('customer.home.index') }}"><img
                src="{{ asset('customer/images/logo-white.png') }}" alt=""></a>
    </div>
    <div class="couponblock">
        <div class="coupon">
            Coupon Balance <span>NRs. {{ $couponValue }}</span>
        </div>
        <div class="couponcode">Coupon Code 
            
        <div><a href="#!" id="copy-code"
                onclick="copyToClipboard('#coupon-code')"><span><svg xmlns="http://www.w3.org/2000/svg" width="16"
                        height="16" fill="currentColor" class="bi bi-copy" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V2Zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H6ZM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1H2Z" />
                    </svg></span><span id="coupon-code"> {{ isset($couponCode) ? $couponCode->code : '' }}</span></a></div>
        </div>

        <!-- @isset($firstParam)
    <div class="coupon">{{ ucwords(str_replace('-', ' ', $firstParam)) }}</div>
@endisset -->
        <!-- > -->
    </div>
    <a class="logout" href="{{ route('customer.logout') }}">Logout</a>
</div>
