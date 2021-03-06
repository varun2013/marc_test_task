<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Php Demo Task</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php require('php/Functions.php'); ?>
        <div class="container-fluid ">

            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-9 myfunctions">
                    <ul class="nav nav-pills">
                        <li class="active"><a href="index.php">My Sort</a></li>
                        <li><a href="checkdomain.php">checkdomain</a></li>
                        <li><a href="countones.php">countones</a></li>
                        <li><a href="sanitize.php">sanitize</a></li>
                        <li><a href="truncate.php">truncateString</a></li>

                    </ul>
                    <div class="col-sm-12 functionData">
                        <div class="formDiv">
                            <form id="sortform" method="POST" >
                                <div class="control-group">
                                    <div class="control-label" >Enter the arguments</div>                         
                                    <div class="control-input">
                                        <input type="text" name="sortvalues" /> 
                                    </div>
                                </div>
                                <span class="btn  btn-success add_arguments">+ arguments</span>
                                <span class=" btn btn-danger sort_values">Sort</span>
                            </form>     		   

                        </div>
                        <div class="result" style="display:none;">

                        </div>

                    </div>
                </div>
            </div>    
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.add_arguments').click(function() {
                    var html = '<div class="control-group"> <div class="control-label" >Enter the arguments</div> <div class="control-input"><input type="text" name="sortvalues"></div> </div>';
                    $(this).before(html);
                });
                $('.sort_values').click(function() {
                    var formData = $('#sortform').serialize();
                    $.ajax({
                        type: 'POST',
                        url: 'ajax.php',
                        data: {
                            data: formData,
                            sortvalue: 'sort',
                        },
                        beforeSend: function() {

                        },
                        success: function(result) {
                            var data = $.parseJSON(result);
                            var html = '<div>Sorted Values Are:' + data.join(",") + ' </div>';
                            $('.result').html(html);
                            $('.result').css('display', 'block');
                        },
                    });

                });
            });

        </script>


    </body>
</html>