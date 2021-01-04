function mylogin() {
  var help = document.getElementById("exampleInputEmail1").value
  console.log(help)

document.getElementById('inputname1').innerHTML = help;

}

function mysignup(){
    $('#exampleModal2').modal('show');
    document.getElementById('nowords').style.visibility = 'hidden';
    console.log(username);
  }



$(document).ready(function(){
$('#textareaID').on('input propertychange', function(){
  if(this.value.length > 500) {
    $('#exampleModal').modal('show');
    $("#textareaID").val($("#textareaID").val().substring(0,501));

}
})
});


var price = document.querySelector('.pricy').textContent;
console.log(price);

if (price >= 30) {

}
