const urlParams = new URLSearchParams(window.location.search);
const softIdValue = urlParams.get('soft-id');
const gameIdValue = urlParams.get('game-id');

if (softIdValue) {
    get_softInfo(softIdValue);
    get_ID(softIdValue, 'software-components/cpu-software.php', 'cpu_brand', 'CPU', 'catagories-cpu', 'cpu_box', 'cpu_name', 'cpu_price', 'cpu');
    get_ID(softIdValue, 'software-components/gpu-software.php', 'gpu_brand', 'GPU', 'catagories-gpu', 'gpu_box', 'gpu_name', 'gpu_price', 'gpu');
    get_ID(softIdValue, 'software-components/ram-software.php', 'ram_gb', 'RAM', 'catagories-ram', 'ram_box', 'ram_name', 'ram_price', 'ram');
    get_ID(softIdValue, 'software-components/motherboard-software.php', 'motherboard_model', 'Motherboard', 'catagories-motherboard', 'motherboard_box', 'motherboard_name', 'motherboard_price', 'motherboard');
} else {
    get_gameInfo(gameIdValue);
    get_ID(gameIdValue, 'games-components/cpu-games.php', 'cpu_brand', 'CPU', 'catagories-cpu', 'cpu_box', 'cpu_name', 'cpu_price', 'cpu');
    get_ID(gameIdValue, 'games-components/gpu-games.php', 'gpu_brand', 'GPU', 'catagories-gpu', 'gpu_box', 'gpu_name', 'gpu_price', 'gpu');
    get_ID(gameIdValue, 'games-components/ram-games.php', 'ram_gb', 'RAM', 'catagories-ram', 'ram_box', 'ram_name', 'ram_price', 'ram');
    get_ID(gameIdValue, 'games-components/motherboard-games.php', 'motherboard_model', 'Motherboard', 'catagories-motherboard', 'motherboard_box', 'motherboard_name', 'motherboard_price', 'motherboard');
}

function get_softInfo(soft_id) {
    const inputvalue = soft_id;
    const xhr = new XMLHttpRequest();

    // Configure the AJAX request (POST method and PHP file to handle the request)
    xhr.open('POST', './php/info/software-info.php', true);
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
            result.forEach(soft => {
                html += `<img src="./images/software-image/${soft.software_image}" alt="${soft.software_name}_icon">
                        <h1>${soft.software_name}</h1>
                        <div class="budget" id="budget" onclick="getBudget()">
                            <p>Create Your Budget PC</p>
                        </div>`;
            });
            document.getElementById('name').innerHTML = html;
        }
    };

    // Send the input value to the PHP script
    xhr.send('inputValue=' + encodeURIComponent(inputvalue));
}

function get_ID(id, php, brand_name, title,catagory_id, className, name, price, idName) {
    const inputvalue = id;
    const xhr = new XMLHttpRequest();

    // Configure the AJAX request (POST method and PHP file to handle the request)
    xhr.open('POST', `./php/${php}`, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    // Define what to do when the AJAX request completes
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Display the result returned from the PHP script
            let result = JSON.parse(xhr.responseText);
            const h = result;
            if (result == null) {
                return null;
            }

            let html = '';
            const brands = [];
            result.forEach (Element => {
                if (!brands.includes(Element[brand_name])) {
                    brands.push(Element[brand_name]);
                }
            });
            html += `<p>${title}:</p>
                    <div class="box">`;
            brands.forEach (brand => {
                html += `<div class="checkbox">
                            <input type="checkbox" class="${className}" value="${brand}" id="${className}${brand}">
                            <label for="${className}${brand}">${brand}</label>
                        </div>`;
            });
            html += '</div>';
            document.getElementById(catagory_id).innerHTML = html;

            const filterCheckboxes = document.querySelectorAll('.'+className);
            let components = [];

            function updateFilter() {
                const selectedValues = Array.from(filterCheckboxes)
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => checkbox.value);
        
                for (const component of h) {
                    if (selectedValues.length === 0 || selectedValues.includes(component[brand_name])) {
                        components.push(component);
                    }
                }
            }

            for (const checkbox of filterCheckboxes) {
                checkbox.addEventListener('change', () => {
                    components = [];
                    updateFilter();
                    result = components;
                    html = "";
                    html += `<h1>${title}:</h1>`;
                    result.forEach(element => {
                        html += `<ul>
                                    <li>
                                        <p>${element[name]} </p>
                                        <p>TK ${element[price]}</p>
                                    </li>
                                </ul>`
                    });
                    document.getElementById(idName).innerHTML = html;    
                });
            }

            result = h;
            html = "";
            html += `<h1>${title}:</h1>\n`;
            result.forEach(element => {
                html += `<ul>
                            <li>
                                <p>${element[name]} </p>
                                <p>TK ${element[price]}</p>
                            </li>
                        </ul>`
            });
            document.getElementById(idName).style.display = "flex";
            document.getElementById(idName).innerHTML = html;
            document.getElementById('loading').style.display = "none";
        }
    };

    // Send the input value to the PHP script
    xhr.send('inputValue=' + encodeURIComponent(inputvalue));
}

function get_gameInfo(game_id) {
    const inputvalue = game_id;
    const xhr = new XMLHttpRequest();

    // Configure the AJAX request (POST method and PHP file to handle the request)
    xhr.open('POST', './php/info/games-info.php', true);
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
            result.forEach(game => {
                html += `<img src="./images/games-image/${game.games_image}" alt="${game.games_name}_icon">
                        <h1>${game.games_name}</h1>
                        <div class="budget" id="budget" onclick="getBudget()">
                            <p>Create Your Budget PC</p>
                        </div>`;
            });
            document.getElementById('name').innerHTML = html;
        }
    };

    // Send the input value to the PHP script
    xhr.send('inputValue=' + encodeURIComponent(inputvalue));
}