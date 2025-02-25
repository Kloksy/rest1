<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEstablishmentRequest;
use App\Http\Requests\UpdateEstablishmentRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\EstablishmentRepository;
use Illuminate\Http\Request;
use Flash;

class EstablishmentController extends AppBaseController
{
    /** @var EstablishmentRepository $establishmentRepository*/
    private $establishmentRepository;

    public function __construct(EstablishmentRepository $establishmentRepo)
    {
        $this->establishmentRepository = $establishmentRepo;
    }

    /**
     * Display a listing of the Establishment.
     */
    public function index(Request $request)
    {
        return view('establishments.index');
    }

    /**
     * Show the form for creating a new Establishment.
     */
    public function create()
    {
        return view('establishments.create');
    }

    /**
     * Store a newly created Establishment in storage.
     */
    public function store(CreateEstablishmentRequest $request)
    {
        $input = $request->all();

        $establishment = $this->establishmentRepository->create($input);

        Flash::success('Establishment saved successfully.');

        return redirect(route('establishments.index'));
    }

    /**
     * Display the specified Establishment.
     */
    public function show($id)
    {
        $establishment = $this->establishmentRepository->find($id);

        if (empty($establishment)) {
            Flash::error('Establishment not found');

            return redirect(route('establishments.index'));
        }

        return view('establishments.show')->with('establishment', $establishment);
    }

    // Метод для редактирования заведения
    public function card($id)
    {
        // Используем метод репозитория для поиска заведения
        $establishment = $this->establishmentRepository->findWithRelations($id, ['photos']);

        // Проверяем, существует ли заведение
        if (empty($establishment)) {
            Flash::error('Заведение не найдено');
            return redirect()->route('home');
        }

        // Передаем данные в представление
        return view('establishments.card')->with('establishment', $establishment);
    }

    /**
     * Show the form for editing the specified Establishment.
     */
    public function edit($id)
    {
        $establishment = $this->establishmentRepository->find($id);

        if (empty($establishment)) {
            Flash::error('Establishment not found');

            return redirect(route('establishments.index'));
        }

        return view('establishments.edit')->with('establishment', $establishment);
    }

    /**
     * Update the specified Establishment in storage.
     */
    public function update($id, UpdateEstablishmentRequest $request)
    {
        $establishment = $this->establishmentRepository->find($id);

        if (empty($establishment)) {
            Flash::error('Establishment not found');

            return redirect(route('establishments.index'));
        }

        $establishment = $this->establishmentRepository->update($request->all(), $id);

        Flash::success('Establishment updated successfully.');

        return redirect(route('establishments.index'));
    }

    /**
     * Remove the specified Establishment from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $establishment = $this->establishmentRepository->find($id);

        if (empty($establishment)) {
            Flash::error('Establishment not found');

            return redirect(route('establishments.index'));
        }

        $this->establishmentRepository->delete($id);

        Flash::success('Establishment deleted successfully.');

        return redirect(route('establishments.index'));
    }
}
