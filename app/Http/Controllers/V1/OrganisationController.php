<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Organisation\StoreOrganisationRequest;
use App\Interfaces\Services\BaseServiceInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class OrganisationController extends Controller
{
    protected BaseServiceInterface $organisationService;

    /**
     * @param BaseServiceInterface $organisationService
     */
    public function __construct(BaseServiceInterface $organisationService)
    {
        $this->organisationService = $organisationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $organisations = $this->organisationService->getAll();

        return response()->json([
            'data' => $organisations
        ], Response::HTTP_CREATED);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOrganisationRequest $request
     *
     * @return JsonResponse
     */
    public function store(StoreOrganisationRequest $request): JsonResponse
    {
        $organisation = $this->organisationService->store($request->validated());

        return response()->json([
            'data' => $organisation
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
        $organisation = $this->organisationService->get($id);

        return response()->json([
            'data' => $organisation
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreOrganisationRequest $request
     * @param string $id
     *
     * @return JsonResponse
     */
    public function update(StoreOrganisationRequest $request, string $id): JsonResponse
    {
        $organisation = $this->organisationService->update($id, $request->validated());

        return response()->json([
            'data' => $organisation
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
        $this->organisationService->destroy($id);

        return response()->noContent();
    }
}
