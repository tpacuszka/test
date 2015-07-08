//add new item to quote
function addItem() {    
    var itemsBody = $('#items-body');
    $('#add-item').on('click', function(){
        var item = $(".item").first().clone().removeClass('hide').hide();
        itemsBody.append(item);  
        item.show('slow');
        correctSeqNumber();
    });
}

//remove item from quote
function removeItem() {
    $('#items-body').on('click', '.glyphicon-trash', function() {
        $(this).closest('tr').hide('slow', function() {
            $(this).remove();
            correctSeqNumber();
        });        
    });
}

//corrects attributes seq number to proper one
function correctSeqNumber () {
    var items = $(".item");
    var tagNames = ['item-name', 'item-description', 'item-data',
                'item-amount', 'item-price', 'item-discount',
                'item-final'];
    items.each(function(index, item) {
        var that = this;
        if (index !== 0) {
            $.each(tagNames, function(j, tagName) {
                var currentItem = $(that).find("."+tagName);
                currentItem.attr("name", tagName + index);
                currentItem.attr("id", tagName + index);
            });
        }
    });
    $("#items-amount").val(items.length - 1);
}

//function submits quote and products forms
function submitQuote() {
    $(".create-quote").on("click", function(e) {
        e.preventDefault();        
        var forms = $("#w0, #product-form").serialize();
        $.ajax({
            url: $("#w0").attr('action'),
            method: "POST",
            //data: quoteForm,
            data: forms,
            success: function(response) {
                console.log(response);                
            },
            error: function() {
                console.log("not done");
            }
        });
    });
}

$(document).ready(function() {
    correctSeqNumber();
    addItem();
    removeItem();    
    submitQuote();
});