<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\YandexReview;

class YandexReviewsTable extends DataTableComponent
{
    protected $model = YandexReview::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        YandexReview::find($id)->delete();
        Flash::success('Yandex Review deleted successfully.');
        $this->dispatch('refreshDatatable');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("User Name", "user_name")
                ->sortable()
                ->searchable(),
            Column::make("Establishment Id", "establishment_id")
                ->sortable()
                ->searchable(),
            Column::make("Content", "content")
                ->sortable()
                ->searchable(),
            Column::make("Rating", "rating")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('yandex-reviews.show', $row->id),
                        'editUrl' => route('yandex-reviews.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
