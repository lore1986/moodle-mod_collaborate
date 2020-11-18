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

class adhoc_namechange extends \core\task\adhoc_task {

    public function get_name() {
        // Shown in admin screens
        return get_string('namechangeall', 'mod_collaborate');

    }

    public function execute(){
        $trace = new \text_progress_trace();
        $cd =  $this->get_custom_data();;
            collaborate_do_adhoc_task($trace, $cd);
    }
}
