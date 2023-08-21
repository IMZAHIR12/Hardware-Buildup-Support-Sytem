// Get a reference to the button element
const createPost = document.getElementById("createPost");

// Add a click event listener to the button
createPost.addEventListener("click", function() {
    // Code to execute when the button is clicked
    console.log("Button clicked!");
    const body = document.getElementById("ask").value;
    const user_id = getCookie("user-id");

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "./php/user-post/createPost.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText); // Response from server
        }
    };
    var data = "body=" + encodeURIComponent(body) + "&userid=" + encodeURIComponent(user_id);
    xhr.send(data);
});


function getQuestions() {
    const xhr = new XMLHttpRequest();
    document.getElementById('posts').innerHTML = '';
    xhr.open('GET', "./php/user-post/allPosts.php", true);
    xhr.onreadystatechange = () => {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const result = JSON.parse(xhr.responseText);
            let html = '';
            result.forEach(element => {
                let replies = '';
                if(element.post_replies) {
                    replies = element.post_replies.split(',');
                }
                
                html = `<div class="post">
                            <div class="head">
                                <div class="userInfo">
                                    <img src="images/user-image/${element.users_image}" alt="${element.users_username}" class="userImage">
                                    <div class="user">
                                        <h2 class="userName">${element.users_name}</h2>
                                        <p class="time">${element.created_at}</p>
                                    </div>
                                </div>
                                <div class="menuBar">
                                    <a href="#answer"><i class="fa-solid fa-reply fa-rotate-180"></i> ${replies.length} Replies</a>
                                    <i class="fa-solid fa-share-from-square"></i>
                                    <i class="fa-solid fa-chevron-down"></i>
                                </div>
                            </div>
                            <div class="body">
                                <p>${element.document}</p>
                            </div>
                            <div class="showAnswer">
                                <p class="clickAnswer" id="clickAnswer${element.post_id}" onclick='getAnswers(${element.post_replies}, ${element.post_id})'>Click here to see answers</p>
                                <table class="answer" id="answer${element.post_id}"></table>
                            </div>
                        </div>`;
                document.getElementById('posts').innerHTML += html;
            });
            
        }
    };
    xhr.send();
}

getQuestions();

function getAnswers (repliesid, postid) {
    const inputvalue = repliesid;
    const xhr = new XMLHttpRequest();
    let html = "";

    // Configure the AJAX request (POST method and PHP file to handle the request)
    xhr.open('POST', './php/user-reply/allReplies.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    // Define what to do when the AJAX request completes
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Display the result returned from the PHP script
            const result = JSON.parse(xhr.responseText);
            if (result == null) {
                html += '';
            } else {
                result.forEach(reply => {
                    html += `<tr class="reply">
                                <td class="replyUserInfo">
                                    <img src="images/user-image/${reply.users_image}" alt="${reply.users_uesrname}" class="userImage">
                                    <h2>${reply.users_name}</h2>
                                </td>
                                <td class="replyMessege">
                                    <p class="replyBody">
                                        ${reply.reply_text} ${postid}
                                    </p>
                                    <p class="replyTime">${reply.reply_time}</p>
                                </td>
                            </tr>`;
                });
            }
            html += `<tr class="user-reply" id="user-reply">
                        <td class="replyUserInfo">
                            <img src="images/user-image/${getCookie('image')}" alt="${getCookie('username')}" class="userImage">
                            <h2>${getCookie('name')}</h2>
                        </td>
                        <td class="user-replyMessege">
                            <textarea name="replybody" id="replyBody" placeholder="Type your answer here..."></textarea>
                            <input type="button" value="Send">
                        </td>
                    </tr>`
        }
        document.getElementById('clickAnswer'+postid).innerHTML = 'Replies';
        document.getElementById('answer'+postid).innerHTML = html;
    };

    // Send the input value to the PHP script
    xhr.send('inputValue=' + encodeURIComponent(inputvalue));
}