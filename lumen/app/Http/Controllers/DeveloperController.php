<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DeveloperController extends Controller
{

    public function searchDevelopers(Request $request)
    {
        $developer = new Developer();
        $queryBuilder = $developer->newQuery();

        foreach ($developer->getFillable() as $attribute) {
            if ($request->has($attribute)) {
                $queryBuilder->where($attribute, $request->input($attribute));
            }
        }
        $developerList = $queryBuilder->get();
        if ($developerList->count() > 0) {
            $httpCode = Response::HTTP_OK;
        } else {
            $developerList = null;
            $httpCode = Response::HTTP_BAD_REQUEST;
        }
        return response()->json($developerList, $httpCode);
    }

    public function showOneDeveloper($id)
    {
        try {
            return response()->json(Developer::findOrFail($id));
        } catch (ModelNotFoundException $e) {
            return response(null, Response::HTTP_BAD_REQUEST);
        }
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'nome' => 'required',
            'sexo' => 'required',
            'dt_nasc' => 'required|date'
        ]);
        $developer = Developer::create($request->all());
        return response()->json($developer, Response::HTTP_CREATED);
    }

    public function update($id, Request $request)
    {
        $httpCode = Response::HTTP_OK;
        try {
            $developer = Developer::findOrFail($id);
            $developer->update($request->all());
        } catch (ModelNotFoundException $e) {
            $developer = null;
            $httpCode = Response::HTTP_BAD_REQUEST;
        }
        return response()->json($developer, $httpCode);
    }

    public function delete($id)
    {
        try {
            $httpCode = Response::HTTP_NO_CONTENT;
            Developer::findOrFail($id)->delete();
        } catch (ModelNotFoundException $e) {
            $httpCode = Response::HTTP_BAD_REQUEST;
        }
        return response(null, $httpCode);
    }
}
