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
    - **[Detailed Class Documentation](docs/detailed-documentation.md)**
- [Examples](docs/examples.md)
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

You can customize the appearance of the grid by extending the `BaseLaraGridTheme` class and setting the desired CSS.

```php
use BoredProgrammers\LaraGrid\Theme\BaseLaraGridTheme;
use Illuminate\Database\Eloquent\Model;

class MyTheme extends BaseLaraGridTheme
{

    public static function make(): static
    {
        $theme = new static();

        $theme->setTableClass('');
        $theme->setFilterResetButtonClass('');
        $theme->setTheadClass('');
        $theme->setTrClass('');
        $theme->setFilterTrClass('');
        $theme->setThClass('');
        $theme->setTbodyClass('');
        $theme->setTdClass('');
        $theme->setGroupTdClass('');
        $theme->setActionContainerClass('');
        $theme->setPaginationClass('');
        $theme->setFilterTextClass('');
        $theme->setFilterSelectClass('');
        $theme->setFilterDateClass('');
        $theme->setActionButtonClass('');
        $theme->setPaginationMaxResultsClass('');
        
        $theme->setFilterResetButtonRenderer(fn() => view('test')); // you can also set renderer for filter reset button. Pass a closure that returns a whatever you want -> string, view, etc.

        $theme->setRecordTrClass(fn(Model $model) => $model->role === 'admin' ? 'bg-red-500' : 'bg-white'); // you can also set a closure for record tr class. Pass a closure that returns a string class.
        $theme->setRecordTrClass('bg-gray-100'); // If you don't want to set a closure, you can just pass a string class.

        // for more methods, check the BaseLaraGridTheme class

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
