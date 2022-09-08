    var num1=Math.floor(Math.random() * 10);
    var num2=Math.floor(Math.random() * 10);

  

    document.getElementById('userVerification').placeholder="Enter sum of "+num1+" + "+num2;

    function reloadCaptcha(){

       num1=Math.floor(Math.random() * 10);
       num2=Math.floor(Math.random() * 10);
       document.getElementById('userVerification').placeholder="Enter sum of "+num1+" + "+num2;
       document.getElementById('userVerification').value="";
       document.getElementById('error_message').style.visibility="hidden";
    }

    function onCaptchaChange(){
       var user_answer=document.getElementById('userVerification').value;
       var right_result=num1+num2;

       if (right_result==user_answer) {
          document.getElementById('error_message').style.visibility="hidden";
          document.getElementById('submit_btn').type="submit";
       } 
       else if (user_answer=='') {
        document.getElementById('error_message').style.visibility="hidden";
        document.getElementById('submit_btn').type="button";
       }
       else {
        document.getElementById('error_message').style.visibility="visible";
        document.getElementById('submit_btn').type="button";
       }
       
    }