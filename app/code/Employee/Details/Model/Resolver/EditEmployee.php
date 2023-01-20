<?php

namespace Employee\Details\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Employee\Details\Model\PostFactory as ViewCollectionFactory;

class EditEmployee implements ResolverInterface
{
    public function __construct(ViewCollectionFactory $viewCollectionFactory)
    {
        $this->_viewCollectionFactory = $viewCollectionFactory;
    }

    /**
     * 
     * @inheritdoc
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    )
    {
        $id = $args['input']['idColumn'];
        if (empty($args['input']['idColumn'])) 
        {
            throw new GraphQlInputException(__('Id No should be specified'));
        }
            $phone = $args['input']['contactNo'];
            if(preg_match('/^[0-9]{10}+$/', $phone)) 
            {
            $model = $this->_viewCollectionFactory->create();
            $model->load($id);
            $model->setEmpNo($args['input']['empNo']);
            $model->setEmpName($args['input']['empName']);
            $model->setDOb($args['input']['dob']);
            $model->setContactNo($args['input']['contactNo']);
            $model->save();
            }
            else {
                throw new GraphQlInputException(__('Invalid Contact Number'));
            }
       
    }
}
