
let filt = document.getElementById("filt");
let filts = document.getElementById("filtreler");
let filtIcon = document.querySelector(".bx-menu");
filt.addEventListener("click", function(){
    filts.classList.toggle("open");
    filtIcon.classList.toggle("bx-x");
});




function tikla(touched_id,danslar){
    //rowdaki buton
    const edit_btn = document.querySelector("#edit-"+touched_id);
    const delete_btn = document.querySelector("#delete-"+touched_id);
    //butonu değiştirme
    edit_btn.classList.toggle("btn-warning");
    
    if(edit_btn.type == "submit"){
        edit_btn.type = "";
    }else{
        edit_btn.type = "submit";
    }
    
    if(edit_btn.innerHTML =="Edit"){
        edit_btn.innerHTML = "Kaydet";
    }else{
        edit_btn.innerHTML = "Edit";
    }

    //div elementi (rowun hepsi)
    let button_parent = edit_btn.parentElement.parentElement;
    button_parent.style.background = "rgb(249, 240, 228)";
    
    let row_childs = button_parent.children;
    
    //itemlerin içindeki bilgiler
    let id = row_childs[0].className;
    let name = row_childs[1].className;
    let surname = row_childs[2].className;
    let tc = row_childs[3].className;
    let email = row_childs[4].className;
    let number = row_childs[5].className;
    let date = row_childs[6].className;
    let ldate = row_childs[7].className;
    let tür = row_childs[8].className;
    let sınıf = row_childs[9]; //sınıf 
    let span = sınıf.querySelector('span'); // span öğesini seç
    let cumle = span.innerHTML; // span öğesinin içindeki metni al
    
    //row elementleri
    row_name = document.getElementById("name_id"+id);
    row_surname = document.getElementById("surname_id"+id);
    row_tc = document.getElementById("tc_id"+id);
    row_email = document.getElementById("email_id"+id);
    row_number = document.getElementById("number_id"+id);
    row_bas_tarih = document.getElementById("date_id"+id);
    row_bit_tarih = document.getElementById("ldate_id"+id);
    row_tür = document.getElementById("tür_id"+id);
    row_sınıf = document.getElementById("sınıf_id"+id);
    
    //Silinecek SPAN DOM'ları
    let id_dom = document.querySelector("#id_"+id);
    let name_dom = document.querySelector("#name_"+id); // name;
    let surname_dom = document.querySelector("#surname_"+id); // surname
    let tc_dom = document.querySelector("#tc_"+id); // tc
    let email_dom = document.querySelector("#email_"+id); // email
    let number_dom = document.querySelector("#number_"+id); // number
    let date_dom = document.querySelector("#date_"+id); // bas tarihi
    let ldate_dom = document.querySelector("#ldate_"+id); // bit tarihi
    let edit_dom = document.querySelector("#edit-"+id); // edit button
    let delete_dom = document.querySelector("#delete-"+id); // edit button
    let tür_dom = document.querySelector("#tür_"+id); //edit tür
    let sınıf_dom = document.querySelector("#sınıf_"+id); // sınıf tür 

    //DOM'ları gizleme
    name_dom.style.display = "none";
    surname_dom.style.display = "none";
    tc_dom.style.display = "none";
    email_dom.style.display = "none";
    number_dom.style.display = "none";
    date_dom.style.display = "none";
    ldate_dom.style.display = "none";
    edit_dom.style.display = "none";
    delete_dom.style.display = "none";
    tür_dom.style.display = "none";
    sınıf_dom.style.display = "none";
    // YAPILANDIRMA


    
    //Name
    const text_name = document.createElement("input"); //yaratılan input elementi
    text_name.type = "text";
    text_name.name = "name";
    text_name.value =""+ name;
    text_name.style.border = "none";
    text_name.size = "5";
    text_name.style.background = "transparent";

    document.getElementById("name_id"+id).appendChild(text_name);

    //Surname
    const text_surname = document.createElement("input"); //yaratılan input elementi
    text_surname.type = "text";
    text_surname.name = "surname";
    text_surname.value = ""+surname;
    text_surname.style.border = "none";
    text_surname.size = "5";
    text_surname.style.background = "transparent";

    document.getElementById("surname_id"+id).appendChild(text_surname);

    //TC
    const text_tc = document.createElement("input"); //yaratılan tc inputu
    text_tc.type = "text";
    text_tc.name = "tc";
    text_tc.value = ""+tc;
    text_tc.style.border = "none";
    text_tc.size = "5";
    text_tc.style.background = "transparent";

    document.getElementById("tc_id"+id).appendChild(text_tc);
    
    //email
    const text_email = document.createElement("input"); //yaratılan input elementi
    text_email.type = "text";
    text_email.name = "email";
    text_email.value =""+ email;
    text_email.style.border = "none";
    text_email.size = "10";  
    text_email.style.background = "transparent";


    document.getElementById("email_id"+id).appendChild(text_email);

    //number
    const text_number = document.createElement("input"); //yaratılan input elementi
    text_number.type = "text";
    text_number.name = "number";
    text_number.value = number;
    text_number.style.border = "none";
    text_number.size = "7";
    text_number.maxLength = "10";
    text_number.style.padding = "0";
    text_number.style.background = "transparent";

    document.getElementById("number_id"+id).appendChild(text_number);

    //baslangıc date
    const text_date = document.createElement("input"); //yaratılan input elementi
    text_date.type = "date";
    text_date.name = "date";
    text_date.value = date;
    text_date.style.border = "none";
    text_date.min = "2020-00-00";
    text_date.max = "2030-00-00";
    text_date.size = "1";
    text_date.style.background = "transparent";

    document.getElementById("date_id"+id).appendChild(text_date);

    //bitis date
    const text_ldate = document.createElement("input"); //yaratılan input elementi
    text_ldate.type = "date";
    text_ldate.name = "ldate";
    text_ldate.value = ldate;
    text_ldate.style.border = "none";
    text_ldate.min = "2020-00-00";
    text_ldate.max = "2030-00-00";
    text_ldate.size = "2";
    text_ldate.style.background = "transparent";

    document.getElementById("ldate_id"+id).appendChild(text_ldate);

    //tür
    const text_tür = document.createElement("input");
    text_tür.type = "text";
    text_tür.name = "tür";
    text_tür.value = ""+tür;
    text_tür.style.border = "none";
    text_tür.size = "4";
    text_tür.style.background = "transparent";

    document.getElementById("tür_id"+id).appendChild(text_tür);

    //sınıf
    const text_sınıf = document.createElement("select"); 
    text_sınıf.type = "text";
    text_sınıf.name = "sınıf";
    text_sınıf.style.border = "none";
    text_sınıf.style.background = "transparent";

    var n= 0;
    
    var defaultOption = document.createElement("option");
    defaultOption.text = cumle;
    defaultOption.value = cumle;
    defaultOption.selected = true;
    text_sınıf.add(defaultOption);

    while (n < danslar.length) {
      var option = document.createElement("option");
      option.text = danslar[n];
      option.value = danslar[n];
      text_sınıf.add(option);
      n++;
    }


    document.getElementById("sınıf_id"+id).appendChild(text_sınıf);

    //edit button
    const text_edit = document.createElement("button");
    text_edit.className= "btn btn-warning btn-sm edit-btn";
    text_edit.type ="submit";
    text_edit.name = "editUser"; 
    text_edit.value = id;
    text_edit.innerHTML = "Kaydet";

    document.getElementById("edit_id"+id).appendChild(text_edit);

    //iptal button
    const iptal_edit = document.createElement("button");
    iptal_edit.className ="btn btn-danger btn-sm";
    iptal_edit.type = "";
    iptal_edit.name = "userdeletedeğisti";
    iptal_edit.innerHTML = "İptal";

    document.getElementById("edit_id"+id).appendChild(iptal_edit);

    iptal_edit.addEventListener("click" , function(){
        event.preventDefault();
        
        //background düzeltme
        button_parent.style.background = "#fff";  
        //buton düzeltmeleri 
        edit_btn.className = "btn btn-primary btn-sm edit-btn";
        edit_btn.innerHTML = "Edit";
        //inputları silme

        text_name.remove();
        text_surname.remove();
        text_tc.remove();
        text_email.remove();
        text_number.remove();
        text_date.remove();
        text_ldate.remove();
        iptal_edit.remove();
        text_edit.remove();
        text_tür.remove();
        text_sınıf.remove();

        //inputları tekrardan açığa çıkartmak

        name_dom.style.display = "block";
        surname_dom.style.display = "block";
        tc_dom.style.display = "block";
        email_dom.style.display = "block";
        number_dom.style.display = "block";
        date_dom.style.display = "block";
        ldate_dom.style.display = "block";
        edit_dom.style.display = "inline-block";
        delete_dom.style.display = "inline-block";
        tür_dom.style.display = "block";
        sınıf_dom.style.display = "block";
    });
}


                        // FİLTRELERİN JS KODU 

