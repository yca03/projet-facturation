document.addEventListener('DOMContentLoaded', function () {
    const factureId = $('#facture_IdClient');
    const toggleReadOnly = () => {
        const isReadonly = factureId.val() === '3';
        $('input[name*="periode"]').prop('readonly', isReadonly);
        console.log('Période readonly:', isReadonly);
    };

    factureId.change(toggleReadOnly);
    toggleReadOnly();

    new MutationObserver(() => toggleReadOnly()).observe(document.body, { childList: true, subtree: true });
});
