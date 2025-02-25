<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateYandexReviewRequest;
use App\Http\Requests\UpdateYandexReviewRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\YandexReviewRepository;
use Illuminate\Http\Request;
use Flash;

class YandexReviewController extends AppBaseController
{
    /** @var YandexReviewRepository $yandexReviewRepository*/
    private $yandexReviewRepository;

    public function __construct(YandexReviewRepository $yandexReviewRepo)
    {
        $this->yandexReviewRepository = $yandexReviewRepo;
    }

    /**
     * Display a listing of the YandexReview.
     */
    public function index(Request $request)
    {
        return view('yandex_reviews.index');
    }

    /**
     * Show the form for creating a new YandexReview.
     */
    public function create()
    {
        return view('yandex_reviews.create');
    }

    /**
     * Store a newly created YandexReview in storage.
     */
    public function store(CreateYandexReviewRequest $request)
    {
        $input = $request->all();

        $yandexReview = $this->yandexReviewRepository->create($input);

        Flash::success('Yandex Review saved successfully.');

        return redirect(route('yandexReviews.index'));
    }

    /**
     * Display the specified YandexReview.
     */
    public function show($id)
    {
        $yandexReview = $this->yandexReviewRepository->find($id);

        if (empty($yandexReview)) {
            Flash::error('Yandex Review not found');

            return redirect(route('yandexReviews.index'));
        }

        return view('yandex_reviews.show')->with('yandexReview', $yandexReview);
    }

    /**
     * Show the form for editing the specified YandexReview.
     */
    public function edit($id)
    {
        $yandexReview = $this->yandexReviewRepository->find($id);

        if (empty($yandexReview)) {
            Flash::error('Yandex Review not found');

            return redirect(route('yandexReviews.index'));
        }

        return view('yandex_reviews.edit')->with('yandexReview', $yandexReview);
    }

    /**
     * Update the specified YandexReview in storage.
     */
    public function update($id, UpdateYandexReviewRequest $request)
    {
        $yandexReview = $this->yandexReviewRepository->find($id);

        if (empty($yandexReview)) {
            Flash::error('Yandex Review not found');

            return redirect(route('yandexReviews.index'));
        }

        $yandexReview = $this->yandexReviewRepository->update($request->all(), $id);

        Flash::success('Yandex Review updated successfully.');

        return redirect(route('yandexReviews.index'));
    }

    /**
     * Remove the specified YandexReview from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $yandexReview = $this->yandexReviewRepository->find($id);

        if (empty($yandexReview)) {
            Flash::error('Yandex Review not found');

            return redirect(route('yandexReviews.index'));
        }

        $this->yandexReviewRepository->delete($id);

        Flash::success('Yandex Review deleted successfully.');

        return redirect(route('yandexReviews.index'));
    }
}
