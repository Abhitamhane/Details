<?php

namespace Employee\Details\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Employee\Details\Model\PostFactory as ViewCollectionFactory;

class DeleteEmployee implements ResolverInterface
{

    public function __construct(ViewCollectionFactory $viewCollectionFactory)
    {
        $this->_viewCollectionFactory = $viewCollectionFactory;
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
        $id = $args['input']['idColumn'];
        if (empty($args['input']['idColumn'])) {
            throw new GraphQlInputException(__('Id No should be specified'));
        }
        try {
                $model = $this->_viewCollectionFactory->create();
                $model->load($id);
                $model->delete();

        } catch (NoSuchEntityException $exception) {
            throw  new NoSuchEntityException(__($exception->getMessage()));
        }
    }
}
