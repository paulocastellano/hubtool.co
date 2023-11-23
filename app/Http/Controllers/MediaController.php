<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Media;

class MediaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'media' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'collection' => 'required',
            'model' => 'required',
            'model_id' => 'required',
        ]);

        $model = 'App?Models?' . $request->model;
        $model = str_replace('?', '\\', $model);

        $model = $model::where('id', $request->model_id)->first();

        $upload = $model->addMediaFromRequest('media')->toMediaCollection($request->collection);

        return response()->json($upload);
    }

    public function destroy($id)
    {
        $media = Media::where('uuid', $id)->firstOrFail();
        $media->delete();

        return response()->json();
    }
}
