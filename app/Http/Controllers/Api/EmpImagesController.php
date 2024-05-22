<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EmpImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EmpImagesController extends ApiController
{
    private EmpImage $empImage;

    public function __construct(EmpImage $empImage)
    {
        parent::__construct();

        $this->empImage = $empImage;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file',
        ]);

        $file = $request->file('file');
        $data = [
            'path' => 'uploads/emp_images' . date('/Y/') . date('m/') . date('d'),
            'filename' => md5(time()),
            'extension' => $file->getClientOriginalExtension(),
        ];

        if(!File::exists($data['path'])){
            File::makeDirectory($data['path']);
        }
        $file->move($data['path'], $data['filename'].'.'.$data['extension']);

        $empImage = $this->empImage->create($data);

        return $this->composeJson([
            'id' => $empImage->getId(),
            'url' => $empImage->getImageUrl(),
        ]);
    }
}
