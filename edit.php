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
global $CFG, $COURSE, $DB, $PAGE, $OUTPUT; 
require_once('../../config.php');
require_once($CFG->libdir . '/blocklib.php');

$id = required_param('id', PARAM_INT);  // course ID
$instanceid = optional_param('instanceid', 0, PARAM_INT);
$action = optional_param('action', '', PARAM_ALPHA);

$modrecord = $DB->get_record('block_dictionary', array('id' => $id));
$courseid = $modrecord->courseid;

if (!$course = $DB->get_record('course', array('id' => $courseid)))
{
    error('Course ID was incorrect');
}

require_login($course->id);
$context = get_context_instance(CONTEXT_COURSE, $courseid);


/// This block of code ensures that Quickmail will run 
///     whether it is in the course or not


if ($form = data_submitted())
{   // data was submitted to be mailed
    confirm_sesskey();

    $courseid = $_REQUEST['courseid'];

    if (!empty($form->cancel))
    {
        // cancel button was hit...
        redirect("$CFG->wwwroot/course/view.php?id=" . $courseid);
    }

    // prepare an object for the insert_record function
    $log = new stdClass;
    $log->id = $id;
    $log->courseid = $courseid;
    $log->dictionary = $_REQUEST['dictionary'];
    $log->popup = optional_param('popup', 0, PARAM_INT);

    if (!$DB->update_record('block_dictionary', $log))
    {
        error('No dictionary selected.');
    }
    redirect("$CFG->wwwroot/course/view.php?id=" . $courseid);
}

$usedictionary = $DB->get_record("block_dictionary", array("id" => $id));
$PAGE->set_title(get_string('select', 'block_dictionary'));
$PAGE->set_url('/blocks/dictionary/edit.php', array('id' => $id));
echo $OUTPUT->header();

echo $OUTPUT->box_start();
?>
<form name="theform" method="post" action="edit.php">
    <table align="center">
        <tr>
            <td>

                <input type="hidden" name="sesskey" value="<?php echo sesskey(); ?>" />
                <input type="hidden" name="instanceid" value="<?php echo $instanceid; ?>" />
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <input type="hidden" name="courseid" value="<?php echo $usedictionary->courseid ?>">
                <select name="dictionary" id="dictionary">
                    <option value="" <?php
