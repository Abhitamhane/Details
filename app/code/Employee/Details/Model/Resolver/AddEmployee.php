<?php
namespace Employee\Details\Model\Resolver;
//resolver section
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Employee\Details\Helper\Data as EmployeeHelper;

class AddEmployee implements ResolverInterface
{
private $contactusDataProvider;

/**
 * @param
 */
    public function __construct(EmployeeHelper $employeeHelper)
    {
        $this->employeeHelper = $employeeHelper;
    }
/**
 * @inheritdoc
 */
public function resolve(
    Field $field,
    $context,
    ResolveInfo $info,
    array $value = null,
    array $args = null
) {
    $empNo['empNo'] = $args['input']['empNo'];
    $empName['empName'] = $args['input']['empName'];
    $contactNo['contactNo']= $args['input']['contactNo'];
    $dob['dob']= $args['input']['dob'];
    $add = $this->employeeHelper->addEmployee($empNo['empNo'], $empName['empName'], $contactNo['contactNo'], $dob['dob']);
    $success = $empNo + $empName + $contactNo + $dob;
    return $success;
}
}
