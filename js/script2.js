const urlParams = new URLSearchParams(window.location.search);
const softIdValue = urlParams.get('soft-id');
const gameIdValue = urlParams.get('game-id');

if (softIdValue) {
    get_softInfo(softIdValue);
    get_cpuID(softIdValue);
    get_gpuID(softIdValue);
    get_ramID(softIdValue);
    get_motherboardID(softIdValue);
} else {
    get_gameInfo(gameIdValue);
    get_gCpuID(gameIdValue);
    get_gGpuID(gameIdValue);
    get_gRamID(gameIdValue);
    get_gMotherboardID(gameIdValue);
}



//software
/*
get_softInfo(softIdValue);
get_cpuID(softIdValue);
get_gpuID(softIdValue);
get_ramID(softIdValue);
get_motherboardID(softIdValue);

*/

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
                        <div class="budget" id="budget">
                            <p>Create Your Budget PC</p>
                        </div>`;
            });
            document.getElementById('name').innerHTML = html;
        }
    };

    // Send the input value to the PHP script
    xhr.send('inputValue=' + encodeURIComponent(inputvalue));
}


function get_cpuID(soft_id) {
    const inputvalue = soft_id;
    const xhr = new XMLHttpRequest();

    // Configure the AJAX request (POST method and PHP file to handle the request)
    xhr.open('POST', './php/software-components/cpu-software.php', true);
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
            html += '<h1>CPU:</h1>\n';
            result.forEach(cpus => {
                html += `<ul>
                            <li>
                                <p>${cpus.cpu_name} </p>
                                <p>TK ${cpus.cpu_price}</p>
                            </li>
                        </ul>`
            });
            document.getElementById('cpu').innerHTML = html;
            
            html = '';
            const brands = [];
            result.forEach (cpus => {
                if (!brands.includes(cpus.cpu_brand)) {
                    brands.push(cpus.cpu_brand);
                }
            });
            console.log(brands);
            html += `<p>CPU:</p>
                    <div class="box">`;
            brands.forEach (brand => {
                html += `<div class="checkbox">
                            <input type="checkbox" name="${brand}" id="${brand}">
                            <p>${brand}</p>
                        </div>`;
            });
            html += '</div>';
            document.getElementById('catagories-cpu').innerHTML = html;
        }
    };

    // Send the input value to the PHP script
    xhr.send('inputValue=' + encodeURIComponent(inputvalue));
}


function get_gpuID(soft_id) {
    const inputvalue = soft_id;
    const xhr = new XMLHttpRequest();

    // Configure the AJAX request (POST method and PHP file to handle the request)
    xhr.open('POST', './php/software-components/gpu-software.php', true);
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
            html += '<h1>GPU:</h1>\n';
            result.forEach(gpus => {
                html += `<ul>
                            <li>
                                <p>${gpus.gpu_name} </p>
                                <p>TK ${gpus.gpu_price}</p>
                            </li>
                        </ul>`
            });
            document.getElementById('gpu').innerHTML = html;

            html = '';
            const brands = [];
            result.forEach (gpus => {
                if (!brands.includes(gpus.gpu_brand)) {
                    brands.push(gpus.gpu_brand);
                }
            });
            console.log(brands);
            html += `<p>GPU:</p>
                    <div class="box">`;
            brands.forEach (brand => {
                html += `<div class="checkbox">
                            <input type="checkbox" name="${brand}" id="${brand}">
                            <p>${brand}</p>
                        </div>`;
            });
            html += '</div>';
            document.getElementById('catagories-gpu').innerHTML = html;
        }
    };

    // Send the input value to the PHP script
    xhr.send('inputValue=' + encodeURIComponent(inputvalue));
}

function get_ramID(soft_id) {
    const inputvalue = soft_id;
    const xhr = new XMLHttpRequest();

    // Configure the AJAX request (POST method and PHP file to handle the request)
    xhr.open('POST', './php/software-components/ram-software.php', true);
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
            html += '<h1>Ram:</h1>\n';
            result.forEach(rams => {
                html += `<ul>
                            <li>
                                <p>${rams.ram_name} </p>
                                <p>TK ${rams.ram_price}</p>
                            </li>
                        </ul>`
            });
            document.getElementById('ram').innerHTML = html;

            html = '';
            const brands = [];
            result.forEach (rams => {
                if (!brands.includes(rams.ram_gb)) {
                    brands.push(rams.ram_gb);
                }
            });
            console.log(brands);
            html += `<p>RAM:</p>
                    <div class="box">`;
            brands.forEach (brand => {
                html += `<div class="checkbox">
                            <input type="checkbox" name="${brand}" id="${brand}">
                            <p>${brand}</p>
                        </div>`;
            });
            html += '</div>';
            document.getElementById('catagories-ram').innerHTML = html;
        }
    };

    // Send the input value to the PHP script
    xhr.send('inputValue=' + encodeURIComponent(inputvalue));
}

function get_motherboardID(soft_id) {
    const inputvalue = soft_id;
    const xhr = new XMLHttpRequest();

    // Configure the AJAX request (POST method and PHP file to handle the request)
    xhr.open('POST', './php/software-components/motherboard-software.php', true);
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
            html += '<h1>Motherboard:</h1>\n';
            result.forEach(motherboards => {
                html += `<ul>
                            <li>
                                <p>${motherboards.motherboard_name} </p>
                                <p>TK ${motherboards.motherboard_price}</p>
                            </li>
                        </ul>`
            });
            document.getElementById('motherboard').innerHTML = html;

            html = '';
            const brands = [];
            result.forEach (motherboards => {
                if (!brands.includes(motherboards.motherboard_model)) {
                    brands.push(motherboards.motherboard_model);
                }
            });
            console.log(brands);
            html += `<p>Motherboard:</p>
                    <div class="box">`;
            brands.forEach (brand => {
                html += `<div class="checkbox">
                            <input type="checkbox" name="${brand}" id="${brand}">
                            <p>${brand}</p>
                        </div>`;
            });
            html += '</div>';
            document.getElementById('catagories-gpu').innerHTML = html;
        }
    };

    // Send the input value to the PHP script
    xhr.send('inputValue=' + encodeURIComponent(inputvalue));
}




//GAMES
/*

get_gameInfo(game-id);
get_gCpuID(game-id);
get_gGpuID(game-id);
get_gRamID(game-id);
get_gMotherboardID(game-id);

*/

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
                        <div class="budget" id="budget">
                            <p>Create Your Budget PC</p>
                        </div>`;
            });
            document.getElementById('name').innerHTML = html;
        }
    };

    // Send the input value to the PHP script
    xhr.send('inputValue=' + encodeURIComponent(inputvalue));
}


