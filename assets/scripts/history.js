$(document).ready(function() {

    var table = $('#historyTable').DataTable();
 
    // #column3_search is a <input type="text"> element
    $('#periode').on( 'keyup', function () {
        table
            .columns( 1 )
            .search( this.value )
            .draw();
    } );
    $('#nature').on( 'keyup', function () {
        table
            .columns( 2 )
            .search( this.value )
            .draw();
    } );
    $('#etab').on( 'keyup', function () {
        table
            .columns( 3 )
            .search( this.value )
            .draw();
    } );
    $('#promo').on( 'keyup', function () {
        table
            .columns( 4 )
            .search( this.value )
            .draw();
    } );
    $('#year').on( 'keyup', function () {
        table
            .columns( 5 )
            .search( this.value )
            .draw();
    } );
    $('#intervalle').on( 'keyup', function () {
        table
            .columns( 6 )
            .search( this.value )
            .draw();
    } );

    // Setup - add a text input to each footer cell

} );