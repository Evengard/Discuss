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
 *
 * @package discuss
 * @subpackage controllers
 */
class DiscussUserController extends DiscussController {
    /** @var disUser $user */
    public $user;


    public function initialize() {
        /* allow external profile page */
        $profileResourceId = $this->modx->getOption('discuss.profile_resource_id',null,0);
        if (!empty($profileResourceId) && $this->discuss->ssoMode) {
            $url = $this->modx->makeUrl($profileResourceId,'',array('discuss' => 1,'user' => $this->scriptProperties['user']),'full');
            $this->modx->sendRedirect($url);
        }

        $user = $this->getProperty('user',$this->discuss->user->get('id'));
        if (empty($user)) { $this->discuss->sendErrorPage(); }
        $user = trim($user,' /');
        $key = intval($user) <= 0 ? 'username' : 'id';
        $c = array();
        $c[!empty($this->scriptProperties['i']) ? 'integrated_id' : $key] = $user;
        $this->user = $this->modx->getObject('disUser',$c);
        if (empty($this->user)) { $this->discuss->sendErrorPage(); }

        $this->modx->lexicon->load('discuss:user');

    }

    /**
     * @return mixed|string
     */
    public function getPageTitle() {
        return $this->user->get('username');
    }

    /**
     * @return string
     */
    public function getSessionPlace() {
        return 'user:'.(($this->user) ? $this->user->get('id') : $this->getProperty('user', 0));
    }

    /**
     * @return bool
     */
    public function checkPermissions() {
        return $this->discuss->user->isLoggedIn;
    }

    /**
     * Process the page
     * @return void
     */
    public function process() {
        $userArray = $this->user->toArray();
        if (!$this->user->isAdmin() && !$this->user->get('show_email')) {
            unset($userArray['email']);
        }
        $this->setPlaceholders($userArray);
        $this->getLastVisitedThread();

        /* recent posts */
        if (!empty($this->options['showRecentPosts'])) {
            $this->getRecentPosts();
        }
        $this->getUserGroups();

        /* do output */
        $this->getMenu();
        $this->modx->setPlaceholder('discuss.user',$this->user->get('username'));
    }

    /**
     * Get the last visited thread for this user
     * @return void
     */
    public function getLastVisitedThread() {
        $this->setPlaceholder('last_reading','');
        $lastThread = $this->user->getLastVisitedThread();
        if ($lastThread) {
            /** @var disPost $firstPost */
            $firstPost = $this->modx->getObject('disPost',$lastThread->get('post_first'));
            $placeholders = $lastThread->toArray('lastThread.');
            if ($firstPost) {
                $placeholders = array_merge($placeholders,$firstPost->toArray('lastThread.'));
                $placeholders['last_post_url'] = $firstPost->getUrl();
            }
            $this->setPlaceholders($placeholders);
        }
    }

    public function getUserGroups() {
        $this->setPlaceholder('groups',implode(', ',$this->user->getUserGroupNames()));
    }

    public function getMenu() {
        $this->setPlaceholder('usermenu',$this->discuss->getChunk('disUserMenu',$this->getPlaceholders()));
    }

    public function getRecentPosts() {
        $recent = $this->discuss->hooks->load('post/recent',array(
            'user' => $this->user->get('id'),
        ));
        $this->setPlaceholder('recent_posts',$recent['results']);
    }

    /**
     * @return array
     */
    public function getBreadcrumbs() {
        $trail = array();
        $trail[] = array(
            'url' => $this->discuss->request->makeUrl(),
            'text' => $this->modx->getOption('discuss.forum_title'),
        );
        $userParams = array();
        if ($this->user->get('id') != $this->discuss->user->get('id')) {
            $userParams = array('user' => $this->user->get('id'));
        }
        $trail[] = array(
            'text' => $this->modx->lexicon('discuss.user.trail',array('user' => ($this->user) ? $this->user->get('username') : $this->discuss->user->get('username'))),
            'url' => $this->discuss->request->makeUrl('user', $userParams)
        );
        return $trail;
    }
}
