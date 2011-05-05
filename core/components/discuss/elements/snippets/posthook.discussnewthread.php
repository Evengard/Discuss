<?php
/**
 * Post a reply to a post
 *
 * @package discuss
 */
$discuss =& $modx->discuss;
$modx->lexicon->load('discuss:post');
$fields = $hook->getValues();
unset($fields[$submitVar]);

if (empty($fields['board'])) return $modx->error->failure($modx->lexicon('discuss.post_err_ns'));
$board = $modx->getObject('disBoard',$fields['board']);
if ($board == null) return false;

/* first check attachments for validity */
$attachments = array();
if (!empty($_FILES) && $_FILES['attachment1']['error'] == 0) {
    $result = $discuss->hooks->load('post/attachment/verify',array(
        'attachments' => &$_FILES,
    ));
    if (!empty($result['errors'])) {
        $hook->addError('attachments',implode('<br />',$result['errors']));
    }
    $attachments = $result['attachments'];
}

/* if any errors, return */
if (!empty($hook->errors)) {
    return false;
}

/* validate post length */
$maxSize = (int)$modx->getOption('discuss.maximum_post_size',null,30000);
if ($maxSize > 0) {
    if ($maxSize > strlen($fields['message'])) $maxSize = strlen($fields['message']);
    $fields['message'] = substr($fields['message'],0,$maxSize);
}

/* create post object and set fields */
$post = $modx->newObject('disPost');
$post->fromArray($fields);
$post->set('author',$discuss->user->get('id'));
$post->set('parent',0);
$post->set('board',$board->get('id'));
$post->set('thread',0);
$post->set('createdon',$discuss->now());
$post->set('ip',$discuss->getIp());

/* fire before post save event */
$rs = $modx->invokeEvent('OnDiscussBeforePostSave',array(
    'post' => &$post,
    'board' => &$board,
    'mode' => 'new',
));
$canSave = $discuss->getEventResult($rs);
if (!empty($canSave)) {
    $hook->addError('title',$modx->error->failure($canSave));
    return false;
}

/* save post */
if (!$post->save()) {
    $modx->log(modX::LOG_LEVEL_ERROR,'[Discuss] Could not create new thread: '.print_r($post->toArray(),true));
    $hook->addError('title',$modx->lexicon('discuss.post_err_create'));
    return false;
}

/* upload attachments */
foreach ($attachments as $file) {
    $attachment = $modx->newObject('disPostAttachment');
    $attachment->set('post',$post->get('id'));
    $attachment->set('board',$post->get('board'));
    $attachment->set('filename',$file['name']);
    $attachment->set('filesize',$file['size']);

    if ($attachment->upload($file)) {
        $attachment->save();
    } else {
        $modx->log(modX::LOG_LEVEL_ERROR,'[Discuss] '.$modx->lexicon('attachment_err_upload',array(
            'error' => print_r($file,true),
        )));
    }
}

$discuss->user->checkForPostGroupAdvance();

if (!empty($fields['notify'])) {
    $thread = $post->getOne('Thread');
    if ($thread) {
        $thread->addSubscription($discuss->user->get('id'));
    }
}

/* send notifications */
$discuss->hooks->load('notifications/send',array(
    'board' => $board->get('id'),
    'thread' => $post->get('thread'),
    'post' => $post->get('id'),
    'title' => $post->get('title'),
    'subject' => $modx->getOption('discuss.notification_new_post_subject'),
    'tpl' => $modx->getOption('discuss.notification_new_post_chunk'),
));

/* fire post save event */
$modx->invokeEvent('OnDiscussPostSave',array(
    'post' => &$post,
    'board' => &$board,
    'mode' => 'new',
));

$url = $post->getUrl();
$modx->sendRedirect($url);
return true;