<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\UserPreference;

class UserPreferencesTable extends DataTableComponent
{
    protected $model = UserPreference::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        UserPreference::find($id)->delete();
        Flash::success('User Preference deleted successfully.');
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
            Column::make("Price Category", "price_category")
                ->sortable()
                ->searchable(),
            Column::make("Latitude", "latitude")
                ->sortable()
                ->searchable(),
            Column::make("Longitude", "longitude")
                ->sortable()
                ->searchable(),
            Column::make("Preferred Time From", "preferred_time_from")
                ->sortable()
                ->searchable(),
            Column::make("Preferred Time To", "preferred_time_to")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('user-preferences.show', $row->id),
                        'editUrl' => route('user-preferences.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
