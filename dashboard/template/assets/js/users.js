let login = JSON.parse(localStorage.getItem('login'))
search_username.innerHTML = login.firstname
search_username2.innerHTML = login.firstname + ' '+ login.lastname
async function Summary(){
    
  let balls = document.getElementById('loading')
  balls.style.display = 'block'
 try {
  const res = await fetch('../../api/users/summary', {
      method: "GET",
      headers: login,
  })
  const reply = await res.json()
  amount_spent.innerHTML = reply.data.amount_spent
  wallet_balance.innerHTML = reply.data.wallet_balance
  affiliate_earnings.innerHTML = reply.data.affiliate_wallet_balance
  amount_withdrawn.innerHTML = reply.data.amount_withdrawn
  
  
 } catch (error) {
  console.log(error);
 }finally{
  balls.style.display = 'none'
 }

}
async function Vps(){
    
    let balls = document.getElementById('loading')
    balls.style.display = 'block'
   try {
    const res = await fetch('../../api/users/vps', {
        method: "GET",
        headers: login,
    })
    const reply = await res.json()
    reply.data.forEach((element,i) => {
        vps.innerHTML += `
        
        <div class="col-md-4 mt-3">
                    <div class="p-3 rounded border">
                        <h4>${element.vps}</h4>
                        <h3 class="">$${element.price} / Month</span></h3>
                        <span>$0 Setup Fee</span>
                        <p class="border-top mt-2"></p>
                        <div class="mt-3" style='height: 200px; overflow-y: auto;'>

                        ${element.description}
                        </div>
                         <a href="subscribe?vps=${element.vps}" class="btn btn-success mt-3 w-100">Order Now!</a>
                    </div>

                </div>
              `
          })
  } catch (error) {
    console.log(error);
  }finally{
  balls.style.display = 'none'
  }
  }
  

  const Select_Vps_For_Subscription= async(vps) => {
    let balls = document.getElementById('loading')
    balls.style.display = 'block'
    // subcategories.innerHTML = []
   try {
    const res = await fetch('../../api/users/vps?vps='+vps, {
        method: "GET",
        headers: login,
    })
    const reply = await res.json()
    const find = await fetch('../../api/users/summary', {
      method: "GET",
      headers: login,
  })
  const balance = await find.json()
  wallet_balance = balance.data.wallet_balance
  vps_price = reply.data.price
  content.innerHTML = `
  <div class="">
                  <div class="p-3 rounded border">
                      <h4>${reply.data.vps}</h4>
                     
                      <span>Forex VPS</span>
                      <p class="border-top mt-2"></p>
                      <div class="mt-3">

                      ${reply.data.description}
                      </div>
                  </div>
              </div>
            `
            vps_name.innerHTML = `${reply.data.vps}`
            vps_name2.innerHTML = `${reply.data.vps}`
            price.innerHTML = `${reply.data.price}`
            price2.innerHTML = `${reply.data.price}`
            total.innerHTML = `${reply.data.price}`
            wal_balance.innerHTML = wallet_balance
  } catch (error) {
    console.log(error);
  }finally{
  balls.style.display = 'none'
  } 
  }
  
  const Change_Duration_On_Select = async() =>{
    let duration = document.getElementById('duration')
    let username = document.getElementById('username')
    let password = document.getElementById('password')
    price.innerHTML = vps_price*duration.value
    price2.innerHTML = vps_price*duration.value
    total.innerHTML = vps_price*duration.value
    if (duration.value === '1') {
      plan.innerHTML = 'Monthly'
    } else if (duration.value === '3') {
      plan.innerHTML = 'Quarterly'
    } else if (duration.value === '6') {
      plan.innerHTML = 'Semi Annually'
    }else if (duration.value === '12') {
      plan.innerHTML = 'Annually'
    }else{
      plan.innerHTML = 'Monthly'
    }
  }
  
  const Convert1 = async()=>{
    let amount = document.getElementById('bank_amount')
    let c_amount = document.getElementById('converted_amount')
    
    let balls = document.getElementById('loading')
    balls.style.display = 'block'
    
        
   try {
    const res = await fetch('../../api/users/rate', {
        method: "GET",
        headers: login,
    })
    const reply = await res.json()
    c_amount.value = reply.data.rate*amount.value
    
   } catch (error) {
    console.log(error);
   }finally{
    balls.style.display = 'none'
    
   } 
  }
  

  const Bank_Payment = async() =>{
    let amount = document.getElementById('bank_amount')
    let image = document.getElementById('image')
    let btn = document.getElementById('btn')
    let balls = document.getElementById('load_ing')
    balls.style.display = 'block'
    btn.style.display = 'none'
    const data = new FormData();
        data.append('amount', amount.value);
        data.append('method', 'Bank Transfer');
        data.append('image', image.files[0]);
          try {
    const res = await fetch('../../api/users/payments', {
        method: "POST",
        headers: login,
        body: data
    })
    const reply = await res.json()
    
    alert(reply.msg)
    if(reply.msg.search('Successful')>-1){
         window.location.assign('payment_history')
    }
   } catch (error) {
    console.log(error);
   }finally{
    balls.style.display = 'none'
    btn.style.display = 'block'
   }
  }


  const Usdt_Payment = async() =>{
    let amount = document.getElementById('usdt_amount')
    let image = document.getElementById('usdt_image')
    let btn = document.getElementById('usdt_btn')
    let balls = document.getElementById('usdt_loading')
    balls.style.display = 'block'
    btn.style.display = 'none'
    const data = new FormData();
        data.append('amount', amount.value);
        data.append('method', 'USDT');
        data.append('image', image.files[0]);
          try {
    const res = await fetch('../../api/users/payments', {
        method: "POST",
        headers: login,
        body: data
    })
    const reply = await res.json()
    
    alert(reply.msg)
    if(reply.msg.search('Successful')>-1){
         window.location.assign('payment_history')
    }
   } catch (error) {
    console.log(error);
   }finally{
    balls.style.display = 'none'
    btn.style.display = 'block'
   }
  }

  const Btc_Payment = async() =>{
    let amount = document.getElementById('btc_amount')
    let image = document.getElementById('btc_image')
    let btn = document.getElementById('btc_btn')
    let balls = document.getElementById('btc_loading')
    balls.style.display = 'block'
    btn.style.display = 'none'
    const data = new FormData();
        data.append('amount', amount.value);
        data.append('method', 'Bitcoin');
        data.append('image', image.files[0]);
          try {
    const res = await fetch('../../api/users/payments', {
        method: "POST",
        headers: login,
        body: data
    })
    const reply = await res.json()
    
    alert(reply.msg)
    if(reply.msg.search('Successful')>-1){
         window.location.assign('payment_history')
    }
   } catch (error) {
    console.log(error);
   }finally{
    balls.style.display = 'none'
    btn.style.display = 'block'
   }
  }

  const  Payments_history = async() =>{
    let balls = document.getElementById('loading')
      balls.style.display = 'block'
     try {
      const res = await fetch('../../api/users/payments', {
          method: "GET",
          headers: login,
      })
      const reply = await res.json()
      reply.data.forEach((element,i) => {
        payments.innerHTML += `
          <tr>
                          <td> <strong>${1+i++}</strong></td>
                          <td>${element.payment_method}</td>
                          <td>$ ${element.payment_amount}</td>
                          <td>${element.payment_id}</td>
                          <td> <div class="badge ${element.payment_status === 'Approved' ? 'badge-outline-success':
                          element.payment_status === 'pending' ? 'badge-outline-warning':
                           'badge-outline-danger'
                        }
                          ">${element.payment_status}</div>
                          </td>
                            <td>${element.payment_date}</td>
                          
                        </tr>
                        
                        `
                      })
  } catch (error) {
      console.log(error);
  }finally{
    balls.style.display = 'none'
   }
  }
  const Subscribe = async() =>{
    let username = document.getElementById('username')
    let password = document.getElementById('password')
    let duration = document.getElementById('duration')
    let vps = document.getElementById('vps')
    let btn = document.getElementById('btn')
    let balls = document.getElementById('load_ing')
    balls.style.display = 'block'
    btn.style.display = 'none'
    const data = new FormData();
        data.append('username', username.value);
        data.append('password', password.value);
        data.append('duration', duration.value);
        data.append('vps', vps.value);
          try {
    const res = await fetch('../../api/users/subscriptions', {
        method: "POST",
        headers: login,
        body: data
    })
    const reply = await res.json()
    
    alert(reply.msg)
    if(reply.msg.search('successfully')>-1){
         window.location.assign('subscriptions')
    }
   } catch (error) {
    console.log(error);
   }finally{
    balls.style.display = 'none'
    btn.style.display = 'block'
   }
  }
  const  Subscriptions = async() =>{
    let balls = document.getElementById('loading')
      balls.style.display = 'block'
     try {
      const res = await fetch('../../api/users/subscriptions', {
          method: "GET",
          headers: login,
      })
      const reply = await res.json()
      reply.data.forEach((element,i) => {
        sub.innerHTML += `
          <tr>
                          <td> <strong>${1+i++}</strong></td>
                          <td>${element.vps}</td>
                          <td>$ ${element.amount}</td>
                          <td>${element.duration} Month(s)</td>
                          <td>${element.sub_id}</td>
                          <td>${element.date}<br>${element.time}</td>
                          <td> <div class="badge ${element.sub_status === 'Activated' ? 'badge-outline-success':
                          element.sub_status === 'processing' ? 'badge-outline-warning':
                          element.sub_status === 'Deactivated' ? 'badge-outline-primary':
                           'badge-outline-danger'
                        }
                          ">${element.sub_status}</div>
                          </td>
                            <td><a href='view_subscription?sub=${element.sub_id}' class='btn btn-success'>View</a></td>
                          
                        </tr>
                        
                        `
                      })
  } catch (error) {
      console.log(error);
  }finally{
    balls.style.display = 'none'
   }
  }

  const View_Subscription= async(sub_id) => {
    let balls = document.getElementById('loading')
    balls.style.display = 'block'
    // subcategories.innerHTML = []
   try {
    const res = await fetch('../../api/users/subscriptions?sub_id='+sub_id, {
        method: "GET",
        headers: login,
    })
    const reply = await res.json()
  content.innerHTML = `
  <div class="">
                  <div class="p-3 rounded border">
                      <h4>${reply.data.vps}</h4>
                     
                      <span>Forex VPS</span>
                      <p class="border-top mt-2"></p>
                      <div class="mt-3">

                      ${reply.data.description}
                      </div>
                  </div>
              </div>
            `
            
            duration.innerHTML = reply.data.duration
            amount.innerHTML = reply.data.amount
            sub.innerHTML = reply.data.sub_id
            subStatus.innerHTML = reply.data.sub_status
            date.innerHTML = reply.data.date
            
            if(reply.data.ip === '' || reply.data.ip === ' '){
              ip.innerHTML = '...'
              username.innerHTML = '...'
              password.innerHTML = '...'
            }else{
              ip.innerHTML = reply.data.ip
              username.innerHTML = reply.data.username
              password.innerHTML = reply.data.password
            }
            Sub_status.innerHTML = reply.data.sub_status
            vps_name.innerHTML = reply.data.vps
            
  } catch (error) {
    console.log(error);
  }finally{
  balls.style.display = 'none'
  } 
  }

  const Withdrawal = async() =>{
    let amount = document.getElementById('amount')
    let a_name = document.getElementById('a_name')
    let a_number = document.getElementById('a_number')
    let bank_name = document.getElementById('bank_name')
    let btn = document.getElementById('btn')
    let balls = document.getElementById('load_ing')
    balls.style.display = 'block'
    btn.style.display = 'none'
    const data = new FormData();
        data.append('account_name', a_name.value);
        data.append('bank_name', bank_name.value);
        data.append('account_number', a_number.value);
        data.append('amount', amount.value);
          try {
    const res = await fetch('../../api/users/withdrawal', {
        method: "POST",
        headers: login,
        body: data
    })
    const reply = await res.json()
    
    alert(reply.msg)
    if(reply.msg.search('successfully')>-1){
         window.location.reload()
    }
   } catch (error) {
    console.log(error);
   }finally{
    balls.style.display = 'none'
    btn.style.display = 'block'
   }
  }

  const  Withdrawal_history = async() =>{
    let balls = document.getElementById('loading')
      balls.style.display = 'block'
     try {
      const res = await fetch('../../api/users/withdrawal', {
          method: "GET",
          headers: login,
      })
      const reply = await res.json()
      reply.data.forEach((element,i) => {
        withdrawal.innerHTML += `
          <tr>
                          <td> <strong>${1+i++}</strong></td>
                          <td>${element.account_number}<br>${element.bank_name}</td>
                          <td>$ ${element.amount}</td>
                          <td>${element.date}</td>
                          
                          <td> <div class="badge ${element.with_status === 'Approved' ? 'badge-outline-success':
                          element.with_status === 'pending' ? 'badge-outline-warning':
                           'badge-outline-danger'
                        }
                          ">${element.with_status}</div>
                          </td>
                        </tr>
                        
                        `
                      })
  } catch (error) {
      console.log(error);
  }finally{
    balls.style.display = 'none'
   }
  }
  const Profile = async() =>{
    
    let balls = document.getElementById('loading')
    balls.style.display = 'block'
   try {
    const res = await fetch('../../api/users/profile', {
        method: "GET",
        headers: login,
    })
    const reply = await res.json()
    firstname.value = reply.data.firstname
    lastname.value = reply.data.lastname
    address.value = reply.data.address
    phone.value = reply.data.phone
    email.value = reply.data.email
    date.value = reply.data.date
    Link.value = 'https://www.myfxvpsm.com/dashboard/template/register?ref_id='+reply.data.reg_id
    
   } catch (error) {
    console.log(error);
   }finally{
    balls.style.display = 'none'
   }
  
  }
  
  const Update_Profile = async() =>{
    let balls = document.getElementById('loading')
    balls.style.display = 'block'
    const data = {
                'firstname': firstname.value,
                'lastname': lastname.value,
                'address': address.value,
                'phone': phone.value,
    }
   try {
    const res = await fetch('../../api/users/profile', {
        method: "PATCH",
        body: JSON.stringify(data),
        headers: login,
    })
    const reply = await res.json()
    alert(reply.msg)
    if(reply.msg.search('successful')>-1){
      Profile()
      // window.location.reload()
  }
   } catch (error) {
    console.log(error);
   }finally{
    balls.style.display = 'none'
   }
  }
  const Password = async()=>{
    let balls = document.getElementById('load_ing')
    balls.style.display = 'block'
    const data = {
                'password': old_password.value,
                'c_password': c_password.value,
                'new_password': new_password.value,
    }
   try {
    const res = await fetch('../../api/users/password', {
        method: "PATCH",
        body: JSON.stringify(data),
        headers: login,
    })
    const reply = await res.json()
    alert(reply.msg)
    if(reply.msg.search('successful')>-1){
      window.location.assign('../login')
  }
   } catch (error) {
    console.log(error);
   }finally{
    balls.style.display = 'none'
   }
  }
  
  const  Subscriptions_dash = async() =>{
    
     try {
      const res = await fetch('../../api/users/subscriptions?dash', {
          method: "GET",
          headers: login,
      })
      const reply = await res.json()
      reply.data.forEach((element,i) => {
        sub.innerHTML += `
                       <div class="preview-item border-bottom">
                            <div class="preview-thumbnail">
                            <div class="preview-icon bg-success">
                              <i class="mdi mdi-cloud-download"></i>
                            </div>
                          </div>
                            <div class="preview-item-content d-sm-flex flex-grow">
                              <div class="flex-grow">
                                <h6 class="preview-subject">${element.vps}</h6>
                                <p class="text-muted mb-0">$ ${element.amount}</p>
                              </div>
                              <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                <p class="text-muted">${element.duration} Month(s)</p>
                                <p class="text-muted mb-0">${element.date}<br>${element.time}</p>
                              </div>
                            </div>
                          </div>
                          `
                      })
  } catch (error) {
      console.log(error);
  }
  }
  const  Payments_history_dash = async() =>{
    let balls = document.getElementById('load_ing')
      balls.style.display = 'block'
     try {
      const res = await fetch('../../api/users/payments?dash', {
          method: "GET",
          headers: login,
      })
      const reply = await res.json()
      reply.data.forEach((element,i) => {
        payments.innerHTML += `
          <tr>
                          <td> <strong>${1+i++}</strong></td>
                          <td>${element.payment_method}</td>
                          <td>$ ${element.payment_amount}</td>
                          <td>${element.payment_id}</td>
                          <td>${element.payment_date}</td>
                          <td> <div class="badge ${element.payment_status === 'Approved' ? 'badge-outline-success':
                          element.payment_status === 'pending' ? 'badge-outline-warning':
                           'badge-outline-danger'
                        }
                          ">${element.payment_status}</div>
                          </td>
                          
                        </tr>
                        
                        `
                      })
  } catch (error) {
      console.log(error);
  }finally{
    balls.style.display = 'none'
   }
  }
  const Login = async() =>{
    
     try {
      const res = await fetch('../../api/users/login', {
          method: "GET",
          headers: login,
      })
      const reply = await res.json()
      reply.data.forEach((element,i) => {
        tbody.innerHTML += `
        <tr>
        <td>
          <i class="flag-icon flag-icon-ng"></i>
        </td>
        <td>Nigeria</td>
        <td>${element.date}</td>
        <td class="text-right"> ${element.time} </td>
      </tr>
                        
                        `
                      })
  } catch (error) {
      console.log(error);
  }
  }