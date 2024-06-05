$('.basic-datatable').dataTable({
    dom: '<"row"<"col-sm-12 col-md-4"B><"col-sm-12 col-md-8"f>><"row"<"col-sm-12"t>><"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
    language: {
        paginate: {
            previous: '<i class="fa fa-lg fa-angle-left"></i>',
            next: '<i class="fa fa-lg fa-angle-right"></i>'
        },
        url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/fr-FR.json'
    },
    autoWidth: false,
    deferRender: true,
    order: [1, 'asc'],
    buttons: [
        'copy', 'print'
    ]
});

function getFormattedDate(dates) {
    var date = new Date(dates);
    var year = date.getFullYear();

    var month = (1 + date.getMonth());
    month = month.length > 1 ? month : '0' + month;

    var day = date.getDate();

    return day + '/' + month + '/' + year;
}

const $form = $('form[name="form_reporting_livraison"]');
$form.submit(function (e) {
    e.preventDefault();
    const $data = $(this).serialize();
    const tab = $data.split('&');
    const tab2_deb = tab[0].split('=');
    const tab2_fin = tab[1].split('=');
    const debut = tab2_deb[1];
    const fin = tab2_fin[1];
    $('#table-reporting-delivery').dataTable({
        bDestroy: true,
        bAutoWidth: true,
        /*drawCallback: function () {
          $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
        },*/
        fnFooterCallback: function (row, data, start, end, display) {
            end = data.length;
            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '') * 1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            function formatMillier(nombre) {
                return new Intl.NumberFormat('fr-FR', {
                    style: 'decimal'
                }).format(nombre);
            }

            let $cmde_super = 0;
            let $cmde_gasoil = 0;
            let $recu_super = 0;
            let $recu_gasoil = 0;
            let $ecart_super = 0;
            let $ecart_gasoil = 0;
            let $contre_super = 0;
            let $contre_gasoil = 0;

            for (let i = 0; i < end; i++) {
                $cmde_super += intVal(data[display[i]]['cmde_super']);
                $cmde_gasoil += intVal(data[display[i]]['cmde_gasoil']);
                $recu_super += intVal(data[display[i]]['recu_super']);
                $recu_gasoil += intVal(data[display[i]]['recu_gasoil']);
                $ecart_super += intVal(data[display[i]]['ecart_super']);
                $ecart_gasoil += intVal(data[display[i]]['ecart_gasoil']);
                $contre_super += intVal(data[display[i]]['contreplein_super']);
                $contre_gasoil += intVal(data[display[i]]['contreplein_gasoil']);
            }
            // Modifying the footer row
            let nCells = row.getElementsByTagName('th');
            nCells[1].innerHTML = formatMillier(parseInt($cmde_super));
            nCells[2].innerHTML = formatMillier(parseInt($cmde_gasoil));
            nCells[4].innerHTML = formatMillier(parseInt($recu_super));
            nCells[5].innerHTML = formatMillier(parseInt($recu_gasoil));
            nCells[6].innerHTML = formatMillier(parseInt($ecart_super));
            nCells[7].innerHTML = formatMillier(parseInt($ecart_gasoil));
            nCells[8].innerHTML = formatMillier(parseInt($contre_super));
            nCells[9].innerHTML = formatMillier(parseInt($contre_gasoil));
        },
        ajax: {
            url: `/api/reporting/delivery?${$data}`,
            dataSrc: ''
        },
        dom: '<"row"<"col-sm-12 col-md-4"B><"col-sm-12 col-md-8"f>><"row"<"col-sm-12"t>><"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        language: {
            paginate: {
                previous: '<i class="fa fa-lg fa-angle-left"></i>',
                next: '<i class="fa fa-lg fa-angle-right"></i>'
            }
        },
        columns: [
            { data: 'date', sClass: 'text-center' },
            { data: 'date_chargement', sClass: 'text-center' },
            { data: 'numcmde', sClass: 'text-left' },
            { data: 'cmde_super', sClass: 'text-right' },
            { data: 'cmde_gasoil', sClass: 'text-right' },
            { data: 'date_livraison', sClass: 'text-center' },
            { data: 'numbl', sClass: 'text-left' },
            { data: 'citerne', sClass: 'text-center' },
            { data: 'tractor', sClass: 'text-center' },
            { data: 'transporteur', sClass: 'text-center' },
            { data: 'recu_super', sClass: 'text-right' },
            { data: 'recu_gasoil', sClass: 'text-right' },
            { data: 'ecart_super', sClass: 'text-right' },
            { data: 'ecart_gasoil', sClass: 'text-right' },
            { data: 'contreplein_super', sClass: 'text-right' },
            { data: 'contreplein_gasoil', sClass: 'text-right' }
        ],
        buttons: [
            "copy",
            /* {
               extend: "print",
               customize: function (win) {
                 $(win.document.body)
                     .prepend(
                         '<div class="d-flex justify-content-between"> <div>Orbis Station</div> <div>Du ' + getFormattedDate(debut) + ' Au ' + getFormattedDate(fin) + '</div> <div>{{ "now"|date("m/d/Y") }}</div> </div>'
                     );
                 $(win.document.body).find('h1').replaceWith('<h6>Etat des Livraisons </h6>');
                 $(win.document.body).find('h6').addClass('text-center').css('color', 'black');
               },
             },*/
            'pdf'
        ],
        columnDefs: [
            {
                targets: 3,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 4,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 10,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 11,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 12,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 13,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 14,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 15,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
        ]
    });
});

