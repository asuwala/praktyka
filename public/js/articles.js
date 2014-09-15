/*
 * 
 * Widok: 
 * @returns {undefined}
 */
function getArticlesList() {
    var category_id = $('#selected_category').val();
    var subcategory_id = $('#selected_subcategory').val();
    var url = window.location.origin + "/articles/getArticlesList";
    
    if (category_id.length === 0) {
        var slg = document.getElementById('articles-list-group');
        slg.innerHTML='';
        $('#selected_category').focus();
    } else {
        $.ajax({
            url: url,
            type: 'POST',
            data: { 
                categoryId: category_id,
                subcategoryId: subcategory_id
                
            },
            success: function(data) {
                // console.log("Success");
                var opts = $.parseJSON(data);
                var slg = document.getElementById('articles-list-group');
                slg.innerHTML='';
                // czyszczony jest div zawierający listę podkategorii
                //document.getElementById('subcategories_list').innerHTML='';
                //var list = document.createElement('ul');
                //list.className="list-group";
                //removeOptions(document.getElementById('selected_subcategory'));
                if(!opts) {
                    var slg_row = document.createElement('li');
                    slg_row.className="list-group-item";
                    slg_row.innerHTML="Brak artykułów";
                    slg.appendChild(slg_row);
                }
                $.each(opts, function(i, article) {
                    var row = document.createElement('li');
                    row.className="list-group-item";
                    var text = '<b>' + article.title + '</b><br>utworzony ' +  article.created_at + 
                            ' przez ' + article.author + '<br>ostatnio edytowany w dniu ' + article.updated_at;
                       
                    row.innerHTML=text;
                    var btn0 = document.createElement('a');
                    var btn1 = document.createElement('a');
                    var btn2 = document.createElement('a');
                    btn0.className="btn btn-default btn-sm";
                    btn0.setAttribute("role","button");
                    btn0.setAttribute("href", window.location.origin + "/articles/" + article.id);
                    btn0.innerHTML="Edytuj";
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


function updateLists() {
    updateSubcategoriesList();
    getArticlesList();
    
}

