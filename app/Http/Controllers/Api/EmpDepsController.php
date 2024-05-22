<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmpDep;

class EmpDepsController extends ApiController
{
    private EmpDep $empDep;

    public function __construct(EmpDep $empDep)
    {
        parent::__construct();

        $this->empDep = $empDep;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empDeps = $this->empDep->get();

        $empDepCollection = $empDeps->transform(function($item){
            return [
                'id' => $item->getId(),
                'name' => $item->getName(),
            ];
        });

        return $this->composeJson($empDepCollection);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);

        $empDep = $this->empDep->create($data);

        return $this->composeJson([
            'id' => $empDep->getId(),
            'name' => $empDep->getName(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $empDep = $this->empDep->whereKey($id)->first();

        dd($empDep);
        
        return $this->composeJson([
            'id' => $empDep->getId(),
            'name' => $empDep->getName(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EmpDep $empDep)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);

        $empDep->update($data);

        return $this->composeJson([
            'id' => $empDep->getId(),
            'name' => $empDep->getName(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmpDep $empDep)
    {
        $empDep->delete();

        return $this->composeJson();
    }
}
