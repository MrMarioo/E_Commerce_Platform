<?php

namespace App\Http\Resources;

use App\Enum\StatuseEnum;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $slug
 * @property StatuseEnum $status
 * @property integer $sort_order
 * @property integer $parent_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class CategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'slug' => $this->slug,
            'sort_order' => $this->sort_order,
            'parent_id' => $this->parent_id,
            'status' => $this->status,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
