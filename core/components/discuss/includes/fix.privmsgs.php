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
$mtime = microtime();
$mtime = explode(' ', $mtime);
$mtime = $mtime[1] + $mtime[0];
$tstart = $mtime;
set_time_limit(0);

/* override with your own defines here (see build.config.sample.php) */
require_once dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/config.core.php';
require_once MODX_CORE_PATH.'config/'.MODX_CONFIG_KEY.'.inc.php';
require_once MODX_CORE_PATH . 'model/modx/modx.class.php';
$modx= new modX();
$modx->initialize('mgr');
$modx->setLogLevel(modX::LOG_LEVEL_INFO);
$modx->setLogTarget('ECHO');

/* load Discuss */
$discuss = $modx->getService('discuss','Discuss',$modx->getOption('discuss.core_path',null,$modx->getOption('core_path').'components/discuss/').'model/discuss/');
if (!($discuss instanceof Discuss)) return '';

/* setup mem limits */
ini_set('memory_limit','1024M');
set_time_limit(0);
@ob_end_clean();
echo '<pre>';

/* load and run importer */
if ($discuss->loadImporter('disSmfImport')) {
    $c = $modx->newQuery('disThread');
    $c->select(array(
        'id',
        'board',
        'users',
        'title',
        'author_first',
    ));
    $c->where(array(
        'private' => true,
    ));
    $c->sortby('id','ASC');
    $threads = $modx->getIterator('disThread',$c);
    /** @var disThread $thread */
    foreach ($threads as $thread) {
        $users = $thread->get('users');
        $discuss->import->log('Setting users to: '.$users.' for Thread: '.$thread->get('title'));
        if (!empty($users)) {
            $users = explode(',',$users);
            foreach ($users as $user) {
                /** @var disThreadUser $threadUser */
                $threadUser = $modx->getObject('disThreadUser',array(
                    'user' => $user,
                    'thread' => $thread->get('id'),
                ));
                if (!$threadUser) {
                    $threadUser = $modx->newObject('disThreadUser');
                    $threadUser->set('user',$user);
                    $threadUser->set('thread',$thread->get('id'));
                    $threadUser->set('author',$thread->get('author_first') == $user ? true : false);
                    $threadUser->save();
                }

                /** @var disUserNotification $subscription */
                $subscription = $modx->getObject('disUserNotification',array(
                    'thread' => $thread->get('id'),
                    'user' => $user,
                    'board' => 0,
                ));
                if (!$subscription) {
                    $subscription = $modx->newObject('disUserNotification');
                    $subscription->set('thread',$thread->get('id'));
                    $subscription->set('user',$user);
                    $subscription->set('board',0);
                    $subscription->save();
                }
            }
        }
    }
} else {
    $modx->log(xPDO::LOG_LEVEL_ERROR,'Failed to load Import class.');
}

$mtime= microtime();
$mtime= explode(" ", $mtime);
$mtime= $mtime[1] + $mtime[0];
$tend= $mtime;
$totalTime= ($tend - $tstart);
$totalTime= sprintf("%2.4f s", $totalTime);

$modx->log(modX::LOG_LEVEL_INFO,"\nExecution time: {$totalTime}\n");

@session_write_close();
die();