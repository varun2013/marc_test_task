
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

        <div class="container-fluid ">

            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-9 myfunctions">
                    <ul class="nav nav-pills">
                        <li ><a href="index.php">My Sort</a></li>
                        <li class="active"><a href="checkdomain.php">checkdomain</a></li>
                        <li><a href="countones.php">countones</a></li>
                        <li><a href="sanitize.php">sanitize</a></li>
                        <li><a href="truncate.php">truncateString</a></li>

                    </ul>
                    <div class="col-sm-12 functionData">
                        <div class="formDiv">
                            <form id="domainform" method="POST" >
                                <div class="control-group">
                                    <div class="control-label" >Enter The domain</div>                         
                                    <div class="control-input">
                                        <input type="text" name="domain" /> 
                                    </div>
                                </div>
                                <span class=" btn btn-danger check_domain">Check Domain</span>
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

                $('.check_domain').click(function() {
                    var formData = $('#domainform').serialize();
                    $.ajax({
                        type: 'POST',
                        url: 'ajax.php',
                        data: {
                            data: formData,
                            domainform: 'domainform',
                        },
                        beforeSend: function() {

                        },
                        success: function(result) {
                            var data = $.parseJSON(result);
                            var html = '<div>Result:' + result + ' </div>';
                            $('.result').html(html);
                            $('.result').css('display', 'block');
                        },
                    });

                });
            });

        </script>



    </body>
</html>