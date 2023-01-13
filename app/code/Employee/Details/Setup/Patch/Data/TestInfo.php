<?php

namespace Employee\Details\Setup\Patch\Data;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class TestInfo implements DataPatchInterface
{

    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    public function __construct(
       ModuleDataSetupInterface $moduleDataSetup

     ) {

        $this->moduleDataSetup = $moduleDataSetup;

    }
    public function apply()
    {
        $this->moduleDataSetup->startSetup();
        $setup = $this->moduleDataSetup;

        $data[] = ['emp_no' => '1001', 'emp_name' => 'Abhishek', 'dob' => '2000-11-03', 'contact_no' => '9762523445', 'percentage' => 5];
        $data[] = ['emp_no' => '1002', 'emp_name' => 'Abhi', 'dob' => '2000-12-03', 'contact_no' => '1111111111', 'percentage' => 5];
        $data[] = ['emp_no' => '1003', 'emp_name' => 'QPR', 'dob' => '2000-10-03', 'contact_no' => '1234567890', 'percentage' => 4];
        $data[] = ['emp_no' => '1004', 'emp_name' => 'PQR', 'dob' => '2000-05-20', 'contact_no' => '1123456789', 'percentage' => 5];
        $data[] = ['emp_no' => '1005', 'emp_name' => 'ABC', 'dob' => '2000-03-03', 'contact_no' => '1112345678', 'percentage' => 6];
        $data[] = ['emp_no' => '1006', 'emp_name' => 'XYZ', 'dob' => '2000-02-03', 'contact_no' => '1111234567', 'percentage' => 5];
        $data[] = ['emp_no' => '1007', 'emp_name' => 'WXY', 'dob' => '2000-07-03', 'contact_no' => '1111123456', 'percentage' => 2];
        $data[] = ['emp_no' => '1008', 'emp_name' => 'DEF', 'dob' => '2000-07-03', 'contact_no' => '1111112345', 'percentage' => 5];
        $data[] = ['emp_no' => '1009', 'emp_name' => 'GHI', 'dob' => '2000-01-03', 'contact_no' => '1111111234', 'percentage' => 5];
        $data[] = ['emp_no' => '1010', 'emp_name' => 'RTA', 'dob' => '2000-02-03', 'contact_no' => '1111111123', 'percentage' => 7];


         $this->moduleDataSetup->getConnection()->insertArray(
            $this->moduleDataSetup->getTable('mp_post'),
            ['emp_No', 'emp_name', 'dob', 'contact_no', 'percentage'],
      
            $data
        );     
        $this->moduleDataSetup->endSetup();
    }

    public function getAliases()
    {
        return [];
    }
    public static function getDependencies()
    {
        return [];
    }
}