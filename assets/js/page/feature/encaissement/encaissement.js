$(document).ready(function() {
    function updateFacturesOptions(clientId, selectElement) {
        if (clientId) {
            $.ajax({
                url: `/facture/get/references?clientId=${clientId}`,
                type: 'GET',
                success: function (data) {
                    console.log('Références récupérées :', data);
                    if (selectElement) {
                        selectElement.empty();
                        const placeholderOption = $('<option></option>')
                            .val('')
                            .text('Sélectionnez une facture')
                            .prop('disabled', true)
                            .prop('selected', true);
                        selectElement.append(placeholderOption);
                        if (Array.isArray(data)) {
                            data.forEach(ref => {
                                if (ref.label) {
                                    const option = $('<option></option>')
                                        .val(ref.id)
                                        .text(ref.label)
                                        .data('total', ref.totalTTC);
                                    selectElement.append(option);
                                }
                            });
                        } else {
                            console.error('Les données récupérées ne sont pas un tableau:', data);
                        }
                    } else {
                        $('.encaissement_detatilEncaissements_0_facture').each(function () {
                            const select = $(this);
                            select.empty();
                            const placeholderOption = $('<option></option>')
                                .val('')
                                .text('Sélectionnez une facture')
                                .prop('disabled', true)
                                .prop('selected', true);
                            select.append(placeholderOption);
                            if (Array.isArray(data)) {
                                data.forEach(ref => {
                                    if (ref.label) {
                                        const option = $('<option></option>')
                                            .val(ref.id)
                                            .text(ref.label)
                                            .data('total', ref.totalTTC);
                                        select.append(option);
                                    }
                                });
                            } else {
                                console.error('Les données récupérées ne sont pas un tableau:', data);
                            }
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Erreur lors de la récupération des références :', error);
                }
            });
        }
    }
    $('#encaissement_clients').change(function () {
        const clientId = $(this).val();
        updateFacturesOptions(clientId);
    });
    $('body').on('change', '.encaissement_detatilEncaissements_0_facture', function () {
        const selectedOption = $(this).find('option:selected');
        const totalTTC = selectedOption.data('total');
        const montantDuField = $(this).closest('tr').find('.encaissement_detatilEncaissements_0_montantDu');

        if (totalTTC !== undefined) {
            montantDuField.val(totalTTC);
            updateSolde($(this).closest('tr'));
        }
    });
    $('body').on('input', '.montantVerse', function () {
        updateSolde($(this).closest('tr'));
    });
    function updateSolde(row) {
        const montantDu = parseFloat(row.find('.encaissement_detatilEncaissements_0_montantDu').val()) || 0;
        const montantVerse = parseFloat(row.find('.montantVerse').val()) || 0;
        const soldeField = row.find('.soled');

        const solde = montantDu - montantVerse;
        soldeField.val(solde.toFixed(0));
    }
    $('#add-collection-detail-encaissement').click(function () {

        const clientId = $('#encaissement_clients').val();
        if (clientId) {

            const newFactureSelect = $('.encaissement_detatilEncaissements_0_facture').last();
            if (newFactureSelect.length) {
                updateFacturesOptions(clientId, newFactureSelect);
            }
        }
    });
});
