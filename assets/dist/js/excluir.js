/**	 * Passa os dados  para o Modal, e atualiza o link para exclusão	 */
$('#delete-modal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('customer');
    var rota = button.data('rota');
    var modal = $(this);
   // modal.find('.modal-title').text('Excluir Cliente #' + id);
    modal.find('#confirm').attr('href', rota + id);
})

$('#desativar-usuario').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('customer');
    var nome = button.data('nome')
    var rota = button.data('rota');
    var modal = $(this);
    modal.find('.modal-title').text('Desativar Usuário: ' + nome);
    modal.find('#confirm').attr('href', rota + id);
})

/**	 * Passa os dados do palete para o Modal, e atualiza o link para exclusão	 
$('#remove-palete').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id_doca = button.data('customer');
    var id_palt = button.data('idpalt');
    var rota = button.data('rota');
    var modal = $(this);
    // 'doca/' . $id_doca . '/removePalete' . '/' . $palete['id']
    //modal.find('.modal-title').text('Excluir Cliente #' + id_doca);
    modal.find('#confirm-remover').attr('href', rota + 'doca/' + id_doca + '/removePalete/' + id_palt);
})*/

$('#despacha-pedidos').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    // var id_doca = button.data('customer');
    // var id_palt = button.data('idped');
    var rota = button.data('rota');
    var modal = $(this);
      
    modal.find('#confirm-remover').attr('href', rota);
})

$('#limpar-palete').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var rta = button.data('rta');
    var id_palt = button.data('idp');
    var rota = button.data('rota');
    var modal = $(this);

    modal.find('#confirm-remover').attr('href', rota + id_palt +'/'+rta);
})

$('#limpar-doca').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var rota = button.data('rota');
    var modal = $(this);

    modal.find('#confirm-remover').attr('href', rota);
})


/*$('#ativar-palete').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var rota = button.data('rota');
    var modal = $(this);

    modal.find('#confirm-ativar').attr('href', rota);
})*/
