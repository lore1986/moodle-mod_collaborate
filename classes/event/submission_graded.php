<?php

namespace mod_collaborate\event;
defined('MOODLE_INTERNAL') || die();

class submission_graded extends \core\event\base {
    protected function init() {
        $this->data['objecttable'] = 'collaborate_submissions';
        $this->data['crud'] = 'u';
        $this->data['edulevel'] = self::LEVEL_PARTICIPATING;
    }

    public static function get_name() {
        return get_string('submission_graded', 'mod_collaborate');
    }
    /**
     * Returns non-localised event description with id's for admin use only.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' has
                made a submission with the id '$this->objectid'
                in the Collaborate activity with course
                module id '$this->contextinstanceid'.";
    }
}