<?php
/**
 * Discuss
 *
 * Copyright 2010-11 by Shaun McCormick <shaun@modx.com>
 *
 * This file is part of Discuss, a native forum for MODx Revolution.
 *
 * Discuss is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * Discuss is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * Discuss; if not, write to the Free Software Foundation, Inc., 59 Temple Place,
 * Suite 330, Boston, MA 02111-1307 USA
 *
 * @package discuss
 * @subpackage controllers
 */
/**
 * Logout the user
 * 
 * @package discuss
 * @subpackage controllers
 */
class DiscussLogoutController extends DiscussController {
    public function getPageTitle() {
        return $this->modx->lexicon('discuss.logout');
    }
    public function getSessionPlace() { return ''; }

    public function process() {
        $this->discuss->user->clearCache();
        $contexts = $this->modx->user->getSessionContexts();
        foreach ($contexts as $context => $level) {
            if ($context == 'mgr') continue;
            $this->modx->user->removeSessionContext($context);
            $this->modx->getUser($context,true);
        }
        $this->modx->sendRedirect($this->discuss->request->makeUrl());
    }
}