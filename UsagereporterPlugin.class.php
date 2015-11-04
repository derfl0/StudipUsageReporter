<?php
/**
 * UsagereporterPlugin.class.php
 *
 * ...
 *
 * @author  Florian Bieringer <florian.bieringer@uni-passau.de>
 * @version 1.0
 */

class UsagereporterPlugin extends StudIPPlugin implements SystemPlugin {

    public function __construct() {
        parent::__construct();

        $navigation = new AutoNavigation(_('UsageReporter'));
        $navigation->setURL(PluginEngine::GetURL($this, array(), 'show/index'));
        Navigation::addItem('/tools/usagereporterplugin', $navigation);

        register_shutdown_function('UsagereporterPlugin::report');
    }

    public function initialize () {

    }

    public function perform($unconsumed_path)
    {
        $this->setupAutoload();
        $dispatcher = new Trails_Dispatcher(
            $this->getPluginPath(),
            rtrim(PluginEngine::getLink($this, array(), null), '/'),
            'show'
        );
        $dispatcher->plugin = $this;
        $dispatcher->dispatch($unconsumed_path);
    }

    private function setupAutoload()
    {
        if (class_exists('StudipAutoloader')) {
            StudipAutoloader::addAutoloadPath(__DIR__ . '/models');
        } else {
            spl_autoload_register(function ($class) {
                include_once __DIR__ . $class . '.php';
            });
        }
    }

    public static function report() {
        try {
            $stmt = DBManager::get()->prepare("REPLACE INTO usage_report (caller, include) VALUES (?,?)");
            foreach (get_included_files() as $file) {
                $stmt->execute(array($_SERVER['REQUEST_URI'], $file));
            }
        } catch (PDOException $e) {
            echo "ERROR! $e";
        }
    }
}
