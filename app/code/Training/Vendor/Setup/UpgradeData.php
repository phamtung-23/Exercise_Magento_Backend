<?php

namespace Training\Vendor\Setup;




use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Eav\Model\Config;
use Magento\Customer\Model\ResourceModel\Attribute;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Customer\Model\Customer;
use Magento\Eav\Model\Entity\Attribute\SetFactory as AttributeSetFactory;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;


class UpgradeData implements UpgradeDataInterface
{
    protected $customerSetupFactory;

    protected $attributeSetFactory;

    private $eavSetupFactory;

    private $eavConfig;

    private $attributeResoure;

    public function __construct(
        CustomerSetupFactory $customerSetupFactory,
        AttributeSetFactory $attributeSetFactory,
        EavSetupFactory $eavSetupFactory, 
        Config $eavConfig, 
        Attribute $attributeResoure
    ) {
        $this->customerSetupFactory = $customerSetupFactory;
        $this->attributeSetFactory = $attributeSetFactory;
        $this->eavSetupFactory = $eavSetupFactory;
        $this->eavConfig = $eavConfig;
        $this->attributeResoure = $attributeResoure;
    }
    /**
     * {@inheritdoc}
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        
        if(version_compare($context->getVersion(),'1.2.2', '<=')){

            $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

            $attributeSetId = $eavSetup->getDefaultAttributeSetId(Customer::ENTITY);
            $attributeGroupId = $eavSetup->getDefaultAttributeGroupId(Customer::ENTITY);

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
                ]
            );

            $attribute = $this->eavConfig->getAttribute(Customer::ENTITY, 'Multiselect_product_origin_attribute');
            $attribute->setData('attribute_set_id', $attributeSetId);
            $attribute->setData('attribute_group_id', $attributeGroupId);

            $this->attributeResoure->save($attribute);

        }
        
        if(version_compare($context->getVersion(),'1.2.2', '<=')){
            /** @var CustomerSetup $customerSetup */
            $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);

            $customerEntity = $customerSetup->getEavConfig()->getEntityType('customer');
            $attributeSetId = $customerEntity->getDefaultAttributeSetId();

            /** @var $attributeSet AttributeSet */
            $attributeSet = $this->attributeSetFactory->create();
            $attributeGroupId = $attributeSet->getDefaultGroupId($attributeSetId);

            $customerSetup->addAttribute(Customer::ENTITY, 'priority', [
                'type' => 'int',
                'label' => 'Priority',
                'input' => 'select',
                'required' => false,
                'visible' => true,
                'user_defined' => true,
                'sort_order' => 999,
                'position' => 999,
                'system' => 0,
                'source' => 'Training\Vendor\Model\Config\Source\PriorityOptions',
                'is_used_in_grid' => true,
                'is_visible_in_grid' => true,
                'is_html_allowed_on_front' => false,
                'visible_on_front' => true
            ]);

            $attribute = $customerSetup->getEavConfig()->getAttribute(Customer::ENTITY, 'priority')
            ->addData([
                'attribute_set_id' => $attributeSetId,
                'attribute_group_id' => $attributeGroupId,
                'used_in_forms' => ['adminhtml_customer', 'customer_account_edit'],
            ]);

            $attribute->save();
        }
    }
}