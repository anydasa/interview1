- docker compose build
- docker compose run --rm app composer install
- docker compose run --rm app bin/console comm:calc:batch var/transactions.txt