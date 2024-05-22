<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EmpList.php
 * @package App\Models
 * 
 * @property int $id
 * @property id $emp_dep_id
 * @property id $emp_position_id
 * @property string $full_name
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class EmpList extends Model
{
    protected $table = 'emp_lists';
    protected $guarded = [];

    // Relations

    public function relationEmpDep()
    {
        return $this->belongsTo(EmpDep::class, 'emp_dep_id', 'id');
    }

    public function relationEmpPosition()
    {
        return $this->belongsTo(EmpPosition::class, 'emp_position_id', 'id');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmpDepId(): int
    {
        return $this->emp_dep_id;
    }

    public function getEmpPositionId(): int
    {
        return $this->emp_position_id;
    }

    public function getFullName(): string
    {
        return $this->full_name;
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
