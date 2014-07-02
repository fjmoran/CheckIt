jsPlumb.ready(function() {

	var instance = jsPlumb.getInstance({
		// default drag options
		DragOptions : { cursor: 'pointer', zIndex:2000 },
		// the overlays to decorate each connection with.  note that the label overlay uses a function to generate the label text; in this
		// case it returns the 'labelText' member that we set on each connection in the 'init' method below.
		ConnectionOverlays : [
			[ "Arrow", { location:1 } ],
			[ "Label", { 
				location:0.1,
				id:"label",
				cssClass:"aLabel"
			}]
		],
		Container:"flowchart-edit"
	});

	// this is the paint style for the connecting lines..
	var connectorPaintStyle = {
		lineWidth:3,
		strokeStyle:"#3276b1",
		joinstyle:"round",
		outlineColor:"white",
		outlineWidth:2
	},
	// .. and this is the hover style. 
	connectorHoverStyle = {
		lineWidth:3,
		strokeStyle:"#285e8e",
		outlineWidth:2,
		outlineColor:"white"
	},
	endpointHoverStyle = {
		fillStyle:"#285e8e",
		strokeStyle:"#285e8e"
	},
	// the definition of source endpoints (the small blue ones)
	sourceEndpoint = {
		endpoint:"Dot",
		isSource:true,
		maxConnections:-1,
		paintStyle:{ 
			strokeStyle:"#3276b1",
			fillStyle:"white",
			radius:7,
			lineWidth:3 
		},				
		connector:[ "Flowchart", { stub:[5, 25], gap:10, cornerRadius:3, alwaysRespectStubs:true } ],								                
		connectorStyle:connectorPaintStyle,
		hoverPaintStyle:endpointHoverStyle,
		connectorHoverStyle:connectorHoverStyle,
        dragOptions:{},
        overlays:[
        	[ "Label", { 
            	location:[0.5, 1.5], 
            	//label:"Drag",
            	cssClass:"endpointSourceLabel" 
            } ]
        ]
	},		
	// the definition of target endpoints (will appear when the user drags a connection) 
	targetEndpoint = {
		endpoint:"Dot",					
		paintStyle:{ fillStyle:"#3276b1",radius:9 },
		hoverPaintStyle:endpointHoverStyle,
		maxConnections:-1,
		dropOptions:{ hoverClass:"hover", activeClass:"active" },
		isTarget:true,	
        overlays:[
        	[ "Label", { 
        		location:[0.5, -0.5], 
        		//label:"Drop", 
        		cssClass:"endpointTargetLabel" 
        	} ]
        ]
	},			

/*
	init = function(connection) {			
		//connection.getOverlay("label").setLabel(connection.sourceId.substring(15) + "-" + connection.targetId.substring(15));
		connection.bind("editCompleted", function(o) {
			if (typeof console != "undefined")
				console.log("connection edited. path is now ", o.path);
		});
	};*/

	add_connector = function(id, source_id, target_id) {
		//instance.connect({source:source_id, target:target_id});
		conn = instance.connect({uuids:["task_" + source_id + "_bottom", "task_" + target_id + "_top"], editable:false});
		conn.id = "connection_" + id;
	}

	add_task = function(id, name, type, pos_x, pos_y) {

		var task_id = 'task_' + id;

		var newState = $('<div>').attr('id', task_id).addClass('item activity');
		var title = $('<div>').addClass('title').text(name);

		if (type==1) { // es inicio
			newState.addClass('begin-point');
		}
		if (type==2) { // es fin
			newState.addClass('end-point');
		}

		newState.css({
			'top': pos_y,
			'left': pos_x
		});

		newState.append(title);

		var sourceUUID = task_id + "_bottom";
		var targetUUID = task_id + "_top";

		newState.dblclick(function(e) {

			var arr = $(this).attr('id').split('_');
			id = arr[1];

			instance.detachAllConnections($(this));
			instance.deleteEndpoint(sourceUUID);
			instance.deleteEndpoint(targetUUID);
			$(this).remove();
			e.stopPropagation();

			$.post('<?php echo Yii::app()->createUrl('processtask/delete?id='); ?>'+id, null,  function(d) {
				if(!d['success']) {
					//doLine=false;
				}
			});

			console.log("task deleted " + $(this).attr('id'));

		});

		instance.draggable(newState, {
			grid: [20, 20],
			stop: function(){
				var offset = $(this).position();
				var xPos = offset.left;
				var yPos = offset.top;

				//database
				var data = {
					pos_x: xPos,
					pos_y: yPos
				};

				$.post('<?php echo Yii::app()->createUrl('processtask/update?id='); ?>'+id, data,  function(d) {
					if(!d['success']) {alert('Error!');}
				});

				//console.log("New position: x: ", xPos, " - y:", yPos);
			},
		});

		$('#flowchart-edit').append(newState);

		if (type!=1) { // no es inicio
			instance.addEndpoint(task_id, targetEndpoint, {anchor:"TopCenter", uuid:targetUUID});
		}
		if (type!=2) { // no es fin
			instance.addEndpoint(task_id, sourceEndpoint, {anchor:"BottomCenter", uuid:sourceUUID});
		}
	};

	//private $typeOptions = array('0' => 'Actividad', '1' => 'Inicio', '2' => 'Término');

	var i = 1;
	$('#option-add-task').click(function(e) {
		var name = 'Actividad ' + i;
		add_task_db(name, 0);
	});

	$('#option-add-start').click(function(e) {
		var name = 'Actividad Inicial';
		add_task_db(name, 1); // 1 = 
	});

	$('#option-add-end').click(function(e) {
		var name = 'Actividad Final';
		add_task_db(name, 2); // 1 = 
	});

	function add_task_db(name, type) {
		var top = 100 + (20*(i-1))%80;
		var left = 100 + (20*(i-1))%80;

		//database
		var data = {
			name: name,
			process_id: <?php echo $process_id; ?>,
			pos_x: left,
			pos_y: top,
			type: type
		};
		$.post('<?php echo Yii::app()->createUrl('processtask/create'); ?>', data,  function(d) {
			if(!d['success']) 
				alert('Error!');
			else {
				id = d['data']['id'];
				add_task(id, name, type, left, top);
			}
		});

		i++;
	};

	load_data = function(ins) {

	<?php 
		foreach ($model->processTasks as $processTask) {
			?>
		add_task('<?php echo $processTask->id?>', '<?php echo $processTask->name?>', <?php echo $processTask->type?>, <?php echo $processTask->pos_x?>, <?php echo $processTask->pos_y?>);
			<?php
		}
	?>

		instance.bind("click", function(conn, originalEvent) {
			if (confirm("Delete connection from " + conn.sourceId + " to " + conn.targetId + "?"))
				instance.detach(conn); 
		});	

		instance.bind("beforeDrop", function(info){

			var arr1 = info.sourceId.split('_');
			var arr2 = info.targetId.split('_');

			//database
			var data = {
				process_id: <?php echo $process_id; ?>,
				source_task_id: arr1[1],
				target_task_id: arr2[1],
			};

			var doLine=true;
			/*$.post('<?php echo Yii::app()->createUrl('processconnector/create'); ?>', data,  function(d) {
				if(!d['success']) {
					doLine=false;
				}
			}*/

			$.ajax({
				type: 'POST',
				url: '<?php echo Yii::app()->createUrl('processconnector/create'); ?>',
				data: data,
				success: function(d) {
					if(!d['success']) {
						doLine=false;
						alert(d['errors']);
					}
					else {
						id = d['data']['id'];
						info.connection.id = 'connection_' + id;
					}
				},
				//dataType: dataType,
				async:false
			});

			console.log("drop " + info.connection.id + " from " + info.sourceId + " to " + info.targetId );
			return doLine;
		});

		instance.bind("connection", function(info) {
			info.connection.setDetachable(false);
		});
		
		instance.bind("connectionDetached", function(info) {

			var arr = info.connection.id.split('_');

			if (arr[0] == 'connection') {
				id = arr[1];

				$.post('<?php echo Yii::app()->createUrl('processconnector/delete?id='); ?>'+id, null,  function(d) {
					if(!d['success']) {
						//doLine=false;
					}
				});

				console.log("detached " + info.connection.id + " from " + info.sourceId + " to " + info.targetId);

			}

		});
		
	<?php 
		foreach ($model->processConnectors as $processConnector) {
			?>
		add_connector('<?php echo $processConnector->id?>', '<?php echo $processConnector->source_task_id?>', '<?php echo $processConnector->target_task_id?>');
			<?php
		}
	?>

	};

	load_data(instance);

});

