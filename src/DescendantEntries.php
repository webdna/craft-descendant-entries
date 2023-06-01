<?php

namespace webdna\descendantentries;

use webdna\descendantentries\elements\conditions\DescendantOfConditionRule;

use Craft;
use craft\base\Plugin;
use craft\elements\conditions\entries\EntryCondition;
use craft\events\RegisterConditionRuleTypesEvent;

use yii\base\Event;

/**
 * Descendants Entry Rule plugin
 *
 * @method static DescendantEntries getInstance()
 * @author webdna <info@webdna.co.uk>
 * @copyright webdna
 * @license MIT
 */
class DescendantEntries extends Plugin
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

        // Defer most setup tasks until Craft is fully initialized
        Craft::$app->onInit(function() {
            $this->attachEventHandlers();
            // ...
        });
    }

    private function attachEventHandlers(): void
    {
        Event::on(
            EntryCondition::class,
            EntryCondition::EVENT_REGISTER_CONDITION_RULE_TYPES,
            function (RegisterConditionRuleTypesEvent $event) {
                $event->conditionRuleTypes[] = DescendantOfConditionRule::class;
            }
        );       
    }
}
