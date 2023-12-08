# LaraGrid Filters

Filters in LaraGrid are used to filter the data in the grid based on user input. They are set on a column and the filter's value is used to modify the query builder for the grid's data source.

## Available Filters

LaraGrid provides several filter classes out of the box:

1. **BaseFilter**: This is the abstract base class for all filter types. It defines the basic structure and methods that all filters must have. It has methods like `setBuilder` which sets a closure that modifies the query builder based on the filter's value.

2. **TextFilter**: This class extends `BaseFilter` and is used for filtering text fields. It sets the filtration type to `LIKE` and filter type to `TEXT`.

```php
use BoredProgrammers\LaraGrid\Filters\TextFilter;

Column::make('name', 'Name')->setFilter(TextFilter::make()),
```

3. **SelectFilter**: This class extends `BaseFilter` and is used for filtering select fields. It sets the filtration type to `EQUAL` and filter type to `SELECT`. It also has methods to set options for the select filter.

```php
use BoredProgrammers\LaraGrid\Filters\SelectFilter;

Column::make('status', 'Status')->setFilter(SelectFilter::make()->setOptions([
    'active' => 'Active',
    'inactive' => 'Inactive',
])),
```

4. **DateFilter**: This class extends `BaseFilter` and is used for filtering date fields. It sets the filtration type to `DATE_BETWEEN` and filter type to `DATE`.

```php
use BoredProgrammers\LaraGrid\Filters\DateFilter;

Column::make('created_at', 'Created At')->setFilter(DateFilter::make()),
```

5. **BooleanFilter**: This class extends `SelectFilter` and is used for filtering boolean fields. It sets predefined options for boolean values.

```php
use BoredProgrammers\LaraGrid\Filters\BooleanFilter;

Column::make('is_active', 'Is Active')->setFilter(BooleanFilter::make()),
```

## Filter Types

LaraGrid defines an enum class `FilterType` that lists the types of filters available: `TEXT`, `SELECT`, and `DATE`.

## Filtration Types

LaraGrid defines an enum class `FiltrationType` that lists the types of filtrations available: `LIKE`, `EQUAL`, and `DATE_BETWEEN`.

## Usage

Filters are used in the `getColumns` method of your Livewire component to define the filters for the columns in the grid. The filters are applied to the data source based on the user's input.

```php
protected function getColumns(): array
{
    return [
        Column::make('id', 'ID'),
        Column::make('name', 'Name')->setFilter(TextFilter::make()),
        Column::make('status', 'Status')->setFilter(SelectFilter::make()->setOptions([
            'active' => 'Active',
            'inactive' => 'Inactive',
        ])),
        Column::make('created_at', 'Created At')->setFilter(DateFilter::make()),
        // Add more columns as needed
    ];
}
```

In this example, we have four columns: 'ID', 'Name', 'Status', and 'Created At'. The 'Name' column has a text filter, the 'Status' column has a select filter, and the 'Created At' column has a date filter.