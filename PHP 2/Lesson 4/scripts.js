$(document).ready(function(){

    var inProgress = false;
    var startFrom = 25;

    var total = +document.querySelector('.data-php').getAttribute('data-attr');

    $('#more').click(function() {
        $.ajax({

        url: 'handler.php',
        method: 'POST',
        data: {"startFrom" : startFrom},

        beforeSend: function() {inProgress = true;}

        }).done(function(data){

        data = jQuery.parseJSON(data);

        if (data.length > 0) {
            $.each(data, function(index, data){
            $("#products_box").append(`
                <div class='product'>
                    <span class='prod_name'>${data.name}</span>
                    <span class='prod_cost'>${data.cost} руб.</span>
                    <span class='prod_desc'>${data.description}</span>
                </div>
            `);

        });

        inProgress = false;
        startFrom += 25;

        if (startFrom >= total) {
            document.querySelector('#more').style.color = 'grey';
        }
        }});
    });
});
