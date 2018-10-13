<?php
/******************************************************
 * IM - Vocabulary Builder
 * Version : 1.0.2
 * Copyright© 2016 Imprevo Ltd. All Rights Reversed.
 * This file may not be redistributed.
 * Author URL:http://imprevo.net
 ******************************************************/
?>
@extends('layouts.back')

@section('content')
  <section role="main" class="content-body">
    <header class="page-header">
      <h2>
        Word Database
      </h2>
    </header>
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="page-header">
              @if($word['id'])
                <h2 class="panel-title">Edit word</h2>
              @else
                <h2 class="panel-title">Add new word</h2>
              @endif
          </header>
          <div class="panel-body">
            <!-- Add New Words -->
            @include('common.errors')
            <form id="wordForm" role="form" class="form-horizontal form-bordered" action="{{ Config::get('RELATIVE_URL') }}/word" method="post" encType="multipart/form-data">
              @if($word['id'])
                <input type="hidden" name="id" value="{{$word->id}}">
              @endif
              <div class="form-group">
                <label class="col-md-3 control-label label-left" for="sourceWord">Source word</label>
                <div class="col-md-6">
                  <input type="text" class="form-control" id="sourceWord" name="sourceWord" value="{{$word['source_word']}}" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label label-left" for="translation">Translation</label>
                <div class="col-md-6">
                  <input type="text" class="form-control" id="translation" name="translation" value="{{$word['translation']}}" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label label-left" for="uploadImage">Upload image</label>
                <div class="col-md-6">
                  {{$word['image']}}
                  <input type="file" class="form-control" id="uploadImage" name="uploadImage">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label label-left" for="copyrightUrl">Copyright URL</label>
                <div class="col-md-6">
                  <input type="url" class="form-control" id="copyrightUrl" name="copyrightUrl" value="{{$word['copyright_url']}}">
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-3 control-label label-left" for="uploadAudio">Upload audio</label>
                <div class="col-md-6">
                  {{$word['audio']}}
                  <input type="file" id="uploadAudio" class="form-control" name="uploadAudio" >
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label label-left" for="categoryId">Select category</label>
                <div class="col-md-6">
                  <select name="categoryId" id="categoryId" class="form-control mb-md">
                    @foreach ($categories as $category)
                      <option value="{{$category->id}}" @if($word['category_id']==$category->id) selected="selected"@endif>{{$category->category}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
			  
			  <div class="form-group">
                <label class="col-md-3 control-label label-left" for="wordsetId">Select word set</label>
                <div class="col-md-6">
                  <select name="wordset_id" id="wordset_id" class="form-control mb-md">
                    @foreach ($wordsets as $wordset)
                      <option value="{{$wordset->id}}" @if($word['wordset_id']==$wordset->id) selected="selected"@endif>{{$wordset->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
			  
              <div class="form-group">
                <label class="col-md-3 control-label label-left" for="note">Note</label>
                <div class="col-md-6">
                  <input type="text" class="form-control" id="note" name="note" value="{{$word['note']}}">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label label-left" for="example">Example sentence</label>
                <div class="col-md-6">
                  <input type="text" class="form-control" id="example" name="example" value="{{$word['example']}}">
                </div>
              </div>
              <div>
                <button type="submit" class="btn btn-primary" style="width:120px">{!! trans('flashcard.save') !!}</button>
                <a class="btn btn-default" href="/words">&nbsp;&nbsp;{!! trans('flashcard.back') !!}&nbsp;&nbsp;</a>
              </div>
            </form>
            <!-- END Add New Words -->
          </div>
        </section>
      </div>
    </div>
  </section>
@endsection
