<div class="col-12">
    <div class="alert alert-{{ $notificationType }} alert-dismissible fade show" role="alert">
        @isset($notificationTitle)
        <strong>{{ $notificationTitle }}</strong>
        @endisset
        {{ $notificationMessage }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>