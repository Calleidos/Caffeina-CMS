function closeIFrame(){
     $('.fancybox-iframe').remove();
}

function deleteFile(id, model) {
	$.ajax({
		async:true, 
		data:{id: id},
		dataType:"html", 
		success:function (data) {						
			$('#'+model+'-list tr#'+model+"-"+id).hide("slow", function(){ $(this).remove(); orderIcons(); createIcons(); })
		}, 
		type:"post",
		url:"/admin/"+model+"s/deleteAjax"
	});
}

function editFile(id, model) {
	$.ajax({
		async:true, 
		data:{id: id},
		dataType:"html", 
		success:function (data) {				
			$('#'+model+'-list tr#'+model+"-"+id).hide("slow", function(){ $(this).replaceWith(data); $('.order-icons ul').remove(); createIcons(); tinyMCE.init({mode:"textareas", theme : 'advanced', theme_advanced_statusbar_location : "bottom", theme_advanced_toolbar_location : "top",}); });
			
		}, 
		type:"post",
		url:"/admin/"+model+"s/addEditRow"
	});
}

function saveFile(id, model) {
	var firstLetter = model.substr(0, 1);
	var ucModel=firstLetter.toUpperCase() + model.substr(1);
	
	if (model=="image") {
		data={
			id			: id,
			name 		: $("tr#"+model+"-"+id+" input#"+ucModel+id+"Name").val(),
			tipologia 	: $("tr#"+model+"-"+id+" input#"+ucModel+id+"Tipologia").val()
		};
	}
	
	if (model=="document") {
		data={
			id			: id,
			name 		: $("tr#"+model+"-"+id+" input#"+ucModel+id+"Name").val(),
			tipologia 	: $("tr#"+model+"-"+id+" input#"+ucModel+id+"Tipologia").val(),
			description	: $("tr#"+model+"-"+id+" #"+ucModel+id+"DescriptionTextArea iframe").contents().find("body").html(),
		};
	}
	
	$.ajax({
		async:true, 
		data:data,
		dataType:"html", 
		success:function (data) {
			$('#'+model+'-list tr#'+model+"-"+id).hide("slow", function(){ $(this).replaceWith(data); orderIcons(); createIcons(); });
		}, 
		type:"post",
		url:"/admin/"+model+"s/saveAjax"
	});
}

function cancelFileSave(id, model) {
	$.ajax({
		async:true, 
		data:{
			id			: id,
		},
		dataType:"html", 
		success:function (data) {
			$('#'+model+'-list tr#'+model+"-"+id).hide("slow", function(){ $(this).replaceWith(data); orderIcons(); createIcons();});
		}, 
		type:"post",
		url:"/admin/"+model+"s/addRow"
	});
}

function orderUp(id, model, order) {
	currentElement=".file-row#"+model+"-"+id;
	prev=$(currentElement).prev();
	$(currentElement).hide("slow");
	$(prev).hide("slow");
	$(currentElement).after($(prev));
	orderIcons();
	createIcons();
	$(currentElement).show("slow");
	$(prev).show("slow");
}

function orderDown(id, model, order) {
	currentElement=".file-row#"+model+"-"+id;
	next=$(currentElement).next();
	$(currentElement).hide("slow");
	$(next).hide("slow");
	$(currentElement).before($(next));
	orderIcons();
	createIcons();
	$(currentElement).show("slow");
	$(next).show("slow");
}

function categoriesOrderUp (tab, id, model, order) {
	currentElement=".file-row#"+model+"-"+id;
	prev=$(currentElement).prev();
	$(currentElement).hide("slow");
	$(prev).hide("slow");
	$(currentElement).after($(prev));
	orderIcons();
	createIcons();
	$(currentElement).show("slow");
	$(prev).show("slow");
}

