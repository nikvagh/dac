<form id="booking_form" action="" method="post" enctype="multipart/form-data">
	<div class="row">

		<div class="col-lg-12">
			<div class="form-group">
				<label class="form-control-label">Address  *</label>
				<input type="text" name="google_location" id="google_location" class="form-control" autocomplete="off"/>
			</div>
		</div>

		<div id="postal_code"></div>
    <div id="map_canvas"></div>

		<div class="col-lg-6">
			<div class="form-group">
				<label class="form-control-label">Flat, house no., Building, Company, Apartment *</label>
				<input type="text" name="flat" id="flat" class="form-control">
				<span class="error text-danger validation-message" data-field="flat"></span>
			</div>
		</div>

		<div class="col-lg-6">
			<div class="form-group">
				<label class="form-control-label">Area, Street, Sector, Village *</label>
				<input type="text" name="area" id="area" class="form-control">
				<span class="error text-danger validation-message" data-field="area"></span>
			</div>
		</div>

		<div class="col-lg-6">
			<div class="form-group">
				<label class="form-control-label">Landmark</label>
				<input type="text" name="landmark" id="landmark" class="form-control">
				<span class="error text-danger validation-message" data-field="landmark"></span>
			</div>
		</div>

		<div class="col-lg-6">
			<div class="form-group">
				<label class="form-control-label">City *</label>
				<input type="text" name="city" id="city" class="form-control">
				<span class="error text-danger validation-message" data-field="city"></span>
			</div>
		</div>

		<div class="col-lg-6">
			<div class="form-group">
				<label class="form-control-label">State *</label>
				<input type="text" name="state" id="state" class="form-control">
				<span class="error text-danger validation-message" data-field="state"></span>
			</div>
		</div>

		<div class="col-lg-6">
			<div class="form-group">
				<label class="form-control-label">Zip Code *</label>
				<input type="text" name="zipcode" id="zipcode" class="form-control">
				<span class="error text-danger validation-message" data-field="zipcode"></span>
			</div>
		</div>

		<div class="col-lg-12">
			<div class="form-group">
				<label class="form-control-label">Location *</label>
				<textarea name="location" id="location" class="form-control" placeholder="Location"></textarea>
				<span class="error text-danger validation-message" data-field="location"></span>
			</div>
		</div>

		<!-- <div class="col-lg-12">
			<div class="form-group">
				<label class="form-control-label">Zip Code *</label>
				<select name="zipcode" id="zipcode" class="form-control"></select>
				<span class="error text-danger validation-message" data-field="zipcode"></span>
			</div>
		</div> -->

		<div class="col-lg-12"> <hr> </div>

		<div class="col-lg-12">
			<div class="form-group">
				<label class="form-control-label">Vehicle *</label>
				<select name="vehicle_id" id="vehicle_id" class="form-control select2">
					<option value="">--select--</option>
					<?php foreach ($vehicles as $val) { ?>
						<option value="<?php echo $val->id; ?>"><?php echo $val->name . ' - ' . $val->year; ?></option>
					<?php } ?>
				</select>
			</div>
		</div>

		<div class="col-lg-12">
			<label class="form-control-label d-flex justify-content-center1"> ---- Or Add New Vehicle ---- </label>
		</div>

		<div class="col-lg-12">
			<div class="row d-flex justify-content-center1">
				<div class="col-lg-4">
					<div class="form-group">
						<input type="text" name="vehicle_name" class="form-control" placeholder="Vehicle Name" value="">
						<!-- <span class="error text-danger validation-message" data-field="vehicle_name"></span> -->
					</div>
				</div>

				<div class="col-lg-4">
					<div class="form-group">
						<select name="vehicle_year" id="" class="form-control select2">
							<option value="">-- Select Year --</option>
							<?php foreach (get_last_30_yr() as $val) { ?>
								<option value="<?php echo $val; ?>"><?php echo $val; ?></option>
							<?php } ?>
						</select>
						<!-- <span class="error text-danger validation-message" data-field="vehicle_name"></span> -->
					</div>
				</div>
			</div>
			<span class="error text-danger validation-message" data-field="vehicle_id"></span><br />
		</div>

		<div class="col-lg-12"> <hr> </div>

		<div class="col-lg-12">
			<div class="form-group">
				<label class="form-control-label">Service Booking Type *</label> <br />
				<label><input type="radio" name="service_type" value="package" checked> With Package </label> &nbsp;&nbsp;
				<label><input type="radio" name="service_type" value="custom"> Other Services </label>
				<br />
				<span class="error text-danger validation-message" data-field="service_type"></span>
			</div>
		</div>

		<div class="col-lg-12 package_box">
			<div class="form-group">
				<label class="form-control-label">Package *</label>
				<select name="package_id" id="package_id" class="form-control select2">
					<option value="">--select--</option>
					<?php foreach ($packages as $val) { ?>
						<option value="<?php echo $val->customer_membership_id; ?>"><?php echo '#'.$val->customer_membership_id.' - '. $val->name.' - (Expire On - '.date('d M,y',strtotime($val->end_date)).')'; ?></option>
					<?php } ?>
				</select>
				<span class="error text-danger validation-message" data-field="package_id"></span>
			</div>
		</div>

		<div class="col-lg-12 service_box">
			<div class="form-group">
				<label class="form-control-label">Services *</label>
				<select name="service[]" id="service" class="form-control select2" multiple>
					<?php foreach ($services as $val) { ?>
						<option value="<?php echo $val->id; ?>"><?php echo $val->name.' - ($'.$val->amount.')' ?></option>
					<?php } ?>
				</select>
				<span class="error text-danger validation-message" data-field="service[]"></span>
			</div>
		</div>

		<div class="col-lg-12">
			<div class="form-group">
				<label class="form-control-label">Add On</label>
				<select name="addOn[]" id="addOn" class="form-control select2" multiple="">
					<?php foreach ($addOns as $val) { ?>
						<option value="<?php echo $val->id; ?>"><?php echo $val->name.' - ($'.$val->amount.')'  ?></option>
					<?php } ?>
				</select>
				<span class="error text-danger validation-message" data-field="addOn[]"></span>
			</div>
		</div>

		<div class="col-lg-12">
			<div class="form-group">
				<label class="form-control-label">Time *</label> <br />
				<label><input type="radio" name="appointment_type" value="book_now"> Book Now </label> &nbsp;&nbsp;
				<label><input type="radio" name="appointment_type" value="schedule_book"> Book Later </label>
				<br />
				<span class="error text-danger validation-message" data-field="appointment_type"></span>
			</div>
		</div>

		<div class="col-lg-6 time_box">
			<div class="form-group">
				<label class="form-control-label">Date Time *</label>
				<input type="text" name="time" id="time" class="form-control" autocomplete="off" />
				<span class="error text-danger validation-message" data-field="time"></span>
			</div>
		</div>

		<div class="col-lg-6 date_time_box">
			<div class="form-group">
				<label class="form-control-label">Date Time *</label>
				<input type="text" name="date_time" id="date_time" class="form-control" autocomplete="off" />
				<span class="error text-danger validation-message" data-field="date_time"></span>
			</div>
		</div>

	</div>
	<input type="hidden" name="customer_id" value="<?php echo $this->member->loginData->id; ?>">
	<input type="hidden" name="latitude" id="latitude" value="">
	<input type="hidden" name="longitude" id="longitude" value="">

	
