# LaraGrid

LaraGrid is a Laravel package that provides a powerful and customizable grid system. It allows you to easily create
sortable, filterable tables with pagination. This package is currently in development and **not ready** for use **in
production**.

## Table of Contents

- [Requirements](#requirements)
- [Installation](#installation)
- [Publishable Assets](#publishable-assets)
- [Usage](#usage)
    - [Creating a Grid](#creating-a-grid)
    - [Displaying the Grid](#displaying-the-grid)
    - [Customizing the Theme](#customizing-the-theme)
    - **[Detailed Class Documentation](docs/detailed-documentation)**
- [Examples](#examples)
- [Testing](#testing)
- [Contribution Guidelines](#contribution-guidelines)
- [Changelog](#changelog)
- [License](#license)
- [Contact Information](#contact-information)
- [Acknowledgments](#acknowledgments)

## Requirements

- PHP 8.1 or higher
- Laravel 10.0 or higher

## Installation

To install LaraGrid, you need to run the following command:

```bash
composer require bored-programmers/laragrid
```

LaraGrid depends on `flatpickr` for date and datetime fields. You can install it by following the instructions on
the [official website](https://flatpickr.js.org/getting-started/). If you encounter issues with loading the CSS file,
you can manually add it to your JS file:

```javascript
import 'flatpickr/dist/flatpickr.css';
```

**_Don't forget to make flatpickr globally accessible_**

```javascript
window.flatpickr = flatpickr;
```

You also need to install `momentjs` for date formatting:

```bash
npm install moment --save
```

**_Don't forget to make moment globally accessible_**

```javascript
window.flatpickr = flatpickr;
```

## Publishable Assets

You can publish the package's configuration, language files, and views using the following commands:

```bash
php artisan vendor:publish --tag=laragrid-config
php artisan vendor:publish --tag=laragrid-lang
php artisan vendor:publish --tag=laragrid-views
```

## Base Usage

### Creating a Grid

To create a grid, you need to extend the `BaseLaraGrid` class and implement the `getColumns` and `getDataSource`
methods.

```php
use BoredProgrammers\LaraGrid\Components\ColumnComponents\Column;use BoredProgrammers\LaraGrid\Livewire\BaseLaraGrid;use Illuminate\Database\Eloquent\Builder;

class MyGrid extends BaseLaraGrid
{
    protected function getColumns(): array
    {
        return [
            Column::make('id', 'ID'),
            Column::make('name', 'Name'),
            // Add more columns as needed
        ];
    }

    protected function getDataSource(): Builder
    {
        return MyModel::query();
    }
}
```

In the `getColumns` method, you define the columns that will be displayed in the grid. The `Column::make` method takes
two arguments: the model field and the label.

The `getDataSource` method should return an instance of `Illuminate\Database\Eloquent\Builder` for the model you want to
display in the grid.

### Displaying the Grid

To display the grid in a Blade view, you can use the `@livewire` or `<livewire>` directive:

```blade
@livewire('my-grid')
```

```blade
<livewire:my-grid/>
```

_Replace `'my-grid'` with the actual name of your Livewire component._

### Customizing the Theme

You can customize the appearance of the grid by extending the `BaseLaraGridTheme` class and overriding the methods that
return CSS classes:

```php
use BoredProgrammers\LaraGrid\Theme\BaseLaraGridTheme;

class MyTheme extends BaseLaraGridTheme
{
    public function getTable(): ?string
    {
        $this->setTable('')
            ->setThead('')
            ->setTr('')
            ->setTh('')
            ->setTbody('')
            ->setTd('')
            ->setGroupTd('')
            ->setActionContainer('')
            ->setPagination('')
            ->setFilterText('')
            ->setFilterSelect('')
            ->setFilterDate('')
            ->setActionButton('')
            ->setPaginationMaxResults('')
            ->setPaginationMaxResultsContainer('')
            ->setPaginationContainer('')
            ->setEmptyMessage('')
            ->setResetFilterButton('');
            // for more methods, check the BaseLaraGridTheme class
    }
```

Then, in your Livewire component, you can set the $theme property to your custom theme class:

```php
protected string $theme = MyTheme::class;
```

## Examples

```php
<?php

namespace App\Modules\Admin\Livewire\Grids;

use App\Enums\Transaction\TransactionStatus;use App\Models\Transaction;use App\Modules\Shared\Lib\Grids\BaseGrid;use BoredProgrammers\LaraGrid\Components\ColumnComponents\Column;use BoredProgrammers\LaraGrid\Filters\DateFilter;use BoredProgrammers\LaraGrid\Filters\SelectFilter;use BoredProgrammers\LaraGrid\Filters\TextFilter;use BoredProgrammers\LaraGrid\Themes\UiKitTheme;use Illuminate\Database\Eloquent\Builder;

class TransactionsGrid extends BaseGrid
{

    protected function getDataSource(): Builder
    {
        return Transaction::with([
            'to_user_account',
            'from_user_account',
            'to_currency',
            'created_by',
        ])->latest();
    }

    protected function getColumns(): array
    {
        return [
            Column::make('created_at', 'attributes.created_at')
                ->setFilter(DateFilter::make()),

            Column::make('created_by.email', 'attributes.created_by')
                ->setFilter(TextFilter::make()),

            Column::make('from_account', 'attributes.from_account')
                ->setSortable(false)
                ->setRenderer(fn(Transaction $transaction) => $transaction->getFormattedFromAccount())
                ->setFilter(
                    TextFilter::make()
                        ->setBuilder(fn($query, $field, $value) => $query->whereFromAccount($value))
                ),

            Column::make('to_account', 'attributes.to_account')
                ->setSortable(false)
                ->setRenderer(fn(Transaction $transaction) => $transaction->getFormattedToAccount())
                ->setFilter(TextFilter::make()),

            Column::make('money_amount', 'attributes.money_amount')
                ->setSortable(false)
                ->setRenderer(
                    fn(Transaction $transaction) => formatMoney($transaction->to_currency, $transaction->to_amount)
                )
                ->setFilter(TextFilter::make()),

            Column::make('status', 'attributes.status')
                ->setFilter(
                    SelectFilter::make()
                        ->setOptions(TransactionStatus::arrayForSelect()) // this will return an array of formatted enum values ['value' => 'label']
                ),
        ];
    }

}
```

```php
<?php

namespace App\Livewire\AdminModule\Grid;

use App\Models\User;use BoredProgrammers\LaraGrid\Components\ColumnComponents\ActionButton;use BoredProgrammers\LaraGrid\Components\ColumnComponents\Column;use BoredProgrammers\LaraGrid\Components\ColumnComponents\ColumnGroup;use BoredProgrammers\LaraGrid\Filters\DateFilter;use BoredProgrammers\LaraGrid\Filters\TextFilter;use Illuminate\Database\Eloquent\Builder;

class CustomersGrid extends BaseGrid
{

    protected function getDataSource(): Builder
    {
        return User::query();
    }

    protected function getColumns(): array
    {
        return [
            Column::make('email', 'attributes.email')
                ->setFilter(TextFilter::make()),

            Column::make('first_name', 'attributes.first_name')
                ->setFilter(TextFilter::make()),

            Column::make('last_name', 'attributes.last_name')
                ->setFilter(TextFilter::make()),

            Column::make('created_at', 'attributes.created_at')
                ->setFilter(DateFilter::make()),

            ColumnGroup::make('attributes.actions')
                ->setColumns([
                    ActionButton::make('attributes.detail')
                        ->setColumnTag('a')
                        ->setAttributes(function (User $userAccount) {
                            return [
                                'wire:click.prevent' => 'download(' . $userAccount->id . ')',
                            ];
                        }),
                    ActionButton::make('attributes.delete')
                        ->setColumnTag('a')
                        ->setAttributes(function (User $userAccount) {
                            return [
                                'wire:click.prevent' => 'download(' . $userAccount->id . ')',
                            ];
                        }),
                ]),
        ];
    }

    public function download($id)
    {
        dd($id);
    }

}
```

## Testing

To run the tests for the package, you can use the following command:

```bash
vendor/bin/phpunit
```

## Contribution Guidelines

We welcome contributions to LaraGrid. If you'd like to contribute, please fork the repository, make your changes, and
submit a pull request. We have a few requirements for contributions:

- Follow the PSR-2 coding standard.
- Write tests for new features and bug fixes.
- Only use pull requests for contributions.

## Changelog

For a detailed history of changes, see the [CHANGELOG.md](CHANGELOG.md) file.

## License

This project is licensed under the [MIT license](https://github.com/Bored-Programmers/laragrid/blob/main/LICENSE.md).

## Contact Information

For any questions or concerns, please feel free to create a discussion on GitHub.

## Acknowledgments

We would like to thank all the contributors who have helped to make LaraGrid a better package.