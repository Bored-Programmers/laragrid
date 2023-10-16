@props([
    /** @var \BoredProgrammers\LaraGrid\Components\ActionButton $actionButton */
    'actionButton',
    /** @var \BoredProgrammers\LaraGrid\Theme\BaseLaraGridTheme $theme */
    'theme',
    'record',
])

<a
        class="{{ $theme->getActionButton() }}"
        href="{{ $actionButton->getRedirect($record) }}"
>
    {{ $actionButton->callRenderer($record) }}
</a>
