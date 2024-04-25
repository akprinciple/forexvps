const Session = async()=>{
    let login = JSON.parse(localStorage.getItem('login'))
    if (!login) {
        window.location.assign('../login')
    }
   try {
    const res =  await fetch('../../api/users/inc/session2', {
        // method: "POST",
        headers: login,
    })
    const reply = await res.json()
    let status = reply.status
    if (status>400) {
    alert(reply.msg)
        
        if (status === 503) {
        window.location.assign('../locked');
    }else if (status >=500){
        window.location.assign('../login')
    }else{
        window.location.assign('../login')
    }
    }
   } catch (error) {
    console.log(error);
   }

}

Session()