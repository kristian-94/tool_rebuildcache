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
 * Link to unsupported db replace script.
 *
 * @package    tool
 * @subpackage clearcache
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($hassiteconfig) {

    $url = new moodle_url("/admin/tool/clearcache");
    $ADMIN->add('tools', new admin_externalpage('tool_clearcache', 'Clear course cache', $url));

    $settings = new admin_settingpage('tool_clearcache_settings', 'Clear caches');
    $settings->add(new admin_setting_configcheckbox('tool_clearcache/enable',
        'enable', 'do you want to enable this plugin',
        '1'));
    $ADMIN->add('tools', $settings);

}
