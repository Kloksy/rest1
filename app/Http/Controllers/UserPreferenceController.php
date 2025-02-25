<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserPreferenceRequest;
use App\Http\Requests\UpdateUserPreferenceRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\UserPreferenceRepository;
use Illuminate\Http\Request;
use Flash;

class UserPreferenceController extends AppBaseController
{
    /** @var UserPreferenceRepository $userPreferenceRepository*/
    private $userPreferenceRepository;

    public function __construct(UserPreferenceRepository $userPreferenceRepo)
    {
        $this->userPreferenceRepository = $userPreferenceRepo;
    }

    /**
     * Display a listing of the UserPreference.
     */
    public function index(Request $request)
    {
        return view('user_preferences.index');
    }

    /**
     * Show the form for creating a new UserPreference.
     */
    public function create()
    {
        return view('user_preferences.create');
    }

    /**
     * Store a newly created UserPreference in storage.
     */
    public function store(CreateUserPreferenceRequest $request)
    {
        $input = $request->all();

        $userPreference = $this->userPreferenceRepository->create($input);

        Flash::success('User Preference saved successfully.');

        return redirect(route('userPreferences.index'));
    }

    /**
     * Display the specified UserPreference.
     */
    public function show($id)
    {
        $userPreference = $this->userPreferenceRepository->find($id);

        if (empty($userPreference)) {
            Flash::error('User Preference not found');

            return redirect(route('userPreferences.index'));
        }

        return view('user_preferences.show')->with('userPreference', $userPreference);
    }

    /**
     * Show the form for editing the specified UserPreference.
     */
    public function edit($id)
    {
        $userPreference = $this->userPreferenceRepository->find($id);

        if (empty($userPreference)) {
            Flash::error('User Preference not found');

            return redirect(route('userPreferences.index'));
        }

        return view('user_preferences.edit')->with('userPreference', $userPreference);
    }

    /**
     * Update the specified UserPreference in storage.
     */
    public function update($id, UpdateUserPreferenceRequest $request)
    {
        $userPreference = $this->userPreferenceRepository->find($id);

        if (empty($userPreference)) {
            Flash::error('User Preference not found');

            return redirect(route('userPreferences.index'));
        }

        $userPreference = $this->userPreferenceRepository->update($request->all(), $id);

        Flash::success('User Preference updated successfully.');

        return redirect(route('userPreferences.index'));
    }

    /**
     * Remove the specified UserPreference from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $userPreference = $this->userPreferenceRepository->find($id);

        if (empty($userPreference)) {
            Flash::error('User Preference not found');

            return redirect(route('userPreferences.index'));
        }

        $this->userPreferenceRepository->delete($id);

        Flash::success('User Preference deleted successfully.');

        return redirect(route('userPreferences.index'));
    }
}
