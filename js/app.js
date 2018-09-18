// Assigns active class to nav link
function markActiveLink(){
    var activeurl = window.location.href;
    links = document.getElementsByTagName("a");
    for(var i = 0; i < links.length; i++) {
      if( links[i].href === activeurl ) {
        links[i].parentElement.classList.add("active")
        return;
      }
   }
}
markActiveLink()
//send POST request to post creation api and get validation errors if there are any
function createOrder(){
    // disabling submit button for the duration of the request
  document.getElementById("order_form_submit").disabled = true

  var variables = new Array(
    document.getElementById("order_form_name"),
    document.getElementById("order_form_address"),
    document.getElementById("order_form_city"),
    document.getElementById("order_form_country"),
    document.getElementById("order_form_post"),
    document.getElementById("order_form_quantity")
  )
  var data = {}
  variables.forEach(function(variable){
    data[variable.name] = variable.value
  })

  // sending api request
  fetch("/orders/create", {
    method: "POST",
    body: JSON.stringify(data),
    credentials: "same-origin",
    headers: {
           "Content-Type": "application/json; charset=utf-8",
       }
  })
  .then(response => {
    if(response.status !== 200)
        response.text().then(errors =>{ throw errors})
        .catch(err => {
            var div = document.createElement('div');
            var errors = JSON.parse(err)

            document.getElementById("order_form_submit").disabled = false

            document.getElementById("order_alert_container").innerHTML = ''
            div.className = 'alert-danger h6 text-left pl-4 pt-3 pb-3';
            div.id = 'order_form_errors'
            document.getElementById("order_alert_container").appendChild(div)
            for(var i = 0; i< errors.errors.length; i++){
                var error = document.createElement('li')
                error.innerHTML = errors.errors[i]
                document.getElementById("order_form_errors").appendChild(error)
            }
        })
    else {
        return response.json()
    }})
    .then(response => {
        document.getElementById("order_form_submit").disabled = false

        var div = document.createElement('div');
        document.getElementById("order_alert_container").innerHTML = ''
        div.className = 'alert-success h6 text-center pt-3 pb-3';
        div.innerHTML = 'Order created!'
        document.getElementById("order_alert_container").appendChild(div)
        emptyInputs()
  })

}

function emptyInputs(){
  var inputs = document.getElementsByTagName("input")
  for(var i = 0; i < inputs.length; i++) {
    inputs[i].value = ''
  }
}
