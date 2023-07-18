const ws = new WebSocket('ws://localhost:2345');

var userId;

/////////// Отправка сообщения из формы       
        
    document
        .querySelector("#form_send")
        ?.addEventListener("submit", (e) => {
            e.preventDefault();

            let sendData = {
                message: document.querySelector("#message").value
            }
                
            ws.send(JSON.stringify(sendData));
        })


///////////// Получение сообщения от сервера

   ws.onmessage = response => {
        let Message = JSON.parse(response.data);

        userId = Message.userId;  

        //console.log(Message);
        
        if(Message.action=='Message'){
            
            for(let key in Message.users){
                
                if(key!=userId){
                    
                    document.getElementById('messages').append('<p>'+Message.users[key].message+'</p>');
                    
                }
            }
    
    
        }
       

   }