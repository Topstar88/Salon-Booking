(function($){
	'use strict';
        $("input[type='number']").inputSpinner();

        $('#datepicker').datetimepicker({
			format: 'MM-DD-YYYY',
			minDate: new Date(),
			maxDate: new Date(new Date().setMonth(new Date().getMonth() + 2)),
			daysOfWeekDisabled: [0, 6]
		});
        $('.dateTimePickerInput').datetimepicker({
			format: 'hh:mm A',
			enabledHours: [8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18]
		});
        $('#servStarts').datetimepicker({
			format: 'hh:mm A',
		});
        $('#servEnds').datetimepicker({
			format: 'hh:mm A',
		});
        $('#service-duration').datetimepicker({
			format: 'hh:mm'
		});
})(jQuery);