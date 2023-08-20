
const urlparams = new URLSearchParams(window.location.search);
const userid =urlparams.get('userid');
console.log('User id:'+userid);

if(userid){
    userData(userid);
}

function userData(user_id) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', "./php/user.php", true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = () => {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText);
            const result = JSON.parse(xhr.responseText);
            let html = "";
                html += `<img src="./images/${result[0]['users_image']}" alt="${result[0]['users_username']}"></img>
                    <p>${result[0]['users_name']}</p>`;
            document.getElementById('login').innerHTML = html;
            document.getElementById('login').href = "./userprofile.html";
        }
    };
    xhr.send('inputValue=' + encodeURIComponent(user_id));
}

function fetchData() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', "./php/allSoftware.php", true);
    xhr.onreadystatechange = () => {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const result = JSON.parse(xhr.responseText);
            const elements= [];
            let html = "";
            for(let i=0; i < result.length; i++) {
                elements[i] = document.getElementById('soft_name').innerHTML =
                    '<a class="soft" href="#">\n' +
                    '<img src="./images/'+ result[i]['software_image']+ '"></img>\n' +
                    '<p>'+ result[i]['software_name'] + '</p>';
                html += elements[i];
            }
            document.getElementById('softname').innerHTML = html;
        }
    };
    xhr.send();
}
fetchData();


function getSoftwares() {
    const inputvalue = document.getElementById('search').value;
    const xhr = new XMLHttpRequest();

    // Configure the AJAX request (POST method and PHP file to handle the request)
    xhr.open('POST', './php/searchSoftware.php', true);
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
                    '<a class="soft" href="#">\n' +
                    '<img src="./images/'+ result1[i]['software_image']+ '"></img>\n' +
                    '<p>'+ result1[i]['software_name'] + '</p>';
            }
            if (result1.length <= 0) {
                html += "<p>Software cannot be found</P>";
            }
            document.getElementById('softname').innerHTML = html;
        }
    };

    // Send the input value to the PHP script
    xhr.send('inputValue=' + encodeURIComponent(inputvalue));
}




