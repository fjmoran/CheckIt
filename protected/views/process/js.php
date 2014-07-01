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
		lineWidth:4,
		strokeStyle:"#61B7CF",
		joinstyle:"round",
		outlineColor:"white",
		outlineWidth:2
	},
	// .. and this is the hover style. 
	connectorHoverStyle = {
		lineWidth:4,
		strokeStyle:"#216477",
		outlineWidth:2,
		outlineColor:"white"
	},
	endpointHoverStyle = {
		fillStyle:"#216477",
		strokeStyle:"#216477"
	},
	// the definition of source endpoints (the small blue ones)
	sourceEndpoint = {
		endpoint:"Dot",
		isSource:true,
		maxConnections:-1,
		paintStyle:{ 
			strokeStyle:"#7AB02C",
			fillStyle:"white",
			radius:7,
			lineWidth:3 
		},				
		connector:[ "Flowchart", { stub:[40, 60], gap:10, cornerRadius:5, alwaysRespectStubs:true } ],								                
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
		paintStyle:{ fillStyle:"#7AB02C",radius:11 },
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

	add_connection = function() {

	}

	add_task = function(id, name, pos_x, pos_y) {
		var newState = $('<div>').attr('id', id).addClass('item');
		var title = $('<div>').addClass('title').text(name);

		newState.css({
			'top': pos_y,
			'left': pos_x
		});

		newState.append(title);

		var sourceUUID = id + "_bottom";
		var targetUUID = id + "_top";

		newState.dblclick(function(e) {
			instance.detachAllConnections($(this));
			instance.deleteEndpoint(sourceUUID);
			instance.deleteEndpoint(targetUUID);
			$(this).remove();
			e.stopPropagation();
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

				console.log("New position: x: ", xPos, " - y:", yPos);
			},
		});

		$('#flowchart-edit').append(newState);

		instance.addEndpoint(id, sourceEndpoint, {anchor:"BottomCenter", uuid:sourceUUID});
		instance.addEndpoint(id, targetEndpoint, { anchor:"TopCenter", uuid:targetUUID });
	};

	var i = 1;

	$('#option-add-task').click(function(e) {

		var name = 'Tarea ' + i;
		var top = 100 + (20*(i-1))%80;
		var left = 100 + (20*(i-1))%80;

		//database
		var data = {
			name: name,
			process_id: <?php echo $process_id; ?>,
			pos_x: left,
			pos_y: top
		};

		$.post('<?php echo Yii::app()->createUrl('processtask/create'); ?>', data,  function(d) {
			if(!d['success']) 
				alert('Error!');
			else {
				id = d['data']['id'];
				add_task(id, name, left, top);
			}
		});

		i++;

	});  

	
	load_data = function(ins) {

	<?php 
		foreach ($model->processTasks as $processTask) {
			?>
		add_task('<?php echo $processTask->id?>', '<?php echo $processTask->name?>', <?php echo $processTask->pos_x?>, <?php echo $processTask->pos_y?>);
			<?php
		}
	?>

		instance.bind("click", function(conn, originalEvent) {
			if (confirm("Delete connection from " + conn.sourceId + " to " + conn.targetId + "?"))
				jsPlumb.detach(conn); 
		});	

		instance.bind("connection", function(info) {
			//database
			var data = {
				id: info.connection.id,
				from: info.sourceId,
				to: info.targetId,
			};

			console.log("connection " + info.connection.id + " from " + info.sourceId + " to " + info.targetId);
		});
		
		instance.bind("connectionDetached", function(info) {
			var data = {
				id: info.connection.id,
				from: info.sourceId,
				to: info.targetId,
			};

			//console.log("detached " + info.connection.id + " from " + info.sourceId + " to " + info.targetId);
		});
		
	};

	load_data(instance);

});

