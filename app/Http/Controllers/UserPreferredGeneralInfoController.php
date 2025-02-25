<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserPreferredGeneralInfoRequest;
use App\Http\Requests\UpdateUserPreferredGeneralInfoRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\UserPreferredGeneralInfoRepository;
use Illuminate\Http\Request;
use Flash;

class UserPreferredGeneralInfoController extends AppBaseController
{
    /** @var UserPreferredGeneralInfoRepository $userPreferredGeneralInfoRepository*/
    private $userPreferredGeneralInfoRepository;

    public function __construct(UserPreferredGeneralInfoRepository $userPreferredGeneralInfoRepo)
    {
        $this->userPreferredGeneralInfoRepository = $userPreferredGeneralInfoRepo;
    }

    /**
     * Display a listing of the UserPreferredGeneralInfo.
     */
    public function index(Request $request)
    {
        return view('user_preferred_general_infos.index');
    }

    /**
     * Show the form for creating a new UserPreferredGeneralInfo.
     */
    public function create()
    {
        return view('user_preferred_general_infos.create');
    }

    /**
     * Store a newly created UserPreferredGeneralInfo in storage.
     */
    public function store(CreateUserPreferredGeneralInfoRequest $request)
    {
        $input = $request->all();

        $userPreferredGeneralInfo = $this->userPreferredGeneralInfoRepository->create($input);

        Flash::success('User Preferred General Info saved successfully.');

        return redirect(route('userPreferredGeneralInfos.index'));
    }

    /**
     * Display the specified UserPreferredGeneralInfo.
     */
    public function show($id)
    {
        $userPreferredGeneralInfo = $this->userPreferredGeneralInfoRepository->find($id);

        if (empty($userPreferredGeneralInfo)) {
            Flash::error('User Preferred General Info not found');

            return redirect(route('userPreferredGeneralInfos.index'));
        }

        return view('user_preferred_general_infos.show')->with('userPreferredGeneralInfo', $userPreferredGeneralInfo);
    }

    /**
     * Show the form for editing the specified UserPreferredGeneralInfo.
     */
    public function edit($id)
    {
        $userPreferredGeneralInfo = $this->userPreferredGeneralInfoRepository->find($id);

        if (empty($userPreferredGeneralInfo)) {
            Flash::error('User Preferred General Info not found');

            return redirect(route('userPreferredGeneralInfos.index'));
        }

        return view('user_preferred_general_infos.edit')->with('userPreferredGeneralInfo', $userPreferredGeneralInfo);
    }

    /**
     * Update the specified UserPreferredGeneralInfo in storage.
     */
    public function update($id, UpdateUserPreferredGeneralInfoRequest $request)
    {
        $userPreferredGeneralInfo = $this->userPreferredGeneralInfoRepository->find($id);

        if (empty($userPreferredGeneralInfo)) {
            Flash::error('User Preferred General Info not found');

            return redirect(route('userPreferredGeneralInfos.index'));
        }

        $userPreferredGeneralInfo = $this->userPreferredGeneralInfoRepository->update($request->all(), $id);

        Flash::success('User Preferred General Info updated successfully.');

        return redirect(route('userPreferredGeneralInfos.index'));
    }

    /**
     * Remove the specified UserPreferredGeneralInfo from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $userPreferredGeneralInfo = $this->userPreferredGeneralInfoRepository->find($id);

        if (empty($userPreferredGeneralInfo)) {
            Flash::error('User Preferred General Info not found');

            return redirect(route('userPreferredGeneralInfos.index'));
        }

        $this->userPreferredGeneralInfoRepository->delete($id);

        Flash::success('User Preferred General Info deleted successfully.');

        return redirect(route('userPreferredGeneralInfos.index'));
    }
}