const $formDepotage = $('form[name="form_reporting_depotage"]');
$formDepotage.submit(function (e) {
    e.preventDefault();
    const $data = $(this).serialize();
    const tab = $data.split('&');
    const tab2_deb = tab[0].split('=');
    const tab2_fin = tab[1].split('=');
    const debut = tab2_deb[1];
    const fin = tab2_fin[1];
    $('#table-reporting-depotage').dataTable({
        bDestroy: true,
        bAutoWidth: true,
        /*drawCallback: function () {
          $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
        },*/
        ajax: {
            url: `/api/reporting/depotage?${$data}`,
            dataSrc: ''
        },
        dom: '<"row"<"col-sm-12 col-md-4"B><"col-sm-12 col-md-8"f>><"row"<"col-sm-12"t>><"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        language: {
            paginate: {
                previous: '<i class="fa fa-lg fa-angle-left"></i>',
                next: '<i class="fa fa-lg fa-angle-right"></i>'
            }
        },
        columns: [
            { data: 'date', sClass: 'text-center' },
            { data: 'date_chargement', sClass: 'text-center' },
            { data: 'cuve', sClass: 'text-center' },
            { data: 'product', sClass: 'text-center' },
            { data: 'jauge_avant', sClass: 'text-right' },
            { data: 'qte_depot', sClass: 'text-right' },
            { data: 'qte_dispo', sClass: 'text-right' },
            { data: 'jauge_apres', sClass: 'text-right' },
            { data: 'ecart', sClass: 'text-right' },
            { data: 'chauffeur', sClass: 'text-center' },
        ],
        buttons: [
            "copy",
            /* {
               extend: "print",
               customize: function (win) {
                 $(win.document.body)
                     .prepend(
                         '<div class="d-flex justify-content-between"> <div>Orbis Station</div> <div>Du ' + getFormattedDate(debut) + ' Au ' + getFormattedDate(fin) + '</div> <div>{{ "now"|date("m/d/Y") }}</div> </div>'
             );
         $(win.document.body).find('h1').replaceWith('<h6>Etat des Livraisons </h6>');
         $(win.document.body).find('h6').addClass('text-center').css('color', 'black');
       },
     },*/
            'pdf'
        ],
        columnDefs: [
            {
                targets: 5,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 6,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 7,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 8,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
        ]
    });
});


