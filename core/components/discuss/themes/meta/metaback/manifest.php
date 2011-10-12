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
 */
/**
 * Theme manifest for default theme
 */
$manifest = array(
    'preview' => 'preview.png',
    'global' => array(
        'css' => array(
            'header' => array(
                'index.css',
            ),
        ),
        'js' => array(
            'header' => array(
                'jquery-1.3.2.min.js',
                'discuss.js',
                'sh/shCore.js',
                'sh/shAutoloader.js',
                'sh/shDiscuss.js',
            ),
            'inline' => 'DIS.url = "'.$this->discuss->request->makeUrl().'";DIS.shJsUrl = "'.$this->discuss->config['jsUrl'].'sh/";',
        ),
    ),
    'print' => array(
        'css' => array(
            'header' => array(
                'print.css',
            ),
        ),
    ),
    'home' => array(
        'js' => array(
            'header' => array(
                'dis.home.js',
            ),
        ),
        'options' => array(
            'showBoards' => true,
            'showBreadcrumbs' => true,
            'showRecentPosts' => true,
            'showStatistics' => true,
            'showLoginForm' => false,
            'bypassUnreadCheck' => true,
            'checkUnread' => true,
            'showLogoutActionButton' => false,
        ),
    ),
    'board' => array(
        'js' => array(
            'header' => array(
                'dis.board.js',
            ),
        ),
        'options' => array(
            'showSubBoards' => true,
            'showPosts' => true,
            'showBreadcrumbs' => true,
            'showReaders' => true,
            'showModerators' => true,
        ),
    ),
    'thread' => array(
        'js' => array(
            'header' => array(
                'dis.thread.js',
            )
        ),
        'options' => array(
            'showPosts' => true,
            'showBreadcrumbs' => true,
            'showViewing' => true,
            'showSubscribeOption' => true,
            'showPrintOption' => false,
            'showStickOption' => true,
            'showLockOption' => true,
            'showMarkAsSpamOption' => true,
        ),
    ),
    'thread/new' => array(
        'js' => array(
            'header' => array(
                'dis.thread.new.js',
                'dis.post.buttons.js',
            ),
        ),
    ),
    'thread/reply' => array(
        'js' => array(
            'header' => array(
                'dis.post.reply.js',
                'dis.post.buttons.js',
            ),
        ),
    ),
    'thread/modify' => array(
        'js' => array(
            'header' => array(
                'dis.post.modify.js',
                'dis.post.buttons.js',
            ),
        ),
    ),
    'thread/remove' => array(
        'js' => array(
            'header' => array(
                'dis.thread.js',
            )
        ),
    ),
    'search' => array(
        'js' => array(
            'header' => array(
                'dis.search.js',
            ),
        ),
        'css' => array(
            'header' => array(
                'search.css',
            ),
        )
    ),
    'user' => array(
        'options' => array(
            'showRecentPosts' => true,
        ),
    ),
    'user/subscriptions' => array(
        'js' => array(
            'header' => array(
                'user/dis.user.subscriptions.js',
            )
        ),
    ),
    'user/ignoreboards' => array(
        'js' => array(
            'header' => array(
                'user/dis.user.ignoreboards.js',
            )
        ),
    ),
    'messages/new' => array(
        'js' => array(
            'header' => array(
                'messages/dis.message.new.js',
                'dis.post.buttons.js',
            ),
        ),
    ),
    'messages/reply' => array(
        'js' => array(
            'header' => array(
                'messages/dis.message.reply.js',
                'dis.post.buttons.js',
            ),
        ),
    ),
    'messages/modify' => array(
        'js' => array(
            'header' => array(
                'messages/dis.message.modify.js',
                'dis.post.buttons.js',
            ),
        ),
    ),
);
return $manifest;