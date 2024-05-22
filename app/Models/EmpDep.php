<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EmpDep.php
 * @package App\Models
 * 
 * @property int $id
 * @property string $name
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class EmpDep extends Model
{
    protected $table ='emp_deps';
    protected $guarded = [];

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updated_at;
    }
}
