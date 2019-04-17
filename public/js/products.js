$(document).ready( () => {
    // gestion du formulaire de création des produits
    $('#addProduct').on('click', () => {
        $('.addProduct-form').css('display', 'inline');
    });

    $('.addProduct-form .cancel-btn').on('click', () => {
        $('.addProduct-form .form-group input').val('');
        $('.addProduct-form').css('display', 'none');
    });

    $('.editProduct').on('click', event => {
        $(event.currentTarget).parent().next().css('display', 'inline');
    });

    $('.editProduct-form .cancel-btn').on('click', () => {
        $('.editProduct-form').css('display', 'none');
    });

});