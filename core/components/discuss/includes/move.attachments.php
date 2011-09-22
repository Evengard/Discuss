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
 * @var Discuss $discuss
 *
 * @package discuss
 * @subpackage scripts
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
    $modx->getCacheManager();
    $sourceAttachmentsPath = $discuss->import->config['attachments_path'];

    $discuss->import->getConnection();
    $c = $modx->newQuery('disPostAttachment');
    $c->sortby('post','DESC');
    $attachments = $modx->getIterator('disPostAttachment',$c);
    /** @var disPostAttachment $attachment */
    foreach ($attachments as $attachment) {
        $found = false;
        $target = $attachment->getPath();
        $source = $sourceAttachmentsPath.$attachment->get('filename');

        $discuss->import->log('Looking for: '.$source);
        if (file_exists($source)) {
            $found = true;
        } else {
            $cleanName = $attachment->get('filename');
            $cleanName = strtr($cleanName, '������������������������������������������������������������', 'SZszYAAAAAACEEEEIIIINOOOOOOUUUUYaaaaaaceeeeiiiinoooooouuuuyy');
            $cleanName = strtr($cleanName, array('�' => 'TH', '�' => 'th', '�' => 'DH', '�' => 'dh', '�' => 'ss', '�' => 'OE', '�' => 'oe', '�' => 'AE', '�' => 'ae', '�' => 'u'));
            $cleanName = preg_replace(array('/\s/', '/[^\w_\.\-]/'), array('_', ''), $cleanName);
            $hash = md5($cleanName);
            $cleanName = strtr($cleanName, '.', '_');
            $source = $sourceAttachmentsPath.$attachment->get('integrated_id').'_'.$cleanName.$hash;
            $discuss->import->log('Looking for: '.$source);
            if (file_exists($source)) {
                $found = true;
            }
        }

        if ($found) {
            $dir = dirname($target).'/';
            if ($modx->cacheManager->writeTree($dir)) {

                /* move attachment to correct dir */
                if (!@copy($source,$target)) {
                    $discuss->import->log('Could not copy: '.$source.' to '.$target);
                }
            } else {
                $discuss->import->log('Could not make attachment directory: '.$dir);
            }
        } else {
            $discuss->import->log('Could not find attachment: '.$source);
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

exit ();
@session_write_close();
die();

/**
 * disBoard - smf_boards
 * disCategory - smf_categories
 * disPost - smf_messages (smf_topics?)
 * disPostAttachment - smf_attachments
 * modUserGroup/disUserGroupProfile - smf_membergroups
 * disModerator - smf_moderators
 * disUser/modUser - smf_members
 */