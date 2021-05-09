(function( factory ) {
	if ( typeof define === "function" && define.amd ) {

		define([ "../jquery.ui.datepicker" ], factory );
	} else {

		factory( jQuery.datepicker );
	}
}(function( datepicker ) {
	datepicker.regional['ar'] = {
		closeText: 'إغلاق',
		prevText: '&#x3C;السابق',
		nextText: 'التالي&#x3E;',
		currentText: 'اليوم',
		monthNames: ['يناير', 'فبراير', 'مارس', 'أبريل', 'ماي', 'يونيو',
		'يوليوز', 'غشت', 'شتنبر',	'أكتوبر', 'نونبر', 'دجنبر'],
		monthNamesShort: ['يناير', 'فبراير', 'مارس', 'أبريل', 'ماي', 'يونيو',
		'يوليوز', 'غشت', 'شتنبر',	'أكتوبر', 'نونبر', 'دجنبر'],
		dayNames: ['الأحد', 'الاثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'],
		dayNamesShort: ['الأحد', 'الاثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'],
		dayNamesMin: ['ح', 'ن', 'ث', 'ر', 'خ', 'ج', 'س'],
		weekHeader: 'أسبوع',
		dateFormat: 'dd/mm/yy',
		firstDay: 6,
  		isRTL: true,
		showMonthAfterYear: false,
		yearSuffix: ''};
	datepicker.setDefaults(datepicker.regional['ar']);

	return datepicker.regional['ar'];

}));
