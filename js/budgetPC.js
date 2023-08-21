document.getElementById('budget').addEventListener('click', () => {
    document.getElementById('price-range').innerHTML = 
                                `<p>Price range:</p>
                                <div>
                                    <input type="range" name="price-range" id="price-range" value="Price">
                                    <input type="number" name="price" id="price">
                                </div>`;
});