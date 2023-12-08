# Examples

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