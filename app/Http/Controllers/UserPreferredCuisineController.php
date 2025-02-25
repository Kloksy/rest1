<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserPreferredCuisineRequest;
use App\Http\Requests\UpdateUserPreferredCuisineRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\UserPreferredCuisineRepository;
use Illuminate\Http\Request;
use Flash;

class UserPreferredCuisineController extends AppBaseController
{
    /** @var UserPreferredCuisineRepository $userPreferredCuisineRepository*/
    private $userPreferredCuisineRepository;

    public function __construct(UserPreferredCuisineRepository $userPreferredCuisineRepo)
    {
        $this->userPreferredCuisineRepository = $userPreferredCuisineRepo;
    }

    /**
     * Display a listing of the UserPreferredCuisine.
     */
    public function index(Request $request)
    {
        return view('user_preferred_cuisines.index');
    }

    /**
     * Show the form for creating a new UserPreferredCuisine.
     */
    public function create()
    {
        return view('user_preferred_cuisines.create');
    }

    /**
     * Store a newly created UserPreferredCuisine in storage.
     */
    public function store(CreateUserPreferredCuisineRequest $request)
    {
        $input = $request->all();

        $userPreferredCuisine = $this->userPreferredCuisineRepository->create($input);

        Flash::success('User Preferred Cuisine saved successfully.');

        return redirect(route('userPreferredCuisines.index'));
    }

    /**
     * Display the specified UserPreferredCuisine.
     */
    public function show($id)
    {
        $userPreferredCuisine = $this->userPreferredCuisineRepository->find($id);

        if (empty($userPreferredCuisine)) {
            Flash::error('User Preferred Cuisine not found');

            return redirect(route('userPreferredCuisines.index'));
        }

        return view('user_preferred_cuisines.show')->with('userPreferredCuisine', $userPreferredCuisine);
    }

    /**
     * Show the form for editing the specified UserPreferredCuisine.
     */
    public function edit($id)
    {
        $userPreferredCuisine = $this->userPreferredCuisineRepository->find($id);

        if (empty($userPreferredCuisine)) {
            Flash::error('User Preferred Cuisine not found');

            return redirect(route('userPreferredCuisines.index'));
        }

        return view('user_preferred_cuisines.edit')->with('userPreferredCuisine', $userPreferredCuisine);
    }

    /**
     * Update the specified UserPreferredCuisine in storage.
     */
    public function update($id, UpdateUserPreferredCuisineRequest $request)
    {
        $userPreferredCuisine = $this->userPreferredCuisineRepository->find($id);

        if (empty($userPreferredCuisine)) {
            Flash::error('User Preferred Cuisine not found');

            return redirect(route('userPreferredCuisines.index'));
        }

        $userPreferredCuisine = $this->userPreferredCuisineRepository->update($request->all(), $id);

        Flash::success('User Preferred Cuisine updated successfully.');

        return redirect(route('userPreferredCuisines.index'));
    }

    /**
     * Remove the specified UserPreferredCuisine from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $userPreferredCuisine = $this->userPreferredCuisineRepository->find($id);

        if (empty($userPreferredCuisine)) {
            Flash::error('User Preferred Cuisine not found');

            return redirect(route('userPreferredCuisines.index'));
        }

        $this->userPreferredCuisineRepository->delete($id);

        Flash::success('User Preferred Cuisine deleted successfully.');

        return redirect(route('userPreferredCuisines.index'));
    }
}
