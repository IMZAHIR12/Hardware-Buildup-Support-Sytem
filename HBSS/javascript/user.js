


function getUser() {
    const userid = document.getElementById('login').value;
    const xhr = new XMLHttpRequest();

    // Configure the AJAX request (POST method and PHP file to handle the request)
    xhr.open('POST', './php/userdetails.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    // Define what to do when the AJAX request completes
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Display the result returned from the PHP script
            const result1 = JSON.parse(xhr.responseText);
            console.log(result1);
            console.log(result1.length);
            let html = "";
            for(let i=0; i < result1.length; i++) {
                html+=

                    '<img src="./images/'+ result1[i]['users_image']+ '"></img>\n' +
                    '<p>'+ result1[i]['users_name'] + '</p>';
            }
            if (result1.length <= 0) {
                html += "<p>User cannot be found</P>";
            }
            document.getElementById('login').innerHTML = html;
        }
    };

    // Send the input value to the PHP script
    xhr.send('inputValue=' + encodeURIComponent(userid));
}
getUser();

export * from ".//script";
