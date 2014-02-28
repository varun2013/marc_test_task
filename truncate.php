
<!DOCTYPE html>
<html lang="sa">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
                        <li ><a href="index.php">My Sort</a></li>
                        <li><a href="checkdomain.php">checkdomain</a></li>
                        <li><a href="countones.php">countones</a></li>
                        <li><a href="sanitize.php">sanitize</a></li>
                        <li class="active"><a href="truncate.php">truncateString</a></li>

                    </ul>
                    <div class="col-sm-12 functionData">
                        <div class="formDiv">
                            <form id="truncateForm" method="POST" >
                                <div class="control-group">
                                    <div class="control-label" >Enter the String</div>                         
                                    <div class="control-input">
                                        <input type="text" name="string" /> 
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="control-label" >Length to truncate</div>                         
                                    <div class="control-input">

                                        <input type="text" name="length" />

                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="control-label" >replacement string</div>                         
                                    <div class="control-input">
                                        <input type="text" name="replacewith" /> 

                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="control-label" >Break words</div>                         
                                    <div class="control-input">
                                        <input type="checkbox" name="breakwords" value=true /> 
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="control-label" >Truncate middle </div>                         
                                    <div class="control-input">
                                        <input type="checkbox" name="middle" value=true />  
                                    </div>
                                </div>

                                <span class=" btn btn-danger truncate_value">Truncate</span>
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

                $('.truncate_value').click(function() {

                    var string = $('input[name="string"]').val();
                    var length = $('input[name="length"]').val();
                    var replacewith = $('input[name="replacewith"]').val();
                    var word_break = $('input[name="breakwords"]:checked').val();
                    var middle = $('input[name="middle"]:checked').val();
                    $.ajax({
                        type: 'POST',
                        url: 'ajax.php',
                        data: {
                            string: string,
                            length: length,
                            replacewith: replacewith,
                            word_break: word_break,
                            middle: middle,
                            truncate: 'truncate',
                        },
                        beforeSend: function() {

                        },
                        success: function(result) {
                            $('.result').html(result);
                            $('.result').css('display', 'block');
                        },
                    });

                });
            });

        </script>


    </body>
</html>