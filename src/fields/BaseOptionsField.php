<?php
/**
 * @link https://craftcms.com/
 * @copyright Copyright (c) Pixel & Tonic, Inc.
 * @license https://craftcms.github.io/license/
 */

namespace appyhay\datalist\fields;

use Craft;
use craft\base\ElementInterface;
use craft\base\Field;
use craft\base\PreviewableFieldInterface;
use craft\helpers\Cp;
use LitEmoji\LitEmoji;

/**
 * BaseOptionsField is the base class for classes representing an options field.
 *
 * @author Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @since 3.0.0
 */
abstract class BaseOptionsField extends Field implements PreviewableFieldInterface
{
    /**
     * @var array The available options
     */
    public array $options;

    /**
     * @inheritdoc
     */
    // public function init()
    public function __construct($config = [])
    {
        // Normalize the options
        $options = [];
        if (isset($config['options']) && is_array($config['options'])) {
            if (is_array($config['options'])) {
                foreach ($config['options'] as $key => $option) {
                    // Old school?
                    if (!is_array($option)) {
                        $options[] = [
                            'value' => $key,
                        ];
                    } else {
                        $options[] = $option;
                    }
                }
            }
        }

        $config['options'] = $options;

        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function settingsAttributes(): array
    {
        $attributes = parent::settingsAttributes();
        $attributes[] = 'options';

        return $attributes;
    }

    /**
     * @inheritdoc
     */
    protected function defineRules(): array
    {
        $rules = parent::defineRules();
        $rules[] = ['options', 'validateOptions'];
        return $rules;
    }

    /**
     * Validates the field options.
     *
     * @since 3.3.5
     */
    public function validateOptions(): void
    {
        // @TODO add validation items for text entry
    }

    /**
     * @inheritdoc
     */
    public function getSettingsHtml(): ?string
    {
        if (empty($this->options)) {
            // Give it a default row
            $this->options = [['value' => '']];
        }

        $cols = [];
        $cols['value'] = [
            'heading' => Craft::t('datalist', 'Value'),
            'type' => 'singleline',
            'class' => 'code',
        ];

        $rows = [];
        foreach ($this->options as $option) {
            $rows[] = $option;
        }

        return Cp::editableTableFieldHtml([
            'label' => $this->optionsSettingLabel(),
            'instructions' => Craft::t('datalist', 'Define the available options.'),
            'id' => 'options',
            'name' => 'options',
            'addRowLabel' => Craft::t('datalist', 'Add an option'),
            'allowAdd' => true,
            'allowReorder' => true,
            'allowDelete' => true,
            'cols' => $cols,
            'rows' => $rows,
            'errors' => $this->getErrors('options'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function normalizeValue(mixed $value, ?ElementInterface $element = null): mixed
    {
        if ($value !== null) {
            $value = LitEmoji::shortcodeToUnicode($value);
            $value = trim(preg_replace('/\R/u', "\n", $value));
        }

        return $value !== '' ? $value : null;
    }

    /**
     * @inheritdoc
     */
    public function serializeValue(mixed $value, ?ElementInterface $element = null): mixed
    {
        if ($value !== null) {
            $value = LitEmoji::unicodeToShortcode($value);
        }
        return $value;
    }

    /**
     * @inheritdoc
     */
    protected function searchKeywords(mixed $value, ElementInterface $element): string
    {
        $value = (string)$value;
        $value = LitEmoji::unicodeToShortcode($value);
        return $value;
    }

    /**
     * Returns the label for the Options setting.
     *
     * @return string
     */
    abstract protected function optionsSettingLabel(): string;

    /**
     * @return array
     */
    protected function options(): array
    {
        return $this->options ?? [];
    }

    protected function datalistOptions(): array
    {
        $datalistOptions = [];

        foreach ($this->options() as $option) {
            $datalistOptions[] = [
                'value' => $option['value'],
                ];
        }

        return $datalistOptions;
    }

}
