/**
 * Osługa przeładowania listy rozwijalnej z podkategoriami
 * w momencie, gdy uzytkownik zmieni kategorię główną.
 */

/**
 * Funkcja usuwa wszystkie opcje dla przekazanego jej jako argument elementu.
 * @param {type} selectbox
 * @returns {undefined}
 */
function removeOptions(selectbox)
{
    var i;
    if(selectbox !== null) {
        selectbox.options.length = 0;
    }
}


function  changeElAttrVal(el_id, new_value) {
    document.getElementById(el_id).value=new_value;
}

function changeEditorContent(content) {
    //var tcontent = $('#mceEditor').val();
    if(content.length > 0) {
        tinymce.get('mceEditor').setContent(content);
    }   
}



/**
 * Funkcja pobieracjąca z serwera listę podkategorii dla wybranej kategorii głównej
 * podczas tworzenia/edycji artykułu.
 * Widok: articles.create
 *        articles.edit
 * @returns {undefined}
 */
function updateSubcategoriesList() {
    var category_id = $('#selected_category').val();
    var url = window.location.origin + "/subcategories/retrieve";
    if (category_id.length === 0) {
        $('#selected_category').focus();
        removeOptions(document.getElementById('selected_subcategory'));
        $('#selected_subcategory').append('<option value="" selected="selected">Wybierz podkategorię..</option>');
    } else {
        $.ajax({
            url: url,
            type: 'POST',
            data: { categoryId: category_id  },
            success: function(data) {
                var p_data = $.parseJSON(data);  
                removeOptions(document.getElementById('selected_subcategory'));
                $.each(p_data, function(i, subc) {
                    
                    $('#selected_subcategory').append('<option value="' + subc.id + '">' + subc.name + '</option>');
                });
            }
        });
    }
}

/*
 * Funkcja pobiera listę podkategorii i wyświetla ją w panelu zarządzania podkategoriami.
 * Widok: subcategories.show_list
 * @returns {undefined}
 */
function getSubcategoriesList() {
    var category_id = $('#selected_category').val();
    var url = window.location.origin + "/subcategories/retrieve";
    
    if (category_id.length === 0) {
        var slg = document.getElementById('subcategories-list-group');
        slg.innerHTML='';
        $('#selected_category').focus();
        var heading = document.createElement('li');
        heading.className="list-group-item";
        var heading_title = document.createElement('h4');
        heading_title.className="list-group-item-heading";           
        heading_title.innerHTML="Lista podkategorii";
        heading.appendChild(heading_title);
        slg.appendChild(heading);
    } else {
        $.ajax({
            url: url,
            type: 'POST',
            data: { categoryId: category_id  },
            success: function(data) {
                // console.log("Success");
                var p_data = $.parseJSON(data);
                var slg = document.getElementById('subcategories-list-group');
                slg.innerHTML='';
                var heading = document.createElement('li');
                heading.className="list-group-item";
                var heading_title = document.createElement('h4');
                heading_title.className="list-group-item-heading";           
                heading_title.innerHTML="Lista podkategorii";
                heading.appendChild(heading_title);
                slg.appendChild(heading);
                
                if(!p_data) {
                    var slg_row = document.createElement('li');
                    slg_row.className="list-group-item";
                    slg_row.innerHTML="Wybrana kategoria główna nie posiada podkategorii";
                    slg.appendChild(slg_row);
                }
                $.each(p_data, function(i, subc) {
                    var row = document.createElement('li');
                    row.className="list-group-item";
                    //var text = '<b>' + subc.name + '</b>';
                    
                    var sName = document.createElement('p');
                    sName.innerHTML = '<b>' + subc.name + '</b>';
                    row.appendChild(sName);
                    if (subc.description) {
                        var sDesc = document.createElement('p');
                        sDesc.innerHTML = subc.description;
                        row.appendChild(sDesc);
                    }
                       
                    //row.innerHTML=text;
                    var btn1 = document.createElement('a');
                    var btn2 = document.createElement('a');
                    btn1.className="btn btn-default btn-sm";
                    btn1.setAttribute("role","button");
                    btn1.setAttribute("href", window.location.origin + "/subcategories/" + subc.id + "/edit");
                    btn1.innerHTML="Edytuj";
                    btn2.className="btn btn-default btn-sm";
                    btn2.setAttribute("role","button");
                    btn2.setAttribute("href", window.location.origin + "/subcategories/" + subc.id + "/remove");
                    btn2.innerHTML="Usuń";
                    row.appendChild(document.createElement('br'));
                    row.appendChild(btn1);
                    row.appendChild(btn2);
                    //var b1 = document.createElement('span');
                    //var b2 = document.createElement('span');
                    //b1.className="badge";
                    //b1.setAttribute("role","button");
                    //b1.setAttribute("href", window.location.origin + "/subcategories/" + subc.id + "/edit");
                    //b1.innerHTML = "Edytuj";
                    //b2.className="badge";
                    //b2.setAttribute("role","button");
                    //b2.setAttribute("href", window.location.origin + "/subcategories/" + subc.id + "/remove");
                    //b2.innerHTML = "Usuń";
                    //row.appendChild(b1);
                    //row.appendChild(b2);
                    slg.appendChild(row);
                    //el.innerHTML = subc.name + '<a class="btn btn-primary" role="button" href="{{ URL::to('/') }}/subcategories/list">Anuluj</a>'
                    //$('#selected_subcategory').append('<option value="' + subc.id + '">' + subc.name + '</option>');
                    // console.log(subc.id + ' ' + subc.name);
                });
                
                //document.getElementById('subcategories_list').appendChild(list);
            }
        });
    }
}


