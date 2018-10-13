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
                <h2>Quiz management</h2>
            </header>
            <div class="panel-body" id="pageDocument">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-md">
                            <a href="/quizzes/new" id="addToTable" class="btn btn-primary">Add <i class="fa fa-plus"></i></a>
                        </div>
                    </div>
					<div class="col-sm-6">
						<form id="search-form" method="GET" action="">
						<div class="form-group" style="text-align:right; justify-content:right;">
							<div class="col-md-3">
							</div>
							<div class="col-md-4">
								<select class="form-control" name="courseId" id="courseId" onchange="selectCourse(this.value)">
									<option value="0">Filter by courses</option>
									@foreach (\App\Course::all() as $item)
										<option value="{{$item->id}}" @if($item->id==$courseId) selected="selected"@endif>{{$item->title}}</option>
									@endforeach
								</select>
							</div>	
							<div class="col-md-4">
								<select class="form-control" name="lessonId" id="lessonId">
									<option value="0">Filter by lessons</option>
								</select>
							</div>
							<div class="col-md-1">
								<div class="mb-md">
									<button class="btn btn-primary" type="submit">Go</a>
								</div>								
							</div>							
						</div>
						</form>
					</div>			
                </div>
                <table class="table table-bordered table-striped mb-none" id="datatable-editable">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Created at</th>
                        <th>Shortcode</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($quizzes as $item)
                        <tr id="{{$item->id}}">
                            <td>{{$item->title}}</td>
                            <td>{{$item->createdBy->name}}</td>
                            <td>{{$item->created_at}}</td>
                            <td>{{$item->shortcode}}</td>
                            <td class="actions">
                                <a href="/quizzes/{{$item->id}}" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                                <a href="#" class="on-default remove-row" onclick="remove({{$item->id}})"><i class="fa fa-trash-o"></i></a>
                                <a href="#" class="on-default remove-row" onclick="duplicate({{$item->id}})"><i class="fa fa-copy"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $quizzes->links() }}
            </div>
        </section>
    <script>	
		var lessonList= [];
		@foreach(\App\Course::all() as $course)
			lessonList['{{$course->id}}'] = JSON.parse('<?php echo json_encode($course->lessons)?>');
		@endforeach
		@if ($course)
			console.log("{{$courseId}}");
			var lessonSelect = $('#lessonId');
			lessonSelect.empty();
			lessonSelect.append('<option value="">Filter by lessons</option>');
			var lessons = lessonList["{{$courseId}}"];
			for (var i = 0; i < lessons.length; i++) {
				if (lessons[i].id == "{{$lessonId}}")
					lessonSelect.append('<option value="' + lessons[i].id + '" selected="selected">' + lessons[i].title + '</option>');
				else
					lessonSelect.append('<option value="' + lessons[i].id + '">' + lessons[i].title + '</option>');
			}					
		@endif
		function selectCourse(courseId) {
			var lessonSelect = $('#lessonId');
			lessonSelect.empty();
			lessonSelect.append('<option value="">Filter by lessons</option>');
			if(courseId != '') {
				var lessons = lessonList[courseId];
				for (var i = 0; i < lessons.length; i++) {
					lessonSelect.append('<option value=' + lessons[i].id + '>' + lessons[i].title + '</option>');
				}
			}			
		}
		
        function remove(id) {
          res = confirm("Do you really want to delete this item?");
          if (res){
            $.ajax({
              url:'/quizzes/' + id,
              type:'delete'
            }).then(function(ret){
                console.log(ret);
                location.href = "{{$quizzes->url($quizzes->currentPage())}}"
            }, function(err){
                console.log(err);
            })
          }
        }

        function duplicate(id) {
            $.ajax({
                url:'/quizzes/duplicate',
                type:'post',
                data:{id:id}
            }).then(function(ret){
                //console.log(ret);
                location.href = "{{$quizzes->url($quizzes->currentPage())}}"
            }, function(err){
                console.log(err);
            })
        }

    $(function() {
    });
</script>

@endsection
