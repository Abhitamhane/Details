<?php
/**
 * Creating Product attribute
 */

namespace Employee\Details\Setup\Patch\Data;

use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Employee\Details\Model\Attribute\Source\AgentAttribute as Source; 
use Employee\Details\Model\Attribute\Frontend\AgentAttribute as Frontend; 
use Employee\Details\Model\Attribute\Backend\AgentAttribute as Backend; 

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;


/**
 * Class CreateAgentProductAttribute
 * @package Employee\Details\Setup
 */

 class CreateAgentProductAttribute implements DataPatchInterface, PatchRevertableInterface
{
	const SESSION_ATTRIBUTES = [
	'agent_product_attribute' => [
		'input' => 'select',
		'type' => 'text',
		'label' => 'Agent Attribute',
		'visible' => true,
		'required' => true,
		'used_in_product_listing' => true,
		'visible_on_front' => false,
		'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
		'unique' => false,
		'source' => Source::class,
		'frontend'=> Frontend::class,
		'backend'=> Backend::class,
		'group' => 'general',
		],
	];

	/**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;
    /**
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * Constructor
     *
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }

	public function apply()
	{
	
		$this->moduleDataSetup->getConnection()->startSetup();
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
		foreach (self::SESSION_ATTRIBUTES as $attributeKey => $attributeValue) {
		$eavSetup->addAttribute(
			\Magento\Catalog\Model\Product::ENTITY,
			$attributeKey,
			$attributeValue
		);
	}
	$this->moduleDataSetup->getConnection()->endSetup();
	}

	public function getAliases()
	{
		return [];
	}

	public static function getDependencies()
	{
		return [];
	}

	public function revert()
	{

	}
	
}