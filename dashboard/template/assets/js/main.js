async function Registration(){
    let firstname = document.getElementById('firstname')
    let lastname = document.getElementById('lastname')
    let email = document.getElementById('email')
    let password = document.getElementById('password')
    let c_password = document.getElementById('c_password')
    let phone = document.getElementById('phone')
    let address = document.getElementById('address')
    let ref_id = document.getElementById('ref_id')
    let loading = document.getElementById('loading')
    let btn = document.getElementById('btn')
    loading.style.display = 'block'
    btn.style.display = 'none'
    const data = new FormData();
        data.append('firstname', firstname.value);
        data.append('lastname', lastname.value);
        data.append('email', email.value);
        data.append('password', password.value);
        data.append('c_password', c_password.value);
        data.append('phone', phone.value);
        data.append('address', address.value);
        data.append('ref_id', ref_id.value);
   try {
    const res = await fetch('../api/register', {
        method: "POST",
        body: data
    })
    const reply = await res.json()
    alert(reply.msg)
    if(reply.msg.search('Successful')>-1){
         window.location.assign('login')

    }
   } catch (error) {
    console.log(error);
   }finally{
    loading.style.display = 'none'
    btn.style.display = 'block'
   }

}

async function Login(){
            let email = document.getElementById('email')
            let password = document.getElementById('password')
            const data = new FormData();
                
                data.append('email', email.value);
                data.append('password', password.value);
                let loading = document.getElementById('loading')
            let btn = document.getElementById('btn')
            loading.style.display = 'block'
            btn.style.display = 'none'
           try {
            const res = await fetch('../api/login', {
                method: "POST",
                body: data
            })
            const reply = await res.json()
            alert(reply.msg)
            if (reply.user_status === "Unverified") {
            window.location.assign('locked')
            }
            else if (reply.msg === "Login Successful") {
                
            localStorage.setItem('login', JSON.stringify(reply))
            if (reply.level === 'admin') {
            window.location.assign('admin/')
            }else{
            window.location.assign('users/')
            }
            }
           } catch (error) {
            console.log(error);
           }finally{
            loading.style.display = 'none'
            btn.style.display = 'block'
           }

        }
        
        async function Locked(){
            let login = JSON.parse(localStorage.getItem('login'))
            let btn = document.getElementById('btn')
            const data = new FormData();
            data.append('submit', btn.value);
            let loading = document.getElementById('loading')
            loading.style.display = 'block'
            btn.style.display = 'none'
           try {
            const res = await fetch('../api/locked', {
                method: "POST",
                headers: login,
                body: data
            })
            const reply = await res.json()
            alert(reply.msg)
            
           } catch (error) {
            console.log(error);
           }finally{
            loading.style.display = 'none'
            btn.style.display = 'block'
           }

        }
        async function Forgot_password(){
            let email = document.getElementById('email')
            const data = new FormData();
                
                data.append('email', email.value);
                let loading = document.getElementById('loading')
            let btn = document.getElementById('btn')
            loading.style.display = 'block'
            btn.style.display = 'none'
           try {
            const res = await fetch('../api/forgot_password', {
                method: "POST",
                body: data
            })
            const reply = await res.json()
            alert(reply.msg)
            
            
           } catch (error) {
            console.log(error);
           }finally{
            loading.style.display = 'none'
            btn.style.display = 'block'
           }

        }
        const Change_forgot_password = async(email, token)=>{
            let password = document.getElementById('password')
            let c_password = document.getElementById('c_password')
            const data = new FormData();
                
                data.append('password', password.value);
                data.append('c_password', c_password.value);
                data.append('email', email);
                data.append('token', token);
                let loading = document.getElementById('loading')
            let btn = document.getElementById('btn')
            loading.style.display = 'block'
            btn.style.display = 'none'
           try {
            const res = await fetch('../api/forgot_password', {
                method: "POST",
                body: data
            })
            const reply = await res.json()
            alert(reply.msg)
            if(reply.msg.search('successfully')>-1){
                window.location.assign('login')

           }
            
           } catch (error) {
            console.log(error);
           }finally{
            loading.style.display = 'none'
            btn.style.display = 'block'
           }

        }