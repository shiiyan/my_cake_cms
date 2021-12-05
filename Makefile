hello:
	echo "hello there"
composer_require:
	cd .. && php composer.phar require $(dependency) --working-dir ./cms && echo
composer_show:
	cd .. && php composer.phar show  --working-dir ./cms && echo
