/**
 * Created by irapcover on 07/07/2017.
 */
//
String.prototype.format = function() {
    var formatted = this;
    for (var i = 0; i < arguments.length; i++) {
        var regexp = new RegExp('\\{'+i+'\\}', 'gi');
        formatted = formatted.replace(regexp, arguments[i]);
    }
    return formatted;
};

String.prototype.replaceAllandJoin = function(search, replacement) {
    var target = this;
    return target.split(search).join(replacement);
};

if (!String.prototype.trim) {
    String.prototype.trim = function () {
        return this.replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, '');
    };
}

function dd(text) {
    console.log(text);
}

function AjaxFunction(url, method, data, index_more){
    var content = {
        url: url,
        type: method
    };
    if(data && typeof data == 'object')
        content.data = data;

    if(index_more && typeof index_more == 'object')
        for(var index in index_more){
            if(!content.hasOwnProperty(index)){
                content[index] = index_more[index];
            }
        }
    return $.ajax(content);
}

function replaceMQ(text){
    str = text.toLowerCase();
    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a");
    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e");
    str = str.replace(/ì|í|ị|ỉ|ĩ/g,"i");
    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o");
    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");
    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y");
    str = str.replace(/đ/g,"d");
    str = str.replace(/!|@|\$|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\'|\;| |\"|\&|\#|\[|\]|~/g,"-");
    str = str.replace(/-+-/g,"-"); //thay thế 2- thành 1-
    str = str.replace(/^\-+|\-+$/g,"");//cắt bỏ ký tự - ở đầu và cuối chuỗi
    return str;
}

function b64DecodeUnicode(str) {
    // Going backwards: from bytestream, to percent-encoding, to original string.
    return decodeURIComponent(atob(str).split('').map(function(c) {
        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
    }).join(''));
}

function b64EncodeUnicode(str) {
    // first we use encodeURIComponent to get percent-encoded UTF-8,
    // then we convert the percent encodings into raw bytes which
    // can be fed into btoa.
    return btoa(encodeURIComponent(str).replace(/%([0-9A-F]{2})/g,
        function toSolidBytes(match, p1) {
            return String.fromCharCode('0x' + p1);
        }));
}

// get style of element
function _css(a) {
    var sheets = document.styleSheets, o = {};
    for (var i in sheets) {
        var rules = sheets[i].rules || sheets[i].cssRules;
        for (var r in rules) {
            if (a.is(rules[r].selectorText)) {
                o = $.extend(o, css2json(rules[r].style), css2json(a.attr('style')));
            }
        }
    }
    return o;
}

function css2json(css) {
    var s = {};
    if (!css) return s;
    if (css instanceof CSSStyleDeclaration) {
        for (var i in css) {
            if ((css[i]).toLowerCase) {
                s[(css[i]).toLowerCase()] = (css[css[i]]);
            }
        }
    } else if (typeof css == "string") {
        css = css.split("; ");
        for (var i in css) {
            var l = css[i].split(": ");
            s[l[0].toLowerCase()] = (l[1]);
        }
    }
    return s;
}

(function($) {
    var configElement = {
        tabFile: 'span.tab_file',
        tabNewFile: 'span.tab_new_file',
        boxContainTab: 'i.box_contain_tab',
        liFileName: 'li.file_name',
        eTab: '<span class="tab_file _tab selected __tab_item__{1}" data-file_name="{0}" data-file_slug="{1}">{0} <b class="fa fa-times-circle" aria-hidden="true"></b></span>',
        eEditor: '<div class="contain_editor _{0}"><div id="editor_{0}" class="box_main form-control"></div></div>',
        boxContainEditor: 'contain_editor',
        colEditor: 'col_editor',
        editorDefault: 'div#editor',
        endFile: {
            css: 'css',
            js: 'javascript'
        },
        btnClosePopupCreateFile: 'span.close_box',
        boxPopup: 'div.box_popup',
        btnCreateNewFile: 'span.create_new_file',
        inputName: 'input[name="{0}"]',
        selectName: 'select[name="{0}"]',
        ulListFile: 'ul.list_file',
        clsLiFileName: '<li class="file_name item__{1}" data-file_name="{0}" data-file_slug="{1}" data-widget_id="{2}">- {0}</li>',
        btnUpdate: 'span#update',
        useCommonCss: 'uc_css',
        useCommonJs: 'uc_js',
        tabItem : '__tab_item__{0}',
        liFileCommon: '<li><input type="checkbox" name="file_global_js[]" id="file_{0}" value="{0}" checked="checked"> <label for="file_{0}">{1}</label></li>',
        spanBoxFileCommon: 'span.uc_{0}',
    };

    // editor
    function renderCodeInEditor(_data,_element,_language,_theme) {
        let eEditorHTML = _element, editor = ace.edit(eEditorHTML);
        editor.setTheme("ace/theme/"+_theme);
        editor.getSession().setMode("ace/mode/"+_language);
        editor.setValue(b64DecodeUnicode(_data));
        return editor;
    }

    // right click - click delete
    function deleteFile(wgid, fid){
        var result = JSON.parse(AjaxFunction(
            '/admin2018/modules/widget/ajax_delete_file.php', 'POST',
            {
                wgid: wgid,
                file_id: fid
            }, {dataType: 'json',async: false}
        ).responseText);
        $(configElement.tabFile+'.'+configElement.tabItem.format(fid)+' b').click();
        $(configElement.liFileName+'.item__'+fid).remove();
    }
    // right click - click global File
    function globalFile(wgid, fid) {
        var result = JSON.parse(AjaxFunction(
            '/admin2018/modules/widget/ajax_normal_to_global_file.php', 'POST',
            {
                wgid: wgid,
                file_id: fid
            }, {dataType: 'json',async: false}
        ).responseText);
        if(result['code'] == 200){
            // remove file in menu file of widget
            $(configElement.tabFile+'.'+configElement.tabItem.format(fid)+' b').click();
            $(configElement.liFileName+'.item__'+fid).remove();
            // add option vao phan file dung chung tuong ung
            var _span = $(configElement.spanBoxFileCommon.format(result['extension']));
            var ulBoxFileCommon = _span.siblings('div').find('ul');
            ulBoxFileCommon.append(configElement.liFileCommon.format(result['lag_id'], result['file_name']));
        }
    }
    // right click - click  File undo
    function undoFile(wgid, fid){

    }
    // function right click menu list file
    function rightClickMenuListFile() {
        // right click menu list file
        $(document).find(configElement.liFileName).each(function () {
            var file_id = $(this).data('file_slug');
            $.contextMenu({
                selector: '.item__{0}'.format(file_id),
                // define the elements of the menu
                callback: function(key, options) {
                    var $this = $(options.selector),
                        $widget_id = $this.data('widget_id'),
                        $file_id = $this.data('file_slug'),
                        $action = {
                            // 'globalFile': globalFile,
                            'deleteFile': deleteFile,
                            'undoFile': undoFile
                        };
                    $action[key]($widget_id, $file_id);
                },
                items: {
                    // "globalFile": {name: "Global File", icon: "fa-cloud-upload"},
                    // "undoFile": {name: "Undo", icon: "fa-undo"},
                    // "sep1": "---------",
                    "deleteFile": {name: "Delete", icon: "delete"}
                }
            });
        });
    }

    rightClickMenuListFile();


    var arrayEditor = {};
    arrayEditor['_0'] = renderCodeInEditor(valueHTML,"editor", "html", "monokai");

    // close popup create file by ESC and ctrl + s = preventDefault()
    $(window).keydown(function(e) {

        var keyCode = e.which | e.keyCode;
        if(keyCode == 27) {
            var getCss = _css($(configElement.boxPopup));
            if(getCss['z-index'] != 2 && getCss['z-index'] != '2;') return false;
            $(configElement.btnClosePopupCreateFile).trigger('click');
        }

        if(keyCode == 83 && e.ctrlKey == true || keyCode == 83 && keyCode == 91) {
            e.preventDefault();
            var $file_id = $(configElement.tabFile+'.selected').data('file_slug'),
                _value =  arrayEditor[$file_id]?arrayEditor[$file_id].getValue():'',
                id = id_wg ? id_wg : 0;

            if(_value != '') {
                if ($file_id != '_0') {
                    var file_name = $(configElement.tabFile+'.selected').data('file_name');
                    var result = JSON.parse(AjaxFunction(
                        '/admin2018/modules/widget/ajax_save_file.php',
                        'POST',
                        {
                            html: _value,
                            wgid: id,
                            file_name:file_name,
                            file_id: $file_id
                        },
                        {
                            dataType: 'json',
                            async: false
                        }
                    ).responseText);
                }
                else {
                    var lpwg_id = $(configElement.selectName.format('group_name')).val(),
                        lpw_name = $(configElement.inputName.format('widget_name')).val();
                    if(lpw_name.trim() == '') {
                        $(configElement.inputName.format('widget_name')).css('border', '1px solid red');
                        return false;
                    }else{
                        $(configElement.inputName.format('widget_name')).css('border', '1px solid #ccc');
                    }
                    //
                    var result = JSON.parse(AjaxFunction(
                        '/admin2018/modules/widget/ajax_save_widget.php',
                        'POST',
                        {
                            html: _value,
                            wgid: id,
                            lpwg_id: lpwg_id,
                            lpw_name: replaceMQ(lpw_name)
                        },
                        {
                            dataType: 'json',
                            async: false
                        }
                    ).responseText);

                    if (result['code'] == 200) {
                        var href = "/admin2018/modules/widget/action.php?type_action=edit&id=" + result.lpw_id;
                        window.location.href = href;
                    }else if(result['code'] == 422){
                        $(configElement.inputName.format('widget_name')).css('border', '1px solid red');
                        $('.notify_error').html('Tên widget bị trùng!');
                    }
                }
            }
        }
    });

    // click vao file_name sau do goi file do len editor
    $(document).on('click', configElement.liFileName, function(e) {
        var file_name = $(this).data("file_name"),
            file_slug = $(this).data("file_slug"),
            idWidget = $(this).data("widget_id"),
            checkExits=false,
            explode_file_name = file_name.split("."),
            end_file = explode_file_name[(explode_file_name.length - 1)],
            language_editor = configElement.endFile[end_file]?configElement.endFile[end_file]:'';
        if(language_editor == '') return false;
        $(configElement.tabFile).each(function () {
            if($(this).data("file_slug") == file_slug){
                $(configElement.tabFile).removeClass('selected');
                $(this).addClass('selected');
                $('.'+configElement.boxContainEditor).addClass('hide');
                $('.'+configElement.boxContainEditor+'._'+file_slug).removeClass('hide');
                checkExits = true;
            }
        });
        if(checkExits) return false;
        $(configElement.tabFile).removeClass('selected');
        $(configElement.boxContainTab).append(configElement.eTab.format(file_name,file_slug));
        $('.'+configElement.boxContainEditor).addClass('hide');
        $('.'+configElement.colEditor+'>.row').append(configElement.eEditor.format(file_slug));
        // ban ajax di lay content cua file

        var result = JSON.parse(AjaxFunction(
            '/admin2018/modules/widget/ajax_get_content_file.php',
            'POST',
            {
                id : file_slug,
                idWg: idWidget
            },
            {
                dataType: 'json',
                async: false
            }
        ).responseText);
        if(result['code'] == 200){
            var content = result['content'];
            if(content == ''){
                content = b64EncodeUnicode('/*code {0} o day*/'.format(language_editor));
            }
            // khi ajax tra ra thi k nhan tag moi
            arrayEditor[file_slug] = renderCodeInEditor(content, "editor_"+file_slug, language_editor, "monokai");
        }

    });



    // enter create file
    $(configElement.inputName.format('new_file_name')).keydown(function(e){
        var keyCode = e.which | e.keyCode;
        if(keyCode == 13){
            $(configElement.btnCreateNewFile).trigger('click');
            e.preventDefault();
        }

    });

    // click close popup create file
    $(configElement.btnClosePopupCreateFile).click(function(e) {
        $(configElement.boxPopup).css('z-index', -1);
    });

    // click btn ok create file
    $(configElement.btnCreateNewFile).click(function(e) {
        var getCss = _css($(configElement.boxPopup));
        if(getCss['z-index'] != 2 && getCss['z-index'] != '2;') return false;
        var inputFileName = $(configElement.inputName.format('new_file_name')),
            fileName = (inputFileName.val()).trim(),
            lpw_id = inputFileName.data('lpw_id'),
            lpwg_id = inputFileName.data('lpwg_id');
        if(fileName == '') return false;
        var explode_file_name = fileName.split("."),
            end_file = explode_file_name[(explode_file_name.length - 1)];
        if(!configElement.endFile[end_file]) return false;
        /*
        * ban ajax ten cua file '/admin2018/modules/widget/ajax.php',
        * */
        var result = JSON.parse(AjaxFunction(
            '/admin2018/modules/widget/ajax_create_file.php',
            'POST',
            {
                file_name : fileName,
                end_file: end_file,
                id: lpw_id,
                gid: lpwg_id
            },
            {
                dataType: 'json',
                async: false
            }
        ).responseText);
        //
        if(result['code'] == 200){
            // dong popup them file
            $(configElement.btnClosePopupCreateFile).trigger('click');
            // tao lai list file sap xep theo thu tu abc
            var _html_li_file_name = '';
            // tao lai danh sach file sap xet theo abc
            for(var _index in result['list_file_name'])
            {
                _html_li_file_name += configElement.clsLiFileName.format(result['list_file_name'][_index][1], result['list_file_name'][_index][0], lpw_id);
            }
            $(document).find(configElement.ulListFile).html('').append(_html_li_file_name);

            rightClickMenuListFile();
            // add them tab moi = chinh file vua tao
            $('.item__'+result['new_id']).trigger('click');
        }
        else{
            e.preventDefault();
        }
    });

    // click tab add new tab
    $(configElement.tabNewFile).click(function(e) {
        // cho phep tao 10 file ... code something

        // open popup enter file name
        $(configElement.boxPopup).css({'z-index': 2});
        $(configElement.inputName.format('new_file_name')).focus();
    });

    // click select one tab
    $(document).on('click',configElement.tabFile,function(e) {
        var file_slug = $(this).data('file_slug');
        $(configElement.tabFile).removeClass("selected");
        $(this).addClass("selected");
        $('.'+configElement.boxContainEditor).addClass('hide');
        $('.'+configElement.boxContainEditor+'._'+file_slug).removeClass('hide');
    });

    // xoa tab code some thing
    $(document).on('click',configElement.tabFile+' b',function(e) {
        var _spanParent = $(this).parents('span'),
            file_slug = _spanParent.data('file_slug'),
            indexParent = _spanParent.index();

        // if(indexParent >= 0){
        //     $(configElement.tabFile+':nth-child('+(indexParent)+')').click();
        // }
        $('.'+configElement.boxContainEditor+'._'+file_slug).remove();
        _spanParent.remove();
        arrayEditor[file_slug]?delete arrayEditor[file_slug]: true;
    });

    // toggle list file use common
    $('.'+configElement.useCommonCss+', .'+configElement.useCommonJs).click(function () {
        var $siblings = $(this).siblings('.col-sm-12');
        if($siblings.hasClass('hide')){
            $siblings.removeClass('hide');
        }else{
            $siblings.addClass('hide');
        }
    });

    // choose group widget -> create widget

    $(configElement.selectName.format('group_name')).change(function(){
        var $wgName = replaceMQ($(this).find(":selected").text())+'-'+Date.now();
        $(configElement.inputName.format('widget_name')).val($wgName);
    });

})(jQuery);