# LaraGrid Action Button Class

The `ActionButton` class is a part of the LaraGrid package. It is used to define an interactive button in the grid. Each
instance of the `ActionButton` class represents an action button in the grid.

## Creating an Action Button

To create an action button, you use the `make` method. This static method creates a new instance of the `ActionButton`
class. It takes one argument: the label.

```php
ActionButton::make('View')
```

## Methods

The `ActionButton` class provides several methods to manipulate an action button in the grid.

### `setRenderer(callable $renderer): static`

This method sets the renderer for the action button. You can pass a callable, a class method, or a string.

```php
public function setRenderer(callable $renderer): static
```

```php
ActionButton::make('View')
    ->setRenderer(function (Model $model) {
        return "<span class='bg-blue-200'>View</span>";
    })
    ->setRenderer(fn(Model $model) => view('test'))
    ->setRenderer([MyClass::class, 'myMethod'])
    ->setRenderer('Random Text')
```

```php
class MyClass
{
    public static function myMethod(Model $model)
    {
        return '<a href="' . route('detail', $model->id) . '">View</a>';
    }
}
```

### `setAttributes(array $attributes): static`

This method sets the attributes of the action button. The attributes are HTML attributes that are applied to the action
button tag. You can pass a callable, a class method, or an array.

```php
public function setAttributes(array $attributes): static
```

```php
ActionButton::make('View')
    ->setAttributes(function (Model $model) {
        return [
            'target' => '_blank',
            'href' => 'https://google.com',
            'class' => 'btn btn-primary'
        ];
    })
    ->setAttributes([MyClass::class, 'myMethod'])
    ->setAttributes(['class' => 'btn btn-primary'])
```

```php
class MyClass
{
    public static function myMethod(Model $model)
    {
        return [
            'target' => '_blank',
            'href' => 'https://google.com',
            'class' => 'btn btn-primary'
        ];
    }
}
```

### `setColumnTag(string $columnTag): static`

This method sets the HTML tag for the action button.

```php
public function setColumnTag(string $columnTag): static
```

```php
ActionButton::make('View')->setColumnTag('a'),
```
