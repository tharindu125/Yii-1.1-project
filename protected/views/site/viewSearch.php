<table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Guest name</th>
                <th>Room number</th>
                <th>Mobile Number</th>
                <th>email</th>
                <th>gender</th>
                <th>Date of Birth</th>
                <th>country</th>
                <th>Dishes</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($view as $data){ ?>
        
        <tr>
            <td><?php echo $data["guest_id"] ?></td>
            <td><?php echo $data["guest_name"] ?></td>
            <td><?php echo $data["room_number"] ?></td>
            <td><?php echo $data["mobile_number"] ?></td>
            <td><?php echo $data["email"] ?></td>
            <td><?php echo $data["gender"] ?></td>
            <td><?php echo $data["dob"] ?></td>
            <td><?php echo $data["country"] ?></td>
            <td><?php echo $data["dishes"] ?></td>
            
            <td><button type="button" onclick="deleteData(<?php echo $data['guest_id']; ?>)">Delete</button></td>
        </tr>


        <?php  } ?>

        </tbody>
    </table>

    <script>

        function deleteData(guestId) {
            jQuery.ajax({
                url:"<?php echo Yii::app()->baseUrl;?>/index.php?r=site/deleteData",  // replace with your server-side script URL
                type: 'POST',
                data: { 
                    id: guestId,
                    },
                success: function (data) {
                    var response = JSON.parse(data);
                    console.log(response);
                    if(response.status == 1){
                        alert ('Deleted Successfully');
                        location.reload();
                    }else{
                        alert ('Deleted Error');
                    }
                }  
            });
        }

    </script>