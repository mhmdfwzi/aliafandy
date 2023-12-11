(function ($) {
    $(".item_quantity").on("change", function (e) {
        $.ajax({
            url: "/cart/" + $(this).data("id"),
            method: "put",
            data: {
                quantity: $(this).val(),
                _token: csrf_token,
            },
        });
    });

    $(".remove-item").on("click", function (e) {
        let id = $(this).data("id");
        $.ajax({
            url: "/cart/" + id,
            method: "delete",
            data: {
                _token: csrf_token,
            },
            //  success: response =>{
            //           $(`#${id}`).remove();
            //  }
            success: function (response) {
                // toastr.error("تم حذف المنتج من العربة بنجاح");

                $(`#${id}`).remove(); // Use $id instead of id

                // Update the cart UI with the new content
                $("#cartContainer").html(response.cartHtml);

                $(".total-items").text(response.totalItems);
            },
            error:function(error){
                console.log(error);
            }
        });
    });
})(jQuery);
