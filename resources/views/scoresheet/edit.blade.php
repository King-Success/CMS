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
    <title>Bootstrap 4 Starter Pack</title>
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
                    <h1 class="text-center"><i class="fa fa-table"></i> Students Score Sheet</h1>
                </div>
            </div>
        </div>
    </header>

    <!-- ACTIONS -->
    <section class="py-4 mb-4 bg-light" id="action">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <a href="#" class="btn btn-success btn-block" data-toggle="modal" data-target="#addCategoryModal">
                        <i class="fa fa-pencil">Compute Result</i>
                    </a>
                </div>
                <div class="col-md-3">
                   <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search"> 
                        <span class="input-group-btn">
                            <button class="btn btn-success ">Search</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Users -->
    <section id="posts">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card">
                    {!! Form::open(['url' => '/student/' . $id . '/scoresheet/update']) !!}
                        <table class="table table-striped " id="score_form">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>#</th>
                                    <th>Subject</th>
                                    <th>1 CA</th>                                
                                    <th>2 CA</th>  
                                    <th>3 CA</th>                                
                                    <th>4 CA</th>                                
                                    <th>5 CA</th>                                
                                    <th>Exam</th>                                
                                    <th>Total</th>                                 
                                    <th>Position</th>                                 
                                    <th>Teacher</th>                                 
                                                                  
                                </tr>
                            </thead>
                        @foreach($data as $item)
                            <tbody>
                                <tr>
                                    <td scope="row"><input type="hidden" name="subject_record_id[]" value="<?php echo $item['subject_record_id']; ?>"><?php echo $item['subject_record_id']; ?></td>
                                    <td class="col-5"><input type="hidden" name="subjects[]" value="<?php echo $item['subject']; ?>"><?php echo $item['subject']; ?></td>
                                    <td ><input class="text-center" type="text" name="CA1[]" value="<?php echo $item['CA1']; ?>"></td>
                                    <td ><input class="text-center" type="text" name="CA2[]" value="<?php echo $item['CA2']; ?>"></td>
                                    <td ><input class="text-center" type="text" name="CA3[]" value="<?php echo $item['CA3']; ?>"></td>
                                    <td ><input class="text-center" type="text" name="CA4[]" value="<?php echo $item['CA4']; ?>"></td>
                                    <td ><input class="text-center" type="text" name="CA5[]" value="<?php echo $item['CA5']; ?>"></td>
                                    <td ><input class="text-center" type="text" name="exam[]" value="<?php echo $item['exam']; ?>"></td>
                                    <td class="text-center"><?php echo $item['total']; ?></td>
                                    <td class="text-center"><?php echo $item['position']; ?></td>
                                </tr>
                            </tbody>
                        @endforeach
                        </table>
                        <center><input type="submit" class="btn btn-lg btn-default" value="Submit"></center>
                        {!! Form::close() !!}


                        <nav class="ml-4">
                            <ul class="pagination">
                                <li class="page-item disabled"><a href="#" class="page-link">Previous</a></li>
                                <li class="page-item active"><a href="#" class="page-link">1</a></li>
                                <li class="page-item"><a href="#" class="page-link">2</a></li>
                                <li class="page-item"><a href="#" class="page-link">3</a></li>
                                <li class="page-item"><a href="#" class="page-link">Next</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-dark text-white mt-5 p-5" id="main-footer">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="lead text-center">Copyright &copy; 2017 Blogen</p>
                </div>
            </div>
        </div>
    </footer>

    
  </script>
<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>