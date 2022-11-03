<?php
/**
 * Datalist plugin for Craft CMS 4.x
 *
 * Datalist entry field.
 *
 * @link      https://github.com/appyhay/datalist
 * @copyright Copyright (c) 2022 John Fuller
 */

namespace appyhay\datalist;

use Craft;
use craft\base\Plugin;
use craft\services\Fields;
use craft\events\RegisterComponentTypesEvent;
use appyhay\datalist\fields\DatalistField;
use yii\base\Event;

/**
 * @author    John Fuller
 * @package   Datalist
 * @since     1.0.0
 */
class Datalist extends Plugin
{
    /**
     * @var Datalist
     */
    public static $plugin;

    /**
     * @var string
     */
    public string $schemaVersion = '1.0.0';

    /**
     * @var bool
     */
    public bool $hasCpSettings = false;

    /**
     * @var bool
     */
    public bool $hasCpSection = false;

    public function init()
    {
        parent::init();
        self::$plugin = $this;

        Event::on(
            Fields::class,
            Fields::EVENT_REGISTER_FIELD_TYPES,
            function (RegisterComponentTypesEvent $event) {
                $event->types[] = DatalistField::class;
            }
        );

        Craft::info(
            Craft::t(
                'datalist',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

}
