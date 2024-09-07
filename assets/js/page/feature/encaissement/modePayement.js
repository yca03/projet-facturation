// document.addEventListener('DOMContentLoaded', function() {
//     const modePayementSelect = $('#encaissement_modePayement');
//
//     if (!modePayementSelect.length) {
//         // console.error('Le sélecteur de mode de paiement avec l\'ID "encaissement_modePayement" est introuvable.');
//         return;
//     }
//
//     // Pour stocker l'état d'affichage initial des colonnes et en-têtes
//     const initialDisplay = {
//         compteBanque: '',
//         banqueClient: '',
//         headerCompteBanque: '',
//         headerBanqueClient: ''
//     };
//
//     function getInitialColumnDisplay() {
//         const table = document.getElementById('table_detail_ModePayement');
//         if (table) {
//             const rows = table.querySelectorAll('thead th');
//             rows.forEach(cell => {
//                 const textContent = cell.textContent.trim();
//                 if (textContent === 'Numéro Compte Banque') {
//                     initialDisplay.headerCompteBanque = cell.style.display || '';
//                 } else if (textContent === 'Banque client') {
//                     initialDisplay.headerBanqueClient = cell.style.display || '';
//                 }
//             });
//             // Initialiser les colonnes de données
//             const firstRow = table.querySelector('.data-row');
//             if (firstRow) {
//                 initialDisplay.compteBanque = firstRow.querySelector('.compte-banque').style.display || '';
//                 initialDisplay.banqueClient = firstRow.querySelector('.banque-client').style.display || '';
//             }
//         }
//     }
//
//     function toggleFields() {
//         const selectedValue = modePayementSelect.val();
//         // console.log('Mode de paiement sélectionné:', selectedValue);
//
//         const table = document.getElementById('table_detail_ModePayement');
//         if (!table) {
//             // console.error('Le tableau avec l\'ID "table_detail_ModePayement" est introuvable.');
//             return;
//         }
//
//         const rows = table.querySelectorAll('.data-row');
//         const headerCells = table.querySelectorAll('thead th');
//
//         rows.forEach(row => {
//             const compteBanqueCell = row.querySelector('.compte-banque');
//             const banqueClientCell = row.querySelector('.banque-client');
//
//             if (selectedValue === '2' || selectedValue === '3') { // Chèque bancaire ou Espèces
//                 compteBanqueCell.style.display = 'none';
//                 banqueClientCell.style.display = '';
//             } else if (selectedValue === '1') { // Autre mode de paiement
//                 compteBanqueCell.style.display = '';
//                 banqueClientCell.style.display = 'none';
//             } else {
//                 // Restauration de l'affichage initial si aucune sélection ou valeur non reconnue
//                 compteBanqueCell.style.display = initialDisplay.compteBanque;
//                 banqueClientCell.style.display = initialDisplay.banqueClient;
//             }
//         });
//
//         headerCells.forEach(cell => {
//             const textContent = cell.textContent.trim();
//             if (textContent === 'Numéro Compte Banque') {
//                 cell.style.display = selectedValue === '2' || selectedValue === '3' ? 'none' : initialDisplay.headerCompteBanque;
//             }
//             if (textContent === 'Banque client') {
//                 cell.style.display = selectedValue === '1' ? 'none' : initialDisplay.headerBanqueClient;
//             }
//         });
//     }
//
//     function initNewRows() {
//         // Initialiser les nouvelles lignes avec les champs visibles corrects
//         toggleFields();
//     }
//
//     // Capture de l'état initial des colonnes pour la restauration
//     getInitialColumnDisplay();
//
//     // Initial check
//     toggleFields();
//
//     modePayementSelect.on('change.select2', function() {
//         // console.log('Changement détecté dans le mode de paiement');
//         toggleFields();
//     });
//
//     // Observer pour gérer les lignes ajoutées dynamiquement
//     const observer = new MutationObserver(() => {
//         // console.log('Changement dans le DOM détecté');
//         initNewRows(); // Initialiser les nouvelles lignes
//     });
//
//     const tableElement = document.getElementById('table_detail_ModePayement');
//     if (tableElement) {
//         observer.observe(tableElement, { childList: true, subtree: true });
//     } else {
//         // console.error('Le tableau à observer n\'existe pas.');
//     }
// });
