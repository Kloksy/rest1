<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEstablishmentTypeRequest;
use App\Http\Requests\UpdateEstablishmentTypeRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\EstablishmentTypeRepository;
use Illuminate\Http\Request;
use Flash;

class EstablishmentTypeController extends AppBaseController
{
    /** @var EstablishmentTypeRepository $establishmentTypeRepository*/
    private $establishmentTypeRepository;

    public function __construct(EstablishmentTypeRepository $establishmentTypeRepo)
    {
        $this->establishmentTypeRepository = $establishmentTypeRepo;
    }

    /**
     * Display a listing of the EstablishmentType.
     */
    public function index(Request $request)
    {
        return view('establishment_types.index');
    }

    /**
     * Show the form for creating a new EstablishmentType.
     */
    public function create()
    {
        return view('establishment_types.create');
    }

    /**
     * Store a newly created EstablishmentType in storage.
     */
    public function store(CreateEstablishmentTypeRequest $request)
    {
        $input = $request->all();

        $establishmentType = $this->establishmentTypeRepository->create($input);

        Flash::success('Establishment Type saved successfully.');

        return redirect(route('establishmentTypes.index'));
    }

    /**
     * Display the specified EstablishmentType.
     */
    public function show($id)
    {
        $establishmentType = $this->establishmentTypeRepository->find($id);

        if (empty($establishmentType)) {
            Flash::error('Establishment Type not found');

            return redirect(route('establishmentTypes.index'));
        }

        return view('establishment_types.show')->with('establishmentType', $establishmentType);
    }

    /**
     * Show the form for editing the specified EstablishmentType.
     */
    public function edit($id)
    {
        $establishmentType = $this->establishmentTypeRepository->find($id);

        if (empty($establishmentType)) {
            Flash::error('Establishment Type not found');

            return redirect(route('establishmentTypes.index'));
        }

        return view('establishment_types.edit')->with('establishmentType', $establishmentType);
    }

    /**
     * Update the specified EstablishmentType in storage.
     */
    public function update($id, UpdateEstablishmentTypeRequest $request)
    {
        $establishmentType = $this->establishmentTypeRepository->find($id);

        if (empty($establishmentType)) {
            Flash::error('Establishment Type not found');

            return redirect(route('establishmentTypes.index'));
        }

        $establishmentType = $this->establishmentTypeRepository->update($request->all(), $id);

        Flash::success('Establishment Type updated successfully.');

        return redirect(route('establishmentTypes.index'));
    }

    /**
     * Remove the specified EstablishmentType from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $establishmentType = $this->establishmentTypeRepository->find($id);

        if (empty($establishmentType)) {
            Flash::error('Establishment Type not found');

            return redirect(route('establishmentTypes.index'));
        }

        $this->establishmentTypeRepository->delete($id);

        Flash::success('Establishment Type deleted successfully.');

        return redirect(route('establishmentTypes.index'));
    }
}
