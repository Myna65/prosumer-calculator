<?php
/*
Plugin Name: Prosumer calculator
Plugin URI:  https://github.com/Myna65/prosumer-calculator
Description: Prosumer tax calculator in Belgium
Version:     0.1
Author:      Nathan Meynaert
Author URI:  https://github.com/Myna65
License:     AGPL-3.0
License URI: https://www.gnu.org/licenses/agpl-3.0.html
Text Domain: prosumer_calculator
Domain Path: /languages

Prosumer calculator is free software: you can redistribute it and/or modify
it under the terms of the GNU Affero General Public License as
published by the Free Software Foundation, either version 3 of the
License, or any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

require_once(__DIR__ . '/vendor/autoload.php');

new \Myna65\ProsumerCalculator\Plugin(__FILE__);