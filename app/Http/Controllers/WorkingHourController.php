<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateWorkingHourRequest;
use App\Http\Requests\UpdateWorkingHourRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\WorkingHourRepository;
use Illuminate\Http\Request;
use Flash;

class WorkingHourController extends AppBaseController
{
    /** @var WorkingHourRepository $workingHourRepository*/
    private $workingHourRepository;

    public function __construct(WorkingHourRepository $workingHourRepo)
    {
        $this->workingHourRepository = $workingHourRepo;
    }

    /**
     * Display a listing of the WorkingHour.
     */
    public function index(Request $request)
    {
        return view('working_hours.index');
    }

    /**
     * Show the form for creating a new WorkingHour.
     */
    public function create()
    {
        return view('working_hours.create');
    }

    /**
     * Store a newly created WorkingHour in storage.
     */
    public function store(CreateWorkingHourRequest $request)
    {
        $input = $request->all();

        $workingHour = $this->workingHourRepository->create($input);

        Flash::success('Working Hour saved successfully.');

        return redirect(route('workingHours.index'));
    }

    /**
     * Display the specified WorkingHour.
     */
    public function show($id)
    {
        $workingHour = $this->workingHourRepository->find($id);

        if (empty($workingHour)) {
            Flash::error('Working Hour not found');

            return redirect(route('workingHours.index'));
        }

        return view('working_hours.show')->with('workingHour', $workingHour);
    }

    /**
     * Show the form for editing the specified WorkingHour.
     */
    public function edit($id)
    {
        $workingHour = $this->workingHourRepository->find($id);

        if (empty($workingHour)) {
            Flash::error('Working Hour not found');

            return redirect(route('workingHours.index'));
        }

        return view('working_hours.edit')->with('workingHour', $workingHour);
    }

    /**
     * Update the specified WorkingHour in storage.
     */
    public function update($id, UpdateWorkingHourRequest $request)
    {
        $workingHour = $this->workingHourRepository->find($id);

        if (empty($workingHour)) {
            Flash::error('Working Hour not found');

            return redirect(route('workingHours.index'));
        }

        $workingHour = $this->workingHourRepository->update($request->all(), $id);

        Flash::success('Working Hour updated successfully.');

        return redirect(route('workingHours.index'));
    }

    /**
     * Remove the specified WorkingHour from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $workingHour = $this->workingHourRepository->find($id);

        if (empty($workingHour)) {
            Flash::error('Working Hour not found');

            return redirect(route('workingHours.index'));
        }

        $this->workingHourRepository->delete($id);

        Flash::success('Working Hour deleted successfully.');

        return redirect(route('workingHours.index'));
    }
}