if (empty($usedictionary->dictionary))
{
    echo 'selected';
}
?> ><?php echo get_string('select', 'block_dictionary') ?>
                    </option>
                    <?php if ($CFG->filter_dictionary_uri != '')
                    { ?>
                        <option value="<?php echo $CFG->filter_dictionary_uri; ?>"
                        <?php
                        if ($CFG->filter_dictionary_uri == $usedictionary->dictionary)
                        {
                            echo 'selected';
                        }
                        ?>><?php echo $CFG->filter_dictionary_name; ?>
                        </option>
                    <?php }if ($CFG->filter_dictionary_uri1 != '')
                    { ?>
                        <option value="<?php echo $CFG->filter_dictionary_uri1; ?>"
                        <?php
                        if ($CFG->filter_dictionary_uri1 == $usedictionary->dictionary)
                        {
                            echo 'selected';
                        }
                        ?>>
                        <?php echo $CFG->filter_dictionary_name1; ?>
                        </option>
                            <?php }if ($CFG->filter_dictionary_uri2 != '')
                            { ?>
                        <option value="<?php echo $CFG->filter_dictionary_uri2; ?>"
                        <?php
                        if ($CFG->filter_dictionary_uri2 == $usedictionary->dictionary)
                        {
                            echo 'selected';
                        }
                        ?>>
                        <?php echo $CFG->filter_dictionary_name2; ?>
                        </option>
                    <?php }if ($CFG->filter_dictionary_uri3 != '')
                    { ?>
                        <option value="<?php echo $CFG->filter_dictionary_uri3; ?>"
                        <?php
                        if ($CFG->filter_dictionary_uri3 == $usedictionary->dictionary)
                        {
                            echo 'selected';
                        }
                        ?>>
                        <?php echo $CFG->filter_dictionary_name3; ?>
                        </option>
                    <?php }if ($CFG->filter_dictionary_uri4 != '')
                    { ?>
                        <option value="<?php echo $CFG->filter_dictionary_uri4; ?>"
                                <?php
                                if ($CFG->filter_dictionary_uri4 == $usedictionary->dictionary)
                                {
                                    echo 'selected';
                                }
                                ?>><?php echo $CFG->filter_dictionary_name4; ?>
                        </option>
                    <?php }if ($CFG->filter_dictionary_uri5 != '')
                    { ?>
                        <option value="<?php echo $CFG->filter_dictionary_uri5; ?>"
    <?php
    if ($CFG->filter_dictionary_uri5 == $usedictionary->dictionary)
    {
        echo 'selected';
    }
    ?>><?php echo $CFG->filter_dictionary_name5; ?>
                        </option>
<?php }if ($CFG->filter_dictionary_uri6 != '')
{ ?>
                        <option value="<?php echo $CFG->filter_dictionary_uri6; ?>"
    <?php
    if ($CFG->filter_dictionary_uri6 == $usedictionary->dictionary)
    {
        echo 'selected';
    }
    ?>><?php echo $CFG->filter_dictionary_name6; ?>
                        </option>
<?php }if ($CFG->filter_dictionary_uri7 != '')
{ ?>
                        <option value="<?php echo $CFG->filter_dictionary_uri7; ?>"
    <?php
    if ($CFG->filter_dictionary_uri7 == $usedictionary->dictionary)
    {
        echo 'selected';
    }
    ?>><?php echo $CFG->filter_dictionary_name7; ?>
                        </option>
<?php }if ($CFG->filter_dictionary_uri8 != '')
{ ?>
                        <option value="<?php echo $CFG->filter_dictionary_uri8; ?>"
    <?php
    if ($CFG->filter_dictionary_uri8 == $usedictionary->dictionary)
    {
        echo 'selected';
    }
    ?>><?php echo $CFG->filter_dictionary_name8; ?>
                        </option>
<?php }if ($CFG->filter_dictionary_uri9 != '')
{ ?>
                        <option value="<?php echo $CFG->filter_dictionary_uri9; ?>"
    <?php
    if ($CFG->filter_dictionary_uri9 == $usedictionary->dictionary)
    {
        echo 'selected';
    }
    ?>><?php echo $CFG->filter_dictionary_name9; ?>
                        </option>
<?php }if ($CFG->filter_dictionary_uri10 != '')
{ ?>
                        <option value="<?php echo $CFG->filter_dictionary_uri10; ?>"
    <?php
    if ($CFG->filter_dictionary_uri10 == $usedictionary->dictionary)
    {
        echo 'selected';
    }
    ?>><?php echo $CFG->filter_dictionary_name10; ?>
                        </option>
<?php }if ($CFG->filter_dictionary_uri11 != '')
{ ?>
                        <option value="<?php echo $CFG->filter_dictionary_uri11; ?>"
    <?php
    if ($CFG->filter_dictionary_uri11 == $usedictionary->dictionary)
    {
        echo 'selected';
    }
    ?>><?php echo $CFG->filter_dictionary_name11; ?>
                        </option>
<?php }if ($CFG->filter_dictionary_uri12 != '')
{ ?>
                        <option value="<?php echo $CFG->filter_dictionary_uri12; ?>"
    <?php
    if ($CFG->filter_dictionary_uri12 == $usedictionary->dictionary)
    {
        echo 'selected';
    }
    ?>><?php echo $CFG->filter_dictionary_name12; ?>
                        </option>
<?php } ?>
                </select><br>
                <input type="checkbox" name="popup" value="1" <?php echo $usedictionary->popup==1?'checked="checked"':''; ?>/><?php echo get_string("popup", "block_dictionary") ?><br>
                <input type="submit" name="Submit" value="<?php echo get_string("submit", "block_dictionary") ?>">
                <input type="submit" name="cancel" value="<?php print_string('cancel') ?>" />
            </td>
        </tr>
    </table>
</form>
<?php 
echo $OUTPUT->box_end();


echo $OUTPUT->footer($course);