

function handleDeleteButtons()
{
    $('button[data-action="delete"]').click(function(){
        const target = this.dataset.target;
        $(target).remove();
    });
}

function updateCounter()
{
    const count = +$('#ad_images div.form-group').length;

    $('#widgets-counter').val(count);
}


updateCounter();
handleDeleteButtons();