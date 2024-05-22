<?php

namespace App\Http\Controllers\Api;

use App\Models\EmpPosition;
use Illuminate\Http\Request;

class EmpPositionsController extends ApiController
{
    private EmpPosition $empPosition;

    public function __construct(EmpPosition $empPosition)
    {
        parent::__construct();

        $this->empPosition = $empPosition;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empPositions = $this->empPosition->get();

        $empPositionCollection = $empPositions->transform(function($item){
            return [
                'id' => $item->getId(),
                'name' => $item->getName(),
            ];
        });

        return $this->composeJson($empPositionCollection);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);

        $empPosition = $this->empPosition->create($data);

        return $this->composeJson([
            'id' => $empPosition->getId(),
            'name' => $empPosition->getName(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $empPosition = $this->empPosition->whereKey($id)->first();

        if(is_null($empPosition)){
            $this->setCode(404);
            $this->setMessage('Emp dep not found!');

            return $this->composeJson();
        }

        return $this->composeJson([
            'id' => $empPosition->getId(),
            'name' => $empPosition->getName(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);

        $empPosition = $this->empPosition->whereKey($id)->first();
        if(is_null($empPosition)){
            $this->setCode(404);
            $this->setMessage('Emp dep not found!');

            return $this->composeJson();
        }

        $empPosition->update($data);

        return $this->composeJson([
            'id' => $empPosition->getId(),
            'name' => $empPosition->getName(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $empPosition = $this->empPosition->whereKey($id)->first();

        if(is_null($empPosition)){
            $this->setCode(404);
            $this->setMessage('Emp dep not found!');

            return $this->composeJson();
        }

        $empPosition->delete();

        return $this->composeJson();
    }
}