const $formPompe = $('form[name="form_reporting_pompes"]');
$formPompe.submit(function (e) {
    e.preventDefault();
    const $data = $(this).serialize();
    const tab = $data.split('&');
    const tab2_deb = tab[0].split('=');
    const tab2_fin = tab[1].split('=');
    const debut = tab2_deb[1];
    const fin = tab2_fin[1];
    $('#table-reporting-pompes').DataTable({
        bDestroy: true,
        bAutoWidth: true,
        /*drawCallback: function () {
          $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
        },*/
        rowGroup: {
            dataSrc: 'cuve',
            enable: true,
            startRender: null,
            endRender: function (rows, group) {
                const intVal = function (i) {
                    return typeof i === 'string' ?
                        i.replace(/[\$, ' ']/g, '') * 1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                function formatMillier(nombre) {
                    return new Intl.NumberFormat('fr-FR', {
                        style: 'decimal'
                    }).format(nombre);
                }

                const number = rows.count();
                const vente = rows
                    .data()
                    .pluck('vente')
                    .reduce((a, b) => intVal(a) + intVal(b), 0);
                const retour = rows
                    .data()
                    .pluck('retourCuve')
                    .reduce((a, b) => intVal(a) + intVal(b), 0);
                const venteReel = rows
                    .data()
                    .pluck('venteReel')
                    .reduce((a, b) => intVal(a) + intVal(b), 0);
                const montant = rows
                    .data()
                    .pluck('montant')
                    .reduce((a, b) => intVal(a) + intVal(b), 0);

                return $('<tr/>')
                    .append(`<th colspan="5">${group}</th>`)
                    .append(`<th class="text-right">${formatMillier(vente)}</th>`)
                    .append(`<th class="text-right">${formatMillier(retour)}</th>`)
                    .append(`<th class="text-right">${formatMillier(venteReel)}</th>`)
                    .append(`<th class="text-right"></th>`)
                    .append(`<th class="text-right">${formatMillier(montant)}</th>`);
            },
        },
        ajax: {
            url: `/api/reporting/pompes?${$data}`,
            dataSrc: ''
        },
        dom: '<"row"<"col-sm-12 col-md-4"B><"col-sm-12 col-md-8"f>><"row"<"col-sm-12"t>><"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        language: {
            paginate: {
                previous: '<i class="fa fa-lg fa-angle-left"></i>',
                next: '<i class="fa fa-lg fa-angle-right"></i>'
            }
        },
        columns: [
            { data: 'date', sClass: 'text-center' },
            { data: 'cuve', sClass: 'text-center' },
            { data: 'pompe', sClass: 'text-center' },
            { data: 'ouverture', sClass: 'text-right' },
            { data: 'fermeture', sClass: 'text-right' },
            { data: 'vente', sClass: 'text-right' },
            { data: 'retourCuve', sClass: 'text-right' },
            { data: 'venteReel', sClass: 'text-right' },
            { data: 'pu', sClass: 'text-right' },
            { data: 'montant', sClass: 'text-right' },
        ],
        buttons: [
            "copy",
            /* {
               extend: "print",
               customize: function (win) {
                 $(win.document.body)
                     .prepend(
                         '<div class="d-flex justify-content-between"> <div>Orbis Station</div> <div>Du ' + getFormattedDate(debut) + ' Au ' + getFormattedDate(fin) + '</div> <div>{{ "now"|date("m/d/Y") }}</div> </div>'
             );
         $(win.document.body).find('h1').replaceWith('<h6>Etat des Livraisons </h6>');
         $(win.document.body).find('h6').addClass('text-center').css('color', 'black');
       },
     },*/
            'pdf'
        ],
        fnFooterCallback: function (row, data, start, end, display) {
            end = data.length;
            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '') * 1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            function formatMillier(nombre) {
                return new Intl.NumberFormat('fr-FR', {
                    style: 'decimal'
                }).format(nombre);
            }

            let $montantTotal = 0;

            for (let i = 0; i < end; i++) {
                $montantTotal += intVal(data[display[i]]['montant']);
            }
            // Modifying the footer row
            let nCells = row.getElementsByTagName('th');
            nCells[1].innerHTML = formatMillier(parseInt($montantTotal));
        },
        columnDefs: [
            {
                targets: 3,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 4,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 5,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 6,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 7,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 8,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 9,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
        ]
    });
});

