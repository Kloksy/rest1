<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\WorkingHour;

class WorkingHoursTable extends DataTableComponent
{
    protected $model = WorkingHour::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        WorkingHour::find($id)->delete();
        Flash::success('Working Hour deleted successfully.');
        $this->dispatch('refreshDatatable');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Establishment Id", "establishment_id")
                ->sortable()
                ->searchable(),
            Column::make("Day", "day")
                ->sortable()
                ->searchable(),
            Column::make("Hours", "hours")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('working-hours.show', $row->id),
                        'editUrl' => route('working-hours.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
