let login = JSON.parse(localStorage.getItem('login'))
async function Summary(){
    
  let balls = document.getElementById('loading')
  balls.style.display = 'block'
 try {
  const res = await fetch('../../api/admin/summary', {
      method: "GET",
      headers: login,
  })
  const reply = await res.json()
  amount_spent.innerHTML = reply.data.amount_spent
  wallet_balance.innerHTML = reply.data.wallet_balance
  affiliate_earnings.innerHTML = reply.data.affiliate_wallet_balance
  amount_withdrawn.innerHTML = reply.data.amount_withdrawn
  vps.innerHTML = reply.data.vps
  activated_sub.innerHTML = reply.data.activated_sub
  pending_withdrawal.innerHTML = reply.data.pending_withdrawal
  
  
 } catch (error) {
  console.log(error);
 }finally{
  balls.style.display = 'none'
 }

}
const AddVPS = async() => {
  
    let vps = document.getElementById('vps')
    let price = document.getElementById('price')
    let old_price = document.getElementById('old_price')
    let description = document.getElementById('description')
    let btn = document.getElementById('btn')
    loading.style.display = 'block'
    btn.style.display = 'none'
    const data = new FormData();
        data.append('vps', vps.value);
        data.append('price', price.value);
        data.append('old_price', old_price.value);
        data.append('description', description.value);
       
   try {
    const res = await fetch('../../api/admin/vps', {
        method: "POST",
        headers: login,
        body: data
    })
    const reply = await res.json()
    alert(reply.msg)
    if(reply.msg.search('Successful')>-1){
         window.location.reload()
    }
   } catch (error) {
    console.log(error);
   }finally{
    loading.style.display = 'none'
    btn.style.display = 'block'
   }
  
  }
  const VPS = async() => {
    let loading = document.getElementById('loading')
      loading.style.display = 'block'
      vps.innerHTML = []
     try {
      const res = await fetch('../../api/admin/vps', {
          method: "GET",
          headers: login,
      })
      const reply = await res.json()
      reply.data.forEach((element,i) => {
        vps.innerHTML += `
        <tr>
        <td>${1+i++}</td>
        <td>${element.vps}</td>
        <td>${element.price}</td>
        
        <td><label class="badge ${element.status === 'Active' ? 'badge-primary' : 'badge-danger'}">${element.status}</label></td>
        <td style='font-size: 18px'>
        <a href='view_vps?id=${element.id}'><i class='mdi mdi-pen'></i></a>
        <i class='mdi mdi-delete-forever text-danger' ondblclick="Del_vps(${element.id})" title='Double click to delete'></i></td>
        </tr>
                        `
                      })
  } catch (error) {
      console.log(error);
  }finally{
    loading.style.display = 'none'
   }
  }

  async function Del_vps(id){
    
    let balls = document.getElementById('loading')
    balls.style.display = 'block'
   try {
    const res = await fetch('../../api/admin/vps?id='+id, {
        method: "DELETE",
        headers: login,
    })
    const reply = await res.json()
    alert(reply.msg)
    VPS()
    // window.location.reload()
  } catch (error) {
    console.log(error);
  }finally{
  balls.style.display = 'none'
  }
  }

  const ViewVPS = async(id)=> {
    let balls = document.getElementById('loading')
    balls.style.display = 'block'
   try {
    const res = await fetch('../../api/admin/vps?id='+id, {
        method: "GET",
        headers: login,
    })
    const reply = await res.json()
    current_status.innerHTML = reply.data.status
    current_status.value = reply.data.status
    vps.value = reply.data.vps
    price.value = reply.data.price
    old_price.value = reply.data.old_price
    description.value = reply.data.description
    // subcategory.value = reply.data.subcategory
    
   } catch (error) {
    console.log(error);
   }finally{
    balls.style.display = 'none'
   }
  
  }
  async function Update_vps(id) {
    let balls = document.getElementById('load_ing')
    balls.style.display = 'block'
    btn.style.display = 'none'
    
    const data = {
                'vps': vps.value,
                'price': price.value,
                'old_price': old_price.value,
                'status': vps_status.value,
                'description': description.value
    }
   try {
    const res = await fetch('../../api/admin/vps?id='+id, {
        method: "PATCH",
        body: JSON.stringify(data),
        headers: login,
    })
    const reply = await res.json()
    alert(reply.msg)
    if(reply.msg.search('successful')>-1){
      window.location.assign('all_vps')
  }
   } catch (error) {
    console.log(error);
   }finally{
    balls.style.display = 'none'
    btn.style.display = 'block'
   } 
  }
  
  const Payments = async() => {
    let loading = document.getElementById('loading')
      loading.style.display = 'block'
      vps.innerHTML = []
     try {
      const res = await fetch('../../api/admin/payments', {
          method: "GET",
          headers: login,
      })
      const reply = await res.json()
      reply.data.forEach((element,i) => {
        vps.innerHTML += `
        <tr>
        <td>${1+i++}</td>
        <td class='text-capitalize'>${element.firstname + ' ' + element.lastname}</td>
        <td class='text-center'>${element.payment_amount}</td>
        <td>${element.payment_method}</td>
        <td>${element.payment_date+ '<br>' + element.payment_time}</td>
        
        <td> <div class="badge ${element.payment_status === 'Approved' ? 'badge-outline-success':
        element.payment_status === 'pending' ? 'badge-outline-warning':
         'badge-outline-danger'
      }
        ">${element.payment_status}</td>
        <td style='font-size: 18px'>
        <a href='view_payment?id=${element.id}'><i class='mdi mdi-pen text-success'></i></a>
        <i class='mdi mdi-delete-forever text-danger' ondblclick="Del_payment(${element.id})" title='Double click to delete'></i></td>
        </tr> `
                      })
  } catch (error) {
      console.log(error);
  }finally{
    loading.style.display = 'none'
   }
  }

  async function Del_payment(id){
    
    let balls = document.getElementById('loading')
    balls.style.display = 'block'
   try {
    const res = await fetch('../../api/admin/payments?id='+id, {
        method: "DELETE",
        headers: login,
    })
    const reply = await res.json()
    alert(reply.msg)
    Payments()
    // window.location.reload()
  } catch (error) {
    console.log(error);
  }finally{
  balls.style.display = 'none'
  }
  }

  const View_payment = async(id)=> {
    let balls = document.getElementById('loading')
    balls.style.display = 'block'
   try {
    const res = await fetch('../../api/admin/payments?id='+id, {
        method: "GET",
        headers: login,
    })
    const reply = await res.json()
    current_status.innerHTML = reply.data.payment_status
    current_status.value = reply.data.payment_status
    p_status.innerHTML = reply.data.payment_status
    p_status.value = reply.data.payment_status
    amount.value = reply.data.payment_amount
    email.value = reply.data.email
    method.value = reply.data.payment_method
    payment_id.value = reply.data.payment_id
    username.value = reply.data.firstname + ' '+reply.data.lastname
    if (reply.data.payment_image !== '' && reply.data.payment_id !==' ') {
      img.innerHTML = "<a href='../../api/payment_images/"+reply.data.payment_image+"' target='_blank'><img src='../../api/payment_images/"+reply.data.payment_image+"' alt='"+reply.data.payment_image+"' class='card-img'></a>"
    }else{
      img.innerHTML = "<h4 class='text-success text-center'>Image preview not available</h4>"
    }
    // subcategory.value = reply.data.subcategory
    
   } catch (error) {
    console.log(error);
   }finally{
    balls.style.display = 'none'
   }
  
  }

  async function Update_payments(id) {
    let balls = document.getElementById('load_ing')
    balls.style.display = 'block'
    btn.style.display = 'none'
    
    const data = {
                'amount': amount.value,
                'status': payment_status.value,
    }

   try {
    const res = await fetch('../../api/admin/payments?id='+id, {
        method: "PATCH",
        body: JSON.stringify(data),
        headers: login,
    })
    const reply = await res.json()
    alert(reply.msg)
    if(reply.msg.search('successful')>-1){
      window.location.assign('payments')
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
      const res = await fetch('../../api/admin/subscriptions', {
          method: "GET",
          headers: login,
      })
      const reply = await res.json()
      reply.data.forEach((element,i) => {
        sub.innerHTML += `
          <tr>
                          <td> <strong>${1+i++}</strong></td>
                          <td>${element.firstname} ${element.lastname}</td>
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
                            <td>
                            <a href='view_subscription?sub=${element.sub_id}' class='mdi mdi-pen text-success ' title='Edit Subscription'></a>
                            <span class='text-danger mdi mdi-delete-forever' ondblclick="Del_Subscription('${element.sub_id}')" title='Double click to delete' style='font-size: 18px' title='Delete Subscription'></span>
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

  const View_Subscription= async(sub_id) => {
    let balls = document.getElementById('loading')
    balls.style.display = 'block'
    // subcategories.innerHTML = []
   try {
    const res = await fetch('../../api/admin/subscriptions?sub_id='+sub_id, {
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
            
            customer.innerHTML = reply.data.firstname+' '+reply.data.lastname
            duration.innerHTML = reply.data.duration
            amount.innerHTML = reply.data.amount
            sub.innerHTML = reply.data.sub_id
            subStatus.innerHTML = reply.data.sub_status
            date.innerHTML = reply.data.date
            username.innerHTML = reply.data.username
            Username.value = reply.data.username
            Password.value = reply.data.password
            Ip.value = reply.data.ip
            
            if(reply.data.ip === '' || reply.data.ip === ' '){
              ip.innerHTML = '...'
              username.innerHTML = '...'
              password.innerHTML = '...'
            }else{
              ip.innerHTML = reply.data.ip
              password.innerHTML = reply.data.password
            }
            Sub_status.innerHTML = reply.data.sub_status
            vps_name.innerHTML = reply.data.vps
            email.innerHTML = reply.data.email
            email.href = 'mailto:'+reply.data.email
            if (reply.data.sub_status === 'processing') {
              btn.innerHTML = `<button class="btn btn-success" id="activate" onclick="Activate_Subscription('${reply.data.sub_id}')">Activate</button>
              <button class="btn btn-warning" id="pend" onclick="Pend_Subscription('${reply.data.sub_id}')">Pend</button>
              <button class="btn btn-danger" id="reject" onclick="Reject_Subscription('${reply.data.sub_id}')">Reject</button>
            `
            }
  } catch (error) {
    console.log(error);
  }finally{
  balls.style.display = 'none'
  } 
  }

 const Activate_Subscription = async(id)=> {
    let balls = document.getElementById('load_ing')
    balls.style.display = 'block'
    btn.style.display = 'none'
    
    const data = {
                'username': Username.value,
                'password': Password.value,
                'ip': Ip.value,
                'status': 'Activated',
    }
   try {
    const res = await fetch('../../api/admin/subscriptions?sub_id='+id, {
        method: "PATCH",
        body: JSON.stringify(data),
        headers: login,
    })
    const reply = await res.json()
    alert(reply.msg)
    if(reply.msg.search('successful')>-1){
      window.location.assign('subscriptions')
  }
   } catch (error) {
    console.log(error);
   }finally{
    balls.style.display = 'none'
    btn.style.display = 'block'
   } 
  }
  const Pend_Subscription = async(id)=> {
    let balls = document.getElementById('load_ing')
    balls.style.display = 'block'
    btn.style.display = 'none'
    
    const data = {
                'username': Username.value,
                'password': '...',
                'ip': '...',
                'status': 'processing',
    }
   try {
    const res = await fetch('../../api/admin/subscriptions?sub_id='+id, {
        method: "PATCH",
        body: JSON.stringify(data),
        headers: login,
    })
    const reply = await res.json()
    alert(reply.msg)
    if(reply.msg.search('successful')>-1){
      window.location.assign('subscriptions')
  }
   } catch (error) {
    console.log(error);
   }finally{
    balls.style.display = 'none'
    btn.style.display = 'block'
   } 
  }
  const Reject_Subscription = async(id)=> {
    let balls = document.getElementById('load_ing')
    balls.style.display = 'block'
    btn.style.display = 'none'
    
    const data = {
                'username': Username.value,
                'password': '...',
                'ip': '...',
                'status': 'Rejected',
    }
   try {
    const res = await fetch('../../api/admin/subscriptions?sub_id='+id, {
        method: "PATCH",
        body: JSON.stringify(data),
        headers: login,
    })
    const reply = await res.json()
    alert(reply.msg)
    if(reply.msg.search('successful')>-1){
      window.location.assign('subscriptions')
  }
   } catch (error) {
    console.log(error);
   }finally{
    balls.style.display = 'none'
    btn.style.display = 'block'
   } 
  }
  async function Del_Subscription(id){
    
    let balls = document.getElementById('loading')
    balls.style.display = 'block'
   try {
    const res = await fetch('../../api/admin/subscriptions?id='+id, {
        method: "DELETE",
        headers: login,
    })
    const reply = await res.json()
    alert(reply.msg)
    Subscriptions()
    window.location.reload()
  } catch (error) {
    console.log(error);
  }finally{
  balls.style.display = 'none'
  }
  }

  const  Withdrawal_history = async() =>{
    let balls = document.getElementById('loading')
      balls.style.display = 'block'
     try {
      const res = await fetch('../../api/admin/withdrawal', {
          method: "GET",
          headers: login,
      })
      const reply = await res.json()
      withdrawal.innerHTML = []
      reply.data.forEach((element,i) => {
        withdrawal.innerHTML += `
          <tr>
                          <td> <strong>${1+i++}</strong></td>
                          <td class='text-capitalize'>${element.firstname} ${element.lastname}</td>
                          <td>${element.account_number}<br>${element.bank_name}<br>${element.account_name}</td>
                          <td>$ ${element.amount}</td>
                          <td>${element.date}</td>
                          
                          <td> <div class="badge ${element.with_status === 'Approved' ? 'badge-outline-success':
                          element.with_status === 'pending' ? 'badge-outline-warning':
                           'badge-outline-danger'
                        }
                          ">${element.with_status}</div>
                          </td>
                          <td style='font-size: 18
                          px'>
                            <a href='view_withdrawal?id=${element.id}'><i class='mdi mdi-pen text-success'></i></a>
                            <i class='mdi mdi-delete-forever text-danger' ondblclick="Del_withdrawal(${element.id})" title='Double click to delete'></i>
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
  async function Del_withdrawal(id){
    
    let balls = document.getElementById('loading')
    balls.style.display = 'block'
    
   try {
    const res = await fetch('../../api/admin/withdrawal?id='+id, {
        method: "DELETE",
        headers: login,
    })
    const reply = await res.json()
    alert(reply.msg)
    Withdrawal_history()
    
    // window.location.reload()
  } catch (error) {
    console.log(error);
  }finally{
  balls.style.display = 'none'
  }
  }
  async function Update_withdrawal(id) {
    let balls = document.getElementById('load_ing')
    balls.style.display = 'block'
    btn.style.display = 'none'
    
    const data = {
        'status': withdrawal_status.value
    }

   try {
    const res = await fetch('../../api/admin/withdrawal?id='+id, {
        method: "PATCH",
        body: JSON.stringify(data),
        headers: login,
    })
    const reply = await res.json()
    alert(reply.msg)
    if(reply.msg.search('successful')>-1){
      window.location.assign('withdrawals')
  }
   } catch (error) {
    console.log(error);
   }finally{
    balls.style.display = 'none'
    btn.style.display = 'block'
   } 
  }

  const View_withdrawal = async(id)=> {
    let balls = document.getElementById('loading')
    balls.style.display = 'block'
    console.log(id);
   try {
    const res = await fetch('../../api/admin/withdrawal?id='+id, {
        method: "GET",
        headers: login,
    })
    const reply = await res.json()
    current_status.innerHTML = reply.data.with_status
    current_status.value = reply.data.with_status
    p_status.innerHTML = reply.data.with_status
    p_status.value = reply.data.with_status
    amount.value = reply.data.amount
    email.value = reply.data.email
    bank_name.value = reply.data.bank_name
    account_name.value = reply.data.account_name
    account_number.value = reply.data.account_number
    date.value = reply.data.date
    username.value = reply.data.firstname + ' '+reply.data.lastname
    
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
    const res = await fetch('../../api/admin/profile', {
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
    const res = await fetch('../../api/admin/profile', {
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
    const res = await fetch('../../api/admin/password', {
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

  const Show_rate = async() =>{
    let balls = document.getElementById('loader')
    balls.style.display = 'block'
   try {
    const res = await fetch('../../api/admin/rate', {
        method: "GET",
        headers: login,
    })
    const reply = await res.json()
    rate.value = reply.data.rate
    
    
   } catch (error) {
    console.log(error);
   }finally{
    balls.style.display = 'none'
   }
  
  }
  const Update_rate = async() =>{
    let stat = document.getElementById('user_status')
      
    let balls = document.getElementById('loader')
    let btn = document.getElementById('btn')
    balls.style.display = 'block'
    btn.style.display = 'none'
    const data = new FormData();
        data.append('rate', rate.value);
       
   try {
    const res = await fetch('../../api/admin/rate', {
        method: "POST",
        headers: login,
        body: data
    })
    const reply = await res.json()
    alert(reply.msg)
    if(reply.msg.search('successful')>-1){
         window.location.reload()
    }
   } catch (error) {
    console.log(error);
   }finally{
    balls.style.display = 'none'
    btn.style.display = 'block'
   }
  
  }
  async function Users(){
    
    let balls = document.getElementById('loading')
    balls.style.display = 'block'
   try {
    const res = await fetch('../../api/admin/users', {
        method: "GET",
        headers: login,
    })
    const reply = await res.json()
    console.log(reply);
    reply.data.forEach((element,i) => {
        users.innerHTML += `
        <tr>
                        <td> <strong>${1+i++}</strong></td>
                        <td>${element.firstname} ${element.lastname}</td>
                        <td>
                         <a href='mailto:${element.email}'>${element.email}</a>
                        </td>
                        <td>${element.phone}</td>
                        <td>${element.address}</td>
                        <td>${element.date}</td>
                        <td>
                        <div class="badge ${element.status === 'Verified' ? 'badge-outline-success':
                          element.status === 'Unverified' ? 'badge-outline-warning':
                           'badge-outline-danger'
                        }
                          ">${element.status}</div>
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
  
  const  Subscriptions_dash = async() =>{
    
    try {
     const res = await fetch('../../api/admin/subscriptions?dash', {
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
                               <p class="text-muted mb-0">${element.date}</p>
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
     const res = await fetch('../../api/admin/payments?dash', {
         method: "GET",
         headers: login,
     })
     const reply = await res.json()
     reply.data.forEach((element,i) => {
       payments.innerHTML += `
         <tr>
                         <td> <strong>${1+i++}</strong></td>
                        <td>${element.firstname} ${element.lastname}</td>
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
 const Login = async() =>{
   
    try {
     const res = await fetch('../../api/admin/login', {
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
       <td>${element.firstname} ${element.lastname}</td>
       <td>${element.date}</td>
       <td class="text-right"> ${element.time} </td>
     </tr>
                       
                       `
                     })
 } catch (error) {
     console.log(error);
 }
 }