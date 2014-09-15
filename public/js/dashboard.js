/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function prepareUserProfileForm(current_username) {
    var username_changed = document.getElementById('username_changed');
    var new_password_set = document.getElementById('new_password_set');
    if ($('#user_username').val() !== current_username) {
        username_changed.value = 1;
    }
    username_changed.value = 0;
    if($('#new_password').val().lenth > 0) {
        new_password_set.value = 1;
    }
    new_password_set.value = 0;   
}

function getUserMenu() {
    var slg = document.getElementById('subcategories-list-group');
                slg.innerHTML='';
                // czyszczony jest div zawierający listę podkategorii
                //document.getElementById('subcategories_list').innerHTML='';
                //var list = document.createElement('ul');
                //list.className="list-group";
                //removeOptions(document.getElementById('selected_subcategory'));
                //$.each(opts, function(i, subc) {
                    var row = document.createElement('li');
                    row.className="list-group-item";
                    row.innerHTML=subc.name;
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
               // }
}

