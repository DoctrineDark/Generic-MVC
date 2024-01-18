# Generic MVC

Тестовый проект для проверки концепции, в котором реализована веб-интерпретация схемы разделения данных MVC в её стандартном представлении.

## Описание

##### Структура каталогов
* [bin](bin) - Каталог, зарезервированный под побочные скрипты (например: [bin/migrate.php](bin/migrate.php))
* [config](config) - Каталог файлов конфигурации
* [public](public) - Каталог публично доступных данных. Содержит точку входа [public/index.php](public/index.php)
* [resources](resources) - Каталог ресурсов. Содержит [каталог шаблонов](resources/views)
* [src](src) - Основной код приложения: каталог контроллеров, моделей. В каталоге [Core](src/Core) находятся все модули приложения.

##### Инициализация
Приложение имеет единую точку входа в [public/index.php](public/index.php), который инициализирует работу [конфигуратора](src/Core/Config/Config.php) и [маршрутизатора](src/Core/Router/Router.php).

##### Конфигуратор
Конфигуратор - модуль управления конфигурациями приложения. По умолчанию читает содержимое папки [config](config). 
В [config/database.php](config/database.php) задано соединение с MySQL для PDO - DSN. 
В [config/routes.php](config/routes.php) заданы маршруты в виде массивов со следующими данными: 
* uri - Шаблон семантического URI
* method - HTTP-метод
* controller - Класс-контроллер
* action - Метод контроллера

##### Маршрутизатор
Маршрутизатор отвечает за навигацию в приложении. Он осуществляет поиск соответствия текущего URI какому-либо uri-шаблону из [заданных маршрутов](config/routes.php), и в случае обнаружения маршрута производится вызов его контроллера.
Также в маршрутизаторе происходит инициализация глобальных и path-переменных с последующей их передачей в [базовый контроллер](src\Controllers\Controller.php) в инкапсулированном виде в модуле [Request](src/Core/Router/Request.php).

##### Контроллер
Как было сказано выше, вызов соответствующего контроллера производится в маршрутизаторе. Экземпляр [базового контроллера](src\Controllers\Controller.php) принимает [Request](src/Core/Router/Request.php), в котором содержится информация о текущем запросе. Соответственно, наследники базового контроллера имеют к нему доступ. Дочерние контроллеры возвращают [Response](src/Core/Router/Response.php).

##### Модель
[Базовая модель](src/Models/Model.php) включает в себя метод соединения с базой данных, а так же набор методов, через которые осуществляются наиболее общие запросы в базу данных (CRUD). Режим выборки задан таким образом, что PDO возвращает данные типа дочернего класса модели, таким образом достигается концепция модели.

##### Модуль View
Рендер шаблона в модуле [View](src/Core/Template/View.php) реализуется путем буферизации вывода. Метод render принимает название шаблона и массив данных. Запускается буферизация, производится извлечение данных из массива, вызывается файл шаблона, метод отдает содержимое буфера вывода. 

## Начало работы

### Зависимости

* Composer (исключительно как инструмент автозагрузки классов, сторонние библиотеки в проекте не использованы)

### Установка

* Склонируйте репозиторий: 
```
git clone https://github.com/DoctrineDark/Generic-MVC.git
```
* Создайте новый домен с указанием корневой директории проекта.
* Выполните (в корневой директории): 
```
composer install
```
* В файлах [bin/migrate.php](bin/migrate.php) и [config/database.php](config/database.php) укажите учетные данные для доступа к MySQL
* Запустите скрипт миграции (в корневой директории) ИЛИ импортируйте [mvc.sql](mvc.sql) вручную: 
```
php bin/migrate.php
```

