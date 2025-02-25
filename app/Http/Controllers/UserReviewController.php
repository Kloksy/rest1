<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserReviewRequest;
use App\Http\Requests\UpdateUserReviewRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\UserReviewRepository;
use Illuminate\Http\Request;
use Flash;

class UserReviewController extends AppBaseController
{
    /** @var UserReviewRepository $userReviewRepository*/
    private $userReviewRepository;

    public function __construct(UserReviewRepository $userReviewRepo)
    {
        $this->userReviewRepository = $userReviewRepo;
    }

    /**
     * Display a listing of the UserReview.
     */
    public function index(Request $request)
    {
        return view('user_reviews.index');
    }

    /**
     * Show the form for creating a new UserReview.
     */
    public function create()
    {
        return view('user_reviews.create');
    }

    /**
     * Store a newly created UserReview in storage.
     */
    public function store(CreateUserReviewRequest $request)
    {
        $input = $request->all();

        $userReview = $this->userReviewRepository->create($input);

        Flash::success('User Review saved successfully.');

        return redirect(route('userReviews.index'));
    }

    /**
     * Display the specified UserReview.
     */
    public function show($id)
    {
        $userReview = $this->userReviewRepository->find($id);

        if (empty($userReview)) {
            Flash::error('User Review not found');

            return redirect(route('userReviews.index'));
        }

        return view('user_reviews.show')->with('userReview', $userReview);
    }

    /**
     * Show the form for editing the specified UserReview.
     */
    public function edit($id)
    {
        $userReview = $this->userReviewRepository->find($id);

        if (empty($userReview)) {
            Flash::error('User Review not found');

            return redirect(route('userReviews.index'));
        }

        return view('user_reviews.edit')->with('userReview', $userReview);
    }

    /**
     * Update the specified UserReview in storage.
     */
    public function update($id, UpdateUserReviewRequest $request)
    {
        $userReview = $this->userReviewRepository->find($id);

        if (empty($userReview)) {
            Flash::error('User Review not found');

            return redirect(route('userReviews.index'));
        }

        $userReview = $this->userReviewRepository->update($request->all(), $id);

        Flash::success('User Review updated successfully.');

        return redirect(route('userReviews.index'));
    }

    /**
     * Remove the specified UserReview from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $userReview = $this->userReviewRepository->find($id);

        if (empty($userReview)) {
            Flash::error('User Review not found');

            return redirect(route('userReviews.index'));
        }

        $this->userReviewRepository->delete($id);

        Flash::success('User Review deleted successfully.');

        return redirect(route('userReviews.index'));
    }
}
