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
				<form id="search-form" method="GET" action="">
				<div class="row">												
					<label class="col-md-1 control-label" for="inputSuccess">Select word set:</label>
					<div class="col-md-4 form-group">
						<select name="wordset_id" id="wordset_id" class="form-control mb-md" onchange="onSelect()">
							@foreach ($wordsets as $wordset)
								<option value="{{$wordset->id}}" @if($wordset->id==$wordset_id) selected="selected"@endif>{{$wordset->name}}</option>
							@endforeach
						</select>
					</div>
				</div>	
                <section class="panel">
                    <header class="panel-heading">
						<div class="row">
							<div class="col-lg-9">	
								<h2 class="panel-title">Submitted words</h2>	
							</div>		
							<div class="col-lg-3">	
								<div class="input-group input-search">
									<input type="text" class="form-control" name="query" id="query" placeholder="Search..." value="{{$search}}">
									<span class="input-group-btn">
										<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
									</span>
								</div>

							</div>								
						</div>
                    </header>
                    <div class="panel-body">
                      <div class="row">
                          <div class="col-sm-6">
                              <div class="mb-md">
                                  <a href="/words/new" id="addToTable" class="btn btn-primary" onclick="AddWord(event)">Add <i class="fa fa-plus"></i></a>
                              </div>
                          </div>
                      </div>
                        <div class="table-responsive">
                            <table class="table table-hover mb-none">
                                <thead><tr>
                                    <th>Id</th>
                                    <th>Source word</th>
                                    <th>Translation</th>
                                    <th>Image</th>
                                    <th>Copyright URL</th>
                                    <th>Audio</th>
                                    <th>Category</th>
                                    <th>Note</th>
                                    <th>Example sentence</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($words as $key=>$word)
                                    <tr>
                                        <td>{{ $word->wordset_index}}</td>
                                        <td>{{ $word->source_word }}</td>
                                        <td>{{ $word->translation }}</td>
                                        <td>
                                            @if ($word->image == '')
                                                <a style="color:#00a65a;"><i class="fa fa-close"></i></a>
                                            @else
                                                <a style="color:#00a65a;"><i class="fa fa-check"></i></a>
                                            @endif
                                        </td>
                                        <td>{{ $word->copyright_url }}</td>
                                        <td>
                                            @if ($word->audio == '')
                                                <a style="color:#00a65a;"><i class="fa fa-close"></i></a>
                                            @else
                                                <a style="color:#00a65a;"><i class="fa fa-check"></i></a>
                                            @endif
                                        </td>
                                        <td>{{ $word->category }}</td>
                                        <td>{{ $word->note }}</td>
                                        <td>{{ $word->example }}</td>
                                        <!-- Task Delete Button -->
                                        <td class="actions-hover actions-fade">
                                            <a href="{{ Config::get('RELATIVE_URL') }}/words/{{ $word->id }}"><i class="fa fa-pencil"></i></a>
                                            <a href="#" class="delete-row" onclick="removeWord({{ $word->id }}, event)"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody></table>
                            {{ $words->links() }}
                        </div>
                    </div>
                </section>
				</form>
            </div>
        </div>
    </section>
    <script>
        function removeWord(id, e) {
            res = confirm("Do you really want to delete this item?");
            if (res){
            console.log(e);
            $.ajax({
                url:'/words/' + id,
                type:'delete'
            }).then(function(ret){
                console.log(ret);
                $(e.target).parents("tr").remove();
            }, function(err){
                console.log(err);
            })
            }
        }
		
		function AddWord(e)
		{
			e.preventDefault();
			e.stopPropagation();
			
			var wordset_id = document.getElementById('wordset_id').value;
            var curUrl = '/words/new' + '?wordset_id=' + wordset_id;
			location.href = curUrl;
		}
		
		function onSelect()
		{	
			$('#search-form').submit();
		}
    </script>
@endsection
