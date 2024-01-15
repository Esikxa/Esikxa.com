<!-- Footer  -->
<footer class="footer">
    <div class="container">
        <div class="footer-wrap">
            <div class="row">
                <div class="col-md-3">
                    <div class="footer-content">
                        <div class="footer-logo">
                            <a href="index.php">
                                <img src="{{ asset('storage/' . config('settings.logo')) }}" alt="Logo">
                            </a>
                        </div>
                        <p>
                            {!! config('settings.short_introduction') !!}
                        </p>
                        <ul>

                            <li><a href="{!! config('settings.facebook') !!}"><i class="lab la-facebook-f"></i></a></li>
                            <li><a href="{!! config('settings.twitter') !!}"><i class="lab la-twitter"></i></a></li>
                            <li><a href="{!! config('settings.instagram') !!}"><i class="lab la-instagram"></i></a></li>
                            <li><a href="{!! config('settings.linkedin') !!}"><i class="lab la-linkedin"></i></a></li>
                            <li><a href="{!! config('settings.youtube') !!}"><i class="lab la-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="footer-col space1">
                        <h3>Quick Links</h3>
                        @if (isset($widget1) && !empty($widget1))
                            <ul>
                                @foreach ($widget1['parent'] as $item)
                                    @if (isset($item['title']) && !empty($item['title']))
                                        <li><a href="{{ isset($item['url']) ? $item['url'] : '' }}"
                                                {{ isset($item['target']) && !empty($item['target']) ? 'target="_blank"' : '' }}>{!! $item['title'] !!}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="footer-col space2">
                        <h3>Our Supports</h3>
                        @if (isset($widget2) && !empty($widget2))
                            <ul>
                                @foreach ($widget2['parent'] as $item)
                                    @if (isset($item['title']) && !empty($item['title']))
                                        <li><a href="{{ isset($item['url']) ? $item['url'] : '' }}"
                                                {{ isset($item['target']) && !empty($item['target']) ? 'target="_blank"' : '' }}>{!! $item['title'] !!}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="footer-col">
                        <h3>Join Newsletter</h3>
                        <p>
                            Join our newsletter for further more information and notifications about Janak Technology.
                        </p>
                        <form action="">
                            <input type="email" class="form-control" placeholder="Enter your email" required>
                            <button type="submit">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>All rights reserved. Nepal's Tution Home © 2022. <a href="#">Janak Technology</a></p>
        </div>
    </div>
</footer>
<!-- Footer End  -->
<script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery-migrate-1.2.1.min.js') }}"></script>
<script src="{{ asset('frontend/js/popper.min.js') }}"></script>
<script src="{{ asset('frontend/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontend/js/animation.js') }}"></script>
<script src="{{ asset('frontend/js/slick.min.js') }}"></script>
<script src="{{ asset('frontend/js/custom.js') }}"></script>
@yield('script')
@include('admin/layouts/sections/toast')
@stack('scripts')
</body>

</html>
