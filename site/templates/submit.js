// handle form submission
document.getElementById('contact-form').addEventListener('submit', function(event) {
    event.preventDefault();
    
    // get form data
    var form = event.target;
    var data = new FormData(form);
    
    // send form data to server
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'submit.php');
    xhr.send(data);
    
    // handle server response
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        var response = xhr.responseText;
        if (response === 'success') {
          form.reset();
          document.getElementById('form-messages').innerHTML = 'Thank you for your message. We will get back to you shortly.';
        } else {
          document.getElementById('form-messages').innerHTML = 'An error occurred. Please try again later.';
        }
      }
    };
  });
  