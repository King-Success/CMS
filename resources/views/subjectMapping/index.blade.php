   <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bootstrap 4 Starter Pack</title>
    <!-- bootstrap cdn here -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <!-- fontawesome cdn here -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <!-- jQuery -->
    <script src="//code.jquery.com/jquery.js"></script>
    <!-- DataTables -->
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <!-- custom style sheet here -->
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css">
   <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CMS</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark p-0">
        <div class="container">
            <a href="index.html" class="navbar-brand">CMS</a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item px-2">
                        <a href="index.html" class="nav-link">Dashboard</a>
                    </li>
                    <li class="nav-item px-2">
                        <a href="posts.html" class="nav-link">Posts</a>
                    </li>
                    <li class="nav-item px-2">
                        <a href="categories.html" class="nav-link">Categories</a>
                    </li>
                    <li class="nav-item px-2">
                        <a href="student_registration.html" class="nav-link active">Students</a>
                    </li>
                    <li class="nav-item px-2">
                        <a href="print_result.html" class="nav-link active">Print Result</a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown mr-3">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user"></i> Welcome Staff
                        </a>
                        <div class="dropdown-menu">
                            <a href="" class="dropdown-item">
                                <i class="fa fa-user-circle"> Profile</i>
                            </a>
                            <a href="" class="dropdown-item">
                                <i class="fa fa-gear"> Settings</i>
                            </a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="login.html" class="nav-link">
                            <i class="fa fa-user-times"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>   
    
    <header class="py-2 bg-warning text-white" id="main-header">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h1 class="text-center"><i class="fa fa-envelope"></i> Subjects</h1>
                </div>
            </div>
        </div>
    </header>

    <!-- SIDEBAR SECTION -->
    <!-- <div class="col-lg-2">

    </div> -->
    <div class="col-lg-12">
        <!-- MESSAGE SECTION -->
    @if (session('status'))
    <section class="pt-2">
        <div class="container">
            <div class="row justify-content-center text-danger">
                <p >{{session('status')}}</p>
            </div>
        </div>
    </section>
    @endif
    
        <!-- ACTIONS -->
    <section class="py-4 mb-4 bg-light" id="action">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <a href="" class="btn btn-primary btn-block" data-toggle="modal" data-target="#mapSubjectModal">
                        <i class="fa fa-plus"> Allocate Subject</i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Subjects -->
    <section id="subjects">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card table-responsive">
                        <div class="card-header">
                            <h4>Subjects Allocation</h4>
                        </div>
                        <table class="table table-striped" id="subject-mapping-table">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>#</th>
                                    <th>Subject</th>                                  
                                    <th>Class</th>                              
                                    <th>Teacher</th>   
                                    <th>Created At</th>  
                                    <th></th>                        
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-dark text-white pt-3 mt-5" id="main-footer">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="lead text-center">Copyright &copy; 2017 Blogen</p>
                </div>
            </div>
        </div>
    </footer>
    </div>
    

         <!--ADD SUBJECT MAPPING MODAL -->
     <div class="modal fade" id="mapSubjectModal">
         <div class="modal-dialog modal-md">
             <div class="modal-content">
                 <div class="modal-header bg-warning text-white">
                     <h5 class="modal-title">Allocate Subject</h5>
                     <button class="close" data-dismiss="modal"><span>&times;</span></button>
                 </div>
                {!! Form::open(array('action' => 'SubjectMappingController@assignToTeacher', 'method' => 'POST')) !!}
                <input type="hidden" name="session_id" value="1">
                <input type="hidden" name="term_id" value="1">
                 <div class="modal-body">
                          <div class="form-group">
                              <label for="subject">Subject</label>
                              <select name="subject" id="" type="text" class="form-control">
                                <option value="Biology">Biology</option>
                                <option value="Mathmatics">Mathmatics</option>
                                <option value="Physics">Physics</option>
                                <option value="Economics">Economics</option>
                              </select>
                              <label for="teacher">Teacher</label>
                              <select name="teacher_id" id="" type="text" class="form-control">
                                <option value="1">Kingsley Arinze</option>
                                <option value="2">Ebuka Stanley</option>
                              </select>
                              <label for="class">Class</label>
                              <select name="class_id" id="" type="text" class="form-control">
                                <option value="1">Jss 1</option>
                                <option value="2">Jss 2</option>
                                <option value="3">Jss 3</option>
                                <option value="4">SS 1</option>
                                <option value="5">SS 2</option>
                                <option value="6">SS 3</option>
                              </select>
                          </div>
                 </div>
                 <div class="modal-footer">
                    {!! Form::submit('Close', ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) !!}
                    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                 </div>
                 </form>
             </div>
         </div>
     </div>

        <!-- EDIT SUBJECT MAPPING MODAL -->
     <div class="modal fade" id="editSubjectMappingModal">
         <div class="modal-dialog modal-lg">
             <div class="modal-content">
                 <div class="modal-header bg-warning text-white">
                     <h5 class="modal-title">Reallocate Subject</h5>
                     <button class="close" data-dismiss="modal"><span>&times;</span></button>
                 </div>
                 {!! Form::open(array('action' => 'SubjectController@update', 'method' => 'POST')) !!}
                 {{ Form::hidden('id', null, ['id' => 'subjectID']) }}
                 <div class="modal-body">
                          <div class="form-group">
                              {!! Form::label('name', 'Name') !!}
                              {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'subjectName']) !!}
                          </div>
                 </div>
                 <div class="modal-footer">
                     {!! Form::submit('Close', ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) !!}
                     {!! Form::submit('Submit', ['class' => 'btn btn-warning']) !!}
                 </div>
                 {!! Form::close()!!}
             </div>
         </div>
     </div>
<script type="text/javascript">
		$(document).ready(function() {
	    	$(function() {
			    $('#subject-mapping-table').DataTable({
			        processing: true,
			        serverSide: true,
                    ajax: {{ url('/subject/mapping/ajax/search') }},
                    //assigning id to tr the datatables way for easy modal display
                    createdRow: function ( row, data, index ) {
                        $('td', row).eq(0).attr('id', 'id');
                        $('td', row).eq(1).attr('id', 'subject');
                        $('td', row).eq(1).attr('id', 'class');
                        $('td', row).eq(1).attr('id', 'teacher');
                    },
			        columns: [
			            { data: 'id', name: 'id'},
			            {data: 'subject', name: 'subject'},
                        { data: 'class', name: 'class' },
                        { data: 'teacher', name: 'teacher' },
                        { data: 'created_at', name: 'created_at' },
			            { data: 'actions', name: 'actions' }
                        
			        ]
			    });
			});

            $( '#editSubjectMappingModal' ).on( 'show.bs.modal', function (e) {
                var target = e.relatedTarget;
                // get values for particular rows
                var tr = $( target ).closest( 'tr' );
                var idTd = tr.find('#id');
                var subjectTd = tr.find( '#subject' );
                var teacherTd = tr.find( '#teacher' );
                var classTd = tr.find( 'class' );

                // put values into editor's form elements
                // nameTd.eq(0).val() -- 1st column
                $('#id' ).val(idTd.eq(0).text());
                $( '#subject' ).val( subjectTd.eq(0).text() );
                $( '#teacher' ).val( teacherTd.eq(0).text() );
                $( '#class' ).val( classTd.eq(0).text() );
                // tds.eq(1).val() -- 2nd column and so on.
                // same goes to others element
            });
		});
	</script>
<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>