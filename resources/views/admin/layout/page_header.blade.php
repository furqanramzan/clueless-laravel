<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-home"></i>
        </span> {{ $pageTitle }}
    </h3>
    @if (isset($pageRoute) && isset($pageIcon))
    <h3 class="page-title">
        <a href="{{ route($pageRoute) }}">
            <span class="page-title-icon bg-gradient-info text-white mr-2">
                <i class="mdi mdi-{{ $pageIcon }}"></i>
            </span>
        </a>
    </h3>
    @endif
</div>