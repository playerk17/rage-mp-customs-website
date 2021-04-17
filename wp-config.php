<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'rage-mp-customs-website-db' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'root' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', 'MkefglaI892' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '*G8yU91uY{ .DKsD.]00T,d:mMtYsIEWN@t+]~:hE}H[5JN9(k8Y)Xb_xuR+fRO!' );
define( 'SECURE_AUTH_KEY',  '9Mh,E6}Rc67#}aVOi%=,zd><=U^a8x[XNE+;+R>K^j<YiN?vt)n=>aSK zZMytX@' );
define( 'LOGGED_IN_KEY',    'UW$1N1Xze+W?&3bvFm_w~k4;G5:9#X6&z$`12,?,hM{ od+BPe_4.j84%V(RCtUN' );
define( 'NONCE_KEY',        'EO+0Z~lyF`C@C[nWGKc}z}cJVFK<kT4A-GU.{_f(PMqVX! rQ%AW>_AnKB2F::&T' );
define( 'AUTH_SALT',        'neAQ}#lUz39Vs!r]BB;Y%zss.jZ=7=A-@*E/,S/7OmaH~Mv5y_k|Rl4hqk0c$KAO' );
define( 'SECURE_AUTH_SALT', 'H(-Ef89n@G2~%(O><<+@45|xu!*-_kR/ioMDMkrtAkg?4mtJfsK}a;hX;`O@%T;k' );
define( 'LOGGED_IN_SALT',   'Y6d>`39}|N*ub)@6N-j1YQ%V(vBP)TWB42e&/e9v9@6mO=e-*Fz6Rj~E/m-2>X[3' );
define( 'NONCE_SALT',       'HBvru}zAMnyzk$EqB[!chG,O IW=V%fL[9!$mc3n#W8Ip@2%luWaB~ T!5*W.|TT' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
