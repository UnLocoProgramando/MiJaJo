<?php
define('CONFIG', require(__DIR__ . '/config.php'));
const VIEWS_DIR = __DIR__ . '/../res/views/';


/**
 * Retrieves a configuration value from the CONFIG array.
 *
 * This function accesses the CONFIG array using the specified type and title
 * to retrieve a configuration value. If the value is not found, the provided
 * default value is returned.
 *
 * @param string $type The category or section of the configuration.
 * @param string $title The specific configuration key within the category.
 * @param string|null $default The default value to return if the configuration
 *                             value is not found. Defaults to null.
 *
 * @return mixed The configuration value or the default value if not found.
 */
function get_config(string $type, string $title, string $default = null)
{
    return CONFIG[$type][$title] ?? $default;
}
/**
 * Serves a view file.
 *
 * @param string $view The name of the view to serve. The .php extension should be omitted.
 * @param array $data An associative array of variables to extract into the view file's scope.
 */
function render_view(string $view, array $data = [], string $title = ''): void
{
    // serves the view file
    extract($data);
    $page_title = get_config('app', 'name', '') . ' - ' . $title;
    try {
        require VIEWS_DIR . $view . '.php';
    } catch (ParseError $e) {
        // check if the file exists
        //throw new ViewNotFoundException('The view file does not exist: ' . VIEWS_DIR . $view . '.php' . PHP_EOL . $e->getMessage());
    }
    exit;
}
