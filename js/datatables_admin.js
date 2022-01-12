	$(document).ready(function() {
		
		var title_name = $('#finance_datatables').attr("title_name");   
		var file_name = $('#finance_datatables').attr("file_name");   
		var column_name = [ $('#finance_datatables').attr("column_name") ];   
		var page_count = [ $('#finance_datatables').attr("page_count") ];
		var language_name = [ $('#finance_datatables').attr("language_name") ];   
		
		var button_name = [
			{
				extend: 'copy',				
				className: 'btn btn-primary',
				exportOptions: {
					columns: column_name
				}
			},
			{
				extend: 'excel',
				title: title_name,
				filename: file_name,				
				className: 'btn btn-primary',
				exportOptions: {
					columns: column_name
				}
			},
			{
				extend: 'pdf',
				title: title_name,
				filename: file_name,				 
				className: 'btn btn-primary',		
				exportOptions: {
					columns: column_name
				}
			},
			{
				extend: 'print',
				title: title_name,
				className: 'btn btn-primary',
				exportOptions: {
					columns: column_name
				}
			}
		];

		var language_name_en = {
			buttons: {
				copy: '<i class="fa fa-files-o"></i> Copy',
				excel: '<i class="fa fa-file-excel-o"></i> Excel',
				pdf: '<i class="fa fa-file-pdf-o"></i> PDF',
				print: '<i class="fa fa-print"></i> Print',
			}
		};

		var language_name_mn = {
			buttons: {
				copy: '<i class="fa fa-files-o"></i> Хуулах',
				excel: '<i class="fa fa-file-excel-o"></i> Excel',
				pdf: '<i class="fa fa-file-pdf-o"></i> PDF',
				print: '<i class="fa fa-print"></i> Хэвлэх',
				copyTitle: 'Санах ойд бичлэг хуулах',
				copyKeys: '<i>ctrl</i> эсвэл <i>\u2318</i> + <i>C</i> товчийг дарж хүснэгтийн өгөгдлийг системийн санах ойд хуулна. <br><br>Энэ мэдээллийг арилгахын тулд Esc товч дарна уу.',
				copyprimary: {
					_: '%d бичлэг хуулав',
					1: '1 бичлэг хуулав'
				},
			}
		};
		
		if(language_name=='mn') languages = language_name_mn; else languages = language_name_en;
		
		$('#finance_datatables').DataTable( {
				dom: 'B',
				ordering: false,
				buttons:  button_name,
				language: languages,
				pageLength: page_count
		});

	});
	
	$(document).ready(function() {
		
		var title_name = $('#finance_datatables_all').attr("title_name");   
		var file_name = $('#finance_datatables_all').attr("file_name");   
		var column_name = [ $('#finance_datatables_all').attr("column_name") ];   
		var page_count = [ $('#finance_datatables_all').attr("page_count") ];
		var language_name = [ $('#finance_datatables_all').attr("language_name") ];   
		
		var button_name = [
			{
				extend: 'copy',				
				className: 'btn btn-primary',
				exportOptions: {
					columns: column_name
				}
			},
			{
				extend: 'excel',
				title: title_name,
				filename: file_name,				
				className: 'btn btn-primary',
				exportOptions: {
					columns: column_name
				}
			},
			{
				extend: 'pdf',
				title: title_name,
				filename: file_name,				 
				className: 'btn btn-primary',
				orientation: 'landscape',
				exportOptions: {
					columns: column_name
				}
			},
			{
				extend: 'print',
				title: title_name,
				className: 'btn btn-primary',
				exportOptions: {
					columns: column_name
				}
			}
		];

		var language_name_en = {
			buttons: {
				copy: '<i class="fa fa-files-o"></i> Copy',
				excel: '<i class="fa fa-file-excel-o"></i> Excel',
				pdf: '<i class="fa fa-file-pdf-o"></i> PDF',
				print: '<i class="fa fa-print"></i> Print',
			}
		};

		var language_name_mn = {
			buttons: {
				copy: '<i class="fa fa-files-o"></i> Хуулах',
				excel: '<i class="fa fa-file-excel-o"></i> Excel',
				pdf: '<i class="fa fa-file-pdf-o"></i> PDF',
				print: '<i class="fa fa-print"></i> Хэвлэх',
				copyTitle: 'Санах ойд бичлэг хуулах',
				copyKeys: '<i>ctrl</i> эсвэл <i>\u2318</i> + <i>C</i> товчийг дарж хүснэгтийн өгөгдлийг системийн санах ойд хуулна. <br><br>Энэ мэдээллийг арилгахын тулд Esc товч дарна уу.',
				copyprimary: {
					_: '%d бичлэг хуулав',
					1: '1 бичлэг хуулав'
				},
			}
		};
		
		if(language_name=='mn') languages = language_name_mn; else languages = language_name_en;
		
		$('#finance_datatables_all').DataTable( {
				dom: 'B',
				ordering: false,
				buttons:  button_name,
				language: languages,
				pageLength: page_count
		});

	});
