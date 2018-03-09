var Design = {

	init: function(){

		var _this = this;
		window.onload = _this.setMenuActive();	
		_this.tooltipp();
		_this.popover();

		/*_this.modal();*/
		_this.alertSuppression();
	},

	setMenuActive:function() {
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

	alertSuppression:function() {

		 var elems = document.getElementsByClassName('confirmation');
	    var confirmIt = function (e) {
	        if (!confirm('Êtes-vous sûr ?')) e.preventDefault();
	    };
	    for (var i = 0, l = elems.length; i < l; i++) {
	        elems[i].addEventListener('click', confirmIt, false);
	    }
		
	},

	/*modal:function() {
		$('[data-toggle="modal"][data-target="#myModal"]').modal();
	}*/
}
