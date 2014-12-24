<?php

/**
 * *************************************************************************
 * *                           Pop-up Dictionary                          **
 * *************************************************************************
 * @package     block                                                     **
 * @subpackage  dictionary                                                **
 * @name        dictionary                                                **
 * @copyright   oohoo.biz                                                 **
 * @link        http://oohoo.biz                                          **
 * @author      Patrick Thibaudeau                                        **
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later  **
 * *************************************************************************
 * ************************************************************************ */
defined( 'MOODLE_INTERNAL' ) || die();

function xmldb_block_dictionary_upgrade( $oldversion ) {
    global $DB;

    $dbman = $DB->get_manager(); // loads ddl manager and xmldb classes

    if ( $oldversion < 2012111500 ) {
        //Added new wikipedia languages
        //Added User guide link
        // block dictionary savepoint reached
        upgrade_block_savepoint( true, 2012111500, 'dictionary' );
    }
    if ( $oldversion < 2012111501 ) {

        //Added more dictionaries
        // block dictionary savepoint reached
        upgrade_block_savepoint( true, 2012111501, 'dictionary' );
    }

    if ( $oldversion < 2012112800 ) {
        // Correct a bug in the edit form
        // Add a popup checkbox to force popup in a real popup
        // Add param to the URLs to allow word to be placed in the middle instead of always at the end
        // Define field popup to be added to block_dictionary
        $table = new xmldb_table( 'block_dictionary' );
        $field = new xmldb_field( 'popup', XMLDB_TYPE_INTEGER, '1', null, XMLDB_NOTNULL, null, '0', 'dictionary' );

        // Conditionally launch add field popup
        if ( !$dbman->field_exists( $table, $field ) ) {
            $dbman->add_field( $table, $field );
        }

        // dictionary savepoint reached
        upgrade_block_savepoint( true, 2012112800, 'dictionary' );
    }

    if ( $oldversion < 2012121000 ) {
        //Update logo for Moodle 2.4
        // dictionary savepoint reached
        upgrade_block_savepoint( true, 2012121000, 'dictionary' );
    }

    if ( $oldversion < 2014040200 ) {
        //Update logo for Moodle 2.6
        // dictionary savepoint reached
        upgrade_block_savepoint( true, 2014040200, 'dictionary' );
    }

    if ( $oldversion < 2014122400 ) {


        //Update for Moodle 2.8
        // dictionary savepoint reached
        upgrade_block_savepoint( true, 2014122400, 'dictionary' );
    }

    return true;
}
