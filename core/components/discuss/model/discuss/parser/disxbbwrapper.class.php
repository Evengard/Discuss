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
 * @subpackage parser
 */
require_once dirname(__FILE__).'/disparser.class.php';
require_once dirname(__FILE__).'/xbb/bbcode.lib.php';

/**
 * @package discuss
 * @subpackage parser
 */
class disXbbWrapper extends disParser {
    /**
     * Parse BBCode in post and return proper HTML. Supports SMF/Vanilla formats.
     *
     * @param string $message The string to parse
     * @param mixed $allowedTags
     * @return string The parsed string with HTML instead of BBCode, and all code stripped
     */
    public function parse($message, array $allowedTags = array()) {
        /* Assuming all tags allowed if not an array or the array is empty */
        if (!is_array($allowedTags) || count($allowedTags) == 0) {
            $allowedTags = null;
        }
        $this->allowedTags = $allowedTags;

        /* Initialize xBB and process */
        $parser = new bbcode($message, $this->allowedTags);
        $message = $parser->get_html();

        /* Escape all MODX tags */
        $message = str_replace(array('[',']'),array('&#91;','&#93;'),$message);
        return $message;
    }
}
