# LaraGrid Column Class

The `Column` class is a crucial part of the LaraGrid package. It is used to define a single column in the grid. Each
instance of the `Column` class represents a column in the grid.

## Creating a Column

To create a column, you use the `make` method. This static method creates a new instance of the `Column` class. It takes
two arguments: the model field and the label.

**Label is automatically translated with default renderers. If you rewrite the renderer, you need to translate the label
yourself.**

```php
Column::make('name', 'attributes.name')
```

```php
Column::make('name', 'attributes.name')
    ->setRenderer(function ($record) {
        return __($record->name);
    })
```

## Methods

The `Column` class provides several methods to manipulate a column in the grid.

### `setFilter(BaseFilter $filter)`

This method sets a filter for the column. Available filters
are: `TextFilter`, `DateFilter`, `SelectFilter`, `BooleanFilter`.

```php
public function setFilter(BaseFilter $filter): static
```

### `setRecordField(?string $recordField)`

This method sets the model field of the column.

```php
public function setRecordField(?string $recordField): void
```

### `setSortable($isSortable = true)`

This method enables or disables sorting for a column.

```php
public function setSortable($isSortable = true): static
```

### `setDateFormat(string $dateFormat)`

This method sets the date format used to display date values in the column.

```php
public function setDateFormat(string $dateFormat): static
```

### `setTag(string $tag): static`

This method sets the tag of the column. The default tag is `td`.

```php
public function setTag(string $tag): static
```

### `setRenderer(callable $renderer): static`

This method sets the renderer for the column. You can pass a callable, a class method, or a string.

```php
public function setRenderer(callable $renderer): static
```

```php
Column::make(label: 'Name')
    ->setRenderer(function ($record) {
        return $record->name;
    })
    ->setRenderer([MyClass::class, 'myMethod'])
    ->setRenderer('Random Text')
```

```php
class MyClass
{
    public static function myMethod($record)
    {
        return $record->name;
    }
}
```

### `setAttributes(array $attributes): static`

This method sets the attributes of the column. The attributes are HTML attributes that are applied to the column tag.
You can pass a callable, a class method, or an array.

```php
public function setAttributes(array $attributes): static
```

```php
Column::make(label: 'Name')
    ->setAttributes(function ($record) {
        return [
            'class' => 'text-center',
            'data-id' => $record->id,
            'wire:click.prevent' => 'download(' . $record->id . ')',
        ];
    })
    ->setAttributes([MyClass::class, 'myMethod'])
    ->setAttributes(['class' => 'bg-red-500'])
```

```php
class MyClass
{
    public static function myMethod($record)
    {
        return [
            'class' => 'text-center',
            'data-id' => $record->id,
            'wire:click.prevent' => 'download(' . $record->id . ')',
        ];
    }
}
```

## Usage

The `Column` class is used in the `getColumns` method of your Livewire component to define the columns that will be
displayed in the grid.

```php
use BoredProgrammers\LaraGrid\Components\ColumnComponents\Column;
use BoredProgrammers\LaraGrid\Components\ColumnComponents\ColumnGroup;
use BoredProgrammers\LaraGrid\Components\ColumnComponents\ActionButton;
use BoredProgrammers\LaraGrid\Filters\TextFilter;
use BoredProgrammers\LaraGrid\Filters\SelectFilter;
use BoredProgrammers\LaraGrid\Filters\DateFilter;

protected function getColumns(): array
{
    return [
            Column::make('email', 'attributes.email')
                ->setFilter(TextFilter::make()),

            Column::make('first_name', 'First Name')
                ->setFilter(TextFilter::make()),

            Column::make('last_name', 'last_name')
                ->setFilter(TextFilter::make()),
                            
            Column::make('role', 'attributes.role')
                ->setFilter(
                    SelectFilter::make()
                        ->setOptions([
                            'admin' => 'Admin',
                            'user' => 'User',
                        ])
                ),

            Column::make('created_at', 'attributes.created_at')
                ->setFilter(DateFilter::make()),
    
            ColumnGroup::make('attributes.actions')
                ->setColumns([
                    ActionButton::make('attributes.detail')
                        ->setColumnTag('a')
                        ->setRenderer(fn(User $user) => view('test'))
                        ->setAttributes(function (User $user) {
                            return [
                                'wire:click.prevent' => 'download(' . $user->id . ')',
                            ];
                        }),
                    ActionButton::make('attributes.delete')
                        ->setColumnTag('a')
                        ->setAttributes(function (User $user) {
                            return [
                                'wire:click.prevent' => 'download(' . $user->id . ')',
                            ];
                        }),
                ]),
        // Add more columns as needed
    ];
}
```
