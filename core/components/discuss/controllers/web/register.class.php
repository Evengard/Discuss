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
 * Display the Register page
 *
 * @todo Only supports SSO now. Eventually make a real register page.
 *
 * @package discuss
 * @subpackage controllers
 */
class DiscussRegisterController extends DiscussController {
    public function getPageTitle() {
        return $this->modx->lexicon('discuss.register');
    }
    public function getSessionPlace() { return ''; }

    public function process() {
        $registerResourceId = $this->modx->getOption('discuss.register_resource_id',null,0);
        if (!empty($registerResourceId) && $this->discuss->ssoMode) {
            $url = $this->modx->makeUrl($registerResourceId,'',array('discuss' => 1),'full');
            $this->modx->sendRedirect($url);
        }
    }
}