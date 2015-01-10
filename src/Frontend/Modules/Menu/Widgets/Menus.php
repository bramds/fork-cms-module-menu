<?php

namespace Frontend\Modules\Menu\Widgets;

/*
 * This file is part of Fork CMS.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

use Frontend\Core\Engine\Base\Widget;
use Frontend\Core\Engine\Navigation;
use Frontend\Modules\Menu\Engine\Model as FrontendMenuModel;

/**
 * This is a widget with the A la carte menu items
 *
 * @author Jesse Dobbelaere <jesse@dobbelaere-ae.be>
 */
class Menus extends Widget
{
    /**
     * Execute the extra
     */
    public function execute()
    {
        parent::execute();
        $this->loadTemplate();
        $this->parse();
    }

    /**
     * Parse
     */
    private function parse()
    {
        // get categories
        $menus = FrontendMenuModel::getAllMenus();

        // assign comments
        $this->tpl->assign('widgetMenus', $menus);
    }
}
