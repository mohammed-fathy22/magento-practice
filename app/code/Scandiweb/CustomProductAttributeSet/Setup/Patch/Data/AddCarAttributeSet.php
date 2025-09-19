<?php

declare(strict_types=1);

namespace Scandiweb\CustomProductAttributeSet\Setup\Patch\Data;

use Magento\Catalog\Model\Product;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Eav\Model\Entity\Attribute\SetFactory as AttributeSetFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

/**
 * Data Patch to create "Car Attribute Set" with custom attributes.
 *
 * @package Scandiweb\CustomProductAttributeSet\Setup\Patch\Data
 * @var ModuleDataSetupInterface $moduleDataSetup
 * @var EavSetupFactory $eavSetupFactory
 * @var AttributeSetFactory $attributeSetFactory
 */
class AddCarAttributeSet implements DataPatchInterface
{
    public function __construct(
        protected ModuleDataSetupInterface $moduleDataSetup,
        protected EavSetupFactory $eavSetupFactory,
        protected AttributeSetFactory $attributeSetFactory
    ) {}

    /**
     * Apply the patch: create attribute set, group, and attributes.
     *
     * @return void
     */
    public function apply(): void
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $entityTypeId = $eavSetup->getEntityTypeId(Product::ENTITY);

        // 1. Create new attribute set "Car Attribute Set"
        $attributeSet = $this->attributeSetFactory->create();
        $attributeSet->setEntityTypeId($entityTypeId)
            ->setAttributeSetName('Car Attribute Set')
            ->save();
        $attributeSetId = (int) $attributeSet->getId();

        // 2. Add new group "Car Details"
        $eavSetup->addAttributeGroup(
            $entityTypeId,
            $attributeSetId,
            'Car Details',
            10
        );

        // 3. Define attributes
        $attributes = [
            'engine_type' => [
                'type' => 'varchar',
                'label' => 'Engine Type',
                'input' => 'text',
                'required' => false,
                'visible' => true,
                'user_defined' => true,
                'system' => 0,
            ],
            'fuel_type' => [
                'type' => 'varchar',
                'label' => 'Fuel Type',
                'input' => 'text',
                'required' => false,
                'visible' => true,
                'user_defined' => true,
                'system' => 0,
            ],
            'horsepower' => [
                'type' => 'int',
                'label' => 'Horsepower',
                'input' => 'text',
                'required' => false,
                'visible' => true,
                'user_defined' => true,
                'system' => 0,
            ],
        ];

        // 4. Add attributes to "Car Details" group
        foreach ($attributes as $code => $data) {
            $eavSetup->addAttribute(Product::ENTITY, $code, $data);

            $attribute = $eavSetup->getAttribute(Product::ENTITY, $code);

            if (is_array($attribute) && isset($attribute['attribute_id'])) {
                $eavSetup->addAttributeToSet(
                    $entityTypeId,
                    $attributeSetId,
                    'Car Details',
                    (int) $attribute['attribute_id']
                );
            }
        }

        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * @inheritdoc
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function getAliases(): array
    {
        return [];
    }
}
