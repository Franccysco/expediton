
$(document).ready(function () {
    setInterval("paletesRelacionados()", 10000);
});

function getPalete() {
    
    var $modal = $('#modal-ped-palet');
     $modal.modal("show");

     var deferred = $.Deferred();
     // registra o deferimento no modal para receber o valor produzido
     $modal.deferred = deferred;
     // por fim, registra os valores nos inputs quando o modal devolver o produto
     deferred.done(function (palete) {
         $('#palete').val(palete.cod);
         $('#palete_id').val(palete.id);
     });


     // para todo e qualquer elemento que quando clicado irá retornar (produzir) um palete.     
     $modal.find('[data-produce]').click(function (e) {
         // caso exista um deferimento previamente registrado, o resolve com o palete clicado
         // o deferimento é uma forma de vinculo entre o modal e o input que solicitou o palete.
         if ($modal.deferred) {
             $modal.deferred.resolve({
                 id: $(this).data('paleteId'),
                 cod: $(this).data('paleteCod')
             });
         }

         $modal.modal("hide");
     });

     $modal.on('hidden.bs.modal', function (e) {
         // cancela o deferimento atual pois o modal foi fechado
         delete $modal.deferred;
     });

}

function getRota() {

    var $modal = $('#modal-ped-rotas');
    $modal.modal("show");

    var deferred = $.Deferred();
    // registra o deferimento no modal para receber o valor produzido
    $modal.deferred = deferred;
    // por fim, registra os valores nos inputs quando o modal devolver o produto
    deferred.done(function (rota) {
        $('#rota_input').val(rota.rota);
        $('#rota_id').val(rota.rota);
    });



    // para todo e qualquer elemento que quando clicado irá retornar (produzir) um rota.     
    $modal.find('[data-produce]').click(function (e) {
        // caso exista um deferimento previamente registrado, o resolve com o rota clicado
        // o deferimento é uma forma de vinculo entre o modal e o input que solicitou o rota.
        if ($modal.deferred) {
            $modal.deferred.resolve({
                rota: $(this).data('rta'),
                //id: $(this).data('rotaId')
            });
        }

        $modal.modal("hide");
    });

    $modal.on('hidden.bs.modal', function (e) {
        // cancela o deferimento atual pois o modal foi fechado
        delete $modal.deferred;
    });

}


function hidePaletesAdd() {
    document.getElementById("paletesAddDoca").style.display = "none";
}


function showPaletesAdd(idDoca) {
    $("#paletesAddDoca").toggle();
    
    paletesNaoRelacionados(idDoca);
   
}


function paletesRelacionados(idDoca) {
   var idDocaAtual =  (idDoca != undefined) ? idDoca : document.getElementById("idDoca").value;
   var base_url =  document.getElementById("base_url").value;
   var isAdmin = document.getElementById("admin").value;



    $.ajax({
        url: base_url+"home/paletesRelacionados",
        type:"POST",
        data:{
            idDoca:idDocaAtual
        }, 
        success: function (result) {
            
            let paletes_doca = JSON.parse(result);
            
            if (paletes_doca.length > 0) {
                document.getElementById("paleteDocaSelecionada").innerHTML = createHtmlPaleteRealacionados(paletes_doca, idDocaAtual, isAdmin);
            } else {
                document.getElementById("paleteDocaSelecionada").innerHTML = `
                    <section class="content">
                        <div class="callout callout-warning">
                            <h4><i class="icon fa fa-exclamation-circle"></i> Insira um palete na doca selecionada!
                            </h4>
                        </div>
                    </section>                
                `;
            }
            
        }
    });

}


function paletesNaoRelacionados(idDoca) {
    var base_url =  document.getElementById("base_url").value;
 
    $.ajax({
        url: base_url+"palete/paletesNaoRelacionados",

        success: function (result) {
            let paletes = JSON.parse(result);
            if (paletes.length > 0) {
                document.getElementById("paletesDisponivieis").innerHTML = createHtmlPaleteNaoRealacionados(paletes, idDoca);                
            } else{
                document.getElementById("paletesDisponivieis").innerHTML = `
                    <section class="content">
                        <div class="callout callout-warning">
                            <a style="float:right;" href="${base_url+"paletes/cadastro"}" class="btn btn-success">
                                <i class="fa fa-plus-circle"></i> Cadastrar palete
                            </a>
                            <h4><i class="icon fa fa-exclamation-circle"></i> Cadastre mais um palete no
                                sistema!</h4>
                            Nenhum Palete cadastrado ainda!
                        </div>
                    </section>
                `;
            }
        }
    });

 
 }

 function adicionarPaleteDoca(idDoca,idPalete) {
    var base_url =  document.getElementById("base_url").value;

    $.ajax({
        url:base_url+"doca/addPaleteDoca",
        type:"POST",
        data:{
            idDoca:idDoca,
            idPalete:idPalete
        },
        success: function (response) {
            let resp = JSON.parse(response);
            if (resp.status == "success") {
                document.getElementById("msg").innerHTML = createHtmlMsg(resp.status, resp.msg);
                paletesNaoRelacionados(idDoca);
                paletesRelacionados(idDoca);
            }else{
                document.getElementById("msg").innerHTML = createHtmlMsg(resp.status, resp.msg);
            }
        }

    });
}


