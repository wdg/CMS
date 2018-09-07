<?php
/** Loader
 *
 * Loads everything you'll ever need.
 */
namespace WDGWV\CMS;

/*
------------------------------------------------------------
-                :....................,:,                  -
-              ,.`,,,::;;;;;;;;;;;;;;;;:;`                 -
-            `...`,::;:::::;;;;;;;;;;;;;::'                -
-           ,..``,,,::::::::::::::::;:;;:::;               -
-          :.,,``..::;;,,,,,,,,,,,,,:;;;;;::;`             -
-         ,.,,,`...,:.:,,,,,,,,,,,,,:;:;;;;:;;             -
-        `..,,``...;;,;::::::::::::::'';';';:''            -
-        ,,,,,``..:;,;;:::::::::::::;';;';';;'';           -
-       ,,,,,``....;,,:::::::;;;;;;;;':'''';''+;           -
-       :,::```....,,,:;;;;;;;;;;;;;;;''''';';';;          -
-      `,,::``.....,,,;;;;;;;;;;;;;;;;'''''';';;;'         -
-      :;:::``......,;;;;;;;;:::::;;;;'''''';;;;:-         -
-      ;;;::,`.....,::;;::::::;;;;;;;;'''''';;,;;,         -
-      ;:;;:;`....,:::::::::::::::::;;;;'''':;,;;;         -
-      ';;;;;.,,,,::::::::::::::::::;;;;;''':::;;'         -
-      ;';;;;.;,,,,::::::::::::::::;;;;;;;''::;;;'         -
-      ;'';;:;..,,,;;;:;;:::;;;;;;;;;;;;;;;':::;;'         -
-      ;'';;;;;.,,;:;;;;;;;;;;;;;;;;;;;;;;;;;:;':;         -
-      ;''';;:;;.;;;;;;;;;;;;;;;;;;;;;;;;;;;''';:.         -
-      :';';;;;;;::,,,,,,,,,,,,,,:;;;;;;;;;;'''';          -
-       '';;;;:;;;.,,,,,,,,,,,,,,,,:;;;;;;;;'''''          -
-       '''';;;;;:..,,,,,,,,,,,,,,,,,;;;;;;;''':,          -
-       .'''';;;;....,,,,,,,,,,,,,,,,,,,:;;;''''           -
-        ''''';;;;....,,,,,,,,,,,,,,,,,,;;;''';.           -
-         '''';;;::.......,,,,,,,,,,,,,:;;;''''            -
-         `''';;;;:,......,,,,,,,,,,,,,;;;;;''             -
-          .'';;;;;:.....,,,,,,,,,,,,,,:;;;;'              -
-           `;;;;;:,....,,,,,,,,,,,,,,,:;;''               -
-             ;';;,,..,.,,,,,,,,,,,,,,,;;',                -
-               '';:,,,,,,,,,,,,,,,::;;;:                  -
-                 `:;'''''''''''''''';:.                   -
-                                                          -
- ,,,::::::::::::::::::::::::;;;;,:::::::::::::::::::::::: -
- ,::::::::::::::::::::::::::;;;;,:::::::::::::::::::::::: -
- ,:; ## ## ##  #####     ####      ## ## ##  ##   ##  ;:: -
- ,,; ## ## ##  ## ##    ##         ## ## ##  ##   ##  ;:: -
- ,,; ## ## ##  ##  ##  ##   ####   ## ## ##   ## ##   ;:: -
- ,,' ## ## ##  ## ##    ##    ##   ## ## ##   ## ##   ::: -
- ,:: ########  ####      ######    ########    ###    ::: -
- ,,,:,,:,,:::,,,:;:::::::::::::::;;;:::;:;::::::::::::::: -
- ,,,,,,,,,,,,,,,,,,,,,,,,:,::::::;;;;:::::;;;;::::;;;;::: -
-                                                          -
-       (c) WDGWV. 2018, http://www.wdgwv.com              -
-    Websites, Apps, Hosting, Services, Development.       -
------------------------------------------------------------
 */

/**
 * Autoload WDGWV CMS class
 * @param  string $class The class name
 * @return void
 */
function autloadWDGWVCMS($class)
{
    /**
     * Replace \ to /
     * @var string
     */
    $fileName = str_replace('\\', '/', $class);

    /**
     * sprintf ./Data/$filename.php
     * @var string
     */
    $fileName = sprintf('./Data/%s.php', $fileName);

    /**
     * Check if the file exists, otherwise fail.
     */
    if (file_exists($fileName)) {
        /**
         * Check if $fileName is readable.
         */
        if (is_readable($fileName)) {
            /**
             * Load $fileName.
             */
            require_once $fileName;
        } else {
            /**
             * Check if the $class is using a namespace, otherwise, ignore
             */
            if (sizeof(explode('\\', $class)) > 1) {
                /**
                 * Show the error
                 */
                echo "<b>WARNING</b><br />";
                echo "Couldn't load class <b>{$class}</b> the required file is missing!<br />";
                echo "Attempted to load: {$fileName}<hr />";

                /**
                 * debug_print_backtrace, show debug logs
                 */
                echo "<pre>";
                debug_print_backtrace();
                echo "</pre>";

                /**
                 * Exit with error (1)
                 */
                exit(1);
            }
        }
    } else {
        /**
         * Check if the $class is using a namespace, otherwise, ignore
         */
        if (sizeof(explode('\\', $class)) > 1) {
            /**
             * Show the error
             */
            echo "<b>WARNING</b><br />";
            echo "Couldn't load class <b>{$class}</b> the required file is missing!<br />";
            echo "Attempted to load: {$fileName}<hr />";

            /**
             * debug_print_backtrace, show debug logs
             */
            echo "<pre>";
            debug_print_backtrace();
            echo "</pre>";

            /**
             * Exit with error (1)
             */
            exit(1);
        }
    }

    /**
     * return, becouse the class is loaded, and we don't need to do anything anymore.
     */
    return;
}

/**
 * Add class to spl autload register
 */
spl_autoload_register('WDGWV\CMS\autloadWDGWVCMS');

/**
 * Define Template directory
 */
define('CMS_TEMPLATE_DIR', './Data/Themes/');

/**
 * Initialize the configuration
 * @param $_config class The configuration class
 */
$_config = Config::shared();

/**
 * Initialize the debugger
 * @param $debugger class The debugger class
 */
$debugger = Debugger::shared();

/**
 * Initialize the hooks system
 * @param $hooks the hooks system
 */
$hooks = Hooks::shared();

/**
 * Initialize the extensions system
 * @param $extensions the extensions system
 */
$extensions = Extensions::shared();

/**
 * Initialize the installer
 * @param $installer class The installer class
 */
$installer = Installer::shared();

/**
 * Initialize the database
 * @param $database class The database class
 */
$database = Controllers\Databases\Controller::shared();

/**
 * Initialize the CMS
 * @param $CMS class The CMS class
 */
$CMS = Base::shared();

/**
 * If in debug mode, hook debugger to the installer.
 */
if ($_config->debug) {
    /**
     * Hook debugger to installer.
     */
    $installer->setDebugger($debugger);
}

/**
 * Relase $_config before continue...
 */
unset($_config);