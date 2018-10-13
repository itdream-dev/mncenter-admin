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
				Lesson management
			</h2>
		</header>
		<div class="row">
			<div class="col-lg-12">
				<section class="panel">
					<header class="panel-heading">
						@if($lesson['id'] != null)
							<h2 class="panel-title">Edit lesson</h2>
						@else
							<h2 class="panel-title">Add new lesson</h2>
						@endif
					</header>
					<div class="panel-body">
						@include('common.errors')
						<form id="form" role="form" class="form-horizontal form-bordered" action="{{ Config::get('RELATIVE_URL') }}/lesson" method="post" encType="multipart/form-data">
							@if($lesson['id'])
								<input type="hidden" name="id" value="{{$lesson->id}}">
								<input type="hidden" id="exercise_sorts" name="exercise_sorts" value="">
							@endif
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="title">Lesson title <span class="required">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control" id="title" name="title" required value="{{$lesson['title']}}">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="description">Description</label>
								<div class="col-md-6">
									<textarea type="text" class="form-control" id="description" name="description">{{$lesson['description']}}</textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="uploadPhoto">Lesson image</label>
								<div class="col-md-6">
									@if($lesson['id'] && $lesson['image'])
									<img src="{{$lesson['image']}}" style="max-height:200px;margin-bottom: 10px">
									@endif
									<input type="file" id="uploadPhoto" class="form-control" name="uploadPhoto" >
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="isTrial">Trial lesson?</label>
								<div class="col-md-6">
									<div class="switch switch-primary">
										<input type="checkbox" name="isTrial" value='1' data-plugin-ios-switch @if($lesson['is_trial']) checked="checked" @endif/>
									</div>
								</div>
							</div>
								<div class="form-group">
									<label class="col-md-3 control-label label-left" for="courseId">Select a course <span class="required">*</span></label>
									<div class="col-md-6">
										<select class="form-control" name="courseId" id="courseId" required onchange="selectCourse(this.value)">
											<option value="">Select a course</option>
											@foreach ($courses as $item)
												<option value="{{$item->id}}" @if($lesson['course_id']==$item->id) selected @endif>{{$item->title}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label label-left" for="levelId">Select a level <span class="required">*</span></label>
									<div class="col-md-6">
										<select class="form-control" name="levelId" id="levelId" required>
											<option value="">Select a level</option>
											@if($lesson['course_id'] != '')
											@foreach ($lesson->course->levels as $item)
												<option value="{{$item->id}}" @if($lesson['level_id']==$item->id) selected @endif>{{$item->title}}</option>
											@endforeach
											@endif
										</select>
									</div>
								</div>
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="isPublic">Public lesson?</label>
								<div class="col-md-6">
									<div class="switch switch-primary">
										<input type="checkbox" name="isPublic" value='1' data-plugin-ios-switch @if($lesson['is_public']) checked="checked" @endif/>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="isFree">Free lesson?</label>
								<div class="col-md-6">
									<div class="switch switch-primary">
										<input type="checkbox" name="isFree" value='1' data-plugin-ios-switch @if($lesson['is_free']) checked="checked" @endif/>
									</div>
								</div>
							</div>

							<div id="syllabus-div-label" class="form-group">
							@if ($syllabus_list)
								<label class="col-md-3 control-label label-left" for="Syllabus details" style="font-size:20px;font-weight:bold">Syllabus details</label>
							@endif
							</div>

							<div id="syllabus-div" class="row"  style="padding-left:15px">
								@if ($syllabus_list && count($syllabus_list) > 0)
									@foreach ($syllabus_list as $syllabus)
										<div class="form-group">
											<label class="col-md-3 control-label label-left" for="syllabus">{{$syllabus['module_name']}}</label>
											<div class="col-md-6">
												<input type="text" class="form-control" id="{{$syllabus['module_id']}}" name="syllabus-{{$syllabus['module_id']}}" value="{{$syllabus['description']}}">
											</div>
										</div>
									@endforeach
								@else
									@if ($lesson_course)
										@foreach ($lesson_course->modules as $module)
										<div class="form-group">
											<label class="col-md-3 control-label label-left" for="syllabus">{{$module['title']}}</label>
											<div class="col-md-6">
												<input type="text" class="form-control" id="{{$module['module_id']}}" name="syllabus-{{$module['id']}}" value="">
											</div>
										</div>
										@endforeach
									@endif
								@endif
							</div>

							<div style="margin-top:15px">
								<button onclick="SaveLesson()" class="btn btn-primary" style="width:120px">{!! trans('flashcard.save') !!}</button>
							</div>
						</form>
						@if($lesson['id'])
							<div class="row" style="margin-top:20px;border-bottom: 1px solid #eff2f7;margin-bottom: 15px;">
								<div class="col-md-12">
									<h4><strong>Add new exercise to this lesson</strong></h4>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<select class="form-control" id="exerciseType">
										<option value="">Please select an exercise type</option>
										<option value="video">Video</option>
										<option value="quiz">Quiz</option>
										<option value="translation">Translation</option>
										<option value="text">Text</option>
									</select>
								</div>
								<div class="col-md-6">
									<div class="mb-md">
										<button id="addToTable" class="btn btn-primary" onClick="createExercise(event)">Add <i class="fa fa-plus"></i></button>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<table id="table-exercises" class="table table-bordered table-striped mb-none" id="datatable-editable">
										<thead>
										<tr>
											<th>Exercise Title</th>
											<th>Created by</th>
											<th>Date added</th>
											<th>Exercise type</th>
											<th>Module</th>
											<th>Actions</th>
										</tr>
										</thead>
										<tbody id="exercise-list">
										@foreach ($lesson->exercises as $item)
											<tr id="tr-ex-{{$item->id}}">
												<td>{{$item->title}}</td>
												<td>{{$item->createdBy?$item->createdBy->name:''}}</td>
												<td>{{$item->created_at}}</td>
												<td>{{$item->type}}</td>
												<td>{{$item->module->title}}</td>
												<td class="actions">
													<a href="#" class="on-default edit-row" onclick="editExercise({{$item->id}}, event)"><i class="fa fa-pencil"></i></a>
													<a href="#" class="on-default remove-row" onclick="removeExercise({{$item->id}}, event)"><i class="fa fa-trash-o"></i></a>
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
		<div id="video-exercise-modal" class="modal-block mfp-hide" style="max-width:800px">
			<section class="panel">
				<form id="exerciseForm" role="form" class="form-horizontal form-bordered" encType="multipart/form-data">
				<header class="panel-heading">
					<h2 class="panel-title" id="exerciseModalTitle"></h2>
				</header>
				<div class="panel-body">
					<div class="modal-wrapper">
							<input type="hidden" name="id">
							<input type="hidden" name="type">
							<input type="hidden" name="lessonId" value="{{$lesson['id']}}">
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="title">Exercise title <span class="required">*</span></label>
								<div class="col-md-9">
									<input type="text" class="form-control" id="title" name="title" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="description">Description</label>
								<div class="col-md-9">
									<textarea type="text" class="form-control" id="description" name="description"></textarea>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label label-left" for="description">Module</label>
								<div class="col-md-9">
									<select class="form-control" name="moduleId" id="moduleId" required>
										<option value="">Select a module</option>
									</select>
								</div>
							</div>
							<!-- video exercise view-->
							<div id="videoDiv">
								<div class="form-group">
									<label class="col-md-3 control-label label-left" for="description">Video url</label>
									<div class="col-md-9">
										<input type="url" class="form-control" id="videoUrl" name="videoUrl">
									</div>
								</div>
							</div>
							<!-- quiz exercise view-->
							<div id="quizDiv">
								<div class="form-group">
									<label class="col-md-3 control-label label-left" for="example">Example</label>
									<div class="col-md-9">
										<textarea type="text" class="form-control" id="example" name="example" rows="3"></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label label-left" for="quizUploadAudio">Audio</label>
									<div class="col-md-9">
										<label id="quizDiv-uploadAudio"></label>
										<input type="file" id="quizUploadAudio" class="form-control" name="quizUploadAudio" >
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label label-left" for="description">Quiz</label>
									<div class="col-md-9">
										<select class="form-control" name="quizId" id="quizId">
											<option value="">Select a quiz</option>
											@if ($lesson['id'])
												@foreach ($lesson->quizzes as $item)
													<option value="{{$item->id}}">{{$item->title}}</option>
												@endforeach
											@endif
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label label-left" for="quizText">Text</label>
									<div class="col-md-9">
										<textarea type="text" class="form-control" id="quizText" name="quizText" rows="3"></textarea>
									</div>
								</div>
							</div>

							<!-- translation exercise view-->
							<div id="translationDiv">
								<div class="form-group">
									<label class="col-md-3 control-label label-left" for="uploadAudio">Add audio</label>
									<div  class="col-md-9">
										<label id="translationDiv-uploadAudio"></label>
										<input type="file" id="translationUploadAudio" class="form-control" name="translationUploadAudio">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label label-left" for="firstColumn">First 1/2 column</label>
									<div class="col-md-9">
										<textarea type="text" class="form-control" id="firstColumn" name="firstColumn" rows="3"></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label label-left" for="secondColumn">Second 1/2 column</label>
									<div class="col-md-9">
										<textarea type="text" class="form-control" id="secondColumn" name="secondColumn" rows="3"></textarea>
									</div>
								</div>
							</div>

							<!-- text exercise view-->
							<div id="textDiv">
								<div class="form-group">
									<label class="col-md-3 control-label label-left" for="uploadAudio">Add audio</label>
									<div  class="col-md-9">
										<label id="textDiv-uploadAudio"></label>
										<input type="file" id="textUploadAudio" class="form-control" name="textUploadAudio">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-3 control-label label-left" for="content">Content</label>
									<div class="col-md-9">
										<textarea type="text" class="form-control" id="content" name="content" rows="3"></textarea>
									</div>
								</div>

							</div>
					</div>
				</div>
				<footer class="panel-footer">
					<div class="row">
						<div class="col-md-12 text-right">
							<button type="submit" class="btn btn-primary modal-confirm">Confirm</button>
							<button class="btn btn-default modal-dismiss">Cancel</button>
						</div>
					</div>
				</footer>
				</form>
			</section>
		</div>
	</section>
	<script type="text/javascript" src="{{ Config::get('RELATIVE_URL') }}/assets/vendor/dragtable/js/jquery.tablednd.0.7.min.js"></script>
	<script type="text/javascript">
		var exercise_sorts = '';
		@if ($lesson['id'])
			document.getElementById('exercise_sorts').value = exercise_sorts;
		@endif
		$(document).ready(function() {
    		$("#table-exercises").tableDnD({
	    		onDragClass: "myDragClass",
	    		onDrop: function(table, row) {
            	var rows = table.tBodies[0].rows;
            	for (var i=0; i<rows.length; i++) {
                exercise_sorts += rows[i].id.slice(6,rows[i].id.length)+",";
            	}
							exercise_sorts = exercise_sorts.slice(0, exercise_sorts.length-1);
	        	//	console.log(exercise_sorts);
	    		},
					onDragStart: function(table, row) {
							exercise_sorts = '';
						//	console.log("Started dragging row "+row.id);
					}
				});
		});
		var levelList= [];
		var moduleList= [];
		var exerciseList = [];
		@foreach($courses as $course)
				levelList['{{$course->id}}'] = JSON.parse('<?php echo json_encode($course->levels)?>');
				moduleList['{{$course->id}}'] = JSON.parse('<?php echo json_encode($course->modules)?>');
		@endforeach
		@if($lesson['id'])
		@foreach($lesson->exercises as $ex)
			exerc = {};
			exerc.id = "{{$ex->id}}".trim();
			exerc.title = "{{$ex->title}}";
			exerc.description = <?php echo json_encode($ex->description)?>;
			exerc.type = "{{$ex->type}}";
			exerc.module_id = "{{$ex->module_id}}";
			exerc.video_url = "{{$ex->video_url}}";
			exerc.content1 = <?php echo json_encode($ex->content1)?>;
			exerc.content2 = <?php echo json_encode($ex->content2)?>;
			exerc.lesson_id = "{{$ex->lesson_id}}";
			exerc.audio = "{{$ex->audio}}";
			exerc.quiz_id = "{{$ex->quiz_id}}";
			exerc.created_by = "{{$ex->created_by}}"
			exerciseList.push(exerc);
		@endforeach
		@endif
		function SaveLesson()
		{
			@if ($lesson['id'])
				document.getElementById('exercise_sorts').value = exercise_sorts;
				//console.log(document.getElementById('exercise_sorts').value);
			@endif
			$('#form').submit();
		}
		$(function(){
			$("#form, #exerciseForm").validate({
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
			$("#exerciseForm").submit(function(){
				if($("#exerciseForm").valid()){
					var currentType = $("#exerciseType").val();

					var id = $("#exerciseForm input[name='id']").val();
					if (currentType == 'text')
					{
						var content  = document.getElementById('content').value;
						if (content)
						{
							 //content = content.replace(/\r/g,"-----");
						//	 content = content.replace(/\n/g," ");
						}
						document.getElementById('content').value = content;
					}
					if (currentType=='translation'){
						var firstColumn = document.getElementById('firstColumn').value;
						if (firstColumn)
						{
							 //content = content.replace(/\r/g,"-----");
						//	 firstColumn = firstColumn.replace(/\n/g," ");
						}
						document.getElementById('firstColumn').value = firstColumn;

						var secondColumn = document.getElementById('secondColumn').value;
						if (secondColumn)
						{
							 //content = content.replace(/\r/g,"-----");
						//	 secondColumn = secondColumn.replace(/\n/g," ");
						}
						document.getElementById('secondColumn').value = secondColumn;
					}

					var formData = new FormData($(this)[0]);
					var pageMode = (id==''?'create':'update');
					/*
					.HTASCCESS
					php_value upload_max_filesize = 64M
					php_value post_max_size = 164M
					php_value max_execution_time 300
					php_value max_input_time 300*/



					var url = "/exercise";
					$.ajax({
						url: url,
						type: 'POST',
						data: formData,
						async: true,
						success: function (ret) {
							var data = JSON.parse(ret);

							//get module title

							var modules = moduleList[$('#courseId').val()];
							var module = _.find(modules, function(o){
								return o.id == data.module_id;
							});

							if(pageMode == 'create') {

								$("#exercise-list").append('<tr id="tr-ex-' + data.id + '">\
									<td>' + data.title + '</td>\
									<td>' + '{{Auth::user()->name}}'+ '</td>\
									<td>' + data.created_at + '</td>\
									<td>' + data.type + '</td>\
									<td>' + module.title + '</td>\
									<td class="actions">\
											<a href="#" class="on-default edit-row" onclick="editExercise(' + data.id + ', event)"><i class="fa fa-pencil"></i></a>\
											<a href="#" class="on-default remove-row" onclick="removeExercise(' + data.id + ', event)"><i class="fa fa-trash-o"></i></a>\
											</td>\
											</tr>')
								exerciseList.push(data);
							} else {
								var oldData = _.find(exerciseList, function(o){
									return o.id == data.id;
								});

								var createBy = oldData.created_by;

								_.extend(oldData, data);
								oldData.created_by = createBy;
								$("#tr-ex-" + oldData.id).html('<td>' + oldData.title + '</td>\
									<td>' + '{{Auth::user()->name}}' + '</td>\
									<td>' + oldData.created_at + '</td>\
									<td>' + oldData.type + '</td>\
									<td>' + module.title + '</td>\
									<td class="actions">\
											<a href="#" class="on-default edit-row" onclick="editExercise(' + data.id + ', event)"><i class="fa fa-pencil"></i></a>\
											<a href="#" class="on-default remove-row" onclick="removeExercise(' + data.id + ', event)"><i class="fa fa-trash-o"></i></a>\
									</td>');
							}

							$.magnificPopup.close();
						},
						cache: false,
						contentType: false,
						processData: false
					});
				}

				return false;
			})

			$(document).on('click', '.modal-dismiss', function (e) {
				e.preventDefault();
				$.magnificPopup.close();
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
				var modules = moduleList[courseId];
				//console.log(modules);
				if (modules.length > 0){
					$('#syllabus-div-label').html('<label class="col-md-3 control-label label-left" for="Syllabus details" style="font-size:20px;font-weight:bold">Syllabus details</label>');
					$('#syllabus-div').html('');
					html = '';
					for (var j = 0; j < modules.length; j++){
						html = html +'<div class="form-group">\
						<label class="col-md-3 control-label label-left" for="syllabus">'+modules[j].title+'</label>\
						<div class="col-md-6"> \
						<input type="text" class="form-control" id="'+modules[j].id+'" name="syllabus'+modules[j].id+'" value=""/>\
						</div> \
						</div>';
					}
					$('#syllabus-div').html(html);
				}
			}
		}

		function removeExercise(id, e){
			e.preventDefault();
			e.stopPropagation();
			res = confirm("Do you really want to delete this item?");
			if (res){

				$.ajax({
					url:'/exercises/' + id,
					type:'delete'
				}).then(function(ret){
					console.log(ret);
					$("#tr-ex-" + id).remove();
				}, function(err){
					console.log(err);
				})
			}

		}

		function editExercise(id, e){
			e.preventDefault();
			e.stopPropagation();

			var exercise = _.find(exerciseList, function(o){
				console.log(o.id, id);
				return o.id == id
			});

			console.log(exercise);
			if(exercise) {
				initExerciseModal(exercise.type);

				$("#exerciseForm #title").val(exercise.title);
				$("#exerciseForm #description").val(exercise.description);
				$("#exerciseForm #moduleId").val(exercise.module_id);
				$("#exerciseForm input[name='id']").val(exercise.id);

				switch(exercise.type) {
					case 'video':
						$("#exerciseForm #videoUrl").val(exercise.video_url||'');
						break;
					case 'text':
						document.getElementById("textDiv-uploadAudio").innerHTML = exercise.audio;
						$("#exerciseForm #content").val(exercise.content1||'');
						//$("#exerciseForm #content").innerHTML = exercise.content1;
						break;
					case 'translation':

						document.getElementById("translationDiv-uploadAudio").innerHTML = exercise.audio;
						$("#exerciseForm #firstColumn").val(exercise.content1||'');
						$("#exerciseForm #secondColumn").val(exercise.content2||'');
						break;
					case 'quiz':
						document.getElementById("quizDiv-uploadAudio").innerHTML = exercise.audio;
						$("#exerciseForm #example").val(exercise.content1||'');
						$("#exerciseForm #quizText").val(exercise.content2||'');
						$("#exerciseForm #quizId").val(exercise.quiz_id||'');
						break;
				}

				$.magnificPopup.open({
					items: {
						src: '#video-exercise-modal'
					},
					type: 'inline'
				});
			}
		}

		function createExercise(e){
			e.preventDefault();
			e.stopPropagation();

			var currentType = $("#exerciseType").val();
			$("#exerciseForm #title").val('');
			$("#exerciseForm #description").val('');
			$("#exerciseForm #moduleId").val('');
			$("#exerciseForm input[name='id']").val('');
			if(currentType == '') {
				new PNotify({
					text: 'Please select an exercise type first',
					type: 'error',
					icon: false,
					addclass: 'ui-pnotify-no-icon',
				});
				return;
			}
			//init module select first
			if($('#courseId').val() == '') {
				new PNotify({
					text: 'Please select a course first',
					type: 'error',
					icon: false,
					addclass: 'ui-pnotify-no-icon',
				});
				return;
			}
			initExerciseModal(currentType);

			$.magnificPopup.open({
				items: {
					src: '#video-exercise-modal'
				},
				type: 'inline'
			});
		}

		function initExerciseModal(type) {
			var moduleSelect = $('#moduleId');
			moduleSelect.empty();
			moduleSelect.append('<option value="">Select a module</option>');
			var modules = moduleList[$('#courseId').val()];
			for (var i = 0; i < modules.length; i++) {
				moduleSelect.append('<option value=' + modules[i].id + '>' + modules[i].title + '</option>');
			}
			$("#videoUrl").val("");
			$("#content").val("");
			$("#uploadAudio").val("");
			$("#firstColumn").val("");
			$("#secondColumn").val("");
			$("#example").val("");
			$("#quizText").val("");
			$("#quizUploadAudio").val("");
			$("#quizId").val("");

			$("#videoDiv").hide();
			$("#quizDiv").hide();
			$("#translationDiv").hide();
			$("#textDiv").hide();

			switch(type) {
				case 'video':
					modalTitle = "Video exercise";

					$("#videoDiv").show();
					break;
				case 'quiz':
					modalTitle = "Quiz exercise";
					$("#quizDiv").show();
					break;
				case 'translation':
					modalTitle = "Translation exercise";
					$("#translationDiv").show();
					break;
				case 'text':
					modalTitle = "Text exercise";
					$("#textDiv").show();
					break;
			}

			$("#exerciseModalTitle").text(modalTitle);
			$("input[name='type']").val(type);
		}
	</script>
@endsection
