
markActiveLink()
populateOrdersTable()



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
function populateOrdersTable(){

    var perPage = document.getElementById('result_per_page').value
    var sortBy = document.getElementById('orders_table').dataset.sortedBy
    var page = document.getElementById('orders_table').dataset.page
    var sortDirection = document.getElementById('orders_table').dataset.sortDirection
    var searchQuery = document.getElementById('search_input').value
  // sending api request
  fetch("/orders/all", {
    method: "POST",
    body: JSON.stringify({sortBy: sortBy, sortDirection: sortDirection, perPage: perPage, page: page, searchQuery: searchQuery}),
    credentials: "same-origin",
    headers: {
           "Content-Type": "application/json; charset=utf-8",
       }
  })
  .then(response => {
    if(response.status !== 200)
        response.text().then(errors =>{ throw errors})
        .catch(err => {
            console.log(err)
        })
    else {
        return response.json()
    }})
    .then(res => {
        var response = res.orders
        var pageCount = res.count
        pagesNavigation(pageCount)
        document.getElementById('orders_table_body').innerHTML = ''
        for(var i=0; i< response.length; i++){
            var tr = document.createElement('tr')
            var th = document.createElement('th')
            var client = document.createElement('td')
            var creationDate = document.createElement('td')
            var payed = document.createElement('td')
            var shipped = document.createElement('td')
            tr.onclick = function(){
                openOrderModal(this)
            }
            tr.className = "cursor-pointer hover-highlight"
            tr.dataset.id = response[i].id
            tr.dataset.quantity = response[i].quantity
            tr.dataset.address = response[i].shipping_details.address
            tr.dataset.city = response[i].shipping_details.city
            tr.dataset.country = response[i].shipping_details.country
            tr.dataset.post = response[i].shipping_details.post_code
            th.scope = "col"
            th.innerHTML = i+1
            client.innerHTML = response[i].client_name
            creationDate.innerHTML = response[i].created_at
            payed.className = "text-center"
            shipped.className = "text-center"
            if(response[i].payment_received === 1)
                payed.innerHTML = '<span class="fas fa-check text-success"></span>'
            else
                payed.innerHTML = '<span class="fas fa-times text-danger"></span>'

            if(response[i].order_shipped === 1)
                shipped.innerHTML = '<span class="fas fa-check text-success"></span>'
            else
                shipped.innerHTML = '<span class="fas fa-times text-danger"></span>'

            tr.appendChild(th)
            tr.appendChild(client)
            tr.appendChild(creationDate)
            tr.appendChild(payed)
            tr.appendChild(shipped)
            document.getElementById('orders_table_body').appendChild(tr)

        }

  })
}

function sortBy(field, el){
    var header = el
    removeShevrons()
    var sortBy = document.getElementById('orders_table')
    var sortDirection = document.getElementById('orders_table')

    if(field == sortBy.dataset.sortedBy){
        if(sortDirection.dataset.sortDirection == "ASC"){
            sortDirection.dataset.sortDirection = "DESC"
            var shevronDown = document.createElement('span')
            shevronDown.className = "fas fa-angle-down px-3"
            header.appendChild(shevronDown)
        }
        else {
            sortDirection.dataset.sortDirection = "ASC"
            var shevronUp = document.createElement('span')
            shevronUp.className = "fas fa-angle-up px-3"
            header.appendChild(shevronUp)
        }
    }else {
        sortBy.dataset.sortedBy = field
        sortDirection.dataset.sortDirection = "ASC"
        var shevronUp = document.createElement('span')
        shevronUp.className = "fas fa-angle-up px-3"
        header.appendChild(shevronUp)

    }
    populateOrdersTable()
}

function removeShevrons(){
    var elems = document.querySelectorAll(".fas.fa-angle-up");
    [].forEach.call(elems, function(el) {
        el.remove();
    });

    var elems = document.querySelectorAll(".fas.fa-angle-down");
    [].forEach.call(elems, function(el) {
        el.remove();
    });

}

function nextPage(){
    var page = document.getElementById('orders_table').dataset.page
    document.getElementById('orders_table').dataset.page = parseInt(page)+1
    populateOrdersTable()
}

function previousPage(){
    var page = document.getElementById('orders_table').dataset.page
    var page = parseInt(page)
    if(page === 1)
        return;
    else
        document.getElementById('orders_table').dataset.page = page-1
    populateOrdersTable()
}

function changePerPage(){
    populateOrdersTable()
}

function pagesNavigation(count){
    var page = document.getElementById('orders_table').dataset.page
    var perPage = document.getElementById('result_per_page').value
    page = parseInt(page)
    perPage = parseInt(perPage)
    count = parseInt(count)
    var diff = count/perPage
    diff = Math.ceil(diff)
    var container = document.getElementById('orders_pagination')
    container.innerHTML = ''
    for(var i = 1; i<=diff; i++){
        var li = document.createElement('li')
        var a = document.createElement('a')
        li.className = "page-items"
        a.className = "page-link bg-dark text-light"
        if(page == i)
            a.className += "border-danger"
        a.onclick = function(){
            goPage(this)
        }
        a.dataset.page = i
        a.innerHTML = i
        li.appendChild(a)
        container.appendChild(li)
    }
}

function goPage(el){
    var destPage = el.dataset.page
    document.getElementById('orders_table').dataset.page = destPage
    populateOrdersTable()
}

function openOrderModal(tr){

    var modal = document.getElementById('order_info_modal')
    document.getElementById('order_info_modal_quantity').innerHTML = tr.dataset.quantity
    document.getElementById('order_info_modal_address').innerHTML = tr.dataset.address
    document.getElementById('order_info_modal_city').innerHTML = tr.dataset.city
    document.getElementById('order_info_modal_country').innerHTML = tr.dataset.country
    document.getElementById('order_info_modal_post').innerHTML = tr.dataset.post
    modal.dataset.id = tr.dataset.id
    modal.classList.add('show')
}

function closeModal(){
    var modal = document.getElementById('order_info_modal')
    modal.classList.remove('show')
}

function orderPaid(){
    var id = document.getElementById('order_info_modal').dataset.id
    fetch("/orders/paid/"+id).then(response =>{
        populateOrdersTable()
        closeModal()
    })
}

function orderShipped(){
    var id = document.getElementById('order_info_modal').dataset.id
    fetch("/orders/shipped/"+id).then(response =>{
        populateOrdersTable()
        closeModal()
    })
}

function seedDatabase(){
    fetch("/orders/seed").then(response =>{
        populateOrdersTable()
    })
}
