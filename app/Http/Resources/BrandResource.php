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
 * @property string|null $image
 * @property string $description
 * @property string $slug
 * @property StatuseEnum $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class BrandResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var \Illuminate\Filesystem\FilesystemAdapter $disk*/
        $disk = Storage::disk('public');
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'slug' => $this->slug,
            'image' => $this->image ? $disk->url($this->image) : null,
            'status' => $this->status,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
