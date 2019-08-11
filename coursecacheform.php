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

/**
 * enter course to clear cache
 *
 * @package    tool
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once $CFG->libdir.'/formslib.php';

class tool_coursecache_form extends moodleform {
    function definition (){
        global $CFG, $USER;

        $mform =& $this->_form;

        $mform->addElement('static', 'settingsheader', 'Enter course id that you wish to reset cache for');
        $mform->setType('settingsheader', PARAM_TEXT);

        $mform->addElement('text', 'coursetoclear');
        $mform->setType('coursetoclear', PARAM_INT);

        $this->add_action_buttons(false, 'clear cache');
    }
    //Custom validation should be added here
    public function validation($data, $files = null) {
        global $DB;
        $errors = array();

        $courseid = $data['coursetoclear'];
        if (!is_int($courseid) || $courseid < 1) {
            $error = "Not a valid course id: $courseid";
            $errors['coursetoclear'] = $error;
            return $errors;
        }
        $course = $DB->get_record('course', ['id' => $courseid]);

        if ($course) {
            $this->course = $course;
            return $errors;
        }

        $error = "Tried to find course with id $courseid but it doesn't exist";
        $errors['coursetoclear'] = $error;
        return $errors;
    }
}

