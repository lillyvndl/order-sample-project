# sample-project process order

An order from a webshop is stored in a json file, located on the same server as the tool.

Once an order has been handled, we use following services to process the data:

## 1. WMS: Export order to CSV:
- Line 1: all details
- Line 2: total, tax, discount, discount tax, shipping, shipping tax)
- Line 3: customer details
- Starting from line 4: order line items (id, name, product_id, variant_id, price, quantity, total_price, tax)

## 2. Magento: Export order to XML
- one-on-one relationship

## 3. Mailchimp
Depending on the total budget, the customer will be added to following list:
- standard (< € 50 excl. vat)
- silver (< € 250 excl. vat)
- gold (< € 2000 excl. vat)

## Additional info
No web side, just CLI.
It should be able to execute the commands seperately, or all of them at once.

## Usage
Built on Laravel 6.0

1. Clone the project.
2. Run ```composer install```. No further config needed.
3. Execute following CLI commands:
- ```php artisan command:order-to-csv```
- ```php artisan command:order-to-xml```
- ```php artisan command:subscribe-to-mailchimp```
- ```php artisan command:process-order```