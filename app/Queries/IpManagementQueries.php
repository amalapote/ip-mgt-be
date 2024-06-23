<?php

namespace App\Queries;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Models\Audit;

class IpManagementQueries extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    /**
     * Attributes to include in the Audit.
     *
     * @var array
     */
    protected $auditInclude = [
        'ip_address',
        'label',
        'comment'
    ];

    /**
     * IP Management model.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllIpAddresses(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this::with('user')->orderBy('id', 'desc')->paginate(10);
    }

    /**
     * Get an IP address by ID.
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getIpAddressById($ip)
    {
        return $ip->with('user')->first();
    }

    /**
     * Create a new IP address.
     *
     * @param array<string, mixed> $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function createIpAddress(array $data): \Illuminate\Database\Eloquent\Model
    {
        $user = Auth::user();

        return $user->ipManagement()->create($data);
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

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function logs()
    {
        return Audit::with('user')->paginate();
    }

}
