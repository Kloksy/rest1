<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserInteractionRequest;
use App\Http\Requests\UpdateUserInteractionRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\UserInteractionRepository;
use Illuminate\Http\Request;
use Flash;

class UserInteractionController extends AppBaseController
{
    /** @var UserInteractionRepository $userInteractionRepository*/
    private $userInteractionRepository;

    public function __construct(UserInteractionRepository $userInteractionRepo)
    {
        $this->userInteractionRepository = $userInteractionRepo;
    }

    /**
     * Display a listing of the UserInteraction.
     */
    public function index(Request $request)
    {
        return view('user_interactions.index');
    }

    /**
     * Show the form for creating a new UserInteraction.
     */
    public function create()
    {
        return view('user_interactions.create');
    }

    /**
     * Store a newly created UserInteraction in storage.
     */
    public function store(CreateUserInteractionRequest $request)
    {
        $input = $request->all();

        $userInteraction = $this->userInteractionRepository->create($input);

        Flash::success('User Interaction saved successfully.');

        return redirect(route('userInteractions.index'));
    }

    /**
     * Display the specified UserInteraction.
     */
    public function show($id)
    {
        $userInteraction = $this->userInteractionRepository->find($id);

        if (empty($userInteraction)) {
            Flash::error('User Interaction not found');

            return redirect(route('userInteractions.index'));
        }

        return view('user_interactions.show')->with('userInteraction', $userInteraction);
    }

    /**
     * Show the form for editing the specified UserInteraction.
     */
    public function edit($id)
    {
        $userInteraction = $this->userInteractionRepository->find($id);

        if (empty($userInteraction)) {
            Flash::error('User Interaction not found');

            return redirect(route('userInteractions.index'));
        }

        return view('user_interactions.edit')->with('userInteraction', $userInteraction);
    }

    /**
     * Update the specified UserInteraction in storage.
     */
    public function update($id, UpdateUserInteractionRequest $request)
    {
        $userInteraction = $this->userInteractionRepository->find($id);

        if (empty($userInteraction)) {
            Flash::error('User Interaction not found');

            return redirect(route('userInteractions.index'));
        }

        $userInteraction = $this->userInteractionRepository->update($request->all(), $id);

        Flash::success('User Interaction updated successfully.');

        return redirect(route('userInteractions.index'));
    }

    /**
     * Remove the specified UserInteraction from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $userInteraction = $this->userInteractionRepository->find($id);

        if (empty($userInteraction)) {
            Flash::error('User Interaction not found');

            return redirect(route('userInteractions.index'));
        }

        $this->userInteractionRepository->delete($id);

        Flash::success('User Interaction deleted successfully.');

        return redirect(route('userInteractions.index'));
    }
}
