<?php
/**
 * Class for handling a scheduled task.
 *
 * @package   mod_collaborate
 * @copyright 2020 Richard Jones https://richardnz.net
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace mod_collaborate\task;

defined('MOODLE_INTERNAL') || die();

/**
 * A scheduled task.
 *
 * @package    mod_collaborate
 * @since      Moodle 2.7
 * @copyright  2015 Flash Gordon http://www.flashgordon.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class scheduled_export extends \core\task\scheduled_task {

    public function get_name() {
        // Shown in admin screens
        return get_string('exportall', 'mod_collaborate');

    }
     /**
     *  Run all the tasks
     */
     public function execute() {
       \mod_collaborate\local\submissions::export_all_submissions();
    }
}
