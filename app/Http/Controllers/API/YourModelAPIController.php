<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateYourModelAPIRequest;
use App\Http\Requests\API\UpdateYourModelAPIRequest;
use App\Models\YourModel;
use App\Repositories\YourModelRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class YourModelController
 * @package App\Http\Controllers\API
 */

class YourModelAPIController extends AppBaseController
{
    /** @var  YourModelRepository */
    private $yourModelRepository;

    public function __construct(YourModelRepository $yourModelRepo)
    {
        $this->middleware('auth:api');
        $this->yourModelRepository = $yourModelRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/yourModels",
     *      summary="Get a listing of the YourModels.",
     *      tags={"YourModel"},
     *      description="Get all YourModels",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/YourModel")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $this->yourModelRepository->pushCriteria(new RequestCriteria($request));
        $this->yourModelRepository->pushCriteria(new LimitOffsetCriteria($request));
        $yourModels = $this->yourModelRepository->all();

        return $this->sendResponse($yourModels->toArray(), 'Your Models retrieved successfully');
    }

    /**
     * @param CreateYourModelAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/yourModels",
     *      summary="Store a newly created YourModel in storage",
     *      tags={"YourModel"},
     *      description="Store YourModel",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="YourModel that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/YourModel")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/YourModel"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateYourModelAPIRequest $request)
    {
        $input = $request->all();

        $yourModels = $this->yourModelRepository->create($input);

        return $this->sendResponse($yourModels->toArray(), 'Your Model saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/yourModels/{id}",
     *      summary="Display the specified YourModel",
     *      tags={"YourModel"},
     *      description="Get YourModel",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of YourModel",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/YourModel"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var YourModel $yourModel */
        $yourModel = $this->yourModelRepository->findWithoutFail($id);

        if (empty($yourModel)) {
            return $this->sendError('Your Model not found');
        }

        return $this->sendResponse($yourModel->toArray(), 'Your Model retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateYourModelAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/yourModels/{id}",
     *      summary="Update the specified YourModel in storage",
     *      tags={"YourModel"},
     *      description="Update YourModel",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of YourModel",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="YourModel that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/YourModel")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/YourModel"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateYourModelAPIRequest $request)
    {
        $input = $request->all();

        /** @var YourModel $yourModel */
        $yourModel = $this->yourModelRepository->findWithoutFail($id);

        if (empty($yourModel)) {
            return $this->sendError('Your Model not found');
        }

        $yourModel = $this->yourModelRepository->update($input, $id);

        return $this->sendResponse($yourModel->toArray(), 'YourModel updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/yourModels/{id}",
     *      summary="Remove the specified YourModel from storage",
     *      tags={"YourModel"},
     *      description="Delete YourModel",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of YourModel",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var YourModel $yourModel */
        $yourModel = $this->yourModelRepository->findWithoutFail($id);

        if (empty($yourModel)) {
            return $this->sendError('Your Model not found');
        }

        $yourModel->delete();

        return $this->sendResponse($id, 'Your Model deleted successfully');
    }
}
