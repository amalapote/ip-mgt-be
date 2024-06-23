<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    IpManagement,
    IpManagementHistory
};
use App\Http\Requests\IpManagementRequest;
use App\Http\Resources\IpManagementResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class IpManagementController extends Controller
{
    public function __construct(readonly protected IpManagement $ipManagement, readonly protected IpManagementHistory $ipManagementHistory)
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return IpManagementResource
     */
    public function index(): IpManagementResource|AnonymousResourceCollection
    {
        return IpManagementResource::collection($this->ipManagement->getAllIpAddresses());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IpManagementRequest $request): IpManagementResource
    {
        return new IpManagementResource($this->ipManagement->createIpAddress($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(IpManagement $ip): IpManagementResource
    {
        return new IpManagementResource($this->ipManagement->getIpAddressById($ip));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(IpManagementRequest $request, IpManagement $ip): IpManagementResource
    {
        return new IpManagementResource($this->ipManagement->updateIpAddress($request, $ip));
    }

    /**
     * Audit log for the IP Management.
     *
     * @return IpManagementResource
     */
    public function auditLog(): IpManagementResource
    {
        return new IpManagementResource($this->ipManagement->logs());
    }

}
