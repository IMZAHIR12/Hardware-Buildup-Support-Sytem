function getUserInfo (user_id) {
    const inputvalue = user_id;
    const xhr = new XMLHttpRequest();

    // Configure the AJAX request (POST method and PHP file to handle the request)
    xhr.open('POST', './php/user-info/user-info.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    // Define what to do when the AJAX request completes
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Display the result returned from the PHP script
            const result = JSON.parse(xhr.responseText);
            if (result == null) {
                return null;
            }
            let html = "";
            result.forEach(user => {
                html += `<a class="login dropbtn" id="login" value="Login" href="./profile.html">
                            <img src="./images/user-image/${user.users_image}" alt="${user.users_uesrname}">
                            <h2>${user.users_name}</h2>
                        </a>
                        <div class="dropdown-content">
                            <a href="#" onclick="deleteCookie()">Logout</a>
                        </div>`;    
                setCookie('image', user.users_image, 7);
                setCookie('username', user.users_uesrname, 7);
                setCookie('name', user.users_name, 7);
            });
            document.getElementById('dropdown').innerHTML = html;
        }
    };
    // Send the input value to the PHP script
    xhr.send('inputValue=' + encodeURIComponent(inputvalue));
}
function setCookie(name, value, daysToExpire) {
    const expirationDate = new Date();
    expirationDate.setDate(expirationDate.getDate() + daysToExpire);

    const cookieValue = encodeURIComponent(value) + "; expires=" + expirationDate.toUTCString() + "; path=/";
    document.cookie = name + "=" + cookieValue;
}

function getCookie(name) {
    const cookieArray = document.cookie.split(';');
    for (let i = 0; i < cookieArray.length; i++) {
        const cookie = cookieArray[i].trim();
        if (cookie.startsWith(name + "=")) {
            return decodeURIComponent(cookie.substring(name.length + 1));
        }
    }
    return null;
}

function deleteCookie() {
    document.cookie = "user-id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    location.reload();
}

function setID () {
    const userid = getCookie("user-id"); // Get the value of the "username" cookie.
    if (userid) {
        getUserInfo(userid);
    } 
    else {
        document.getElementById('dropdown').innerHTML = '<a class="login" value="Login" href="./login_signup.html">Login</a>';
    }
}

setID();