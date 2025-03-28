<?php

namespace webdna\descendantentries;

use Craft;
use craft\base\Plugin as BasePlugin;
use craft\elements\conditions\entries\EntryCondition;
use craft\events\RegisterConditionRulesEvent;
use webdna\descendantentries\elements\conditions\DescendantEntriesRule;
use yii\base\Event;

/**
 * Descendant Entries Condition plugin
 *
 * @method static Plugin getInstance()
 * @author webdna <info@webdna.co.uk>
 * @copyright webdna
 * @license MIT
 */
class Plugin extends BasePlugin
{
    public string $schemaVersion = '1.0.0';

    public static function config(): array
    {
        return [
            'components' => [
                // Define component configs here...
            ],
        ];
    }

    public function init(): void
    {
        parent::init();

        $this->attachEventHandlers();

        // Any code that creates an element query or loads Twig should be deferred until
        // after Craft is fully initialized, to avoid conflicts with other plugins/modules
        Craft::$app->onInit(function() {
            Event::on(
                EntryCondition::class,
                EntryCondition::EVENT_REGISTER_CONDITION_RULES,
                function (RegisterConditionRulesEvent $event) {
                    $event->conditionRules[] = DescendantEntriesRule::class;
                }
            );
        });
    }

    private function attachEventHandlers(): void
    {
        // Register event handlers here ...
        // (see https://craftcms.com/docs/5.x/extend/events.html to get started)
    }
}