function updateSubcategoriesSelect() {
    var category_id = $('#selected_category').val();
    var url = window.location.origin + "/subcategories/retrieve";
    if (category_id.length === 0) {        
        $('#selected_category').focus();
        removeOptions(document.getElementById('selected_subcategory'));
        $('#selected_subcategory').append('<option value="" selected="selected">Wybierz podkategorię..</option>');
        //var slg = document.getElementById('articles-list-group');
        //slg.innerHTML='';
    } 
    return $.ajax({
            url: url,
            type: 'POST',
            data: { categoryId: category_id  },
            success: function(data) {
                var p_data = $.parseJSON(data);  
                removeOptions(document.getElementById('selected_subcategory'));
                $.each(p_data, function(i, subc) {
                    
                    $('#selected_subcategory').append('<option value="' + subc.id + '">' + subc.name + '</option>');
                });
            }
        });
}


/*
 * 
 * Widok: 
 * @returns {undefined}
 */
function getArticlesList() {
    var category_id = $('#selected_category').val();
    var subcategory_id = $('#selected_subcategory').val();
    var url = window.location.origin + "/articles/retrieve";
    console.log('Category_id: ' + category_id);
    console.log('Subcategory_id: ' + subcategory_id);
    if (category_id.length === 0) {
        var slg = document.getElementById('articles-list-group');
        slg.innerHTML='';
        var heading = document.createElement('li');
        heading.className="list-group-item";
        var heading_title = document.createElement('h4');
        heading_title.className="list-group-item-heading";           
        heading_title.innerHTML="Lista artykułów";
        heading.appendChild(heading_title);
        slg.appendChild(heading);
        $('#selected_category').focus();
        removeOptions(document.getElementById('selected_subcategory'));
        $('#selected_subcategory').append('<option value="" selected="selected">Wybierz podkategorię..</option>');
    } else {
        $.ajax({
            url: url,
            type: 'POST',
            data: { 
                //categoryId: category_id,
                subcategoryId: subcategory_id
                
            },
            //dataType: 'json',
            success: function(data) {
                console.log("Success in getArticlesList()");
                var p_data = $.parseJSON(data);
                var slg = document.getElementById('articles-list-group');
                slg.innerHTML='';
                var heading = document.createElement('li');
                heading.className="list-group-item";
                var heading_title = document.createElement('h4');
                heading_title.className="list-group-item-heading";           
                heading_title.innerHTML="Lista artykułów";
                heading.appendChild(heading_title);
                slg.appendChild(heading);
                if(!p_data) {
                    console.log("No articles for selected category/subcategory.");
                    var slg_row = document.createElement('li');
                    slg_row.className="list-group-item";
                    slg_row.innerHTML="Brak artykułów";
                    slg.appendChild(slg_row);
                } else {

                $.each(p_data, function(i, article) {
                    console.log("There are some articles..");
                    var row = document.createElement('li');
                    row.className="list-group-item";
                    
                    var aTitle = document.createElement('p');
                    aTitle.innerHTML = '<b>' + article.title + '</b>';
                    //var d = new Date(article.updated_at);
                    var aMeta = document.createElement('p');
                    aMeta.innerHTML = 'Ostatnio edytowany ' + article.updated_at;
                    row.appendChild(aTitle);
                    row.appendChild(aMeta);
                    
                    var btn0 = document.createElement('a');
                    var btn1 = document.createElement('a');
                    var btn2 = document.createElement('a');
                    btn0.className="btn btn-default btn-sm";
                    btn0.setAttribute("role","button");
                    btn0.setAttribute("href", window.location.origin + "/articles/" + article.id);
                    btn0.innerHTML="Wyświetl";
                    btn1.className="btn btn-default btn-sm";
                    btn1.setAttribute("role","button");
                    btn1.setAttribute("href", window.location.origin + "/articles/" + article.id + "/edit");
                    btn1.innerHTML="Edytuj";
                    btn2.className="btn btn-default btn-sm";
                    btn2.setAttribute("role","button");
                    btn2.setAttribute("href", window.location.origin + "/articles/" + article.id + "/remove");
                    btn2.innerHTML="Usuń";
                    
                    row.appendChild(document.createElement('br'));
                    row.appendChild(btn0);
                    row.appendChild(btn1);
                    row.appendChild(btn2);
 
                    slg.appendChild(row);
                });
                
            }
            } 
        });
    }
}
/*
function funcOnFailure() {
    console.log('In funcOnFailure');
    $('#selected_category').focus();
    removeOptions(document.getElementById('selected_subcategory'));
     $('#selected_category').append('<option value="" selected="selected">Wybierz kategorię główną..</option>');
    $('#selected_subcategory').append('<option value="" selected="selected">Wybierz podkategorię..</option>');
    var slg = document.getElementById('articles-list-group');
    slg.innerHTML='';
}
*/
function updateArtSubcList() {
    $.when( updateSubcategoriesSelect() ).then(getArticlesList);
    //updateSubcategoriesList();
    //getArticlesList();
    
}




