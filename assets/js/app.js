var checkPassword = function() {
    $message = '<i class=\"far fa-times-circle\"> Les deux mots de passe ne correspondent pas.';
    $isDisaled = true;

    if (document.getElementById('password').value == document.getElementById('password_confirm').value){
       $message = '';
       $isDisaled = false;
    }

    document.getElementById('message_password').innerHTML = $message;
    document.getElementById('submit').disabled = $isDisaled;
   
}

function LoginLogoutMessage(text){
   var x=document.getElementById("toast");
   x.classList.add("show");
   x.innerHTML=text;

   setTimeout(function(){
     x.classList.remove("show");
     window.location.href = '../';
   },2000);
 }

 function ToastWithoutRediction(text){
  var x=document.getElementById("toast");
  x.classList.add("show");
  x.innerHTML=text;
}

const toggleSwitch = document.querySelector('.switch input[type="checkbox"]');
const currentTheme = localStorage.getItem('theme');

if (currentTheme) {
  document.documentElement.setAttribute('data-theme', currentTheme);

  if (currentTheme === 'dark') {
    toggleSwitch.checked = true;
  }
}

function switchTheme(e) {
  if (e.target.checked) {
    document.documentElement.setAttribute('data-theme', 'dark');
    localStorage.setItem('theme', 'dark');
  }
  else {        
    document.documentElement.setAttribute('data-theme', 'light');
    localStorage.setItem('theme', 'light');
  }    
}

toggleSwitch.addEventListener('change', switchTheme, false);


function checkQuiz(){
  var reponses = document.getElementsByClassName("check");
  for (i = 0; i < reponses.length; i++)
    if(reponses[i].value == 1)
      reponses[i].checked = true;
}