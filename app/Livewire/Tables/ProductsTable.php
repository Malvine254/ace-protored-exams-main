<?php

namespace App\Livewire\Tables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Product;
use Illuminate\Database\Query\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class ProductsTable extends DataTableComponent
{
    protected $model = Product::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable(),
            // Column::make("Description", "description")
            //     ->sortable(),
            Column::make("Price", "price")
                ->sortable(),
            // Column::make("Download link", "download_link")
            //     ->sortable(),
            // Column::make("Slug", "slug")
            //     ->sortable(),
            // Column::make("Categories", "categories")
            //     ->sortable(),
            // Column::make("Tags", "tags")
            //     ->sortable(),
            // Column::make("In stock", "in_stock")
            //     ->sortable(),
            // Column::make("Images", "images")
            //     ->sortable(),
            Column::make("Type", "type")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            // Column::make("Updated at", "updated_at")
            //     ->sortable(),
            LinkColumn::make('View')
                ->title(fn($row) => 'Details')
                ->location(fn($row) => route('admin.products.edit', $row->id))
                ->attributes(fn($row) => [
                    'class' => '!text-blue-700 uppercase font-bold tracking-wider',
                ]),
        ];
    }
}
