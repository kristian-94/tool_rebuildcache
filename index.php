<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

require_once('../../../config.php');
require_once('coursecacheform.php');
require_once($CFG->libdir . '/classes/output/notification.php');
require_once($CFG->libdir . '/adminlib.php');

require_login(null, false);
require_capability('moodle/site:config', context_system::instance());
$url = new moodle_url('/admin/tool/clearcache/index.php');
$PAGE->set_url($url);
$PAGE->set_title('Clear cache');
$PAGE->set_heading('Clear cache');
admin_externalpage_setup('tool_clearcache');

$mform = new tool_coursecache_form();
//Form processing and displaying is done here
if ($mform->is_cancelled()) {
    //Handle form cancel operation, if cancel button is present on form
    // we don't have a cancel button
} else if ($fromform = $mform->get_data()) {
    //In this case you process validated data. $mform->get_data() returns data posted in form.

    $courseid = $fromform->coursetoclear;

    if (!$mform->is_validated()) {
        redirect($url, "Invalid data (you entered '$courseid') - please enter a valid course id", null, \core\output\notification::NOTIFY_ERROR);
    }

    rebuild_course_cache($courseid);
    $coursename = $mform->course->fullname;
    redirect($url, 'You successfully cleared the course cache of course: ' . $coursename, null, \core\output\notification::NOTIFY_SUCCESS);
} else {
    // this branch is executed if the form is submitted but the data doesn't validate and the form should be redisplayed
    // or on the first display of the form.

    echo $OUTPUT->header();

    //displays the form
    $mform->display();
}

echo $OUTPUT->footer();
