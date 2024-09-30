<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Shipnick</title>



	<link href="vendor/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('newtheme/vendor/nouislider/nouislider.min.css')}}">
	<link rel="stylesheet" href="{{asset('newtheme/./vendor/swiper/css/swiper-bundle.min.css')}}">
	<!-- Style css -->
	<link href="{{asset('newtheme/css/style.css')}}" rel="stylesheet">


	<!-- <script type="text/javascript" src="daterangepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="daterangepicker.css" /> -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
		integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
		crossorigin="anonymous"></script>

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css"
		integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">




	<style>
		.daterangepicker {
			position: absolute;
			color: inherit;
			background-color: #fff;
			border-radius: 4px;
			border: 1px solid #ddd;
			width: 278px;
			max-width: none;
			padding: 0;
			margin-top: 7px;
			top: 100px;
			left: 20px;
			z-index: 3001;
			display: none;
			font-family: arial;
			font-size: 15px;
			line-height: 1em;
		}

		.daterangepicker:before,
		.daterangepicker:after {
			position: absolute;
			display: inline-block;
			border-bottom-color: rgba(0, 0, 0, 0.2);
			content: '';
		}

		.daterangepicker:before {
			top: -7px;
			border-right: 7px solid transparent;
			border-left: 7px solid transparent;
			border-bottom: 7px solid #ccc;
		}

		.daterangepicker:after {
			top: -6px;
			border-right: 6px solid transparent;
			border-bottom: 6px solid #fff;
			border-left: 6px solid transparent;
		}

		.daterangepicker.opensleft:before {
			right: 9px;
		}

		.daterangepicker.opensleft:after {
			right: 10px;
		}

		.daterangepicker.openscenter:before {
			left: 0;
			right: 0;
			width: 0;
			margin-left: auto;
			margin-right: auto;
		}

		.daterangepicker.openscenter:after {
			left: 0;
			right: 0;
			width: 0;
			margin-left: auto;
			margin-right: auto;
		}

		.daterangepicker.opensright:before {
			left: 9px;
		}

		.daterangepicker.opensright:after {
			left: 10px;
		}

		.daterangepicker.drop-up {
			margin-top: -7px;
		}

		.daterangepicker.drop-up:before {
			top: initial;
			bottom: -7px;
			border-bottom: initial;
			border-top: 7px solid #ccc;
		}

		.daterangepicker.drop-up:after {
			top: initial;
			bottom: -6px;
			border-bottom: initial;
			border-top: 6px solid #fff;
		}

		.daterangepicker.single .daterangepicker .ranges,
		.daterangepicker.single .drp-calendar {
			float: none;
		}

		.daterangepicker.single .drp-selected {
			display: none;
		}

		.daterangepicker.show-calendar .drp-calendar {
			display: block;
		}

		.daterangepicker.show-calendar .drp-buttons {
			display: block;
		}

		.daterangepicker.auto-apply .drp-buttons {
			display: none;
		}

		.daterangepicker .drp-calendar {
			display: none;
			max-width: 270px;
		}

		.daterangepicker .drp-calendar.left {
			padding: 8px 0 8px 8px;
		}

		.daterangepicker .drp-calendar.right {
			padding: 8px;
		}

		.daterangepicker .drp-calendar.single .calendar-table {
			border: none;
		}

		.daterangepicker .calendar-table .next span,
		.daterangepicker .calendar-table .prev span {
			color: #fff;
			border: solid black;
			border-width: 0 2px 2px 0;
			border-radius: 0;
			display: inline-block;
			padding: 3px;
		}

		.daterangepicker .calendar-table .next span {
			transform: rotate(-45deg);
			-webkit-transform: rotate(-45deg);
		}

		.daterangepicker .calendar-table .prev span {
			transform: rotate(135deg);
			-webkit-transform: rotate(135deg);
		}

		.daterangepicker .calendar-table th,
		.daterangepicker .calendar-table td {
			white-space: nowrap;
			text-align: center;
			vertical-align: middle;
			min-width: 32px;
			width: 32px;
			height: 24px;
			line-height: 24px;
			font-size: 12px;
			border-radius: 4px;
			border: 1px solid transparent;
			white-space: nowrap;
			cursor: pointer;
		}

		.daterangepicker .calendar-table {
			border: 1px solid #fff;
			border-radius: 4px;
			background-color: #fff;
		}

		.daterangepicker .calendar-table table {
			width: 100%;
			margin: 0;
			border-spacing: 0;
			border-collapse: collapse;
		}

		.daterangepicker td.available:hover,
		.daterangepicker th.available:hover {
			background-color: #eee;
			border-color: transparent;
			color: inherit;
		}

		.daterangepicker td.week,
		.daterangepicker th.week {
			font-size: 80%;
			color: #ccc;
		}

		.daterangepicker td.off,
		.daterangepicker td.off.in-range,
		.daterangepicker td.off.start-date,
		.daterangepicker td.off.end-date {
			background-color: #fff;
			border-color: transparent;
			color: #999;
		}

		.daterangepicker td.in-range {
			background-color: #ebf4f8;
			border-color: transparent;
			color: #000;
			border-radius: 0;
		}

		.daterangepicker td.start-date {
			border-radius: 4px 0 0 4px;
		}

		.daterangepicker td.end-date {
			border-radius: 0 4px 4px 0;
		}

		.daterangepicker td.start-date.end-date {
			border-radius: 4px;
		}

		.daterangepicker td.active,
		.daterangepicker td.active:hover {
			background-color: #357ebd;
			border-color: transparent;
			color: #fff;
		}

		.daterangepicker th.month {
			width: auto;
		}

		.daterangepicker td.disabled,
		.daterangepicker option.disabled {
			color: #999;
			cursor: not-allowed;
			text-decoration: line-through;
		}

		.daterangepicker select.monthselect,
		.daterangepicker select.yearselect {
			font-size: 12px;
			padding: 1px;
			height: auto;
			margin: 0;
			cursor: default;
		}

		.daterangepicker select.monthselect {
			margin-right: 2%;
			width: 56%;
		}

		.daterangepicker select.yearselect {
			width: 40%;
		}

		.daterangepicker select.hourselect,
		.daterangepicker select.minuteselect,
		.daterangepicker select.secondselect,
		.daterangepicker select.ampmselect {
			width: 50px;
			margin: 0 auto;
			background: #eee;
			border: 1px solid #eee;
			padding: 2px;
			outline: 0;
			font-size: 12px;
		}

		.daterangepicker .calendar-time {
			text-align: center;
			margin: 4px auto 0 auto;
			line-height: 30px;
			position: relative;
		}

		.daterangepicker .calendar-time select.disabled {
			color: #ccc;
			cursor: not-allowed;
		}

		.daterangepicker .drp-buttons {
			clear: both;
			text-align: right;
			padding: 8px;
			border-top: 1px solid #ddd;
			display: none;
			line-height: 12px;
			vertical-align: middle;
		}

		.daterangepicker .drp-selected {
			display: inline-block;
			font-size: 12px;
			padding-right: 8px;
		}

		.daterangepicker .drp-buttons .btn {
			margin-left: 8px;
			font-size: 12px;
			font-weight: bold;
			padding: 4px 8px;
		}

		.daterangepicker.show-ranges.single.rtl .drp-calendar.left {
			border-right: 1px solid #ddd;
		}

		.daterangepicker.show-ranges.single.ltr .drp-calendar.left {
			border-left: 1px solid #ddd;
		}

		.daterangepicker.show-ranges.rtl .drp-calendar.right {
			border-right: 1px solid #ddd;
		}

		.daterangepicker.show-ranges.ltr .drp-calendar.left {
			border-left: 1px solid #ddd;
		}

		.daterangepicker .ranges {
			float: none;
			text-align: left;
			margin: 0;
		}

		.daterangepicker.show-calendar .ranges {
			margin-top: 8px;
		}

		.daterangepicker .ranges ul {
			list-style: none;
			margin: 0 auto;
			padding: 0;
			width: 100%;
		}

		.daterangepicker .ranges li {
			font-size: 12px;
			padding: 8px 12px;
			cursor: pointer;
		}

		.daterangepicker .ranges li:hover {
			background-color: #eee;
		}

		.daterangepicker .ranges li.active {
			background-color: #08c;
			color: #fff;
		}

		/*  Larger Screen Styling */
		@media (min-width: 564px) {
			.daterangepicker {
				width: auto;
			}

			.daterangepicker .ranges ul {
				width: 140px;
			}

			.daterangepicker.single .ranges ul {
				width: 100%;
			}

			.daterangepicker.single .drp-calendar.left {
				clear: none;
			}

			.daterangepicker.single .ranges,
			.daterangepicker.single .drp-calendar {
				float: left;
			}

			.daterangepicker {
				direction: ltr;
				text-align: left;
			}

			.daterangepicker .drp-calendar.left {
				clear: left;
				margin-right: 0;
			}

			.daterangepicker .drp-calendar.left .calendar-table {
				border-right: none;
				border-top-right-radius: 0;
				border-bottom-right-radius: 0;
			}

			.daterangepicker .drp-calendar.right {
				margin-left: 0;
			}

			.daterangepicker .drp-calendar.right .calendar-table {
				border-left: none;
				border-top-left-radius: 0;
				border-bottom-left-radius: 0;
			}

			.daterangepicker .drp-calendar.left .calendar-table {
				padding-right: 8px;
			}

			.daterangepicker .ranges,
			.daterangepicker .drp-calendar {
				float: left;
			}
		}

		@media (min-width: 730px) {
			.daterangepicker .ranges {
				width: auto;
			}

			.daterangepicker .ranges {
				float: left;
			}

			.daterangepicker.rtl .ranges {
				float: right;
			}

			.daterangepicker .drp-calendar.left {
				clear: none !important;
			}
		}
	</style>
	<script>
		(function(root, factory) {
			if (typeof define === 'function' && define.amd) {
				// AMD. Make globaly available as well
				define(['moment', 'jquery'], function(moment, jquery) {
					if (!jquery.fn) jquery.fn = {}; // webpack server rendering
					if (typeof moment !== 'function' && moment.hasOwnProperty('default')) moment = moment['default']
					return factory(moment, jquery);
				});
			} else if (typeof module === 'object' && module.exports) {
				// Node / Browserify
				//isomorphic issue
				var jQuery = (typeof window != 'undefined') ? window.jQuery : undefined;
				if (!jQuery) {
					jQuery = require('jquery');
					if (!jQuery.fn) jQuery.fn = {};
				}
				var moment = (typeof window != 'undefined' && typeof window.moment != 'undefined') ? window.moment : require('moment');
				module.exports = factory(moment, jQuery);
			} else {
				// Browser globals
				root.daterangepicker = factory(root.moment, root.jQuery);
			}
		}(typeof window !== 'undefined' ? window : this, function(moment, $) {
			var DateRangePicker = function(element, options, cb) {

				//default settings for options
				this.parentEl = 'body';
				this.element = $(element);
				this.startDate = moment().startOf('day');
				this.endDate = moment().endOf('day');
				this.minDate = false;
				this.maxDate = false;
				this.maxSpan = false;
				this.autoApply = false;
				this.singleDatePicker = false;
				this.showDropdowns = false;
				this.minYear = moment().subtract(100, 'year').format('YYYY');
				this.maxYear = moment().add(100, 'year').format('YYYY');
				this.showWeekNumbers = false;
				this.showISOWeekNumbers = false;
				this.showCustomRangeLabel = true;
				this.timePicker = false;
				this.timePicker24Hour = false;
				this.timePickerIncrement = 1;
				this.timePickerSeconds = false;
				this.linkedCalendars = true;
				this.autoUpdateInput = true;
				this.alwaysShowCalendars = false;
				this.ranges = {};

				this.opens = 'right';
				if (this.element.hasClass('pull-right'))
					this.opens = 'left';

				this.drops = 'down';
				if (this.element.hasClass('dropup'))
					this.drops = 'up';

				this.buttonClasses = 'btn btn-sm';
				this.applyButtonClasses = 'btn-primary';
				this.cancelButtonClasses = 'btn-default';

				this.locale = {
					direction: 'ltr',
					format: moment.localeData().longDateFormat('L'),
					separator: ' - ',
					applyLabel: 'Apply',
					cancelLabel: 'Cancel',
					weekLabel: 'W',
					customRangeLabel: 'Custom Range',
					daysOfWeek: moment.weekdaysMin(),
					monthNames: moment.monthsShort(),
					firstDay: moment.localeData().firstDayOfWeek()
				};

				this.callback = function() {};

				//some state information
				this.isShowing = false;
				this.leftCalendar = {};
				this.rightCalendar = {};

				//custom options from user
				if (typeof options !== 'object' || options === null)
					options = {};

				//allow setting options with data attributes
				//data-api options will be overwritten with custom javascript options
				options = $.extend(this.element.data(), options);

				//html template for the picker UI
				if (typeof options.template !== 'string' && !(options.template instanceof $))
					options.template =
					'<div class="daterangepicker">' +
					'<div class="ranges"></div>' +
					'<div class="drp-calendar left">' +
					'<div class="calendar-table"></div>' +
					'<div class="calendar-time"></div>' +
					'</div>' +
					'<div class="drp-calendar right">' +
					'<div class="calendar-table"></div>' +
					'<div class="calendar-time"></div>' +
					'</div>' +
					'<div class="drp-buttons">' +
					'<span class="drp-selected"></span>' +
					'<button class="cancelBtn" type="button"></button>' +
					'<button class="applyBtn" disabled="disabled" type="button"></button> ' +
					'</div>' +
					'</div>';

				this.parentEl = (options.parentEl && $(options.parentEl).length) ? $(options.parentEl) : $(this.parentEl);
				this.container = $(options.template).appendTo(this.parentEl);

				//
				// handle all the possible options overriding defaults
				//

				if (typeof options.locale === 'object') {

					if (typeof options.locale.direction === 'string')
						this.locale.direction = options.locale.direction;

					if (typeof options.locale.format === 'string')
						this.locale.format = options.locale.format;

					if (typeof options.locale.separator === 'string')
						this.locale.separator = options.locale.separator;

					if (typeof options.locale.daysOfWeek === 'object')
						this.locale.daysOfWeek = options.locale.daysOfWeek.slice();

					if (typeof options.locale.monthNames === 'object')
						this.locale.monthNames = options.locale.monthNames.slice();

					if (typeof options.locale.firstDay === 'number')
						this.locale.firstDay = options.locale.firstDay;

					if (typeof options.locale.applyLabel === 'string')
						this.locale.applyLabel = options.locale.applyLabel;

					if (typeof options.locale.cancelLabel === 'string')
						this.locale.cancelLabel = options.locale.cancelLabel;

					if (typeof options.locale.weekLabel === 'string')
						this.locale.weekLabel = options.locale.weekLabel;

					if (typeof options.locale.customRangeLabel === 'string') {
						//Support unicode chars in the custom range name.
						var elem = document.createElement('textarea');
						elem.innerHTML = options.locale.customRangeLabel;
						var rangeHtml = elem.value;
						this.locale.customRangeLabel = rangeHtml;
					}
				}
				this.container.addClass(this.locale.direction);

				if (typeof options.startDate === 'string')
					this.startDate = moment(options.startDate, this.locale.format);

				if (typeof options.endDate === 'string')
					this.endDate = moment(options.endDate, this.locale.format);

				if (typeof options.minDate === 'string')
					this.minDate = moment(options.minDate, this.locale.format);

				if (typeof options.maxDate === 'string')
					this.maxDate = moment(options.maxDate, this.locale.format);

				if (typeof options.startDate === 'object')
					this.startDate = moment(options.startDate);

				if (typeof options.endDate === 'object')
					this.endDate = moment(options.endDate);

				if (typeof options.minDate === 'object')
					this.minDate = moment(options.minDate);

				if (typeof options.maxDate === 'object')
					this.maxDate = moment(options.maxDate);

				// sanity check for bad options
				if (this.minDate && this.startDate.isBefore(this.minDate))
					this.startDate = this.minDate.clone();

				// sanity check for bad options
				if (this.maxDate && this.endDate.isAfter(this.maxDate))
					this.endDate = this.maxDate.clone();

				if (typeof options.applyButtonClasses === 'string')
					this.applyButtonClasses = options.applyButtonClasses;

				if (typeof options.applyClass === 'string') //backwards compat
					this.applyButtonClasses = options.applyClass;

				if (typeof options.cancelButtonClasses === 'string')
					this.cancelButtonClasses = options.cancelButtonClasses;

				if (typeof options.cancelClass === 'string') //backwards compat
					this.cancelButtonClasses = options.cancelClass;

				if (typeof options.maxSpan === 'object')
					this.maxSpan = options.maxSpan;

				if (typeof options.dateLimit === 'object') //backwards compat
					this.maxSpan = options.dateLimit;

				if (typeof options.opens === 'string')
					this.opens = options.opens;

				if (typeof options.drops === 'string')
					this.drops = options.drops;

				if (typeof options.showWeekNumbers === 'boolean')
					this.showWeekNumbers = options.showWeekNumbers;

				if (typeof options.showISOWeekNumbers === 'boolean')
					this.showISOWeekNumbers = options.showISOWeekNumbers;

				if (typeof options.buttonClasses === 'string')
					this.buttonClasses = options.buttonClasses;

				if (typeof options.buttonClasses === 'object')
					this.buttonClasses = options.buttonClasses.join(' ');

				if (typeof options.showDropdowns === 'boolean')
					this.showDropdowns = options.showDropdowns;

				if (typeof options.minYear === 'number')
					this.minYear = options.minYear;

				if (typeof options.maxYear === 'number')
					this.maxYear = options.maxYear;

				if (typeof options.showCustomRangeLabel === 'boolean')
					this.showCustomRangeLabel = options.showCustomRangeLabel;

				if (typeof options.singleDatePicker === 'boolean') {
					this.singleDatePicker = options.singleDatePicker;
					if (this.singleDatePicker)
						this.endDate = this.startDate.clone();
				}

				if (typeof options.timePicker === 'boolean')
					this.timePicker = options.timePicker;

				if (typeof options.timePickerSeconds === 'boolean')
					this.timePickerSeconds = options.timePickerSeconds;

				if (typeof options.timePickerIncrement === 'number')
					this.timePickerIncrement = options.timePickerIncrement;

				if (typeof options.timePicker24Hour === 'boolean')
					this.timePicker24Hour = options.timePicker24Hour;

				if (typeof options.autoApply === 'boolean')
					this.autoApply = options.autoApply;

				if (typeof options.autoUpdateInput === 'boolean')
					this.autoUpdateInput = options.autoUpdateInput;

				if (typeof options.linkedCalendars === 'boolean')
					this.linkedCalendars = options.linkedCalendars;

				if (typeof options.isInvalidDate === 'function')
					this.isInvalidDate = options.isInvalidDate;

				if (typeof options.isCustomDate === 'function')
					this.isCustomDate = options.isCustomDate;

				if (typeof options.alwaysShowCalendars === 'boolean')
					this.alwaysShowCalendars = options.alwaysShowCalendars;

				// update day names order to firstDay
				if (this.locale.firstDay != 0) {
					var iterator = this.locale.firstDay;
					while (iterator > 0) {
						this.locale.daysOfWeek.push(this.locale.daysOfWeek.shift());
						iterator--;
					}
				}

				var start, end, range;

				//if no start/end dates set, check if an input element contains initial values
				if (typeof options.startDate === 'undefined' && typeof options.endDate === 'undefined') {
					if ($(this.element).is(':text')) {
						var val = $(this.element).val(),
							split = val.split(this.locale.separator);

						start = end = null;

						if (split.length == 2) {
							start = moment(split[0], this.locale.format);
							end = moment(split[1], this.locale.format);
						} else if (this.singleDatePicker && val !== "") {
							start = moment(val, this.locale.format);
							end = moment(val, this.locale.format);
						}
						if (start !== null && end !== null) {
							this.setStartDate(start);
							this.setEndDate(end);
						}
					}
				}

				if (typeof options.ranges === 'object') {
					for (range in options.ranges) {

						if (typeof options.ranges[range][0] === 'string')
							start = moment(options.ranges[range][0], this.locale.format);
						else
							start = moment(options.ranges[range][0]);

						if (typeof options.ranges[range][1] === 'string')
							end = moment(options.ranges[range][1], this.locale.format);
						else
							end = moment(options.ranges[range][1]);

						// If the start or end date exceed those allowed by the minDate or maxSpan
						// options, shorten the range to the allowable period.
						if (this.minDate && start.isBefore(this.minDate))
							start = this.minDate.clone();

						var maxDate = this.maxDate;
						if (this.maxSpan && maxDate && start.clone().add(this.maxSpan).isAfter(maxDate))
							maxDate = start.clone().add(this.maxSpan);
						if (maxDate && end.isAfter(maxDate))
							end = maxDate.clone();

						// If the end of the range is before the minimum or the start of the range is
						// after the maximum, don't display this range option at all.
						if ((this.minDate && end.isBefore(this.minDate, this.timepicker ? 'minute' : 'day')) ||
							(maxDate && start.isAfter(maxDate, this.timepicker ? 'minute' : 'day')))
							continue;

						//Support unicode chars in the range names.
						var elem = document.createElement('textarea');
						elem.innerHTML = range;
						var rangeHtml = elem.value;

						this.ranges[rangeHtml] = [start, end];
					}

					var list = '<ul>';
					for (range in this.ranges) {
						list += '<li data-range-key="' + range + '">' + range + '</li>';
					}
					if (this.showCustomRangeLabel) {
						list += '<li data-range-key="' + this.locale.customRangeLabel + '">' + this.locale.customRangeLabel + '</li>';
					}
					list += '</ul>';
					this.container.find('.ranges').prepend(list);
				}

				if (typeof cb === 'function') {
					this.callback = cb;
				}

				if (!this.timePicker) {
					this.startDate = this.startDate.startOf('day');
					this.endDate = this.endDate.endOf('day');
					this.container.find('.calendar-time').hide();
				}

				//can't be used together for now
				if (this.timePicker && this.autoApply)
					this.autoApply = false;

				if (this.autoApply) {
					this.container.addClass('auto-apply');
				}

				if (typeof options.ranges === 'object')
					this.container.addClass('show-ranges');

				if (this.singleDatePicker) {
					this.container.addClass('single');
					this.container.find('.drp-calendar.left').addClass('single');
					this.container.find('.drp-calendar.left').show();
					this.container.find('.drp-calendar.right').hide();
					if (!this.timePicker && this.autoApply) {
						this.container.addClass('auto-apply');
					}
				}

				if ((typeof options.ranges === 'undefined' && !this.singleDatePicker) || this.alwaysShowCalendars) {
					this.container.addClass('show-calendar');
				}

				this.container.addClass('opens' + this.opens);

				//apply CSS classes and labels to buttons
				this.container.find('.applyBtn, .cancelBtn').addClass(this.buttonClasses);
				if (this.applyButtonClasses.length)
					this.container.find('.applyBtn').addClass(this.applyButtonClasses);
				if (this.cancelButtonClasses.length)
					this.container.find('.cancelBtn').addClass(this.cancelButtonClasses);
				this.container.find('.applyBtn').html(this.locale.applyLabel);
				this.container.find('.cancelBtn').html(this.locale.cancelLabel);

				//
				// event listeners
				//

				this.container.find('.drp-calendar')
					.on('click.daterangepicker', '.prev', $.proxy(this.clickPrev, this))
					.on('click.daterangepicker', '.next', $.proxy(this.clickNext, this))
					.on('mousedown.daterangepicker', 'td.available', $.proxy(this.clickDate, this))
					.on('mouseenter.daterangepicker', 'td.available', $.proxy(this.hoverDate, this))
					.on('change.daterangepicker', 'select.yearselect', $.proxy(this.monthOrYearChanged, this))
					.on('change.daterangepicker', 'select.monthselect', $.proxy(this.monthOrYearChanged, this))
					.on('change.daterangepicker', 'select.hourselect,select.minuteselect,select.secondselect,select.ampmselect', $.proxy(this.timeChanged, this));

				this.container.find('.ranges')
					.on('click.daterangepicker', 'li', $.proxy(this.clickRange, this));

				this.container.find('.drp-buttons')
					.on('click.daterangepicker', 'button.applyBtn', $.proxy(this.clickApply, this))
					.on('click.daterangepicker', 'button.cancelBtn', $.proxy(this.clickCancel, this));

				if (this.element.is('input') || this.element.is('button')) {
					this.element.on({
						'click.daterangepicker': $.proxy(this.show, this),
						'focus.daterangepicker': $.proxy(this.show, this),
						'keyup.daterangepicker': $.proxy(this.elementChanged, this),
						'keydown.daterangepicker': $.proxy(this.keydown, this) //IE 11 compatibility
					});
				} else {
					this.element.on('click.daterangepicker', $.proxy(this.toggle, this));
					this.element.on('keydown.daterangepicker', $.proxy(this.toggle, this));
				}

				//
				// if attached to a text input, set the initial value
				//

				this.updateElement();

			};

			DateRangePicker.prototype = {

				constructor: DateRangePicker,

				setStartDate: function(startDate) {
					if (typeof startDate === 'string')
						this.startDate = moment(startDate, this.locale.format);

					if (typeof startDate === 'object')
						this.startDate = moment(startDate);

					if (!this.timePicker)
						this.startDate = this.startDate.startOf('day');

					if (this.timePicker && this.timePickerIncrement)
						this.startDate.minute(Math.round(this.startDate.minute() / this.timePickerIncrement) * this.timePickerIncrement);

					if (this.minDate && this.startDate.isBefore(this.minDate)) {
						this.startDate = this.minDate.clone();
						if (this.timePicker && this.timePickerIncrement)
							this.startDate.minute(Math.round(this.startDate.minute() / this.timePickerIncrement) * this.timePickerIncrement);
					}

					if (this.maxDate && this.startDate.isAfter(this.maxDate)) {
						this.startDate = this.maxDate.clone();
						if (this.timePicker && this.timePickerIncrement)
							this.startDate.minute(Math.floor(this.startDate.minute() / this.timePickerIncrement) * this.timePickerIncrement);
					}

					if (!this.isShowing)
						this.updateElement();

					this.updateMonthsInView();
				},

				setEndDate: function(endDate) {
					if (typeof endDate === 'string')
						this.endDate = moment(endDate, this.locale.format);

					if (typeof endDate === 'object')
						this.endDate = moment(endDate);

					if (!this.timePicker)
						this.endDate = this.endDate.endOf('day');

					if (this.timePicker && this.timePickerIncrement)
						this.endDate.minute(Math.round(this.endDate.minute() / this.timePickerIncrement) * this.timePickerIncrement);

					if (this.endDate.isBefore(this.startDate))
						this.endDate = this.startDate.clone();

					if (this.maxDate && this.endDate.isAfter(this.maxDate))
						this.endDate = this.maxDate.clone();

					if (this.maxSpan && this.startDate.clone().add(this.maxSpan).isBefore(this.endDate))
						this.endDate = this.startDate.clone().add(this.maxSpan);

					this.previousRightTime = this.endDate.clone();

					this.container.find('.drp-selected').html(this.startDate.format(this.locale.format) + this.locale.separator + this.endDate.format(this.locale.format));

					if (!this.isShowing)
						this.updateElement();

					this.updateMonthsInView();
				},

				isInvalidDate: function() {
					return false;
				},

				isCustomDate: function() {
					return false;
				},

				updateView: function() {
					if (this.timePicker) {
						this.renderTimePicker('left');
						this.renderTimePicker('right');
						if (!this.endDate) {
							this.container.find('.right .calendar-time select').prop('disabled', true).addClass('disabled');
						} else {
							this.container.find('.right .calendar-time select').prop('disabled', false).removeClass('disabled');
						}
					}
					if (this.endDate)
						this.container.find('.drp-selected').html(this.startDate.format(this.locale.format) + this.locale.separator + this.endDate.format(this.locale.format));
					this.updateMonthsInView();
					this.updateCalendars();
					this.updateFormInputs();
				},

				updateMonthsInView: function() {
					if (this.endDate) {

						//if both dates are visible already, do nothing
						if (!this.singleDatePicker && this.leftCalendar.month && this.rightCalendar.month &&
							(this.startDate.format('YYYY-MM') == this.leftCalendar.month.format('YYYY-MM') || this.startDate.format('YYYY-MM') == this.rightCalendar.month.format('YYYY-MM')) &&
							(this.endDate.format('YYYY-MM') == this.leftCalendar.month.format('YYYY-MM') || this.endDate.format('YYYY-MM') == this.rightCalendar.month.format('YYYY-MM'))
						) {
							return;
						}

						this.leftCalendar.month = this.startDate.clone().date(2);
						if (!this.linkedCalendars && (this.endDate.month() != this.startDate.month() || this.endDate.year() != this.startDate.year())) {
							this.rightCalendar.month = this.endDate.clone().date(2);
						} else {
							this.rightCalendar.month = this.startDate.clone().date(2).add(1, 'month');
						}

					} else {
						if (this.leftCalendar.month.format('YYYY-MM') != this.startDate.format('YYYY-MM') && this.rightCalendar.month.format('YYYY-MM') != this.startDate.format('YYYY-MM')) {
							this.leftCalendar.month = this.startDate.clone().date(2);
							this.rightCalendar.month = this.startDate.clone().date(2).add(1, 'month');
						}
					}
					if (this.maxDate && this.linkedCalendars && !this.singleDatePicker && this.rightCalendar.month > this.maxDate) {
						this.rightCalendar.month = this.maxDate.clone().date(2);
						this.leftCalendar.month = this.maxDate.clone().date(2).subtract(1, 'month');
					}
				},

				updateCalendars: function() {

					if (this.timePicker) {
						var hour, minute, second;
						if (this.endDate) {
							hour = parseInt(this.container.find('.left .hourselect').val(), 10);
							minute = parseInt(this.container.find('.left .minuteselect').val(), 10);
							if (isNaN(minute)) {
								minute = parseInt(this.container.find('.left .minuteselect option:last').val(), 10);
							}
							second = this.timePickerSeconds ? parseInt(this.container.find('.left .secondselect').val(), 10) : 0;
							if (!this.timePicker24Hour) {
								var ampm = this.container.find('.left .ampmselect').val();
								if (ampm === 'PM' && hour < 12)
									hour += 12;
								if (ampm === 'AM' && hour === 12)
									hour = 0;
							}
						} else {
							hour = parseInt(this.container.find('.right .hourselect').val(), 10);
							minute = parseInt(this.container.find('.right .minuteselect').val(), 10);
							if (isNaN(minute)) {
								minute = parseInt(this.container.find('.right .minuteselect option:last').val(), 10);
							}
							second = this.timePickerSeconds ? parseInt(this.container.find('.right .secondselect').val(), 10) : 0;
							if (!this.timePicker24Hour) {
								var ampm = this.container.find('.right .ampmselect').val();
								if (ampm === 'PM' && hour < 12)
									hour += 12;
								if (ampm === 'AM' && hour === 12)
									hour = 0;
							}
						}
						this.leftCalendar.month.hour(hour).minute(minute).second(second);
						this.rightCalendar.month.hour(hour).minute(minute).second(second);
					}

					this.renderCalendar('left');
					this.renderCalendar('right');

					//highlight any predefined range matching the current start and end dates
					this.container.find('.ranges li').removeClass('active');
					if (this.endDate == null) return;

					this.calculateChosenLabel();
				},

				renderCalendar: function(side) {

					//
					// Build the matrix of dates that will populate the calendar
					//

					var calendar = side == 'left' ? this.leftCalendar : this.rightCalendar;
					var month = calendar.month.month();
					var year = calendar.month.year();
					var hour = calendar.month.hour();
					var minute = calendar.month.minute();
					var second = calendar.month.second();
					var daysInMonth = moment([year, month]).daysInMonth();
					var firstDay = moment([year, month, 1]);
					var lastDay = moment([year, month, daysInMonth]);
					var lastMonth = moment(firstDay).subtract(1, 'month').month();
					var lastYear = moment(firstDay).subtract(1, 'month').year();
					var daysInLastMonth = moment([lastYear, lastMonth]).daysInMonth();
					var dayOfWeek = firstDay.day();

					//initialize a 6 rows x 7 columns array for the calendar
					var calendar = [];
					calendar.firstDay = firstDay;
					calendar.lastDay = lastDay;

					for (var i = 0; i < 6; i++) {
						calendar[i] = [];
					}

					//populate the calendar with date objects
					var startDay = daysInLastMonth - dayOfWeek + this.locale.firstDay + 1;
					if (startDay > daysInLastMonth)
						startDay -= 7;

					if (dayOfWeek == this.locale.firstDay)
						startDay = daysInLastMonth - 6;

					var curDate = moment([lastYear, lastMonth, startDay, 12, minute, second]);

					var col, row;
					for (var i = 0, col = 0, row = 0; i < 42; i++, col++, curDate = moment(curDate).add(24, 'hour')) {
						if (i > 0 && col % 7 === 0) {
							col = 0;
							row++;
						}
						calendar[row][col] = curDate.clone().hour(hour).minute(minute).second(second);
						curDate.hour(12);

						if (this.minDate && calendar[row][col].format('YYYY-MM-DD') == this.minDate.format('YYYY-MM-DD') && calendar[row][col].isBefore(this.minDate) && side == 'left') {
							calendar[row][col] = this.minDate.clone();
						}

						if (this.maxDate && calendar[row][col].format('YYYY-MM-DD') == this.maxDate.format('YYYY-MM-DD') && calendar[row][col].isAfter(this.maxDate) && side == 'right') {
							calendar[row][col] = this.maxDate.clone();
						}

					}

					//make the calendar object available to hoverDate/clickDate
					if (side == 'left') {
						this.leftCalendar.calendar = calendar;
					} else {
						this.rightCalendar.calendar = calendar;
					}

					//
					// Display the calendar
					//

					var minDate = side == 'left' ? this.minDate : this.startDate;
					var maxDate = this.maxDate;
					var selected = side == 'left' ? this.startDate : this.endDate;
					var arrow = this.locale.direction == 'ltr' ? {
						left: 'chevron-left',
						right: 'chevron-right'
					} : {
						left: 'chevron-right',
						right: 'chevron-left'
					};

					var html = '<table class="table-condensed">';
					html += '<thead>';
					html += '<tr>';

					// add empty cell for week number
					if (this.showWeekNumbers || this.showISOWeekNumbers)
						html += '<th></th>';

					if ((!minDate || minDate.isBefore(calendar.firstDay)) && (!this.linkedCalendars || side == 'left')) {
						html += '<th class="prev available"><span></span></th>';
					} else {
						html += '<th></th>';
					}

					var dateHtml = this.locale.monthNames[calendar[1][1].month()] + calendar[1][1].format(" YYYY");

					if (this.showDropdowns) {
						var currentMonth = calendar[1][1].month();
						var currentYear = calendar[1][1].year();
						var maxYear = (maxDate && maxDate.year()) || (this.maxYear);
						var minYear = (minDate && minDate.year()) || (this.minYear);
						var inMinYear = currentYear == minYear;
						var inMaxYear = currentYear == maxYear;

						var monthHtml = '<select class="monthselect">';
						for (var m = 0; m < 12; m++) {
							if ((!inMinYear || (minDate && m >= minDate.month())) && (!inMaxYear || (maxDate && m <= maxDate.month()))) {
								monthHtml += "<option value='" + m + "'" +
									(m === currentMonth ? " selected='selected'" : "") +
									">" + this.locale.monthNames[m] + "</option>";
							} else {
								monthHtml += "<option value='" + m + "'" +
									(m === currentMonth ? " selected='selected'" : "") +
									" disabled='disabled'>" + this.locale.monthNames[m] + "</option>";
							}
						}
						monthHtml += "</select>";

						var yearHtml = '<select class="yearselect">';
						for (var y = minYear; y <= maxYear; y++) {
							yearHtml += '<option value="' + y + '"' +
								(y === currentYear ? ' selected="selected"' : '') +
								'>' + y + '</option>';
						}
						yearHtml += '</select>';

						dateHtml = monthHtml + yearHtml;
					}

					html += '<th colspan="5" class="month">' + dateHtml + '</th>';
					if ((!maxDate || maxDate.isAfter(calendar.lastDay)) && (!this.linkedCalendars || side == 'right' || this.singleDatePicker)) {
						html += '<th class="next available"><span></span></th>';
					} else {
						html += '<th></th>';
					}

					html += '</tr>';
					html += '<tr>';

					// add week number label
					if (this.showWeekNumbers || this.showISOWeekNumbers)
						html += '<th class="week">' + this.locale.weekLabel + '</th>';

					$.each(this.locale.daysOfWeek, function(index, dayOfWeek) {
						html += '<th>' + dayOfWeek + '</th>';
					});

					html += '</tr>';
					html += '</thead>';
					html += '<tbody>';

					//adjust maxDate to reflect the maxSpan setting in order to
					//grey out end dates beyond the maxSpan
					if (this.endDate == null && this.maxSpan) {
						var maxLimit = this.startDate.clone().add(this.maxSpan).endOf('day');
						if (!maxDate || maxLimit.isBefore(maxDate)) {
							maxDate = maxLimit;
						}
					}

					for (var row = 0; row < 6; row++) {
						html += '<tr>';

						// add week number
						if (this.showWeekNumbers)
							html += '<td class="week">' + calendar[row][0].week() + '</td>';
						else if (this.showISOWeekNumbers)
							html += '<td class="week">' + calendar[row][0].isoWeek() + '</td>';

						for (var col = 0; col < 7; col++) {

							var classes = [];

							//highlight today's date
							if (calendar[row][col].isSame(new Date(), "day"))
								classes.push('today');

							//highlight weekends
							if (calendar[row][col].isoWeekday() > 5)
								classes.push('weekend');

							//grey out the dates in other months displayed at beginning and end of this calendar
							if (calendar[row][col].month() != calendar[1][1].month())
								classes.push('off', 'ends');

							//don't allow selection of dates before the minimum date
							if (this.minDate && calendar[row][col].isBefore(this.minDate, 'day'))
								classes.push('off', 'disabled');

							//don't allow selection of dates after the maximum date
							if (maxDate && calendar[row][col].isAfter(maxDate, 'day'))
								classes.push('off', 'disabled');

							//don't allow selection of date if a custom function decides it's invalid
							if (this.isInvalidDate(calendar[row][col]))
								classes.push('off', 'disabled');

							//highlight the currently selected start date
							if (calendar[row][col].format('YYYY-MM-DD') == this.startDate.format('YYYY-MM-DD'))
								classes.push('active', 'start-date');

							//highlight the currently selected end date
							if (this.endDate != null && calendar[row][col].format('YYYY-MM-DD') == this.endDate.format('YYYY-MM-DD'))
								classes.push('active', 'end-date');

							//highlight dates in-between the selected dates
							if (this.endDate != null && calendar[row][col] > this.startDate && calendar[row][col] < this.endDate)
								classes.push('in-range');

							//apply custom classes for this date
							var isCustom = this.isCustomDate(calendar[row][col]);
							if (isCustom !== false) {
								if (typeof isCustom === 'string')
									classes.push(isCustom);
								else
									Array.prototype.push.apply(classes, isCustom);
							}

							var cname = '',
								disabled = false;
							for (var i = 0; i < classes.length; i++) {
								cname += classes[i] + ' ';
								if (classes[i] == 'disabled')
									disabled = true;
							}
							if (!disabled)
								cname += 'available';

							html += '<td class="' + cname.replace(/^\s+|\s+$/g, '') + '" data-title="' + 'r' + row + 'c' + col + '">' + calendar[row][col].date() + '</td>';

						}
						html += '</tr>';
					}

					html += '</tbody>';
					html += '</table>';

					this.container.find('.drp-calendar.' + side + ' .calendar-table').html(html);

				},

				renderTimePicker: function(side) {

					// Don't bother updating the time picker if it's currently disabled
					// because an end date hasn't been clicked yet
					if (side == 'right' && !this.endDate) return;

					var html, selected, minDate, maxDate = this.maxDate;

					if (this.maxSpan && (!this.maxDate || this.startDate.clone().add(this.maxSpan).isBefore(this.maxDate)))
						maxDate = this.startDate.clone().add(this.maxSpan);

					if (side == 'left') {
						selected = this.startDate.clone();
						minDate = this.minDate;
					} else if (side == 'right') {
						selected = this.endDate.clone();
						minDate = this.startDate;

						//Preserve the time already selected
						var timeSelector = this.container.find('.drp-calendar.right .calendar-time');
						if (timeSelector.html() != '') {

							selected.hour(!isNaN(selected.hour()) ? selected.hour() : timeSelector.find('.hourselect option:selected').val());
							selected.minute(!isNaN(selected.minute()) ? selected.minute() : timeSelector.find('.minuteselect option:selected').val());
							selected.second(!isNaN(selected.second()) ? selected.second() : timeSelector.find('.secondselect option:selected').val());

							if (!this.timePicker24Hour) {
								var ampm = timeSelector.find('.ampmselect option:selected').val();
								if (ampm === 'PM' && selected.hour() < 12)
									selected.hour(selected.hour() + 12);
								if (ampm === 'AM' && selected.hour() === 12)
									selected.hour(0);
							}

						}

						if (selected.isBefore(this.startDate))
							selected = this.startDate.clone();

						if (maxDate && selected.isAfter(maxDate))
							selected = maxDate.clone();

					}

					//
					// hours
					//

					html = '<select class="hourselect">';

					var start = this.timePicker24Hour ? 0 : 1;
					var end = this.timePicker24Hour ? 23 : 12;

					for (var i = start; i <= end; i++) {
						var i_in_24 = i;
						if (!this.timePicker24Hour)
							i_in_24 = selected.hour() >= 12 ? (i == 12 ? 12 : i + 12) : (i == 12 ? 0 : i);

						var time = selected.clone().hour(i_in_24);
						var disabled = false;
						if (minDate && time.minute(59).isBefore(minDate))
							disabled = true;
						if (maxDate && time.minute(0).isAfter(maxDate))
							disabled = true;

						if (i_in_24 == selected.hour() && !disabled) {
							html += '<option value="' + i + '" selected="selected">' + i + '</option>';
						} else if (disabled) {
							html += '<option value="' + i + '" disabled="disabled" class="disabled">' + i + '</option>';
						} else {
							html += '<option value="' + i + '">' + i + '</option>';
						}
					}

					html += '</select> ';

					//
					// minutes
					//

					html += ': <select class="minuteselect">';

					for (var i = 0; i < 60; i += this.timePickerIncrement) {
						var padded = i < 10 ? '0' + i : i;
						var time = selected.clone().minute(i);

						var disabled = false;
						if (minDate && time.second(59).isBefore(minDate))
							disabled = true;
						if (maxDate && time.second(0).isAfter(maxDate))
							disabled = true;

						if (selected.minute() == i && !disabled) {
							html += '<option value="' + i + '" selected="selected">' + padded + '</option>';
						} else if (disabled) {
							html += '<option value="' + i + '" disabled="disabled" class="disabled">' + padded + '</option>';
						} else {
							html += '<option value="' + i + '">' + padded + '</option>';
						}
					}

					html += '</select> ';

					//
					// seconds
					//

					if (this.timePickerSeconds) {
						html += ': <select class="secondselect">';

						for (var i = 0; i < 60; i++) {
							var padded = i < 10 ? '0' + i : i;
							var time = selected.clone().second(i);

							var disabled = false;
							if (minDate && time.isBefore(minDate))
								disabled = true;
							if (maxDate && time.isAfter(maxDate))
								disabled = true;

							if (selected.second() == i && !disabled) {
								html += '<option value="' + i + '" selected="selected">' + padded + '</option>';
							} else if (disabled) {
								html += '<option value="' + i + '" disabled="disabled" class="disabled">' + padded + '</option>';
							} else {
								html += '<option value="' + i + '">' + padded + '</option>';
							}
						}

						html += '</select> ';
					}

					//
					// AM/PM
					//

					if (!this.timePicker24Hour) {
						html += '<select class="ampmselect">';

						var am_html = '';
						var pm_html = '';

						if (minDate && selected.clone().hour(12).minute(0).second(0).isBefore(minDate))
							am_html = ' disabled="disabled" class="disabled"';

						if (maxDate && selected.clone().hour(0).minute(0).second(0).isAfter(maxDate))
							pm_html = ' disabled="disabled" class="disabled"';

						if (selected.hour() >= 12) {
							html += '<option value="AM"' + am_html + '>AM</option><option value="PM" selected="selected"' + pm_html + '>PM</option>';
						} else {
							html += '<option value="AM" selected="selected"' + am_html + '>AM</option><option value="PM"' + pm_html + '>PM</option>';
						}

						html += '</select>';
					}

					this.container.find('.drp-calendar.' + side + ' .calendar-time').html(html);

				},

				updateFormInputs: function() {

					if (this.singleDatePicker || (this.endDate && (this.startDate.isBefore(this.endDate) || this.startDate.isSame(this.endDate)))) {
						this.container.find('button.applyBtn').prop('disabled', false);
					} else {
						this.container.find('button.applyBtn').prop('disabled', true);
					}

				},

				move: function() {
					var parentOffset = {
							top: 0,
							left: 0
						},
						containerTop,
						drops = this.drops;

					var parentRightEdge = $(window).width();
					if (!this.parentEl.is('body')) {
						parentOffset = {
							top: this.parentEl.offset().top - this.parentEl.scrollTop(),
							left: this.parentEl.offset().left - this.parentEl.scrollLeft()
						};
						parentRightEdge = this.parentEl[0].clientWidth + this.parentEl.offset().left;
					}

					switch (drops) {
						case 'auto':
							containerTop = this.element.offset().top + this.element.outerHeight() - parentOffset.top;
							if (containerTop + this.container.outerHeight() >= this.parentEl[0].scrollHeight) {
								containerTop = this.element.offset().top - this.container.outerHeight() - parentOffset.top;
								drops = 'up';
							}
							break;
						case 'up':
							containerTop = this.element.offset().top - this.container.outerHeight() - parentOffset.top;
							break;
						default:
							containerTop = this.element.offset().top + this.element.outerHeight() - parentOffset.top;
							break;
					}

					// Force the container to it's actual width
					this.container.css({
						top: 0,
						left: 0,
						right: 'auto'
					});
					var containerWidth = this.container.outerWidth();

					this.container.toggleClass('drop-up', drops == 'up');

					if (this.opens == 'left') {
						var containerRight = parentRightEdge - this.element.offset().left - this.element.outerWidth();
						if (containerWidth + containerRight > $(window).width()) {
							this.container.css({
								top: containerTop,
								right: 'auto',
								left: 9
							});
						} else {
							this.container.css({
								top: containerTop,
								right: containerRight,
								left: 'auto'
							});
						}
					} else if (this.opens == 'center') {
						var containerLeft = this.element.offset().left - parentOffset.left + this.element.outerWidth() / 2 -
							containerWidth / 2;
						if (containerLeft < 0) {
							this.container.css({
								top: containerTop,
								right: 'auto',
								left: 9
							});
						} else if (containerLeft + containerWidth > $(window).width()) {
							this.container.css({
								top: containerTop,
								left: 'auto',
								right: 0
							});
						} else {
							this.container.css({
								top: containerTop,
								left: containerLeft,
								right: 'auto'
							});
						}
					} else {
						var containerLeft = this.element.offset().left - parentOffset.left;
						if (containerLeft + containerWidth > $(window).width()) {
							this.container.css({
								top: containerTop,
								left: 'auto',
								right: 0
							});
						} else {
							this.container.css({
								top: containerTop,
								left: containerLeft,
								right: 'auto'
							});
						}
					}
				},

				show: function(e) {
					if (this.isShowing) return;

					// Create a click proxy that is private to this instance of datepicker, for unbinding
					this._outsideClickProxy = $.proxy(function(e) {
						this.outsideClick(e);
					}, this);

					// Bind global datepicker mousedown for hiding and
					$(document)
						.on('mousedown.daterangepicker', this._outsideClickProxy)
						// also support mobile devices
						.on('touchend.daterangepicker', this._outsideClickProxy)
						// also explicitly play nice with Bootstrap dropdowns, which stopPropagation when clicking them
						.on('click.daterangepicker', '[data-toggle=dropdown]', this._outsideClickProxy)
						// and also close when focus changes to outside the picker (eg. tabbing between controls)
						.on('focusin.daterangepicker', this._outsideClickProxy);

					// Reposition the picker if the window is resized while it's open
					$(window).on('resize.daterangepicker', $.proxy(function(e) {
						this.move(e);
					}, this));

					this.oldStartDate = this.startDate.clone();
					this.oldEndDate = this.endDate.clone();
					this.previousRightTime = this.endDate.clone();

					this.updateView();
					this.container.show();
					this.move();
					this.element.trigger('show.daterangepicker', this);
					this.isShowing = true;
				},

				hide: function(e) {
					if (!this.isShowing) return;

					//incomplete date selection, revert to last values
					if (!this.endDate) {
						this.startDate = this.oldStartDate.clone();
						this.endDate = this.oldEndDate.clone();
					}

					//if a new date range was selected, invoke the user callback function
					if (!this.startDate.isSame(this.oldStartDate) || !this.endDate.isSame(this.oldEndDate))
						this.callback(this.startDate.clone(), this.endDate.clone(), this.chosenLabel);

					//if picker is attached to a text input, update it
					this.updateElement();

					$(document).off('.daterangepicker');
					$(window).off('.daterangepicker');
					this.container.hide();
					this.element.trigger('hide.daterangepicker', this);
					this.isShowing = false;
				},

				toggle: function(e) {
					if (this.isShowing) {
						this.hide();
					} else {
						this.show();
					}
				},

				outsideClick: function(e) {
					var target = $(e.target);
					// if the page is clicked anywhere except within the daterangerpicker/button
					// itself then call this.hide()
					if (
						// ie modal dialog fix
						e.type == "focusin" ||
						target.closest(this.element).length ||
						target.closest(this.container).length ||
						target.closest('.calendar-table').length
					) return;
					this.hide();
					this.element.trigger('outsideClick.daterangepicker', this);
				},

				showCalendars: function() {
					this.container.addClass('show-calendar');
					this.move();
					this.element.trigger('showCalendar.daterangepicker', this);
				},

				hideCalendars: function() {
					this.container.removeClass('show-calendar');
					this.element.trigger('hideCalendar.daterangepicker', this);
				},

				clickRange: function(e) {
					var label = e.target.getAttribute('data-range-key');
					this.chosenLabel = label;
					if (label == this.locale.customRangeLabel) {
						this.showCalendars();
					} else {
						var dates = this.ranges[label];
						this.startDate = dates[0];
						this.endDate = dates[1];

						if (!this.timePicker) {
							this.startDate.startOf('day');
							this.endDate.endOf('day');
						}

						if (!this.alwaysShowCalendars)
							this.hideCalendars();
						this.clickApply();
					}
				},

				clickPrev: function(e) {
					var cal = $(e.target).parents('.drp-calendar');
					if (cal.hasClass('left')) {
						this.leftCalendar.month.subtract(1, 'month');
						if (this.linkedCalendars)
							this.rightCalendar.month.subtract(1, 'month');
					} else {
						this.rightCalendar.month.subtract(1, 'month');
					}
					this.updateCalendars();
				},

				clickNext: function(e) {
					var cal = $(e.target).parents('.drp-calendar');
					if (cal.hasClass('left')) {
						this.leftCalendar.month.add(1, 'month');
					} else {
						this.rightCalendar.month.add(1, 'month');
						if (this.linkedCalendars)
							this.leftCalendar.month.add(1, 'month');
					}
					this.updateCalendars();
				},

				hoverDate: function(e) {

					//ignore dates that can't be selected
					if (!$(e.target).hasClass('available')) return;

					var title = $(e.target).attr('data-title');
					var row = title.substr(1, 1);
					var col = title.substr(3, 1);
					var cal = $(e.target).parents('.drp-calendar');
					var date = cal.hasClass('left') ? this.leftCalendar.calendar[row][col] : this.rightCalendar.calendar[row][col];

					//highlight the dates between the start date and the date being hovered as a potential end date
					var leftCalendar = this.leftCalendar;
					var rightCalendar = this.rightCalendar;
					var startDate = this.startDate;
					if (!this.endDate) {
						this.container.find('.drp-calendar tbody td').each(function(index, el) {

							//skip week numbers, only look at dates
							if ($(el).hasClass('week')) return;

							var title = $(el).attr('data-title');
							var row = title.substr(1, 1);
							var col = title.substr(3, 1);
							var cal = $(el).parents('.drp-calendar');
							var dt = cal.hasClass('left') ? leftCalendar.calendar[row][col] : rightCalendar.calendar[row][col];

							if ((dt.isAfter(startDate) && dt.isBefore(date)) || dt.isSame(date, 'day')) {
								$(el).addClass('in-range');
							} else {
								$(el).removeClass('in-range');
							}

						});
					}

				},

				clickDate: function(e) {

					if (!$(e.target).hasClass('available')) return;

					var title = $(e.target).attr('data-title');
					var row = title.substr(1, 1);
					var col = title.substr(3, 1);
					var cal = $(e.target).parents('.drp-calendar');
					var date = cal.hasClass('left') ? this.leftCalendar.calendar[row][col] : this.rightCalendar.calendar[row][col];

					//
					// this function needs to do a few things:
					// * alternate between selecting a start and end date for the range,
					// * if the time picker is enabled, apply the hour/minute/second from the select boxes to the clicked date
					// * if autoapply is enabled, and an end date was chosen, apply the selection
					// * if single date picker mode, and time picker isn't enabled, apply the selection immediately
					// * if one of the inputs above the calendars was focused, cancel that manual input
					//

					if (this.endDate || date.isBefore(this.startDate, 'day')) { //picking start
						if (this.timePicker) {
							var hour = parseInt(this.container.find('.left .hourselect').val(), 10);
							if (!this.timePicker24Hour) {
								var ampm = this.container.find('.left .ampmselect').val();
								if (ampm === 'PM' && hour < 12)
									hour += 12;
								if (ampm === 'AM' && hour === 12)
									hour = 0;
							}
							var minute = parseInt(this.container.find('.left .minuteselect').val(), 10);
							if (isNaN(minute)) {
								minute = parseInt(this.container.find('.left .minuteselect option:last').val(), 10);
							}
							var second = this.timePickerSeconds ? parseInt(this.container.find('.left .secondselect').val(), 10) : 0;
							date = date.clone().hour(hour).minute(minute).second(second);
						}
						this.endDate = null;
						this.setStartDate(date.clone());
					} else if (!this.endDate && date.isBefore(this.startDate)) {
						//special case: clicking the same date for start/end,
						//but the time of the end date is before the start date
						this.setEndDate(this.startDate.clone());
					} else { // picking end
						if (this.timePicker) {
							var hour = parseInt(this.container.find('.right .hourselect').val(), 10);
							if (!this.timePicker24Hour) {
								var ampm = this.container.find('.right .ampmselect').val();
								if (ampm === 'PM' && hour < 12)
									hour += 12;
								if (ampm === 'AM' && hour === 12)
									hour = 0;
							}
							var minute = parseInt(this.container.find('.right .minuteselect').val(), 10);
							if (isNaN(minute)) {
								minute = parseInt(this.container.find('.right .minuteselect option:last').val(), 10);
							}
							var second = this.timePickerSeconds ? parseInt(this.container.find('.right .secondselect').val(), 10) : 0;
							date = date.clone().hour(hour).minute(minute).second(second);
						}
						this.setEndDate(date.clone());
						if (this.autoApply) {
							this.calculateChosenLabel();
							this.clickApply();
						}
					}

					if (this.singleDatePicker) {
						this.setEndDate(this.startDate);
						if (!this.timePicker && this.autoApply)
							this.clickApply();
					}

					this.updateView();

					//This is to cancel the blur event handler if the mouse was in one of the inputs
					e.stopPropagation();

				},

				calculateChosenLabel: function() {
					var customRange = true;
					var i = 0;
					for (var range in this.ranges) {
						if (this.timePicker) {
							var format = this.timePickerSeconds ? "YYYY-MM-DD HH:mm:ss" : "YYYY-MM-DD HH:mm";
							//ignore times when comparing dates if time picker seconds is not enabled
							if (this.startDate.format(format) == this.ranges[range][0].format(format) && this.endDate.format(format) == this.ranges[range][1].format(format)) {
								customRange = false;
								this.chosenLabel = this.container.find('.ranges li:eq(' + i + ')').addClass('active').attr('data-range-key');
								break;
							}
						} else {
							//ignore times when comparing dates if time picker is not enabled
							if (this.startDate.format('YYYY-MM-DD') == this.ranges[range][0].format('YYYY-MM-DD') && this.endDate.format('YYYY-MM-DD') == this.ranges[range][1].format('YYYY-MM-DD')) {
								customRange = false;
								this.chosenLabel = this.container.find('.ranges li:eq(' + i + ')').addClass('active').attr('data-range-key');
								break;
							}
						}
						i++;
					}
					if (customRange) {
						if (this.showCustomRangeLabel) {
							this.chosenLabel = this.container.find('.ranges li:last').addClass('active').attr('data-range-key');
						} else {
							this.chosenLabel = null;
						}
						this.showCalendars();
					}
				},

				clickApply: function(e) {
					this.hide();
					this.element.trigger('apply.daterangepicker', this);
				},

				clickCancel: function(e) {
					this.startDate = this.oldStartDate;
					this.endDate = this.oldEndDate;
					this.hide();
					this.element.trigger('cancel.daterangepicker', this);
				},

				monthOrYearChanged: function(e) {
					var isLeft = $(e.target).closest('.drp-calendar').hasClass('left'),
						leftOrRight = isLeft ? 'left' : 'right',
						cal = this.container.find('.drp-calendar.' + leftOrRight);

					// Month must be Number for new moment versions
					var month = parseInt(cal.find('.monthselect').val(), 10);
					var year = cal.find('.yearselect').val();

					if (!isLeft) {
						if (year < this.startDate.year() || (year == this.startDate.year() && month < this.startDate.month())) {
							month = this.startDate.month();
							year = this.startDate.year();
						}
					}

					if (this.minDate) {
						if (year < this.minDate.year() || (year == this.minDate.year() && month < this.minDate.month())) {
							month = this.minDate.month();
							year = this.minDate.year();
						}
					}

					if (this.maxDate) {
						if (year > this.maxDate.year() || (year == this.maxDate.year() && month > this.maxDate.month())) {
							month = this.maxDate.month();
							year = this.maxDate.year();
						}
					}

					if (isLeft) {
						this.leftCalendar.month.month(month).year(year);
						if (this.linkedCalendars)
							this.rightCalendar.month = this.leftCalendar.month.clone().add(1, 'month');
					} else {
						this.rightCalendar.month.month(month).year(year);
						if (this.linkedCalendars)
							this.leftCalendar.month = this.rightCalendar.month.clone().subtract(1, 'month');
					}
					this.updateCalendars();
				},

				timeChanged: function(e) {

					var cal = $(e.target).closest('.drp-calendar'),
						isLeft = cal.hasClass('left');

					var hour = parseInt(cal.find('.hourselect').val(), 10);
					var minute = parseInt(cal.find('.minuteselect').val(), 10);
					if (isNaN(minute)) {
						minute = parseInt(cal.find('.minuteselect option:last').val(), 10);
					}
					var second = this.timePickerSeconds ? parseInt(cal.find('.secondselect').val(), 10) : 0;

					if (!this.timePicker24Hour) {
						var ampm = cal.find('.ampmselect').val();
						if (ampm === 'PM' && hour < 12)
							hour += 12;
						if (ampm === 'AM' && hour === 12)
							hour = 0;
					}

					if (isLeft) {
						var start = this.startDate.clone();
						start.hour(hour);
						start.minute(minute);
						start.second(second);
						this.setStartDate(start);
						if (this.singleDatePicker) {
							this.endDate = this.startDate.clone();
						} else if (this.endDate && this.endDate.format('YYYY-MM-DD') == start.format('YYYY-MM-DD') && this.endDate.isBefore(start)) {
							this.setEndDate(start.clone());
						}
					} else if (this.endDate) {
						var end = this.endDate.clone();
						end.hour(hour);
						end.minute(minute);
						end.second(second);
						this.setEndDate(end);
					}

					//update the calendars so all clickable dates reflect the new time component
					this.updateCalendars();

					//update the form inputs above the calendars with the new time
					this.updateFormInputs();

					//re-render the time pickers because changing one selection can affect what's enabled in another
					this.renderTimePicker('left');
					this.renderTimePicker('right');

				},

				elementChanged: function() {
					if (!this.element.is('input')) return;
					if (!this.element.val().length) return;

					var dateString = this.element.val().split(this.locale.separator),
						start = null,
						end = null;

					if (dateString.length === 2) {
						start = moment(dateString[0], this.locale.format);
						end = moment(dateString[1], this.locale.format);
					}

					if (this.singleDatePicker || start === null || end === null) {
						start = moment(this.element.val(), this.locale.format);
						end = start;
					}

					if (!start.isValid() || !end.isValid()) return;

					this.setStartDate(start);
					this.setEndDate(end);
					this.updateView();
				},

				keydown: function(e) {
					//hide on tab or enter
					if ((e.keyCode === 9) || (e.keyCode === 13)) {
						this.hide();
					}

					//hide on esc and prevent propagation
					if (e.keyCode === 27) {
						e.preventDefault();
						e.stopPropagation();

						this.hide();
					}
				},

				updateElement: function() {
					if (this.element.is('input') && this.autoUpdateInput) {
						var newValue = this.startDate.format(this.locale.format);
						if (!this.singleDatePicker) {
							newValue += this.locale.separator + this.endDate.format(this.locale.format);
						}
						if (newValue !== this.element.val()) {
							this.element.val(newValue).trigger('change');
						}
					}
				},

				remove: function() {
					this.container.remove();
					this.element.off('.daterangepicker');
					this.element.removeData();
				}

			};

			$.fn.daterangepicker = function(options, callback) {
				var implementOptions = $.extend(true, {}, $.fn.daterangepicker.defaultOptions, options);
				this.each(function() {
					var el = $(this);
					if (el.data('daterangepicker'))
						el.data('daterangepicker').remove();
					el.data('daterangepicker', new DateRangePicker(el, implementOptions, callback));
				});
				return this;
			};

			return DateRangePicker;

		}));
	</script>
