<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Establishment;

class EstablishmentsTable extends DataTableComponent
{
    protected $model = Establishment::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        Establishment::find($id)->delete();
        Flash::success('Establishment deleted successfully.');
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
            Column::make("Type Id", "type_id")
                ->sortable()
                ->searchable(),
            Column::make("Average Bill", "average_bill")
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
            Column::make("Address", "address")
                ->sortable()
                ->searchable(),
            Column::make("Rating", "rating")
                ->sortable()
                ->searchable(),
            Column::make("Reviews Count", "reviews_count")
                ->sortable()
                ->searchable(),
            Column::make("Logo Url", "logo_url")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('establishments.show', $row->id),
                        'editUrl' => route('establishments.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
