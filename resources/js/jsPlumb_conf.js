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
		maxConnections:20,
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


	init = function(connection) {			
		//connection.getOverlay("label").setLabel(connection.sourceId.substring(15) + "-" + connection.targetId.substring(15));
		connection.bind("editCompleted", function(o) {
			if (typeof console != "undefined")
				console.log("connection edited. path is now ", o.path);
		});
	};

/*  instance.makeSource($('.item'), {
    connector: 'Flowchart'
  });
  instance.makeTarget($('.item'), {
    anchor: 'Continuous'
  });*/

  var i = 1;

  $('#option-add-task').click(function(e) {

  	var name = 'Tarea ' + i;
  	var top = 100 + (5*(i-1));
  	var left = 100 + (5*(i-1));

    var newState = $('<div>').attr('id', 'state' + i).addClass('item');
    
    var title = $('<div>').addClass('title').text(name);
    //var connect = $('<div>').addClass('connect');

    newState.css({
      'top': top,
      'left': left
    });
    
    /*instance.makeTarget(newState, {
      anchor: 'Continuous'
    });
    
    instance.makeSource(connect, {
      parent: newState,
      anchor: 'Continuous'
    });*/
    
    newState.append(title);
    //newState.append(connect);

	var sourceUUID = i + "BottomCenter";
	var targetUUID = i + "TopCenter";

	newState.dblclick(function(e) {
	  instance.detachAllConnections($(this));
	  instance.deleteEndpoint(sourceUUID);
	  instance.deleteEndpoint(targetUUID);
	  $(this).remove();
	  e.stopPropagation();
	});

	instance.draggable(newState, {
	  //containment: 'parent',
	  grid: [20, 20]
	});

    $('#flowchart-edit').append(newState);

	//source
	instance.addEndpoint('state'+i, sourceEndpoint, {anchor:"BottomCenter", uuid:sourceUUID});

	//target
	instance.addEndpoint("state" + i, targetEndpoint, { anchor:"TopCenter", uuid:targetUUID });

	//database
	var data = {
		name: name,
		process_id: 1,
		x: left,
		y: top
	};

	$.post(url_processtask_create, data,  function(d) {
		if(!d['success']) {alert('Error!');}
	});

    i++;

  });  




});