function removerPaleteDocaOcupado(idDoca, idPalete) {
    var $modal = $('#remove-palete');
    $modal.modal("show");

    document.getElementById("confirm-remover").addEventListener("click", function () {
        removerPaleteDoca(idDoca, idPalete);
        $modal.modal("hide");
    });
}

function showModalAtivarPalete(idPalete) {
    var $modal = $('#ativar-palete');
    $modal.modal("show");

    document.getElementById("confirm-ativar").addEventListener("click", function () {
        ativarPalete(idPalete);
        paletesRelacionados();
        $modal.modal("hide");
    });
}

function ativarPalete(idPalete) {
    
    var base_url =  document.getElementById("base_url").value;

    $.ajax({
        url:base_url+"palete/mudaStatus",
        type:"POST",
        data:{
            idPalete:idPalete
        },
        success: function (response) {
            let resp = JSON.parse(response);
            if (resp.status == "success") {
                document.getElementById("msg").innerHTML = createHtmlMsg(resp.status, resp.msg);
            }else{
                document.getElementById("msg").innerHTML = createHtmlMsg(resp.status, resp.msg);
            }
        }

    });
}




function removerPaleteDoca(idDoca, idPalete) {
    
    var base_url =  document.getElementById("base_url").value;

    $.ajax({
        url:base_url+"doca/removePaleteDoca",
        type:"POST",
        data:{
            idDoca:idDoca,
            idPalete:idPalete
        },
        success: function (response) {
            let resp = JSON.parse(response);
            if (resp.status == "success") {
                document.getElementById("msg").innerHTML = createHtmlMsg(resp.status, resp.msg);
                if($("#paletesAddDoca").is(':visible')){
                    paletesNaoRelacionados(idDoca);
                }
                paletesRelacionados(idDoca);
            }else{
                document.getElementById("msg").innerHTML = createHtmlMsg(resp.status, resp.msg);
            }
        }

    });
}


function createHtmlPaleteNaoRealacionados(dados, idDoca) {
    let html =``;
    
    dados.forEach(palete => {
        
    
       html+=`
            <div style="top: -12px;" class="col-md-3 col-sm-6 col-xs-6">

                <div class="info-box bg-green">
                    <span class="info-box-icon-ped2"><i class="fa fa-pallet"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"> ${palete.cod_palete}</span>
                        <p>
                            <span class=" badge bg-default">Ped: 0</span>
                            <span class=" badge bg-default"data-toggle="tooltip" title="Rota do palete"> ${palete.rota}</span>
                        </p>
                    </div>
                    
                </div>
                
                <a onclick="adicionarPaleteDoca(${idDoca}, ${palete.id});"
                    style="margin-top: -11px; margin-bottom: 20px;" href="#" class="btn btn-primary btn-xs pull-right">
                    <i class="fa fa-arrow-right"></i> Adicionar
                </a>

            </div>
        `;

    });

    return html;
}

