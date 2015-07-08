
//Autocompletes client id and client name in popup form
function modalAutoComplete () {
    var clientId = $('#client-id').val();
    var clientName = $('#client-name').val();
    
    $('.modal-show').on('click', function() {        
        $('#w2').val(clientName);
        $('#product-client_id').val(clientId);       
        $('#w1').attr('action', '#');
    });
}

//Reload client related products after creating new one
function reloadRelatedProducts() {
    var modalWindow = $('.modal');
    var productList = $('.list-group');    
    var button = $('.create-product');
    button.attr('type', 'button');    
    
    button.on('click', function() {
        $.when(saveRelatedProducts()).done(function(newProduct){
            //if product was saved properly, we remove popup and
            //refresh list of related products
            if (newProduct.length !== 0) {                    
                var listElem = $('<li class="list-group-item"></li>');

                //appending new product to list                    
                listElem.append($('<a href="/products/' 
                        + newProduct.id + '">' 
                        + newProduct.name 
                        + '</a><div class="pull-right">'
                        + newProduct.price + ' $</div>' ));
                productList.append(listElem);

                //popup remove
                modalWindow.removeClass('in').css('display', 'none');
                $(".modal-backdrop").remove();
                $('body').removeClass('modal-open');
            } else {
                console.log('failure');
            }
        });
    });
}

//saves related product through ajax
function saveRelatedProducts() {
    var form = $('form#w1');
    var formData = form.serialize();

    return $.ajax({
        url: '/product/ajax-create', 
        method: 'POST',
        data: formData, 
        success: function(response){
            console.log('call done');
            return response;
        },
        error: function() {
            console.log('call not done');
        }
    });
    
}

//discards all deleted products from db
function discardDeleted() {
    $('#discard').on('click', function(e) {        
        var conf = confirm("Do you want to discard all deleted products?");
        e.preventDefault();
        if (confirm) {
            $.ajax({
                url: '/product/discard',
                method: 'GET',
                success: function() {
                    var table = $('#w0');
                    table.find('tbody').html('<tr><td colspan="6"><div class="empty">No results found.</div></td></tr>');
                },
                error: function() {
                    console.log('error');
                }
            });
        }
    });
}

$(document).ready(function() {
    modalAutoComplete();
    reloadRelatedProducts();
    discardDeleted();
});