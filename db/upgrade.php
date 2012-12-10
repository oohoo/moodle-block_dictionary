<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * This file keeps track of upgrades to the syllabusadmin module
 *
 * Sometimes, changes between versions involve alterations to database
 * structures and other major things that may break installations. The upgrade
 * function in this file will attempt to perform all the necessary actions to
 * upgrade your older installation to the current version. If there's something
 * it cannot do itself, it will tell you what you need to do.  The commands in
 * here will all be database-neutral, using the functions defined in DLL libraries.
 *
 * @package    blocks
 * @subpackage scholarship
 * @copyright  2012 Patrick Thibaudeau http://oohoo.biz
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();

/**
 * Execute syllabusadmin upgrade from the given old version
 *
 * @param int $oldversion
 * @return bool
 */
function xmldb_block_dictionary_upgrade($oldversion)
{
    global $DB;

    $dbman = $DB->get_manager(); // loads ddl manager and xmldb classes



    if ($oldversion < 2012111500)
    {

        //Added new wikipedia languages
        //Added User guide link
        // block dictionary savepoint reached
        upgrade_block_savepoint(true, 2012111500, 'dictionary');
    }
    if ($oldversion < 2012111501)
    {

        //Added more dictionaries
        // block dictionary savepoint reached
        upgrade_block_savepoint(true, 2012111501, 'dictionary');
    }

    if ($oldversion < 2012112800)
    {
        // Correct a bug in the edit form
        // Add a popup checkbox to force popup in a real popup
        // Add param to the URLs to allow word to be placed in the middle instead of always at the end
        
        // Define field popup to be added to block_dictionary
        $table = new xmldb_table('block_dictionary');
        $field = new xmldb_field('popup', XMLDB_TYPE_INTEGER, '1', null, XMLDB_NOTNULL, null, '0', 'dictionary');

        // Conditionally launch add field popup
        if (!$dbman->field_exists($table, $field))
        {
            $dbman->add_field($table, $field);
        }

        // dictionary savepoint reached
        upgrade_block_savepoint(true, 2012112800, 'dictionary');
    }
    
    if ($oldversion < 2012121000)
    {
        //Update logo for Moodle 2.4
        
        // dictionary savepoint reached
        upgrade_block_savepoint(true, 2012121000, 'dictionary');
    }

    return true;
}