</head>

<body>

	<!--*******************
        Preloader start
    ********************-->
    <style>
	.light-blue-bg {
		background-color: #F0F8FEFF;
		border: 1px solid #b9e1ff;
	}

	.light-grey-bg {
		background-color: #f3f3f3;
		border: 1px solid #d6d6d6;
	}

	.light-yellow-bg {
		background-color: #fff9ee;
		border: 1px solid #ffe1aa;
	}

	.light-green-bg {
		background-color: #f3fbfa;
		border: 1px solid #c4fef7;
	}

	.light-pink-bg {
		background-color: #fff0f4;
		border: 1px solid #ffc9d8;
	}
</style> 
<style>
	/* Preloader Styles */
	#preloader {
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
	
		z-index: 9999;
		display: flex;
		justify-content: center;
		align-items: center;
	}

	.progress-bar {
		width: 100%;
		/*background: #e0e0e0;*/
		border-radius: 5px;
		overflow: hidden;
		position: relative;
	}

	.progress-bar .bar {
		height: 5px;
		background: #008040;
		width: 0%; /* Start at 0% */
		transition: width 2s ease; /* Smooth transition over 2 seconds */
	}

	.progress-bar::before {
		/*content: 'Loading...';*/
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		font-size: 14px;
		color: #333;
	}
