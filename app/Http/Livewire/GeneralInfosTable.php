<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\GeneralInfo;

class GeneralInfosTable extends DataTableComponent
{
    protected $model = GeneralInfo::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        GeneralInfo::find($id)->delete();
        Flash::success('General Info deleted successfully.');
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
                        'showUrl' => route('general-infos.show', $row->id),
                        'editUrl' => route('general-infos.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
