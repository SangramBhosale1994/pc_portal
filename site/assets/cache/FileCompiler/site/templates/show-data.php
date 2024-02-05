<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>
<body>
    <form method="post" class="myform" action="process-form.php">
        <input type="text" name="name" placeholder="Your Name" required><br>
        <input type="email" name="email" placeholder="Your Email" required><br>
        <textarea rows="4" cols="20" name="message" placeholder="Your Message"></textarea><br>
        <input type="submit" name="send" value="Send"> <span class="output_message"></span>
    </form>
    <script>
            $(document).ready(function() {
                $('.myform').on('submit',function(e){
                    
                    // Add text 'loading...' right after clicking on the submit button. 
                    $('.output_message').text('Loading...'); 
                    
                    e.preventDefault();
                    var form = $(this);
                    $.ajax({
                        url: 'process-form.php',
                        method: 'post',
                        data: form.serialize(),
                        success: function(result){
                            if (result == 'success'){
                                $('.output_message').text('Message Sent!');  
                            } else {
                                $('.output_message').text('Error Sending email!');
                            }
                        }
                    });
                });
            });
        </script>
</body>
</html>