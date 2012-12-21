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
 * Get a threaded view of a post.
 *
 * @var Discuss $discuss
 * @var modX $modx
 * @var array $scriptProperties
 *
 * @package discuss
 * @subpackage hooks
 */
/**
 * get thread or root of post
 * @var disThread $thread
 */
$thread = $modx->getOption('thread',$scriptProperties,'');
if (empty($thread)) return false;

$limit = $modx->getOption('limit',$scriptProperties,(int)$modx->getOption('discuss.post_per_page',$scriptProperties, 10));
$start = intval(isset($_GET['page']) ? ($_GET['page'] - 1) * $limit : 0);

/* Verify the posts output type - Flat or Threaded */
$flat = $modx->getOption('flat',$scriptProperties,false);
$flat = true;
/* get default properties */
$tpl = $modx->getOption('postTpl',$scriptProperties,'post/disThreadPost');
$postAttachmentRowTpl = $modx->getOption('postAttachmentRowTpl',$scriptProperties,'post/disPostAttachment');

/* get posts */
$c = $modx->newQuery('disPost');
$c->innerJoin('disThread','Thread');
$c->where(array(
    'thread' => $thread->get('id'),
));
$cc = clone $c;
$total = $modx->getCount('disPost',$cc);
if ($flat) {
    $c->sortby($modx->getSelectColumns('disPost','disPost','',array('createdon')),'ASC');
    $c->limit($limit, $start);
} else {
    $c->sortby($modx->getSelectColumns('disPost','disPost','',array('rank')),'ASC');
}


if (!empty($scriptProperties['post'])) {
    if (!is_object($scriptProperties['post'])) {
        $post = $modx->getObject('disPost',$scriptProperties['post']);
    } else {
        $post =& $scriptProperties['post'];
    }
    if ($post) {
        $c->where(array(
            'disPost.createdon:>=' => $post->get('createdon'),
        ));
    }
}

$c->bindGraph('{"Author":{},"EditedBy":{}}');
$posts = $modx->getCollectionGraph('disPost','{"Author":{},"EditedBy":{}}',$c);

/* setup basic settings/permissions */
$dateFormat = $modx->getOption('discuss.date_format',null,'%b %d, %Y, %H:%M %p');
$allowCustomTitles = $modx->getOption('discuss.allow_custom_titles',null,true);
$globalCanRemovePost = $modx->hasPermission('discuss.pm_remove');
$globalCanReplyPost = $modx->hasPermission('discuss.pm_send');
$globalCanModifyPost = true;
$canViewAttachments = $modx->hasPermission('discuss.view_attachments');
$canTrackIp = $modx->hasPermission('discuss.track_ip');
$canViewEmails = $modx->hasPermission('discuss.view_emails');
$canViewProfiles = $modx->hasPermission('discuss.view_profiles');

