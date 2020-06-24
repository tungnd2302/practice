$(".searchfield").click(function(event) {
    event.preventDefault()
    var titleSearch = $(this).html();
    fieldSearch = $(this).data('field');

    $("#contentSearch").data('field',fieldSearch);
    $("#contentSearch").html(titleSearch);
});

$("#searchButton").click(function(event){
    event.preventDefault();
    let searchParams= new URLSearchParams(window.location.search);
    let params 		= ['status'];

    let link		= "";
    $.each( params, function( key, param ) { // status
        if (searchParams.has(param) ) {
            link += param + "=" + searchParams.get(param) + "&" // status=0
        }
    });
    var contentSearch = $('input[name="search"]').val();
    var fieldSearch   =  $("#contentSearch").data('field');
    if(contentSearch == "" ){
        var redirectUrl = window.location.pathname + '?' + link;
        window.location.href = redirectUrl;
    }else{
        var redirectUrl = window.location.pathname + '?' + link + 'fieldSearch='+fieldSearch + '&contentSearch='+contentSearch;
        window.location.href = redirectUrl;
    }
})
