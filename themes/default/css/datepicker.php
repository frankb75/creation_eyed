<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
.Zebra_DatePicker *,
.Zebra_DatePicker *:after,
.Zebra_DatePicker *:before  { -moz-box-sizing: content-box !important; -webkit-box-sizing: content-box !important; box-sizing: content-box !important }

.Zebra_DatePicker           { position: absolute; background: #373737; border: 3px solid #373737; z-index: 1200; font-family: Geneva, 'Lucida Sans', 'Lucida Grande', 'Lucida Sans Unicode', Verdana, sans-serif; font-size: 13px; top: 0 }

.Zebra_DatePicker *         { margin: 0; padding: 0; color: #666; background: transparent; border: none }

/* = GLOBALS
----------------------------------------------------------------------------------------------------------------------*/
.Zebra_DatePicker table                     { border-collapse: collapse; border-spacing: 0; width: auto; table-layout: auto; }

.Zebra_DatePicker td,
.Zebra_DatePicker th                        { text-align: center; padding: 5px 0 }

.Zebra_DatePicker td                        { cursor: pointer }

.Zebra_DatePicker .dp_daypicker,
.Zebra_DatePicker .dp_monthpicker,
.Zebra_DatePicker .dp_yearpicker            { margin-top: 3px }

.Zebra_DatePicker .dp_daypicker td,
.Zebra_DatePicker .dp_daypicker th,
.Zebra_DatePicker .dp_monthpicker td,
.Zebra_DatePicker .dp_yearpicker td         { width: 30px; border: 1px solid #BBB; background: #DEDEDE url('<?php echo themes_url('images/metallic/default-date.png'); ?>') repeat-x top; color: #666 }

.Zebra_DatePicker,
.Zebra_DatePicker .dp_header .dp_hover,
.Zebra_DatePicker .dp_footer .dp_hover      { -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px }

/* = VISIBLE/HIDDEN STATES (USE TRANSITIONS FOR EFFECTS)
----------------------------------------------------------------------------------------------------------------------*/
.Zebra_DatePicker.dp_visible               { visibility: visible; filter: alpha(opacity=100); -khtml-opacity: 1; -moz-opacity: 1; opacity: 1; transition: opacity 0.2s ease-in-out }
.Zebra_DatePicker.dp_hidden                { visibility: hidden; filter: alpha(opacity=0); -khtml-opacity: 0; -moz-opacity: 0; opacity: 0 }

/* = HEADER
----------------------------------------------------------------------------------------------------------------------*/
.Zebra_DatePicker .dp_header td             { color: #E0E0E0 }

.Zebra_DatePicker .dp_header .dp_previous,
.Zebra_DatePicker .dp_header .dp_next       { width: 30px }

.Zebra_DatePicker .dp_header .dp_caption    { font-weight: bold }
.Zebra_DatePicker .dp_header .dp_hover      { background: #67AABB; color: #FFF }

/* = DATEPICKER
----------------------------------------------------------------------------------------------------------------------*/
.Zebra_DatePicker td.dp_week_number,
.Zebra_DatePicker .dp_daypicker th              { background: #F1F1F1; font-size: 9px; padding-top: 7px }

.Zebra_DatePicker td.dp_weekend_disabled,
.Zebra_DatePicker td.dp_not_in_month,
.Zebra_DatePicker td.dp_not_in_month_selectable { background: #ECECEC url('<?php echo themes_url('images/metallic/disabled-date.png'); ?>'); color: #CCC; cursor: default }
.Zebra_DatePicker td.dp_not_in_month_selectable { cursor: pointer }

.Zebra_DatePicker td.dp_weekend                 { background: #DEDEDE url('<?php echo themes_url('images/metallic/default-date.png'); ?>') repeat-x top; color: #666 }

.Zebra_DatePicker td.dp_selected                { background: #E26262; color: #E0E0E0 !important }

/* = MONTHPICKER
----------------------------------------------------------------------------------------------------------------------*/
.Zebra_DatePicker .dp_monthpicker td    { width: 33% }

/* = YEARPICKER
----------------------------------------------------------------------------------------------------------------------*/
.Zebra_DatePicker .dp_yearpicker td     { width: 33% }

/* = FOOTER
----------------------------------------------------------------------------------------------------------------------*/
.Zebra_DatePicker .dp_footer            { margin-top: 3px }
.Zebra_DatePicker .dp_footer .dp_hover  { background: #67AABB; color: #FFF }

/* = SELECT CURRENT DAY
----------------------------------------------------------------------------------------------------------------------*/
.Zebra_DatePicker .dp_today { color: #E0E0E0; padding: 3px }

/* = CLEAR DATE
----------------------------------------------------------------------------------------------------------------------*/
.Zebra_DatePicker .dp_clear { color: #E0E0E0; padding: 3px }

/* = SOME MORE GLOBALS (MUST BE LAST IN ORDER TO OVERWRITE PRESIOUS PROPERTIES)
----------------------------------------------------------------------------------------------------------------------*/
.Zebra_DatePicker td.dp_current                 { color: #E26261 }
.Zebra_DatePicker td.dp_disabled_current        { color: #E38585 }
.Zebra_DatePicker td.dp_hover                   { background: #67AABB url('<?php echo themes_url('images/metallic/selected-date.png'); ?>') repeat-x top; color: #FFF }
.Zebra_DatePicker td.dp_disabled                { background: #ECECEC url('<?php echo themes_url('images/metallic/disabled-date.png'); ?>') repeat-x top; color: #DDD; cursor: default }

/* = ICON
----------------------------------------------------------------------------------------------------------------------*/
button.Zebra_DatePicker_Icon            { display: block; position: absolute; width: 16px; height: 16px; background: url('<?php echo themes_url('images/metallic/calendar.png'); ?>') no-repeat left top; text-indent: -9000px; border: none; cursor: pointer; padding: 0; line-height: 0; vertical-align: top }
button.Zebra_DatePicker_Icon_Disabled   { background-image: url('<?php echo themes_url('images/metallic/calendar-disabled.png'); ?>') }

/* don't set vertical margins! */
button.Zebra_DatePicker_Icon            { margin: 0 0 0 3px }
button.Zebra_DatePicker_Icon_Inside     { margin: 0 3px 0 0 }