const $formCuve = $('form[name="form_reporting_cuves"]');
$formCuve.submit(function (e) {
    e.preventDefault();
    const $data = $(this).serialize();
    const tab = $data.split('&');
    const tab2_deb = tab[0].split('=');
    const tab2_fin = tab[1].split('=');
    const debut = tab2_deb[1];
    const fin = tab2_fin[1];
    $('#table-reporting-cuves').DataTable({
        bDestroy: true,
        bAutoWidth: true,
        /*drawCallback: function () {
          $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
        },*/
        rowGroup: {
            dataSrc: 'product',
            enable: true,
            startRender: null,
            endRender: function (rows, group) {
                const intVal = function (i) {
                    return typeof i === 'string' ?
                        i.replace(/[\$, ' ']/g, '') * 1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                function formatMillier(nombre) {
                    return new Intl.NumberFormat('fr-FR', {
                        style: 'decimal'
                    }).format(nombre);
                }

                const number = rows.count();
                const reception = rows
                    .data()
                    .pluck('livraison')
                    .reduce((a, b) => intVal(a) + intVal(b), 0);
                const venteTheo = rows
                    .data()
                    .pluck('vente')
                    .reduce((a, b) => intVal(a) + intVal(b), 0);
                const ecart = rows
                    .data()
                    .pluck('ecart')
                    .reduce((a, b) => intVal(a) + intVal(b), 0);
                const valeur = rows
                    .data()
                    .pluck('valeur')
                    .reduce((a, b) => intVal(a) + intVal(b), 0);

                return $('<tr/>')
                    .append(`<th colspan="4">${group}</th>`)
                    .append(`<th class="text-right">${formatMillier(reception)}</th>`)
                    .append(`<th class="text-right">${formatMillier(venteTheo)}</th>`)
                    .append(`<th class="text-right" colspan="2"></th>`)
                    .append(`<th class="text-right">${formatMillier(ecart)}</th>`)
                    .append(`<th class="text-right"></th>`)
                    .append(`<th class="text-right">${formatMillier(valeur)}</th>`)
                    ;
            },
        },
        ajax: {
            url: `/api/reporting/cuves?${$data}`,
            dataSrc: ''
        },
        dom: '<"row"<"col-sm-12 col-md-4"B><"col-sm-12 col-md-8"f>><"row"<"col-sm-12"t>><"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        language: {
            paginate: {
                previous: '<i class="fa fa-lg fa-angle-left"></i>',
                next: '<i class="fa fa-lg fa-angle-right"></i>'
            }
        },
        columns: [
            { data: 'date', sClass: 'text-center' },
            { data: 'cuve', sClass: 'text-center' },
            { data: 'product' },
            { data: 'stock_initial', sClass: 'text-right' },
            { data: 'livraison', sClass: 'text-right' },
            { data: 'vente', sClass: 'text-right' },
            { data: 'stock_final', sClass: 'text-right' },
            { data: 'jaugeFermeture', sClass: 'text-right' },
            { data: 'ecart', sClass: 'text-right' },
            { data: 'percentage', sClass: 'text-right' },
            { data: 'valeur', sClass: 'text-right' },
        ],
        buttons: [
            "copy",
            /* {
               extend: "print",
               customize: function (win) {
                 $(win.document.body)
                     .prepend(
                         '<div class="d-flex justify-content-between"> <div>Orbis Station</div> <div>Du ' + getFormattedDate(debut) + ' Au ' + getFormattedDate(fin) + '</div> <div>{{ "now"|date("m/d/Y") }}</div> </div>'
             );
         $(win.document.body).find('h1').replaceWith('<h6>Etat des Livraisons </h6>');
         $(win.document.body).find('h6').addClass('text-center').css('color', 'black');
       },
     },*/
            'pdf'
        ],
        fnFooterCallback: function (row, data, start, end, display) {
            end = data.length;
            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '') * 1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            function formatMillier(nombre) {
                return new Intl.NumberFormat('fr-FR', {
                    style: 'decimal'
                }).format(nombre);
            }

            let $montantTotal = 0;

            for (let i = 0; i < end; i++) {
                $montantTotal += intVal(data[display[i]]['valeur']);
            }
            // Modifying the footer row
            let nCells = row.getElementsByTagName('th');
            nCells[1].innerHTML = formatMillier(parseInt($montantTotal));
        },
        columnDefs: [
            {
                targets: 3,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 4,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 5,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 6,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 7,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 8,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 10,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
        ]
    });
});

