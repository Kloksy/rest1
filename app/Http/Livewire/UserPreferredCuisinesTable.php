<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\UserPreferredCuisine;

class UserPreferredCuisinesTable extends DataTableComponent
{
    protected $model = UserPreferredCuisine::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        UserPreferredCuisine::find($id)->delete();
        Flash::success('User Preferred Cuisine deleted successfully.');
        $this->dispatch('refreshDatatable');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Cuisine Id", "cuisine_id")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('user-preferred-cuisines.show', $row->id),
                        'editUrl' => route('user-preferred-cuisines.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
