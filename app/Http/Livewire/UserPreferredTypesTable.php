<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\UserPreferredType;

class UserPreferredTypesTable extends DataTableComponent
{
    protected $model = UserPreferredType::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        UserPreferredType::find($id)->delete();
        Flash::success('User Preferred Type deleted successfully.');
        $this->dispatch('refreshDatatable');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Type Id", "type_id")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('user-preferred-types.show', $row->id),
                        'editUrl' => route('user-preferred-types.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
