    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/toastr/toastr.css') }}" />

    <script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}"></script>

    <script>
        var showToast = function(type,message,title=null) {
            var shortCutFunction = type,
                isRtl = 'rtl',
                msg = message,
                title = title,
                $showDuration = 3000,
                $hideDuration = 10000,
                $timeOut = 5000,
                $extendedTimeOut = 1000,
                $showEasing = 'swing',
                $hideEasing = 'linear',
                $showMethod = 'fadeIn',
                $hideMethod = 'fadeOut',
                addClear = true,
                prePositionClass = 'toast-top-right';

            prePositionClass =
                typeof toastr.options.positionClass === 'undefined' ? 'toast-top-right' : toastr.options
                .positionClass;

            toastr.options = {
                maxOpened: 1,
                autoDismiss: true,
                closeButton: true,
                debug: false,
                newestOnTop: true,
                progressBar: true,
                positionClass: 'toast-top-right',
                preventDuplicates: true,
                onclick: null,
                rtl: isRtl
            };

            //Add fix for multiple toast open while changing the position
            if (prePositionClass != toastr.options.positionClass) {
                toastr.options.hideDuration = 0;
                toastr.clear();
            }

            if ($showDuration.length) {
                toastr.options.showDuration = parseInt($showDuration);
            }
            if ($hideDuration.length) {
                toastr.options.hideDuration = parseInt($hideDuration);
            }
            if ($timeOut.length) {
                toastr.options.timeOut = addClear ? 0 : parseInt($timeOut);
            }
            if ($extendedTimeOut.length) {
                toastr.options.extendedTimeOut = addClear ? 0 : parseInt($extendedTimeOut);
            }
            if ($showEasing.length) {
                toastr.options.showEasing = $showEasing;
            }
            if ($hideEasing.length) {
                toastr.options.hideEasing = $hideEasing;
            }
            if ($showMethod.length) {
                toastr.options.showMethod = $showMethod;
            }
            if ($hideMethod.length) {
                toastr.options.hideMethod = $hideMethod;
            }
            if (addClear) {
                toastr.options.tapToDismiss = true;
            }

            var $toast = toastr[shortCutFunction](msg,
                title); // Wire up an event handler to a button in the toast, if it exists
            if (typeof $toast === 'undefined') {
                return;
            }
            if ($toast.find('.clear').length) {
                $toast.delegate('.clear', 'click', function() {
                    toastr.clear($toast, {
                        force: true
                    });
                });
            }

        };
        // $(document).ready(function() {
        //     showToast('info','This is test message');
        // });
    </script>
