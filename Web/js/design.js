var Design = {

	init: function(){

		var _this = this;

		window.onload = _this.setActive();	

		_this.tooltipp();

		_this.popover();

		/*_this.modal();*/

	},

	setActive:function() {
		aObj = document.getElementById('navbar').getElementsByTagName('a');
		 var found = false;
		for(var i=aObj.length-1; i>=1 && !found; i--) {
    		if(document.location.href.indexOf(aObj[i].href)>=0) {
       			aObj[i].className='active';
        		found = true;
    		}
		}
    	if(!found && document.location.href.replace(/\/$/, "") == aObj[0].href.replace(/\/$/, ""))
         aObj[0].className = 'active';
	},

	tooltipp:function() {
		$('[data-toggle="tooltip"]').tooltip();
	},

	popover:function() {
		$('[data-toggle="popover"]').popover();
	},

	/*modal:function() {
		$('[data-toggle="modal"][data-target="#myModal"]').modal();
	}*/
}
