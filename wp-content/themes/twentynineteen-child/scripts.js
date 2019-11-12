// Code for scroll through ID's by Ledwing Hernandez
// https://github.com/Waka867


// Manually feed in ids to scroll through :(
// Of course this would be where you'd programatically add id's to the array if you wanted to
var idList = [
	"main-section-1",
	"section-2",
	"section-3",
	"section-4"
];





// We start with zero before iterating through ID list
var idPos = 0;



// This is where we add the listener for wheel events
/*window.addEventListener( "wheel", function(){

	// If the y position for the wheel is positive we consider it a scroll down (this is inverse to what you'd think)	
	var el = document.getElementById( idList[ idPos ] );

	if( event.deltaY > 0) {
		console.log('wheel has been scrolled down');
		// Increment through list of provided ID's then scroll to that ID
		idPos = idPos + 1;
		
		var sectionId = "#" + el.id;
		location.hash = sectionId;
		console.log( sectionId );

		//window.scroll( 0, findPos( document.getElementById( sectionId ) ) );

		console.log( 'position is ' + idPos );
	} else {
		console.log('wheel has been scrolled up');		
		
		if( idPos > 0 ) {
			idPos = idPos - 1;
		} else {
			// We can't go to negative ids in the ID array
			console.log( "We can't go any lower!" );
		}	
		
		console.log( 'position is ' + idPos );
	};

});*/
