// Handle form submission with JavaScript
document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent the form from submitting normally
    const email=document.getElementById("login-username").value;
    const password=document.getElementById("login-password").value;

    const str=`email=${email}&password=${password}`;
    const xhr = new XMLHttpRequest();
    // Configure the AJAX request (POST method and PHP file to handle the request)
    xhr.open('POST', './php/login.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    // Define what to do when the AJAX request completes
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Display the result returned from the PHP script
            const result1 = JSON.parse(xhr.responseText);
            if(result1=='Login failed!') {
                window.location.href = '#';
                document.getElementById("error").innerHTML='email or password is invalid!'
            }
            else {
                result1.forEach(user => {
                    setCookie('user-id', user.users_id, 10);
                    window.location.href = 'index.html';
                });
            }
        }
    }
    // Send the input value to the PHP script
    xhr.send(str);

});


function setCookie(name, value, daysToExpire) {
    const expirationDate = new Date();
    expirationDate.setDate(expirationDate.getDate() + daysToExpire);

    const cookieValue = encodeURIComponent(value) + "; expires=" + expirationDate.toUTCString() + "; path=/";
    document.cookie = name + "=" + cookieValue;
}