//ARAMA CUBUĞU
// Get the search input element
const searchInput = document.querySelector('.searchh');

// Get all the rows in the table
const rows = document.querySelectorAll('table tbody tr');
// Attach an event listener to the search input
searchInput.addEventListener('input', () => {
  // Get the search query
  const query = searchInput.value.toLowerCase().trim();

  // Loop through the rows and check if they match the search query
  rows.forEach(row => {
    const cells = row.querySelectorAll('td');
    let match = false;
    cells.forEach(cell => {
      if (cell.textContent.toLowerCase().includes(query)) {
        match = true;
      }
    });
    if (match) {
      row.style.display = '';
    } else {
      row.style.display = 'none';
    }
  });   
});


//FİLTRELER
// Get the dance style checkboxes
const danceCheckboxes = document.querySelectorAll('.danslarCheckbox');
// Attach an event listener to each dance style checkbox
danceCheckboxes.forEach(checkbox => {
  checkbox.addEventListener('change', () => {
    // Get the selected dance styles
    const selectedDances = Array.from(danceCheckboxes)
      .filter(checkbox => checkbox.checked)
      .map(checkbox => checkbox.parentElement.textContent.trim());

    // Loop through the rows and check if they match the selected dance styles
    rows.forEach(row => {
      const danceCell = row.querySelector('.tür');
      console.log(danceCell.textContent.trim());
      if (selectedDances.length === 0 || selectedDances.includes(danceCell.textContent.trim())) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  });
});

// SINIFLARIN FİLTRESİ
const siniflarCheckboxes = document.querySelectorAll('.sınıfCheckbox');
// Attach an event listener to each dance style checkbox
siniflarCheckboxes.forEach(checkbox => {
  checkbox.addEventListener('change', () => {
    // Get the selected dance styles
    const selectedDances = Array.from(siniflarCheckboxes)
      .filter(checkbox => checkbox.checked)
      .map(checkbox => checkbox.parentElement.textContent.trim());

    // Loop through the rows and check if they match the selected dance styles
    rows.forEach(row => {
      const danceCell = row.querySelector('.sınıf');
      console.log(danceCell.textContent.trim());
      if (selectedDances.length === 0 || selectedDances.includes(danceCell.textContent.trim())) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  });
});



