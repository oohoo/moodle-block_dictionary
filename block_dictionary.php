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

/**
 * Class dictionary for the creation of the block
 */
class block_dictionary extends block_list
{

    /**
     * Init the block 
     */
    function init()
    {
        $this->title = get_string('dictionary', 'block_dictionary');
    }

    /**
     * Specify if the block allows multiple instances in the same page
     * @return boolean Always false
     */
    function instance_allow_multiple()
    {
        return false;
    }

    /**
     * Return the content for the block
     * @global stdClass  $CFG
     * @global stdClass $USER
     * @global stdClass $COURSE
     * @global moodle_database $DB
     * @global moodle_page $PAGE
     * @return string The content in HTML
     */
    function get_content()
    {
        global $CFG, $USER, $COURSE, $DB, $PAGE;
        $PAGE->requires->js('/filter/dictionary/dictionary.js', true);
        $usedictionary = $DB->get_record("block_dictionary", array("courseid" => $COURSE->id));

        //If no record returned create an empty one
        if ($usedictionary == null)
        {
            $usedictionary = new stdClass();
            $usedictionary->id = 0;
        }

        if (!$usedictionary->id > 0)
        {
            $dictionaryname = get_string('nodictionary', 'block_dictionary');
        }
        else
        {
            if ($CFG->filter_dictionary_uri == $usedictionary->dictionary)
            {
                $dictionaryname = $CFG->filter_dictionary_name;
            }
            elseif ($CFG->filter_dictionary_uri1 == $usedictionary->dictionary)
            {
                $dictionaryname = $CFG->filter_dictionary_name1;
            }
            elseif ($CFG->filter_dictionary_uri2 == $usedictionary->dictionary)
            {
                $dictionaryname = $CFG->filter_dictionary_name2;
            }
            elseif ($CFG->filter_dictionary_uri3 == $usedictionary->dictionary)
            {
                $dictionaryname = $CFG->filter_dictionary_name3;
            }
            elseif ($CFG->filter_dictionary_uri4 == $usedictionary->dictionary)
            {
                $dictionaryname = $CFG->filter_dictionary_name4;
            }
            elseif ($CFG->filter_dictionary_uri5 == $usedictionary->dictionary)
            {
                $dictionaryname = $CFG->filter_dictionary_name5;
            }
            elseif ($CFG->filter_dictionary_uri6 == $usedictionary->dictionary)
            {
                $dictionaryname = $CFG->filter_dictionary_name6;
            }
            elseif ($CFG->filter_dictionary_uri7 == $usedictionary->dictionary)
            {
                $dictionaryname = $CFG->filter_dictionary_name7;
            }
            elseif ($CFG->filter_dictionary_uri8 == $usedictionary->dictionary)
            {
                $dictionaryname = $CFG->filter_dictionary_name8;
            }
            else
            {
                $dictionaryname = get_string('unknown_dictionary', 'block_dictionary');
            }
        }
        $context = get_context_instance(CONTEXT_COURSE, $COURSE->id);
        if (has_capability('moodle/course:update', $context))
        {
            if ($this->content !== NULL)
            {
                return $this->content;
            }

            $this->content = new stdClass;
            $this->content->footer = '';
            $this->content->items = array();
            $this->content->icons = array();

            /// Display dictionary used
            $this->content->items[] = get_string('selecteddictionary', 'block_dictionary') . '<br>' . $dictionaryname;



            /// link to add dictionary
            if (!$usedictionary->id > 0)
            {
                $this->content->items[] = "<a href=\"$CFG->wwwroot/blocks/dictionary/add.php?id=" . $COURSE->id . "\">" . get_string('add', 'block_dictionary') . '</a>';
            }
            else
            {
                $this->content->items[] = "<a href=\"$CFG->wwwroot/blocks/dictionary/edit.php?id=" . $usedictionary->id . "\">" . get_string('edit', 'block_dictionary') . '</a>';
            }
			
			//Link to documentation
			$this->content->items[] = "<a href=\"https://oohoo.biz/index.php/download_file/175/215/\">".get_string('documentation', 'block_dictionary') . "</a>";
        }
        else
        {

            $this->content = new stdClass;
            $this->content->footer = '';
            $this->content->items = array();

            /// Display dictionary used
            $this->content->items[] = '<center>' . get_string('activated', 'block_dictionary') . '<br><b>' . $dictionaryname . '</b>';
            $this->content->items[] = '<p><font size=".1em">' . get_string('instructions', 'block_dictionary') . '</font></p></center>';
        }


        return $this->content;
    }

    /**
     * Events when the block is removed
     * @global stdClass $CFG
     * @global stdClass $COURSE
     * @global moodle_database $DB
     * @return boolean Return true if the deletion was successfully 
     */
    function instance_delete()
    {
        global $CFG, $COURSE, $DB;
        return $DB->delete_records('block_dictionary', array('courseid' => $COURSE->id));
    }
    
        /**
     * Set the applicable formats for this block to all
     * @return array
     */
    function applicable_formats() {
        global $COURSE;
        if (has_capability('moodle/site:config', context_system::instance())) {
            return array('all' => true);
        } else {
            
            if (has_capability('moodle/course:manageactivities', context_course::instance($COURSE->id) )) {
                return array('my'=>true , 'course-view' => true, 'mod' => true, 'tag'=> true);
            }
            
            return false;
        }
    }

}
