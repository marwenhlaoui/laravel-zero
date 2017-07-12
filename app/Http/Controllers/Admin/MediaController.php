<?php

namespace App\Http\Controllers\Admin;

use App\Models\Media;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $medias = Media::orderBy('id','desc')->paginate(20);
        return view('admin.media.index',compact('medias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.media.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$run=null)
    {  
        $run = (!empty($run))?$run: "media" ;
        $this->validate($request,[
                $run => "required|max:10000"
            ]);

        $dir = 'upload/'.date('Y/m/d/');
        $filename = md5(\Auth::user()->id).time(); 
        if (!empty($request->file($run))) {
            $file = $request->file($run);
            $urlFilename = $filename.'.'.$file->getClientOriginalExtension(); 
            $previewFilename = 'preview'.$filename.'.png'; 
            \File::isDirectory($dir) or \File::makeDirectory($dir,0777,true,true); 
            $img = \Image::make($file->getRealPath());
            $file->move($dir,$urlFilename);  
            $img->resize(100, 100);
            $img->save($dir.$previewFilename);

            $media = new Media;
            $media->title = (!empty($request->input('title')))?$request->input('title'):$file->getClientOriginalName();
            $media->by = \Auth::user()->id;
            $media->size = $file->getClientSize();//oct 
            $media->url = $dir.$urlFilename;
            $media->preview = $dir.$previewFilename;
            $media->save();
        }
        if(!empty($run)){
            return $media;
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $media = Media::find($id);
        return view('admin.media.show',compact('media'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function edit(Media $media)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Media $media)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $media = Media::find($id);
        \File::delete($media->url, $media->preview);
        $media->delete();
        $alert['class'] = "success";
        $alert['title'] = "Done";
        $alert['msg'] = "media <b>$media->title</b> successfully deleted! ";
        \Session::flash('alert',(object)$alert);
        return redirect()->route('admin.media.index');
    }
}
