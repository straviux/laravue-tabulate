<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Http\Resources\NewsResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $user = $request->user();
        return NewsResource::collection(News::where('user_id', $user->id)->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNewsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewsRequest $request)
    {
        //
        $data = $request->validated();

        if (isset($data['cover_photo'])) {
            $relativePath = $this->saveImage($data['cover_photo']);
            $data['cover_photo'] = $relativePath;
        }

        $news = News::create($data);

        return new NewsResource($news);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news, Request $request)
    {
        $user = $request->user();
        if ($user->id !== $news->user_id) {
            return abort(403, 'Unauthorized action');
        }
        return new NewsResource($news);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNewsRequest  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNewsRequest $request, News $news)
    {
        $data = $request->validated();

        // Check if image was given and save on local file system
        if (isset($data['cover_photo'])) {
            $relativePath = $this->saveImage($data['cover_photo']);
            $data['cover_photo'] = $relativePath;

            // If there is an old image, delete it
            if ($news->cover_photo) {
                $absolutePath = public_path($news->cover_photo);
                File::delete($absolutePath);
            }
        }

        // Update news in the database
        $news->update($data);
        return new NewsResource($news);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news, Request $request)
    {
        //
        $user = $request->user();
        if ($user->id !== $news->user_id) {
            return abort(403, 'Unauthorized action');
        }

        $news->delete();
        return response('', 204);
    }

    private function saveImage($image)
    {
        //Check if valid base64 string
        if (preg_match('/^data:image\/(\w+);base64,/', $image, $type)) {
            //take base64 encoded text without mime type
            $image = substr($image, strpos($image, ',') + 1);

            //get file extension
            $type = strtolower($type[1]); // jpg, png, gif

            if (!in_array($type, ['jpg', 'png', 'gif', 'jpeg'])) {
                throw new \Exception('invalid image type');
            }
            $image = str_replace(' ', '+', $image);
            $image = base64_decode($image);

            if ($image === false) {
                throw new \Exception('base64_decode failed');
            }
        } else {
            throw new  \Exception('did not match data URI with image data');
        }

        $dir = 'images/coverphotos/';
        $file = Str::random() . '.' . $type;
        $absolutePath = public_path($dir);
        $relativePath = $dir . $file;

        if (!File::exists($absolutePath)) {
            File::makeDirectory($absolutePath, 0755, true);
        }

        file_put_contents($relativePath, $image);

        return $relativePath;
    }
}
