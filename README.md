# LaraGrid

<img src="./resources/assets/img/logo.png" alt="LaraGrid Logo" height="500" width="750">

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
    - **[Detailed Class Documentation](docs/detailed-documentation.md)**
- [Examples](docs/examples.md)
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

## Publishable

You can publish the package's configuration, language files, and views using the following commands:

**_required_**

```bash
php artisan vendor:publish --tag=laragrid-assets
```

**_optional_**

```bash
php artisan vendor:publish --tag=laragrid-config
php artisan vendor:publish --tag=laragrid-lang
php artisan vendor:publish --tag=laragrid-views
```

## TODO List

1. [ ] Write tests for all functionality

## Base Usage

### Creating a Grid

To create a grid, you need to extend the `BaseLaraGrid` class and implement
the `getColumns`, and `getDataSource` methods.

```php
use BoredProgrammers\LaraGrid\Components\ColumnComponents\Column;
use BoredProgrammers\LaraGrid\Livewire\BaseLaraGrid;
use Illuminate\Database\Eloquent\Builder;
use BoredProgrammers\LaraGrid\Filters\FilterResetButton;

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

You can customize the appearance of the grid by extending the `BaseLaraGridTheme` class and setting the desired CSS.

```php
use BoredProgrammers\LaraGrid\Theme\BaseLaraGridTheme;
use BoredProgrammers\LaraGrid\Theme\FilterTheme;
use BoredProgrammers\LaraGrid\Theme\TBodyTheme;
use BoredProgrammers\LaraGrid\Theme\THeadTheme;

class MyTheme extends BaseLaraGridTheme
{

    public static function make(): static
    {
        $theme = new static();

        $theme->setTableClass('min-w-full table-auto');

        $theme->setTheadTheme(
            THeadTheme::make()
                ->setTheadClass('pb-4')
                ->setThClass('pb-3 px-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap')
        );

        $theme->setTbodyTheme(
            TBodyTheme::make()
                ->setEmptyMessageClass('text-white')
                ->setTdClass('whitespace-nowrap p-3 text-sm text-gray-500')
                ->setGroupTdClass('whitespace-nowrap flex items-center p-3 text-sm text-gray-500')

                ->setRecordTrClass(fn($record) => $record->role === 'admin' ? 'bg-red-500' : 'bg-white'); // you can also set a closure for record tr class. Pass a closure that returns a string class.
                ->setRecordTrClass('bg-white odd:bg-gray-100'); // If you don't want to set a closure, you can just pass a string class.
        );

        $theme->setFilterTheme(
            FilterTheme::make()
                ->setFilterTextClass('bg-white w-full rounded-xl border border-gray-300')
                ->setFilterSelectClass('bg-white w-full rounded-xl border border-gray-300')
                ->setFilterDateClass('bg-white w-full rounded-xl border border-gray-300')
        );
        
        // those are not all methods, you can find all of them in BaseLaraGridTheme, THeadTheme, TBodyTheme and FilterTheme classes

        return $theme;
    }
    
}

```

Then, in your grid class, you need to override the `getTheme` method and return an instance of your theme class.

```php
    protected function getTheme(): BaseLaraGridTheme
    {
        return MyTheme::make();
    }
```

By default, there is a theme called `TailwindTheme`. 

## Show filtering and sorting in url

If you want to show filtering and sorting in url, you need to rewrite default LaraGrid properties. You can do it like
this:

```php
abstract class MyBaseGrid extends BaseLaraGrid
{

    #[Url]
    public array $filter = [];

    #[Url(except: 'id')]
    public string $sortColumn = 'id';

    #[Url]
    public string $sortDirection = 'desc';

    protected function getFilterResetButton(): FilterResetButton
    {
        return FilterResetButton::make();
    }

    protected function getTheme(): BaseLaraGridTheme
    {
        return MyTheme::make();
    }

}
```

Those Url params are default from livewire, so you can customize them as you want by
following [livewire docs](https://livewire.laravel.com/docs/url#initializing-properties-from-the-url).

## Contribution Guidelines

We welcome contributions to LaraGrid. If you'd like to contribute, please fork the repository, make your changes, and
submit a pull request. We have a few requirements for contributions:

- Follow the PSR-2 coding standard.
- Write tests for new features and bug fixes.
- Only use pull requests for contributions.

## Changelog

For a detailed history of changes, see [releases](https://github.com/Bored-Programmers/laragrid/releases) on GitHub.

## License

This project is licensed under the [MIT license](https://github.com/Bored-Programmers/laragrid/blob/main/LICENSE.md).

## Contact Information

For any questions or concerns, please feel free to create
a [discussion](https://github.com/Bored-Programmers/laragrid/discussions) on GitHub.

## Credits

Created by [Matěj Černý](https://github.com/LeMatosDeFuk)
from [Bored Programmers](https://github.com/Bored-Programmers).

## Acknowledgments

We would like to thank all the contributors who have helped to make LaraGrid a better package.
