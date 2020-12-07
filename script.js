function mylogin() {
  var help = document.getElementById("exampleInputEmail1").value
  console.log(help)

document.getElementById('inputname1').innerHTML = help;

}

function mysignup(){
$(document).ready(function(){
  var username = document.getElementById("exampleInputEmail2").value
  document.getElementById('inputname2').innerHTML = username;
  console.log(username)
  if (username == ''){
    document.getElementById('nowords').style.visibility = 'visible';
    }else{
    $('#exampleModal2').modal('show');
    document.getElementById('nowords').style.visibility = 'hidden';
    console.log(username)
  }
});
}
$(document).ready(function(){
$('#textareaID').on('input propertychange', function(){
  if(this.value.length > 50) {
    $('#exampleModal').modal('show');
    $("#textareaID").val($("#textareaID").val().substring(0,60));

}
})
});
