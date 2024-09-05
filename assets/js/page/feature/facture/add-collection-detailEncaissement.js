import {runInputmask} from "../../../inputMark";

let lastIndex = 0;
const addFormToCollectionDetailFacture = () => {
    $('#add-collection-detail-encaissement').click(function (e) {
        const list = $($(this).attr('data-list-selector'));
        const $widget = $('#widget-counter-detail-encaissement');
        const index = +$widget.val();

        let newWidget = list.attr('data-prototype');

        newWidget = newWidget.replace(/__name__/g, index);

        $widget.val(index + 1);

        list.data('widget-counter-detail-encaissement', index);
        lastIndex = index

        $('#table_detail_encaissement tbody').append(newWidget);
        $('select.select2').select2({width: '100%'})
        addTagFormDeleteLinkDetailFacture(newWidget);
        runInputmask()
    });
};
const addTagFormDeleteLinkDetailFacture = () => {
    $('body').on('click', '.delete-encaissement', function () {
        const target = $(this).attr('data-target');
        $(target).remove();
    });
};

addFormToCollectionDetailFacture();
addTagFormDeleteLinkDetailFacture();