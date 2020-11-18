<?php 
/**
 * Exports all submission reports for a particular Collaborate instance.
 *
 * @package    mod_collaborate
 * @copyright  2020 Richard Jones richardnz@outlook.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
use mod_collaborate\local\submissions;
use core\dataformat;
require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');

// The collaborate instance id.
$cid = required_param('cid', PARAM_INT);
$collaborate = $DB->get_record('collaborate', ['id' => $cid], '*', MUST_EXIST);
$courseid = $collaborate->course;
$cm = get_coursemodule_from_instance('collaborate', $cid, $courseid, false, MUST_EXIST);
$course = $DB->get_record('course', ['id' => $courseid], '*', MUST_EXIST);
$context = context_module::instance($cm->id);

// Check the user is logged on and can download submissions data.
require_login($course, true, $cm);
require_capability('mod/collaborate:exportsubmissions', $context);

// Get the data and set up an iterator for the pdf export.
$records = submissions::get_export_data($collaborate, $context);
$download_submissions = new ArrayObject($records);
$iterator = $download_submissions->getIterator();
$fields = submissions::get_export_headers();
$dataformat = 'pdf';
$filename = clean_filename('export_submissions' . time());
dataformat::download_data($filename, $dataformat, $fields, $iterator);

// We are actually only showing a dialog box.
echo $OUTPUT->download_dataformat_selector(get_string('download', 'admin'), 'reports.php');    