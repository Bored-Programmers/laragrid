# LaraGrid Column Class

The `Column` class is a crucial part of the LaraGrid package. It is used to define a single column in the grid. Each instance of the `Column` class represents a column in the grid.

## Creating a Column

To create a column, you use the `make` method. This static method creates a new instance of the `Column` class. It takes two arguments: the model field and the label.

**Label is automatically translated with default renderers. If you rewrite the renderer, you need to translate the label yourself.**

```php
Column::make('name', 'attributes.name')
```

```php
Column::make('name', 'attributes.name')
    ->setRenderer(function (Model $model) {
        return __($model->name);
    })
```


## Methods

The `Column` class provides several methods to manipulate a column in the grid.

### `defaultRender(Model $model)`

This method is used to render the value of the column for a given model instance. It handles different types of values, such as `UnitEnum`, `Carbon` (for dates), and select filters.

```php
public function defaultRender(Model $model)
```

### `getValueLabelFromSelect($filter, mixed $value)`

This private method is used to get the label of a select filter's value.

```php
private function getValueLabelFromSelect($filter, mixed $value)
```

### `getFilter()`

This method returns the filter set on the column.

```php
public function getFilter(): ?BaseFilter
```

### `setFilter(BaseFilter $filter)`

This method sets a filter for the column.

```php
public function setFilter(BaseFilter $filter): static
```

### `getModelField()`

This method returns the model field of the column.

```php
public function getModelField(): ?string
```

### `setModelField(?string $modelField)`

This method sets the model field of the column.

```php
public function setModelField(?string $modelField): void
```

### `isSortable()`

This method returns a boolean indicating whether the column is sortable.

```php
public function isSortable(): bool
```

### `setSortable($isSortable = true)`

This method enables or disables sorting for a column.

```php
public function setSortable($isSortable = true): static
```

### `getDateFormat()`

This method returns the date format used to display date values in the column.

```php
public function getDateFormat(): string
```

### `setDateFormat(string $dateFormat)`

This method sets the date format used to display date values in the column.

```php
public function setDateFormat(string $dateFormat): static
```

## Usage

The `Column` class is used in the `getColumns` method of your Livewire component to define the columns that will be displayed in the grid.

```php
protected function getColumns(): array
{
    return [
        Column::make('id', 'ID'),
        Column::make('name', 'Name')->setSortable(true),
        Column::make('created_at', 'Created At')->setFilter(DateFilter::make()),
        // Add more columns as needed
    ];
}
```

In this example, we have three columns: 'ID', 'Name', and 'Created At'. The 'Name' column is sortable, and the 'Created At' column has a date filter.

Remember, the `Column` class extends the `BaseColumn` class, so it inherits all the methods and properties of the `BaseColumn` class. This includes methods for setting the renderer and attributes of the column, as well as the column tag.