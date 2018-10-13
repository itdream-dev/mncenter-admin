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
				Quiz management
			</h2>
		</header>
		<div class="row">
			<div class="col-lg-12">
				<section class="panel">
					<header class="panel-heading">
						@if($quiz['id'])
							<h2 class="panel-title">Edit quiz</h2>
						@else
							<h2 class="panel-title">Add new quiz</h2>
						@endif
					</header>
					<div class="panel-body">
						@include('common.errors')
						<form id="form" role="form" class="form-horizontal form-bordered" action="{{ Config::get('RELATIVE_URL') }}/quiz" method="post" encType="multipart/form-data">
							@if($quiz['id'])
								<input type="hidden" name="id" value="{{$quiz->id}}">
							@endif
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="title">Quiz title <span class="required">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="title" name="title" required value="{{$quiz['title']}}">
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="wordsetId">Select Wordset</label>
								<div class="col-md-6">
								<select name="wordset_id" id="wordset_id" class="form-control mb-md">
									@foreach ($wordsets as $wordset)
										<option value="{{$wordset->id}}" @if($quiz['wordset_id']==$wordset->id) selected="selected"@endif>{{$wordset->name}}</option>
									@endforeach
								</select>
								</div>
							</div>
			  
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="randomType">Question randomization <span class="required">*</span></label>
								<div class="col-md-6">
									<select class="form-control" id="randomType" name="randomType" required>
										<option value="">Select an option from the list</option>
										<option value="1" @if($quiz['random_type']=='1') selected @endif>Do not randomize questions</option>
										<option value="2" @if($quiz['random_type']=='2') selected @endif>Randomize questions but not answers</option>
										<option value="3" @if($quiz['random_type']=='3') selected @endif>Randomize answers but not questions</option>
										<option value="4" @if($quiz['random_type']=='4') selected @endif>Randomize both questions and answers</option>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="courseId">Course</label>
								<div class="col-md-6">
									<select class="form-control" name="courseId" id="courseId" onchange="selectCourse(this.value)">
										<option value="0">Select a course</option>
										@foreach ($courses as $item)
											<option value="{{$item->id}}" @if($quiz['course_id']==$item->id) selected @endif>{{$item->title}}</option>
										@endforeach
									</select>
								</div>
							</div>
								<div class="form-group">
									<label class="col-md-3 control-label label-left" for="levelId">Level</label>
									<div class="col-md-6">
										<select class="form-control" name="levelId" id="levelId">
											<option value="0">Select a level</option>
											@if($quiz['course_id'])
												@if ($quiz->course)
												@foreach ($quiz->course->levels as $item)
													<option value="{{$item->id}}" @if($quiz['level_id']==$item->id) selected @endif>{{$item->title}}</option>
												@endforeach
												@endif
											@endif
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label label-left" for="moduleId">Module</label>
									<div class="col-md-6">
										<select class="form-control" name="moduleId" id="moduleId">
											<option value="0">Select a module</option>
											@if($quiz['course_id'] != '')
												@if ($quiz->course)
												@foreach ($quiz->course->modules as $item)
													<option value="{{$item->id}}" @if($quiz['module_id']==$item->id) selected @endif>{{$item->title}}</option>
												@endforeach
												@endif
											@endif
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label label-left" for="lessonId">Lesson</label>
									<div class="col-md-6">
										<select class="form-control" name="lessonId" id="lessonId">
											<option value="0">Select a lesson</option>
											@if($quiz['course_id'] != '')
												@if ($quiz->course)
												@foreach ($quiz->course->lessons as $item)
													<option value="{{$item->id}}" @if($quiz['lesson_id']==$item->id) selected @endif>{{$item->title}}</option>
												@endforeach
												@endif
											@endif
										</select>
									</div>
								</div>
							<div>
								<button type="submit" class="btn btn-primary" style="width:120px">{!! trans('flashcard.save') !!}</button>
							</div>
						</form>
						@if($quiz['id'])
							<div class="row" style="margin-top:20px;border-bottom: 1px solid #eff2f7;margin-bottom: 15px;">
								<div class="col-md-12">
									<h4><strong>Add new question to this quiz</strong></h4>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<select class="form-control" id="questionType">
										<option value="">Please select an question type</option>
										<option value="1">Single choice</option>
										<option value="2">Select image</option>
										<option value="3">Type audio</option>
										<option value="4">Type image</option>
										<option value="5">Gap fill</option>
									</select>
								</div>
								<div class="col-md-6">
									<div class="mb-md">
										<button type = "sumbmit" class="btn btn-primary" onClick="createQuestion({{$quiz->id}},event)">Add <i class="fa fa-plus"></i></button>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<table class="table table-bordered table-striped mb-none" id="datatable-editable">
										<thead>
										<tr>
											<th>#</th>
											<th>Question excerpt</th>
											<th>Question type</th>
											<th>Actions</th>
										</tr>
										</thead>
										<tbody id="question-list">
										@foreach ($quiz->questions as $key=>$item)
											<tr id="tr-question-{{$item->id}}">
												<td>{{ ++$key }}</td>
												<td id="td{{$item->id}}"></td>
												<td>{{$item->type}}</td>
												<td class="actions">
													<a href="/questions/{{$item->id}}" class="on-default edit-row" onclick="editQuestion({{$item->id}},event)" ><i class="fa fa-pencil"></i></a>
													<a href="#" class="on-default remove-row" onclick="removeQuestion({{$item->id}},event)"><i class="fa fa-trash-o"></i></a>
												</td>
											</tr>
										@endforeach
										</tbody>
									</table>
								</div>
							</div>
							<br>
						@endif
					</div>
				</section>
			</div>
		</div>
	</section>
	<script type="text/javascript">
		var levelList= [];
		var moduleList= [];
		var lessonList= [];
		@foreach($courses as $course)
				levelList['{{$course->id}}'] = JSON.parse('<?php echo json_encode($course->levels)?>');
				moduleList['{{$course->id}}'] = JSON.parse('<?php echo json_encode($course->modules)?>');
				lessonList['{{$course->id}}'] = JSON.parse('<?php echo json_encode($course->lessons)?>');
		@endforeach
		@if($quiz['id'])
			@foreach ($quiz->questions as $key=>$item)
				var instruction_id = <?php echo json_encode($item->instruction)?>;
				if (instruction_id){
					var instruction_id_array = instruction_id.split("&lt;");
					var instruction_update_array = [];
					var instruction_update='';
					for (i1 = 0; i1 < instruction_id_array.length; i1++)
					{
							var each_array = instruction_id_array[i1].split("&gt;");
							for (i2 = 0; i2<each_array.length; i2++)
							{
								instruction_update_array.push(each_array[i2]);
							}
					}
					for(i3=0; i3<instruction_update_array.length; i3++)
					{
								if (i3 % 2 == 0)
								{
									instruction_update = instruction_update + instruction_update_array[i3];
								}
					}
					var td_id = "td{{$item->id}}"
					var td_each = document.getElementById(td_id);
					td_each.innerHTML = instruction_update;
				}					
			@endforeach
		@endif
		$(function(){
			$("#form").validate({
				highlight: function( label ) {
					$(label).closest('.form-group').removeClass('has-success').addClass('has-error');
				},
				success: function( label ) {
					$(label).closest('.form-group').removeClass('has-error');
					label.remove();
				},
				errorPlacement: function( error, element ) {
					var placement = element.closest('.input-group');
					if (!placement.get(0)) {
						placement = element;
					}
					if (error.text() !== '') {
						placement.after(error);
					}
				}
			});
		});

		function selectCourse(courseId) {
			var levelSelect = $('#levelId');
			levelSelect.empty();
			levelSelect.append('<option value="">Select a level</option>');
			if(courseId != '') {
				var levels = levelList[courseId];
				for (var i = 0; i < levels.length; i++) {
					levelSelect.append('<option value=' + levels[i].id + '>' + levels[i].title + '</option>');
				}
			}
			var moduleSelect = $('#moduleId');
			moduleSelect.empty();
			moduleSelect.append('<option value="">Select a module</option>');
			if(courseId != '') {
				var modules = moduleList[courseId];
				for (var i = 0; i < modules.length; i++) {
					moduleSelect.append('<option value=' + modules[i].id + '>' + modules[i].title + '</option>');
				}
			}
			var lessonSelect = $('#lessonId');
			lessonSelect.empty();
			lessonSelect.append('<option value="">Select a lesson</option>');
			if(courseId != '') {
				var lessons = lessonList[courseId];
				for (var i = 0; i < lessons.length; i++) {
					lessonSelect.append('<option value=' + lessons[i].id + '>' + lessons[i].title + '</option>');
				}
			}
		}

		function removeQuestion(id, e){
			e.preventDefault();
			e.stopPropagation();
			$.ajax({
				url:'/questions/' + id,
				type:'delete'
			}).then(function(ret){
				$("#tr-question-" + id).remove();
			}, function(err){
				console.log(err);
			})
		}

		function editQuestion(id, e){
			e.preventDefault();
			e.stopPropagation();

			var wordset_id = document.getElementById('wordset_id').value;
            var curUrl = '/questions/' + id;
			curUrl = curUrl + '?wordset_id=' + wordset_id;
			location.href = curUrl;
		}

		function createQuestion(id, e){
			e.preventDefault();
            e.stopPropagation();
            var currentType = $("#questionType").val();
            if(currentType == '') {
                new PNotify({
                    text: 'Please select an question type first',
                    type: 'error',
                    icon: false,
                    addclass: 'ui-pnotify-no-icon',
                });
                return;
            }
			var quizid = id;
			var wordset_id = document.getElementById('wordset_id').value;
            var curUrl = '/questions/new/' + currentType;
			curUrl = curUrl + '?quizid=' + quizid;
			curUrl = curUrl + '&wordset_id=' + wordset_id;
			location.href = curUrl;
		}
	</script>
@endsection
