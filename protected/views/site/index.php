<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

	<div class="container">

		<h1>Mint Cafe & Restaurant</h1>
		<div>
			<input type="text" name="search" id="search" placeholder="Search Id "/>
			<button type="button" onclick="searchData()">Search</button>
			
		</div></br>
		<hr>

		<div id='update' >
			
		</div>

		<div id='insert'>
			<form>

				<div class="body01">
					<label>Guest Name :</label><br/>
					<input type="text" name="guest_name" id="guest_name" placeholder="Enter Guest Name" >
				</div>
				<br/>
				<div class="body01">
					<label>Room Number :</label><br/>
					<input type="number" name="room_number" id="room_number" placeholder="Enter Room Number">
				</div>
				<br/>
				<div class="body01">
					<label>Mobile Number :</label><br/>
					<input type="number" name="mobile_number" id="mobile_number" placeholder="Enter Mobile Number">
				</div>
				<br/>
				<div class="body01">
					<label>E-mail Address :</label><br/>
					<input type="email" name="email" id="email" placeholder="Enter e-mail">
				</div>
				<br/>
				
				<div class="body01">
					<input type="radio" name="gender" value="male" id="male">
					<label for="male">Male</label>
					<input type="radio" name="gender" value="female" id="female">
					<label for="female">Female</label>

				</div>
				<br/>
				<div>
					<label>Date of birth</label>
					<input type="date" name="dob" id="dob" >
				</div>
				</br>
				<div>
					<label>Country</label>
					<select name="country" id="country">
						<option value="usa">United States</option>
						<option value="canada">Canada</option>
						<option value="uk">United Kingdom</option>
						<option value="Australia">Australia</option>
						<option value="India">India</option>
						<option value="china">China</option>
						<option value="Sri Lanka">Sri Lanka</option>
					</select>
				</div>
				</br>
				<div>
					<p>Food Cuisine</p>
                    <div class="body02">
                        <label class='body02_lbl'>🍲 Indian :</label><br/>
                        <label><input type="checkbox" name="dishes" id="dish1" value="Test Dish 01 - Indian"> Test Dish 01</label>
                        <label><input type="checkbox" name="dishes" id="dish2" value="Test Dish 02 - Indian"> Test Dish 02</label>
                        <label><input type="checkbox" name="dishes" id="dish3" value="Test Dish 03 - Indian"> Test Dish 03</label>
                    </div>
					<div class="body02">
                        <label class='body02_lbl'>🍝 Sri Lankan :</label><br/>
                        <label><input type="checkbox" name="dishes" id="dish4" value="Test Dish 04 - Sri Lankan"> Test Dish 04</label>
                        <label><input type="checkbox" name="dishes" id="dish5" value="Test Dish 05 - Sri Lankan"> Test Dish 05</label>
                        <label><input type="checkbox" name="dishes" id="dish6" value="Test Dish 06 - Sri Lankan"> Test Dish 06</label>
                    </div>	
				</div>
				</br>

				<div class="bodybtn">
					<button type="button" onclick="saveData()">Save</button>
				</div>

			</form>
		</div>
	</div>
<!-- form serialies -->
<script>
    function saveData() {

		var dishes = $("input[name='dishes']:checked").map(function(){
    		return $(this).val();
		}).get();
		var dishesStr = dishes.toString();
		// console.log(dishesStr);
		// console.log(typeof dishesStr);
		// alert ('arguments passed');
       	$.ajax({
            type: "POST",
            url:"<?php echo Yii::app()->baseUrl;?>/index.php?r=site/guestSaveData",

            data: {guest_name:$('#guest_name').val(),room_number:$('#room_number').val()
			,mobile_num:$('#mobile_number').val(),email:$('#email').val(),gender:$("input[name='gender']:checked").val(),
			country:$('#country').val(),dob:$('#dob').val(),dishes:dishesStr
            },
			
            success: function (data) {
               	var response = JSON.parse(data);
				if (response.status == 'success') {
					console.log('Guest data saved successfully.', response.data);
					alert('Guest data saved successfully.');
				} else if (response.status == 'error') {
					console.error('Something went wrong.', response.message);
					alert('Error: ' + response.message);
				}
            }
						
        });
    }

	function searchData() {
		$.ajax({
            type: "POST",
            url:"<?php echo Yii::app()->baseUrl;?>/index.php?r=site/guestSearch",

            data: {search: $('#search').val()},
            
            success: function (data) {
				// var response = JSON.parse(data);
				// console.log(response);
				// if(response.status == 1){
                    $('#insert').hide();
					$('#update').show();
					$('#update').html(data);
				//}
                // if (data =='success') {
                //     alert(data);
                // } else {
                //    alert("wrong data");
                // }
            }
            
        });
    }
	
</script>