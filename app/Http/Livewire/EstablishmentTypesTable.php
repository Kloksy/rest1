<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\EstablishmentType;

class EstablishmentTypesTable extends DataTableComponent
{
    protected $model = EstablishmentType::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        EstablishmentType::find($id)->delete();
        Flash::success('Establishment Type deleted successfully.');
        $this->dispatch('refreshDatatable');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Name", "name")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('establishment-types.show', $row->id),
                        'editUrl' => route('establishment-types.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
