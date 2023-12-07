<script>


         function checkPermissionByGroup(className, checkThis){
            const groupIdName = $("#"+checkThis.id);
            const classCheckBox = $('.'+className+' input');

            if(groupIdName.is(':checked')){
                 classCheckBox.prop('checked', true);
             }else{
                 classCheckBox.prop('checked', false);
             }
         }

         function checkSinglePermission(groupClassName, groupID, countTotalPermission) {
            const classCheckbox = $('.'+groupClassName+ ' input');
            const groupIDCheckBox = $("#"+groupID);

            // if there is any occurance where something is not selected then make selected = false
            if($('.'+groupClassName+ ' input:checked').length == countTotalPermission){
                groupIDCheckBox.prop('checked', true);
            }else{
                groupIDCheckBox.prop('checked', false);
            }
         }

         function checkPermissionAll(allInput, checkThis) {
            const allId = $("#"+checkThis.id);
            const allInputCheck = $('.'+allInput+' input');

            if(allId.is(':checked')){
                 allInputCheck.prop('checked', true);
             }else{
                 allInputCheck.prop('checked', false);
             }
         }


</script>
