import {runInputmask} from "../../../inputMark";

let lastIndex = 0;
const addFormToCollectionDetailProduit = () => {
    $('#add-collection-detail-produit').click(function (e) {
        const list = $($(this).attr('data-list-selector'));
        const $widget = $('#widget-counter-detail-produit');
        const index = +$widget.val();
        // Try to find the counter of the list or use the length of the list

        // grab the prototype template
        let newWidget = list.attr('data-prototype');
        // replace the "__name__" used in the id and name of the prototype
        // with a number that's unique to your emails
        // end name attribute looks like name="contact[emails][2]"
        newWidget = newWidget.replace(/__name__/g, index);
        // Increase the counter
        $widget.val(index + 1);
        // And store it, the length cannot be used if deleting widgets is allowed
        list.data('widget-counter-detail-produit', index);
        lastIndex = index
        // create a new list element and add it to the list
        $('#table_detail_produit tbody').append(newWidget);
        $('select.select2').select2({width: '100%'})
        addTagFormDeleteLinkDetailProduit(newWidget);
        runInputmask()
    });
};
const addTagFormDeleteLinkDetailProduit = () => {
    $('body').on('click', '.delete-detail-Produit', function () {
        const target = $(this).attr('data-target');
        $(target).remove();
    });
};

addFormToCollectionDetailProduit();
addTagFormDeleteLinkDetailProduit();
