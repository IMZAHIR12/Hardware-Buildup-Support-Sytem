
function fetchData() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', "./php/software-page/allSoftware.php", true);
    xhr.onreadystatechange = () => {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const result = JSON.parse(xhr.responseText);
            let html = "";
            for (let i = 0; i < result.length; i++) {
                html +=
                    '<a class="soft" href="#" data-id="' + result[i]['software_id'] + '" >\n' +
                    '<img src="./images/software-image/' + result[i]['software_image'] + '"></img>\n' +
                    '<p>' + result[i]['software_name'] + '</p>';
            }
            document.getElementById('softname').innerHTML = html;

            const links = document.querySelectorAll('#softname a');
            links.forEach(link => {
                link.addEventListener('click', function (event) {
                    event.preventDefault(); // Prevent the default link behavior
                    const dataIdValue = link.getAttribute('data-id');
                    const targetUrl = `./details-software.html?soft-id=${dataIdValue}`;
                    window.location.href = targetUrl;
                });
            });
        }
    };
    xhr.send();
}
fetchData();


function getSoftwares() {
    const inputvalue = document.getElementById('search').value;
    const xhr = new XMLHttpRequest();

    // Configure the AJAX request (POST method and PHP file to handle the request)
    xhr.open('POST', './php/software-page/searchSoftware.php', true);
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
            for (let i = 0; i < result.length; i++) {
                html +=
                    '<a class="soft" href="#">\n' +
                    '<img src="./images/software-image/' + result[i]['software_image'] + '"></img>\n' +
                    '<p>' + result[i]['software_name'] + '</p>';
            }
            document.getElementById('softname').innerHTML = html;
        }
    };

    // Send the input value to the PHP script
    xhr.send('inputValue=' + encodeURIComponent(inputvalue));
}

