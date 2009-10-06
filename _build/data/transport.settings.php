<?php
/**
 * Loads system settings
 *
 * @package discuss
 * @subpackage build
 */
$settings = array();

$settings['discuss.bbcode_enabled']= $modx->newObject('modSystemSetting');
$settings['discuss.bbcode_enabled']->fromArray(array(
    'key' => 'discuss.bbcode_enabled',
    'value' => true,
    'xtype' => 'textfield',
    'namespace' => 'discuss',
    'area' => 'Posts',
),'',true,true);

$settings['discuss.maximum_post_size']= $modx->newObject('modSystemSetting');
$settings['discuss.maximum_post_size']->fromArray(array(
    'key' => 'discuss.maximum_post_size',
    'value' => '30000',
    'xtype' => 'textfield',
    'namespace' => 'discuss',
    'area' => 'Posts',
),'',true,true);

$settings['discuss.max_post_depth']= $modx->newObject('modSystemSetting');
$settings['discuss.max_post_depth']->fromArray(array(
    'key' => 'discuss.max_post_depth',
    'value' => '3',
    'xtype' => 'textfield',
    'namespace' => 'discuss',
    'area' => 'Posts',
),'',true,true);

$settings['discuss.courtesy_edit_wait']= $modx->newObject('modSystemSetting');
$settings['discuss.courtesy_edit_wait']->fromArray(array(
    'key' => 'discuss.courtesy_edit_wait',
    'value' => '60',
    'xtype' => 'textfield',
    'namespace' => 'discuss',
    'area' => 'Posts',
),'',true,true);


$settings['discuss.forum_title']= $modx->newObject('modSystemSetting');
$settings['discuss.forum_title']->fromArray(array(
    'key' => 'discuss.forum_title',
    'value' => 'My Forums',
    'xtype' => 'textfield',
    'namespace' => 'discuss',
    'area' => 'General',
),'',true,true);

$settings['discuss.admin_email']= $modx->newObject('modSystemSetting');
$settings['discuss.admin_email']->fromArray(array(
    'key' => 'discuss.admin_email',
    'value' => 'forums@mydomain.com',
    'xtype' => 'textfield',
    'namespace' => 'discuss',
    'area' => 'Administration',
),'',true,true);

$settings['discuss.date_format']= $modx->newObject('modSystemSetting');
$settings['discuss.date_format']->fromArray(array(
    'key' => 'discuss.date_format',
    'value' => '%e-%d-%Y, %I:%M %p',
    'xtype' => 'textfield',
    'namespace' => 'discuss',
    'area' => 'Administration',
),'',true,true);

$settings['discuss.allow_guests']= $modx->newObject('modSystemSetting');
$settings['discuss.allow_guests']->fromArray(array(
    'key' => 'discuss.allow_guests',
    'value' => true,
    'xtype' => 'combo-boolean',
    'namespace' => 'discuss',
    'area' => 'General',
),'',true,true);


$settings['discuss.allow_custom_titles']= $modx->newObject('modSystemSetting');
$settings['discuss.allow_custom_titles']->fromArray(array(
    'key' => 'discuss.allow_custom_titles',
    'value' => true,
    'xtype' => 'combo-boolean',
    'namespace' => 'discuss',
    'area' => 'User Profiles',
),'',true,true);

$settings['discuss.max_signature_length']= $modx->newObject('modSystemSetting');
$settings['discuss.max_signature_length']->fromArray(array(
    'key' => 'discuss.max_signature_length',
    'value' => '2000',
    'xtype' => 'textfield',
    'namespace' => 'discuss',
    'area' => 'User Profiles',
),'',true,true);


$settings['discuss.stats_enabled']= $modx->newObject('modSystemSetting');
$settings['discuss.stats_enabled']->fromArray(array(
    'key' => 'discuss.stats_enabled',
    'value' => true,
    'xtype' => 'combo-boolean',
    'namespace' => 'discuss',
    'area' => 'Administration',
),'',true,true);


$settings['discuss.show_whos_online']= $modx->newObject('modSystemSetting');
$settings['discuss.show_whos_online']->fromArray(array(
    'key' => 'discuss.show_whos_online',
    'value' => true,
    'xtype' => 'combo-boolean',
    'namespace' => 'discuss',
    'area' => 'General',
),'',true,true);


$settings['discuss.user_active_threshold']= $modx->newObject('modSystemSetting');
$settings['discuss.user_active_threshold']->fromArray(array(
    'key' => 'discuss.user_active_threshold',
    'value' => 40,
    'xtype' => 'textfield',
    'namespace' => 'discuss',
    'area' => 'General',
),'',true,true);


$settings['discuss.num_recent_posts']= $modx->newObject('modSystemSetting');
$settings['discuss.num_recent_posts']->fromArray(array(
    'key' => 'discuss.',
    'value' => 10,
    'xtype' => 'textfield',
    'namespace' => 'discuss',
    'area' => 'General',
),'',true,true);


$settings['discuss.threads_per_page']= $modx->newObject('modSystemSetting');
$settings['discuss.threads_per_page']->fromArray(array(
    'key' => 'discuss.threads_per_page',
    'value' => 20,
    'xtype' => 'textfield',
    'namespace' => 'discuss',
    'area' => 'General',
),'',true,true);


$settings['discuss.hot_thread_threshold']= $modx->newObject('modSystemSetting');
$settings['discuss.hot_thread_threshold']->fromArray(array(
    'key' => 'discuss.hot_thread_threshold',
    'value' => 10,
    'xtype' => 'textfield',
    'namespace' => 'discuss',
    'area' => 'General',
),'',true,true);


$settings['discuss.enable_sticky']= $modx->newObject('modSystemSetting');
$settings['discuss.enable_sticky']->fromArray(array(
    'key' => 'discuss.enable_sticky',
    'value' => true,
    'xtype' => 'combo-boolean',
    'namespace' => 'discuss',
    'area' => 'General',
),'',true,true);

$settings['discuss.enable_hot']= $modx->newObject('modSystemSetting');
$settings['discuss.enable_hot']->fromArray(array(
    'key' => 'discuss.enable_hot',
    'value' => true,
    'xtype' => 'combo-boolean',
    'namespace' => 'discuss',
    'area' => 'General',
),'',true,true);

/*
$settings['discuss.']= $modx->newObject('modSystemSetting');
$settings['discuss.']->fromArray(array(
    'key' => 'discuss.',
    'value' => '',
    'xtype' => 'textfield',
    'namespace' => 'discuss',
    'area' => '',
),'',true,true);
*/

return $settings;