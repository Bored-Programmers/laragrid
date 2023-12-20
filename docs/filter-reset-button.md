# FilterResetButton

The `FilterResetButton` is a component in the LaraGrid package that allows you to reset all filters applied to the grid. It is a button that, when clicked, clears all the filter inputs and refreshes the grid to its initial state.

## Usage

To use the `FilterResetButton`, you need to include it in the `getFilterResetButton` method of your grid class. Here is an example:

```php
use BoredProgrammers\LaraGrid\Filters\FilterResetButton;

class MyGrid extends BaseLaraGrid
{
    protected function getFilterResetButton(): array
    {
        return FilterResetButton::make()
            ->setRenderer(function () {
                return view('my-grid.filter-reset-button');
            })
            ->setRenderer(fn() => 'Reset button')
            ->setRenderer(function() {
                return "<b>Reset button</b>";
            })
            ->setAttributes([
                'id' => 'my-custom-id',
                'data-foo' => 'bar',
            ]);
    }
}
```

In this example, `FilterResetButton::make()` creates an instance of the `FilterResetButton` component. This button will be added to the grid.

## Customization

The `FilterResetButton` component can be customized by chaining methods on the `make` method. Here are some of the methods you can use:

- `setLabel(string $label)`: Sets the label of the button. The default label is 'Reset'.
- `setRenderer(callable $renderer)`: Sets the renderer of the button. The default renderer is `function () { return view('laragrid::components.filter-reset-button'); }`.
- `setAttributes(array $attributes)`: Sets the HTML attributes of the button. BE CAREFUL when using this method, as it can break the functionality of the button. There is already a default wire:click event handler on the button, so if you override it, the button may not work as expected.
