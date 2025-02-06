$(document).ready(function() {
    // Fonction pour mettre à jour les options des factures
    function updateFacturesOptions(clientId, selectElement) {
        if (clientId) {
            $.ajax({
                url: `/facture/get/references?clientId=${clientId}`,
                type: 'GET',
                success: function (data) {
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
                                        .data('total', ref.totalHT)
                                        .data('reste', ref.reste);
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
                                            .data('total', ref.totalHT)
                                            .data('reste', ref.reste);
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
        } else {
            // Réinitialiser les options lorsque aucun client n'est sélectionné
            $('.encaissement_detatilEncaissements_0_facture').each(function () {
                const select = $(this);
                select.empty();
                const placeholderOption = $('<option></option>')
                    .val('')
                    .text('Sélectionnez une facture')
                    .prop('disabled', true)
                    .prop('selected', true);
                select.append(placeholderOption);
            });
        }
    }

    // Gérer le changement de client
    $('#encaissement_clients').change(function () {
        const clientId = $(this).val();
        updateFacturesOptions(clientId);
    });

    // Gérer le changement de facture
    $('body').on('change', '.encaissement_detatilEncaissements_0_facture', function () {
        const selectedOption = $(this).find('option:selected');
        const totalTTC = selectedOption.data('total');
        const reste = selectedOption.data('reste');
        const montantDuField = $(this).closest('tr').find('.encaissement_detatilEncaissements_0_montantDu');

        if (reste !== undefined && reste > 0) {
            montantDuField.val(reste);
        } else {
            montantDuField.val(totalTTC);
        }
        updateSolde($(this).closest('tr'));
    });

    // Calcul du solde
    $('body').on('input', '.montantVerse', function () {
        updateSolde($(this).closest('tr'));
    });

    // Fonction pour mettre à jour le solde
    function updateSolde(row) {
        const montantDu = parseFloat(row.find('.encaissement_detatilEncaissements_0_montantDu').val()) || 0;
        const montantVerse = parseFloat(row.find('.montantVerse').val()) || 0;
        const soldeField = row.find('.soled');

        const solde = montantDu - montantVerse;
        soldeField.val(solde.toFixed(0));
    }

    // Mettre à jour le montant depuis l'encaissement
    function updateMontantFromEncaissement() {
        const montantVerseValue = parseFloat($('.montantVerse').val()) || 0;

        if (montantVerseValue) {
            const modePayementTable = $('#table_detail_ModePayement');
            if (modePayementTable.length) {
                const modePayementRow = modePayementTable.find('.data-row').last();
                if (modePayementRow.length) {
                    const montantField = modePayementRow.find('[name$="[montant]"]');
                    if (montantField.length) {
                        montantField.val(montantVerseValue);
                    } else {
                        console.log('Aucun champ montant trouvé dans la dernière ligne ajoutée');
                    }
                } else {
                    console.log('Aucune ligne trouvée dans ModePayement');
                }
            } else {
                console.log('Tableau ModePayement introuvable');
            }
        }
    }

    // Ajouter un détail d'encaissement
    $('#add-collection-detail-encaissement').click(function () {
        const clientId = $('#encaissement_clients').val();
        if (clientId) {
            const newFactureSelect = $('.encaissement_detatilEncaissements_0_facture').last();
            if (newFactureSelect.length) {
                updateFacturesOptions(clientId, newFactureSelect);
            }
            updateMontantFromEncaissement();
        }
    });

    // Gérer l'affichage dynamique des colonnes selon le mode de paiement
    const modePayementSelect = $('#encaissement_modePayement');
    const initialDisplay = {
        compteBanque: '',
        banqueClient: '',
        headerCompteBanque: '',
        headerBanqueClient: ''
    };

    function getInitialColumnDisplay() {
        const table = document.getElementById('table_detail_ModePayement');
        if (table) {
            const rows = table.querySelectorAll('thead th');
            rows.forEach(cell => {
                const textContent = cell.textContent.trim();
                if (textContent === 'Numéro Compte Banque') {
                    initialDisplay.headerCompteBanque = cell.style.display || '';
                } else if (textContent === 'Banque client') {
                    initialDisplay.headerBanqueClient = cell.style.display || '';
                }
            });
            const firstRow = table.querySelector('.data-row');
            if (firstRow) {
                initialDisplay.compteBanque = firstRow.querySelector('.compte-banque').style.display || '';
                initialDisplay.banqueClient = firstRow.querySelector('.banque-client').style.display || '';
            }
        }
    }

    function toggleFields() {
        const selectedValue = modePayementSelect.val();
        const table = document.getElementById('table_detail_ModePayement');
        if (!table) {
            return;
        }

        const rows = table.querySelectorAll('.data-row');
        const headerCells = table.querySelectorAll('thead th');

        rows.forEach(row => {
            const compteBanqueCell = row.querySelector('.compte-banque');
            const banqueClientCell = row.querySelector('.banque-client');

            if (selectedValue === '2' || selectedValue === '3') {
                compteBanqueCell.style.display = 'none';
                banqueClientCell.style.display = '';
            } else if (selectedValue === '1') {
                compteBanqueCell.style.display = '';
                banqueClientCell.style.display = 'none';
            } else {
                compteBanqueCell.style.display = initialDisplay.compteBanque;
                banqueClientCell.style.display = initialDisplay.banqueClient;
            }
        });

        headerCells.forEach(cell => {
            const textContent = cell.textContent.trim();
            if (textContent === 'Numéro Compte Banque') {
                cell.style.display = selectedValue === '2' || selectedValue === '3' ? 'none' : initialDisplay.headerCompteBanque;
            }
            if (textContent === 'Banque client') {
                cell.style.display = selectedValue === '1' ? 'none' : initialDisplay.headerBanqueClient;
            }
        });
    }

    function initNewRows() {
        toggleFields();
        updateMontantFromEncaissement();
    }

    getInitialColumnDisplay();
    toggleFields();

    modePayementSelect.on('change.select2', function() {
        toggleFields();
    });

    const observer = new MutationObserver(() => {
        initNewRows();
    });

    const tableElement = document.getElementById('table_detail_ModePayement');
    if (tableElement) {
        observer.observe(tableElement, { childList: true, subtree: true });
    }

    // Validation du formulaire à la soumission
    $('#votreFormulaire').submit(function(event) {
        event.preventDefault(); // Empêche la soumission par défaut

        const clientId = $('#encaissement_clients').val();

        // Vérification de la valeur de #encaissement_clients
        console.log('Valeur de #encaissement_clients:', clientId);

        // Vérification de la sélection du client
        if (!clientId || clientId.trim() === '') {
            alert("Veuillez sélectionner un client.");
            return; // Empêcher la soumission si aucun client n'est sélectionné
        }

        const data = $(this).serialize(); // Sérialiser les données du formulaire

        // Soumettre les données via AJAX
        $.ajax({
            url: '/votre-url-de-soumission',
            type: 'POST',
            data: data,
            success: function(response) {
                console.log('Formulaire soumis avec succès');
                // Gérer la réponse ici, par exemple en réinitialisant certains champs ou en affichant un message de succès.
            },
            error: function(error) {
                console.error('Erreur lors de la soumission du formulaire:', error);
            }
        });
    });
});


// js encaissement seull



// $(document).ready(function() {
//     function updateFacturesOptions(clientId, selectElement) {
//         if (clientId) {
//             $.ajax({
//                 url: `/facture/get/references?clientId=${clientId}`,
//                 type: 'GET',
//                 success: function (data) {
//                     // console.log('Références récupérées :', data);
//                     if (selectElement) {
//                         selectElement.empty();
//                         const placeholderOption = $('<option></option>')
//                             .val('')
//                             .text('Sélectionnez une facture')
//                             .prop('disabled', true)
//                             .prop('selected', true);
//                         selectElement.append(placeholderOption);
//                         if (Array.isArray(data)) {
//                             data.forEach(ref => {
//                                 if (ref.label) {
//                                     const option = $('<option></option>')
//                                         .val(ref.id)
//                                         .text(ref.label)
//                                         .data('total', ref.totalTTC)
//                                         .data('reste', ref.reste);
//                                     selectElement.append(option);
//                                 }
//                             });
//                         } else {
//                             // console.error('Les données récupérées ne sont pas un tableau:', data);
//                         }
//                     } else {
//                         $('.encaissement_detatilEncaissements_0_facture').each(function () {
//                             const select = $(this);
//                             select.empty();
//                             const placeholderOption = $('<option></option>')
//                                 .val('')
//                                 .text('Sélectionnez une facture')
//                                 .prop('disabled', true)
//                                 .prop('selected', true);
//                             select.append(placeholderOption);
//                             if (Array.isArray(data)) {
//                                 data.forEach(ref => {
//                                     if (ref.label) {
//                                         const option = $('<option></option>')
//                                             .val(ref.id)
//                                             .text(ref.label)
//                                             .data('total', ref.totalTTC)
//                                             .data('reste', ref.reste);
//                                         select.append(option);
//                                     }
//                                 });
//                             } else {
//                                 // console.error('Les données récupérées ne sont pas un tableau:', data);
//                             }
//                         });
//                     }
//                 },
//                 error: function (xhr, status, error) {
//                     // console.error('Erreur lors de la récupération des références :', error);
//                 }
//             });
//         }
//     }
//
//     $('#encaissement_clients').change(function () {
//         const clientId = $(this).val();
//         updateFacturesOptions(clientId);
//     });
//
//     $('body').on('change', '.encaissement_detatilEncaissements_0_facture', function () {
//         const selectedOption = $(this).find('option:selected');
//         const totalTTC = selectedOption.data('total');
//         const reste = selectedOption.data('reste');
//         const montantDuField = $(this).closest('tr').find('.encaissement_detatilEncaissements_0_montantDu');
//
//         // Affiche 'reste' si différent de 0, sinon affiche 'totalTTC'
//         if (reste !== undefined && reste > 0) {
//             montantDuField.val(reste);
//         } else {
//             montantDuField.val(totalTTC);
//         }
//         updateSolde($(this).closest('tr'));
//     });
//
//     $('body').on('input', '.montantVerse', function () {
//         updateSolde($(this).closest('tr'));
//     });
//
//     function updateSolde(row) {
//         const montantDu = parseFloat(row.find('.encaissement_detatilEncaissements_0_montantDu').val()) || 0;
//         const montantVerse = parseFloat(row.find('.montantVerse').val()) || 0;
//         const soldeField = row.find('.soled');
//
//         const solde = montantDu - montantVerse;
//         soldeField.val(solde.toFixed(0));
//     }
//
//     $('#add-collection-detail-encaissement').click(function () {
//         const clientId = $('#encaissement_clients').val();
//         if (clientId) {
//             const newFactureSelect = $('.encaissement_detatilEncaissements_0_facture').last();
//             if (newFactureSelect.length) {
//                 updateFacturesOptions(clientId, newFactureSelect);
//             }
//         }
//     });
// });