const $formRecette = $('form[name="form_reporting_recette"]');
$formRecette.submit(function (e) {
    e.preventDefault();
    const $data = $(this).serialize();
    const tab = $data.split('&');
    const tab2_deb = tab[0].split('=');
    const tab2_fin = tab[1].split('=');
    $('#table-reporting-recette').DataTable({
        bDestroy: true,
        bAutoWidth: true,
        fixedHeader: true,
        dom: '<"row"<"col-sm-12 col-md-4"B><"col-sm-12 col-md-8"f>><"row"<"col-sm-12"t>><"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        fnFooterCallback: function (row, data, start, end, display) {
            end = data.length;
            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '') * 1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            function formatMillier(nombre) {
                return new Intl.NumberFormat('fr-FR', {
                    style: 'decimal'
                }).format(nombre);
            }

            let $qte_super = 0;
            let $amount_super = 0;
            let $qte_gasoil = 0;
            let $amount_gasoil = 0;
            let $qte_carburant = 0;
            let $ca_carburant = 0;
            let $ca_lub = 0;
            let $ca_gaz = 0;
            let $ca_service = 0;
            let $total_ca = 0;
            let $tpe = 0;
            let $om = 0;
            let $visa = 0;
            let $bv = 0;
            let $depenses = 0;
            let $banque = 0;
            let $total_sortie = 0;
            let $gap = 0;

            for (let i = 0; i < end; i++) {
                $qte_super += intVal(data[display[i]]['qte_super']);
                $amount_super += intVal(data[display[i]]['amount_super']);
                $qte_gasoil += intVal(data[display[i]]['qte_gasoil']);
                $amount_gasoil += intVal(data[display[i]]['amount_gasoil']);
                $qte_carburant += intVal(data[display[i]]['qte_carburant']);
                $ca_carburant += intVal(data[display[i]]['ca_carburant']);
                $ca_lub += intVal(data[display[i]]['ca_lub']);
                $ca_gaz += intVal(data[display[i]]['ca_gaz']);
                $ca_service += intVal(data[display[i]]['ca_service']);
                $total_ca += intVal(data[display[i]]['total_ca']);
                $tpe += intVal(data[display[i]]['tpe']);
                $om += intVal(data[display[i]]['om']);
                $visa += intVal(data[display[i]]['visa']);
                $bv += intVal(data[display[i]]['bv']);
                $depenses += intVal(data[display[i]]['depenses']);
                $banque += intVal(data[display[i]]['banque']);
                $total_sortie += intVal(data[display[i]]['total_sortie']);
                $gap += intVal(data[display[i]]['gap']);
            }
            // Modifying the footer row
            let nCells = row.getElementsByTagName('th');
            nCells[1].innerHTML = formatMillier(parseInt($qte_super));
            nCells[2].innerHTML = formatMillier(parseInt($amount_super));
            nCells[3].innerHTML = formatMillier(parseInt($qte_gasoil));
            nCells[4].innerHTML = formatMillier(parseInt($amount_gasoil));
            nCells[5].innerHTML = formatMillier(parseInt($qte_carburant));
            nCells[6].innerHTML = formatMillier(parseInt($ca_carburant));
            nCells[7].innerHTML = formatMillier(parseInt($ca_lub));
            nCells[8].innerHTML = formatMillier(parseInt($ca_gaz));
            nCells[9].innerHTML = formatMillier(parseInt($ca_service));
            nCells[10].innerHTML = formatMillier(parseInt($total_ca));
            nCells[11].innerHTML = formatMillier(parseInt($tpe));
            nCells[12].innerHTML = formatMillier(parseInt($om));
            nCells[13].innerHTML = formatMillier(parseInt($visa));
            nCells[14].innerHTML = formatMillier(parseInt($bv));
            nCells[15].innerHTML = formatMillier(parseInt($depenses));
            nCells[16].innerHTML = formatMillier(parseInt($banque));
            nCells[17].innerHTML = formatMillier(parseInt($total_sortie));
            nCells[18].innerHTML = formatMillier(parseInt($gap));
        },
        ajax: {
            url: `/api/reporting/journee_recette?${$data}`,
            dataSrc: ''
        },
        language: {
            paginate: {
                previous: '<i class="fa fa-lg fa-angle-left"></i>',
                next: '<i class="fa fa-lg fa-angle-right"></i>'
            }
        },
        columns: [
            { data: 'date', sClass: 'text-center' },
            { data: 'qte_super', sClass: 'text-right' },
            { data: 'amount_super', sClass: 'text-right' },
            { data: 'qte_gasoil', sClass: 'text-right' },
            { data: 'amount_gasoil', sClass: 'text-right' },
            { data: 'qte_carburant', sClass: 'text-right' },
            { data: 'ca_carburant', sClass: 'text-right' },
            { data: 'ca_lub', sClass: 'text-right' },
            { data: 'ca_gaz', sClass: 'text-right' },
            { data: 'ca_service', sClass: 'text-right' },
            { data: 'total_ca', sClass: 'text-right' },
            { data: 'tpe', sClass: 'text-right' },
            { data: 'om', sClass: 'text-right' },
            { data: 'visa', sClass: 'text-right' },
            { data: 'bv', sClass: 'text-right' },
            { data: 'depenses', sClass: 'text-right' },
            { data: 'banque', sClass: 'text-right' },
            { data: 'total_sortie', sClass: 'text-right' },
            { data: 'gap', sClass: 'text-right' },
        ],
        columnDefs: [
            {
                targets: 1,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 2,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 3,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 4,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 5,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 6,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 7,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 8,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 9,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 10,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 11,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 12,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 13,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 14,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 15,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 16,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 17,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 18,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            }
        ],
        buttons: [
            'copy',
        ]
    });
});

