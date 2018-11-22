<?php

namespace App\Http\Controllers;

/******************************************************
* IM - Vocabulary Builder
* Version : 1.0.2
* Copyright© 2016 Imprevo Ltd. All Rights Reversed.
* This file may not be redistributed.
* Author URL:http://imprevo.net
******************************************************/

use App\User;
use App\Sale;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect;
use Illuminate\Support\Facades\DB;
use Log;
use App\Masternode;
use App\Video;

class VideoController extends Controller
{
  public function __construct()
  {
    $this->middleware(['auth', '2fa'] );
  }

  public function videos(Request $request)
  {
    $query = $request->input('query');
    if($query == null)
    $query = '';

    $videos = Video::where('title', 'like', '%'.$query.'%')->paginate(50);

    return view('videos', [
      'videos' => $videos,
      'search' => $query,
    ]);
  }

  public function newVideo()
  {
    return view('videoEdit', [
      'video' => array('id'=>null, 'title'=>'', 'description'=>'',  'link'=>''),
    ]);
  }

  public function editVideo(Request $request, $id)
  {
    $videos = Video::all();
    return view('videoEdit', [
      'video' => Video::findOrNew($id),
    ]);
  }

  public function postEdit(Request $request)
  {
    $video=[];
    if($request->input('id') != '') {
      $video = Video::findOrNew($request->input('id'));
      $video->title = $request->input('title');
      $video->description = $request->input('description');
      $video->type = $request->input('type');
      $video->link = $request->input('link');
      $video->save();
    } else {
      $video = Video::create([
        'title' => $request->input('title'),
        'description' => $request->input('description'),
        'type' => $request->input('type'),
        'link' => $request->input('link'),
      ]);
    }
    return redirect()->to('videos');
  }

  public function destroy($id)
  {
    $u = Video::findOrNew($id);
    //$this->authorize('destroy', $category);
    //Cat::destroy([$category]);
    $u->delete();
    $ret = array("result"=>"ok");
    return json_encode($ret);
  }
}
