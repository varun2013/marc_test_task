
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
                        <li><a href="index.php">My Sort</a></li>
                        <li><a href="checkdomain.php">checkdomain</a></li>
                        <li><a href="countones.php">countones</a></li>
                        <li class="active"><a href="sanitize.php">sanitize</a></li>
                        <li><a href="truncate.php">truncateString</a></li>

                    </ul>

                    <div class="col-sm-12 functionData">
                        <div class="formDiv">
                            <form id="sortform" method="POST" >
                                <div class="control-group">
                                    <div class="control-label" >Enter the HTML</div>                         
                                    <div class="control-input">
                                        <textarea name="htmlstring"  style="height:100px; width:400px;" ></textarea> 
                                    </div>
                                </div>
                                <span class="btn  btn-success add_tag">+Allowed Tag</span>
                                
                                <span class=" btn btn-danger sanitize_values">Sanitize</span>
                            </form>     		   

                        </div>
                        <div class="result" style="display:none;">

                        </div>

                    </div>


                </div>




            </div>    

        </div>



    </body>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.add_tag').click(function() {
                var html = '<div class="control-group"> <div class="control-label">Enter Tag</div> <div class="control-input"><input type="text" name="tag[]" /><span class="attributes">Allowed Attributes</span><input type="text" name="attribute[]" /></div> </div>';
                $(this).before(html);
            });
            
             
            $('.sanitize_values').click(function() {
                var html=$('textarea[name="htmlstring"]').val();
                var allowedtags=[];
                var i=0;
                $('input[name="tag[]"]').each(function(){
                    
                   var tag=$(this).val();
                   var attributes=$(this).siblings('input[name="attribute[]"]').val();
                   var array={};
                   array['tag']=tag;
                   array['attributes']=attributes;
                   allowedtags.push(array);
                  
                    
                });
               $.ajax({
                    type: 'POST',
                    url: 'ajax.php',
                    data: {
                       htmlstring:html,
                       allowedtags:allowedtags,
                       sanitize:'sanitize',
                    },
                    beforeSend: function() {

                    },
                    success: function(result) {
                       
                        $('.result').text(result);
                        $('.result').css('display', 'block');
                    },
                });

            });
        });

    </script>

</html>