function topSoftware() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', "./php/top-software.php", true);
    xhr.onreadystatechange = () => {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const result = JSON.parse(xhr.responseText);
            const elements= [];
            let html = "";
            for(let i=0; i < result.length; i++) {
                html += '<div class="name">\n' +
                '<i class="fa-solid fa-circle"></i>\n' +
                '<a href="./details-software.html" value="'+ result[i]['software_id']+ '">' + result[i]['software_name'] +'</a>\n' +
            '</div>'
            }
            document.getElementById('lists').innerHTML = html;
        }
    };
    xhr.send();
}

topSoftware();