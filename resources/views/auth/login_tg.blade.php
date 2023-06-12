<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    
                <?php //$key = Functions::generateCode(30); ?>
                                
                <p>Способ 1: Для авторизации перейдите по ссылке <a href="http://cflink.ru/admost333_bot?start=<?php echo $random; ?>" target="_blank"><i class="fa fa-telegram" aria-hidden="true"></i> admost333_bot</a> и нажмите "Start".</p>
                <p>Способ 2: Для авторизации отправьте боту <a href="http://cflink.ru/admost333_bot" target="_blank"><i class="fa fa-telegram" aria-hidden="true"></i> admost333_bot</a> следующий текст (кликните, чтобы скопировать в буфер обмена):</p>
                
                <p>/start <?php echo $random; ?></p>              


                <script type="text/javascript">
                
                
                function checkAuth() {
                
                    const url = '/check_auth';
                    
                    let data = new FormData();
                    
                    data.append("_token", '<?php echo csrf_token(); ?>')
                    data.append("key", '<?php echo $random; ?>')
                
                    const requestOptions = {
                        method: "POST",
                        headers: {
                            "X-Requested-With": "XMLHttpRequest",
                        },
                        body: data,
                        redirect: "follow",
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
                            
                            if (data.result == "ok") {
                                
                                window.location.href = "/dashboard";
                                
                                //error.style = "display: none"
                                //submit && submit.setAttribute("disable", false)
                                //form.classList.add("d-none")
                                //success.style = "display: block"
                            } else {
                                //error.style = "display: block"
                            }
                            
                        
                        })
                        .catch((err) => {
                            //error.style = "display: block"
                            //console.error("Request failed", err)
                        })    
                    
                    }
                    
                    
                    setInterval(checkAuth, 2000);
                    
                
                </script>    
    
    
    
    
    
</x-guest-layout>
