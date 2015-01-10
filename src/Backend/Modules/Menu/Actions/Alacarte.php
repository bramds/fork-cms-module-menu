<?php

namespace Backend\Modules\Menu\Actions;

/*
 * This file is part of Fork CMS.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

use Backend\Core\Engine\Base\ActionIndex;
use Backend\Core\Engine\Authentication;
use Backend\Core\Engine\DataGridDB;
use Backend\Core\Engine\Language;
use Backend\Core\Engine\Model;
use Backend\Modules\Menu\Engine\Model as BackendMenuModel;

/**
 * This is the index-action (default), it will display the overview of Menu posts
 *
 * @author Jesse Dobbelaere <jesse@dobbelaere-ae.be>
 */
class Alacarte extends ActionIndex
{
    /**
     * @var Array The datagrids
     */
    private $dataGrids;

    /**
     * Execute the action
     */
    public function execute()
    {
        parent::execute();
        $this->loadDataGrids();

        $this->parse();
        $this->display();
    }

    /**
     * Load the datagrids for each category
     */
    private function loadDataGrids()
    {
        $categories = BackendMenuModel::getCategories();
        foreach ($categories as $id => $category) {
            $this->loadDataGrid($id, $category);
        }
    }

    /**
     * Load a datagrid
     *
     * @param $categoryId int Category ID
     */
    protected function loadDataGrid($categoryId, $categoryName)
    {
        $dataGrid = new DataGridDB(
            BackendMenuModel::QRY_DATAGRID_BROWSE_ALACARTE,
            array(Language::getWorkingLanguage(), $categoryId)
        );

        // reform date
        $dataGrid->setColumnFunction(
            array('Backend\Core\Engine\DataGridFunctions', 'getLongDate'),
            array('[created_on]'), 'created_on', true
        );

        // drag and drop sequencing
        $dataGrid->enableSequenceByDragAndDrop();
        $dataGrid->setAttributes(array('data-action' => 'sequence_alacarte'));

        // check if this action is allowed
        if (Authentication::isAllowedAction('EditAlacarte')) {
            $dataGrid->addColumn(
                'edit', null, Language::lbl('Edit'),
                Model::createURLForAction('EditAlacarte') . '&amp;id=[id]',
                Language::lbl('Edit')
            );
            $dataGrid->setColumnURL(
                'title', Model::createURLForAction('EditAlacarte') . '&amp;id=[id]'
            );
        }

        // Add each datagrid to the $dataGrids array
        $this->dataGrids[] = array(
            'title' => $categoryName,
            'content' => $dataGrid->getContent()
        );
    }

    /**
     * Parse the page
     */
    protected function parse()
    {
        // parse the dataGrid if there are results
        $this->tpl->assign('dataGrids', $this->dataGrids);
    }
}
