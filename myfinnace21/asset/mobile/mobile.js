$(document).bind("mobileinit", function(){
    $.mobile.loadingMessage = "Mohon tunggu...";
});
$(function(){
    $('#accordion_data_transaksi').click(function(){
        if($(this).hasClass('ui-collapsible-heading-collapsed'))
        {
            load('mobile/get_transaksi_terakhir','#data_transaksi');
        }
    });
    $('#accordion_bukubesar').click(function(){
        if($(this).hasClass('ui-collapsible-heading-collapsed'))
        {
            load('mobile/get_buku_besar','#bukubesar');
        }
    });
    $('#accordion_surdef').click(function(){
        if($(this).hasClass('ui-collapsible-heading-collapsed'))
        {
            load('mobile/get_surplus_defisit','#surplusdefisit');
        }
    });
    $('.fnominal')
    .keypress(function(){
        format_number(this); 
    })
    .keyup(function(){
        format_number(this); 
    });
});


function load(page,div){
    $.ajax({
        url: site+"/"+page,
        beforeSend:function(){
            $.mobile.showPageLoadingMsg();
        },
        success:function(response){
            $.mobile.hidePageLoadingMsg();
            $(div).html(response).trigger('create');
        },
        dataType:"html"  		
    });
    return false;
}
function send_form(formObj,action)
{
    $.ajax({
        url: site+"/"+action,  
        data: $(formObj.elements).serialize(),
        beforeSend:function(){
            $.mobile.showPageLoadingMsg();
        },
        success:function(){
            $.mobile.hidePageLoadingMsg();
            empty_forms();
        },
        type: "post", 
        dataType: "html"
    });
    return false;
}
function empty_forms()
{
    $('input').val('');
    $('textarea').val('');
    $('select[name=id_piutang]').val("").selectmenu('refresh');
    $('#li_piutang').hide();
}
function simpan_transaksi()
{
    $('#info-content').text('Loading...');
    var keterangan = $('#keterangan').val();
    $('label[for=keterangan]').removeClass('error');
    if(keterangan == '')
    {
        $('label[for=keterangan]').addClass('error');
    }
    else
    {
        send_form(document.f_transaksi,'mobile/save_transaksi');
    }
}
function login()
{
    var formObj = document.f_login;
    $.ajax({
        url: site+"/mobile/do_login",  
        data: $(formObj.elements).serialize(),
        beforeSend:function(){
            $.mobile.showPageLoadingMsg();
        },
        success:function(response){
            $.mobile.hidePageLoadingMsg();
            $('#login_error').html(response);
            if(response == '')
            {
                location = site+"/mobile";
            }
        },
        type: "post", 
        dataType: "html"
    });
    return false;
}
function cek_piutang()
{
    var tr = $('#transaksi').val();
    if(tr == 9 || tr == 16)
    {
        $('#li_piutang').show();
    }
    else
    {
        $('select[name=id_piutang]').val("").selectmenu('refresh');
        $('#li_piutang').hide();
    }
}
function edit(id)
{
    $('select[name=transaksi]').val($('.transaksi_'+id).val()).selectmenu('refresh');
    $('textarea[name=keterangan]').val($('.keterangan_'+id).val());
    $('input[name=nominal]').val($('.nominal_'+id).val());
    $('input[name=nomor]').val($('.nomor_'+id).val());
    if(typeof($('select[name=id_piutang]').val()) != 'undefined')
    {
        $('select[name=id_piutang]').val($('.id_piutang_'+id).val()).selectmenu('refresh');
    }
    $('#form_input').trigger('click');
    cek_piutang();
}
function format_number(input)
{
    var num = input.value.replace(/\,/g,'');
    if(!isNaN(num)){
    if(num.indexOf('.') > -1){
        num = num.split('.');
        num[0] = num[0].toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1,').split('').reverse().join('').replace(/^[\,]/,'');
        if(num[1].length > 2){
            num[1] = num[1].substring(0,num[1].length-1);
        }
        input.value = num[0]+'.'+num[1];
    }
    else
    {
        input.value = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1,').split('').reverse().join('').replace(/^[\,]/,'') };
    }
    else
    { 
        input.value = input.value.substring(0,input.value.length-1);
    }
}