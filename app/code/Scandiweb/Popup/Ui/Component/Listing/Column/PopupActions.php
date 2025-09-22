<?php

declare(strict_types=1);

namespace Scandiweb\Popup\Ui\Component\Listing\Column;

use Magento\Framework\Escaper;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

/**
 * Column for Popup grid actions (Edit/Delete).
 */
class PopupActions extends Column
{
    /** Url path for edit action */
    const URL_PATH_EDIT = 'scandiweb_popup/popup/edit';
    /** Url path for delete action */
    const URL_PATH_DELETE = 'scandiweb_popup/popup/delete';

    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * @var string
     */
    private $editUrl;

    /**
     * @var Escaper
     */
    private Escaper $escaper;
    /**
     * Constructor.
     *
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     * @param string $editUrl
     * @param Escaper $escaper
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        Escaper $escaper,
        array $components = [],
        array $data = [],
        $editUrl = self::URL_PATH_EDIT,
    ) {
        $this->escaper = $escaper;
        $this->urlBuilder = $urlBuilder;
        $this->editUrl = $editUrl;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare data source for grid actions.
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource): array
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $name = $this->getData('name');
                if (isset($item['popup_id'])) {
                    $item[$name]['edit'] = [
                        'href' => $this->urlBuilder->getUrl($this->editUrl, ['popup_id' => $item['popup_id']]),
                        'label' => __('Edit'),
                    ];
                    $escapedName = $this->getEscaper()->escapeHtml($item['popup_name']);
                    $item[$name]['delete'] = [
                        'href' => $this->urlBuilder->getUrl(self::URL_PATH_DELETE, ['popup_id' => $item['popup_id']]),
                        'label' => __('Delete'),
                        'confirm' => [
                            'title' => __('Delete %1', $escapedName),
                            'message' => __('Are you sure you want to delete a %1 record?', $escapedName),
                        ],
                        'post' => true,
                    ];
                }
            }
        }

        return $dataSource;
    }
    /**
     * Get instance of escaper.
     *
     * @return Escaper
     */
    private function getEscaper(): Escaper
    {
        return $this->escaper;
    }
}
