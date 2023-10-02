.DEFAULT_GOAL := help

include .env
-include .env.local
export

include .make/Utils.mk
include .make/App.mk

help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) \
		| sed "s/.*mk://g" \
		| sort \
		| awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}'
