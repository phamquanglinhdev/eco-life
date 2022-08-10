{{-- localized date using nesbot carbon --}}
@php
    $value = data_get($entry, $column['name']);

    $column['escaped'] = $column['escaped'] ?? true;
    $column['prefix'] = $column['prefix'] ?? '';
    $column['suffix'] = $column['suffix'] ?? '';
    $column['format'] = $column['format'] ?? config('backpack.base.default_date_format');
    $column['text'] = '';

    if(!empty($value)) {
        $column['text'] = \Carbon\Carbon::parse($value)
            ->locale(App::getLocale())
            ->isoFormat("D-MM-Y");

        $column['text'] = $column['prefix'].$column['text'].$column['suffix'];
    }
@endphp

<span data-order="{{ $value ?? '' }}">
    @includeWhen(!empty($column['wrapper']), 'crud::columns.inc.wrapper_start')
        @if($column['escaped'])
            {{ $column['text'] }}
        @else
            {!! $column['text'] !!}
        @endif
    @includeWhen(!empty($column['wrapper']), 'crud::columns.inc.wrapper_end')
</span>
