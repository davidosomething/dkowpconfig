<?php
/**
 * Register the default WordPress theme directory
 * a la Mark Jaquith's WordPress-Skeleton:
 * https://github.com/markjaquith/WordPress-Skeleton/commit/88070415ad7e4ccedce3311b39e38991c639ae97
 *
 * This allows WP to find the Twenty-Eleven and Twenty-Twelve themes in case
 * we don't have a theme in /themes selected.
 */
register_theme_directory( ABSPATH . 'wp-content/themes/' );