function createHtmlPaleteRealacionados(dados, idDoca, isAdmin) {
    var base_url =  document.getElementById("base_url").value;
    let html = ``;
    let htmlPaleteAcoesAdmin = ``;
    // let htmlPaleteAcoesAdminStatus2 = ``;
    let status_palete = "";
    let admin = (isAdmin == 1) ? true : false;

    let htmlfooterPalete = ``;
    
    dados.forEach(paletes_doca =>{

        if(paletes_doca.status == 1){
            status_palete = "bg-green";
            htmlfooterPalete = `
                <a href="${base_url+"doca/"+idDoca+"/palete/"+paletes_doca.id+"/1"}" class="small-box-footer">
                    Adicionar Pedidos <i class="fa fa-plus-circle"></i> 
                </a>
            `;
        }else if(paletes_doca.status == 0){
            status_palete = "bg-red";
            htmlfooterPalete = `
                <a href="${base_url+"doca/"+idDoca+"/palete/"+paletes_doca.id+"/1"}" class="small-box-footer">
                    Visualizar Pedidos <i class="fa fa-eye"></i> 
                </a>
            `;
        }else{
            status_palete = "bg-yellow";
            htmlfooterPalete = `
                <a data-toggle="tooltip" title="Palete em uso, usar o próximo disponível" class="small-box-footer">
                    Está em uso <i class="fa fa-lock"></i>
                </a>
            `;
        }

        //Acoes admin
        if(admin){
            // console.log(createHtmlAcoesPaleteAdmin(idDoca, paletes_doca.id, paletes_doca.qtdPedidos_atual, paletes_doca.status));
            htmlPaleteAcoesAdmin = createHtmlAcoesPaleteAdmin(idDoca, paletes_doca.id, paletes_doca.qtdPedidos_atual, paletes_doca.status);
            if (paletes_doca.status == 2) {
                htmlPaleteAcoesAdmin += `
                    <a href="#" onclick="showModalAtivarPalete(${paletes_doca.id})" data-toggle="tooltip"
                        title="Ativar palete, para uso" 
                        style="position: absolute;top: -3px;right: 70px;font-size: 10px;font-weight: 400;">
                        <span class="badge bg-green" style="border:solid 2px; border-color:#727272">ativar</span>
                    </a>
                `;
            }
        }


        html += `
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="info-box  ${status_palete}">
                
                `+htmlPaleteAcoesAdmin+`                                
            
                <span class="info-box-icon"><i class="fa fa-pallet"></i></span>

                <div class="info-box-content">
                    <span style="margin-top: 9px;" class="info-box-text">${paletes_doca.cod_palete}</span>
                    <p>
                        <span class=" badge bg-default" data-toggle="tooltip" title="Nº de pedidos no palete"> Ped: ${paletes_doca.qtdPedidos_atual} </span> 
                        <span class=" badge bg-default" data-toggle="tooltip" title="Rota do palete"> ${paletes_doca.rota} </span>
                    </p>

                </div>

                <!-- /.info-box-content -->
                </div>
                <div class="small-box-pedidos">
                    `+htmlfooterPalete+`                                       
                </div>
            </div>
        `;
    });

    
    return html;
                                        
}


function createHtmlAcoesPaleteAdmin(idDoca, idPalete, qtdPedidos, statusPalete) {
    var base_url =  document.getElementById("base_url").value;
    let html = ``;

    let htmlLimparPalete0 = `
        <a href="#" data-toggle="modal" data-target="#limpar-palete" data-toggle="tooltip"
            title="Limpar todos os pedidos do palete" data-rota="${base_url+"limpa-pedidos/"}"
            data-idp="${idPalete}" data-rta="${idDoca}" style="position: absolute;top: -3px;right: 70px;font-size: 10px;font-weight: 400;">
            <span class="badge bg-yellow" style="border:solid 2px; border-color:#727272">limpar</span>
        </a>
    `;
    

    let htmlRemoverPaleteComPedido = `
        <a href="#" onclick="removerPaleteDocaOcupado('${idDoca}', '${idPalete}')" data-toggle="modal" d
            data-toggle="tooltip" title="Retirar palete da doca atual" style="position: absolute;top: -3px;right: 6px;font-size: 10px;font-weight: 400;">
            <span class="badge" style="background-color:#b23b2c; border:solid 2px; border-color:#727272">remover</span>
        </a>
    `;

    let htmlRemovPaleteVazio = `
        <a href="#" onclick="removerPaleteDoca('${idDoca}', '${idPalete}')"
            data-toggle="tooltip" title="Retirar palete da doca atual" style="position: absolute;top: -3px;right: 6px;font-size: 10px;font-weight: 400; ">
            <span class="badge" style="background-color:#b23b2c; border:solid 2px; border-color:#727272">remover</span>
        </a>
    `;

    if(qtdPedidos > 0){
        html+= htmlRemoverPaleteComPedido;
        if(statusPalete == 0){
            html+= htmlLimparPalete0;
        }
    }else{
        html+= htmlRemovPaleteVazio;
    }

    return html;
}


function createHtmlMsg(tipo, msg) {

    let html = ``;

    if(tipo == "error"){
        html +=`
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-times-circle"></i> Erros</h4>
            <p>${msg}</p>
        </div>
        `;
    }else{
        html +=`
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check-circle"></i> Sucesso</h4>
            <p>${msg}</p>
        </div>
        `;
    }
    
    return html;
}




