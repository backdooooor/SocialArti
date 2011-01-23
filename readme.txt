SocialArti   -  0.2 alpha release
Внимание версия нестабильна!!
Автор  Артемий <backdoor> Татаринов
Контактные данные
icq : 267173
jabber:backdoor@mir-saratov.ru
skype:inkognit5
http://twitter.com/backd000r

SocialArti
Основные функции :
Регистрация
Личная страница
Друзья
Новостная лента
Система личных сообщений.
Группы
Комментарии
Возможность ведения собственного блога
Приложения(функция в стадии тестирования);
Мультимедиа контент в микроновостях
Обсуждения
Быстрые сообщения


UPD 23.01.2011


Установка
 1  Создайте базу данных и загрузите в нее  дам базы   который находится в файле
socialarti.sql.zip
2 Если вы успешно преодолели первый пункт я вас поздравляю)  двигаемся дальше
открываем файл /system/application/config/database.php
$db['default']['hostname'] = "localhost";
$db['default']['username'] = "root";
$db['default']['password'] = "";
$db['default']['database'] = "socialarti";
меняем выше указанные данные на свои
3  Открываем файл /system/application/config/config.php
в этом файле
$config['base_url']	= "http://socialarti.me/";
измените URL на свой.
4 Proffit!
Если обнаружите какие нибудь ошибки пишите по выше указанным контактам либо
пишите в гите
http://github.com/backdoor/SocialArti
 )
и еще раз удачи)
