<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGeneralInfoRequest;
use App\Http\Requests\UpdateGeneralInfoRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\GeneralInfoRepository;
use Illuminate\Http\Request;
use Flash;

class GeneralInfoController extends AppBaseController
{
    /** @var GeneralInfoRepository $generalInfoRepository*/
    private $generalInfoRepository;

    public function __construct(GeneralInfoRepository $generalInfoRepo)
    {
        $this->generalInfoRepository = $generalInfoRepo;
    }

    /**
     * Display a listing of the GeneralInfo.
     */
    public function index(Request $request)
    {
        return view('general_infos.index');
    }

    /**
     * Show the form for creating a new GeneralInfo.
     */
    public function create()
    {
        return view('general_infos.create');
    }

    /**
     * Store a newly created GeneralInfo in storage.
     */
    public function store(CreateGeneralInfoRequest $request)
    {
        $input = $request->all();

        $generalInfo = $this->generalInfoRepository->create($input);

        Flash::success('General Info saved successfully.');

        return redirect(route('generalInfos.index'));
    }

    /**
     * Display the specified GeneralInfo.
     */
    public function show($id)
    {
        $generalInfo = $this->generalInfoRepository->find($id);

        if (empty($generalInfo)) {
            Flash::error('General Info not found');

            return redirect(route('generalInfos.index'));
        }

        return view('general_infos.show')->with('generalInfo', $generalInfo);
    }

    /**
     * Show the form for editing the specified GeneralInfo.
     */
    public function edit($id)
    {
        $generalInfo = $this->generalInfoRepository->find($id);

        if (empty($generalInfo)) {
            Flash::error('General Info not found');

            return redirect(route('generalInfos.index'));
        }

        return view('general_infos.edit')->with('generalInfo', $generalInfo);
    }

    /**
     * Update the specified GeneralInfo in storage.
     */
    public function update($id, UpdateGeneralInfoRequest $request)
    {
        $generalInfo = $this->generalInfoRepository->find($id);

        if (empty($generalInfo)) {
            Flash::error('General Info not found');

            return redirect(route('generalInfos.index'));
        }

        $generalInfo = $this->generalInfoRepository->update($request->all(), $id);

        Flash::success('General Info updated successfully.');

        return redirect(route('generalInfos.index'));
    }

    /**
     * Remove the specified GeneralInfo from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $generalInfo = $this->generalInfoRepository->find($id);

        if (empty($generalInfo)) {
            Flash::error('General Info not found');

            return redirect(route('generalInfos.index'));
        }

        $this->generalInfoRepository->delete($id);

        Flash::success('General Info deleted successfully.');

        return redirect(route('generalInfos.index'));
    }
}
