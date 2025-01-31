<?php

namespace App\Livewire\Tables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class OrdersTable extends DataTableComponent
{
    protected $model = Order::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Status')
                ->options([
                    'paid' => 'paid',
                    'pending' => 'pending',
                    'cancelled' => 'cancelled',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('status', $value);
                }),
        ];
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Status", "status")
                ->sortable(),
            // Column::make("Payment method", "payment_method")
            //     ->sortable(),
            // Column::make("Stripe id", "stripe_id")
            //     ->sortable(),
            // Column::make("Stripe checkout url", "stripe_checkout_url")
            //     ->sortable(),
            // Column::make("Paid at", "paid_at")
            //     ->sortable(),
            // Column::make("Source", "source")
            //     ->sortable(),
            Column::make("Customer name", "customer_name")
                ->sortable(),
            Column::make("Customer email", "customer_email")
                ->sortable(),
            // Column::make("Email sent", "email_sent")
            //     ->sortable(),
            // Column::make("User id", "user_id")
            //     ->sortable(),
            Column::make("Total amount", "total_amount")
                ->sortable(),
            // Column::make("Products", "products")
            //     ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            // Column::make("Updated at", "updated_at")
            //     ->sortable(),
            LinkColumn::make('View')
                ->title(fn($row) => 'Details')
                ->location(fn($row) => route('admin.orders.details', $row->id))
                ->attributes(fn($row) => [
                    'class' => '!text-blue-700 uppercase font-bold tracking-wider',
                ]),
        ];
    }
}
