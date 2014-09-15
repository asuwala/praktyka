/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function hideMenu() {
    $('#menu-kb-subcategories').hide();
    $('#menu-ex-subcategories').hide();
    //var menu_kb = document.getElementById('menu-kb-subcategories');
    //menu_kb.innerHTML='';
    //var menu_ex = document.getElementById('menu-ex-subcategories');
    //
    //menu_ex.innerHTML='';
}

function showKbMenu() {
    console.log("in show kb menu");
    //var menu_ex = document.getElementById('menu-ex-subcategories');
    $('#menu-ex-subcategories').hide();
    $('#menu-kb-subcategories').show();
    //menu_ex.styles.display = "none";

    //var menu_kb = document.getElementById('menu-kb-subcategories');
    //menu_kb.styles.display = "block";
}

function showExMenu() {
    console.log("in show ex menu");
    $('#menu-kb-subcategories').hide();
    $('#menu-ex-subcategories').show();
    //var menu_kb = document.getElementById('menu-kb-subcategories');
    //menu_kb.styles.display = "none";
    //var menu_ex = document.getElementById('menu-ex-subcategories');
   // menu_ex.styles.display = "block";
}







function getNewestArticle() {
    
    var url = window.location.origin + "/articles/get-newest";
        $.ajax({
            url: url,
            type: 'POST',
            data: { isAuth: isAuth  },
            dataType: 'json',
            success: function(data) {
                console.log('succes in getNewest');
                //var p_data = $.parseJSON(data);
                //$.each(p_data, function(i, subc) {
                    //$('#selected_subcategory').
                    //alert(data.status + ': ' + data.message);
                    console.log('data.error: ' + data.error)
                    if(!data.error) {
                        var aTitle = document.getElementById('a_title');
                        aTitle.innerHTML=data.title;
                        var aMeta1 = document.getElementById('a_meta1');
                        aMeta1.innerHTML=data.meta1;
                        var aMeta2 = document.getElementById('a_meta2');
                        aMeta2.innerHTML = data.categoryName + ' -> ' + data.subcategoryName;
                    
                        var aContents = document.getElementById('a_contents');
                        aContents.innerHTML = data.contents;
                    } else {
                        var aTitle = document.getElementById('a_title');
                        aTitle.innerHTML="Baza artykułów jest pusta!";
                    }
                    
            }

        
        });
}


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