//****************************************

/*
 * 
 */
function saveArticle() {
    var title = $('#title').val();
    var author = $('#author').val();
    //var el = document.getElementById('selected_subcategory');
    //var subcategory_id = el.options[el.selectedIndex].value;
    var subcategory_id = $('#selected_subcategory').val();
    
    // TUTAJ BYŁA ZMIANA
    //var contents = tinyMCE.activeEditor.getContent();
    var contents = tinymce.get('mceEditor').getContent();
    //
    //var contents = $('#mceEditor').val();
    var url = "../articles/create";
    //console.log("Data to be send:");
   // console.log(subcategory_id);
    if (contents.length === 0) {
        $('#mceEditor').focus();
        //$('#selected_subcategory').append('<option value="" selected="selected">Wybierz podkategorię..</option>');
    } else {
        $.ajax({
            url: url,
            type: 'POST',
            //contentType: "application/json; charset=utf-8",
            data: {
                title: title,
                author: author,
                subcategory_id: subcategory_id,
                contents: contents
            },
            dataType: 'json',
            success: function(data) {
                //var p_data = $.parseJSON(data);
                //$.each(p_data, function(i, subc) {
                    //$('#selected_subcategory').
                    //alert(data.status + ': ' + data.message);
                    if(data.status==='success') {
                        console.log(data.status + ': ' + data.message);
                        window.location.href = data.redirect;
                    }
                    else {
                        console.log("Błędy w formularzu:");
                        for (var k in data){
                            if (data.hasOwnProperty(k)) {
                                // dopisać pomijanie 2 pierwszych elementów tablicy: status i message
                               
                               console.log("" + k + ": " + data[k]);
                            }
                        }
                    }
            },
            error: function() {
                alert("Some error occured..");
            }
        });
    }    
}


function saveEditedArticle() {
    var title = $('#title').val();
    var author = $('#author').val();
    //var el = document.getElementById('selected_subcategory');
    //var subcategory_id = el.options[el.selectedIndex].value;
    var subcategory_id = $('#selected_subcategory').val();
    //var contents = tinyMCE.activeEditor.getContent();
    var contents = tinymce.get('mceEditor').getContent();
    var url = "../articles/create";
    console.log("Data to be send:");
    console.log(subcategory_id);
    if (contents.length === 0) {
        $('#mceEditor').focus();
        //$('#selected_subcategory').append('<option value="" selected="selected">Wybierz podkategorię..</option>');
    } else {
        $.ajax({
            url: url,
            type: 'POST',
            //contentType: "application/json; charset=utf-8",
            data: {
                title: title,
                author: author,
                subcategory_id: subcategory_id,
                contents: contents
            },
            dataType: 'json',
            success: function(data) {
                //var p_data = $.parseJSON(data);
                //$.each(p_data, function(i, subc) {
                    //$('#selected_subcategory').
                    //alert(data.status + ': ' + data.message);
                    if(data.status==='success') {
                        console.log(data.status + ': ' + data.message);
                        window.location.href = data.redirect;
                    }
                    else {
                        console.log("Błędy w formularzu:");
                        for (var k in data){
                            if (data.hasOwnProperty(k)) {
                                // dopisać pomijanie 2 pierwszych elementów tablicy: status i message
                               
                               console.log("" + k + ": " + data[k]);
                            }
                        }
                    }

            },
            error: function() {
                alert("Some error occured..");
            }
        });
    }    
}








