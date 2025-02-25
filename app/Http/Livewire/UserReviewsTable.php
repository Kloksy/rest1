<?php

namespace App\Http\Livewire;

use Laracasts\Flash\Flash;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\UserReview;

class UserReviewsTable extends DataTableComponent
{
    protected $model = UserReview::class;

    protected $listeners = ['deleteRecord' => 'deleteRecord'];

    public function deleteRecord($id)
    {
        UserReview::find($id)->delete();
        Flash::success('User Review deleted successfully.');
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
            Column::make("Content", "content")
                ->sortable()
                ->searchable(),
            Column::make("Rating", "rating")
                ->sortable()
                ->searchable(),
            Column::make("Actions", 'id')
                ->format(
                    fn($value, $row, Column $column) => view('common.livewire-tables.actions', [
                        'showUrl' => route('user-reviews.show', $row->id),
                        'editUrl' => route('user-reviews.edit', $row->id),
                        'recordId' => $row->id,
                    ])
                )
        ];
    }
}
