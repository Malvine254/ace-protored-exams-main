<?php

namespace App\Livewire\Tables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class UsersTable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        return User::query()->where('email', '!=', config('constants.super_admin_email'));
        // ->with() // Eager load anything
        // ->join() // Join some tables
        // ->select(); // Select some things
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable(),
            Column::make("Email", "email")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
            LinkColumn::make('Action')
                ->title(fn($row) => 'Send Email')
                ->location(fn($row) => 'mailto:' . $row->email)
                ->attributes(fn($row) => [
                    'class' => '!text-blue-700 uppercase font-bold tracking-wider',
                ]),
            LinkColumn::make('View')
                ->title(fn($row) => 'View Details')
                ->location(fn($row) => route('admin.users.details', $row->id))
                ->attributes(fn($row) => [
                    'class' => '!text-blue-700 uppercase font-bold tracking-wider',
                ]),
        ];
    }
}
