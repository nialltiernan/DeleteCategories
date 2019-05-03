<?php

namespace Niall\DeleteCategories\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Catalog\Model\Category;
use Magento\Catalog\Model\ResourceModel\Category\Collection;

class Index extends Action
{
    /**
     * @var Collection
     */
    private $collection;

    /**
     * Constructor
     *
     * @param Context $context
     * @param Collection     $collection
     */
    public function __construct(Context $context, Collection $collection)
    {
        parent::__construct($context);
        $this->collection = $collection;
    }

    public function execute()
    {
        /* @var Category $category */
        foreach ($this->collection as $category) {
            if ($category->getId() <= 2) {
                continue;
            }
            try {
                $category->delete();
            } catch (\Exception $exception) {
                echo $exception->getMessage();
            }
        }
        return $this->_redirect('admin/dashboard');
    }

}
