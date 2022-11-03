<?php
/**
 * @link https://craftcms.com/
 * @copyright Copyright (c) Pixel & Tonic, Inc.
 * @license https://craftcms.github.io/license/
 */

namespace appyhay\datalist\fields\data;

use craft\base\Serializable;

/**
 * Class OptionData
 *
 * @author Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @since 3.0.0
 */
class OptionData implements Serializable
{
    /**
     * @var string|null
     */
    public ?string $value = null;

    /**
     * @var bool
     * @since 3.5.10
     */
    public bool $valid;

    /**
     * Constructor
     *
     * @param string|null $value
     * @param bool $selected
     * @param bool $valid
     */
    public function __construct(?string $value, bool $valid = true)
    {
        $this->value = $value;
        $this->valid = $valid;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string)$this->value;
    }

    /**
     * @inheritdoc
     */
    public function serialize(): mixed
    {
        return $this->value;
    }
}
