var connection_id;
var order_id;
var hash;


    
function loading(order_id,active=true){
    if(active){
        document.querySelector('#chat-messages-'+order_id+' .loading').classList.add("active");
    }else{
        document.querySelector('#chat-messages-'+order_id+' .loading').classList.remove("active");  
    }
}





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
        
        loading(order_id);
        ws.send(JSON.stringify(sendData));         
        //loading(order_id);
       
    });
}


ws.onopen = function () {};
/*
    ws.onopen = function () {
    
        let sendData = {
            action: 'User',
            user_id: user_id,
            user_hash:user_hash
        }  
        
        //console.log(sendData);
        
              
        ws.send(JSON.stringify(sendData));      
        
        
    }; 

*/
ws.onmessage = response => {
    let Message = JSON.parse(response.data);
    
    //connection_id = Message.connection_id;  

    if(Message.action=='Message' && document.getElementById('messages-'+Message.order_id)){
            
            
            loading(Message.order_id,0);
            
            document.getElementById('messages-'+Message.order_id).innerHTML = Message.messages;
            document.querySelector('#chat-modal-'+Message.order_id+' .messages-content.content-scroll').scrollTop = 100000;
    }

}    


/////////////////////

document.querySelectorAll(".form_send").forEach((form) => {
    form.addEventListener("submit", (e) => {
        e.preventDefault();
        AJAX(e.target);
        form.message.value = '';
    });
    
    form.onkeydown = function(e){
       if(e.keyCode == 13){
            e.preventDefault();
            AJAX(form);
            form.message.value = '';
       }
    };
})  



function AJAX(form) {

let url = form.getAttribute("action");
let data = new FormData(form);

data.append('hash', hash);


let new_message = '<div class="message-row my-message"><div class="message-block">'+
                    '<div class="message">'+form.message.value+'</div>'+
                        '<div class="message-info">'+
                            '<div class="time">Отправка....</div>'+
                            '<div class="status"></div>'+
                        '</div>'+
                    '</div>'+
                  '</div>';

document.querySelector('#chat-modal-'+form.order_id.value+' #messages-'+form.order_id.value).insertAdjacentHTML("beforeend",new_message);
document.querySelector('#chat-modal-'+form.order_id.value+' .messages-content.content-scroll').scrollTop = 100000;


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