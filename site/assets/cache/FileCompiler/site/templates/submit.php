<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<body>
<form id="myForm">
  <input type="text" name="name" placeholder="Enter your name">
  <input type="email" name="email" placeholder="Enter your email">
  <button type="submit">Submit</button>
</form>
<div id="response"></div>
<script>
  document.getElementById('myForm').addEventListener('submit', function(e){
  e.preventDefault();
  var formData = new FormData(this);

  var xhr = new XMLHttpRequest();
  xhr.open('POST', '#', true);
  xhr.onload = function () {
    if (xhr.status === 200) {
      document.getElementById('response').innerHTML = '<p>Thank you for submitting the form!</p>';
      // send email and store data logic here
    } else {
      console.error('Request failed.  Returned status of ' + xhr.status);
    }
  };
  xhr.send(formData);
});

</script>
</body>
</html>