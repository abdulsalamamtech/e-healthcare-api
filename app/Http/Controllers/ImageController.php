<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Support\Str;
use App\Http\Resources\ImageResource;
use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = Image::paginate(20)->withQueryString();
        $metaData = $this->getMetadata($images);

        $images = ImageResource::collection($images);
        return $this->sendSuccess(data: $images, metadata: $metaData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreImageRequest $request)
    {
        $uploadImage = $this->uploadImage($request);
        if(!$uploadImage['path']){
            return $this->sendError([], 'something went wrong, please try again later!');
        }

        $image = new Image();
        $image->path = $uploadImage['path'];
        $image->save();

        $image = new ImageResource($image);
        return $this->sendSuccess($image, 'image created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        $image = new ImageResource($image);
        return $this->sendSuccess($image, 'image fetched successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateImageRequest $request, Image $image)
    {
        $uploadImage = $this->uploadImage($request);

        if(!$uploadImage['path']){
            return $this->sendError([], 'something went wrong, please try again later!');
        }

        $image->path = $uploadImage['path'];
        $image->url = null;
        $image->active = 0;
        $image->save();

        $image = new ImageResource($image);
        return $this->sendSuccess($image, 'image updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        $image->delete();

        return $this->sendSuccess([], 'image deleted successfully');

    }


    protected function uploadImage($request){

        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            // save the file int a variable
            $file = $request->file('image');

            // Assign a new name to the image img-name-1212343215.png
            $newName = "img-". random_int(2000, 9000) . "-" . Str::slug(now())  . "." . $file->guessClientExtension();
            // Save the image to the public/images/$newName
            $path = $file->storeAs('images', $newName, 'public');

            // If the image file is successfully saved
            if($path){

                return ['path' => $path];

            }else{
                return $this->sendError([], 'something went wrong, please try again later!');
            }

            abort('something went wrong, please try again later!');
        }
    }

    
}
