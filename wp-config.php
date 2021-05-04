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
define( 'DB_NAME', 'wp' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'root' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         ' 0PnsKvU#NKvTN]=<F=gKUCG|-18wwMb~ct*IhhA2!<t<zqC41%4Mr%Z|Z>)8h($' );
define( 'SECURE_AUTH_KEY',  'Rw;k-3qK YXLF r>Hl?[#/NN BwGG?:3@CC#vp.qX]B<ui{kc@Jq/w^OE^Mrx&o(' );
define( 'LOGGED_IN_KEY',    '7-[-Pk1#Q@rZB/lWeCav!73CTU$NZPTvEO;B6ZEA&Lz=v3m-@hjZR,0cenE!qTZZ' );
define( 'NONCE_KEY',        '9Hv!@uFNP28tpE-xjGlRu#n6v I,^:YA(C#4{mbu2C@M0WO=O{gI!<;g|pDuE#|~' );
define( 'AUTH_SALT',        'he`6%=&q]5Bp)s#43mc(q`ia1${i=WV5g#AxxDUr+@9K^UP8FP9TSR?b$LISZdN=' );
define( 'SECURE_AUTH_SALT', 'I5Ki)w@k$b5x^z?iwR=@B.Y[+3-xuDf3w/Z>X5.%^9_HMbQVCymi~/pSlri_@Pk%' );
define( 'LOGGED_IN_SALT',   '+z(eBjm^IYIHWK>rbA7[4w_Fzg&M@?L<5sl8~Y>wAB8kh,Rut0]+XF:EdNi5IC;k' );
define( 'NONCE_SALT',       'UoXim_s.upFu`BDZ6(*#mR_*NbwxP!d/$Yb:FfUSd1o8^}b+@!AAx] YA:ockC$?' );

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
