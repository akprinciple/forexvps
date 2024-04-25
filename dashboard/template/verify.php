<?php
    if (isset($_GET['email']) && isset($_GET['token'])) {
        $email = $_GET['email'];
        $token = $_GET['token'];
    }
?>
        <img src="assets/images/loading.gif" alt="" id="balls" style="display: block; margin:100px auto">
<script>
    const Verification = async(email, token)=>{
            let balls = document.getElementById('balls')
            balls.style.display = 'block'
           try {
            const res = await fetch('../api/verify?email='+email+'&&token='+token, {
                method: "GET",
                
            })
            const reply = await res.json()
            alert(reply.msg)
            if (reply.msg === "Verification Successful") {
                window.location.assign('login')
            }
           } catch (error) {
            console.log(error);
           }finally{
            balls.style.display = 'none'
           }

    }
    Verification('<?php echo $email;?>', '<?php echo $token;?>')
</script>