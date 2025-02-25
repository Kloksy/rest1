<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCuisineRequest;
use App\Http\Requests\UpdateCuisineRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\CuisineRepository;
use Illuminate\Http\Request;
use Flash;

class CuisineController extends AppBaseController
{
    /** @var CuisineRepository $cuisineRepository*/
    private $cuisineRepository;

    public function __construct(CuisineRepository $cuisineRepo)
    {
        $this->cuisineRepository = $cuisineRepo;
    }

    /**
     * Display a listing of the Cuisine.
     */
    public function index(Request $request)
    {
        return view('cuisines.index');
    }

    /**
     * Show the form for creating a new Cuisine.
     */
    public function create()
    {
        return view('cuisines.create');
    }

    /**
     * Store a newly created Cuisine in storage.
     */
    public function store(CreateCuisineRequest $request)
    {
        $input = $request->all();

        $cuisine = $this->cuisineRepository->create($input);

        Flash::success('Cuisine saved successfully.');

        return redirect(route('cuisines.index'));
    }

    /**
     * Display the specified Cuisine.
     */
    public function show($id)
    {
        $cuisine = $this->cuisineRepository->find($id);

        if (empty($cuisine)) {
            Flash::error('Cuisine not found');

            return redirect(route('cuisines.index'));
        }

        return view('cuisines.show')->with('cuisine', $cuisine);
    }

    /**
     * Show the form for editing the specified Cuisine.
     */
    public function edit($id)
    {
        $cuisine = $this->cuisineRepository->find($id);

        if (empty($cuisine)) {
            Flash::error('Cuisine not found');

            return redirect(route('cuisines.index'));
        }

        return view('cuisines.edit')->with('cuisine', $cuisine);
    }

    /**
     * Update the specified Cuisine in storage.
     */
    public function update($id, UpdateCuisineRequest $request)
    {
        $cuisine = $this->cuisineRepository->find($id);

        if (empty($cuisine)) {
            Flash::error('Cuisine not found');

            return redirect(route('cuisines.index'));
        }

        $cuisine = $this->cuisineRepository->update($request->all(), $id);

        Flash::success('Cuisine updated successfully.');

        return redirect(route('cuisines.index'));
    }

    /**
     * Remove the specified Cuisine from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $cuisine = $this->cuisineRepository->find($id);

        if (empty($cuisine)) {
            Flash::error('Cuisine not found');

            return redirect(route('cuisines.index'));
        }

        $this->cuisineRepository->delete($id);

        Flash::success('Cuisine deleted successfully.');

        return redirect(route('cuisines.index'));
    }
}
