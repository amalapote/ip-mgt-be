<?php

namespace App\Queries;

use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
class IpManagementQueries extends Model
{
    /**
     * Get all IP addresses.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllIpAddresses(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->all();
    }

    /**
     * Get an IP address by ID.
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getIpAddressById($ip): \Illuminate\Database\Eloquent\Model
    {
        return $ip;
    }

    /**
     * Create a new IP address.
     *
     * @param array<string, mixed> $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function createIpAddress(array $data): \Illuminate\Database\Eloquent\Model
    {
        return $this->create($data);
    }

    /**
     * Update an IP address.
     *
     * @param int $id
     * @param array<string, mixed> $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function updateIpAddress($request, $ipManagement): \Illuminate\Database\Eloquent\Model
    {
        $ipManagement->update($request->validated());

        return $ipManagement;
    }

    /**
     * Delete an IP address.
     *
     * @param int $id
     * @return bool
     */
    public function deleteIpAddress(int $id): bool
    {
        return $this->destroy($id);
    }

}
