# LaraGrid Action Buttons

Action buttons in LaraGrid are used to add interactive buttons to each row in the grid. These buttons can be used to perform actions related to the corresponding record, such as viewing details, editing, or deleting the record.

## Creating an Action Button

To create an action button, you use the `make` method of the `ActionButton` class. This static method creates a new instance of the `ActionButton` class. It takes one argument: the label.

```php
ActionButton::make('View')
```

## Methods

The `ActionButton` class provides several methods to manipulate an action button in the grid.

### `setRenderer(Closure $renderer)`

This method sets a closure that returns the HTML for the action button. The closure receives the model instance for the current row as an argument.

```php
ActionButton::make('View')->setRenderer(function (Model $model) {
    return '<a href="' . route('detail', $model->id) . '">View</a>';
}),
```

### `setAttributes(Closure $attributes)`

This method sets a closure that returns an array of HTML attributes for the action button. The closure receives the model instance for the current row as an argument.

```php
ActionButton::make('View')->setAttributes([
    'target' => '_blank',
    'href' => 'https://google.com'
    'class' => 'btn btn-primary'
    // etc...
]),
```

### `setColumnTag(string $columnTag)`

This method sets the HTML tag for the action button.

```php
ActionButton::make('View')->setColumnTag('a'),
```

## Usage

The `ActionButton` class is used in the `getColumns` method of your Livewire component to define the action buttons that will be displayed in the grid.

```php
protected function getColumns(): array
{
    return [
        Column::make('id', 'ID'),
        Column::make('name', 'Name'),
        ActionButton::make('View')->setRenderer(function (Model $model) {
            return '<a href="' . route('detail', $model->id) . '">View</a>';
        }),
        // Add more columns as needed
    ];
}
```

In this example, we have three columns: 'ID', 'Name', and an action button 'View'. The 'View' button links to the detail page of the corresponding record.

Remember, the `ActionButton` class extends the `BaseColumn` class, so it inherits all the methods and properties of the `BaseColumn` class. This includes methods for setting the renderer and attributes of the column, as well as the column tag.