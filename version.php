<?php

/**
 * *************************************************************************
 * *                           Pop-up Dictionary                          **
 * *************************************************************************
 * @package     block                                                     **
 * @subpackage  dictionary                                                **
 * @name        dictionary                                                **
 * @copyright   oohoo.biz                                                 **
 * @link        http://oohoo.biz                                          **
 * @author      Patrick Thibaudeau                                        **
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later  **
 * *************************************************************************
 * ************************************************************************ */
$plugin->version = 2012121000;
$plugin->requires = 2010112400;
$plugin->maturity = MATURITY_STABLE;
$plugin->release = '1.0.2 (Build: 2012121000)';
$plugin->component = 'block_dictionary';
$plugin->cron = 0;
$plugin->dependencies = array('filter_dictionary' => ANY_VERSION);