<?php

namespace Fgx;

use Illuminate\Support\Collection;
use Illuminate\Http\UploadedFile;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Previews extends Collection
{
    public static function create(...$values)
    {
        $collection = new self(); // Use self() instead of class name
        return $collection->push(...$values);
    }

    /**
     * Override push to ensure items are converted to Preview
     */
    public function push(...$values)
    {
        foreach ($values as $value) {
            if ($value instanceof Preview) {
                parent::push($value);
            } elseif (
                $value instanceof Media ||
                $value instanceof TemporaryUploadedFile ||
                $value instanceof UploadedFile
            ) {
                parent::push(Preview::make($value));
            } elseif (
                $value instanceof Collection ||
                $value instanceof MediaCollection ||
                Preview::isTemporaryFiles($value) ||
                Preview::isUploadedFiles($value)
            ) {
                foreach ($value as $item) {
                    parent::push(Preview::make($item));
                }
            }
        }

        return $this;
    }

    /**
     * Override toArray to convert all items and the collection itself
     */
    public function toArray()
    {
        $array = [];
        foreach ($this->all() as $item) {
            $array[] = $item->toArray();
        }
        return $array;
    }
    public function keepLast()
    {
        return new self([$this->last()]);
    }
}
