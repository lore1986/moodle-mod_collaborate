<?php
/**
 * Form for student submissions.
 *
 * @package   mod_collaborate
 * @copyright 2018 Richard Jones https://richardnz.net
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace mod_collaborate\local;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/formslib.php');
require_once($CFG->libdir . '/filelib.php');

class grading_form extends \moodleform {
    public function definition() {
        global $DB;
        $mform = $this->_form;

        // grades available.
        $grades = array();
        for ($m = 0; $m <= 100; $m++) {
            $grades[$m] = 'Points: ' . $m;
        }
        $mform->addElement('select', 'grade', get_string('selectgrade', 'mod_collaborate'), $grades);
        
        $mform->addElement('hidden', 'cid', $this->_customdata['cid']);
        $mform->addElement('hidden', 'sid', $this->_customdata['sid']);
        
        $mform->setType('cid', PARAM_INT);
        $mform->setType('sid', PARAM_INT);

        $this->add_action_buttons(false, get_string('submissionsave', 'mod_collaborate'));
    }
}

