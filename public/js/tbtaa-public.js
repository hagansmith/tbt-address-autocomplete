(function( $ ) {
	'use strict';

	var autocompleteForms = [];

	function tbtaaSetAutocompleteFields(){
		$(tbtaa_fields).each(function(){							  
			var autocomplete = new google.maps.places.Autocomplete(this, {
				fields: ["address_components"], 
				});
			autocomplete.input = this.id;
			autocomplete.addListener("place_changed", fillInAddress);
			this.addEventListener("focus", function() {
				geoLocate(autocomplete);
			}, false);
			autocompleteForms[this.name] = autocomplete;
		});
	}

	function fillInAddress() {
	    // Get the place details from the autocomplete object.
	    const place 		= this.getPlace(),
			  inputPrefix	= this.input.split('_address')[0],
			  address1Field = $(`#${inputPrefix}_address_1`),
			  address2Field = $(`#${inputPrefix}_address_2`),
			  postalField	= $(`#${inputPrefix}_postcode`),
			  cityField 	= $(`#${inputPrefix}_city`),
			  countryField 	= $(`#${inputPrefix}_country`),
			  stateField	= $(`#${inputPrefix}_state`);

	    let address1 = "";
	    let postcode = "";

	    // Get each component of the address from the place details,
	    // and then fill-in the corresponding field on the form.
	    // place.address_components are google.maps.GeocoderAddressComponent objects
	    // which are documented at http://goo.gle/3l5i5Mr
	    for (const component of place.address_components) {
	      	const componentType = component.types[0];
	      	switch (componentType) {
	        	case "street_number": {
	        	  	address1 = `${component.long_name} ${address1}`;
	        	  	break;
	        	}
	        	case "route": {
	        	  	address1 += component.long_name;
	        	  	break;
	        	}
	        	case "postal_code": {
	        	  	postcode = `${component.long_name}${postcode}`;
	        	  	break;
	        	}
	        	case "postal_code_suffix": {
	        	  	postcode = `${postcode}-${component.long_name}`;
	        	  	break;
	        	}
	        	case "locality": {
	        	  	cityField.val(component.long_name);
	        	  	break;
				}
	        	case "administrative_area_level_1": {
	        	  	stateField.val(component.short_name);
	        	  	break;
	        	}
	        	case "country": {
	        	  	countryField.val(component.short_name);
	        	  	break;
				}
	     	}
	    }
  
	    address1Field.val(address1);
	    postalField.val(postcode);

	    // After filling the form with address components from the Autocomplete
	    // prediction, set cursor focus on the second address line to encourage
	    // entry of subpremise information such as apartment, unit, or floor number.
	    address2Field.focus();
	}

	function geoLocate(autocomplete) {

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                var circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy
                });

                autocomplete.setBounds(circle.getBounds());

            });
        }
    }

	$(function() {
		tbtaaSetAutocompleteFields();
	});

})( jQuery );
