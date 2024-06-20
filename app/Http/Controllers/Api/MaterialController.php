<?php

namespace App\Http\Controllers\Api;

//import model Material
use App\Models\Material;

use App\Http\Controllers\Controller;

//import resource MaterialResource
use App\Http\Resources\MaterialResource;

use Illuminate\Http\Request;

//import facade Validator
use Illuminate\Support\Facades\Validator;

class MaterialController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all materials
        $materials = Material::latest()->paginate(5);

        //return collection of materials as a resource
        return new MaterialResource(true, 'List Data Materials', $materials);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'kode'          => 'required|min:3',
            'nama_material' => 'required',
            'keterangan'    => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create material
        $material = Material::create([
            'kode'          => $request->kode,
            'nama_material' => $request->nama_material,
            'keterangan'   => $request->keterangan,
        ]);

        //return response
        return new MaterialResource(true, 'Data Material Berhasil Ditambahkan!', $material);
    }

    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'kode'          => 'required',
            'nama_material'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find material by ID
        $material = Material::find($id);
        $material->update([
            'kode'     => $request->kode,
            'nama_material'   => $request->nama_material,
            'keterangan'   => $request->keterangan,
        ]);

        //return response
        return new MaterialResource(true, 'Data Material Berhasil Diubah!', $material);
    }

    /**
     * delete
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {

        //find material by ID
        $material = Material::find($id);

        //delete post
        $material->delete();

        //return response
        return new MaterialResource(true, 'Data Material Berhasil Dihapus!', null);
    }

     /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        //find material by ID
        $materials = Material::find($id);

        //return single Materials as a resource
        return new MaterialResource(true, 'Detail Data Material!', $materials);
    }
}
