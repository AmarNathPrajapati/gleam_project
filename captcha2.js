var num3=Math.floor(Math.random() * 10);
var num4=Math.floor(Math.random() * 10);



document.getElementById('userVerification2').placeholder="Enter sum of "+num3+" + "+num4;

function reloadCaptcha2(){

   num3=Math.floor(Math.random() * 10);
   num4=Math.floor(Math.random() * 10);
   document.getElementById('userVerification2').placeholder="Enter sum of "+num3+" + "+num4;
   document.getElementById('userVerification2').value="";
   document.getElementById('error_message2').style.visibility="hidden";
}

function onCaptchaChange2(){
   var user_answer=document.getElementById('userVerification2').value;
   var right_result=num3+num4;

   if (right_result==user_answer) {
      document.getElementById('error_message2').style.visibility="hidden";
      document.getElementById('submit_btn2').type="submit";
   } 
   else if (user_answer=='') {
    document.getElementById('error_message2').style.visibility="hidden";
    document.getElementById('submit_btn2').type="button";
   }
   else {
    document.getElementById('error_message2').style.visibility="visible";
    document.getElementById('submit_btn2').type="button";
   }
   
}