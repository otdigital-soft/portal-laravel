@if(session()->has('info'))

<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-14 text-theme-10">
    <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> {!! session()->get('info') !!}
</div>

@endif

@if(session()->has('success'))
<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-18 text-theme-9">
    <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> {!! session()->get('success') !!}
</div>
@endif

@if(session()->has('warning'))
<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-17 text-theme-11">
    <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> {!! session()->get('warning') !!}
</div>
@endif

@if(session()->has('error'))
<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-31 text-theme-6">
    <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> {!! session()->get('error') !!}
</div>
@endif
