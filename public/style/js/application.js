/**
 * Created by mgoldenbaum on 12.09.14.
 */

$(function(){

    /*############################################################
     Controller: REPORT
     ############################################################*/
    jQuery('#generate_reports').click(function(e){
        e.preventDefault();
        jQuery(this).attr('disabled','disabled');
        var ergebnis = jQuery('#ergebnis');
        ergebnis.html('');
        var id = startLoader(jQuery('#loader'));
        jQuery.post('api/api.php?c=report&m=generate', {type : 'normal'}, function(res){
            $("html, body").animate({ scrollTop: $(document).height()-1500 }, "slow");
            ergebnis.html('<div class="text-center"><h3>'+res+' Berichte wurden erstellt!</h3></div>');
            $.notify("Laden der Daten erfolgreich beendet", "success", {position:"right bottom"});
            stopLoader(id);
            ergebnis.show();
            jQuery('#generate_reports').removeAttr('disabled');
        })
    })

    jQuery('.report_stream_file_action').each(function(){
        jQuery(this).click(function(e){
            e.preventDefault();
            var ergebnis = jQuery('#ergebnis_iframe');
            var id = startLoader(jQuery('#loader'));
            ergebnis.show();
            jQuery.post('api/api.php?c=report&m=stream_file', {file : jQuery(this).data('file')}, function(res){
                jQuery("#pdf_viewer").attr("src","data:application/pdf;base64,"+res);

                $("html, body").animate({ scrollTop: $(document).height()-1500 }, "slow");
                $.notify("Laden der Daten erfolgreich beendet", "success", {position:"right bottom"});
                stopLoader(id);
            })
        })
    })

    /*############################################################
     Controller: EXTENSION
     ############################################################*/

    jQuery('#load_extensions').click(function(){
        var ergebnis = jQuery('#ergebnis');
        ergebnis.html ('');
        jQuery(this).attr('disabled','disabled');
        var id = startLoader(jQuery('#loader'));
        jQuery.post('api/api.php?c=extension&m=load_extensions', {type : 'normal'}, function(res){
            ergebnis.html('<div class="col-lg-12">Laden der Daten erfolgreich beendet.<br /> Es wurden '+res+' Einträge erfolgreich hinzugefügt</div>');
            $.notify("Laden der Daten erfolgreich beendet", "success", {position:"right bottom"});
            stopLoader(id);
            jQuery('#load_extensions').removeAttr('disabled');
        })
    })

    jQuery('#edit_extensions').click(function(){
        var ergebnis = jQuery('#ergebnis');
        ergebnis.html('');
        jQuery(this).attr('disabled','disabled');
        var id = startLoader(jQuery('#loader'));
        jQuery.post('api/api.php?c=extension&m=view_extensions', {type : 'normal'}, function(res){
            ergebnis.html(res);
            $.notify("Laden der Daten erfolgreich beendet", "success", {position:"right bottom"});
            stopLoader(id);
            jQuery('#edit_extensions').removeAttr('disabled');
            load_save_extension_click();
            load_delete_extension_click();
        })
    })

    jQuery('#add_extensions').click(function(){
        var ergebnis = jQuery('#ergebnis');
        ergebnis.html('');
        jQuery(this).attr('disabled','disabled');
        var id = startLoader(jQuery('#loader'));
        jQuery.post('api/api.php?c=extension&m=add_extension', {type : 'normal'}, function(res){
            ergebnis.html(res);
            $.notify("Laden der Daten erfolgreich beendet", "success", {position:"right bottom"});
            stopLoader(id);
            jQuery('#add_extensions').removeAttr('disabled');
            load_save_extension_click();
        })
    })

    /*############################################################
    Controller: SET
     ############################################################*/
    jQuery('#btn_normal_build').click(function(){
        var id = startLoader(jQuery('#loader'));
        jQuery(this).attr('disabled','disabled');
        jQuery.post('api/api.php?c=set&m=bundle', {type : 'normal'}, function(res){
            var data = jQuery.parseJSON(res);
            jQuery('#ergebnis_count').html(data.count);
            jQuery('#ergebnis_time').html(data.time+' sec');
            jQuery('#btn_normal_build').removeAttr('disabled');

            jQuery('#ergebnis').show();
            stopLoader(id);
        })
    })

    jQuery('#btn_advanced_build').click(function(){
        var id = startLoader(jQuery('#loader'));
        jQuery(this).attr('disabled','disabled');
        jQuery.post('api/api.php?c=set&m=bundle', {type : 'advanced'}, function(res){
            //console.log(res);
            var data = jQuery.parseJSON(res);
            jQuery('#ergebnis_count').html(data.count);
            jQuery('#ergebnis_time').html(data.time+' sec');
            jQuery('#btn_advanced_build').removeAttr('disabled');

            jQuery('#ergebnis').show();
            stopLoader(id);
        })
    })

    /*############################################################
     Controller: USER
     ############################################################*/

    jQuery('#user_load_times').click(function(e){
        e.preventDefault();
        jQuery(this).attr('disabled','disabled');
        var ergebnis = jQuery('#ergebnis');
        ergebnis.html('');
        var id = startLoader(jQuery('#loader'));
        jQuery.post('api/api.php?c=user&m=load_times', {type : 'normal'}, function(res){
            //$("html, body").animate({ scrollTop: $(document).height()-1500 }, "slow");
            ergebnis.html('<div class="text-center">'+res+'</div>');
            $.notify("Laden der Daten erfolgreich beendet", "success", {position:"right bottom"});
            stopLoader(id);
            ergebnis.show();
            jQuery('#user_load_times').removeAttr('disabled');
        })
    })

    jQuery('[data-function=addTime]').each(function(){
        jQuery(this).on('click', function(e){
            e.preventDefault();

            var time = jQuery(this).data('time').toString();
            var date = time.substr(0,2)+'.'+time.substr(2,2)+'.'+time.substr(-4);

            jQuery.post('api/api.php?c=time&m=add', {date : date}, function(id){

                if(jQuery.isNumeric(id)){
                    $.notify("Eintrag erfolgreich hinzugefügt", "success", {position:"right bottom"});

                    var html = '<form role="form" method="POST" target="_self" id="timeEntry_'+id+'">'+
                                    '<div class="form-group">'+
                                        '<b>Angegebene Tätigkeit</b>'+
                                        '<div style="display: inline-block; float: right; padding: 5px;">'+
                                            '<button class="btn btn-danger btn-circle btn-xs" style="display: inline-block" data-function="deleteTime" data-id="'+id+'">x</button>'+
                                        '</div>'+
                                        '<input class="form-control" style="margin-bottom: 10px;" name="project_name" value="Projektbezeichnung" placeholder="Projekt"/>'+
                                        '<input class="form-control" name="service_name" value="Geleisteter Service" placeholder="Service"/>'+
                                        '<input class="form-control" style="width: 100px;margin-top: 10px;display: inline-block" name="minutes" value="0" placeholder="Minutes"/>'+

                                        '&nbsp;<input type="hidden" name="id" value="'+id+'" />'+

                                        '<button class="btn btn-default" style="display: inline-block" data-function="editTime" data-id="'+id+'">Speichern</button>'+
                                    '</div>'+
                                '</form>';

                    jQuery('#day_box_'+time).prepend(html);
                    deleteTimeEntry(jQuery('[data-function=deleteTime][data-id='+id+']'));
                    editTimeEntry(jQuery('[data-function=editTime][data-id='+id+']'));
                }else{
                    $.notify("Eintrag konnte nicht hinzugefügt werden", "error");
                }
            });
        })
    })

    jQuery('[data-function=editTime]').each(function(){
        editTimeEntry(jQuery(this));
    })


    jQuery('[data-function=deleteTime]').each(function(){
        deleteTimeEntry(jQuery(this));
    })


    /*############################################################
     Controller: FUNCTION LIB
     ############################################################*/
    function load_save_extension_click(){
        jQuery('.save_extension').each(function(){

            jQuery(this).on('click', function(e){
                e.preventDefault();

                jQuery.post('api/api.php?c=extension&m=save', jQuery('form[data-id='+jQuery(this).data('id')+']').serialize(), function(res){
                    if(res == 'true' || res == 1){
                        $.notify("Eintrag erfolgreich gespeichert", "success", {position:"right bottom"});
                    }else{
                        $.notify("Eintrag konnte nicht gespeichert werden", "error");
                    }
                });
            });
        })
    }

    function load_delete_extension_click(){
        jQuery('.delete_extension').each(function(){

            jQuery(this).on('click', function(e){
                e.preventDefault();

                var id = jQuery(this).data('id');

                jQuery.post('api/api.php?c=extension&m=delete', {id : id}, function(res){
                    if(res == 'true' || res == 1){
                        $.notify("Eintrag erfolgreich gelöscht", "success", {position:"right bottom"});
                        jQuery('[data-wrapper=extension_body_'+id+']').remove();
                    }else{
                        $.notify("Eintrag konnte nicht gelöscht werden", "error");
                    }
                });
            });
        })
    }

    function editTimeEntry(dom){
        dom.on('click', function(e){
            e.preventDefault();

            jQuery.post('api/api.php?c=time&m=edit', jQuery('#timeEntry_'+jQuery(this).data('id')).serialize(), function(res){
                if(res == 'true'){
                    $.notify("Eintrag erfolgreich gespeichert", "success", {position:"right bottom"});
                }else{
                    $.notify("Eintrag konnte nicht gespeichert werden", "error");
                }
            });
        })
    }

    function deleteTimeEntry(dom){
        dom.on('click', function(e){
            e.preventDefault();
            var form = jQuery('#timeEntry_'+jQuery(this).data('id'));

            jQuery.post('api/api.php?c=time&m=delete', form.serialize(), function(res){
                if(res == 'true'){
                    $.notify("Eintrag erfolgreich gelöscht", "success", {position:"right bottom"});
                    form.remove();
                }else{
                    $.notify("Eintrag konnte nicht gelöscht werden", "error");
                }
            });
        })
    }

    function startLoader(dom){
        var id = 'loader_'+Math.floor((Math.random() * 100) + 1);
        dom.prepend('<img src="style/img/ajax-loader.gif" id="'+id+'" />');

        return id;
    }

    function stopLoader(id){
        jQuery('#'+id).remove();
    }
});