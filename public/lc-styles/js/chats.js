var connection_id;
var order_id;
var hash;


var chats = document.querySelectorAll(".open-chat")
for (var i = 0; i < chats.length; i++) {
    chats[i].addEventListener('click', function(event) {
    order_id = this.getAttribute("order_id");
    user_id = this.getAttribute("user_id");
    hash = this.getAttribute("hash");  
        let sendData = {
            order_id: order_id,
            user_id: user_id,
            hash:hash,
            view:1,
        }      
        //console.log(sendData);  
          ws.send(JSON.stringify(sendData));         
       
       
    });
}


ws.onopen = function () {};

ws.onmessage = response => {
    let Message = JSON.parse(response.data);
    //connection_id = Message.connection_id;  

    if(Message.action=='Message' && document.getElementById('messages-'+Message.order_id)){
            document.getElementById('messages-'+Message.order_id).innerHTML = Message.messages;
    }

}    


/////////////////////

document.querySelectorAll(".form_send").forEach((form) => {
    form.addEventListener("submit", (e) => {
        e.preventDefault();
        AJAX(e.target);
     
    })
})  



function AJAX(form) {

let url = form.getAttribute("action");
let data = new FormData(form);

data.append('hash', hash);

const requestOptions = {
    method: "POST",
    headers: {
    },
    body: data,
}

fetch(url, requestOptions)
    .then((response) => {
        if (response.status >= 200 && response.status < 300) { 
            return Promise.resolve(response)
        } else {
            return Promise.reject(new Error(response.statusText))
        }
    })
    .then((response) => {
        return response.json()
    })
    .then((data) => {
            
            if (data.result=='ok') {
            
                let sendData = {
                    order_id: order_id,
                    user_id: user_id,
                    hash:hash,
                    view:1
                }        
                  ws.send(JSON.stringify(sendData));  
           
            }

    })
    .catch((err) => {

    })
}