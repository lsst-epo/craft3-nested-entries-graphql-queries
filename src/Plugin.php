<?php
namespace rosas;

use Craft;
use rosas\queries\EntryAsField;
use rosas\arguments\EntryAsFieldArgumentHandler;
use craft\events\RegisterGqlQueriesEvent;
use craft\services\Gql;
use yii\base\Event;
use craft\gql\ArgumentManager;
use craft\events\RegisterGqlArgumentHandlersEvent;

class Plugin extends \craft\base\Plugin {
    public static $plugin;

    //public $hasCpSettings = true;

    public function init() {
        parent::init();
        self::$plugin = $this;

        $this->registerArgumentHandler();
        $this->registerQuery();
        
    }

    // protected function createSettingsModel() {
    //     return new \rosas\models\Settings();
    // }

    protected function registerArgumentHandler() {
        Event::on(
            ArgumentManager::class,
            ArgumentManager::EVENT_DEFINE_GQL_ARGUMENT_HANDLERS,
            function(RegisterGqlArgumentHandlersEvent $event) {
                $event->handlers["searchRelated"] = EntryAsFieldArgumentHandler::class;
            }
        );
    }

    protected function settingsHtml() {
        return \Craft::$app->getView()->renderTemplate(
            'rosas-first-plugin/settings',
            [ 'settings' => $this->getSettings() ]
        );
    }

    public function registerQuery() {
        Event::on(
            Gql::class,
            Gql::EVENT_REGISTER_GQL_QUERIES,
            function(RegisterGqlQueriesEvent $event) {                
                $event->queries['nestedEntries'] = EntryAsField::getQueries();
            }
        );
    }
}