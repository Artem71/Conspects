Роберт Мартин 2018

Хорошая архитектура отвечает потребностям пользователей, разработчиков и владельцев не только сейчас, но
и продолжит отвечать им в будущем

  Если вы думаете что хорошая архитектура стоит дорого, попробуйте плохую (с) Брайн Фут

К целе ведет много путей.
Все архитектуры подчиняются одним и тем же правилам!
в 1946 году Алан Тьюринг написал первый программный код
Самонадеянность, управляющая перепроектированием, приведет к тому же беспорядку что и прежде
Всякая программная система имеет две ценности: поведение и структуру

-----
Если правильно работающая программа не допускает возможности ее изменения, она перестанет работать правильно,
когда изменятся требования, и вы не сможете заставить ее работать правильно. То есть программа станет бесполезной 

Если программа работает неправильно, но легко поддается изменению, вы сможете заставить работать ее правильно
и поддерживать ее работоспособность по мере изменения требований. То есть программа постоянно будет оставаться
полезной.
-----

Обьектно Ориентированное Программирование
Инкапсуляция - возможность прятать переменные и функции внутри класса

Принципы SOLID определяют как обьеденять функции и структуры данных в классы и как эти классы должны
сочетаться друг с другом. Эти принципы применимы не только к ООП

Принцип единой ответственности:
Модуль должен иметь одну и только одну причину для изминения! Это можно переформулировать еще так - 
Модуль должен отвечать за одного и только за одного пользователя или заинтересованное лицо
Итоговое - Модуль должен отвечать за одного и только за одного актора
Связаность - сила, которая связывает код, ответственный за единого актора.
Принцип единой ответственности требует разделять код, от которого зависят разные акторы

Принцип открытости/закрытости
Программные сущности должны быть открыты для расширения и закрыты для изминения
Если компонент А требуется защитить от изминений в компоненте Б, компонент Б должен зависить от компонента А

Зависимости несущие лишний груз ненужных и неиспользуемых особенностей, могут стать причиной неожиданных проблем.

Наиболие гибкими получаются системы, в которых зависимости в исходном коде направлены на абстракции, 
а не на конкретные реализации

Принцип согласованного изминения:
В один компонент должны включаться классы, изменяющиеся по одним причинам и в одно время. В разные компоненты
должны включаться классы, изменяющиеся в разное время и по разным причинам

Собирайте вместе все, что изменяется по одной причине и в одно время. Разделяйте все, что изменяется в разное 
время и по разным причинам

Не вынуждайте пользователя компонента зависеть от того, что им не требуется
Классы не имеющие тесной связи не должны включатся в один компонент
Не создавайте зависимостей от чего-то неиспользуемого

Архитектуру основанною на службах (или сервисах), часто называют сервис-ориентированной архитектурой
Работа бизнес-правил не должна нарушаться из-за изминения формата веб-страниц или схемы базы данных

Архитектура не должна определяться фреймворками

Простота тестирования является характерным признаком хорошей архитектуры
принцип YAGNI: «You Aren’t Going to Need It» («Вам это не понадобится»).

Архитектура системы определяется границами, отделяющеми высокоуровневые политики, от низкоуровневых
деталей, и следованием правил зависимостей.

Тесты не находятся вне системы; они — часть системы, и к их проектированию следует подходить с неменьшим вниманием,
чтобы получить от них выгоды в виде стабильности и защищенности от регрессий. Тесты, которые не проектируются
как часть системы, получаются хрупкими и сложными в сопровождении. Такие тесты часто заканчивают свое существование
в комнате персонала, осуществляющего сопровождение, потому что их слишком тяжело поддерживать.

Несмотря на что, что ПО не изнашевается, оно может быть разрушено неуправляемыми зависимостями от микропрограмм и 
оборудования

С архитектурной точки зрения база данных не является сущностью — это деталь, которая не должна 
подниматься до уровня архитектурного элемента. Ее отношение к архитектуре программной системы сопоставимо
 с отношением дверной ручки к архитектуре здания.

Является ли производительность архитектурной проблемой? Конечно! Но в отношении хранения данных эту проблему
можно полностью инкапсулировать и отделить от бизнес-правил. Да, нам нужно, чтобы данные быстро перемещались 
из хранилища и в хранилище, но это низкоуровневая проблема. Ее можно решить с помощью низкоуровневых механизмов 
доступа к данным. И она не имеет ничего общего с архитектурой системы.

Встретившись с фреймворком, не торопитесь вступать с ним в союз. Посмотрите, есть ли возможность отложить решение. 
Если это возможно, удерживайте фреймворк за архитектурными границами. Может быть, вам удастся найти способ 
получить молоко, не покупая корову.
