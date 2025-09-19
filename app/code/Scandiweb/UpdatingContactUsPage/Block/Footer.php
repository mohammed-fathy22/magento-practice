<?php

namespace Scandiweb\UpdatingContactUsPage\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Footer extends Template
{
    public function __construct(
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    public function footerMessage(): string
    {
        return __('Thank you for contacting us. We will respond to you as soon as possible.');
    }
}