function orderIcons () {
	
	$('.file-list').each(function() {
		var model=$(this).attr('id');
		model=model.replace("-list", "");
		i=1;
		count=$(this).children().children("tr.file-row").length;
	    $(this).children().children("tr.file-row").each(function(){
	    	var currentId = $(this).attr('id');
	    	currentId=currentId.replace(model+"-", "");
	    	html="<p>"+i+"</p><input type='hidden' id='Image"+currentId+"Order' value='"+i+"' name='data[Image]["+currentId+"][order]'><ul>"
	    	if (i>1) {
	    		html=html+"<li><button onclick=\"orderUp("+currentId+", 'image', "+i+"); return false;\" class='act up_order'>Sposta su</button></li>";
	    	}
	    	if (i<count) {
	    		html=html+"<li><button onclick=\"orderDown("+currentId+", 'image', "+i+"); return false;\" class='act down_order'>Sposta giu</button></li>";
	    	}
	    	html=html+"</ul>";
		    $(this).children('.order-icons').html(html);
		    i++;
	    });
	    
	});
					
} 

function order (controller, category, id, order) {
	$.ajax({
		async:true, 
		data:{
			id			: id,
			order 		: order,
			category	: category
			
		},
		dataType:"html", 
		success:function (data) {
			self.location.reload();
		}, 
		type:"post",
		url:"/admin/categories/order"
	});
}

function categoriesOrderIcons () {
	
	$('.file-list').each(function() {
		var model=$(this).attr('id');
		model=model.replace("-list", "");
		i=1;
		count=$(this).children().children("tr.file-row").length;
	    $(this).children().children("tr.file-row").each(function(){
	    	var currentId = $(this).attr('id');
	    	currentId=currentId.replace(model+"-", "");
	    	html="<p>"+i+"</p><input type='hidden' id='Image"+currentId+"Order' value='"+i+"' name='data[Image]["+currentId+"][order]'><ul>"
	    	if (i>1) {
	    		html=html+"<li><button onclick=\"orderUp("+currentId+", 'image', "+i+"); return false;\" class='order-up'>Move up</button></li>";
	    	}
	    	if (i<count) {
	    		html=html+"<li><button onclick=\"orderDown("+currentId+", 'image', "+i+"); return false;\" class='order-down'>Move down</button></li>";
	    	}
	    	html=html+"</ul>";
		    $(this).children('.order-icons').html(html);
		    i++;
	    });
	    
	});
					
} 

function createIcons() {
	
	$( ".cancel-file" ).button({
        icons: {
            primary: "ui-icon-trash"
        },
        
    });

	$( ".edit-file" ).button({
        icons: {
            primary: "ui-icon-document"
        },
        
    });

	$( ".save-file" ).button({
        icons: {
            primary: "ui-icon-disk"
        },
        
    });

	$( ".cancel-file-save" ).button({
        icons: {
            primary: "ui-icon-cancel"
        },
        
    });

	$( ".order-up" ).button({
        icons: {
            primary: "ui-icon-triangle-1-n"
        },
        
    });

	$( ".order-down" ).button({
        icons: {
            primary: "ui-icon-triangle-1-s"
        },
        
    });
	
	$( ".open-file" ).button({
        icons: {
            primary: "ui-icon-search"
        },
        
    });

	
}

function fancyImages() {
	$("a[rel=fancy-images]").fancybox();
}

function modifySlug(id) {
	newButton='<button id="save-slug-'+id+'" onclick="saveSlug('+id+'); return false;" class="act btn_green" style="float: none;left: 260px;position: relative;top: -45px;">Save Slug</button>';
	$("#ProductVersion"+id+"Slug").prop('disabled', false);
	$("#modify-slug-"+id).replaceWith(newButton);
	createIcons();
}

function saveSlug(id) {
	newButton='<button id="modify-slug-'+id+'" onclick="modifySlug('+id+'); return false;" class="act btn_yellow" style="float: none;left: 260px;position: relative;top: -45px;">Modify Slug</button>';
	$("#ProductVersion"+id+"Slug").prop('disabled', true);
	$("#save-slug-"+id).replaceWith(newButton);
	createIcons();
}