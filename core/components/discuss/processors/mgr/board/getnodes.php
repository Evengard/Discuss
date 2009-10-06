<?php
/**
 * @package discuss
 */

$curNode = !empty($_REQUEST['id']) ? $_REQUEST['id'] : 'root_0';
$curNode = explode('_',$curNode);
$type = $curNode[0];
$id = $curNode[1];


$nodes = array();


$parentFK = 'parent';
switch ($type) {
    /* get all boards in category - will progress to next step after
     * setting FK to category */
    case 'category':
        $where = array(
            'parent' => 0,
            'category' => $id,
        );
    /* get all subboards */
    case 'board':
        if (!isset($where)) {
            $where = array(
                'parent' => $id,
            );
        }
        $c = $modx->newQuery('disBoard');
        $c->where($where);
        $c->sortby('disBoard.rank','ASC');
        $boards = $modx->getCollection('disBoard',$c);

        foreach ($boards as $board) {
            $boardArray = $board->toArray();

            $boardArray['pk'] = $board->get('id');
            $boardArray['text'] = $board->get('name').' ('.$board->get('id').')';
            $boardArray['leaf'] = false;
            $boardArray['classKey'] = 'disBoard';

            $boardArray['menu'] = array('items' => array());
            $boardArray['menu']['items'][] = array(
                'text' => 'Edit Board',
                'handler' => 'function(itm,e) { this.updateBoard(itm,e); }',
            );
            $boardArray['menu']['items'][] = '-';
            $boardArray['menu']['items'][] = array(
                'text' => 'Create Board Here',
                'handler' => 'function(itm,e) { this.createBoard(itm,e); }',
            );
            $boardArray['menu']['items'][] = '-';
            $boardArray['menu']['items'][] = array(
                'text' => 'Remove Board',
                'handler' => 'function(itm,e) {this.removeBoard(itm,e); }',
            );

            unset($boardArray['id']);
            $boardArray['id'] = 'board_'.$board->get('id');
            $nodes[] = $boardArray;
        }

        break;
    /* get all categories */
    default:

        $c = $modx->newQuery('disCategory');
        $c->sortby('rank','ASC');
        $categories = $modx->getCollection('disCategory',$c);

        foreach ($categories as $category) {
            $categoryArray = $category->toArray();

            $categoryArray['pk'] = $category->get('id');
            $categoryArray['text'] = $category->get('name').' ('.$category->get('id').')';
            $categoryArray['leaf'] = false;
            $categoryArray['parent'] = 0;
            $categoryArray['category'] = $category->get('id');
            $categoryArray['classKey'] = 'disCategory';

            $categoryArray['menu'] = array('items' => array());
            $categoryArray['menu']['items'][] = array(
                'text' => 'Edit Category',
                'handler' => 'function(itm,e) { this.updateCategory(itm,e); }',
            );
            $categoryArray['menu']['items'][] = '-';
            $categoryArray['menu']['items'][] = array(
                'text' => 'Create Board Here',
                'handler' => 'function(itm,e) { this.createBoard(itm,e); }',
            );

            $categoryArray['menu']['items'][] = '-';
            $categoryArray['menu']['items'][] = array(
                'text' => 'Remove Category',
                'handler' => 'function(itm,e) { this.removeCategory(itm,e); }',
            );

            unset($categoryArray['id']);
            $categoryArray['id'] = 'category_'.$category->get('id');
            $nodes[] = $categoryArray;
        }
        break;
}



return $this->toJSON($nodes);
