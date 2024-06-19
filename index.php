<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Curs Valutar</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <h1>Curs Valutar</h1>
    <label for="country">Selectează moneda:</label>
    <select id="country">
        <option value="">Alege o monedă</option>
        <option value="EUR">Euro (EUR)</option>
        <option value="BGN">Leva Bulgaria (BGN)</option>
        <option value="CHF">Franc Elvețian (CHF)</option>
        <option value="CZK">Coroană Cehă (CZK)</option>
        <option value="DKK">Coroană Daneză (DKK)</option>
        <option value="GBP">Liră Sterlină (GBP)</option>
        <option value="HUF">Forint Ungaria (HUF)</option>
        <option value="ISK">Coroană Islandeză (ISK)</option>
        <option value="NOK">Coroană Norvegiană (NOK)</option>
        <option value="PLN">Zlot Polonia (PLN)</option>
        <option value="RON">Leu Românesc (RON)</option>
        <option value="SEK">Coroană Suedeză (SEK)</option>
        <option value="TRY">Liră Turcească (TRY)</option>
    </select>
    <div id="exchange-rate">
        <p>Selectează o monedă pentru a vedea valoarea 1 USD în moneda ta.</p>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('country').addEventListener('change', function() {
            const selectedCurrency = this.value;
            const exchangeRateDiv = document.getElementById('exchange-rate');

            if (selectedCurrency) {
                fetch('get_exchange_rates.php')
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const rate = data.rates[selectedCurrency];
                            if (rate) {
                                exchangeRateDiv.innerHTML = `<p>1 USD = ${rate} ${selectedCurrency}</p>`;
                            }
                        } else {
                            exchangeRateDiv.textContent = `Eroare: ${data.error}`;
                        }
                    })
                    .catch(error => {
                        exchangeRateDiv.textContent = `Eroare la încărcarea datelor: ${error.message}`;
                    });
            } else {
                exchangeRateDiv.textContent = 'Selectează o monedă pentru a vedea valoarea 1 USD în moneda ta.';
            }
        });
    });
</script>
</body>
</html>
