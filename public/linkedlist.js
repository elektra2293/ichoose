// JavaScript Document
function getXmlHttp(){
  var xmlhttp;
  try {
    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
  } catch (e) {
    try {
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    } catch (e) {
      xmlhttp = false;
    }
  }
  if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
    xmlhttp = new XMLHttpRequest();
  }
  return xmlhttp;
}




// javascript-код голосования из примера
function vote(doc, sender, reciever) {
	// (1) создать объект для запроса к серверу
	var req = getXmlHttp();
       
        // (2)
	// span рядом с кнопкой
	// в нем будем отображать ход выполнения
	var statusElem = document.getElementById(reciever);
	var CategoryId = document.getElementById(sender).value;
	
	req.onreadystatechange = function() {  
        // onreadystatechange активируется при получении ответа сервера

		if (req.readyState == 4) { 
            // если запрос закончил выполняться


			if(req.status == 200) { 
                 // если статус 200 (ОК) - выдать ответ пользователю
				
				statusElem.innerHTML = req.responseText;
			}
			// тут можно добавить else с обработкой ошибок запроса
		}

	}

       // (3) задать адрес подключения
	  

	req.open('GET', doc+'.php?id='+CategoryId, true);  

	// объект запроса подготовлен: указан адрес и создана функция onreadystatechange
	// для обработки ответа сервера
	 
        // (4)
	req.send(null);  // отослать запрос
  
        // (5)	 
}


$(document).ready(function() {
	$('#sity2').change(function(){
	vote("street", "sity2", "street");
	$('#street').attr('disabled', false);
	});
	$('#sity2').change(function(){
	vote("metro", "sity2", "show");
	});   
$('#category').change(function(){
	vote("subcategory", "category", "subcat");
	$('#subcat').attr('disabled', false);
	});   

});

