fix-permission: ## Fix permissions for directories
	@docker compose run --rm app chmod -R 0777 var vendor config || true
