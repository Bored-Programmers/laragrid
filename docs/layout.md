# Layout

The Layout class is responsible for rendering footer, and header of the grid. In `getLayout` method, there is a parameter
of type `BaseLaraGridTheme` which is the actual theme of the grid. You can use this parameter to customize the rendered
html based on actual theme. You can create custom properties in your theme class and use them in the getLayout method.

## Usage

To use the Layout class, you need to include it in the `getLayout` method of your grid class. Here is an example:

```php
use BoredProgrammers\LaraGrid\Components\Layout;

class MyGrid extends BaseLaraGrid
{
    protected function getLayout(BaseLaraGridTheme $theme): array
    {
        return Layout::make()
            ->setHeaderRenderer(function () {
                return view('my-grid.header');
            })
            ->setFooterRenderer(function () {
                return "This is the footer";
            })
            ->setFooterRenderer(function () {
                return "<b>This is the footer</b>";
            })
    }
}
```

In the example above, we have used the `setHeaderRenderer` method to set the header of the grid. The `setHeaderRenderer`
method takes a closure as an argument. The closure can return a view, string, or any other valid HTML.

The `setFooterRenderer` method works the same way as the `setHeaderRenderer` method.