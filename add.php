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
require_once('../../config.php');
require_once($CFG->libdir . '/blocklib.php');
global $DB, $OUTPUT, $PAGE;
$id = required_param('id', PARAM_INT);  // course ID
$instanceid = optional_param('instanceid', 0, PARAM_INT);
$action = optional_param('action', '', PARAM_ALPHA);



if (!$course = $DB->get_record('course', array('id' => $id)))
{
    error('Course ID was incorrect');
}

require_login($course->id);
$context = get_context_instance(CONTEXT_COURSE, $course->id);



/// This block of code ensures that Quickmail will run 
///     whether it is in the course or not


if ($form = data_submitted())
{   // data was submitted to be mailed
    confirm_sesskey();

    if (!empty($form->cancel))
    {
        // cancel button was hit...
        redirect("$CFG->wwwroot/course/view.php?id=" . $id);
    }

    // prepare an object for the insert_record function
    $log = new stdClass;
    $log->courseid = $course->id;
    $log->dictionary = $_REQUEST['dictionary'];
    $log->popup = optional_param('popup', 0, PARAM_INT);

    if (!$DB->insert_record('block_dictionary', $log))
    {
        error('No dictionary selected.');
    }
    redirect("$CFG->wwwroot/course/view.php?id=" . $id);
}
$PAGE->set_title(get_string('select', 'block_dictionary'));
$PAGE->set_url('/blocks/dictionary/add.php', array('id' => $id));
echo $OUTPUT->header();

echo $OUTPUT->box_start();
echo '<form name="theform" method="post" action="add.php">' . "\n";
echo ' <table align="center">' . "\n";
echo '	<tr>' . "\n";
echo '		<td>' . "\n";

echo '<input type="hidden" name="sesskey" value="' . sesskey() . '" />' . "\n";
echo '<input type="hidden" name="instanceid" value="' . $instanceid . '" />' . "\n";

echo ' <input type="hidden" name="id" value="' . $id . '">' . "\n";
echo ' <select name="dictionary" id="dictionary">' . "\n";
echo '	<option value="" selected >' . get_string('select', 'block_dictionary') . '</option>' . "\n";
echo ($CFG->filter_dictionary_uri != '') ? '	<option value="' . $CFG->filter_dictionary_uri . '" >' . $CFG->filter_dictionary_name . '</option>' . "\n" : '';
echo ($CFG->filter_dictionary_uri1 != '') ? '      <option value="' . $CFG->filter_dictionary_uri1 . '">' . $CFG->filter_dictionary_name1 . '</option>' . "\n" : '';
echo ($CFG->filter_dictionary_uri2 != '') ? '      <option value="' . $CFG->filter_dictionary_uri2 . '">' . $CFG->filter_dictionary_name2 . '</option>' . "\n" : '';
echo ($CFG->filter_dictionary_uri3 != '') ? '      <option value="' . $CFG->filter_dictionary_uri3 . '">' . $CFG->filter_dictionary_name3 . '</option>' . "\n" : '';
echo ($CFG->filter_dictionary_uri4 != '') ? '      <option value="' . $CFG->filter_dictionary_uri4 . '">' . $CFG->filter_dictionary_name4 . '</option>' . "\n" : '';
echo ($CFG->filter_dictionary_uri5 != '') ? '	<option value="' . $CFG->filter_dictionary_uri5 . '">' . $CFG->filter_dictionary_name5 . '</option>' . "\n" : '';
echo ($CFG->filter_dictionary_uri6 != '') ? '	<option value="' . $CFG->filter_dictionary_uri6 . '">' . $CFG->filter_dictionary_name6 . '</option>' . "\n" : '';
echo ($CFG->filter_dictionary_uri7 != '') ? '	<option value="' . $CFG->filter_dictionary_uri7 . '">' . $CFG->filter_dictionary_name7 . '</option>' . "\n" : '';
echo ($CFG->filter_dictionary_uri8 != '') ? '	<option value="' . $CFG->filter_dictionary_uri8 . '">' . $CFG->filter_dictionary_name8 . '</option>' . "\n" : '';
echo ($CFG->filter_dictionary_uri9 != '') ? '	<option value="' . $CFG->filter_dictionary_uri9 . '">' . $CFG->filter_dictionary_name9 . '</option>' . "\n" : '';
echo ($CFG->filter_dictionary_uri10 != '') ? '	<option value="' . $CFG->filter_dictionary_uri10 . '">' . $CFG->filter_dictionary_name10 . '</option>' . "\n" : '';
echo ($CFG->filter_dictionary_uri11 != '') ? '	<option value="' . $CFG->filter_dictionary_uri11 . '">' . $CFG->filter_dictionary_name11 . '</option>' . "\n" : '';
echo ($CFG->filter_dictionary_uri12 != '') ? '	<option value="' . $CFG->filter_dictionary_uri12 . '">' . $CFG->filter_dictionary_name12 . '</option>' . "\n" : '';
echo '  </select><br>' . "\n";
echo ' <input type="checkbox" name="popup" value="1" /> ' . get_string("popup", "block_dictionary") . '<br>' . "\n";
echo ' <input type="submit" name="Submit" value="' . get_string("submit", "block_dictionary") . '">' . "\n";
echo ' <input type="submit" name="cancel" value="' . get_string('cancel') . '" />' . "\n";
echo '		</td>' . "\n";
echo '	</tr>' . "\n";
echo '</table>' . "\n";
echo '</form>' . "\n";
echo $OUTPUT->box_end();

echo $OUTPUT->footer();