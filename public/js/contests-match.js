$('.add-match-btn').click(function() {
    $(this).parent('.create-form').append('<div><input type="text" name="home[]" /> vs <input type="text" name="opponent[]" /> <span class="remove-match-btn btn btn-primary">x</span></div>');
});

$('body').on('click', '.remove-match-btn', function() {
    $(this).parent().remove();
});