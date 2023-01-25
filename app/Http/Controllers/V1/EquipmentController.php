<?php

namespace App\Http\Controllers\V1;

use App\Helpers\ApplicationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Equipment\StoreEquipmentRequest;
use App\Http\Requests\Equipment\UpdateEquipmentRequest;
use App\Interfaces\Services\BaseServiceInterface;
use App\Interfaces\Services\MediaServiceInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class EquipmentController extends Controller
{
    /**
     * @var BaseServiceInterface
     */
    protected BaseServiceInterface $equipmentService;

    /**
     * @var MediaServiceInterface
     */
    protected MediaServiceInterface $mediaService;

    /**
     * @param BaseServiceInterface $equipmentService
     * @param MediaServiceInterface $mediaService
     */
    public function __construct(BaseServiceInterface $equipmentService, MediaServiceInterface $mediaService)
    {
        $this->equipmentService = $equipmentService;
        $this->mediaService = $mediaService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $equipments = $this->equipmentService->getAll();

        return response()->json([
            'data' => $equipments
        ], Response::HTTP_CREATED);
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
        ], Response::HTTP_OK);
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
