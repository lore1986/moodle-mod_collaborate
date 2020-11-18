<?php

namespace mod_collaborate\output;

use renderable;
use renderer_base;
use templatable;
use stdClass;
use context_module;

/**
 * Create a new grading form page.
 */

class grading implements renderable, templatable {

    protected $submission;
    protected $context;
    protected $sid;

    public function __construct($submission, $cmid, $sid) {

        $this->submission = $submission;
        $this->context = context_module::instance($cmid);
        $this->sid = $sid;
    }
    /**
     * Export this data so it can be used as the context for a mustache template.
     *
     * @param renderer_base $output
     * @return stdClass
     */
    public function export_for_template(renderer_base $output) {

        $this->submission->pageheader =  get_string('gradingheader', 'mod_collaborate');

        // Submission.
        $content = file_rewrite_pluginfile_urls($this->submission->submission, 'pluginfile.php',
                $this->context->id,'mod_collaborate', 'submission', $this->sid);

        // Format submission.
        $formatoptions = new stdClass;
        $formatoptions->noclean = true;
        $formatoptions->overflowdiv = true;
        $formatoptions->context = $this->context;
        $format = FORMAT_HTML;

        $this->submission->submission = format_text($content, $format, $formatoptions);

        return $this->submission;
    }
}