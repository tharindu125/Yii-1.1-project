<form>
				
				<div>
					<label>Guest Name :</label><br/>
					<input type="text" value="<?php echo $search["guest_name"] ?>" id="guest_name" >
				</div>
				<br/>
				<div>
					<label>Room Number :</label><br/>
					<input type="number" value="<?php echo $search["room_number"] ?>" id="room_number" >
				</div>
				<br/>
				<div>
					<label>Mobile Number :</label><br/>
					<input type="number" value="<?php echo $search["mobile_number"] ?>" id="mobile_number" >
				</div>
				<br/>
				<div>
					<label>E-mail Address :</label><br/>
					<input type="email" value="<?php echo $search["email"] ?>" id="email" >
				</div>
				<br/>
				<div>
					<input type="radio" name="gender" value="male" id="male" 
						<?php echo ($search["gender"] == "male") ? "checked" : ""; ?>>
					<label for="male">Male</label>
					<input type="radio" name="gender" value="female" id="female" 
						<?php echo ($search["gender"] == "female") ? "checked" : ""; ?>>
					<label for="female">Female</label>
				</div>

				<br/>
				<div>
					<label>Date Of Birth :</label><br/>
					<input type="date" value="<?php echo $search["dob"] ?>" id="dob" > 
				</div>
				<br/>
				<div>
					<label>Country</label>
					<select name="country" id="country" value="<?php echo $search["country"] ?>">
						<option value="usa">United States</option>
						<option value="canada">Canada</option>
						<option value="uk">United Kingdom</option>
						<option value="Australia">Australia</option>
						<option value="India">India</option>
						<option value="china">China</option>
						<option value="Sri Lanka">Sri Lanka</option>
					</select>
				</div>
				<br/>
				<div>
					<label>Food Cuisine</label>
					<select name="food" id="food" onchange="selectFood()">
						<option selected disabled value="">Select Food</option>
						<?php foreach($food as $data){ ?>
						<option value="<?php echo $data["food_id"] ?>"><?php echo $data["food_type"] ?></option>
						<?php  }  ?>
					</select></br>

					<div id="dishes"></div>				

				</div>
				<br/>

				<div>
					<button type="button" onclick="updateData()">Update</button>
				</div>
</form>


<?php 
	$id = $search["guest_id"] ;
?> 

<script>
	var guest_id = "<?php echo $id; ?>";
	function updateData() {
		alert ( "Update" );

		var dishes = $("input[name='dishes']:checked").map(function(){
    		return $(this).val();
		}).get();
		var dishesStr = dishes.toString();

		$.ajax({
            type: "POST",
            url:"<?php echo Yii::app()->baseUrl;?>/index.php?r=site/updateData",

            data: {guest_id: guest_id, guest_name:$('#guest_name').val(),room_number:$('#room_number').val()
			,mobile_num:$('#mobile_number').val(),email:$('#email').val(),gender:$("input[name='gender']:checked").val(),
			country:$('#country').val(),dob:$('#dob').val(),food_type:$('#food').val()
            },
			
            success: function (data) {
                var response = JSON.parse(data);
				if (response.status == 'success') {
					console.log('Guest data update successfully.', response.data);
					alert('Guest data update successfully.');
				} else if (response.status == 'error') {
					console.error('Something went wrong.', response.message);
					alert('Error: ' + response.message);
				}
            }					
        });
	}
</script>