</form>

<div class="text-right">
	<button class="btn btn-default btn-pill" onclick="cancel('booking')">Cancel</button>
	<button class="btn btn-primary btn-submit btn-pill" onclick="bookingCreate()">Save</button>
</div>

<!-- <script src="https://maps.googleapis.com/maps/api/js?key=<?php //echo $this->config->item('google_map_api'); ?>&callback=initialize&libraries=places&v=weekly" defer></script> -->
<!-- <script src="https://maps.googleapis.com/maps/api/place/queryautocomplete/json?&key=<?php //echo $this->config->item('google_map_api'); ?>"></script> -->
<!-- <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script> -->
<!-- <script src="https://maps.googleapis.com/maps/api/js?libraries=geometry,places&callback=initialize&key=<?php echo $this->config->item('google_map_api'); ?>"></script>
<script type="text/javascript">
	var geocoder;
	var map;
	function initialize() {
		var options = {
			// types: ['(cities)'],
			// componentRestrictions: {country: "us"},
			// strictBounds: true,
			// fields: ["place_id","address_components", "geometry", "icon", "name"],
			// fields: ["geometry"],
			// placeId
		};

		const input = document.getElementById("google_location");
		const searchBox = new google.maps.places.Autocomplete(input, options);

		if(searchBox){
			searchBox.addEventListener('autocomplete','places_changed', function() {
				var places = searchBox.getPlaces();

				console.log(places);

				// if (places.length == 0) {
				// 	return;
				// }

				// const geocoder = new google.maps.Geocoder();
				// geocodeAddress(geocoder, map);
			});
		}
	}
	// google.maps.event.addDomListener(window, "load", initialize);
