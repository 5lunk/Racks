<?php

namespace App\Http\Resources\RackResources;

use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="UnableToUpdateRackResponse",
 *     title="Unable to update rack",
 *
 *         @OA\Property(
 *             property="message",
 *             type="string",
 *             example="Unable to update rack"
 *         ),
 *         @OA\Property(
 *             property="error",
 *             type="string",
 *             example="Some internal error"
 *         )
 *     )
 * )
 */
class UnableToUpdateRackResource extends JsonResource
{
    protected \Throwable $e;

    public function __construct(\Throwable $e)
    {
        parent::__construct($e);
        $this->e = $e;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<mixed>
     */
    public function toArray($request): array
    {
        return [
            'message' => 'Unable to update rack',
            'error' => $this->e->getMessage(),
        ];
    }
}
