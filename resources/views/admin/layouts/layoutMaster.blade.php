@isset($pageConfigs)
{!! Helper::updatePageConfig($pageConfigs) !!}
@endisset
@php
$configData = Helper::appClasses();
@endphp

@isset($configData["layout"])
@include((( $configData["layout"] === 'horizontal') ? 'admin.layouts.horizontalLayout' :
(( $configData["layout"] === 'blank') ? 'admin.layouts.blankLayout' : 'admin.layouts.contentNavbarLayout') ))
@endisset