const $formInventaire = $('form[name="form_reporting_inventaire_gaz"]');
$formInventaire.submit(function (e) {
    console.log(e);
    e.preventDefault();
    const $data = $(this).serialize();
    const tab = $data.split('&');
    const tab2_deb = tab[0].split('=');
    const tab2_fin = tab[1].split('=');
    const debut = tab2_deb[1];
    const fin = tab2_fin[1];
    $('#table-inventaire-gaz').dataTable({
        bDestroy: true,
        bAutoWidth: true,
        fnFooterCallback: function (row, data, start, end, display) {
            end = data.length;
            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '') * 1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            function formatMillier(nombre) {
                return new Intl.NumberFormat('fr-FR', {
                    style: 'decimal'
                }).format(nombre);
            }
        },
        ajax: {
            url: `/api/reporting/fiche_inventaire?${$data}`,
            dataSrc: ''
        },
        dom: '<"row"<"col-sm-12 col-md-4"B><"col-sm-12 col-md-8"f>><"row"<"col-sm-12"t>><"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        columns: [
            { data: 'date', sClass: 'text-center' },
            { data: 'group_product', sClass: 'text-center' },
            { data: 'stock_initial', sClass: 'text-right' },
            { data: 'reception', sClass: 'text-right' },
            { data: 'reception_consigne', sClass: 'text-right' },
            { data: 'stock_total', sClass: 'text-right' },
            { data: 'recharge.quantity', sClass: 'text-right' },
            { data: 'recharge.price', sClass: 'text-right' },
            { data: 'recharge.value', sClass: 'text-right' },
            { data: 'recharge.marge', sClass: 'text-right' },
            { data: 'consigne.quantity', sClass: 'text-right' },
            { data: 'consigne.price', sClass: 'text-right' },
            { data: 'consigne.value', sClass: 'text-right' },
            { data: 'consigne.marge', sClass: 'text-right' },
            { data: 'stock_final', sClass: 'text-right' },
            { data: 'CA', sClass: 'text-right' },
            { data: 'stock_vide', sClass: 'text-right' },
        ],
        columnDefs: [
            { targets: 2, render: $.fn.dataTable.render.number(' ', ',', 0, '') },
            { targets: 3, render: $.fn.dataTable.render.number(' ', ',', 0, '') },
            { targets: 4, render: $.fn.dataTable.render.number(' ', ',', 0, '') },
            { targets: 5, render: $.fn.dataTable.render.number(' ', ',', 0, '') },
            { targets: 6, render: $.fn.dataTable.render.number(' ', ',', 0, '') },
            { targets: 7, render: $.fn.dataTable.render.number(' ', ',', 0, '') },
            { targets: 8, render: $.fn.dataTable.render.number(' ', ',', 0, '') },
            { targets: 9, render: $.fn.dataTable.render.number(' ', ',', 0, '') },
            { targets: 10, render: $.fn.dataTable.render.number(' ', ',', 0, '') },
            { targets: 11, render: $.fn.dataTable.render.number(' ', ',', 0, '') },
            { targets: 12, render: $.fn.dataTable.render.number(' ', ',', 0, '') },
            { targets: 13, render: $.fn.dataTable.render.number(' ', ',', 0, '') },
            { targets: 14, render: $.fn.dataTable.render.number(' ', ',', 0, '') },
            { targets: 15, render: $.fn.dataTable.render.number(' ', ',', 0, '') },
        ],
        buttons: [
            "copy",
            'pdf'
        ],
    });
});

