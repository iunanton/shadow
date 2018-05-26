<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Video;
use App\Jobs\ProcessVideo;

class VideoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::user()->id;
        $videos = Video::where('user_id', $userId)->orderBy('created_at', 'desc')->paginate(10);
        return view('video.index')->with('videos', $videos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('video.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'video' => 'required|mimetypes:video/mp4,video/avi,video/mpeg,video/quicktime,video/x-flv,video/webm,video/x-matroska,video/x-msvideo',
        ]);

        $path = $request->file('video')->store('/', 'uploads');

        $id = pathinfo($path, PATHINFO_FILENAME);
        $name = urlencode($request->file('video')->getClientOriginalName());
        $title = urldecode(pathinfo($name, PATHINFO_FILENAME));
        $owner = $request->user()->id;

        Video::create([
            'id' => $id,
            'title' => $title,
            'user_id' => $owner
        ]);

        ProcessVideo::dispatch($path);

        return redirect(action('VideoController@index'))
                   ->with('status', 'Successfully uploaded the video!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        $this->authorize('view', $video);

        $count = 6;
        $publicVideos = Video::where('public', 1)->whereIn('status', [2, 3])->get();
        $availableCount = $publicVideos->count();

        $asideVideos = $publicVideos->random($availableCount < $count ? $availableCount : $count);

        return view('video.show', [
            'video' => $video,
            'asideVideos' => $asideVideos,
        ]);
    }

    public function getAsset(Video $video, $file)
    {
        
        $this->authorize('view', $video);
        return Storage::disk('videos')->download("$video->id/$file")->setPrivate();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        $this->authorize('update', $video);
        return view('video.edit')->withVideo($video);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        $this->authorize('update', $video);
        $input = array_add(
            $request->except('public'),
            'public',
            is_null($request->input('public')) ? false : true);

        $video->fill($input)->save();
        return redirect(action('VideoController@index'))
                   ->withStatus('Video was successful updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        $this->authorize('delete', $video);
        $video->delete();
        return redirect(action('VideoController@index'))
                   ->withStatus('Video was successful deleted!');
    }
}
