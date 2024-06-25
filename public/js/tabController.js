$(document).ready(function() {
    $.get('api/settings/tabs', function(data) {
        if (data.tab_order.length > 0) applyTabOrder(data.tab_order);
        $('#tabs').children(':first')[0].classList.add('selected');
        if (window.location.hash) makeNetworkList(window.location.hash);
    });
    $('#save-tab-order').on('click', function() {
        var tabOrder = getTabOrder(); 
        $.ajax({
            url: 'api/settings/tabs',
            method: 'POST',
            data: {
                tab_order: tabOrder,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                alert('Tab order saved!');
            }
        });
    });
});
function getTabOrder(){
    var order = [];
    $('#tabs .tab').each(function() {
        order.push($(this).data('tab'));
    });
    return order;
}
function applyTabOrder(order){
    var container = $('#tabs');
    container.empty();
    order.forEach(function(tab){
        var button = document.createElement('button');
        button.id = tab.toLowerCase();
        button.addEventListener('click', function(e){
            window.location.hash = e.target.id;
            e.preventDefault();
        })
        $.get('api/translate/' + tab, function(data) {
            button.textContent = data;
        });
        container.append(button);
    });
    if (!window.location.hash) window.location.hash = container.children(':first')[0].id;
}
function addNetworks(data){
    var savedNetworks = {'auth': false, 'networks': []};
    var networksContainer = $('#content-networks');

    fetch('api/savedNetworks/')
        .then(response => response.json())
        .then(dataSavedNetworks => {
            if (dataSavedNetworks['auth']){
                savedNetworks['auth'] = true;
                dataSavedNetworks['saved'].forEach(network =>{
                    savedNetworks.networks.push(network['route_network_id']);
                })
            }
                networksContainer.empty();
                data.forEach(element => {
                    var li = document.createElement('li');
                    li.setAttribute('data-network-id', element['id']);
                    var imgTrans = document.createElement('img');
                    var a = document.createElement('a');
                    var p = document.createElement('p');
                    if (savedNetworks.auth){
                        var imgSaved = document.createElement('img');
                        if (savedNetworks.networks.includes(element['id'])) imgSaved.setAttribute('src', 'img/star-yellow.png');
                        else imgSaved.setAttribute('src', 'img/star-empty.png');
                        imgSaved.addEventListener('click', function(e) {
                            let networkID = e.target.parentElement.dataset.networkId;
                            if (e.target.getAttribute('src') == 'img/star-empty.png') {
                                fetch('api/saveNetwork/' + networkID).then(response => response.json());
                                e.target.setAttribute('src', 'img/star-yellow.png');
                            }
                            else {
                                fetch('api/unSaveNetwork/' + networkID).then(response => response.json());
                                e.target.setAttribute('src', 'img/star-empty.png');
                                if ($('#tabs').children('.selected')[0].id == 'saved') e.target.parentElement.remove();
                            }
                        })
                        imgSaved.classList.add('saved-star');
                        li.appendChild(imgSaved);
                    }
                    imgTrans.setAttribute('src', '/img/' + element['transport_type'] + '.png');
                    p.textContent = element['name'];
                    a.textContent = element ['description'];
                    a.id = element['name'] + '-' + element['transport_type'];
                    a.setAttribute('href', '/schedule'+ '#' + element['transport_type'] + '/' + element['name']);
                    li.appendChild(imgTrans);
                    li.appendChild(p);
                    li.appendChild(a);
                    li.classList.add(element['transport_type']);
                    networksContainer.append(li);
                });
        });
    
}; 
function makeNetworkList (hash){
    switch(hash){
        case '#all':
            $('#tabs').children('.selected').removeClass('selected');
            $('#all')[0].classList.add('selected');
            fetch('api/tab/all')
                .then(response => response.json())
                .then(data => {
                    addNetworks(data);
                });
            break;
        case '#bus':
            $('#tabs').children('.selected').removeClass('selected');
            $('#bus')[0].classList.add('selected');
            fetch('api/tab/bus')
                .then(response => response.json())
                .then(data => {
                    addNetworks(data);
                });
            break;
        case '#tram':
            $('#tabs').children('.selected').removeClass('selected');
            $('#tram')[0].classList.add('selected');
            fetch('api/tab/tram')
                .then(response => response.json())
                .then(data => {
                    addNetworks(data);
                });
            break;
        case '#saved':
            $('#tabs').children('.selected').removeClass('selected');
            $('#saved')[0].classList.add('selected');
            fetch('api/tab/saved')
                .then(response => response.json())
                .then(data => {
                    addNetworks(data);
                });
            break;    
        default:
            break;
    }
}
$(window).on('hashchange', function(e) {
    const hash = window.location.hash;
    makeNetworkList(hash);
});