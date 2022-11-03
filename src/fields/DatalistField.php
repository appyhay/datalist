<?php
/**
 * @link https://craftcms.com/
 * @copyright Copyright (c) Pixel & Tonic, Inc.
 * @license https://craftcms.github.io/license/
 */

namespace appyhay\datalist\fields;

use Craft;
use craft\base\ElementInterface;
use craft\base\SortableFieldInterface;
use appyhay\datalist\fields\data\SingleOptionFieldData;
use appyhay\datalist\fields\BaseOptionsField;

/**
 * Dropdown represents a Dropdown field.
 *
 * @author Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @since 3.0.0
 */
class DatalistField extends BaseOptionsField implements SortableFieldInterface
{
    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t('datalist', 'Datalist');
    }

    /**
     * @inheritdoc
     */
    public static function valueType(): string
    {
        return SingleOptionFieldData::class;
    }

    /**
     * @inheritdoc
     */
    protected function inputHtml(mixed $value, ElementInterface $element = null): string
    {
        /** @var SingleOptionFieldData $value */
        $options = $this->datalistOptions();

        // @TODO add validation checks

        return Craft::$app->getView()->renderTemplate('datalist/_includes/forms/datalist.twig', [
            'id' => $this->getInputId(),
            'describedBy' => $this->describedBy,
            'name' => $this->handle,
            'value' => $value,
            'options' => $options,
            'listId' => 'list-' . rand(10000 , 99999),
        ]);
    }

    /**
     * @inheritdoc
     */
    protected function optionsSettingLabel(): string
    {
        return Craft::t('datalist', 'Datalist Options');
    }
}