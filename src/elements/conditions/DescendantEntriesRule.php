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
        return Craft::t('descendant-entries-condition', 'Descendant Entries');
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

    function matchElement(ElementInterface $element): bool
    {
        // Match the element based on one of its attributes
        return $this->matchValue($element->myAttribute);
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
