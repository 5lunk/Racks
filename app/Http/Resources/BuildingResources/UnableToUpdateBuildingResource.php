<?php

declare(strict_types=1);

namespace App\Http\Resources\BuildingResources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="UnableToUpdateBuildingResponse",
 *     title="Unable to update building",
 *
 *         @OA\Property(
 *             property="message",
 *             type="string",
 *             example="Unable to update building"
 *         ),
 *         @OA\Property(
 *             property="error",
 *             type="string",
 *             example="Some internal error"
 *         )
 *     )
 * )
 */
class UnableToUpdateBuildingResource extends JsonResource
{
    /**
     * @var \Throwable
     */
    protected \Throwable $e;

    /**
     * @param  \Throwable  $e
     */
    public function __construct(\Throwable $e)
    {
        parent::__construct($e);
        $this->e = $e;
    }

    /**
     * @param  Request  $request
     * @return array<mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'message' => 'Unable to update building',
            'error' => (config('app.debug') ? $this->e->getMessage() : 'Internal server error'),
        ];
    }
}
