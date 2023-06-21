<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>

<div>
    <input type="text" placeholder="Enter Name or Room no" id="view_search" name="view_search" onkeyup="viewSearch()">
</div>
</br>

<div id= "viewData">
    
</div>

<script>

$(document).ready(function(e) {
    viewSearch();
});

    function viewSearch() {
        // alert ('Search Successfully');
        $.ajax({
            url:"<?php echo Yii::app()->baseUrl;?>/index.php?r=site/viewSearch",
            type: 'POST',
            data: { 
                view_search:$('#view_search').val()
                },
           
            success: function (data) {
					$('#viewData').show();
					$('#viewData').html(data);
            //     var response = JSON.parse(data);
			// 	console.log(response);
			// 	if(response.status == 1){
            //         alert ('Deleted Successfully');
            //         location.reload();
			// 	}else{
            //         alert ('Deleted Error');
            //     }
            }  
        });
    }
</script>

