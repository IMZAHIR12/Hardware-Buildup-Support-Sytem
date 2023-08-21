function topSoftware() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', "./php/top-software.php", true);
    xhr.onreadystatechange = () => {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const result = JSON.parse(xhr.responseText);
            let html = "";
            for (let i = 0; i < result.length; i++) {
                html += '<div class="name">\n' +
                    '<i class="fa-solid fa-circle"></i>\n' +
                    '<a data-id="' + result[i]['software_id'] + '" href="#">' + result[i]['software_name'] + '</a>\n' +
                    '</div>';
            }
            document.getElementById('lists1').innerHTML = html;

            const links = document.querySelectorAll('#lists1 a');
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

topSoftware();


function topGames() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', "./php/top-games.php", true);
    xhr.onreadystatechange = () => {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const result = JSON.parse(xhr.responseText);
            let html = "";
            for (let i = 0; i < result.length; i++) {
                html += '<div class="name">\n' +
                    '<i class="fa-solid fa-circle"></i>\n' +
                    '<a data-id="' + result[i]['games_id'] + '" href="#">' + result[i]['games_name'] + '</a>\n' +
                    '</div>';
            }
            document.getElementById('lists2').innerHTML = html;

            const links = document.querySelectorAll('#lists2 a');
            links.forEach(link => {
                link.addEventListener('click', function (event) {
                    event.preventDefault(); // Prevent the default link behavior
                    const dataIdValue = link.getAttribute('data-id');
                    const targetUrl = `./details-software.html?game-id=${dataIdValue}`;
                    window.location.href = targetUrl;
                });
            });
        }
    };
    xhr.send();
}

topGames();
