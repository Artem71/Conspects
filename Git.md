Логика гита - рабочая директория -> index (git add .) -> repository (commit)

что бы посмотреть коммит есть команда: 
git show идентификатор (или его начало, например e740). Без идентификатора текущий коммит

Автор коммита - тот кто придумал данное изменение
Коммитер - тот кто создал коммит 
По дефолтку коммитер и автор это одно и тоже лицо
Автора можно указать при коммите через флаг --author='some name', дату автора --date='...'

Гит не умеет работать с пустыми директориями, как правило он их просто не видит. 
Обычно делают хак - ложа в пустую директорию пустой файл .gitkeep

git reset HEAD <file> - сбрасывает изменения в индексе (index)

.gitignore файл содержащий названия файлов которые следует игнорировать
через флаг -f (--force) можно добавить файл в коммит даже если он есть в игноре

Очень важно что бы один коммит делал только одну вещь (был атомарный)
Commit early. Commit often.

Зачем нужен индекс? Почему двухступенчатая система сохранения? Почему бы сразу не гонять в репозиторий?
Это дает нам возможность коммитить кусочками, а не сразу все изменения
git add -p позволяет добавить в индекс только часть изменений из одного файла (не весь файл)

git commit -a закомитит все изменения сразу добавив их и в индекс и в репозиторий
(это два в одном). !ВНИМАНИЕ! -a игнорирует файлы, которые еще не отслеживаются гитом

git commit <paths> сразу закомитить (с индексированием) конкретный файл/файлы

git config --global alias.commitall '!git add -A;git commit'
Добавил алиас commitall который будет коммитить сразу все файлы (и проиндексированные и нет) 

git rm <file> или git rm -r <directory> 
Удаляет файл/директорию и из рабочий директории и сразу же добавляет это изменение в индекс
флаг --cached удалит из индекса, но оставит в рабочей директории
флаг --cached используется во многих гит командах. Его смысл в том, что производит операцию с индексом, 
а рабочию директорию не троем

С точки зрения гита, переименования не существует. Мы просто удаляем старый файл и создаем новый, с новым
названием
git mv index.html hello.html переименует файл в хеллоу и сразу добавит в индекс

--- ВЕТКИ ---

Когда мы делаем первый коммит, гит создает первую ветку (master)

С технической точки зрения - ветка это ссылка на коммит
git branch - список веток (флаг -v покажет и коммиты) 

git branch <name> - после создания, новая ветка указывает на тот же коммит, что и родительская ветка 
(создание новой ветки это создание новой ссылки на коммит)

Если попробовать перейти на другую ветку имея в текущей не закомиченные изменения, то гит выдаст ошибку
(защищает нас от утери прогресса). НО! Если файлы в обоих ветках одинаковые, то чекаут отработает и изменения 
не потеряются
при git checkout с флагом -f гит перезапишет все файлы из ветки на которую переходим

git checkout -f HEAD - принудительно перейти на текущую ветку. В таком случае гит удалит все наши изменения,
до состояния последнего коммита

git stash - собирает незакомиченные изменения, удаляет их из файлов и в спец виде архивирует в гите.
Технически гит не привязывает сохраненные изменения к какой то одной ветке, поэтому можно сохранить изменения
на одной ветка, а применить их на другой
git stash pop - вернуть изменения

Что бы переместить несколько последних коммитов в другую ветку, мы согдаем новую ветку от текущей (она будет указывать 
на последний наш коммит), а текущую ветку откатывает на необходимый коммит командой git branch -f <branch name> <commit hash>
А если мы передумали, то можно переместить обратно

Можно запускать checkout на коммит, но при этом мы переходим на особое состояние которое называется detached HEAD т.е. отдельнная HEAD
т.е. теперь HEAD указывает не на ветку, а на конкретный коммит
Мы даже можем создать новый коммит родителем которого будет предыдущий. Особенность таких коммитов в том, что она не участвуют
не в одной из веток и это очень не удобно

Мы можем откатить конкретный файл на состояние любого предшествующего коммита указать checkout путь
git checkout <branch name | commit hash> <file name> - Откатит конкретный файл (можно указать несколько файлов) +
так же добавляет эти изменения в индекс

git log --oneline - посмотреть историю коммитов. Можно передать ветку

git show HEAD~1 покажет предыдущий коммит. Количество тильд определяет сколько коммитов следует откатить. Цифра указывает на количество тильд

git merge fix - Влить ветку фикс в текущую

git branch -d fix - удалить ветку фикс. Гит удалит ссылку ветки на коммит. Удаление произойдет только при условии, что 
удаляемая ветка было влита в какую либо другую, иначе гит нас защитит и выдаст ошибку

В директории .git/logs/HEAD можно увидить логи со всей историей перемещения ссылки HEAD по разным коммитам

git clean -f - удаление не отслеживаемых файлов (с флагом -d и директорий) (флаг -x для файлов которые игнорируются в гитигнор)
из проекта
Для полного сброса всех изменений необходимо выполнить две команды:
git reset --hard
git clean -dxf

