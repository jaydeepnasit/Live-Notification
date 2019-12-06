<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notification</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/6b23de7647.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    

    <div class="container-fluid mb-5">
        <div class="container mt-3">
            <nav class="navbar navbar-dark bg-dark">
                <a class="navbar-brand" href="#">
                    <strong>LIVE NOTIFICATION</strong>
                </a> 
                    <ul class="nav justify-content-end" >
                        <li class="dropdown">
                            <div  class="dropdown-toggle text-light" id="noti_count" style="cursor: pointer;" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="counter">0</span><i class="fas fa-bell" style="font-size: 20px;"></i>
                            </div>
                            
                            <div class="dropdown-menu overflow-h-menu dropdown-menu-right">
                                <div class="notification">

                                </div>
                            </div>
                        </li>
                    </ul>
            </nav>
        </div>
    </div>
    <div class="container-fluid">
        <div class="container">
            <div class="box-center">
                <form method="post" class="box-center-sub" id="form-submit">
                    <div class="form-group">
                        <label for="subject"><b>Subject *</b></label>
                        <input type="text" name="subject" class="form-control" id="subject" aria-describedby="emailHelp">
                        <small class="form-text text-error" id="sub-error"></small>
                    </div>
                    <div class="form-group">
                        <label for="comment"><b>Comment *</b></label>
                        <textarea name="comment" class="form-control" id="comment" ></textarea>
                        <small class="form-text text-error" id="com-error"></small>
                    </div>
                    <button type="submit" class="btn btn-danger">Submit</button>
                </form>
            </div>  
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<script type="text/javascript">

    $(document).ready(function (){

        $('.notification').load('Ajax/Notification.php');
        $('.counter').text('0').hide();

        var counter = 0;

        $('#form-submit').on('submit', function(event){
            event.preventDefault();
            
            var subject = $('#subject').val().trim();
            var comment = $('#comment').val().trim();

            $('#sub-error').text('');
            $('#com-error').text('');

            if(subject != '' && comment != ''){
                
                $.ajax({
                    type: "POST",
                    url: "Ajax/Ins_notification.php",
                    data: { 'subject' : subject, 'comment' : comment },
                    success: function (response) {
                        var status = JSON.parse(response);
                        if(status.status == 101){
                            counter++;
                            $('.counter').text(counter).show();
                            $('.notification').load('Ajax/Notification.php');
                            $("#form-submit").trigger("reset");
                            console.log(status.msg);
                        }
                        else{
                           console.log(status.msg);
                        }
                    }
                });

            }
            else{
            
                if(subject == ''){
                    $('#sub-error').text("Please Enter Subject");
                }
                if(comment == ''){
                    $('#com-error').text("Please Enter Comment");
                }
            }

        });

        $('#noti_count').on('click',function (){
            counter = 0;
            $('.counter').text('0').hide();
        });

    });

</script>

</body>
</html>