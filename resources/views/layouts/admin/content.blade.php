{{-- Authentication Laravel to VUE JS --}}
@if (Auth::check())
<meta name="user_id" content="{{ Auth::user()->id }}" />
@endif
{{-- -------------------------------- --}}

<div class="content-wrapper">
    <router-view></router-view>
</div>
