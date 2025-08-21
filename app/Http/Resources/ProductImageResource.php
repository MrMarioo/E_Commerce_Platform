<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $id
 * @property string $name
 * @property string $alt_text
 * @property int $sort_order
 * @property string $url
 * @property string $image_path
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class ProductImageResource extends JsonResource
{
   public function toArray(Request $request): array
   {
       /** @var \Illuminate\Filesystem\FilesystemAdapter $disk*/
       $disk = Storage::disk('public');
       return [
           'id' => $this->id,
           'name' => $this->name,
           'alt_text' => $this->alt_text,
           'sort_order' => $this->sort_order,
           'url' => $disk->url($this->image_path),
           'path' => $this->image_path,
           'created_at' => $this->created_at,
           'updated_at' => $this->updated_at,
       ];
   }
}
