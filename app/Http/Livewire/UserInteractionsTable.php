<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\UserInteraction;

class UserInteractionsTable extends DataTableComponent
{
    protected $model = UserInteraction::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        UserInteraction::find($id)->delete();
        Flash::success('User Interaction deleted successfully.');
        $this->dispatch('refreshDatatable');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("User Id", "user_id")
                ->sortable()
                ->searchable(),
            Column::make("Establishment Id", "establishment_id")
                ->sortable()
                ->searchable(),
            Column::make("Review Id", "review_id")
                ->sortable()
                ->searchable(),
            Column::make("Viewed At", "viewed_at")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('user-interactions.show', $row->id),
                        'editUrl' => route('user-interactions.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
