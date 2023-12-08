function kayıt(touched_id,danslar){
    //rowdaki buton
    const edit_btn = document.querySelector("#edit-"+touched_id);
    const kaydet_btn = document.querySelector("#editbtn-"+touched_id);
    //butonu değiştirme
    edit_btn.classList.toggle("d-none");
    kaydet_btn.classList.toggle("d-block");
      
    
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
  let tür_dom = document.querySelector("#tür_"+id); //edit tür
  let sınıf_dom = document.querySelector("#sinif_"+id); // sınıf tür 

  //DOM'ları gizleme
  name_dom.style.display = "none";
  surname_dom.style.display = "none";
  tc_dom.style.display = "none";
  email_dom.style.display = "none";
  number_dom.style.display = "none";
  date_dom.style.display = "none";
  ldate_dom.style.display = "none";
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


    document.getElementById("number_id"+id).appendChild(text_sınıf);
    
    //email
    const text_email = document.createElement("input"); //yaratılan input elementi
    text_email.type = "text";
    text_email.name = "email";
    text_email.value =""+ email;
    text_email.style.border = "none";
    text_email.size = "10";  
    text_email.style.background = "transparent";


    document.getElementById("email_id"+id).appendChild(text_email);


    //baslangıc date
    const text_date = document.createElement("input"); //yaratılan input elementi
    text_date.type = "date";
    text_date.name = "date";
    text_date.value = ldate;
    text_date.style.border = "none";
    text_date.min = "2020-00-00";
    text_date.max = "2030-00-00";
    text_date.size = "1";
    text_date.style.background = "transparent";

    document.getElementById("date_id"+id).appendChild(text_date);

    //Tarih
    const text_time = document.createElement("select");
    text_time.id = "ldate";
    text_time.name = "ldate";
    text_time.className = "form-select";
    text_time.style.border = "none";
    
    
    var defaultOption = document.createElement("option");
    defaultOption.text = "1 aylık";
    defaultOption.value = 28;
    defaultOption.selected = true;
    text_time.add(defaultOption);

    for (var n = 2 ; n <= 12;n++){
        var option = document.createElement("option");
        option.text = n + " aylık";
        option.value = n*28;
        text_time.add(option);
    }

    document.getElementById("ldate_id"+id).appendChild(text_time);

    //PARA
    const text_money = document.createElement("input");
    text_money.type = "text";
    text_money.name = "fiyat";
    text_money.placeholder = "Fiyat Gir";
    text_money.size = "5";

    document.getElementById("sinif_id"+id).appendChild(text_money);
}
