<?php

declare(strict_types=1);

namespace App\Http\Resources\RackResources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="UnableToDeleteRackResponse",
 *     title="Unable to delete rack",
 *
 *         @OA\Property(
 *             property="message",
 *             type="string",
 *             example="Unable to delete rack"
 *         ),
 *         @OA\Property(
 *             property="error",
 *             type="string",
 *             example="Some internal error"
 *         )
 *     )
 * )
 */
class UnableToDeleteRackResource extends JsonResource
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
            'message' => 'Unable to delete rack',
            'error' => (config('app.debug') ? $this->e->getMessage() : 'Internal server error'),
        ];
    }
}
