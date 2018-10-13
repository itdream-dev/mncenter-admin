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
		@if	(!$question['id'])
			@if($question['type'] == 1)
				<h2>Add new single choice question</h2>
			@elseif($question['type'] == 2)
				<h2>Add new select image question</h2>						
			@elseif ($question['type'] == 3)
				<h2 class="panel-title">Add new type audio question</h2>
			@elseif ($question['type'] == 4)
				<h2 class="panel-title">Add new type image question</h2>
			@elseif ($question['type'] == 5)
				<h2 class="panel-title">Add new gap fill question</h2>								
			@endif
		@else
			@if($question['type'] == 1)
				<h2>Edit single choice question</h2>
			@elseif($question['type'] == 2)
				<h2>Edit select image question</h2>					
			@elseif ($question['type'] == 3)
				<h2 class="panel-title">Edit type audio question</h2>
			@elseif ($question['type'] == 4)
				<h2 class="panel-title">Edit type image question</h2>
			@elseif ($question['type'] == 5)
				<h2 class="panel-title">Edit new gap fill question</h2>								
			@endif
		@endif
		</header>
		<div class="row">
			<div class="col-lg-12">
				<section class="panel">
					<header class="panel-heading">
						@if($question['id'])
							@if($question['type'] == 1)
								<h2>Edit single choice question</h2>
							@elseif($question['type'] == 2)
								<h2>Edit select image question</h2>					
							@elseif ($question['type'] == 3)
								<h2 class="panel-title">Edit type audio question</h2>
							@elseif ($question['type'] == 4)
								<h2 class="panel-title">Edit type image question</h2>
							@elseif ($question['type'] == 5)
								<h2 class="panel-title">Edit new gap fill question</h2>								
							@endif
						@else
							@if($question['type'] == 1)
								<h2>Add new single choice question</h2>
							@elseif($question['type'] == 2)
								<h2>Add new select image question</h2>						
							@elseif ($question['type'] == 3)
								<h2 class="panel-title">Add new type audio question</h2>
							@elseif ($question['type'] == 4)
								<h2 class="panel-title">Add new type image question</h2>
							@elseif ($question['type'] == 5)
								<h2 class="panel-title">Add new gap fill question</h2>								
							@endif
						@endif
					</header>
					<div class="panel-body">
						@include('common.errors')
						<form id="form" role="form" class="form-horizontal form-bordered" action="{{ Config::get('RELATIVE_URL') }}/question" method="post" encType="multipart/form-data">
							@if($question['id'])
								<input type="hidden" name="id" value="{{$question['id']}}">
								<input type="hidden" name="answer-data" value="{{$question['answer_data']}}">
								@if ($question['type'] == 1)
									<input type="hidden" name="correct_answer-id" value="{{$question['correct_answer_id']}}">
								@endif
							@endif
							<input type="hidden" id="type" name="type" value="{{$question['type']}}">
							<input type="hidden" id="quiz_id" name="quiz_id" value="{{$question['quiz_id']}}">
							@if( ($question['type'] == 1) || ($question['type'] == 2) || ($question['type'] == 5))
							<div class="form-group">
								<label class="col-md-2 control-label">Instruction</label>
								<div class="col-md-9">
									<textarea type="text" class="summernote" id="instruction" name="instruction" style="height:271px; width:100%" data-plugin-summernote data-plugin-options='{ "height": 180, "codemirror": { "theme": "ambiance" } }'>{{$question['instruction']}}</textarea>
									<!--<div class="summernote" id="instruction" name="instruction" data-plugin-summernote data-plugin-options='{ "height": 180, "codemirror": { "theme": "ambiance" } }'>"{{$question['instruction']}}"</div>-->
								</div>
							</div>
							@endif
							@if ($question['type'] == 1)
								<div class="form-group">
									<div>
										<label class="col-md-2 control-label">Add new answer</label>
										<div class="col-md-10">
											<div class="mb-md">
												<button type = "button" class="btn btn-primary" onClick="AddAnswerField()">Add <i class="fa fa-plus"></i></button>
											</div>
											<div id="answer-list">
											</div>
										</div>
									</div>
								</div>
							@endif
							@if ($question['type'] == 2)
							<div class="form-group">
							<div class="row">
								<label class="col-md-2 control-label">Enter the ID of the word from the word database.Separate each ID with a comma.</label>
								<div class="col-md-5">
										<input type="text" class="form-control" id="answer_data" name="answer_data" required value="{{$question['answer_data']}}">
								</div>
							<!--<label class="col-md-2 control-label">Enter the Correct ID.</label>
								<div class="col-md-2">
									<input type="text" class="form-control" id="correct_answer_id" name="correct_answer_id" required value="{{$question['correct_answer_id']}}">
								</div>-->
							</div>
							</div>
							@endif
							
							@if ($question['type'] == 3)
							<div class="form-group">
							<div class="row">
								<label class="col-md-2 control-label">Enter the ID of the word from the word database.Separate each ID with a comma.</label>
								<div class="col-md-5">
										<input type="text" class="form-control" id="answer_data" name="answer_data" required value="{{$question['answer_data']}}">
								</div>
							<!--<label class="col-md-2 control-label">Enter the Correct ID.</label>
								<div class="col-md-2">
									<input type="text" class="form-control" id="correct_answer_id" name="correct_answer_id" required value="{{$question['correct_answer_id']}}">
								</div>-->
							</div>
							</div>
							@endif		
							
							@if ($question['type'] == 4)
							<div class="form-group">
							<div class="row">
								<label class="col-md-2 control-label">Enter the ID of the word from the word database.Separate each ID with a comma.</label>
								<div class="col-md-5">
										<input type="text" class="form-control" id="answer_data" name="answer_data" required value="{{$question['answer_data']}}">
								</div>
							<!--<label class="col-md-2 control-label">Enter the Correct ID.</label>
								<div class="col-md-2">
									<input type="text" class="form-control" id="correct_answer_id" name="correct_answer_id" required value="{{$question['correct_answer_id']}}">
								</div>-->
							</div>
							</div>
							@endif		
							
							@if ($question['type'] == 1 || $question['type'] == 5)
							<div class="form-group">
								<label class="col-md-2 control-label">Optional note</label>
								<div class="col-md-9">
									<textarea type="text" class="summernote" id="note" name="note" style="height:271px; width:100%" style="height:271px; width:100%" data-plugin-summernote data-plugin-options='{ "height": 180, "codemirror": { "theme": "ambiance" } }'>{{$question['note']}}</textarea>
								</div>
							</div>
							@endif							
							<div>
								<button type="submit" class="btn btn-primary" style="width:120px">{!! trans('flashcard.save') !!}</button>
							</div>
						</form>
					</div>
				</section>
			</div>
		</div>
	</section>
	<script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
		var AnswerElementCount = 0;
        var id = $("#form input[name='id']").val();
        var type = $("#form input[name='type']").val();
        var answerData = $("#form input[name='answer-data']").val();
        var correctAnswer = $("#form input[name='correct_answer-id']").val();

		if (id)
		{
		    if (type == 1)
			{
				var arryAnswer = answerData.split(",");
				if (answerData.includes("||"))
					arryAnswer = answerData.split("||");
				
                if (arryAnswer.length > 0) {
                    for (answer in arryAnswer) {
                        AnswerElementCount++;
                        var strcheck = '';
                        if (arryAnswer.length == 1) strcheck = 'checked';
                        else
						{
						    console.log(arryAnswer[answer], correctAnswer);
						    if (arryAnswer[answer] == correctAnswer)
							{
                                strcheck = 'checked';
							}
						}

						html = '<div id="answerDiv" class="col-lg-10 col-md-10 col-sm-12 " style="background:#e0dddd;text-align: center;margin-top:10px">\
                  	<div style="font-size:17px;width:100%">\
                		<p name="answerLabel"> Answer #' + AnswerElementCount + '</p>\
                		<a href="#" onclick="removeAnswerField(event, this)"><i class="fa fa-trash-o pull-right"></i></a>\
                  	</div>\
        		  	<div style="width:100%;padding:0 20px 0 20px">\
            	  		<Textarea style="width:100%" name="answer-text" rows="4">' + arryAnswer[answer] + '</Textarea>\
            	  	</div>\
            	  	<div style="font-size:12px">\
            	  		<span>Mark as correct answer</span>\
        		  		<span>\
        					<input type="radio" name="answer-radio"' + strcheck + '>\
            	  		</span>\
            	  	</div>\
            	  </div>';
                        $("#answer-list").append(html);
                    }
                }
                $("#correct_answer_id").value = correctAnswer;
			}
		}

        function AddAnswerField()
		{
		    AnswerElementCount++;

			var checkvalue = false;


            var strcheck = '';
            if (AnswerElementCount == 1)
                strcheck = 'checked'


			html='<div id="answerDiv" class="col-lg-10 col-md-10 col-sm-12 " style="background:#e0dddd;text-align: center;margin-top:10px">\
                  	<div style="font-size:17px;width:100%">\
                		<p name="answerLabel"> Answer #'+ AnswerElementCount + '</p>\
                		<a href="#" onclick="removeAnswerField(event, this)"><i class="fa fa-trash-o pull-right"></i></a>\
                  	</div>\
        		  	<div style="width:100%;padding:0 20px 0 20px">\
            	  		<Textarea style="width:100%" name="answer-text" rows="4"></Textarea>\
            	  	</div>\
            	  	<div style="font-size:12px">\
            	  		<span>Mark as correct answer</span>\
        		  		<span>\
        					<input type="radio" name="answer-radio"' + strcheck + '>\
            	  		</span>\
            	  	</div>\
            	  </div>';

			$("#answer-list").append(html);
		}

		function removeAnswerField(event, obj)
		{
			AnswerElementCount--;
			$($(obj).parents("#answerDiv")[0]).remove();
			if (AnswerElementCount > 0) {
                var answerLabel = document.getElementsByName("answerLabel");
                for (i = 0; i < answerLabel.length; i++) {
                    var strLabel = 'Answer #' + (i + 1);
                    answerLabel[i].textContent = strLabel;
                }
            }
		}

        $(function() {
            $("#form").submit(function(e){
                e.preventDefault();
                e.stopPropagation();
                var id = $("#form input[name='id']").val();
                var type = $("#form input[name='type']").val();
                var quizid = $("#form input[name='quiz_id']").val();


//                var instruct  = document.getElementById('instruction').value;
  //             instruct = instruct.replace(/"/g,"\\\"");
  //              document.getElementById('instruction').value = instruct;
                var formData = new FormData(this);
				if (type == 1)
				{
 					var answerData;
                    var correctAnswer;
                    var answers = document.getElementsByName("answer-text");
                    var correct_radios = document.getElementsByName("answer-radio");
                    if (answers)
					{
						var correct_i = 0;
					    for (i=0; i<correct_radios.length; i++)
						{
							if (correct_radios[i].checked == true)
							{
								correctAnswer = answers[i].value;
							}
						}
                        for (i=0; i<answers.length; i++)
						{
							if (i == 0)
								answerData = answers[i].value;
							else
							{
								answerData = answerData + "||" + answers[i].value;
							}
						}
						formData.append ("answer_data",  answerData);
						formData.append ("correct_answer_id", correctAnswer);
						var url = "/question";
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: formData,
                            async: true,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function (ret) {
                                //console.log(ret);
                                var curUrl = '/quizzes/' + quizid;
                                location.href = curUrl;

                            },
                            error:  function(ret)
							{
                                alert(ret);
							}
                        });
					}

				}
				else if (type == 2)
				{
					var answers = document.getElementById('answer_data').value;
					var answer_array = answers.split(',');

					var words = [];
				
	
					@foreach ($words as $word)
						word = {};
						word.id = "{{$word->id}}".trim();	
						word.wordset_index = "{{$word->wordset_index}}".trim()
						words.push(word);
					@endforeach

					var bExist = false;

					for (answer in answer_array)
					{
						bExist = false;
						for (word in words)
						{
							if (answer_array[answer].trim() == words[word].wordset_index)
							{
								bExist = true;
							}
						}
						if (bExist == false)
						{
						new PNotify({
								text: 'This word ids includes incorrect id. Please correct them first',
								type: 'error',
								icon: false,
								addclass: 'ui-pnotify-no-icon',
								});
							return;
						}
					}
                    var url = "/question";
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: formData,
						mimeType:"multipart/form-data",
                        async: true,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (ret) {
                           // console.log(ret);
                            var curUrl = '/quizzes/' + quizid;
                            location.href = curUrl;
                        },
                        error: function (errMsg) {
                    		alert(errMsg);
                		}
					});
				}
				else if (type == 3)
				{
 					var answers = document.getElementById('answer_data').value;
					var answer_array = answers.split(',');

					var words = [];
				
	
					@foreach ($words as $word)
						word = {};
						word.id = "{{$word->id}}".trim();	
						word.wordset_index = "{{$word->wordset_index}}".trim()
						words.push(word);
					@endforeach

					var bExist = false;

					for (answer in answer_array)
					{
						bExist = false;
						for (word in words)
						{
							if (answer_array[answer].trim() == words[word].wordset_index)
							{
								bExist = true;
							}
						}
						if (bExist == false)
						{
						new PNotify({
								text: 'This word ids includes incorrect id. Please correct them first',
								type: 'error',
								icon: false,
								addclass: 'ui-pnotify-no-icon',
								});
							return;
						}
					}
                    var url = "/question";
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: formData,
						mimeType:"multipart/form-data",
                        async: true,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (ret) {
                           // console.log(ret);
                            var curUrl = '/quizzes/' + quizid;
                            location.href = curUrl;
                        },
                        error: function (errMsg) {
                    		alert(errMsg);
                		}
					});

				}
				else if (type == 4)
				{
 				var answers = document.getElementById('answer_data').value;
					var answer_array = answers.split(',');

					var words = [];
				
	
					@foreach ($words as $word)
						word = {};
						word.id = "{{$word->id}}".trim();	
						word.wordset_index = "{{$word->wordset_index}}".trim()
						words.push(word);
					@endforeach

					var bExist = false;

					for (answer in answer_array)
					{
						bExist = false;
						for (word in words)
						{
							if (answer_array[answer].trim() == words[word].wordset_index)
							{
								bExist = true;
							}
						}
						if (bExist == false)
						{
						new PNotify({
								text: 'This word ids includes incorrect id. Please correct them first',
								type: 'error',
								icon: false,
								addclass: 'ui-pnotify-no-icon',
								});
							return;
						}
					}
                    var url = "/question";
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: formData,
						mimeType:"multipart/form-data",
                        async: true,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (ret) {
                           // console.log(ret);
                            var curUrl = '/quizzes/' + quizid;
                            location.href = curUrl;
                        },
                        error: function (errMsg) {
                    		alert(errMsg);
                		}
					});

				}
				else if (type == 5)
				{
 					
                    var url = "/question";
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: formData,
						mimeType:"multipart/form-data",
                        async: true,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (ret) {
                           // console.log(ret);
                            var curUrl = '/quizzes/' + quizid;
                            location.href = curUrl;
                        },
                        error: function (errMsg) {
                    		alert(errMsg);
                		}
					});

				}
                //e.preventDefault();
                //e.stopPropagation();
            })
        })
</script>
@endsection
