<?php

namespace Scandiweb\Popup\Model;

use Magento\Framework\Model\AbstractModel;
use Scandiweb\Popup\Api\Data\PopupInterface;
use Scandiweb\Popup\Model\ResourceModel\Popup as PopupResource;

/**
 * Model class for Popup entity.
 *
 * @package Scandiweb\Popup\Model
 */
class Popup extends AbstractModel implements PopupInterface
{
    /** @var string */
    protected const POPUP_ID = 'popup_id';
    /** @var string */
    protected const POPUP_NAME = 'popup_name';
    /** @var string */
    protected const POPUP_CONTENT = 'popup_content';
    /** @var string */
    protected const IS_ACTIVE = 'is_active';
    /** @var string */
    protected const CREATED_AT = 'created_at';
    /** @var string */
    protected const UPDATED_AT = 'updated_at';
    /** @var string */
    protected const TIMEOUT = 'timeout';

    /**
     * Initialize resource model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_eventPrefix = 'scandiweb_popup';
        $this->_eventObject = 'popup';
        $this->_idFieldName = 'popup_id';
        $this->_init(PopupResource::class);
    }

    /**
     * Get popup name.
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->getData(self::POPUP_NAME);
    }

    /**
     * Set popup name.
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        return $this->setData(self::POPUP_NAME, $name);
    }

    /**
     * Get popup content.
     *
     * @return string
     */
    public function getContent(): string
    {
        return $this->getData(self::POPUP_CONTENT);
    }

    /**
     * Set popup content.
     *
     * @param string $content
     * @return $this
     */
    public function setContent($content)
    {
        return $this->setData(self::POPUP_CONTENT, $content);
    }

    /**
     * Get popup active status.
     *
     * @return bool
     */
    public function getIsActive(): bool
    {
        return (bool) $this->getData(self::IS_ACTIVE);
    }

    /**
     * Set popup active status.
     *
     * @param bool|int $isActive
     * @return $this
     */
    public function setIsActive($isActive)
    {
        return $this->setData(self::IS_ACTIVE, $isActive);
    }

    /**
     * Get popup creation date.
     *
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Set popup creation date.
     *
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * Get popup update date.
     *
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return (string) $this->getData(self::UPDATED_AT);
    }

    /**
     * Set popup update date.
     *
     * @param string $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }

    /**
     * Get popup ID.
     *
     * @return int
     */
    public function getId(): int
    {
        return (int) $this->getData(self::POPUP_ID);
    }

    /**
     * Set popup ID.
     *
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        return $this->setData(self::POPUP_ID, $id);
    }

    /**
     * Get popup timeout status.
     *
     * @return bool
     */
    public function getTimeout(): bool
    {
        return (bool) $this->getData(self::TIMEOUT);
    }

    /**
     * Set popup timeout status.
     *
     * @param bool|int $timeout
     * @return $this
     */
    public function setTimeout($timeout)
    {
        return $this->setData(self::TIMEOUT, $timeout);
    }
}
