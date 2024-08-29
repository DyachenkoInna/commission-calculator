# Commission calculation script

This script calculates the commission for a given list of transactions.
The script reads the transactions from a JSON file and output the calculated commissions.

If there is some error in the input data, the script will print an error message with line number to output and stops.

Transactions must be provided each in it's own line in the input file, in JSON.
Format example:
`{"bin":"123456","amount":"100.00","currency":"USD"}`

All commissions calculate in EUR currency.
There are different commission rates for EU-issued and non-EU-issued cards.

### Usage:
1. Clone the repository
2. Install dependencies with composer
```bash
$ composer install
```
3. Run the script with the input file path as an argument
```bash
$ php app.php input.txt
```
