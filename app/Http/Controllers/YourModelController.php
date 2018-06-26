<?php

namespace App\Http\Controllers;

use App\DataTables\YourModelDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateYourModelRequest;
use App\Http\Requests\UpdateYourModelRequest;
use App\Repositories\YourModelRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\Auth; // add by dandisy
use Illuminate\Support\Facades\Storage; // add by dandisy

class YourModelController extends AppBaseController
{
    /** @var  YourModelRepository */
    private $yourModelRepository;

    public function __construct(YourModelRepository $yourModelRepo)
    {
        $this->middleware('auth');
        $this->yourModelRepository = $yourModelRepo;
    }

    /**
     * Display a listing of the YourModel.
     *
     * @param YourModelDataTable $yourModelDataTable
     * @return Response
     */
    public function index(YourModelDataTable $yourModelDataTable)
    {
        return $yourModelDataTable->render('your_models.index');
    }

    /**
     * Show the form for creating a new YourModel.
     *
     * @return Response
     */
    public function create()
    {
        // add by dandisy
        

        // edit by dandisy
        //return view('your_models.create');
        return view('your_models.create');
    }

    /**
     * Store a newly created YourModel in storage.
     *
     * @param CreateYourModelRequest $request
     *
     * @return Response
     */
    public function store(CreateYourModelRequest $request)
    {
        $input = $request->all();

        $yourModel = $this->yourModelRepository->create($input);

        Flash::success('Your Model saved successfully.');

        return redirect(route('yourModels.index'));
    }

    /**
     * Display the specified YourModel.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $yourModel = $this->yourModelRepository->findWithoutFail($id);

        if (empty($yourModel)) {
            Flash::error('Your Model not found');

            return redirect(route('yourModels.index'));
        }

        return view('your_models.show')->with('yourModel', $yourModel);
    }

    /**
     * Show the form for editing the specified YourModel.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // add by dandisy
        

        $yourModel = $this->yourModelRepository->findWithoutFail($id);

        if (empty($yourModel)) {
            Flash::error('Your Model not found');

            return redirect(route('yourModels.index'));
        }

        // edit by dandisy
        //return view('your_models.edit')->with('yourModel', $yourModel);
        return view('your_models.edit')
            ->with('yourModel', $yourModel);        
    }

    /**
     * Update the specified YourModel in storage.
     *
     * @param  int              $id
     * @param UpdateYourModelRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateYourModelRequest $request)
    {
        $yourModel = $this->yourModelRepository->findWithoutFail($id);

        if (empty($yourModel)) {
            Flash::error('Your Model not found');

            return redirect(route('yourModels.index'));
        }

        $yourModel = $this->yourModelRepository->update($request->all(), $id);

        Flash::success('Your Model updated successfully.');

        return redirect(route('yourModels.index'));
    }

    /**
     * Remove the specified YourModel from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $yourModel = $this->yourModelRepository->findWithoutFail($id);

        if (empty($yourModel)) {
            Flash::error('Your Model not found');

            return redirect(route('yourModels.index'));
        }

        $this->yourModelRepository->delete($id);

        Flash::success('Your Model deleted successfully.');

        return redirect(route('yourModels.index'));
    }
}
