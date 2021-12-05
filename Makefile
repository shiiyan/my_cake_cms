hello:
	echo "hello there"
composer_require:
	cd .. && php composer.phar require $(dependency) --working-dir ./cms && echo
composer_show:
	cd .. && php composer.phar show  --working-dir ./cms
composer_list:
	cd .. && php composer.phar list  --working-dir ./cms
cs_check:
	cd .. && php composer.phar run cs-check --working-dir ./cms
cs_fix:
	cd .. && php composer.phar run cs-fix --working-dir ./cms