</style>



<div id="preloader"></div>
	<div class="progress-bar">
		<div class="bar" id="progress"></div>
	</div>
	</div>   
	
	
	<script >
	// Function to animate the progress bar to 100%
	function animateProgressBar() {
		document.getElementById('progress').style.width = '100%';
	}

	// Start the animation after the DOM has loaded
	window.addEventListener('load', () => {
		animateProgressBar();

		// Optionally, hide the preloader after the animation ends
		setTimeout(() => {
			document.getElementById('preloader').style.display = 'none'; // Hide preloader
		}, 50000); // Match this with the duration of the CSS transition (2 seconds)
	});
</script>
	<!--*******************
        Preloader end
    ********************-->

	<!--**********************************
        Main wrapper start
    ***********************************-->
	<div id="main-wrapper">

		<style>
			.dlab-scroll {
				overflow-y: scroll;
			}

			.dlab-scroll {
				overflow-y: scroll;
			}

			body>* {
				scrollbar-width: thin;
				overflow-y: scroll;
				scrollbar-color: rgb(0 0 0 / 41%) rgba(0, 0, 0, 0);
			}

			::-webkit-scrollbar {
				width: 10px;
				opacity: 0;
			}

			/* ::-webkit-scrollbar-thumb{
	  background:  rgba(111, 133, 147, 0.0); 
  } */
			::-webkit-scrollbar-thumb {
				background: rgb(0 0 0 / 49%);
			}
		</style>
		<div class="nav-header">
			<a href="{{ asset('/UserPanel') }}" class="brand-logo">
				<h1 class="logo-abbr">SHIPNICK</h1>
				<!--<svg class="logo-abbr" width="53" height="53" viewBox="0 0 53 53">-->
				<!--	<path d="M21.6348 8.04782C21.6348 5.1939 23.9566 2.87204 26.8105 2.87204H28.6018L28.0614 1.37003C27.7576 0.525342 26.9616 0 26.1132 0C25.8781 0 25.639 0.0403711 25.4052 0.125461L7.3052 6.7133C6.22916 7.105 5.67535 8.29574 6.06933 9.37096L7.02571 11.9814H21.6348V8.04782Z" fill="#759DD9" />-->
				<!--	<path d="M26.8105 5.97754C25.6671 5.97754 24.7402 6.90442 24.7402 8.04786V11.9815H42.8555V8.04786C42.8555 6.90442 41.9286 5.97754 40.7852 5.97754H26.8105Z" fill="#F8A961" />-->
				<!--	<path class="svg-logo-primary-path" d="M48.3418 41.8457H41.0957C36.8148 41.8457 33.332 38.3629 33.332 34.082C33.332 29.8011 36.8148 26.3184 41.0957 26.3184H48.3418V19.2275C48.3418 16.9408 46.4879 15.0869 44.2012 15.0869H4.14062C1.85386 15.0869 0 16.9408 0 19.2275V48.8594C0 51.1462 1.85386 53 4.14062 53H44.2012C46.4879 53 48.3418 51.1462 48.3418 48.8594V41.8457Z" fill="#5BCFC5" />-->
				<!--	<path class="svg-logo-primary-path" d="M51.4473 29.4238H41.0957C38.5272 29.4238 36.4375 31.5135 36.4375 34.082C36.4375 36.6506 38.5272 38.7402 41.0957 38.7402H51.4473C52.3034 38.7402 53 38.0437 53 37.1875V30.9766C53 30.1204 52.3034 29.4238 51.4473 29.4238ZM41.0957 35.6348C40.2382 35.6348 39.543 34.9396 39.543 34.082C39.543 33.2245 40.2382 32.5293 41.0957 32.5293C41.9532 32.5293 42.6484 33.2245 42.6484 34.082C42.6484 34.9396 41.9532 35.6348 41.0957 35.6348Z" fill="#5BCFC5" />-->
				<!--</svg>-->
				<!--<svg class="brand-title" width="124px" height="33px">-->
				<!--	<path class="svg-title-path" fill-rule="evenodd" fill="rgb(25, 59, 98)" d="M119.160,20.128 C119.363,20.309 119.602,20.400 119.873,20.400 L123.681,20.400 L123.681,24.820 L118.718,24.820 C117.108,24.820 115.850,24.366 114.944,23.460 C114.037,22.530 113.583,21.284 113.583,19.720 L113.583,11.696 L118.887,11.696 L118.887,19.414 C118.887,19.686 118.978,19.924 119.160,20.128 ZM110.727,11.696 L110.727,7.378 L113.583,7.378 L113.583,11.696 L110.727,11.696 ZM113.583,3.128 L118.887,3.128 L118.887,7.378 L113.583,7.378 L113.583,3.128 ZM123.681,7.378 L123.681,11.696 L118.887,11.696 L118.887,7.378 L123.681,7.378 ZM110.085,17.782 L98.661,17.782 C98.797,18.371 99.058,18.870 99.443,19.278 C99.828,19.686 100.316,19.992 100.905,20.196 C101.494,20.377 102.151,20.468 102.877,20.468 L108.215,20.468 L108.215,24.820 L103.047,24.820 C101.075,24.820 99.341,24.457 97.845,23.732 C96.349,22.984 95.182,21.964 94.343,20.672 C93.527,19.357 93.119,17.839 93.119,16.116 C93.119,14.212 93.516,12.580 94.309,11.220 C95.102,9.860 96.157,8.817 97.471,8.092 C98.808,7.344 100.281,6.970 101.891,6.970 C103.727,6.970 105.257,7.355 106.481,8.126 C107.728,8.897 108.668,9.951 109.303,11.288 C109.937,12.602 110.255,14.110 110.255,15.810 C110.255,16.104 110.232,16.456 110.187,16.864 C110.164,17.249 110.130,17.555 110.085,17.782 ZM104.951,13.430 C104.860,13.090 104.713,12.795 104.509,12.546 C104.328,12.274 104.112,12.047 103.863,11.866 C103.614,11.662 103.319,11.503 102.979,11.390 C102.661,11.276 102.299,11.220 101.891,11.220 C101.370,11.220 100.905,11.310 100.497,11.492 C100.089,11.673 99.749,11.922 99.477,12.240 C99.205,12.534 98.990,12.886 98.831,13.294 C98.695,13.679 98.593,14.076 98.525,14.484 L105.155,14.484 C105.110,14.121 105.041,13.770 104.951,13.430 ZM87.805,24.106 C86.559,24.854 85.108,25.228 83.454,25.228 C82.751,25.228 82.082,25.137 81.448,24.956 C80.835,24.775 80.269,24.514 79.747,24.174 C79.249,23.811 78.829,23.392 78.489,22.916 L78.387,22.916 L78.387,32.198 L73.117,32.198 L73.117,16.422 C73.117,14.518 73.503,12.852 74.274,11.424 C75.044,9.996 76.132,8.897 77.538,8.126 C78.942,7.355 80.586,6.970 82.467,6.970 C83.940,6.970 85.244,7.196 86.377,7.650 C87.533,8.103 88.508,8.760 89.301,9.622 C90.118,10.460 90.740,11.458 91.171,12.614 C91.602,13.770 91.817,15.028 91.817,16.388 C91.817,18.156 91.455,19.697 90.729,21.012 C90.027,22.326 89.052,23.358 87.805,24.106 ZM85.935,13.770 C85.618,13.067 85.165,12.523 84.576,12.138 C83.986,11.730 83.283,11.526 82.467,11.526 C81.651,11.526 80.938,11.730 80.326,12.138 C79.736,12.523 79.282,13.067 78.965,13.770 C78.648,14.450 78.489,15.221 78.489,16.082 C78.489,16.943 78.648,17.714 78.965,18.394 C79.282,19.074 79.736,19.618 80.326,20.026 C80.938,20.411 81.651,20.604 82.467,20.604 C83.283,20.604 83.986,20.411 84.576,20.026 C85.165,19.618 85.618,19.074 85.935,18.394 C86.275,17.714 86.445,16.943 86.445,16.082 C86.445,15.221 86.275,14.450 85.935,13.770 ZM65.039,14.688 C65.039,14.121 64.892,13.611 64.597,13.158 C64.325,12.682 63.951,12.297 63.475,12.002 C62.999,11.707 62.455,11.560 61.843,11.560 C61.231,11.560 60.676,11.707 60.177,12.002 C59.701,12.297 59.327,12.682 59.055,13.158 C58.783,13.611 58.647,14.121 58.647,14.688 L58.647,24.820 L53.377,24.820 L53.377,14.688 C53.377,14.121 53.230,13.611 52.935,13.158 C52.663,12.682 52.278,12.297 51.779,12.002 C51.303,11.707 50.759,11.560 50.147,11.560 C49.535,11.560 48.979,11.707 48.481,12.002 C48.005,12.297 47.631,12.682 47.359,13.158 C47.087,13.611 46.951,14.121 46.951,14.688 L46.951,24.820 L41.681,24.820 L41.681,14.518 C41.681,13.090 42.010,11.809 42.667,10.676 C43.347,9.520 44.311,8.613 45.557,7.956 C46.804,7.299 48.288,6.970 50.011,6.970 C50.873,6.970 51.666,7.072 52.391,7.276 C53.117,7.457 53.774,7.718 54.363,8.058 C54.975,8.375 55.497,8.760 55.927,9.214 L55.995,9.214 C56.448,8.760 56.970,8.375 57.559,8.058 C58.171,7.718 58.840,7.457 59.565,7.276 C60.313,7.072 61.118,6.970 61.979,6.970 C63.702,6.970 65.187,7.299 66.433,7.956 C67.680,8.613 68.643,9.520 69.323,10.676 C70.003,11.809 70.343,13.090 70.343,14.518 L70.343,24.820 L65.039,24.820 L65.039,14.688 ZM34.927,24.038 C33.499,24.831 31.901,25.228 30.133,25.228 C28.343,25.228 26.733,24.831 25.306,24.038 C23.877,23.244 22.744,22.156 21.906,20.774 C21.089,19.391 20.681,17.839 20.681,16.116 C20.681,14.370 21.089,12.818 21.906,11.458 C22.744,10.075 23.877,8.987 25.306,8.194 C26.733,7.378 28.343,6.970 30.133,6.970 C31.924,6.970 33.522,7.378 34.927,8.194 C36.356,8.987 37.478,10.075 38.293,11.458 C39.132,12.818 39.551,14.370 39.551,16.116 C39.551,17.839 39.132,19.391 38.293,20.774 C37.478,22.156 36.356,23.244 34.927,24.038 ZM33.738,13.804 C33.397,13.124 32.921,12.580 32.310,12.172 C31.698,11.764 30.972,11.560 30.133,11.560 C29.295,11.560 28.558,11.764 27.924,12.172 C27.312,12.580 26.835,13.124 26.495,13.804 C26.156,14.484 25.985,15.243 25.985,16.082 C25.985,16.943 26.156,17.714 26.495,18.394 C26.835,19.074 27.312,19.618 27.924,20.026 C28.558,20.434 29.295,20.638 30.133,20.638 C30.972,20.638 31.698,20.434 32.310,20.026 C32.921,19.618 33.397,19.074 33.738,18.394 C34.078,17.714 34.247,16.943 34.247,16.082 C34.247,15.243 34.078,14.484 33.738,13.804 ZM14.280,24.072 C12.875,24.842 11.231,25.228 9.350,25.228 C7.876,25.228 6.561,25.001 5.406,24.548 C4.272,24.094 3.298,23.449 2.482,22.610 C1.689,21.748 1.076,20.740 0.646,19.584 C0.215,18.428 0.000,17.170 0.000,15.810 C0.000,14.042 0.351,12.501 1.054,11.186 C1.779,9.871 2.765,8.840 4.012,8.092 C5.258,7.344 6.709,6.970 8.364,6.970 C9.067,6.970 9.724,7.061 10.336,7.242 C10.971,7.423 11.537,7.695 12.036,8.058 C12.557,8.398 12.988,8.806 13.328,9.282 L13.430,9.282 L13.430,-0.000 L18.700,-0.000 L18.700,15.776 C18.700,17.680 18.314,19.346 17.544,20.774 C16.773,22.202 15.686,23.301 14.280,24.072 ZM12.851,13.804 C12.534,13.124 12.070,12.591 11.458,12.206 C10.869,11.798 10.166,11.594 9.350,11.594 C8.534,11.594 7.831,11.798 7.242,12.206 C6.652,12.591 6.187,13.124 5.848,13.804 C5.530,14.484 5.372,15.254 5.372,16.116 C5.372,16.977 5.530,17.759 5.848,18.462 C6.187,19.142 6.652,19.686 7.242,20.094 C7.831,20.479 8.534,20.672 9.350,20.672 C10.166,20.672 10.869,20.479 11.458,20.094 C12.070,19.686 12.534,19.142 12.851,18.462 C13.169,17.759 13.328,16.977 13.328,16.116 C13.328,15.254 13.169,14.484 12.851,13.804 Z" />-->
				<!--</svg>-->
			</a>
			<div class="nav-control">
				<div class="hamburger">
					<span class="line"></span><span class="line"></span><span class="line"></span>
				</div>
			</div>
		</div>
		<!--**********************************
			  Nav header end
		  ***********************************-->



		<!--**********************************
			  Header start
		  ***********************************-->
		<div class="header">
			<div class="header-content">
				<nav class="navbar navbar-expand">
					<div class="collapse navbar-collapse justify-content-between">
						<div class="header-left">
							<div class="dashboard_bar">
								<!--<span class="font-w600 ">Hi,<b>{{ session('UserLogin2name') }}</b></span>-->
								<small class="text-end font-w400">Hi, {{ session('UserLogin2name') }}</small>
								<p class="font-w200 " style="font-size:18px">{{ \Carbon\Carbon::now()->format('l, F jS Y') }}</p>

							</div>
						</div>
						<ul class="navbar-nav header-right">
							<li class="nav-item">
								<button type="button" class="btn btn-outline-primary btn-icon-text" data-bs-toggle="modal" data-bs-target="#add_tax">

									Add Balance
								</button>
							</li>



						</ul>
					</div>