const $formStockLubrifiant = $('form[name="form_stock_lubrifiant"]');
$formStockLubrifiant.submit(function (e) {
    e.preventDefault();
    const $data = $(this).serialize();
    const tab = $data.split('&');
    const tab2_deb = tab[0].split('=');
    const tab2_fin = tab[1].split('=');
    const debut = tab2_deb[1];
    const fin = tab2_fin[1];
    $('#table-reporting-stock_lubrifiant').dataTable({
        bDestroy: true,
        bAutoWidth: true,
        rowGroup: {
            dataSrc: 'date',
            enable: true,
            startRender: null,
            endRender: function (rows, group) {
                const intVal = function (i) {
                    return typeof i === 'string' ?
                        i.replace(/[\$, ' ']/g, '') * 1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                function formatMillier(nombre) {
                    return new Intl.NumberFormat('fr-FR', {
                        style: 'decimal'
                    }).format(nombre);
                }

                const reception = rows
                    .data()
                    .pluck('reception')
                    .reduce((a, b) => intVal(a) + intVal(b), 0);
                const sortie = rows
                    .data()
                    .pluck('vente')
                    .reduce((a, b) => intVal(a) + intVal(b), 0);
                const venteReel = rows
                    .data()
                    .pluck('ca_lub')
                    .reduce((a, b) => intVal(a) + intVal(b), 0);
                const montant = rows
                    .data()
                    .pluck('val_stock')
                    .reduce((a, b) => intVal(a) + intVal(b), 0);

                const collisage = rows
                    .data()
                    .pluck('collisage')
                    .reduce((a, b) => intVal(a) + intVal(b), 0);

                return $('<tr/>')
                    .append(`<th colspan="6">${group}</th>`)
                    .append(`<th class="text-right">${formatMillier(sortie)}</th>`)
                    .append(`<th class="text-right">${formatMillier(collisage)}</th>`)
                    .append(`<th class="text-right"></th>`)
                    .append(`<th class="text-right">${formatMillier(venteReel)}</th>`)
                    .append(`<th class="text-right"></th>`)
                    .append(`<th class="text-right"></th>`)
                    .append(`<th class="text-right">${formatMillier(montant)}</th>`);
            },
        },
        scrollY: 500,
        deferRender: true,
        scroller: true,
        paging: false,
        ajax: {
            url: `/api/reporting/stock_lubrifiant?${$data}`,
            dataSrc: ''
        },
        dom: '<"row"<"col-sm-12 col-md-4"B><"col-sm-12 col-md-8"f>><"row"<"col-sm-12"t>><"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        // language: {
        //     paginate: {
        //         previous: '<i class="fa fa-lg fa-angle-left"></i>',
        //         next: '<i class="fa fa-lg fa-angle-right"></i>'
        //     }
        // },
        columns: [
            { data: 'date', sClass: 'text-center' },
            { data: 'product', },
            { data: 'poids', sClass: 'text-right' },
            { data: 'stock_initial', sClass: 'text-right' },
            { data: 'reception', sClass: 'text-right' },
            { data: 'disponible', sClass: 'text-right' },
            { data: 'vente', sClass: 'text-right' },
            { data: 'collisage', sClass: 'text-right' },
            { data: 'pu', sClass: 'text-right' },
            { data: 'ca_lub', sClass: 'text-right' },
            { data: 'stock_final', sClass: 'text-right' },
            { data: 'pa', sClass: 'text-right' },
            { data: 'val_stock', sClass: 'text-right' },
        ],
        buttons: [
            { extend: 'copy', text: 'Copier'},
            { extend: 'print', text: 'Imprimer'},
        ],
        columnDefs: [
            {
                targets: 1,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 2,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 3,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 4,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 5,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 6,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 7,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            },
            {
                targets: 8,
                render: $.fn.dataTable.render.number(' ', ',', 0, ''),
            }
        ]
    });
});
