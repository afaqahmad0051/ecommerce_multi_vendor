const site_url = "http://127.0.0.1:8000/";

$("body").on("keyup","#search", function(){
    let text = $('#search').val();
    // console.log(text);
    if (text.length > 0) {
        $.ajax({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },
            data: {search:text},
            url: site_url + "product/ajax-search",
            method: "POST",
            // beforeSend: function(request){
            //     return request.setRequestHeader('X-CSRF-TOKEN',('meta[name="csrf-token"]'))
            // },
            success:function(result){
                $("#searchProducts").html(result)

            }
        })
    }
    if (text.length < 1) $("#searchProducts").html("")
})