function get_gCpuID(soft_id) {
    const inputvalue = soft_id;
    const xhr = new XMLHttpRequest();

    // Configure the AJAX request (POST method and PHP file to handle the request)
    xhr.open('POST', './php/games-components/cpu-games.php', true);
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
            html += '<h1>CPU:</h1>\n';
            result.forEach(cpus => {
                html += `<ul>
                            <li>
                                <p>${cpus.cpu_name} </p>
                                <p>TK ${cpus.cpu_price}</p>
                            </li>
                        </ul>`
            });
            document.getElementById('cpu').innerHTML = html;
        }
    };

    // Send the input value to the PHP script
    xhr.send('inputValue=' + encodeURIComponent(inputvalue));
}


function get_gGpuID(soft_id) {
    const inputvalue = soft_id;
    const xhr = new XMLHttpRequest();

    // Configure the AJAX request (POST method and PHP file to handle the request)
    xhr.open('POST', './php/games-components/gpu-games.php', true);
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
            html += '<h1>GPU:</h1>\n';
            result.forEach(gpus => {
                html += `<ul>
                            <li>
                                <p>${gpus.gpu_name} </p>
                                <p>TK ${gpus.gpu_price}</p>
                            </li>
                        </ul>`
            });
            document.getElementById('gpu').innerHTML = html;
        }
    };

    // Send the input value to the PHP script
    xhr.send('inputValue=' + encodeURIComponent(inputvalue));
}

function get_gRamID(soft_id) {
    const inputvalue = soft_id;
    const xhr = new XMLHttpRequest();

    // Configure the AJAX request (POST method and PHP file to handle the request)
    xhr.open('POST', './php/games-components/ram-games.php', true);
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
            html += '<h1>Ram:</h1>\n';
            result.forEach(rams => {
                html += `<ul>
                            <li>
                                <p>${rams.ram_name} </p>
                                <p>TK ${rams.ram_price}</p>
                            </li>
                        </ul>`
            });
            document.getElementById('ram').innerHTML = html;
        }
    };

    // Send the input value to the PHP script
    xhr.send('inputValue=' + encodeURIComponent(inputvalue));
}

function get_gMotherboardID(soft_id) {
    const inputvalue = soft_id;
    const xhr = new XMLHttpRequest();

    // Configure the AJAX request (POST method and PHP file to handle the request)
    xhr.open('POST', './php/games-components/motherboard-games.php', true);
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
            html += '<h1>Motherboard:</h1>\n';
            result.forEach(motherboards => {
                html += `<ul>
                            <li>
                                <p>${motherboards.motherboard_name} </p>
                                <p>TK ${motherboards.motherboard_price}</p>
                            </li>
                        </ul>`
            });
            document.getElementById('motherboard').innerHTML = html;
        }
    };

    // Send the input value to the PHP script
    xhr.send('inputValue=' + encodeURIComponent(inputvalue));
}