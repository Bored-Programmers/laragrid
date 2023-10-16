@props([
    /** @var \BoredProgrammers\LaraGrid\Components\ActionButton $actionButton */
    'actionButton',
    /** @var \BoredProgrammers\LaraGrid\Theme\BaseLaraGridTheme $theme */
    'theme',
    'record',
])
<a
        class="{{ $theme->getActionButton() }}"
        @if($redirect = $actionButton->callRedirect($record))
            href="{{ $redirect }}"
        @endif
        @if($attributes = $actionButton->callAttributes($record))
            {!! $attributes !!}
        @endif
>
    {{ $actionButton->callRenderer($record) }}
</a>
