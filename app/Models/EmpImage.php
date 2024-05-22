<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EmpImage.php
 * @package App\Models
 *
 * @property int $id
 * @property string $path
 * @property string $filename
 * @property string $extension
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class EmpImage extends Model
{
    protected $table ='emp_images';
    protected $guarded = [];

    public function getId(): int
    {
        return $this->id;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getFilename(): string
    {
        return $this->filename;
    }

    public function getExtension(): string
    {
        return $this->extension;
    }

    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updated_at;
    }

    public function getImageUrl()
    {
        $url = $this->getPath() . '/' . $this->getFilename() . '.' . $this->getExtension();

        return asset($url);
    }
}