</script> -->



    <script>
        var geocoder;
        var map;

        function initialize() {
            var map = new google.maps.Map(
                document.getElementById("map_canvas"), {
                center: new google.maps.LatLng(37.4419, -122.1419),
                zoom: 13,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            var input = document.getElementById('google_location');
            var options = {
                // types: ['all'],
                types: ['geocode'],
                componentRestrictions: {
                    country: 'us'
                }
            };
            
            autocomplete = new google.maps.places.Autocomplete(input, options);

            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                var place = autocomplete.getPlace();

                console.log(place.address_components);
                // console.log(place.geometry.location.lng);
                // geocode({ 'address': address}, function(results, status) {
                //     console.log('hh')
                // })
				$("#flat").val('');
				$("#area").val('');
				$("#landmark").val('');
				$("#city").val('');
				$("#state").val('');
				$("#zipcode").val('');

                for (var i = 0; i < place.address_components.length; i++) {
                    for (var j = 0; j < place.address_components[i].types.length; j++) {

						console.log(place.address_components[i].types[j]);

						if (place.address_components[i].types[j] == "premise" || place.address_components[i].types[j] == "sublocality_level_3" || place.address_components[i].types[j] == "sublocality_level_4" || place.address_components[i].types[j] == "sublocality_level_5") {
							var flat_val = $("#flat").val();
							$("#flat").val(flat_val+' '+place.address_components[i].long_name);
                        }

						if (place.address_components[i].types[j] == "route" || place.address_components[i].types[j] == "sublocality_level_1") {
							var area_val = $("#area").val();
							$("#area").val(area_val+' '+place.address_components[i].long_name);
                        }
						
						if (place.address_components[i].types[j] == "sublocality_level_2") {
							$("#landmark").val(place.address_components[i].long_name);
                        }

						if (place.address_components[i].types[j] == "locality" || place.address_components[i].types[j] == "administrative_area_level_2" || place.address_components[i].types[j] == "administrative_area_level_3") {
							var city_val = $("#city").val();

							// console.log(city_val);
							// alert(place.address_components[i].types[j])

							$("#city").val(city_val+' '+place.address_components[i].long_name);
                        }

						if (place.address_components[i].types[j] == "administrative_area_level_1") {
							$("#state").val(place.address_components[i].long_name);
                        }

                        if (place.address_components[i].types[j] == "postal_code") {
							$("#zipcode").val(place.address_components[i].long_name);
                        }

                    }
                }
            })
        }
		initialize();
        // google.maps.event.addDomListener(window, "load", initialize);


        // $("#id_address").change(function () {
        //     var addressVal = $(this).val();
        //     console.log(addressVal)
        //     var geocoder = new google.maps.Geocoder();
        //     var address = addressVal;
        //     geocoder.geocode({'address': address}, function(results, status) {
        //         if (status == google.maps.GeocoderStatus.OK) {
        //             var latitude = results[0].geometry.location.lat();
        //             var longitude = results[0].geometry.location.lng();
        //             // alert(latitude);
        //             // alert(longitude);

        //             console.log(latitude,longitude)
        //         } 
        //     });
        // })

    </script>