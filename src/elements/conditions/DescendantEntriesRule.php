<?php

namespace webdna\descendantentries\elements\conditions;

use Craft;
use craft\base\ElementInterface;
use craft\base\conditions\BaseElementSelectConditionRule;
use craft\elements\conditions\ElementConditionRuleInterface;
use craft\elements\db\ElementQueryInterface;
use craft\elements\Entry;

/**
 * Descendant Entries element condition rule
 */
class DescendantEntriesRule extends BaseElementSelectConditionRule implements ElementConditionRuleInterface
{
    function getLabel(): string
    {
        // hide from element index for now
        if ($this->condition->referenceElement) {
            return Craft::t('descendant-entries', 'Descendant Entries');
        }
        return '';
    }

    function getExclusiveQueryParams(): array
    {
        return ['descendantOf'];
    }

    function modifyQuery(ElementQueryInterface $query): void
    {
        $query->descendantOf($this->condition->referenceElement);
    }

    function inputHtml(): string
    {
        return '';
    }

    // function operators(): array
    // {
    //     return [
    //         ...parent::operators(),
    //         self::OPERATOR_NOT_EMPTY,
    //     ];
    // }

    function matchElement(ElementInterface $element): bool
    {
        // Match the element based on one of its attributes
        return $this->matchValue($element->getDescendants());
    }

    protected function elementType(): string
    {
        // Return the element type to select
        return Entry::class;
    }

    protected function sources(): ?array
    {
        return null;
    }

    protected function criteria(): ?array
    {
        return null;
    }
}
