$(document).ready( () => {
    // gestion du formulaire de création des produits
    $('#addProduct').on('click', () => {
        $('.addProduct-form').css('display', 'inline');
    });

    $('.cancel-btn').on('click', () => {
        $('.addProduct-form').css('display', 'none');
    })

    
});