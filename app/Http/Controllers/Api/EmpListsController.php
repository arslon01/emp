<?php

namespace App\Http\Controllers\Api;

use App\Models\EmpList;
use Illuminate\Http\Request;

class EmpListsController extends ApiController
{
    private EmpList $empList;

    public function __construct(EmpList $empList)
    {
        parent::__construct();

        $this->empList = $empList;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empLists = $this->empList->get();

        $empListCollection = $empLists->transform(function($item){
            return [
                'id' => $item->getId(),
                'department' => $item->relationEmpDep?->getName(),
                'position' => $item->relationEmpPosition?->getName(),
                'full_name' => $item->getFullName(),
            ];
        });

        return $this->composeJson($empListCollection);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'emp_dep_id' => 'required|numeric',
            'emp_position_id' => 'required|numeric',
            'image_id' => 'required|numeric',
            'full_name' => 'required|string',
        ]);

        $empList = $this->empList->create($data);

        return $this->composeJson([
            'id' => $empList->getId(),
            'department' => $empList->relationEmpDep?->getName(),
            'position' => $empList->relationEmpPosition?->getName(),
            'full_name' => $empList->getFullName(),
            'image' => $empList->relationEmpImage?->getImageUrl(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $empList = $this->empList->whereKey($id)->first();

        if(is_null($empList)){
            $this->setCode(404);
            $this->setMessage('Emp dep not found!');

            return $this->composeJson();
        }

        return $this->composeJson([
            'id' => $empList->getId(),
            'department' => $empList->relationEmpDep?->getName(),
            'position' => $empList->relationEmpPosition?->getName(),
            'full_name' => $empList->getFullName(),
            'image' => $empList->relationEmpImage?->getImageUrl(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'emp_dep_id' => 'required|numeric',
            'emp_position_id' => 'required|numeric',
            'image_id' => 'nullable|numeric',
            'full_name' => 'required|string',
        ]);

        $empList = $this->empList->whereKey($id)->first();
        if(is_null($empList)){
            $this->setCode(404);
            $this->setMessage('Emp dep not found!');

            return $this->composeJson();
        }

        $empList->update($data);

        return $this->composeJson([
            'id' => $empList->getId(),
            'department' => $empList->relationEmpDep?->getName(),
            'position' => $empList->relationEmpPosition?->getName(),
            'full_name' => $empList->getFullName(),
            'image' => $empList->relationEmpImage?->getImageUrl(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $empList = $this->empList->whereKey($id)->first();

        if(is_null($empList)){
            $this->setCode(404);
            $this->setMessage('Emp dep not found!');

            return $this->composeJson();
        }

        $empList->delete();

        return $this->composeJson();
    }
}
