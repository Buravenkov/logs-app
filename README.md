Приложение работает на базе асинхронной библиотеки amphp. 
Для запуска необходимо развернуть docker контейнер командой docker-compose up. 
Далее открыть в браузере http://127.0.0.1 
В среднем время выполнения программы занимает 23 секунды. 
Результат выполнения находится в /app/Storage/log.txt 
Чтобы проверить, как программа будет работать с фейковыми категориями, добавьте свои категории в файле /app/vendor/vladimir163/lead-generator/src/Generator.php в методе getRandCategory() 
Все невалидные записи попадут в файл /app/Storage/errors.txt Время исполнения почти не изменится.