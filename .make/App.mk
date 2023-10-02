build: ## build image
	@docker compose build

composer-install: ## install dependencies
	@docker compose run --rm app composer install

run-example: ## run example
	@docker compose run --rm app bin/console comm:calc:batch tests/_data/transactions.txt

test: ## run tests
	@docker compose run --rm app vendor/bin/codecept run