function getBudget() {
    document.getElementById('price-range').innerHTML =
        `<p>Price range:</p>
        <div>
            <input type="range" name="price-range" id="price-range-input" value="10000">
            <input type="number" name="price" id="price" value="10000">
        </div>`;

    document.getElementById('price').addEventListener('input', () => {
        getPrice();
    })


    // Function to fetch product prices (replace this with your actual fetching logic)
    let inputvalue = '';
    if (softIdValue) {
        inputvalue = softIdValue;
    } else {
        inputvalue = gameIdValue;
    }
    const xhr = new XMLHttpRequest();

    // Configure the AJAX request (POST method and PHP file to handle the request)
    xhr.open('POST', './php/budget/min_maxPrice.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    // Define what to do when the AJAX request completes
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Display the result returned from the PHP script
            const result = JSON.parse(xhr.responseText);
            updateRangeInput(result[1], result[0]);

            // Event listener to update the number input when the range input changes
            const rangeInput = document.getElementById('price-range-input');
            const numberInput = document.getElementById('price');
            
            rangeInput.addEventListener('input', () => {
                numberInput.value = rangeInput.value;
                getPrice();
            });
            
            // Event listener to update the range input when the number input changes
            numberInput.addEventListener('input', () => {
                const parsedValue = parseInt(numberInput.value);
                if (!isNaN(parsedValue)) {
                rangeInput.value = Math.min(result[0], Math.max(result[1], parsedValue));
                }
            });
        }
    };
    // Send the input value to the PHP script
    xhr.send('inputValue=' + encodeURIComponent(inputvalue));

    
    // Function to update the range input based on fetched product prices
    function updateRangeInput(minPrice, maxPrice) {
        const rangeInput = document.getElementById('price-range-input');
        rangeInput.min = minPrice;
        rangeInput.max = maxPrice;
        rangeInput.value = (minPrice + maxPrice) / 2;
    }
}

function getPrice() {
    document.getElementById('loading').style.display = "block";
    const price = document.getElementById('price').value;
    let inputvalue = '';
    if (softIdValue) {
        inputvalue = softIdValue;
    } else {
        inputvalue = gameIdValue;
    }
    const xhr = new XMLHttpRequest();

    // Configure the AJAX request (POST method and PHP file to handle the request)
    xhr.open('POST', './php/budget/budget.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    // Define what to do when the AJAX request completes
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Display the result returned from the PHP script
            const result = JSON.parse(xhr.responseText);
            console.log(result[0]);
            if (result[0]['CPU'] == null) {
                document.getElementById('info').innerHTML = 'Increase Your Budget';
            }
            else {
                let total = 0;
                let key = Object.keys(result[0]['CPU']);
                total += result[0]['CPU'][key[0]]['price'];
                html = `<h2>Your Budget PC</h2>`;
                fetchingBudget(result, 'CPU');

                key = Object.keys(result[0]['GPU']);
                total += result[0]['GPU'][key[0]]['price'];
                fetchingBudget(result, 'GPU');

                key = Object.keys(result[0]['RAM']);
                total += result[0]['RAM'][key[0]]['price'];
                fetchingBudget(result, 'RAM');

                key = Object.keys(result[0]['MotherBoard']);
                total += result[0]['MotherBoard'][key[0]]['price'];
                fetchingBudget(result, 'MotherBoard');

                html += `<div class="component total_price">
                            <h1 style="font-size: 30px;">Total Price: ${total} Taka</h1>
                        </div>`;
                document.getElementById('info').innerHTML = `<div class="budget_components" id="budget_components"></div>`;
                document.getElementById('budget_components').innerHTML = html;
                document.getElementById('loading').style.display = 'none';
            }
        }
    };

    // Send the input value to the PHP script
    xhr.send('inputValue=' + encodeURIComponent(inputvalue) + '&price=' + encodeURIComponent(price));
}

function fetchingBudget(result, component) {
    let key = Object.keys(result[0][component]);
    html += `<div class="component"><h1 style="font-size: 30px;">${component}:</h1>\n`;
    html += `<ul>
                <li>
                    <p style="font-size: 20px; font-weight: bold;">${key[0]}</p>
                    <p>Price: ${result[0][component][key[0]]['price']} Taka</p>
                </li>
            </ul>
        </div>`;
}

function getPriceFilter(filter) {
    document.getElementById('loading').style.display = "block";
    const price = document.getElementById('price').value;
    let inputvalue = '';
    if (softIdValue) {
        inputvalue = softIdValue;
    } else {
        inputvalue = gameIdValue;
    }
    const xhr = new XMLHttpRequest();

    // Configure the AJAX request (POST method and PHP file to handle the request)
    xhr.open('POST', './php/budget/budget.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    // Define what to do when the AJAX request completes
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Display the result returned from the PHP script
            const result = JSON.parse(xhr.responseText);
            console.log(result[0]);
            if (result[0]['CPU'] == null) {
                document.getElementById('info').innerHTML = 'Increase Your Budget';
            }
            else {
                let total = 0;
                let key = Object.keys(result[0]['CPU']);
                total += result[0]['CPU'][key[0]]['price'];
                html = `<h2>Your Budget PC</h2>`;
                fetchingBudget(result, 'CPU');

                key = Object.keys(result[0]['GPU']);
                total += result[0]['GPU'][key[0]]['price'];
                fetchingBudget(result, 'GPU');

                key = Object.keys(result[0]['RAM']);
                total += result[0]['RAM'][key[0]]['price'];
                fetchingBudget(result, 'RAM');

                key = Object.keys(result[0]['MotherBoard']);
                total += result[0]['MotherBoard'][key[0]]['price'];
                fetchingBudget(result, 'MotherBoard');

                html += `<div class="component total_price">
                            <h1 style="font-size: 30px;">Total Price: ${total} Taka</h1>
                        </div>`;
                document.getElementById('info').innerHTML = `<div class="budget_components" id="budget_components"></div>`;
                document.getElementById('budget_components').innerHTML = html;
                document.getElementById('loading').style.display = 'none';
            }
        }
    };

    // Send the input value to the PHP script
    xhr.send('inputValue=' + encodeURIComponent(inputvalue) + '&price=' + encodeURIComponent(price) + '&filter' + encodeURIComponent(filter));
}

