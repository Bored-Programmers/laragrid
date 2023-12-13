# LaraGrid ColumnGroup

The `ColumnGroup` class in LaraGrid is used to define a group of columns in the grid. This is useful when you want to
group related columns together under a common heading.

## Creating a ColumnGroup

To create a column group, you use the `make` method of the `ColumnGroup` class. This static method creates a new
instance of the `ColumnGroup` class. It takes one argument: the label.

```php
ColumnGroup::make('User Details')
```

## Methods

The `ColumnGroup` class provides several methods to manipulate a column group in the grid.

### `setColumns(array $columns)`

This method sets the columns of the group. It takes one argument: an array of `BaseColumn` instances.

```php
public function setColumns(array $columns): static
```

### `addColumn(BaseColumn $column)`

This method adds a column to the group. It takes one argument: a `BaseColumn` instance.

```php
public function addColumn(BaseColumn $column): static
```

## Usage

The `ColumnGroup` class is used in the `getColumns` method of your Livewire component to define the column groups that
will be displayed in the grid.

```php
protected function getColumns(): array
{
    return [
        ColumnGroup::make('User Details')
            ->setColumns([
                Column::make('first_name'),
                Column::make('last_name'),
            ]),
        ColumnGroup::make('Actions')
            ->setColumns([
                ActionButton::make('View')->setRenderer(function (Model $model) {
                    return '<a href="' . route('detail', $model->id) . '">View</a>';
                }),
                ActionButton::make('Edit')->setAttributes(function() {
                    return [
                        'class' => 'btn btn-primary'
                        'href' => route('edit', $model->id)
                        'wire:click' => 'openModal'
                    ];
                })
            ]),
        // Add more column groups as needed
    ];
}
```

In this example, we have a column group 'User Details' with two columns: 'ID' and 'Name'.

Currently, we do not support filtering or sorting on column groups, and there are no plans to add support for this in
the future. However, feel free to create a PR if you wish to propose adding this feature

Remember, the `ColumnGroup` class contains instances of the `BaseColumn` class, so it can contain any type of column,
including `Column` and `ActionButton` instances.