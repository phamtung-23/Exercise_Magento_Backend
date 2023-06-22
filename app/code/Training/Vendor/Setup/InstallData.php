<?php
namespace Training\Vendor\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Eav\Model\Entity\Attribute\SetFactory as AttributeSetFactory;
use Magento\Eav\Model\Config;
use Magento\Customer\Model\ResourceModel\Attribute;
use Magento\Customer\Model\Customer;
use Magento\Framework\Setup\InstallDataInterface;

class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;

    private $eavConfig;

    private $attributeResoure;

    public function __construct(EavSetupFactory $eavSetupFactory, Config $eavConfig, Attribute $attributeResoure) 
    {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->eavConfig = $eavConfig;
        $this->attributeResoure = $attributeResoure;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

        $attributeSetId = $eavSetup->getDefaultAttributeSetId(Customer::ENTITY);
        $attributeGroupId = $eavSetup->getDefaultAttributeGroupId(Customer::ENTITY);

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'input_text_attribute',
            [
                'label' => 'Text Input',
                'type' => 'text',
                'input' => 'text',
                'source' => '',
                'required' => false,
                'sort_order' => 30,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'used_in_product_listing' => true,
                'backend' => 'Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend',
                'visible_on_front' => true,
            ]
        );

        $attribute = $this->eavConfig->getAttribute(Customer::ENTITY, 'input_text_attribute');
        $attribute->setData('attribute_set_id', $attributeSetId);
        $attribute->setData('attribute_group_id', $attributeGroupId);

        $this->attributeResoure->save($attribute);

        $setup->endSetup();
    }
}