/* iterate */
$plist = array();
$output = array();
$idx = 0;
/** @var disPost $post */
foreach ($posts as $post) {
    $postArray = $post->toArray();
    $postArray['url'] = $discuss->request->makeUrl('messages/view',array('thread' => $post->get('thread'))).'#dis-post-'.$post->get('id');
    $postArray['children'] = '';

    if (!empty($post->EditedBy)) {
        $postArray = array_merge($postArray,$post->EditedBy->toArray('editedby.'));
        unset($postArray['editedby.password'],$postArray['editedby.cachepwd']);
    }

    $post->renderAuthorMeta($postArray);

    $postArray['title'] = str_replace(array('[',']'),array('&#91;','&#93;'),$postArray['title']);

    $postArray['class'] = array('dis-post');
    if (!$flat) {
        /* set depth and check max post depth */
        $postArray['class'][] = 'dis-depth-'.$postArray['depth'];
        if ($postArray['depth'] > $modx->getOption('discuss.max_post_depth',null,3)) {
            /* Don't hide post if it exceed max depth, set its depth placeholder to max depth value instead */
            $postArray['depth'] = $modx->getOption('discuss.max_post_depth',null,3);
        }
    }

    /* Get stuff for quick reply */
    $postArray['content_raw'] = htmlentities($post->br2nl($discuss->convertMODXTags($post->get('message'))), ENT_QUOTES, 'UTF-8');
    $postArray['createdon_raw'] = strtotime($post->get('createdon'));
    /* format bbcode */
    $postArray['content'] = $post->getContent();

    /* check allowing of custom titles */
    if (!$allowCustomTitles) {
        $postArray['author.title'] = '';
    }


    /* load actions */
    $postArray['action_reply'] = '';
    $postArray['actions'] = array();
    if (!$thread->get('locked') && $discuss->user->isLoggedIn) {
        if ($post->canReply()) {
            $postArray['action_reply'] = $discuss->getChunk('disActionLink',array(
                'url' => $discuss->request->makeUrl('messages/reply',array('post' => $post->get('id'))),
                'text' => $modx->lexicon('discuss.reply_with_quote'),
                'class' => 'dis-post-reply',
                'id' => '',
                'attributes' => '',
            ));
            $postArray['action_quote'] = $discuss->getChunk('disActionLink',array(
                'url' => $discuss->request->makeUrl('messages/reply',array('post' => $post->get('id'),'quote' => 1)),
                'text' => $modx->lexicon('discuss.quote'),
                'class' => 'dis-post-quote',
                'id' => '',
                'attributes' => '',
            ));
        }

        if ($post->canModify()) {
            $postArray['action_modify'] = $discuss->getChunk('disActionLink',array(
                'url' => $discuss->request->makeUrl('messages/modify',array('post' => $post->get('id'))),
                'text' => $modx->lexicon('discuss.modify'),
                'class' => 'dis-post-modify',
                'id' => '',
                'attributes' => '',
            ));
        }

        if ($post->canRemove()) {
            $postArray['action_remove'] = $discuss->getChunk('disActionLink',array(
                'url' => $discuss->request->makeUrl('messages/remove_post',array('post' => $post->get('id'))),
                'text' => $modx->lexicon('discuss.remove'),
                'class' => 'dis-post-remove',
                'id' => '',
                'attributes' => '',
            ));
        }
    }

    /* order action buttons */
    $postArray['actions'] = $thread->aggregateThreadActionButtons($postArray);
    $postArray['actions'] = implode("\n",$postArray['actions']);
    
    /* get attachments */
    $postArray['attachments'] = '';
    if ($canViewAttachments) {
        $attachments = $post->getMany('Attachments');
        if (!empty($attachments)) {
            $postArray['attachments'] = array();
            /** @var disPostAttachment $attachment */
            foreach ($attachments as $attachment) {
                $attachmentArray = $attachment->toArray();
                $attachmentArray['filesize'] = $attachment->convert();
                $attachmentArray['url'] = $attachment->getUrl();
                $postArray['attachments'][] = $discuss->getChunk('post/disPostAttachment',$attachmentArray);
            }
            $postArray['attachments'] = implode("\n",$postArray['attachments']);
        }
    }

    $postArray['createdon'] = strftime($dateFormat,strtotime($postArray['createdon']));
    $postArray['class'] = implode(' ',$postArray['class']);
    $postArray['report_link'] = '';
    $postArray['ip'] = '';
    $postArray['idx'] = $idx+1;

    /* prepare thread view for derivative thread types */
    $postArray['answer_count'] = 0;
    $postArray['url_mark_as_answer'] = '';
    $postArray['class_key'] = $thread->get('class_key');
    $postArray = $thread->prepareThreadView($postArray);

    /* fire OnDiscussPostBeforeRender */
    $modx->invokeEvent('OnDiscussPostBeforeRender',array(
        'post' => &$post,
        'postArray' => &$postArray,
        'idx' => $idx+1,
        'tpl' => $tpl,
        'flat' => $flat,
    ));
    
    if ($flat) {
        $output[] = $discuss->getChunk($tpl,$postArray);
    } else {
        $plist[] = $postArray;
    }
    $idx++;
}
$response = array(
    'total' => $total,
    'start' => $start,
    'limit' => $limit,
);
if (empty($flat)) {
    /* parse posts via tree parser */
    $discuss->loadTreeParser();
    if (count($plist) > 0) {
        $output = $discuss->treeParser->parse($plist,'post/disThreadPost');
    }
} else {
    $output = implode("\n",$output);
}
$response['results'] = $output;//str_replace(array('[',']'),array('&#91;','&#93;'),$output);

/* mark as read */
$thread->read($discuss->user->get('id'));

return $response;
