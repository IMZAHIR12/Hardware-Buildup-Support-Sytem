function fetchData() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', "./php/allGames.php", true);
    xhr.onreadystatechange = () => {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const result = JSON.parse(xhr.responseText);
            const elements= [];
            let html = "";
            for(let i=0; i < result.length; i++) {
                html +=
                    '<a class="game" href="#">\n' +
                    '<img src="./images/'+ result[i]['games_image']+ '"></img>\n' +
                    '<p>'+ result[i]['games_name'] + '</p>';
            }
            document.getElementById('gamename').innerHTML = html;
        }
    };
    xhr.send();
}
fetchData();


function getGames() {
    const inputvalue = document.getElementById('search').value;
    const xhr = new XMLHttpRequest();

    // Configure the AJAX request (POST method and PHP file to handle the request)
    xhr.open('POST', './php/searchGames.php', true);
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
                    '<img src="./images/'+ result1[i]['games_image']+ '"></img>\n' +
                    '<p>'+ result1[i]['games_name'] + '</p>';
            }
            if (result1.length <= 0) {
                html += "<p>Software cannot be found</P>";
            }
            document.getElementById('gamename').innerHTML = html;
        }
    };

    // Send the input value to the PHP script
    xhr.send('inputValue=' + encodeURIComponent(inputvalue));
}


