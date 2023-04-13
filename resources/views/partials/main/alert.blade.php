<div class="tg-dbsectionspace tg-haslayout tg-alertexamples">
    @if(session()->has('info'))
    <div class="tg-alert alert alert-info fade in">
        <p><strong>info: </strong> {!! session()->get('info') !!}</p>
        <div class="tg-anchors">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
        </div>
    </div>
    <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-14 text-theme-10">
        <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> {!! session()->get('info') !!}
    </div>

    @endif

    @if(session()->has('success'))
    <div class="tg-alert alert alert-success fade in">
        <p><strong>Success:</strong> {!! session()->get('success') !!}</p>
        <div class="tg-anchors">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
        </div>
    </div>
    @endif

    @if(session()->has('warning'))
    <div class="tg-alert alert alert-warning fade in">
        <p><strong>Warning:</strong> {!! session()->get('warning') !!}</p>
        <div class="tg-anchors">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
        </div>
    </div>
    @endif

    @if(session()->has('error'))
    <div class="tg-alert alert alert-danger fade in">
        <p><strong>Danger: </strong>{!! session()->get('error') !!}</p>
        <div class="tg-anchors">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
        </div>
    </div>
    @endif

</div>
