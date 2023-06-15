<?php

namespace Training\Vendor\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Customer\Model\Customer;
use Magento\Framework\Setup\UpgradeDataInterface;

use Magento\Eav\Model\Config;
use Magento\Customer\Model\ResourceModel\Attribute;
use Magento\Eav\Setup\EavSetupFactory;

class UpgradeData implements UpgradeDataInterface
{
    private $eavSetupFactory;

    private $eavConfig;

    private $attributeResoure;

    public function __construct(
        EavSetupFactory $eavSetupFactory, 
        Config $eavConfig, 
        Attribute $attributeResoure
    ) {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->eavConfig = $eavConfig;
        $this->attributeResoure = $attributeResoure;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if(version_compare($context->getVersion(),'1.0.3', '<')){

            $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

            $attributeSetId = $eavSetup->getDefaultAttributeSetId(Customer::ENTITY);
            $attributeGroupId = $eavSetup->getDefaultAttributeGroupId(Customer::ENTITY);

            // Create a new attribute
            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'Multiselect_product_origin_attribute',
                [
                    'label' => 'Product origin',
                    'type' => 'text',
                    'input' => 'multiselect',
                    'source' => 'Training\Vendor\Model\Config\Product\Extensionoption',
                    'required' => false,
                    'sort_order' => 30,
                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                    'used_in_product_listing' => true,
                    'backend' => 'Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend',
                    'visible_on_front' => true,

                    // 'visible' => true,
                    // 'user_defined' => true,
                    // 'default' => '',
                    // 'searchable' => false,
                    // 'filterable' => false,
                    // 'comparable' => false,
                    // 'used_in_product_listing' => true,
                    // 'unique' => false,
                ]
            );

            $attribute = $this->eavConfig->getAttribute(Customer::ENTITY, 'Multiselect_product_origin_attribute');
            $attribute->setData('attribute_set_id', $attributeSetId);
            $attribute->setData('attribute_group_id', $attributeGroupId);

            $this->attributeResoure->save($attribute);

        }
        $setup->endSetup();
    }
}