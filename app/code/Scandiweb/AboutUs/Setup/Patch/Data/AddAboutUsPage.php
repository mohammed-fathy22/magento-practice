<?php

namespace Scandiweb\AboutUs\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Cms\Api\PageRepositoryInterface;
use Magento\Cms\Api\Data\PageInterfaceFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Api\SearchCriteriaBuilder;

class AddAboutUsPage implements DataPatchInterface
{
    /**
     * @var PageRepositoryInterface $pageRepository
     * @var PageInterfaceFactory $pageFactory
     * @var SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        protected PageRepositoryInterface $pageRepository,
        protected PageInterfaceFactory $pageFactory,
        protected  SearchCriteriaBuilder $searchCriteriaBuilder
    ) {}

    /**
     * Apply data patch: add "About Us" CMS page if it does not exist.
     *
     * @return void
     */
    public function apply()
    {
        $identifier = 'about-us';

        // Check if page already exists
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('identifier', $identifier, 'eq')
            ->create();
        $existingPages = $this->pageRepository->getList($searchCriteria)->getItems();

        if (!empty($existingPages)) {
            return; // Page already exists, do nothing
        }

        // Only create a basic About Us page, template is handled by layout XML
        $pageData = [
            'title' => 'About Us',
            'identifier' => $identifier,
            'content' => '', // leave empty, template will render content
            'page_layout' => '1column',
            'is_active' => 1,
            'stores' => [0], // 0 = all stores
            'sort_order' => 0
        ];

        try {
            $page = $this->pageFactory->create();
            $page->setData($pageData);
            $this->pageRepository->save($page);
        } catch (LocalizedException $e) {
            // Optionally log error
        }
    }

    /**
     * Get patch dependencies.
     *
     * @return array
     */
    public static function getDependencies(): array
    {
        return [];
    }
    /**
     * Get patch aliases.
     *
     * @return array
     */
    public function getAliases(): array
    {
        return [];
    }
}
