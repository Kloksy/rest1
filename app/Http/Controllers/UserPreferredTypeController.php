<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserPreferredTypeRequest;
use App\Http\Requests\UpdateUserPreferredTypeRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\UserPreferredTypeRepository;
use Illuminate\Http\Request;
use Flash;

class UserPreferredTypeController extends AppBaseController
{
    /** @var UserPreferredTypeRepository $userPreferredTypeRepository*/
    private $userPreferredTypeRepository;

    public function __construct(UserPreferredTypeRepository $userPreferredTypeRepo)
    {
        $this->userPreferredTypeRepository = $userPreferredTypeRepo;
    }

    /**
     * Display a listing of the UserPreferredType.
     */
    public function index(Request $request)
    {
        return view('user_preferred_types.index');
    }

    /**
     * Show the form for creating a new UserPreferredType.
     */
    public function create()
    {
        return view('user_preferred_types.create');
    }

    /**
     * Store a newly created UserPreferredType in storage.
     */
    public function store(CreateUserPreferredTypeRequest $request)
    {
        $input = $request->all();

        $userPreferredType = $this->userPreferredTypeRepository->create($input);

        Flash::success('User Preferred Type saved successfully.');

        return redirect(route('userPreferredTypes.index'));
    }

    /**
     * Display the specified UserPreferredType.
     */
    public function show($id)
    {
        $userPreferredType = $this->userPreferredTypeRepository->find($id);

        if (empty($userPreferredType)) {
            Flash::error('User Preferred Type not found');

            return redirect(route('userPreferredTypes.index'));
        }

        return view('user_preferred_types.show')->with('userPreferredType', $userPreferredType);
    }

    /**
     * Show the form for editing the specified UserPreferredType.
     */
    public function edit($id)
    {
        $userPreferredType = $this->userPreferredTypeRepository->find($id);

        if (empty($userPreferredType)) {
            Flash::error('User Preferred Type not found');

            return redirect(route('userPreferredTypes.index'));
        }

        return view('user_preferred_types.edit')->with('userPreferredType', $userPreferredType);
    }

    /**
     * Update the specified UserPreferredType in storage.
     */
    public function update($id, UpdateUserPreferredTypeRequest $request)
    {
        $userPreferredType = $this->userPreferredTypeRepository->find($id);

        if (empty($userPreferredType)) {
            Flash::error('User Preferred Type not found');

            return redirect(route('userPreferredTypes.index'));
        }

        $userPreferredType = $this->userPreferredTypeRepository->update($request->all(), $id);

        Flash::success('User Preferred Type updated successfully.');

        return redirect(route('userPreferredTypes.index'));
    }

    /**
     * Remove the specified UserPreferredType from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $userPreferredType = $this->userPreferredTypeRepository->find($id);

        if (empty($userPreferredType)) {
            Flash::error('User Preferred Type not found');

            return redirect(route('userPreferredTypes.index'));
        }

        $this->userPreferredTypeRepository->delete($id);

        Flash::success('User Preferred Type deleted successfully.');

        return redirect(route('userPreferredTypes.index'));
    }
}
