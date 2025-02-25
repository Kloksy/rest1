<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\UserPreferredGeneralInfo;

class UserPreferredGeneralInfosTable extends DataTableComponent
{
    protected $model = UserPreferredGeneralInfo::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        UserPreferredGeneralInfo::find($id)->delete();
        Flash::success('User Preferred General Info deleted successfully.');
        $this->dispatch('refreshDatatable');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("General Info Id", "general_info_id")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('user-preferred-general-infos.show', $row->id),
                        'editUrl' => route('user-preferred-general-infos.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
