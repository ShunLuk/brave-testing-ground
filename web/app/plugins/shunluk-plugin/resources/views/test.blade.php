<div class="shun-luk-test" data-live-content="{{ $id }}">
    <h3>{{ $title }}</h3>
    <div class="content">
        {{ $slot }}
    </div>
    <small>Last updated: {{ now()->toTimeString() }}</small>
</div>