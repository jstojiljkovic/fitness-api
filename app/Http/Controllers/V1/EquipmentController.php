<?php

namespace App\Http\Controllers\V1;

use App\Helpers\ApplicationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Equipment\StoreEquipmentRequest;
use App\Http\Requests\Equipment\UpdateEquipmentRequest;
use App\Interfaces\Services\EquipmentServiceInterface;
use App\Interfaces\Services\MediaServiceInterface;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Response;

class EquipmentController extends Controller
{
    /**
     * @var EquipmentServiceInterface
     */
    protected EquipmentServiceInterface $equipmentService;

    /**
     * @var MediaServiceInterface
     */
    protected MediaServiceInterface $mediaService;

    /**
     * @param EquipmentServiceInterface $equipmentService
     * @param MediaServiceInterface $mediaService
     */
    public function __construct(EquipmentServiceInterface $equipmentService, MediaServiceInterface $mediaService)
    {
        $this->equipmentService = $equipmentService;
        $this->mediaService = $mediaService;
    }

    /**
     * Display a listing of the resource.
     *
     * @OA\Get(
     *     path="/fitness-api/v1/equipments",
     *     tags={"Equipment"},
     *     operationId="index",
     *     summary="Returns all the equipments",
     *     description="",
     *     security={ {"barear": {} }},
     * @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *        @OA\Property(property="data", type="array",
     *     @OA\Items(
     *        @OA\Property(property="id", type="int", example="1"),
     *        @OA\Property(property="name", type="string", example="Nis"),
     *        @OA\Property(property="country", type="string", example="Serbia"),
     *        @OA\Property(property="description", type="string", example="Drinking problem country"),
     *        @OA\Property(property="created_at", type="string",
     *     format="date-time", description="Initial creation timestamp", readOnly="true"),
     *        @OA\Property(property="updated_at", type="string",
     *     format="date-time", description="Last update timestamp", readOnly="true"),
     *       @OA\Property(property="created_at", type="array",
     *     @OA\Items(
     *           @OA\Property(property="human", type="int", example="1"),
     *           @OA\Property(property="date_time", type="text", example="This is just a random comment"),
     *           @OA\Property(property="city_id", type="int", example="1"),
     *        @OA\Property(property="created_at", type="string",
     *     format="date-time", description="Initial creation timestamp", readOnly="true"),
     *        @OA\Property(property="updated_at", type="string",
     *     format="date-time", description="Last update timestamp", readOnly="true"),
     *     )),)),)
     *  ),
     * @OA\Response(
     *     response=422,
     *     description="Returns when validation fails",
     *     @OA\JsonContent(
     *        @OA\Property(property="message", type="string", example="The given data was invalid."),
     *     )
     *  ),
     * @OA\Response(
     *     response=401,
     *     description="Returns when user is not authenticated",
     *     @OA\JsonContent(
     *        @OA\Property(property="message", type="string", example="Invalid credentials."),
     *     )
     *  ),
     * )
     *
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $equipments = $this->equipmentService->getAll();

        return response()->json([
            'data' => $equipments
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreEquipmentRequest $request
     *
     * @return JsonResponse
     */
    public function store(StoreEquipmentRequest $request): JsonResponse
    {
        $data = $request->validated();
        $file = $this->mediaService->uploadPhoto($request->photo, ApplicationHelper::activeOrganisation(), true);
        $data = array_merge($data, $file);
        $equipment = $this->equipmentService->store($data);

        return response()->json([
            'data' => $equipment
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param string $id
     *
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $equipment = $this->equipmentService->get($id);

        return response()->json([
            'data' => $equipment
        ], Response::HTTP_OK);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateEquipmentRequest $request
     * @param string $id
     *
     * @return JsonResponse
     */
    public function update(UpdateEquipmentRequest $request, string $id): JsonResponse
    {
        $data = $request->validated();
        $equipment = $this->equipmentService->get($id);
        $organisationId = ApplicationHelper::activeOrganisation();

        if ($request->hasFile('photo')) {
            $file = $this->mediaService->overwritePhoto(
                $request->photo,
                $organisationId . '/' . $equipment['filename'],
                $organisationId,
                true,
                $organisationId . '/' . $equipment['thumbnail'],
            );
            $data = array_merge($data, $file);
        }

        $equipment = $this->equipmentService->update($id, $data);

        return response()->json([
            'data' => $equipment
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     *
     * @return Response
     */
    public function destroy(string $id): Response
    {
        $equipment = $this->equipmentService->get($id);
        $this->equipmentService->destroy($id);
        $organisationId = ApplicationHelper::activeOrganisation();
        $this->mediaService->deletePhoto(
            $organisationId . '/' . $equipment['filename'],
            $organisationId . '/' . $equipment['thumbnail']
        );

        return response()->noContent();
    }
}
