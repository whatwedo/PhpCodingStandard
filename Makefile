.PHONY: help
.DEFAULT_GOAL := help

## Show help
help:
	@echo ""
	@echo "==================================================="
	@echo "=           whatwedo php coding standard          ="
	@echo "==================================================="
	@echo ""
	@echo "Usage:"
	@echo "  make <target>"
	@echo ""
	@echo "Targets:"
	@awk '/^[a-zA-Z\-\_0-9]+:/ { \
		helpMessage = match(lastLine, /^## (.*)/); \
		if (helpMessage) { \
			helpCommand = substr($$1, 0, index($$1, ":")-1); \
			helpMessage = substr(lastLine, RSTART + 3, RLENGTH); \
			printf "  %-20s %s\n", helpCommand, helpMessage; \
		} \
	} \
	{ lastLine = $$0 }' $(MAKEFILE_LIST)
	@echo ""
	@echo ""

## initialize project
install:
	composer install


## fix php code style
ecs:
	vendor/bin/ecs check --config ./ecs.php --fix --clear-cache
