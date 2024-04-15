help:
	@echo "\n"
	@echo "пример ввода: \t\033[1;34mmake \033[1;32m{команды}\033[0m"
	@echo "\n"
	@echo "\033[1;33mДоступные команды:\033[0m"
	@echo "\033[1;32mgit-clone-main-http\033[0m\t - Склонировать проект 'Основной' по протоколу HTTP"
	@echo "\033[1;32mgit-clone-main-ssh\033[0m\t - Склонировать проект 'Основной' по протоколу  SSH"
	@echo "\033[1;32mgit-clone-lk-http\033[0m\t - Склонировать проект 'Личный кабинет' по протоколу HTTP"
	@echo "\033[1;32mgit-clone-lk-ssh\033[0m\t - Склонировать проект 'Личный кабинет' по протоколу SSH"
	@echo "\033[1;32mnetwork-create\033[0m\t\t - Создание сети контейнеров"
	@echo "\033[1;32mnetwork-prune\033[0m\t\t - Удаление всех сети контейнеров"
	@echo "\033[1;32mup-prod\033[0m\t\t\t - Поднять докер композ. \033[0;31mДля PRODUCTION\033[0m"
	@echo "\033[1;32mup-prod-build\033[0m\t\t - Обновить образы докера. \033[0;31mДля PRODUCTION\033[0m"
	@echo "\033[1;32mdown-prod\033[0m\t\t - Остановить контейнеры. \033[0;31mДДля PRODUCTION\033[0m"
	@echo "\033[1;32mdown-prod-clear\033[0m\t\t - Остановить и очистить контейнеры. \033[0;31mДля PRODUCTION\033[0m"
	@echo "\033[1;32mup\033[0m\t\t\t - Поднять докер композ. \033[93mДля локальной разработки\033[0m"
	@echo "\033[1;32mup-build\033[0m\t\t - Обновить образы докера. \033[93mДля локальной разработки\033[0m"
	@echo "\033[1;32mdown\033[0m\t\t\t - Остановить контейнеры. \033[93mДля локальной разработки\033[0m"
	@echo "\033[1;32mdown-clear\033[0m\t\t - Остановить и очистить контейнеры. \033[93mДля локальной разработки\033[0m"
	@echo "\033[1;32mcomposer-main-update\033[0m\t - Обновить все пакеты для основного проекта. \033[0;31mПредпочтительный способ\033[0m"
	@echo "\033[1;32mcomposer-main-install\033[0m\t - Установить все пакеты для основного проекта"
	@echo "\033[1;32mcomposer-lk-update\033[0m\t - Обновить все пакеты для LK. \033[0;31mПредпочтительный способ\033[0m"
	@echo "\033[1;32mcomposer-lk-install\033[0m\t - Установить все пакеты для LK"
	@echo "\033[1;32mmigrate-up-lk\033[0m\t\t - Накат миграции БД в ЛК"
	@echo "\033[1;32mmigrate-down-lk\033[0m\t\t - Откат миграции БД в ЛК"
	@echo "\033[1;32mfixture-up-lk\033[0m\t\t - Накат тестовых данных в БД для ЛК"
	@echo "\033[1;32mfixture-down-lk\033[0m\t\t - откат тестовых данных в БД для ЛК"
	@echo "\n"
git-clone-main-http:
	cd src && git clone https://git.jetbrains.space/panika/main/panika_main.git
git-clone-lk-http:
	cd src && git clone https://git.jetbrains.space/panika/main/panika_lk.git
git-clone-main-ssh:
	cd src && git clone ssh://git@git.jetbrains.space/panika/main/panika_main.git
git-clone-lk-ssh:
	cd src && git clone ssh://git@git.jetbrains.space/panika/main/panika_lk.git
network-create:
	docker network create project_panika_network --subnet=172.2.0.0/24 --gateway=172.2.0.1
network-prune:
	docker network rm $(docker network ls -q)
up-prod:
	docker compose -f docker-compose-prod.yaml up -d
up-prod-build:
	docker compose -f docker-compose-prod.yaml up -d --build --force-recreate
down-prod:
	docker compose -f docker-compose-prod.yaml down
down-prod-clear:
	docker compose -f docker-compose-prod.yaml down -v --remove-orphans
up:
	docker compose up -d
up-build:
	docker compose up -d --build --force-recreate
down:
	docker compose down
down-clear:
	docker compose down -v --remove-orphans
composer-main-update:
	docker compose run --rm main-php-cli composer update
composer-main-install:
	docker compose run --rm main-php-cli composer install
composer-lk-update:
	docker compose run --rm lk-php-cli composer update
composer-lk-install:
	docker compose run --rm lk-php-cli composer install
migrate-lk:
	docker compose run --rm lk-php-cli php ./yii migrate -- --interactive=0
fixture-lk:
	docker compose run --rm lk-php-cli php ./yii fixture/load "*" -- --interactive=0
