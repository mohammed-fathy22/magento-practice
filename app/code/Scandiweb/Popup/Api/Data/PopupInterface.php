<?php

namespace Scandiweb\Popup\Api\Data;

interface PopupInterface
{
    /**
     * Get ID
     *
     * @return int
     */
    public function getId(): int;

    /**
     * Set ID
     *
     * @param int $id
     * @return \Scandiweb\Popup\Api\Data\PopupInterface
     */
    public function setId(int $id);

    /**
     * Get Name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Set Name
     *
     * @param string $name
     * @return \Scandiweb\Popup\Api\Data\PopupInterface
     */
    public function setName(string $name);

    /**
     * Get Content
     *
     * @return string
     */
    public function getContent(): string;

    /**
     * Set Content
     *
     * @param string $content
     * @return \Scandiweb\Popup\Api\Data\PopupInterface
     */
    public function setContent(string $content);

    /**
     * Get Is Active
     *
     * @return bool
     */
    public function getIsActive(): bool;

    /**
     * Set Is Active
     *
     * @param bool $isActive
     * @return \Scandiweb\Popup\Api\Data\PopupInterface
     */
    public function setIsActive(bool $isActive);

    /**
     * Get Created At
     *
     * @return string
     */
    public function getCreatedAt(): string;

    /**
     * Set Created At
     *
     * @param string $createdAt
     * @return \Scandiweb\Popup\Api\Data\PopupInterface
     */
    public function setCreatedAt(string $createdAt);

    /**
     * Get Updated At
     *
     * @return string
     */
    public function getUpdatedAt(): string;

    /**
     * Set Updated At
     *
     * @param string $updatedAt
     * @return \Scandiweb\Popup\Api\Data\PopupInterface
     */
    public function setUpdatedAt(string $updatedAt);
    /**
     * Get Timeout
     *
     * @return bool
     */
    public function getTimeout(): bool;
    /**
     * Set Timeout
     *
     * @param bool $timeout
     * @return \Scandiweb\Popup\Api\Data\PopupInterface
     */
    public function setTimeout(bool $timeout);
}