<style>
    .amount-bx {
       background-color: #e5effa !important;
    }
</style>
					<div class="card-body pb-3 transaction-details d-flex flex-wrap justify-content-between align-items-center">


						<div class="amount-bx mb-3">
							<i class="fas fa-inr" style="background: #17a2b8;
	  "></i>
							<div>
								<p class="mb-1">Wallet Amount</p>
								<h3 class="mb-0"></h3>
							</div>
						</div>

					</div>
				</nav>
			</div>
		</div>

		<div id="add_tax" class="modal custom-modal fade" role="dialog">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Add Money</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
					</div>
					<!-- <form class="contribution-form" id="contribution-form" method="POST" enctype="multipart/form-data" action="{{url('make-order')}}">@csrf -->

					<div class="text-center">
						<div class="row my-4">
							<div class="col-md-3 my-1">
								<p><strong>Amount</strong></p>
							</div>
							<div class="col-md-6">
								<input type="text" placeholder="₹" class="form-control" style="border-color:#33333373;border-radius:20px" value="500" name="amount" required="" id="plan">
								<!-- @error('amount') <font color="red">{{$massage}}</font> @enderror() -->
							</div>
							<div class="col-md-3"></div>
						</div>
						<!-- <div class="text-center my-3">
													  <a href="#" class="btn btn-success badge">500</a>
													  <a href="#" class="btn btn-success badge">1000</a>
													  <a href="#" class="btn btn-success badge">2000</a>
													  <a href="#" class="btn btn-success badge">5000</a>
												  </div> -->
						<button class="btn btn-primary badge pay_now" type="button">Recharge</button>
					</div>
					<!-- </form> -->
					<br><br>

				</div>
			</div>
		</div>


		<!--**********************************
			  Header end ti-comment-alt
		  ***********************************-->

		<!--**********************************
			  Sidebar start
		  ***********************************-->
		<div class="dlabnav">
			<div class="dlabnav-scroll">
				<ul class="metismenu" id="menu">
					<li class="dropdown header-profile">
						<a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
							<img src="{{asset('/Profiles/')}}/{{ session('UserLoginPic') }}" width="20" alt="">
							<div class="header-info ms-3">
								<span class="font-w600 ">Hi,<b>{{ session('UserLogin2name') }}</b></span>
								<!--<small class="text-end font-w400">{{ session('UserLogin2name') }}</small>-->
							</div>
						</a>

					</li>

					<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-025-dashboard"></i>
							<span class="nav-text">Dashboard</span>
						</a>
						<ul aria-expanded="false">

							<li><a href="{{ asset('/user-Home') }}">Dashboard</a></li>


						</ul>
					</li>
					<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-043-menu"></i>
							<span class="nav-text">Orders</span></a>
						<ul aria-expanded="false">
							<li><a href="{{ asset('/UPBulk_Order') }}">Create order</a></li>
							<li><a href="{{asset('/booked-order')}}">Shipment</a></li>
						</ul>
					</li>
					<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-022-copy"></i>
							<span class="nav-text">Reports</span>
						</a>
						<ul aria-expanded="false">
							<li><a href="{{asset('/UPMIS_Report')}}">MIS</a></li>
							<!--<li><a href="{{asset('/page-error-503')}}">Menifest<span class="badge badge-xs badge-success ms-3">Update</span></a></li>-->
							<li><a href="{{asset('/page-error-503')}}">NDR</a></li>
							<li><a href="{{ asset('/showordercounts') }}">Courier Wise Detail</a></li>
						</ul>
					</li>
					<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="fa-solid fa-house fw-bold"></i>
							<span class="nav-text">Hub</span>
						</a>
						<ul aria-expanded="false">
							<li><a href="{{ asset('/UPNew_Hub') }}">Add a hub</a></li>
							<li><a href="{{ asset('/UPAll_Hubs') }}">All hub</a></li>
						</ul>
					</li>
					<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="mdi mdi-file-document-box font-18 align-middle me-2"></i>
							<span class="nav-text">Billing</span>
						</a>
						<ul aria-expanded="false">
							<li><a href="{{ asset('/Wallet') }}">Billing</a></li>
							<!-- <li><a href="{{ asset('/UPAll_Hubs') }}">All hub</a></li> -->
						</ul>
					</li>
					<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-072-printer"></i>
							<span class="nav-text">Print</span>
						</a>
						<ul aria-expanded="false">
							<li><a href="{{ asset('/Label_Print') }}">Print shipping label</a></li>
						</ul>
					</li>
					<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-381-locations"></i>
							<span class="nav-text">Location</span>
						</a>
						<ul aria-expanded="false">
							<li><a href="#">Order Tracking</a></li>
						</ul>
					</li>
					<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="fa-solid fa-gear fw-bold"></i>
							<span class="nav-text">Settings</span>
							<!-- <span class="badge badge-xs badge-danger ms-3">New</span> -->
						</a>
						<ul aria-expanded="false">
							<li><a href="{{ asset('/setting') }}">Setting</a></li>

						</ul>

					</li>
					<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-381-turn-off"></i>
							<span class="nav-text">Power</span>
						</a>
						<ul aria-expanded="false">
							<li><a href="{{ asset('/Logout') }}">Sign out</a></li>
						</ul>
					</li>
				</ul>
				<div class="copyright">
					<!-- <p><strong>Shipnick</strong> © 2023 All Rights Reserved</p>
			  <p class="fs-12">Made with <span class="heart"></span> by Philon Technologies Pvt. Ltd.</p> -->
				</div>
			</div>
			@if(session()->has('message'))
			<div class="alert alert-success left-icon-big alert-dismissible fade show">
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i class="mdi mdi-btn-close"></i></span>
				</button>
				<div class="media">
					<div class="alert-left-icon-big">
						<span><i class="mdi mdi-check-circle-outline"></i></span>
					</div>
					<div class="media-body">
						<h5 class="mt-1 mb-2">successfully</h5>
						<p class="mb-0">{{ session()->get('message') }}</p>
					</div>
				</div>
			</div>

			@endif
		</div>

		<!--**********************************
			  Sidebar end
		  ***********************************-->
		<!--**********************************
            Content body start
        ***********************************-->
		<div class="content-body">
			<!-- row -->

			<div class="container-fluid">
				<div class="row invoice-card-row">
					<div class="col-md-12 mb-5 mt-5 ">
						<form class="rightcol" action="/new">
							<div class="collapsable" id="example4">
								<div class="row">
									<div class="col-4">
										<!-- <label>Produces:</label> -->
										<div id="reportrange" class="pull-right"
											style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
											<i class="fa fa-calendar"></i>&nbsp;
											<span></span> <i class="fa fa-caret-down"></i>
										</div>

										<input type="hidden" id="start_date" name="start_date" />
										<input type="hidden" id="end_date" name="end_date" />

										
									</div>
								</div>
							</div>
						</form>

					</div>
					<div class="col-xl-2 col-xxl-2 col-sm-6">
						<div class="card  invoice-card light-blue-bg ">
							<div class="card-body d-flex">
								<div class="icon me-3">
									<svg width="33px" height="32px">
										<path fill-rule="evenodd" fill="#0d111b" d="M31.963,30.931 C31.818,31.160 31.609,31.342 31.363,31.455 C31.175,31.538 30.972,31.582 30.767,31.583 C30.429,31.583 30.102,31.463 29.845,31.243 L25.802,27.786 L21.758,31.243 C21.502,31.463 21.175,31.583 20.837,31.583 C20.498,31.583 20.172,31.463 19.915,31.243 L15.872,27.786 L11.829,31.243 C11.622,31.420 11.370,31.534 11.101,31.572 C10.832,31.609 10.558,31.569 10.311,31.455 C10.065,31.342 9.857,31.160 9.710,30.931 C9.565,30.703 9.488,30.437 9.488,30.167 L9.488,17.416 L2.395,17.416 C2.019,17.416 1.658,17.267 1.392,17.001 C1.126,16.736 0.976,16.375 0.976,16.000 L0.976,6.083 C0.976,4.580 1.574,3.139 2.639,2.076 C3.703,1.014 5.146,0.417 6.651,0.417 L26.511,0.417 C28.016,0.417 29.459,1.014 30.524,2.076 C31.588,3.139 32.186,4.580 32.186,6.083 L32.186,30.167 C32.186,30.437 32.109,30.703 31.963,30.931 ZM9.488,6.083 C9.488,5.332 9.189,4.611 8.657,4.080 C8.125,3.548 7.403,3.250 6.651,3.250 C5.898,3.250 5.177,3.548 4.645,4.080 C4.113,4.611 3.814,5.332 3.814,6.083 L3.814,14.583 L9.488,14.583 L9.488,6.083 ZM29.348,6.083 C29.348,5.332 29.050,4.611 28.517,4.080 C27.985,3.548 27.263,3.250 26.511,3.250 L11.559,3.250 C12.059,4.111 12.324,5.088 12.325,6.083 L12.325,27.092 L14.950,24.840 C15.207,24.620 15.534,24.500 15.872,24.500 C16.210,24.500 16.537,24.620 16.794,24.840 L20.837,28.296 L24.880,24.840 C25.137,24.620 25.463,24.500 25.802,24.500 C26.140,24.500 26.467,24.620 26.724,24.840 L29.348,27.092 L29.348,6.083 ZM25.092,20.250 L16.581,20.250 C16.205,20.250 15.844,20.101 15.578,19.835 C15.312,19.569 15.162,19.209 15.162,18.833 C15.162,18.457 15.312,18.097 15.578,17.831 C15.844,17.566 16.205,17.416 16.581,17.416 L25.092,17.416 C25.469,17.416 25.829,17.566 26.096,17.831 C26.362,18.097 26.511,18.457 26.511,18.833 C26.511,19.209 26.362,19.569 26.096,19.835 C25.829,20.101 25.469,20.250 25.092,20.250 ZM25.092,14.583 L16.581,14.583 C16.205,14.583 15.844,14.434 15.578,14.168 C15.312,13.903 15.162,13.542 15.162,13.167 C15.162,12.791 15.312,12.430 15.578,12.165 C15.844,11.899 16.205,11.750 16.581,11.750 L25.092,11.750 C25.469,11.750 25.829,11.899 26.096,12.165 C26.362,12.430 26.511,12.791 26.511,13.167 C26.511,13.542 26.362,13.903 26.096,14.168 C25.829,14.434 25.469,14.583 25.092,14.583 ZM25.092,8.916 L16.581,8.916 C16.205,8.916 15.844,8.767 15.578,8.501 C15.312,8.236 15.162,7.875 15.162,7.500 C15.162,7.124 15.312,6.764 15.578,6.498 C15.844,6.232 16.205,6.083 16.581,6.083 L25.092,6.083 C25.469,6.083 25.829,6.232 26.096,6.498 C26.362,6.764 26.511,7.124 26.511,7.500 C26.511,7.875 26.362,8.236 26.096,8.501 C25.829,8.767 25.469,8.916 25.092,8.916 Z" />
									</svg>

								</div>
								<div>
									<h2 class="text-black invoice-num">{{$callcomplete}}</h2>

								</div>

							</div>
							<span class="text-black fs-18  mb-4 text-center"><b>Total orders</b> <br> </span>
						</div>
					</div>
					<div class="col-xl-2 col-xxl-2 col-sm-6">
						<div class="card  invoice-card light-grey-bg">
							<div class="card-body d-flex">
								<div class="icon me-3">
									<svg width="33px" height="32px">
										<path fill-rule="evenodd" fill="#0d111b" d="M31.963,30.931 C31.818,31.160 31.609,31.342 31.363,31.455 C31.175,31.538 30.972,31.582 30.767,31.583 C30.429,31.583 30.102,31.463 29.845,31.243 L25.802,27.786 L21.758,31.243 C21.502,31.463 21.175,31.583 20.837,31.583 C20.498,31.583 20.172,31.463 19.915,31.243 L15.872,27.786 L11.829,31.243 C11.622,31.420 11.370,31.534 11.101,31.572 C10.832,31.609 10.558,31.569 10.311,31.455 C10.065,31.342 9.857,31.160 9.710,30.931 C9.565,30.703 9.488,30.437 9.488,30.167 L9.488,17.416 L2.395,17.416 C2.019,17.416 1.658,17.267 1.392,17.001 C1.126,16.736 0.976,16.375 0.976,16.000 L0.976,6.083 C0.976,4.580 1.574,3.139 2.639,2.076 C3.703,1.014 5.146,0.417 6.651,0.417 L26.511,0.417 C28.016,0.417 29.459,1.014 30.524,2.076 C31.588,3.139 32.186,4.580 32.186,6.083 L32.186,30.167 C32.186,30.437 32.109,30.703 31.963,30.931 ZM9.488,6.083 C9.488,5.332 9.189,4.611 8.657,4.080 C8.125,3.548 7.403,3.250 6.651,3.250 C5.898,3.250 5.177,3.548 4.645,4.080 C4.113,4.611 3.814,5.332 3.814,6.083 L3.814,14.583 L9.488,14.583 L9.488,6.083 ZM29.348,6.083 C29.348,5.332 29.050,4.611 28.517,4.080 C27.985,3.548 27.263,3.250 26.511,3.250 L11.559,3.250 C12.059,4.111 12.324,5.088 12.325,6.083 L12.325,27.092 L14.950,24.840 C15.207,24.620 15.534,24.500 15.872,24.500 C16.210,24.500 16.537,24.620 16.794,24.840 L20.837,28.296 L24.880,24.840 C25.137,24.620 25.463,24.500 25.802,24.500 C26.140,24.500 26.467,24.620 26.724,24.840 L29.348,27.092 L29.348,6.083 ZM25.092,20.250 L16.581,20.250 C16.205,20.250 15.844,20.101 15.578,19.835 C15.312,19.569 15.162,19.209 15.162,18.833 C15.162,18.457 15.312,18.097 15.578,17.831 C15.844,17.566 16.205,17.416 16.581,17.416 L25.092,17.416 C25.469,17.416 25.829,17.566 26.096,17.831 C26.362,18.097 26.511,18.457 26.511,18.833 C26.511,19.209 26.362,19.569 26.096,19.835 C25.829,20.101 25.469,20.250 25.092,20.250 ZM25.092,14.583 L16.581,14.583 C16.205,14.583 15.844,14.434 15.578,14.168 C15.312,13.903 15.162,13.542 15.162,13.167 C15.162,12.791 15.312,12.430 15.578,12.165 C15.844,11.899 16.205,11.750 16.581,11.750 L25.092,11.750 C25.469,11.750 25.829,11.899 26.096,12.165 C26.362,12.430 26.511,12.791 26.511,13.167 C26.511,13.542 26.362,13.903 26.096,14.168 C25.829,14.434 25.469,14.583 25.092,14.583 ZM25.092,8.916 L16.581,8.916 C16.205,8.916 15.844,8.767 15.578,8.501 C15.312,8.236 15.162,7.875 15.162,7.500 C15.162,7.124 15.312,6.764 15.578,6.498 C15.844,6.232 16.205,6.083 16.581,6.083 L25.092,6.083 C25.469,6.083 25.829,6.232 26.096,6.498 C26.362,6.764 26.511,7.124 26.511,7.500 C26.511,7.875 26.362,8.236 26.096,8.501 C25.829,8.767 25.469,8.916 25.092,8.916 Z" />
									</svg>

								</div>
								<div>
									<h2 class="text-black invoice-num">{{$monthpickup}}</h2>

								</div>
							</div>
							<span class="text-black fs-18 mb-4 text-center"><b>Pending Pickups</b> <br></b></span>
						</div>
					</div>
					<div class="col-xl-2 col-xxl-2 col-sm-6">
						<div class="card  invoice-card light-yellow-bg">
							<div class="card-body d-flex">
								<div class="icon me-3">
									<svg width="35px" height="34px">
										<path fill-rule="evenodd" fill="#0d111b" d="M33.002,9.728 C31.612,6.787 29.411,4.316 26.638,2.583 C22.781,0.179 18.219,-0.584 13.784,0.438 C9.356,1.454 5.585,4.137 3.178,7.989 C0.764,11.840 -0.000,16.396 1.023,20.825 C2.048,25.247 4.734,29.013 8.584,31.417 C11.297,33.110 14.409,34.006 17.594,34.006 L17.800,34.006 C20.973,33.967 24.058,33.050 26.731,31.363 C27.509,30.872 27.735,29.849 27.243,29.072 C26.751,28.296 25.727,28.070 24.949,28.561 C22.801,29.922 20.314,30.660 17.761,30.693 C15.141,30.726 12.581,30.002 10.346,28.614 C7.241,26.675 5.080,23.647 4.262,20.088 C3.444,16.515 4.056,12.850 5.997,9.748 C10.001,3.353 18.473,1.401 24.876,5.399 C27.110,6.793 28.879,8.779 29.996,11.143 C31.087,13.447 31.513,16.004 31.227,18.527 C31.126,19.437 31.778,20.260 32.696,20.360 C33.607,20.459 34.432,19.809 34.531,18.892 C34.884,15.765 34.352,12.591 33.002,9.728 L33.002,9.728 Z" />
										<path fill-rule="evenodd" fill="#0d111b" d="M23.380,11.236 C22.728,10.585 21.678,10.585 21.026,11.236 L17.608,14.656 L14.190,11.243 C13.539,10.592 12.488,10.592 11.836,11.243 C11.184,11.893 11.184,12.942 11.836,13.593 L15.254,17.006 L11.836,20.420 C11.184,21.071 11.184,22.120 11.836,22.770 C12.162,23.096 12.588,23.255 13.014,23.255 C13.438,23.255 13.864,23.096 14.190,22.770 L17.608,19.357 L21.026,22.770 C21.352,23.096 21.777,23.255 22.203,23.255 C22.629,23.255 23.054,23.096 23.380,22.770 C24.031,22.120 24.031,21.071 23.380,20.420 L19.962,17.000 L23.380,13.587 C24.031,12.936 24.031,11.887 23.380,11.236 L23.380,11.236 Z" />
									</svg>

								</div>
								<div>
									<h2 class="text-black invoice-num">{{$callintransit}}</h2>

								</div>
							</div>
							<span class="text-black fs-18 mb-4 text-center"><b>In Transit</b> </br></span>
						</div>
					</div>
					<div class="col-xl-2 col-xxl-2 col-sm-6">
						<div class="card  invoice-card light-green-bg">
							<div class="card-body d-flex">
								<div class="icon me-3">
									<svg width="35px" height="34px">
										<path fill-rule="evenodd" fill="#0d111b" d="M32.482,9.730 C31.092,6.789 28.892,4.319 26.120,2.586 C22.265,0.183 17.698,-0.580 13.271,0.442 C8.843,1.458 5.074,4.140 2.668,7.990 C0.255,11.840 -0.509,16.394 0.514,20.822 C1.538,25.244 4.224,29.008 8.072,31.411 C10.785,33.104 13.896,34.000 17.080,34.000 L17.286,34.000 C20.456,33.960 23.541,33.044 26.213,31.358 C26.991,30.866 27.217,29.844 26.725,29.067 C26.234,28.291 25.210,28.065 24.432,28.556 C22.285,29.917 19.799,30.654 17.246,30.687 C14.627,30.720 12.067,29.997 9.834,28.609 C6.730,26.671 4.569,23.644 3.752,20.085 C2.934,16.527 3.546,12.863 5.486,9.763 C9.488,3.370 17.957,1.418 24.359,5.414 C26.592,6.808 28.360,8.793 29.477,11.157 C30.568,13.460 30.993,16.016 30.707,18.539 C30.607,19.448 31.259,20.271 32.177,20.371 C33.087,20.470 33.911,19.820 34.011,18.904 C34.363,15.764 33.832,12.591 32.482,9.730 L32.482,9.730 Z" />
										<path fill-rule="evenodd" fill="#0d111b" d="M22.593,11.237 L14.575,19.244 L11.604,16.277 C10.952,15.626 9.902,15.626 9.250,16.277 C8.599,16.927 8.599,17.976 9.250,18.627 L13.399,22.770 C13.725,23.095 14.150,23.254 14.575,23.254 C15.001,23.254 15.427,23.095 15.753,22.770 L24.940,13.588 C25.592,12.937 25.592,11.888 24.940,11.237 C24.289,10.593 23.238,10.593 22.593,11.237 L22.593,11.237 Z" />
									</svg>

								</div>
								<div>
									<h2 class="text-black invoice-num">{{$calldeliverd}}</h2>

								</div>
							</div>
							<span class="text-black fs-18 mb-4 text-center"><b>Delivered</b> <br></span>
						</div>
					</div>
					<div class="col-xl-2 col-xxl-2 col-sm-6">
						<div class="card  invoice-card light-pink-bg">
							<div class="card-body d-flex">
								<div class="icon me-3">
									<svg width="33px" height="32px">
										<path fill-rule="evenodd" fill="#0d111b" d="M31.963,30.931 C31.818,31.160 31.609,31.342 31.363,31.455 C31.175,31.538 30.972,31.582 30.767,31.583 C30.429,31.583 30.102,31.463 29.845,31.243 L25.802,27.786 L21.758,31.243 C21.502,31.463 21.175,31.583 20.837,31.583 C20.498,31.583 20.172,31.463 19.915,31.243 L15.872,27.786 L11.829,31.243 C11.622,31.420 11.370,31.534 11.101,31.572 C10.832,31.609 10.558,31.569 10.311,31.455 C10.065,31.342 9.857,31.160 9.710,30.931 C9.565,30.703 9.488,30.437 9.488,30.167 L9.488,17.416 L2.395,17.416 C2.019,17.416 1.658,17.267 1.392,17.001 C1.126,16.736 0.976,16.375 0.976,16.000 L0.976,6.083 C0.976,4.580 1.574,3.139 2.639,2.076 C3.703,1.014 5.146,0.417 6.651,0.417 L26.511,0.417 C28.016,0.417 29.459,1.014 30.524,2.076 C31.588,3.139 32.186,4.580 32.186,6.083 L32.186,30.167 C32.186,30.437 32.109,30.703 31.963,30.931 ZM9.488,6.083 C9.488,5.332 9.189,4.611 8.657,4.080 C8.125,3.548 7.403,3.250 6.651,3.250 C5.898,3.250 5.177,3.548 4.645,4.080 C4.113,4.611 3.814,5.332 3.814,6.083 L3.814,14.583 L9.488,14.583 L9.488,6.083 ZM29.348,6.083 C29.348,5.332 29.050,4.611 28.517,4.080 C27.985,3.548 27.263,3.250 26.511,3.250 L11.559,3.250 C12.059,4.111 12.324,5.088 12.325,6.083 L12.325,27.092 L14.950,24.840 C15.207,24.620 15.534,24.500 15.872,24.500 C16.210,24.500 16.537,24.620 16.794,24.840 L20.837,28.296 L24.880,24.840 C25.137,24.620 25.463,24.500 25.802,24.500 C26.140,24.500 26.467,24.620 26.724,24.840 L29.348,27.092 L29.348,6.083 ZM25.092,20.250 L16.581,20.250 C16.205,20.250 15.844,20.101 15.578,19.835 C15.312,19.569 15.162,19.209 15.162,18.833 C15.162,18.457 15.312,18.097 15.578,17.831 C15.844,17.566 16.205,17.416 16.581,17.416 L25.092,17.416 C25.469,17.416 25.829,17.566 26.096,17.831 C26.362,18.097 26.511,18.457 26.511,18.833 C26.511,19.209 26.362,19.569 26.096,19.835 C25.829,20.101 25.469,20.250 25.092,20.250 ZM25.092,14.583 L16.581,14.583 C16.205,14.583 15.844,14.434 15.578,14.168 C15.312,13.903 15.162,13.542 15.162,13.167 C15.162,12.791 15.312,12.430 15.578,12.165 C15.844,11.899 16.205,11.750 16.581,11.750 L25.092,11.750 C25.469,11.750 25.829,11.899 26.096,12.165 C26.362,12.430 26.511,12.791 26.511,13.167 C26.511,13.542 26.362,13.903 26.096,14.168 C25.829,14.434 25.469,14.583 25.092,14.583 ZM25.092,8.916 L16.581,8.916 C16.205,8.916 15.844,8.767 15.578,8.501 C15.312,8.236 15.162,7.875 15.162,7.500 C15.162,7.124 15.312,6.764 15.578,6.498 C15.844,6.232 16.205,6.083 16.581,6.083 L25.092,6.083 C25.469,6.083 25.829,6.232 26.096,6.498 C26.362,6.764 26.511,7.124 26.511,7.500 C26.511,7.875 26.362,8.236 26.096,8.501 C25.829,8.767 25.469,8.916 25.092,8.916 Z" />
									</svg>

								</div>
								<div>
									<h2 class="text-black invoice-num">{{$monthndr}}</h2>

								</div>
							</div>
							<span class="text-black fs-18 mb-4 text-center"><b>NDR</b> <br></b></span>
						</div>
					</div>

					<div class="col-xl-2 col-xxl-2 col-sm-6">
						<div class="card  invoice-card light-yellow-bg">
							<div class="card-body d-flex">
								<div class="icon me-3">
									<svg width="33px" height="32px">
										<path fill-rule="evenodd" fill="#0d111b" d="M31.963,30.931 C31.818,31.160 31.609,31.342 31.363,31.455 C31.175,31.538 30.972,31.582 30.767,31.583 C30.429,31.583 30.102,31.463 29.845,31.243 L25.802,27.786 L21.758,31.243 C21.502,31.463 21.175,31.583 20.837,31.583 C20.498,31.583 20.172,31.463 19.915,31.243 L15.872,27.786 L11.829,31.243 C11.622,31.420 11.370,31.534 11.101,31.572 C10.832,31.609 10.558,31.569 10.311,31.455 C10.065,31.342 9.857,31.160 9.710,30.931 C9.565,30.703 9.488,30.437 9.488,30.167 L9.488,17.416 L2.395,17.416 C2.019,17.416 1.658,17.267 1.392,17.001 C1.126,16.736 0.976,16.375 0.976,16.000 L0.976,6.083 C0.976,4.580 1.574,3.139 2.639,2.076 C3.703,1.014 5.146,0.417 6.651,0.417 L26.511,0.417 C28.016,0.417 29.459,1.014 30.524,2.076 C31.588,3.139 32.186,4.580 32.186,6.083 L32.186,30.167 C32.186,30.437 32.109,30.703 31.963,30.931 ZM9.488,6.083 C9.488,5.332 9.189,4.611 8.657,4.080 C8.125,3.548 7.403,3.250 6.651,3.250 C5.898,3.250 5.177,3.548 4.645,4.080 C4.113,4.611 3.814,5.332 3.814,6.083 L3.814,14.583 L9.488,14.583 L9.488,6.083 ZM29.348,6.083 C29.348,5.332 29.050,4.611 28.517,4.080 C27.985,3.548 27.263,3.250 26.511,3.250 L11.559,3.250 C12.059,4.111 12.324,5.088 12.325,6.083 L12.325,27.092 L14.950,24.840 C15.207,24.620 15.534,24.500 15.872,24.500 C16.210,24.500 16.537,24.620 16.794,24.840 L20.837,28.296 L24.880,24.840 C25.137,24.620 25.463,24.500 25.802,24.500 C26.140,24.500 26.467,24.620 26.724,24.840 L29.348,27.092 L29.348,6.083 ZM25.092,20.250 L16.581,20.250 C16.205,20.250 15.844,20.101 15.578,19.835 C15.312,19.569 15.162,19.209 15.162,18.833 C15.162,18.457 15.312,18.097 15.578,17.831 C15.844,17.566 16.205,17.416 16.581,17.416 L25.092,17.416 C25.469,17.416 25.829,17.566 26.096,17.831 C26.362,18.097 26.511,18.457 26.511,18.833 C26.511,19.209 26.362,19.569 26.096,19.835 C25.829,20.101 25.469,20.250 25.092,20.250 ZM25.092,14.583 L16.581,14.583 C16.205,14.583 15.844,14.434 15.578,14.168 C15.312,13.903 15.162,13.542 15.162,13.167 C15.162,12.791 15.312,12.430 15.578,12.165 C15.844,11.899 16.205,11.750 16.581,11.750 L25.092,11.750 C25.469,11.750 25.829,11.899 26.096,12.165 C26.362,12.430 26.511,12.791 26.511,13.167 C26.511,13.542 26.362,13.903 26.096,14.168 C25.829,14.434 25.469,14.583 25.092,14.583 ZM25.092,8.916 L16.581,8.916 C16.205,8.916 15.844,8.767 15.578,8.501 C15.312,8.236 15.162,7.875 15.162,7.500 C15.162,7.124 15.312,6.764 15.578,6.498 C15.844,6.232 16.205,6.083 16.581,6.083 L25.092,6.083 C25.469,6.083 25.829,6.232 26.096,6.498 C26.362,6.764 26.511,7.124 26.511,7.500 C26.511,7.875 26.362,8.236 26.096,8.501 C25.829,8.767 25.469,8.916 25.092,8.916 Z" />
									</svg>

								</div>
								<div>
									<h2 class="text-black invoice-num">{{$callretrun}}</h2>

								</div>
							</div>
							<span class="text-black fs-18 mb-4 text-center"><b> RTO </b><br></b></span>
						</div>
					</div>


				</div>
				<div class="row">
					<div class="col-xl-9 col-xxl-12">
						<div class="card">
							<div class="card-body">
								<div class="row align-items-center">

									<div class="col-xl-12">
										<div class="row align-items-center  mt-xl-0 mt-4">
											<div class="col-md-6">
												<h4 class="card-title">Today's Overview</h4>
												<!--<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit psu olor</span>-->
												<ul class="card-list mt-4">
													<li><span class="bg-blue circle"></span>COD<span>{{$codPercentage}}%</span></li>
													<li><span class="bg-success circle"></span>Prepaid<span>{{$prepaidPercentage}} %</span></li>
													<!--<li><span class="bg-warning circle"></span>In Transit<span>15%</span></li>-->
													<!--<li><span class="bg-light circle"></span>Others<span>15%</span></li>-->
												</ul>
											</div>
											<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
											<div class="col-md-6" style="height:200px">
												<canvas id="pieChart"></canvas>
											</div>

											<script>
												// Get the canvas element by its id
												var canvas = document.getElementById('pieChart');

												// Create an initial data object for the pie chart
												var data = {
													labels: ['COD', 'Prepaid'],
													datasets: [{
														label: 'Dataset 1',
														data: [{
															{
																$codPercentage
															}
														}, {
															{
																$prepaidPercentage
															}
														}], // Pass percentages directly
														backgroundColor: ['blue', 'green'],
													}]
												};

												// Create configuration options for the pie chart
												var options = {
													responsive: true,
													maintainAspectRatio: false,
												};

												// Create a new pie chart instance
												var pieChart = new Chart(canvas, {
													type: 'pie', // Change chart type to pie
													data: data,
													options: options
												});
											</script>


										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="container-fluid">
				<div class="row ">

					<div class="col-xl-4 col-xxl-4 col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="card  invoice-card" style="background-color: #4d81cc">
							<div class="card-body d-flex">
								<div class="icon me-3">
									<svg width="33px" height="32px">
										<path fill-rule="evenodd" fill="rgb(1, 0, 0)"
											d="M31.963,30.931 C31.818,31.160 31.609,31.342 31.363,31.455 C31.175,31.538 30.972,31.582 30.767,31.583 C30.429,31.583 30.102,31.463 29.845,31.243 L25.802,27.786 L21.758,31.243 C21.502,31.463 21.175,31.583 20.837,31.583 C20.498,31.583 20.172,31.463 19.915,31.243 L15.872,27.786 L11.829,31.243 C11.622,31.420 11.370,31.534 11.101,31.572 C10.832,31.609 10.558,31.569 10.311,31.455 C10.065,31.342 9.857,31.160 9.710,30.931 C9.565,30.703 9.488,30.437 9.488,30.167 L9.488,17.416 L2.395,17.416 C2.019,17.416 1.658,17.267 1.392,17.001 C1.126,16.736 0.976,16.375 0.976,16.000 L0.976,6.083 C0.976,4.580 1.574,3.139 2.639,2.076 C3.703,1.014 5.146,0.417 6.651,0.417 L26.511,0.417 C28.016,0.417 29.459,1.014 30.524,2.076 C31.588,3.139 32.186,4.580 32.186,6.083 L32.186,30.167 C32.186,30.437 32.109,30.703 31.963,30.931 ZM9.488,6.083 C9.488,5.332 9.189,4.611 8.657,4.080 C8.125,3.548 7.403,3.250 6.651,3.250 C5.898,3.250 5.177,3.548 4.645,4.080 C4.113,4.611 3.814,5.332 3.814,6.083 L3.814,14.583 L9.488,14.583 L9.488,6.083 ZM29.348,6.083 C29.348,5.332 29.050,4.611 28.517,4.080 C27.985,3.548 27.263,3.250 26.511,3.250 L11.559,3.250 C12.059,4.111 12.324,5.088 12.325,6.083 L12.325,27.092 L14.950,24.840 C15.207,24.620 15.534,24.500 15.872,24.500 C16.210,24.500 16.537,24.620 16.794,24.840 L20.837,28.296 L24.880,24.840 C25.137,24.620 25.463,24.500 25.802,24.500 C26.140,24.500 26.467,24.620 26.724,24.840 L29.348,27.092 L29.348,6.083 ZM25.092,20.250 L16.581,20.250 C16.205,20.250 15.844,20.101 15.578,19.835 C15.312,19.569 15.162,19.209 15.162,18.833 C15.162,18.457 15.312,18.097 15.578,17.831 C15.844,17.566 16.205,17.416 16.581,17.416 L25.092,17.416 C25.469,17.416 25.829,17.566 26.096,17.831 C26.362,18.097 26.511,18.457 26.511,18.833 C26.511,19.209 26.362,19.569 26.096,19.835 C25.829,20.101 25.469,20.250 25.092,20.250 ZM25.092,14.583 L16.581,14.583 C16.205,14.583 15.844,14.434 15.578,14.168 C15.312,13.903 15.162,13.542 15.162,13.167 C15.162,12.791 15.312,12.430 15.578,12.165 C15.844,11.899 16.205,11.750 16.581,11.750 L25.092,11.750 C25.469,11.750 25.829,11.899 26.096,12.165 C26.362,12.430 26.511,12.791 26.511,13.167 C26.511,13.542 26.362,13.903 26.096,14.168 C25.829,14.434 25.469,14.583 25.092,14.583 ZM25.092,8.916 L16.581,8.916 C16.205,8.916 15.844,8.767 15.578,8.501 C15.312,8.236 15.162,7.875 15.162,7.500 C15.162,7.124 15.312,6.764 15.578,6.498 C15.844,6.232 16.205,6.083 16.581,6.083 L25.092,6.083 C25.469,6.083 25.829,6.232 26.096,6.498 C26.362,6.764 26.511,7.124 26.511,7.500 C26.511,7.875 26.362,8.236 26.096,8.501 C25.829,8.767 25.469,8.916 25.092,8.916 Z" />
									</svg>

								</div>
								<div>
									<h2 class="text-black invoice-num">{{ $talluploaded }}</h2>
									<span class="text-black fs-18">Today's Bookings</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-8 col-xxl-8 col-lg-6 col-md-6 col-sm-12 col-xs-12">

						<div class="card" style="background-color: #4d81cc">
							<div class="card-header border-0 pb-0 d-sm-flex flex-wrap d-block">
								<div class="">
									<h4 class="card-title ">Shipment</h4>
								</div>

							</div>
							<div class="card-body tab-content orders-summary pt-3">
								<div class="tab-pane fade show active" id="Monthly">

									<div class="row text-center">
										<div class="col-sm-2 ">
											<div class="border border-3 px-1 py-2 rounded-xl bg-white">
												<h2 class="fs-32 font-w600 counter">{{ $talluploaded }}</h2>

											</div>
											<p class="fs-16 mb-0 text-white">Booked</p>
										</div>
										<div class="col-sm-2 ">
											<div class="border border-3 px-1 py-2 rounded-xl bg-white">
												<h2 class="fs-32 font-w600 counter">{{$tallpending}}</h2>

											</div>
											<p class="fs-16 mb-0 text-white">Pickup Pending</p>

										</div>
										<div class="col-sm-2 ">
											<div class="border border-3 px-1 py-2 rounded-xl bg-white">
												<h2 class="fs-32 font-w600 counter">{{ $intransitupload }}</h2>

											</div>
											<p class="fs-16 mb-0 text-white">In-transit</p>
										</div>
										<div class="col-sm-2 mb-4">
											<div class="border border-3 px-1 py-2 rounded-xl bg-white">
												<h2 class="fs-32 font-w600 counter">{{ $tallcomplete }}</h2>

											</div>
											<p class="fs-16 mb-0 text-white">Delivered</p>
										</div>
										<div class="col-sm-2 ">
											<div class="border border-3 px-1 py-2 rounded-xl bg-white">
												<h2 class="fs-32 font-w600 counter">{{$tallndr}}</h2>

											</div>
											<p class="fs-16 mb-0 text-white">NDR Pending</p>
										</div>
										<div class="col-sm-2">
											<div class="border border-3 px-1 py-2 rounded-xl bg-white">
												<h2 class="fs-32 font-w600 counter">{{ $tallcancel }}</h2>

											</div>
											<p class="fs-16 mb-0 text-white">RTO</p>
										</div>
									</div>

								</div>

							</div>
						</div>

					</div>
					<div class="col-xl-4 col-xxl-4 col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="card  invoice-card" style="background-color: #457B9D">
							<div class="card-body d-flex">
								<div class="icon me-3">
									<svg width="35px" height="34px">
										<path fill-rule="evenodd" fill="rgb(1, 0, 0)"
											d="M33.002,9.728 C31.612,6.787 29.411,4.316 26.638,2.583 C22.781,0.179 18.219,-0.584 13.784,0.438 C9.356,1.454 5.585,4.137 3.178,7.989 C0.764,11.840 -0.000,16.396 1.023,20.825 C2.048,25.247 4.734,29.013 8.584,31.417 C11.297,33.110 14.409,34.006 17.594,34.006 L17.800,34.006 C20.973,33.967 24.058,33.050 26.731,31.363 C27.509,30.872 27.735,29.849 27.243,29.072 C26.751,28.296 25.727,28.070 24.949,28.561 C22.801,29.922 20.314,30.660 17.761,30.693 C15.141,30.726 12.581,30.002 10.346,28.614 C7.241,26.675 5.080,23.647 4.262,20.088 C3.444,16.515 4.056,12.850 5.997,9.748 C10.001,3.353 18.473,1.401 24.876,5.399 C27.110,6.793 28.879,8.779 29.996,11.143 C31.087,13.447 31.513,16.004 31.227,18.527 C31.126,19.437 31.778,20.260 32.696,20.360 C33.607,20.459 34.432,19.809 34.531,18.892 C34.884,15.765 34.352,12.591 33.002,9.728 L33.002,9.728 Z" />
										<path fill-rule="evenodd" fill="rgb(1, 0, 0)"
											d="M23.380,11.236 C22.728,10.585 21.678,10.585 21.026,11.236 L17.608,14.656 L14.190,11.243 C13.539,10.592 12.488,10.592 11.836,11.243 C11.184,11.893 11.184,12.942 11.836,13.593 L15.254,17.006 L11.836,20.420 C11.184,21.071 11.184,22.120 11.836,22.770 C12.162,23.096 12.588,23.255 13.014,23.255 C13.438,23.255 13.864,23.096 14.190,22.770 L17.608,19.357 L21.026,22.770 C21.352,23.096 21.777,23.255 22.203,23.255 C22.629,23.255 23.054,23.096 23.380,22.770 C24.031,22.120 24.031,21.071 23.380,20.420 L19.962,17.000 L23.380,13.587 C24.031,12.936 24.031,11.887 23.380,11.236 L23.380,11.236 Z" />
									</svg>

								</div>
								<div>
									<h2 class="text-black invoice-num">{{ $tallcomplete }}</h2>
									<span class="text-black fs-18">Delivered Orders</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-8 col-xxl-8 col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
						<div class="card" style="background-color: #457B9D;">
							<div class="card-header border-0 pb-0 d-sm-flex flex-wrap d-block">
								<div class="">
									<h4 class="card-title ">NDR</h4>
								</div>

							</div>
							<div class="card-body tab-content orders-summary pt-3">
								<div class="tab-pane fade show active" id="Monthly">

									<div class="row text-center">
										<div class="col-sm-3 ">
											<div class="border border-3 px-3 py-2 rounded-xl bg-white">
												<h2 class="fs-32 font-w600 counter">{{$tallndr}}</h2>

											</div>
											<p class="fs-16 mb-0 text-white">Total NDR</p>
										</div>
										<div class="col-sm-3 ">
											<div class="border border-3 px-3 py-2 rounded-xl bg-white">
												<h2 class="fs-32 font-w600 counter">0</h2>

											</div>
											<p class="fs-16 mb-0 text-white">Reattempt Request</p>
										</div>
										<div class="col-sm-3 ">
											<div class="border border-3 px-3 py-2 rounded-xl bg-white">
												<h2 class="fs-32 font-w600 counter">0</h2>

											</div>
											<p class="fs-16 mb-0 text-white">Buyer Reattempt Request</p>
										</div>
										<div class="col-sm-3 ">
											<div class="border border-3 px-3 py-2 rounded-xl bg-white">
												<h2 class="fs-32 font-w600 counter">0</h2>

											</div>
											<p class="fs-16 mb-0 text-white">NDR Delivered</p>
										</div>
									</div>

								</div>

							</div>
						</div>
					</div>
					<div class="col-xl-4 col-xxl-4 col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="card  invoice-card" style="background-color: #A8DADC">
							<div class="card-body d-flex">
								<div class="icon me-3">
									<svg width="33px" height="32px">
										<path fill-rule="evenodd" fill="rgb(1, 0, 0)"
											d="M31.963,30.931 C31.818,31.160 31.609,31.342 31.363,31.455 C31.175,31.538 30.972,31.582 30.767,31.583 C30.429,31.583 30.102,31.463 29.845,31.243 L25.802,27.786 L21.758,31.243 C21.502,31.463 21.175,31.583 20.837,31.583 C20.498,31.583 20.172,31.463 19.915,31.243 L15.872,27.786 L11.829,31.243 C11.622,31.420 11.370,31.534 11.101,31.572 C10.832,31.609 10.558,31.569 10.311,31.455 C10.065,31.342 9.857,31.160 9.710,30.931 C9.565,30.703 9.488,30.437 9.488,30.167 L9.488,17.416 L2.395,17.416 C2.019,17.416 1.658,17.267 1.392,17.001 C1.126,16.736 0.976,16.375 0.976,16.000 L0.976,6.083 C0.976,4.580 1.574,3.139 2.639,2.076 C3.703,1.014 5.146,0.417 6.651,0.417 L26.511,0.417 C28.016,0.417 29.459,1.014 30.524,2.076 C31.588,3.139 32.186,4.580 32.186,6.083 L32.186,30.167 C32.186,30.437 32.109,30.703 31.963,30.931 ZM9.488,6.083 C9.488,5.332 9.189,4.611 8.657,4.080 C8.125,3.548 7.403,3.250 6.651,3.250 C5.898,3.250 5.177,3.548 4.645,4.080 C4.113,4.611 3.814,5.332 3.814,6.083 L3.814,14.583 L9.488,14.583 L9.488,6.083 ZM29.348,6.083 C29.348,5.332 29.050,4.611 28.517,4.080 C27.985,3.548 27.263,3.250 26.511,3.250 L11.559,3.250 C12.059,4.111 12.324,5.088 12.325,6.083 L12.325,27.092 L14.950,24.840 C15.207,24.620 15.534,24.500 15.872,24.500 C16.210,24.500 16.537,24.620 16.794,24.840 L20.837,28.296 L24.880,24.840 C25.137,24.620 25.463,24.500 25.802,24.500 C26.140,24.500 26.467,24.620 26.724,24.840 L29.348,27.092 L29.348,6.083 ZM25.092,20.250 L16.581,20.250 C16.205,20.250 15.844,20.101 15.578,19.835 C15.312,19.569 15.162,19.209 15.162,18.833 C15.162,18.457 15.312,18.097 15.578,17.831 C15.844,17.566 16.205,17.416 16.581,17.416 L25.092,17.416 C25.469,17.416 25.829,17.566 26.096,17.831 C26.362,18.097 26.511,18.457 26.511,18.833 C26.511,19.209 26.362,19.569 26.096,19.835 C25.829,20.101 25.469,20.250 25.092,20.250 ZM25.092,14.583 L16.581,14.583 C16.205,14.583 15.844,14.434 15.578,14.168 C15.312,13.903 15.162,13.542 15.162,13.167 C15.162,12.791 15.312,12.430 15.578,12.165 C15.844,11.899 16.205,11.750 16.581,11.750 L25.092,11.750 C25.469,11.750 25.829,11.899 26.096,12.165 C26.362,12.430 26.511,12.791 26.511,13.167 C26.511,13.542 26.362,13.903 26.096,14.168 C25.829,14.434 25.469,14.583 25.092,14.583 ZM25.092,8.916 L16.581,8.916 C16.205,8.916 15.844,8.767 15.578,8.501 C15.312,8.236 15.162,7.875 15.162,7.500 C15.162,7.124 15.312,6.764 15.578,6.498 C15.844,6.232 16.205,6.083 16.581,6.083 L25.092,6.083 C25.469,6.083 25.829,6.232 26.096,6.498 C26.362,6.764 26.511,7.124 26.511,7.500 C26.511,7.875 26.362,8.236 26.096,8.501 C25.829,8.767 25.469,8.916 25.092,8.916 Z" />
									</svg>

								</div>
								<div>
									<h2 class="text-black invoice-num">{{ $codamount }}</h2>
									<span class="text-black fs-18">COD Amount</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-8 col-xxl-8 col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="card" style="background-color: #A8DADC;">
							<div class="card-header border-0 pb-0 d-sm-flex flex-wrap d-block">
								<div class="">
									<h4 class="card-title ">COD</h4>
								</div>
							</div>
							<div class="card-body tab-content orders-summary pt-3">
								<div class="tab-pane fade show active" id="Monthly">

									<div class="row text-center">
										<div class="col-sm-3 ">
											<div class="border border-3 px-3 py-2 rounded-xl bg-white">
												<h2 class="fs-32 font-w600 counter">0</h2>

											</div>
											<p class="fs-16 mb-0 text-white">Total COD (30 days)</p>
										</div>
										<div class="col-sm-3 ">
											<div class="border border-3 px-3 py-2 rounded-xl bg-white">
												<h2 class="fs-32 font-w600 counter">0</h2>

											</div>
											<p class="fs-16 mb-0 text-white">COD Available</p>
										</div>
										<div class="col-sm-3 ">
											<div class="border border-3 px-3 py-2 rounded-xl bg-white">
												<h2 class="fs-32 font-w600 counter">0</h2>

											</div>
											<p class="fs-16 mb-0 text-white">COD Pending</p>
										</div>
										<div class="col-sm-3">
											<div class="border border-3 px-3 py-2 rounded-xl bg-white">
												<h2 class="fs-32 font-w600 counter">0</h2>

											</div>
											<p class="fs-16 mb-0 text-white">Last COD Remitted</p>
										</div>
									</div>

								</div>

							</div>
						</div>
					</div>
					<style>
						.newtd {

							padding: 0px 0px;
							font-weight: 600;
							border-bottom: 0;
							color: black;
						}
					</style>
					<div class="row">
						
						<div class="col-lg-12">
							<div class="card">
								<div class="card-header light-blue-bg">
									<h4 class="card-title">Courier Summary</h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-bordered table-striped verticle-middle table-responsive-sm">
											<thead>
												<tr>
													<!-- <th style="width:80px;"><strong>#</strong></th> -->
													<th><strong>Courier Name</strong></th>
													<th><strong>Total Shipments</strong></th>
													<th><strong>Pending Pickups</strong></th>
													<th><strong>In-Transit</strong></th>
													<th><strong>OFD</strong></th>
													<th><strong>Delivered</strong></th>
													<th><strong>RTO</strong></th>
												</tr>
											</thead>
											<tbody>

												<td><strong>Ecom</strong></td>
												@php
												$total1 = $data1['Bluedartcount'];
												$delivered1 = $data1['DeliveredBluedartcount'];
												$percentage1 = $total1 > 0 ? ($delivered1 / $total1) * 100 : 0;
												@endphp

												<td style="color:black">{{ $data1['Bluedartcount'] }}</td>
												<td style="color:black">{{ $data1['pendingBluedartcount'] }}</td>
												<td style="color:black">{{ $data1['inTransitBluedartcount'] }}</td>
												<td style="color:black">{{ $data1['OfdBluedartcount'] }}</td>
												<td style="color:black">{{ $data1['DeliveredBluedartcount'] }} &nbsp; &nbsp; &nbsp; ({{ number_format($percentage1, 2) }}%)</td>
												<td style="color:black">{{ $data1['RtoBluedartcount'] }}</td>
												<!-- Add other status types here in similar fashion -->
												</tr>

												</tr>
												@php
												$total = $data2['Bluedartcount'];
												$delivered = $data2['DeliveredBluedartcount'];
												$percentage = $total > 0 ? ($delivered / $total) * 100 : 0;
												@endphp

												<tr>
													<td><strong>Xpressbee</strong></td>
													<td style="color:black">{{ $data2['Bluedartcount'] }}</td>
													<td style="color:black">{{ $data2['pendingBluedartcount'] }}</td>
													<td style="color:black">{{ $data2['inTransitBluedartcount'] }}</td>
													<td style="color:black">{{ $data2['OfdBluedartcount'] }}</td>
													<td style="color:black">{{ $data2['DeliveredBluedartcount'] }}&nbsp; &nbsp; &nbsp; ({{ number_format($percentage, 2) }}%)</td>
													<td style="color:black">{{ $data2['RtoBluedartcount'] }}</td>




												</tr>
												<!--<tr>-->
												<!--	<td><strong>Shiprocket</strong></td>-->
												<!--	<td>0</td>-->
												<!--	<td>0</td>-->
												<!--	<td>0</td>-->
												<!--	<td>0</td>-->
												<!--	<td>0</td>-->
												<!--	<td>0</td>-->

												<!--</tr>-->
												@php
												$total = $data3['Bluedartcount'];
												$delivered = $data3['DeliveredBluedartcount'];
												$percentage3 = $total > 0 ? ($delivered / $total) * 100 : 0;
												@endphp
												<tr>
													<td><strong>Bluedart</strong></td>
													<td style="color:black">{{ $data3['Bluedartcount'] }}</td>
													<td style="color:black">{{ $data3['pendingBluedartcount'] }}</td>
													<td style="color:black">{{ $data3['inTransitBluedartcount'] }}</td>
													<td style="color:black">{{ $data3['OfdBluedartcount'] }}</td>
													<td style="color:black">{{ $data3['DeliveredBluedartcount'] }} &nbsp; &nbsp; &nbsp; ({{ number_format($percentage3, 2) }}%)</td>
													<td style="color:black">{{ $data3['RtoBluedartcount'] }}</td>
												</tr>

											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>



				</div>
			</div>
		</div>
		<!--**********************************
            Content body end
        ***********************************-->



		<!--**********************************
            Footer start
        ***********************************-->
		<div class="footer">

			<div class="copyright">
				<p>Copyright © Shipnick.com. Designed &amp; Developed by <a href="https://philontechnologies.com/" target="_blank">Philon Technologies Pvt. Ltd.</a> 2023</p>
			</div>
		</div>
		<!--**********************************
            Footer end
        ***********************************-->




	</div>
	<!--**********************************
        Main wrapper end
    ***********************************-->

	<!--**********************************
        Scripts
    ***********************************-->
	<!-- Required vendors -->
	<!-- <script src="{{asset('newtheme/vendor/global/global.min.js')}}"></script> -->
	<script src="{{asset('newtheme/vendor/chart-js/chart.bundle.min.js')}}"></script>
	<script src="{{asset('newtheme/vendor/jquery-nice-select/js/jquery.nice-select.min.js')}}"></script>

	<!-- Apex Chart -->
	<script src="{{asset('newtheme/vendor/apexchart/apexchart.js')}}"></script>
	<script src="{{asset('newtheme/./vendor/nouislider/nouislider.min.js')}}"></script>
	<script src="{{asset('newtheme/./vendor/wnumb/wNumb.js')}}"></script>

	<!-- Chart piety plugin files -->
	<script src="{{asset('newtheme/vendor/peity/jquery.peity.min.js')}}"></script>

	<script src="{{asset('newtheme/vendor/swiper/js/swiper-bundle.min.js')}}"></script>

	<!-- Dashboard 1 -->
	<script src="{{asset('newtheme/js/dashboard/dashboard-5.js')}}"></script>

	<script src="{{asset('newtheme/js/custom.min.js')}}"></script>
	<script src="{{asset('newtheme/js/dlabnav-init.js')}}"></script>

	<script type="text/javascript">
		$(function() {
			var start = moment();
			var end = moment();

			// Function to update the display
			function cb(start, end) {
				$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
				$('#start_date').val(start.format('YYYY-MM-DD'));
				$('#end_date').val(end.format('YYYY-MM-DD'));
			}

			// Initialize the date range picker
			$('#reportrange').daterangepicker({
				startDate: start,
				endDate: end,
				ranges: {
					'Today': [moment(), moment()],
					'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
					'Last 7 Days': [moment().subtract(6, 'days'), moment()],
					'Last 30 Days': [moment().subtract(29, 'days'), moment()],
					'This Month': [moment().startOf('month'), moment().endOf('month')],
					'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
				}
			}, cb);

			// Show only today's date initially
			cb(start, end);

			// Handle the selection change
			$('#reportrange').on('apply.daterangepicker', function(ev, picker) {
				// Only hit the URL if the selected range is different from today
				if (!picker.startDate.isSame(moment(), 'day') || !picker.endDate.isSame(moment(), 'day')) {
					var url = "{{ url('user-Home') }}?start_date=" + picker.startDate.format('YYYY-MM-DD') + "&end_date=" + picker.endDate.format('YYYY-MM-DD');
					window.location.href = url;
				}
			});
		});
	</script>
	
	<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
	<script>
		$(document).ready(function() {
			$(document).on("click", ".pay_now", function() {
				var plan = $('#plan').val(); // Get the value of the input field

				if (plan !== '') {
					$.ajax({
						url: "{{ url('make-order1') }}", // Ensure this URL is correct
						type: 'POST',
						data: {
							'_token': '{{ csrf_token() }}',
							'plan_id': plan
						},
						success: function(res) {
							try {
								payNow(res.amount, res.rzp_order);
								// Try parsing JSON response if needed
								// var response = JSON.parse(res);
								// console.log('Response:', response);
								// alert('Success: ' + response.message); // Adjust based on your response
							} catch (e) {
								console.log('Invalid JSON response:', res);
								alert('Success, but unable to parse response.');
							}
						},
						error: function(xhr, status, error) {
							console.log('Error:', status, error);
							alert('An error occurred: ' + xhr.responseText);
						}
					});
				} else {
					alert('Please enter an amount.');
				}
			});

			function payNow(amount, rzp_order) {
				var options = {
					"key": "{{env('rzr_key')}}", // Enter the Key ID generated from the Dashboard
					"amount": amount, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
					"currency": "INR",
					"name": "Shipnick", //your business name
					"description": "Wallet Transaction",
					"image": "https://shipnick.com/images/shiplogo.jpeg",
					"order_id": rzp_order, //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
					"callback_url": "{{url('succes-payment')}}",
					"prefill": { //We recommend using the prefill parameter to auto-fill customer's contact information especially their phone number
						"name": "{{ session('UserLogin2name') }}", //your customer's name
						"email": "",
						"contact": "9000090000" //Provide the customer's phone number for better conversion rates 
					},
					"notes": {
						"address": "Razorpay Corporate Office"
					},
					"theme": {
						"color": "#3399cc"
					}
				};
				var rzp1 = new Razorpay(options);
				{
					rzp1.open();

				}
			}
		});
	</script>




</body>

</html>