$(document).ready(function(){
    $(".date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true, 
        changeYear: true,
    });
    
    $('#studentTable').DataTable();
   
});