(общий смысл команды git reset это передвинуть текущую ветку на указанный коммит)
git reset --hard HEAD~1 - откатиться на предыдущий коммит (как будто последнего коммита никогда и не было)
Если мы осознали, что сделали ошибку и хотим отменить откат, то гит не сразу удаляет коммиты из базы (хранит около 30 дней) и у нас есть
шанс все вернуть назад командой:
git reset --hard ORIG_HEAD (ORIG_HEAD это просто временная ссылка для удобства)
Однако не закомиченный изменения про жестком ресете мы потом восстановить не сможем!

git reset --soft HEAD~1 - откатит на предыдущий коммит, но не будет трогать индекс (последний коммит будет в индексе как
не закомиченные изменения)
Мягкий ресет обычно применяется когда мы забыли внести какие то изменения. Технически мы откатываемся на предыдущий коммит,
добавляем в индекс доп изменения и создаем новый коммит. Что бы скопировать описание откаченного коммита можно воспользоваться
командой: git commit -c ORIG_HEAD

Т.к. замена последнего коммита операция очень частая, то для этого есть специальная команда:
git commit --amend (откатывается на предыдущий, и делает новый одной командой)

git commit --amend -m 'description' - изменить описание последнего коммита

Обьединение коммитов - откатываемся через мягкий ресет на несколько коммитов и делаем новый тем самым обьяденив несколько
разных коммитов в один

git reset --mixed HEAD~3 (стоит по дефолту и можно указать просто git reset HEAD~3) Единственное отличие от мягкого
ресета в том, что изменения хоть и остались но из индекса они удаляются (необходимо заного их индексировать git add .)
git reset - очистит индекс (антипод git add)

git diff master feature - посмотреть список изменений
git diff --cached - показать те изменения, которые попадут в следующий коммит

git log - выводит коммиты достижимые из HEAD
Эта команда имеет очень много флагов (читай доку)

git blame <file> - посмотреть кто и когда менял какую строку в файле

--- СЛИЯНИЕ

Истинное слияние: гит анализирует все измененные файлы и создает новый коммит который будет содержать состояние обьедененных
изменений разных веток

Конфликты возникают в результате изменения одних и тех же строк кода в разных ветках

при конфликте мержа git reset --hard отменит мерж

git checkout --conflict=diff3 --merge <file> - покажет конфликт в виде трех сторон (добавится в отображение то, что бы
бло изначально). По дефолту показывает только две стороны (изменения в ветках которые мержим)

Коммит слияния особенный - у него два родителя (последние коммиты каждой ветки)
git show --first-parent покажет изменения от одной родительской ветки

git branch --merged покажет влитые ветки

git reflog -4 (покажет историю работы гит (последние 4 команды))

git merge --no-commit гит сделает мердж, но не будет создавать коммит (мы можем перепроверить все и записать
семантический коммит)

git merge --squash fix вольет ветку без истории

-------------

git cherry-pick <hash> скопирует коммит в текущую ветку. В отличии от merge он не вливает всю ветку (все коммиты) а
копирует только один
Кейс применения: когда какой то баг в середине одной ветке пофикшен, и нужно этот фикс перетянуть в другую ветку
Скопированный коммит будет отличаться от оригинала хешом и датой

git cherry-pick --abort прекращает не оконченное копирование (не захотел резолвить конфликты)

git cherry-pick -n не будет коммитить изменения. Только добавит в рабочую директорию и в индекс

-----------------

git rebase <branch> перебазирует ветку (родительский коммит) т.е. мы начали вести разработку и отпочкавались от коммита
B, кто-то подлил изменения в мастер которые нам нужны, мы делаем git rebase master и теперь радительский коммит для нашей
ветки D (и у нас будут все последние изменения ветки мастера)
По факту происходит просто копирование изменений из старой ветки, в новую

git rebase --abort прервать перебазирование
git rebase --continue продолжить перебазирование (после разруливания конфликта и добавление изменений в индекс)

rebase можно заменить просто подлив мастер в тукущую ветку, но в таком случае у нас идет загрязнение истории разработки
Особенно если мы будем подливать мастер регулярно. На юай истории это очень хорошо видно

Однако проблема rebase в том, что если над одной веткой работают несколько человек и один из них делает ребейс, то это
можно представить как будто вы строите дом и у вас проподает фундамент, а так же у нас могут после перебазирования,
коммиты которые раньше работали - оказаться поломанными (например в масетере переименовали функцию)

rebase:
+Упрощает историю
-Только для приватных веток
-Возможны ошибки в коммитах

git rebase --onto master feature Перенесет текущую ветку с фичи на мастер (сделает мастер родительской)

Через git rebase -i @~4 мы можем править коммиты в середине ветки (гугли - там геммор)

git revert <hash | interval> Создает обратный коммит. Реверт находит все изменения которые были сделаны в коммите,
удаляет их, и создает новый коммит (например в одном коммите мы добавили метод, а в реверте этот метод будет удален)